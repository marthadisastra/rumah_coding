<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

/**
 * Filter untuk memastikan tenant sudah login sebelum mengakses halaman tenant
 */
class TenantAuthFilter implements FilterInterface
{
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
        // Cek apakah tenant sudah login
        if (!session()->get('tenant_id')) {
            // Simpan URL yang diminta untuk redirect setelah login
            session()->setTempdata('redirect_url', current_url());
            
            return redirect()->to('/tenant/login')
                ->with('error', 'Silakan login terlebih dahulu.');
        }
        
        // Cek status tenant
        $tenantModel = new \App\Models\TenantModel();
        $tenant = $tenantModel->find(session()->get('tenant_id'));
        
        if (!$tenant || $tenant['status'] !== 'active') {
            session()->destroy();
            return redirect()->to('/tenant/login')
                ->with('error', 'Akun Anda tidak aktif. Hubungi admin.');
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
        // Tidak ada action setelah request
    }
}
