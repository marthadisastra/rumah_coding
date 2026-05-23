<?php
namespace App\Controllers;

use App\Libraries\AdminPanelService;
use App\Models\SiteContentModel;

class AdminContent extends BaseController
{
    protected SiteContentModel $content;
    protected AdminPanelService $panelService;
    protected $session;

    public function __construct()
    {
        $this->content = new SiteContentModel();
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

        $contentData = $this->panelService->getContentData();

        return view('admin/content/index', [
            'pages' => $contentData['pages'],
            'summary' => $contentData['summary'],
            'adminName' => $this->session->get('admin_name'),
            'shellMetrics' => $this->panelService->getShellMetrics(),
            'flash' => [
                'success' => $this->session->getFlashdata('success'),
                'error' => $this->session->getFlashdata('error'),
            ],
            'title' => 'Content Control Center',
        ]);
    }

    public function create()
    {
        if ($response = $this->requireAdmin()) {
            return $response;
        }

        $page = [
            'id' => null,
            'page_key' => '',
            'lang' => 'id',
            'title' => '',
            'body' => '',
        ];

        return view('admin/content/form', [
            'page' => $page,
            'action' => 'store',
            'adminName' => $this->session->get('admin_name'),
            'shellMetrics' => $this->panelService->getShellMetrics(),
            'flash' => [
                'success' => $this->session->getFlashdata('success'),
                'error' => $this->session->getFlashdata('error'),
            ],
            'title' => 'Create Content',
        ]);
    }

    public function store()
    {
        if ($response = $this->requireAdmin()) {
            return $response;
        }

        if ($this->request->getMethod() !== 'post') {
            return redirect()->to('/admin/content');
        }

        $data = [
            'page_key' => trim($this->request->getPost('page_key')),
            'lang' => $this->request->getPost('lang') ?? 'id',
            'title' => trim($this->request->getPost('title')),
            'body' => $this->request->getPost('body'),
            'effective_date' => date('Y-m-d'),
            'updated_at' => date('Y-m-d H:i:s'),
        ];

        $this->content->insert($data);

        $this->session->setFlashdata('success', 'Konten berhasil dibuat.');
        return redirect()->to('/admin/content');
    }

    public function edit($id = null)
    {
        if ($response = $this->requireAdmin()) {
            return $response;
        }

        $page = $this->content->find((int) $id);
        if (! $page) {
            $this->session->setFlashdata('error', 'Konten tidak ditemukan.');
            return redirect()->to('/admin/content');
        }

        return view('admin/content/form', [
            'page' => $page,
            'action' => 'update/' . $page['id'],
            'adminName' => $this->session->get('admin_name'),
            'shellMetrics' => $this->panelService->getShellMetrics(),
            'flash' => [
                'success' => $this->session->getFlashdata('success'),
                'error' => $this->session->getFlashdata('error'),
            ],
            'title' => 'Edit Content',
        ]);
    }

    public function update($id = null)
    {
        if ($response = $this->requireAdmin()) {
            return $response;
        }

        if ($this->request->getMethod() !== 'post') {
            return redirect()->to('/admin/content');
        }

        $page = $this->content->find((int) $id);
        if (! $page) {
            $this->session->setFlashdata('error', 'Konten tidak ditemukan.');
            return redirect()->to('/admin/content');
        }

        $data = [
            'page_key' => trim($this->request->getPost('page_key')),
            'lang' => $this->request->getPost('lang') ?? $page['lang'],
            'title' => trim($this->request->getPost('title')),
            'body' => $this->request->getPost('body'),
            'updated_at' => date('Y-m-d H:i:s'),
        ];

        $this->content->update($page['id'], $data);

        $this->session->setFlashdata('success', 'Konten berhasil diperbarui.');
        return redirect()->to('/admin/content');
    }

    public function delete($id = null)
    {
        if ($response = $this->requireAdmin()) {
            return $response;
        }

        $page = $this->content->find((int) $id);
        if (! $page) {
            $this->session->setFlashdata('error', 'Konten tidak ditemukan.');
            return redirect()->to('/admin/content');
        }

        $this->content->delete($page['id']);
        $this->session->setFlashdata('success', 'Konten berhasil dihapus.');
        return redirect()->to('/admin/content');
    }
}
