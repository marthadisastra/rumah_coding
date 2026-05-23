<?php

use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */
$routes->get('/', 'Home::index'); // Mengarah ke Landing Page (Frontend B2B)
$routes->get('login', 'Home::login');
$routes->get('register', 'Home::register');
$routes->get('privacy-policy', 'Home::privacy');
$routes->get('terms-of-service', 'Home::terms');
$routes->get('api-reference', 'Home::api');
$routes->get('pricing', 'Home::pricing');
$routes->get('status', 'Home::status');

// Admin panel routes
$routes->get('admin/login', 'Admin::login');
$routes->post('admin/login', 'Admin::authenticate');
$routes->get('admin/logout', 'Admin::logout');
$routes->get('admin', 'Admin::index');
$routes->post('admin/save-content', 'Admin::saveContent');
$routes->post('admin/save-package', 'Admin::savePackage');

// Content CRUD for admin
$routes->get('admin/content', 'AdminContent::index');
$routes->get('admin/content/create', 'AdminContent::create');
$routes->post('admin/content/store', 'AdminContent::store');
$routes->get('admin/content/edit/(:num)', 'AdminContent::edit/$1');
$routes->post('admin/content/update/(:num)', 'AdminContent::update/$1');
$routes->get('admin/content/delete/(:num)', 'AdminContent::delete/$1');

// Users & Tenants admin pages (placeholders)
$routes->get('admin/users', 'Admin::users');
$routes->get('admin/tenants', 'Admin::tenants');
$routes->get('admin/pricing', 'Admin::pricing');
$routes->get('admin/instances', 'Admin::instances');
$routes->get('admin/contacts', 'Admin::contacts');
$routes->get('admin/queues', 'Admin::queues');
$routes->get('admin/performance', 'Admin::performance');

// Portfolio admin
$routes->get('admin/portfolio', 'AdminPortfolio::index');
$routes->get('admin/portfolio/create', 'AdminPortfolio::create');
$routes->post('admin/portfolio/store', 'AdminPortfolio::store');
$routes->get('admin/portfolio/edit/(:num)', 'AdminPortfolio::edit/$1');
$routes->post('admin/portfolio/update/(:num)', 'AdminPortfolio::update/$1');
$routes->get('admin/portfolio/delete/(:num)', 'AdminPortfolio::delete/$1');

// Rute untuk melihat panel Tenant & Admin (Tahap Selanjutnya) yang sudah dibuat UI-nya.
// Silakan buka URL: http://localhost:8080/dashboard atau http://localhost:8080/instances
$routes->get('dashboard', 'Home::dashboard');
$routes->get('instances', 'Home::instances');

// --- ROUTES PORTFOLIO SAAS ---
// Biar auto-render tanpa parameter URL, arahkan default /p ke dummy 'demo' tenant
$routes->get('p', '\Modules\Portfolio\Controllers\Portfolio::index/demo');
$routes->get('p/(:segment)/(:segment)', '\Modules\Portfolio\Controllers\Portfolio::detail/$1/$2');
$routes->get('p/(:segment)', '\Modules\Portfolio\Controllers\Portfolio::index/$1');
