<?php

namespace App\Controllers;

use App\Models\UserModel;

class AdminUsers extends BaseController
{
    protected UserModel $users;
    protected $session;

    public function __construct()
    {
        $this->users = new UserModel();
        $this->session = service('session');
    }

    private function requireAdmin()
    {
        if (! $this->session->get('is_admin')) {
            return redirect()->to('/admin/login');
        }

        return null;
    }

    public function index()
    {
        if ($response = $this->requireAdmin()) return $response;

        $list = $this->users->orderBy('id', 'DESC')->findAll();

        return view('admin/users/index', [
            'users' => $list,
            'adminName' => $this->session->get('admin_name'),
            'flash' => [
                'success' => $this->session->getFlashdata('success'),
                'error' => $this->session->getFlashdata('error'),
            ],
            'title' => 'Users',
        ]);
    }

    public function create()
    {
        if ($response = $this->requireAdmin()) return $response;

        $user = ['id' => null, 'email' => '', 'name' => '', 'role' => 'user', 'is_active' => 1];

        return view('admin/users/form', [
            'user' => $user,
            'action' => 'store',
            'adminName' => $this->session->get('admin_name'),
            'flash' => ['success' => null, 'error' => null],
            'title' => 'Create User',
        ]);
    }

    public function store()
    {
        if ($response = $this->requireAdmin()) return $response;

        if ($this->request->getMethod() !== 'post') return redirect()->to('/admin/users');

        $email = trim($this->request->getPost('email'));
        $name = trim($this->request->getPost('name'));
        $role = $this->request->getPost('role') ?? 'user';
        $password = $this->request->getPost('password');

        $data = [
            'email' => $email,
            'name' => $name,
            'role' => $role,
            'is_active' => $this->request->getPost('is_active') ? 1 : 0,
        ];

        if (! empty($password)) {
            $data['password_hash'] = password_hash($password, PASSWORD_DEFAULT);
        }

        $this->users->insert($data);
        $this->session->setFlashdata('success', 'User berhasil dibuat.');
        return redirect()->to('/admin/users');
    }

    public function edit($id = null)
    {
        if ($response = $this->requireAdmin()) return $response;

        $u = $this->users->find((int)$id);
        if (! $u) {
            $this->session->setFlashdata('error', 'User tidak ditemukan.');
            return redirect()->to('/admin/users');
        }

        return view('admin/users/form', [
            'user' => $u,
            'action' => 'update/' . $u['id'],
            'adminName' => $this->session->get('admin_name'),
            'flash' => ['success' => null, 'error' => null],
            'title' => 'Edit User',
        ]);
    }

    public function update($id = null)
    {
        if ($response = $this->requireAdmin()) return $response;
        if ($this->request->getMethod() !== 'post') return redirect()->to('/admin/users');

        $u = $this->users->find((int)$id);
        if (! $u) {
            $this->session->setFlashdata('error', 'User tidak ditemukan.');
            return redirect()->to('/admin/users');
        }

        $data = [
            'email' => trim($this->request->getPost('email')),
            'name' => trim($this->request->getPost('name')),
            'role' => $this->request->getPost('role') ?? $u['role'],
            'is_active' => $this->request->getPost('is_active') ? 1 : 0,
        ];

        $password = $this->request->getPost('password');
        if (! empty($password)) {
            $data['password_hash'] = password_hash($password, PASSWORD_DEFAULT);
        }

        $this->users->update($u['id'], $data);
        $this->session->setFlashdata('success', 'User berhasil diperbarui.');
        return redirect()->to('/admin/users');
    }

    public function delete($id = null)
    {
        if ($response = $this->requireAdmin()) return $response;
        $u = $this->users->find((int)$id);
        if (! $u) {
            $this->session->setFlashdata('error', 'User tidak ditemukan.');
            return redirect()->to('/admin/users');
        }

        $this->users->delete($u['id']);
        $this->session->setFlashdata('success', 'User berhasil dihapus.');
        return redirect()->to('/admin/users');
    }
}
