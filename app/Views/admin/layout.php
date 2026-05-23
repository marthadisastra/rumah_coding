<?php
/** @var array $flash */
$uri = service('uri');
$path = trim($uri->getPath(), '/');
$shellMetrics = $shellMetrics ?? ['counts' => []];
$countMap = $shellMetrics['counts'] ?? [];

$navGroups = [
    [
        'title' => 'Executive',
        'id' => 'nav-executive',
        'icon' => 'mdi-view-dashboard-outline',
        'items' => [
            [
                'label' => 'Executive Dashboard',
                'href' => site_url('/admin'),
                'match' => ['admin'],
                'icon' => 'typcn-chart-area-outline',
                'badge' => (string) ($shellMetrics['activeTenants'] ?? 0),
            ],
            [
                'label' => 'Tenant Performance',
                'href' => site_url('/admin/performance'),
                'match' => ['admin/performance'],
                'icon' => 'typcn-chart-line-outline',
                'badge' => (string) ($shellMetrics['openInstances'] ?? 0),
            ],
        ],
    ],
    [
        'title' => 'Content & Revenue',
        'id' => 'nav-content',
        'icon' => 'mdi-folder-outline',
        'items' => [
            [
                'label' => 'Management Page',
                'href' => site_url('/admin/content'),
                'match' => ['admin/content'],
                'icon' => 'typcn-document-text',
                'badge' => (string) ($countMap['content'] ?? 0),
            ],
            [
                'label' => 'Management Pricing',
                'href' => site_url('/admin/pricing'),
                'match' => ['admin/pricing'],
                'icon' => 'typcn-credit-card',
                'badge' => (string) ($countMap['packages'] ?? 0),
            ],
            [
                'label' => 'Management Portfolio',
                'href' => site_url('/admin/portfolio'),
                'match' => ['admin/portfolio'],
                'icon' => 'typcn-briefcase',
                'badge' => (string) ($countMap['portfolios'] ?? 0),
            ],
        ],
    ],
    [
        'title' => 'Tenant Ops',
        'id' => 'nav-tenant-ops',
        'icon' => 'mdi-account-cog-outline',
        'items' => [
            [
                'label' => 'Tenant Overview',
                'href' => site_url('/admin/tenants'),
                'match' => ['admin/tenants'],
                'icon' => 'typcn-group',
                'badge' => (string) ($countMap['tenants'] ?? 0),
            ],
            [
                'label' => 'Tenant Instances',
                'href' => site_url('/admin/instances'),
                'match' => ['admin/instances'],
                'icon' => 'typcn-wi-fi',
                'badge' => (string) ($countMap['instances'] ?? 0),
            ],
            [
                'label' => 'Tenant Contacts',
                'href' => site_url('/admin/contacts'),
                'match' => ['admin/contacts'],
                'icon' => 'typcn-contacts',
                'badge' => (string) ($countMap['contacts'] ?? 0),
            ],
            [
                'label' => 'Message Queue',
                'href' => site_url('/admin/queues'),
                'match' => ['admin/queues'],
                'icon' => 'typcn-messages',
                'badge' => (string) ($countMap['queues'] ?? 0),
            ],
        ],
    ],
    [
        'title' => 'Governance',
        'id' => 'nav-governance',
        'icon' => 'mdi-shield-account-outline',
        'items' => [
            [
                'label' => 'User Governance',
                'href' => site_url('/admin/users'),
                'match' => ['admin/users'],
                'icon' => 'typcn-user',
                'badge' => (string) ($countMap['users'] ?? 0),
            ],
        ],
    ],
];
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title><?= esc($title ?? 'Admin Panel - RumahCoding') ?></title>
    <link rel="stylesheet" href="/assets/star_full/dist/assets/vendors/feather/feather.css">
    <link rel="stylesheet" href="/assets/star_full/dist/assets/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="/assets/star_full/dist/assets/vendors/typicons/typicons.css">
    <link rel="stylesheet" href="/assets/star_full/dist/assets/vendors/ti-icons/css/themify-icons.css">
    <link rel="stylesheet" href="/assets/star_full/dist/assets/vendors/simple-line-icons/css/simple-line-icons.css">
    <link rel="stylesheet" href="/assets/star_full/dist/assets/vendors/css/vendor.bundle.base.css">
    <link rel="stylesheet" href="/assets/star_full/dist/assets/css/style.css">
    <link rel="shortcut icon" href="/assets/star_full/dist/assets/images/favicon.png">
    <style>
        :root {
            --rc-navy: #11203b;
            --rc-slate: #5f6b85;
            --rc-surface: #f5f7fb;
            --rc-border: #dde5f0;
            --rc-accent: #2f6bff;
            --rc-success: #17a36b;
            --rc-warning: #ffb648;
            --rc-danger: #ff5b5c;
        }

        body {
            background: var(--rc-surface);
        }

        .page-body-wrapper {
            min-height: calc(100vh - 70px);
        }

        .navbar-brand-wrapper {
            background: linear-gradient(180deg, #122340 0%, #182b4d 100%);
        }

        .navbar-brand-wrapper .brand-logo-text {
            color: #fff;
            font-size: 1rem;
            font-weight: 700;
            letter-spacing: .02em;
        }

        .sidebar {
            background:
                radial-gradient(circle at top, rgba(67, 110, 255, 0.28), transparent 24%),
                linear-gradient(180deg, #0e1d35 0%, #142948 52%, #11203b 100%);
            box-shadow: 16px 0 32px rgba(17, 32, 59, 0.12);
        }

        .sidebar .nav {
            padding-top: 1rem;
        }

        .sidebar .nav .nav-item .nav-link {
            color: rgba(255, 255, 255, 0.84);
            border-radius: 14px;
            margin: 0.2rem 0.75rem;
            padding: 0.95rem 1rem;
            transition: all .18s ease;
            white-space: nowrap;
            min-height: 48px;
        }

        .sidebar .nav .nav-item .nav-link .menu-icon {
            color: rgba(255, 255, 255, 0.92);
            font-size: 1.1rem;
        }

        .sidebar .nav .nav-item .nav-link:hover,
        .sidebar .nav .nav-item.active > .nav-link {
            background: linear-gradient(90deg, rgba(66, 109, 255, 0.28), rgba(255, 255, 255, 0.1));
            color: #fff;
            box-shadow: inset 0 0 0 1px rgba(255,255,255,0.06);
        }

        .sidebar .nav .nav-category {
            color: rgba(255, 255, 255, 0.52);
            font-size: 0.72rem;
            text-transform: uppercase;
            letter-spacing: 0.08em;
            padding: 1.35rem 1.5rem 0.65rem;
        }

        .sidebar .nav.sub-menu {
            padding-bottom: 0.25rem;
        }

        .sidebar .nav.sub-menu .nav-item .nav-link {
            margin-left: 1.55rem;
            padding: 0.72rem 1rem 0.72rem 2.3rem;
            color: rgba(255, 255, 255, 0.72);
            position: relative;
            min-height: auto;
        }

        .sidebar .nav.sub-menu .nav-item .nav-link::before {
            content: "";
            position: absolute;
            left: 1.05rem;
            top: 50%;
            width: 0.45rem;
            height: 0.45rem;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.24);
            transform: translateY(-50%);
        }

        .sidebar .nav.sub-menu .nav-item.active > .nav-link::before,
        .sidebar .nav.sub-menu .nav-item .nav-link:hover::before {
            background: #fff;
        }

        .sidebar .nav .nav-item .nav-link[data-bs-toggle="collapse"] .menu-arrow {
            color: rgba(255,255,255,0.7);
        }

        .sidebar .nav .nav-item .collapse.show + .nav-link,
        .sidebar .nav .nav-item.open > .nav-link {
            color: #fff;
        }

        .main-panel .content-wrapper {
            padding-top: 1.75rem;
        }

        .page-shell-header {
            background:
                radial-gradient(circle at 0% 0%, rgba(105, 150, 255, 0.22), transparent 20%),
                radial-gradient(circle at 100% 100%, rgba(47, 107, 255, 0.2), transparent 22%),
                linear-gradient(135deg, #0f213c 0%, #18345e 54%, #22497d 100%);
            color: #fff;
            border-radius: 24px;
            padding: 1.5rem 1.75rem;
            margin-bottom: 1.75rem;
            box-shadow: 0 24px 48px rgba(17, 32, 59, 0.16);
        }

        .page-shell-header .eyebrow {
            display: inline-flex;
            align-items: center;
            gap: 0.45rem;
            border: 1px solid rgba(255, 255, 255, 0.18);
            border-radius: 999px;
            padding: 0.35rem 0.75rem;
            font-size: 0.78rem;
            color: rgba(255, 255, 255, 0.82);
        }

        .page-shell-header h1 {
            color: #fff;
            font-size: 1.75rem;
            margin: 1rem 0 0.4rem;
        }

        .page-shell-header p {
            color: rgba(255, 255, 255, 0.78);
            margin-bottom: 0;
            max-width: 820px;
        }

        .metric-pills {
            display: flex;
            flex-wrap: wrap;
            gap: 0.75rem;
            margin-top: 1rem;
        }

        .metric-pill {
            background: rgba(255, 255, 255, 0.07);
            border: 1px solid rgba(255, 255, 255, 0.14);
            border-radius: 16px;
            padding: 0.8rem 1rem;
            min-width: 140px;
            backdrop-filter: blur(10px);
        }

        .metric-pill-label {
            font-size: 0.72rem;
            text-transform: uppercase;
            letter-spacing: 0.06em;
            color: rgba(255, 255, 255, 0.64);
            margin-bottom: 0.2rem;
        }

        .metric-pill-value {
            font-size: 1.1rem;
            font-weight: 700;
            color: #fff;
        }

        .badge-soft-primary { background: rgba(47, 107, 255, .12); color: var(--rc-accent); }
        .badge-soft-success { background: rgba(23, 163, 107, .12); color: var(--rc-success); }
        .badge-soft-warning { background: rgba(255, 182, 72, .16); color: #a06700; }
        .badge-soft-danger { background: rgba(255, 91, 92, .14); color: #c23434; }
        .badge-soft-info { background: rgba(59, 130, 246, .12); color: #2563eb; }

        .card.card-shell,
        .card.card-shell-table {
            border: 1px solid var(--rc-border);
            border-radius: 22px;
            box-shadow: 0 12px 28px rgba(31, 41, 55, 0.05);
        }

        .card-shell .card-body,
        .card-shell-table .card-body {
            padding: 1.5rem;
        }

        .section-title {
            font-size: 1.05rem;
            font-weight: 700;
            color: #1b2942;
            margin-bottom: 0.2rem;
        }

        .section-copy {
            color: var(--rc-slate);
            font-size: 0.88rem;
            margin-bottom: 0;
        }

        .table thead th {
            border-top: 0;
            font-size: 0.76rem;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            color: #73809a;
        }

        .table td {
            vertical-align: middle;
        }

        .status-dot {
            width: 0.55rem;
            height: 0.55rem;
            border-radius: 50%;
            display: inline-block;
            margin-right: 0.45rem;
        }

        .quick-link-badge {
            min-width: 1.7rem;
            text-align: center;
            background: rgba(255,255,255,0.95) !important;
            border-radius: 999px;
            font-size: 0.72rem;
        }

        .alert-shell {
            border: 0;
            border-radius: 18px;
        }

        .footer {
            background: transparent;
        }

        @media (max-width: 991.98px) {
            .page-shell-header {
                border-radius: 18px;
                padding: 1.25rem;
            }

            .metric-pill {
                min-width: calc(50% - 0.375rem);
            }

            .sidebar .nav .nav-item .nav-link,
            .sidebar .nav.sub-menu .nav-item .nav-link {
                white-space: normal;
            }
        }
    </style>
</head>
<body class="with-welcome-text">
<div class="container-scroller">
    <nav class="navbar default-layout col-lg-12 col-12 p-0 fixed-top d-flex align-items-top flex-row">
        <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-start">
            <div class="me-3">
                <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-bs-toggle="minimize">
                    <span class="icon-menu text-white"></span>
                </button>
            </div>
            <a class="navbar-brand brand-logo d-flex align-items-center" href="<?= site_url('/admin') ?>">
                <img src="/assets/star_full/dist/assets/images/logo-mini.svg" alt="logo">
                <span class="brand-logo-text ms-2">RumahCoding CMS</span>
            </a>
            <a class="navbar-brand brand-logo-mini" href="<?= site_url('/admin') ?>">
                <img src="/assets/star_full/dist/assets/images/logo-mini.svg" alt="logo">
            </a>
        </div>
        <div class="navbar-menu-wrapper d-flex align-items-top">
            <ul class="navbar-nav">
                <li class="nav-item fw-semibold d-none d-lg-block ms-0">
                    <h1 class="welcome-text mb-1">Halo, <span class="text-black fw-bold"><?= esc($adminName ?? 'Admin') ?></span></h1>
                    <h3 class="welcome-sub-text">Panel owner-grade untuk memantau pertumbuhan tenant, operasi delivery, dan kesiapan konten bisnis.</h3>
                </li>
            </ul>
            <ul class="navbar-nav ms-auto">
                <li class="nav-item d-none d-lg-flex align-items-center me-3">
                    <span class="badge badge-opacity-warning px-3 py-2">
                        Pending queue: <?= esc((string) ($shellMetrics['pendingQueues'] ?? 0)) ?>
                    </span>
                </li>
                <li class="nav-item d-none d-lg-flex align-items-center me-3">
                    <span class="badge badge-opacity-success px-3 py-2">
                        Instance online: <?= esc((string) ($shellMetrics['openInstances'] ?? 0)) ?>
                    </span>
                </li>
                <li class="nav-item dropdown d-none d-lg-block user-dropdown">
                    <a class="nav-link" id="UserDropdown" href="#" data-bs-toggle="dropdown" aria-expanded="false">
                        <div class="d-flex align-items-center">
                            <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center" style="width:40px;height:40px;font-weight:700;">
                                <?= esc(strtoupper(substr((string) ($adminName ?? 'A'), 0, 1))) ?>
                            </div>
                        </div>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="UserDropdown">
                        <div class="dropdown-header text-center">
                            <div class="bg-primary text-white rounded-circle d-inline-flex align-items-center justify-content-center mb-2" style="width:56px;height:56px;font-weight:700;font-size:1.1rem;">
                                <?= esc(strtoupper(substr((string) ($adminName ?? 'A'), 0, 1))) ?>
                            </div>
                            <p class="mb-1 mt-1 fw-semibold"><?= esc($adminName ?? 'Admin') ?></p>
                            <p class="fw-light text-muted mb-0">Administrator Panel</p>
                        </div>
                        <a class="dropdown-item" href="<?= site_url('/admin') ?>"><i class="dropdown-item-icon typcn typcn-chart-area-outline text-primary me-2"></i>Dashboard</a>
                        <a class="dropdown-item" href="<?= site_url('/admin/content') ?>"><i class="dropdown-item-icon typcn typcn-document-text text-primary me-2"></i>Content CMS</a>
                        <a class="dropdown-item" href="<?= site_url('/admin/logout') ?>"><i class="dropdown-item-icon typcn typcn-power text-primary me-2"></i>Logout</a>
                    </div>
                </li>
                <li class="nav-item d-lg-none">
                    <button class="navbar-toggler navbar-toggler-right align-self-center" type="button" data-bs-toggle="offcanvas">
                        <span class="mdi mdi-menu"></span>
                    </button>
                </li>
            </ul>
        </div>
    </nav>

    <div class="container-fluid page-body-wrapper">
        <nav class="sidebar sidebar-offcanvas" id="sidebar">
            <ul class="nav">
                <?php foreach ($navGroups as $group): ?>
                    <?php
                    $groupActive = false;
                    foreach ($group['items'] as $item) {
                        foreach ($item['match'] as $match) {
                            if ($path === $match || str_starts_with($path, $match . '/')) {
                                $groupActive = true;
                                break 2;
                            }
                        }
                    }
                    ?>
                    <li class="nav-category"><?= esc($group['title']) ?></li>
                    <li class="nav-item <?= $groupActive ? 'active' : '' ?>">
                        <a class="nav-link" data-bs-toggle="collapse" href="#<?= esc($group['id']) ?>" aria-expanded="<?= $groupActive ? 'true' : 'false' ?>" aria-controls="<?= esc($group['id']) ?>">
                            <i class="menu-icon mdi <?= esc($group['icon']) ?>"></i>
                            <span class="menu-title"><?= esc($group['title']) ?></span>
                            <i class="menu-arrow"></i>
                        </a>
                        <div class="collapse <?= $groupActive ? 'show' : '' ?>" id="<?= esc($group['id']) ?>">
                            <ul class="nav flex-column sub-menu">
                                <?php foreach ($group['items'] as $item): ?>
                                    <?php
                                    $isActive = false;
                                    foreach ($item['match'] as $match) {
                                        if ($path === $match || str_starts_with($path, $match . '/')) {
                                            $isActive = true;
                                            break;
                                        }
                                    }
                                    ?>
                                    <li class="nav-item <?= $isActive ? 'active' : '' ?>">
                                        <a class="nav-link" href="<?= $item['href'] ?>">
                                            <span class="menu-title"><?= esc($item['label']) ?></span>
                                            <span class="badge bg-white text-dark quick-link-badge ms-auto"><?= esc($item['badge']) ?></span>
                                        </a>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    </li>
                <?php endforeach; ?>

                <li class="nav-category">Owner Snapshot</li>
                <li class="nav-item">
                    <div class="px-3 py-2">
                        <div class="card bg-transparent border border-light border-opacity-10 rounded-4">
                            <div class="card-body p-3">
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <span class="text-white-50 small">Business Readiness</span>
                                    <span class="badge badge-opacity-light text-white"><?= esc((string) ($shellMetrics['failedQueues'] ?? 0)) ?> risk</span>
                                </div>
                                <div class="text-white fw-semibold mb-1"><?= esc((string) ($shellMetrics['activeTenants'] ?? 0)) ?> tenant aktif</div>
                                <div class="text-white-50 small">Dipadukan dengan <?= esc((string) ($shellMetrics['openInstances'] ?? 0)) ?> instance online untuk menilai kapasitas delivery hari ini.</div>
                            </div>
                        </div>
                    </div>
                </li>
            </ul>
        </nav>

        <div class="main-panel">
            <div class="content-wrapper">
                <section class="page-shell-header">
                    <div class="eyebrow">
                        <i class="typcn typcn-flash-outline"></i>
                        Owner Intelligence Workspace
                    </div>
                    <h1><?= esc($title ?? 'Admin Panel RumahCoding') ?></h1>
                    <p>Gunakan panel ini untuk membaca performa tenant, stabilitas operasional, kesiapan konten, dan arah paket monetisasi secara menyatu sebelum mengambil keputusan bisnis berikutnya.</p>
                    <div class="metric-pills">
                        <div class="metric-pill">
                            <div class="metric-pill-label">Tenant</div>
                            <div class="metric-pill-value"><?= esc((string) ($countMap['tenants'] ?? 0)) ?></div>
                        </div>
                        <div class="metric-pill">
                            <div class="metric-pill-label">Users</div>
                            <div class="metric-pill-value"><?= esc((string) ($countMap['users'] ?? 0)) ?></div>
                        </div>
                        <div class="metric-pill">
                            <div class="metric-pill-label">WA Instances</div>
                            <div class="metric-pill-value"><?= esc((string) ($countMap['instances'] ?? 0)) ?></div>
                        </div>
                        <div class="metric-pill">
                            <div class="metric-pill-label">CMS Pages</div>
                            <div class="metric-pill-value"><?= esc((string) ($countMap['content'] ?? 0)) ?></div>
                        </div>
                    </div>
                </section>

                <?php if (!empty($flash['success'])): ?>
                    <div class="alert alert-success alert-shell"><?= esc($flash['success']) ?></div>
                <?php endif; ?>
                <?php if (!empty($flash['error'])): ?>
                    <div class="alert alert-danger alert-shell"><?= esc($flash['error']) ?></div>
                <?php endif; ?>

                <?= $this->renderSection('content') ?>
            </div>
            <footer class="footer">
                <div class="d-sm-flex justify-content-center justify-content-sm-between">
                    <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">© RumahCoding Admin Workspace</span>
                    <span class="float-none float-sm-end d-block mt-1 mt-sm-0 text-center text-muted">Built with Star Full layout foundation and business-focused custom modules.</span>
                </div>
            </footer>
        </div>
    </div>
</div>

<script src="/assets/star_full/dist/assets/vendors/js/vendor.bundle.base.js"></script>
<script src="/assets/star_full/dist/assets/js/off-canvas.js"></script>
<script src="/assets/star_full/dist/assets/js/hoverable-collapse.js"></script>
<script src="/assets/star_full/dist/assets/js/template.js"></script>
<script src="/assets/star_full/dist/assets/js/settings.js"></script>
</body>
</html>
