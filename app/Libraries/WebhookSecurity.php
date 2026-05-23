<?php

namespace App\Libraries;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

/**
 * Library untuk menangani webhook verification dan security
 */
class WebhookSecurity
{
    /**
     * Verifikasi signature dari webhook Evolution API
     * 
     * @param string $payload Raw POST body
     * @param string $signature Signature dari header
     * @param string $secretKey Secret key yang dikonfigurasi
     * @return bool
     */
    public function verifySignature(string $payload, string $signature, string $secretKey): bool
    {
        if (empty($signature)) {
            return false;
        }
        
        // Hitung HMAC SHA256
        $expectedSignature = hash_hmac('sha256', $payload, $secretKey);
        
        // Compare menggunakan timing-safe comparison
        return hash_equals($expectedSignature, $signature);
    }
    
    /**
     * Validasi IP whitelist untuk webhook
     * 
     * @param string $ipAddress IP address yang akan divalidasi
     * @param array $whitelist Daftar IP yang diizinkan
     * @return bool
     */
    public function isIpWhitelisted(string $ipAddress, array $whitelist): bool
    {
        if (empty($whitelist)) {
            // Jika whitelist kosong, izinkan semua (untuk development)
            return true;
        }
        
        return in_array($ipAddress, $whitelist, true);
    }
    
    /**
     * Sanitize webhook payload
     * 
     * @param array $data Data payload
     * @return array
     */
    public function sanitizePayload(array $data): array
    {
        // Hapus field yang tidak diperlukan
        $allowedFields = [
            'instance',
            'data',
            'event',
            'phone',
            'message',
            'type',
            'timestamp'
        ];
        
        $sanitized = [];
        foreach ($data as $key => $value) {
            if (in_array($key, $allowedFields, true)) {
                $sanitized[$key] = is_array($value) ? $this->sanitizePayload($value) : $value;
            }
        }
        
        return $sanitized;
    }
    
    /**
     * Log webhook attempt untuk audit trail
     * 
     * @param string $event Tipe event
     * @param string $ipAddress IP address pengirim
     * @param bool $success Status verifikasi
     * @param string $message Pesan tambahan
     * @return void
     */
    public function logWebhookAttempt(string $event, string $ipAddress, bool $success, string $message = ''): void
    {
        $logData = [
            'timestamp' => date('Y-m-d H:i:s'),
            'event' => $event,
            'ip_address' => $ipAddress,
            'success' => $success,
            'message' => $message
        ];
        
        // Tulis ke log file
        log_message('info', 'Webhook Attempt: ' . json_encode($logData));
    }
}
