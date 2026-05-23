<?php

namespace App\Controllers;

use App\Libraries\AdminPanelService;
use App\Models\AdminUserModel;
use App\Models\PricingPackageModel;
use App\Models\SiteContentModel;

class Admin extends BaseController
{
    protected SiteContentModel $content;
    protected PricingPackageModel $pricing;
    protected AdminUserModel $adminUser;
    protected AdminPanelService $panelService;
    protected $session;

    public function __construct()
    {
        $this->content = new SiteContentModel();
        $this->pricing = new PricingPackageModel();
        $this->adminUser = new AdminUserModel();
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

    public function login()
    {
        if ($this->session->get('is_admin')) {
            return redirect()->to('/admin');
        }

        return view('admin/login');
    }

    public function authenticate()
    {
        if (strtolower($this->request->getMethod()) !== 'post') {
            return redirect()->to('/admin/login');
        }

        $email = trim($this->request->getPost('email'));
        $password = $this->request->getPost('password');

        $admin = $this->adminUser->findActiveByEmail($email);

        if (! empty($admin) && password_verify($password, $admin['password_hash'])) {
            $this->session->set([
                'is_admin' => true,
                'admin_email' => $admin['email'],
                'admin_name' => $admin['name'] ?? 'Admin',
                'admin_id' => $admin['id'],
            ]);

            return redirect()->to('/admin');
        }

        $this->session->setFlashdata('error', 'Email atau password admin salah.');
        return redirect()->to('/admin/login')->withInput();
    }

    public function logout()
    {
        $this->session->destroy();
        return redirect()->to('/admin/login');
    }

    public function index()
    {
        if ($response = $this->requireAdmin()) {
            return $response;
        }

        $pageKeys = ['privacy_policy', 'terms_of_service'];
        $pages = $this->content->whereIn('page_key', $pageKeys)->findAll();

        foreach ($pageKeys as $key) {
            $found = array_filter($pages, fn ($page) => $page['page_key'] === $key);
            if (empty($found)) {
                $pages[] = [
                    'id' => null,
                    'page_key' => $key,
                    'lang' => 'id',
                    'title' => ucfirst(str_replace('_', ' ', $key)),
                    'body' => '',
                ];
            }
        }

        $packages = $this->pricing->orderBy('sort_order', 'ASC')->findAll();
        foreach ($packages as &$package) {
            $package['features_list'] = json_decode($package['features'] ?? '[]', true);
        }

        $dashboardData = $this->panelService->getDashboardData();
        $shellMetrics = $this->panelService->getShellMetrics();

        return view('admin/dashboard', [
            'adminName' => $this->session->get('admin_name'),
            'pages' => $pages,
            'packages' => $packages,
            'dashboardData' => $dashboardData,
            'shellMetrics' => $shellMetrics,
            'flash' => [
                'success' => $this->session->getFlashdata('success'),
                'error' => $this->session->getFlashdata('error'),
            ],
            'title' => 'Executive Dashboard',
        ]);
    }

    public function saveContent()
    {
        if ($response = $this->requireAdmin()) {
            return $response;
        }

        if ($this->request->getMethod() !== 'post') {
            return redirect()->to('/admin');
        }

        $pageKey = $this->request->getPost('page_key');
        $title = trim($this->request->getPost('title'));
        $body = trim($this->request->getPost('body'));

        $existing = $this->content->where('page_key', $pageKey)->first();
        $data = [
            'page_key' => $pageKey,
            'lang' => 'id',
            'title' => $title,
            'body' => $body,
            'updated_at' => date('Y-m-d H:i:s'),
        ];

        if ($existing) {
            $this->content->update($existing['id'], $data);
        } else {
            $data['effective_date'] = date('Y-m-d');
            $this->content->insert($data);
        }

        $this->session->setFlashdata('success', 'Konten halaman berhasil disimpan.');
        return redirect()->to('/admin#content');
    }

    public function savePackage()
    {
        if ($response = $this->requireAdmin()) {
            return $response;
        }

        if ($this->request->getMethod() !== 'post') {
            return redirect()->to('/admin');
        }

        $packageId = (int) $this->request->getPost('id');
        $featuresInput = $this->request->getPost('features') ?? '';
        $features = array_filter(array_map('trim', explode(',', $featuresInput)));

        $packageData = [
            'name' => trim($this->request->getPost('name')),
            'price' => trim($this->request->getPost('price')),
            'max_instances' => (int) $this->request->getPost('max_instances'),
            'max_messages' => (int) $this->request->getPost('max_messages'),
            'max_portfolios' => (int) $this->request->getPost('max_portfolios'),
            'features' => json_encode(array_values($features)),
            'is_recommended' => $this->request->getPost('is_recommended') ? 1 : 0,
            'is_dark_card' => $this->request->getPost('is_dark_card') ? 1 : 0,
            'sort_order' => (int) $this->request->getPost('sort_order'),
            'is_active' => $this->request->getPost('is_active') ? 1 : 0,
        ];

        if ($packageId > 0) {
            $this->pricing->update($packageId, $packageData);
            $message = 'Paket pricing berhasil diperbarui.';
        } else {
            $this->pricing->insert($packageData);
            $message = 'Paket pricing baru berhasil ditambahkan.';
        }

        $this->session->setFlashdata('success', $message);
        return redirect()->to('/admin#pricing');
    }

    public function users()
    {
        if ($response = $this->requireAdmin()) {
            return $response;
        }

        $usersData = $this->panelService->getUsersData();
        $shellMetrics = $this->panelService->getShellMetrics();

        return view('admin/users', [
            'adminName' => $this->session->get('admin_name'),
            'users' => $usersData['users'],
            'summary' => $usersData['summary'],
            'roleCounts' => $usersData['roleCounts'],
            'shellMetrics' => $shellMetrics,
            'flash' => [
                'success' => $this->session->getFlashdata('success'),
                'error' => $this->session->getFlashdata('error'),
            ],
            'title' => 'User Governance',
        ]);
    }

    public function tenants()
    {
        if ($response = $this->requireAdmin()) {
            return $response;
        }

        $tenantsData = $this->panelService->getTenantsData();
        $shellMetrics = $this->panelService->getShellMetrics();

        return view('admin/tenants', [
            'adminName' => $this->session->get('admin_name'),
            'tenants' => $tenantsData['tenants'],
            'summary' => $tenantsData['summary'],
            'shellMetrics' => $shellMetrics,
            'flash' => [
                'success' => $this->session->getFlashdata('success'),
                'error' => $this->session->getFlashdata('error'),
            ],
            'title' => 'Tenant Operations',
        ]);
    }

    public function pricing()
    {
        if ($response = $this->requireAdmin()) {
            return $response;
        }

        $pricingData = $this->panelService->getPricingData();

        return view('admin/pricing', [
            'adminName' => $this->session->get('admin_name'),
            'summary' => $pricingData['summary'],
            'insights' => $pricingData['insights'],
            'packages' => $pricingData['packages'],
            'shellMetrics' => $this->panelService->getShellMetrics(),
            'flash' => [
                'success' => $this->session->getFlashdata('success'),
                'error' => $this->session->getFlashdata('error'),
            ],
            'title' => 'Management Pricing',
        ]);
    }

    public function instances()
    {
        if ($response = $this->requireAdmin()) {
            return $response;
        }

        $instanceData = $this->panelService->getInstancesData();

        return view('admin/instances', [
            'adminName' => $this->session->get('admin_name'),
            'summary' => $instanceData['summary'],
            'instances' => $instanceData['instances'],
            'shellMetrics' => $this->panelService->getShellMetrics(),
            'flash' => [
                'success' => $this->session->getFlashdata('success'),
                'error' => $this->session->getFlashdata('error'),
            ],
            'title' => 'Tenant Instances',
        ]);
    }

    public function contacts()
    {
        if ($response = $this->requireAdmin()) {
            return $response;
        }

        $contactData = $this->panelService->getContactsData();

        return view('admin/contacts', [
            'adminName' => $this->session->get('admin_name'),
            'summary' => $contactData['summary'],
            'contacts' => $contactData['contacts'],
            'shellMetrics' => $this->panelService->getShellMetrics(),
            'flash' => [
                'success' => $this->session->getFlashdata('success'),
                'error' => $this->session->getFlashdata('error'),
            ],
            'title' => 'Tenant Contacts',
        ]);
    }

    public function queues()
    {
        if ($response = $this->requireAdmin()) {
            return $response;
        }

        $queueData = $this->panelService->getQueuesData();

        return view('admin/queues', [
            'adminName' => $this->session->get('admin_name'),
            'summary' => $queueData['summary'],
            'queues' => $queueData['queues'],
            'shellMetrics' => $this->panelService->getShellMetrics(),
            'flash' => [
                'success' => $this->session->getFlashdata('success'),
                'error' => $this->session->getFlashdata('error'),
            ],
            'title' => 'Message Queue',
        ]);
    }

    public function performance()
    {
        if ($response = $this->requireAdmin()) {
            return $response;
        }

        $performanceData = $this->panelService->getPerformanceData();

        return view('admin/performance', [
            'adminName' => $this->session->get('admin_name'),
            'summary' => $performanceData['summary'],
            'topTenants' => $performanceData['topTenants'],
            'shellMetrics' => $this->panelService->getShellMetrics(),
            'flash' => [
                'success' => $this->session->getFlashdata('success'),
                'error' => $this->session->getFlashdata('error'),
            ],
            'title' => 'Tenant Performance',
        ]);
    }
}
