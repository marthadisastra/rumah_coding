<?php

namespace App\Controllers\Tenant;

use App\Controllers\BaseController;
use App\Models\TenantModel;
use App\Models\WaInstanceModel;
use App\Models\MessageQueueModel;

/**
 * Controller untuk autentikasi tenant (user WhatsApp Gateway)
 */
class AuthController extends BaseController
{
    protected TenantModel $tenantModel;
    protected WaInstanceModel $instanceModel;
    
    public function __construct()
    {
        $this->tenantModel = new TenantModel();
        $this->instanceModel = new WaInstanceModel();
    }

    /**
     * Tampilkan form login tenant
     */
    public function login()
    {
        // Jika sudah login, redirect ke dashboard
        if (session()->get('tenant_id')) {
            return redirect()->to('/tenant/dashboard');
        }
        
        return view('tenant/login');
    }

    /**
     * Proses login tenant
     */
    public function doLogin()
    {
        // Validasi input
        $rules = [
            'email' => 'required|valid_email',
            'password' => 'required|min_length[6]'
        ];
        
        if (!$this->validate($rules)) {
            return redirect()->back()
                ->withInput()
                ->with('errors', $this->validator->getErrors());
        }
        
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');
        
        // Verifikasi password dengan hashing
        if (!$this->tenantModel->verifyPassword($email, $password)) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Email atau password salah');
        }
        
        // Ambil data tenant
        $tenant = $this->tenantModel->where('email', $email)->first();
        
        // Cek status tenant
        if ($tenant['status'] !== 'active') {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Akun Anda tidak aktif. Hubungi admin.');
        }
        
        // Set session tenant
        session()->set([
            'tenant_id' => $tenant['id'],
            'tenant_email' => $tenant['email'],
            'tenant_name' => $tenant['owner_name'],
            'logged_in' => true,
            'role' => 'tenant'
        ]);
        
        // Redirect ke dashboard
        return redirect()->to('/tenant/dashboard')
            ->with('success', 'Selamat datang, ' . $tenant['owner_name'] . '!');
    }

    /**
     * Tampilkan form registrasi tenant
     */
    public function register()
    {
        // Jika sudah login, redirect ke dashboard
        if (session()->get('tenant_id')) {
            return redirect()->to('/tenant/dashboard');
        }
        
        return view('tenant/register');
    }

    /**
     * Proses registrasi tenant baru
     */
    public function doRegister()
    {
        // Validasi input
        $rules = [
            'owner_name' => 'required|min_length[3]|max_length[150]',
            'email' => 'required|valid_email|is_unique[tenants.email]',
            'password' => 'required|min_length[8]|regex_match[/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/]',
            'password_confirm' => 'required|matches[password]'
        ];
        
        $messages = [
            'password' => [
                'regex_match' => 'Password harus mengandung minimal 1 huruf besar, 1 huruf kecil, dan 1 angka.'
            ]
        ];
        
        if (!$this->validate($rules, $messages)) {
            return redirect()->back()
                ->withInput()
                ->with('errors', $this->validator->getErrors());
        }
        
        // Simpan tenant baru (password akan di-hash otomatis oleh Model)
        $data = [
            'owner_name' => $this->request->getPost('owner_name'),
            'email' => $this->request->getPost('email'),
            'password' => $this->request->getPost('password'),
            'status' => 'active'
        ];
        
        $tenantId = $this->tenantModel->insert($data);
        
        if (!$tenantId) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Gagal mendaftar. Silakan coba lagi.');
        }
        
        return redirect()->to('/tenant/login')
            ->with('success', 'Registrasi berhasil! Silakan login dengan akun Anda.');
    }

    /**
     * Logout tenant
     */
    public function logout()
    {
        session()->destroy();
        return redirect()->to('/tenant/login')
            ->with('success', 'Anda telah logout.');
    }

    /**
     * Tampilkan form forgot password
     */
    public function forgotPassword()
    {
        return view('tenant/forgot_password');
    }

    /**
     * Proses reset password request
     * TODO: Implement email reset password
     */
    public function doForgotPassword()
    {
        $email = $this->request->getPost('email');
        
        // Cek apakah email terdaftar
        $tenant = $this->tenantModel->where('email', $email)->first();
        
        if (!$tenant) {
            // Tidak memberi tahu apakah email terdaftar atau tidak (security best practice)
            return redirect()->to('/tenant/login')
                ->with('success', 'Jika email terdaftar, Anda akan menerima instruksi reset password.');
        }
        
        // TODO: Generate reset token dan kirim email
        // Untuk saat ini, hanya tampilkan pesan sukses
        return redirect()->to('/tenant/login')
            ->with('success', 'Jika email terdaftar, Anda akan menerima instruksi reset password.');
    }
}
