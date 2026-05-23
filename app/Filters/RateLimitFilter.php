<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

/**
 * Filter untuk rate limiting pada login dan endpoint sensitif
 * Mencegah brute force attacks
 */
class RateLimitFilter implements FilterInterface
{
    /**
     * Maximum attempts per minute
     */
    private int $maxAttempts = 5;
    
    /**
     * Window time in seconds
     */
    private int $windowTime = 60;

    /**
     * Do whatever processing this filter needs to do.
     * By default it should not return anything during
     * normal execution. However, when an abnormal state
     * is found, it should return an instance of
     * CodeIgniter\HTTP\Response. If it does, script
     * execution will end and that Response will be
     * sent back to the client, allowing for error pages,
     * redirects, or other content.
     *
     * @param RequestInterface $request
     * @param array|null       $arguments
     *
     * @return mixed
     */
    public function before(RequestInterface $request, $arguments = null)
    {
        $session = session();
        $ipAddress = $request->getIPAddress();
        $uri = $request->uri->getPath();
        
        // Key unik berdasarkan IP dan URI
        $key = 'ratelimit_' . md5($ipAddress . '_' . $uri);
        
        // Ambil data dari session
        $attempts = $session->get($key) ?? ['count' => 0, 'reset_time' => time() + $this->windowTime];
        
        // Reset jika waktu sudah lewat
        if (time() > $attempts['reset_time']) {
            $attempts = ['count' => 0, 'reset_time' => time() + $this->windowTime];
        }
        
        // Increment counter
        $attempts['count']++;
        $session->set($key, $attempts);
        
        // Check jika melebihi batas
        if ($attempts['count'] > $this->maxAttempts) {
            $retryAfter = $attempts['reset_time'] - time();
            
            return service('response')
                ->setStatusCode(429, 'Too Many Requests')
                ->setJSON([
                    'success' => false,
                    'message' => 'Terlalu banyak percobaan. Silakan coba lagi dalam ' . $retryAfter . ' detik.',
                    'retry_after' => $retryAfter
                ]);
        }
        
        return null;
    }

    /**
     * Allows After filters to inspect and modify the response
     * object as needed. This method does not allow any way
     * to stop execution of other after filters, short of
     * throwing an Exception or Error.
     *
     * @param RequestInterface  $request
     * @param ResponseInterface $response
     * @param array|null        $arguments
     *
     * @return mixed
     */
    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Reset counter jika request berhasil (status 2xx)
        if ($response->getStatusCode() >= 200 && $response->getStatusCode() < 300) {
            $session = session();
            $ipAddress = $request->getIPAddress();
            $uri = $request->uri->getPath();
            $key = 'ratelimit_' . md5($ipAddress . '_' . $uri);
            $session->remove($key);
        }
    }
}
