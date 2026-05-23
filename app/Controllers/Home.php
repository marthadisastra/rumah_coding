<?php

namespace App\Controllers;

use App\Models\PricingPackageModel;
use App\Models\SiteContentModel;

class Home extends BaseController
{
    protected PricingPackageModel $pricing;
    protected SiteContentModel    $content;

    public function __construct()
    {
        $this->pricing = new PricingPackageModel();
        $this->content = new SiteContentModel();
    }

    // =====================================================================
    // PUBLIC FRONTEND PAGES
    // =====================================================================

    public function index()
    {
        $packages = $this->pricing->getActive();
        // Decode features JSON for each package
        foreach ($packages as &$pkg) {
            $pkg['features'] = json_decode($pkg['features'] ?? '[]', true);
        }
        return view('landing_page', ['packages' => $packages]);
    }

    public function pricing()
    {
        $packages = $this->pricing->getActive();
        foreach ($packages as &$pkg) {
            $pkg['features'] = json_decode($pkg['features'] ?? '[]', true);
        }
        return view('pricing_page', ['packages' => $packages]);
    }

    public function privacy()
    {
        $page = $this->content->getPage('privacy_policy');
        return view('privacy', ['page' => $page]);
    }

    public function terms()
    {
        $page = $this->content->getPage('terms_of_service');
        return view('terms', ['page' => $page]);
    }

    public function api()
    {
        return view('api_reference');
    }

    public function login()
    {
        return view('login');
    }

    public function register()
    {
        return view('register');
    }

    public function status()
    {
        return view('status_page');
    }

    // =====================================================================
    // TENANT PANEL PREVIEWS (Sementara sebelum Auth dibuat)
    // =====================================================================

    public function dashboard()
    {
        $data['title'] = 'Dashboard Overview';
        return view('\Modules\Core\Views\dashboard', $data);
    }

    public function instances()
    {
        $data['title'] = 'WA Instances';
        return view('\Modules\WaGateway\Views\instances', $data);
    }
}
