<?php

namespace App\Controllers;

use App\Libraries\AdminPanelService;
use App\Models\PortfolioModel;
use App\Models\TenantModel;

class AdminPortfolio extends BaseController
{
    protected PortfolioModel $portfolio;
    protected TenantModel $tenant;
    protected AdminPanelService $panelService;
    protected $session;

    public function __construct()
    {
        $this->portfolio = new PortfolioModel();
        $this->tenant = new TenantModel();
        $this->panelService = new AdminPanelService(\Config\Database::connect());
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
        if ($response = $this->requireAdmin()) {
            return $response;
        }

        $data = $this->panelService->getPortfolioData();

        return view('admin/portfolio/index', [
            'adminName' => $this->session->get('admin_name'),
            'summary' => $data['summary'],
            'portfolios' => $data['portfolios'],
            'shellMetrics' => $this->panelService->getShellMetrics(),
            'flash' => [
                'success' => $this->session->getFlashdata('success'),
                'error' => $this->session->getFlashdata('error'),
            ],
            'title' => 'Management Portfolio',
        ]);
    }

    public function create()
    {
        if ($response = $this->requireAdmin()) {
            return $response;
        }

        return view('admin/portfolio/form', [
            'adminName' => $this->session->get('admin_name'),
            'portfolio' => [
                'id' => null,
                'tenant_id' => '',
                'title' => '',
                'slug' => '',
                'description' => '',
                'thumbnail_image' => '',
                'demo_url' => '',
                'tech_stack' => '',
                'is_published' => 1,
            ],
            'tenants' => $this->tenant->orderBy('owner_name', 'ASC')->findAll(),
            'action' => 'store',
            'shellMetrics' => $this->panelService->getShellMetrics(),
            'flash' => [
                'success' => $this->session->getFlashdata('success'),
                'error' => $this->session->getFlashdata('error'),
            ],
            'title' => 'Create Portfolio',
        ]);
    }

    public function store()
    {
        if ($response = $this->requireAdmin()) {
            return $response;
        }

        if ($this->request->getMethod() !== 'post') {
            return redirect()->to('/admin/portfolio');
        }

        $this->portfolio->insert($this->collectPayload());
        $this->session->setFlashdata('success', 'Portfolio berhasil dibuat.');

        return redirect()->to('/admin/portfolio');
    }

    public function edit($id = null)
    {
        if ($response = $this->requireAdmin()) {
            return $response;
        }

        $portfolio = $this->portfolio->find((int) $id);
        if (! $portfolio) {
            $this->session->setFlashdata('error', 'Portfolio tidak ditemukan.');
            return redirect()->to('/admin/portfolio');
        }

        return view('admin/portfolio/form', [
            'adminName' => $this->session->get('admin_name'),
            'portfolio' => $portfolio,
            'tenants' => $this->tenant->orderBy('owner_name', 'ASC')->findAll(),
            'action' => 'update/' . $portfolio['id'],
            'shellMetrics' => $this->panelService->getShellMetrics(),
            'flash' => [
                'success' => $this->session->getFlashdata('success'),
                'error' => $this->session->getFlashdata('error'),
            ],
            'title' => 'Edit Portfolio',
        ]);
    }

    public function update($id = null)
    {
        if ($response = $this->requireAdmin()) {
            return $response;
        }

        if ($this->request->getMethod() !== 'post') {
            return redirect()->to('/admin/portfolio');
        }

        if (! $this->portfolio->find((int) $id)) {
            $this->session->setFlashdata('error', 'Portfolio tidak ditemukan.');
            return redirect()->to('/admin/portfolio');
        }

        $this->portfolio->update((int) $id, $this->collectPayload());
        $this->session->setFlashdata('success', 'Portfolio berhasil diperbarui.');

        return redirect()->to('/admin/portfolio');
    }

    public function delete($id = null)
    {
        if ($response = $this->requireAdmin()) {
            return $response;
        }

        if (! $this->portfolio->find((int) $id)) {
            $this->session->setFlashdata('error', 'Portfolio tidak ditemukan.');
            return redirect()->to('/admin/portfolio');
        }

        $this->portfolio->delete((int) $id);
        $this->session->setFlashdata('success', 'Portfolio berhasil dihapus.');

        return redirect()->to('/admin/portfolio');
    }

    private function collectPayload(): array
    {
        return [
            'tenant_id' => (int) $this->request->getPost('tenant_id'),
            'title' => trim((string) $this->request->getPost('title')),
            'slug' => trim((string) $this->request->getPost('slug')),
            'description' => trim((string) $this->request->getPost('description')),
            'thumbnail_image' => trim((string) $this->request->getPost('thumbnail_image')),
            'demo_url' => trim((string) $this->request->getPost('demo_url')),
            'tech_stack' => trim((string) $this->request->getPost('tech_stack')),
            'is_published' => $this->request->getPost('is_published') ? 1 : 0,
        ];
    }
}
