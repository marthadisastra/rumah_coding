<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'SaaS Dashboard' ?></title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Google Fonts: Inter -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <!-- Custom Enterprise B2B Styling -->
    <style>
        body { font-family: 'Inter', sans-serif; background-color: #f8fafc; color: #1e293b; }
        
        /* Sidebar Styling */
        .sidebar { min-height: 100vh; background-color: #ffffff; border-right: 1px solid #e2e8f0; }
        .sidebar .nav-link { color: #64748b; font-weight: 500; padding: 0.75rem 1rem; border-radius: 0.375rem; margin-bottom: 0.25rem; font-size: 0.95rem; }
        .sidebar .nav-link:hover, .sidebar .nav-link.active { background-color: #f1f5f9; color: #0f172a; }
        .sidebar .nav-link i { width: 24px; display: inline-block; }
        
        /* Topbar Styling */
        .topbar { background-color: #ffffff; border-bottom: 1px solid #e2e8f0; height: 64px; }
        
        /* Card Styling */
        .card { border: 1px solid #e2e8f0; box-shadow: none; border-radius: 0.5rem; background-color: #ffffff; }
        .card-header { background-color: #ffffff; border-bottom: 1px solid #e2e8f0; padding: 1rem 1.25rem; }
        
        /* Button Styling (Utilitarian & Solid) */
        .btn { font-weight: 500; border-radius: 0.375rem; padding: 0.5rem 1rem; }
        .btn-sm { padding: 0.25rem 0.75rem; font-size: 0.875rem; }
        .btn-primary { background-color: #1d4ed8; border-color: #1d4ed8; }
        .btn-primary:hover { background-color: #1e40af; border-color: #1e40af; box-shadow: none; }
        .btn-outline-secondary { border-color: #cbd5e1; color: #475569; }
        .btn-outline-secondary:hover { background-color: #f1f5f9; color: #0f172a; border-color: #94a3b8; }
        .btn-outline-danger:hover { background-color: #fef2f2; color: #ef4444; border-color: #fca5a5; }
        
        /* Stats Cards */
        .stat-value { font-size: 2rem; font-weight: 600; color: #0f172a; letter-spacing: -0.02em; }
        .stat-label { font-size: 0.75rem; font-weight: 600; color: #64748b; text-transform: uppercase; letter-spacing: 0.05em; }
        
        /* Utilities / Typography */
        .text-success { color: #059669 !important; }
        .badge { font-weight: 500; padding: 0.35em 0.65em; border-radius: 0.25rem; }
        .bg-success-subtle { background-color: #d1fae5 !important; color: #065f46 !important; border: 1px solid #a7f3d0; }
        .bg-warning-subtle { background-color: #fef3c7 !important; color: #92400e !important; border: 1px solid #fde68a; }
        .bg-secondary-subtle { background-color: #f1f5f9 !important; color: #475569 !important; border: 1px solid #e2e8f0; }
        
        /* Tables */
        .table > :not(caption) > * > * { padding: 1rem 1.25rem; border-bottom-color: #e2e8f0; }
        .table th { font-weight: 600; color: #64748b; background-color: #f8fafc; font-size: 0.75rem; text-transform: uppercase; letter-spacing: 0.05em; border-bottom-width: 1px; }
    </style>
</head>
<body>
    <div class="d-flex">
        <!-- Sidebar Navigation -->
        <div class="sidebar p-3" style="width: 260px; position: sticky; top: 0;">
            <div class="d-flex align-items-center mb-4 px-2 mt-2">
                <i class="bi bi-layers-half fs-4 text-primary me-2"></i>
                <span class="fs-5 fw-bold text-dark" style="letter-spacing: -0.02em;">SaaS Gateway</span>
            </div>
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link active" href="#"><i class="bi bi-bar-chart-fill"></i> Dashboard</a>
                </li>
                
                <li class="nav-item mt-4 mb-2 px-2">
                    <small class="text-uppercase fw-semibold" style="font-size: 0.7rem; color: #94a3b8; letter-spacing: 0.05em;">Communications</small>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#"><i class="bi bi-hdd-network"></i> WA Instances</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#"><i class="bi bi-people"></i> Contacts</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#"><i class="bi bi-send"></i> Campaigns</a>
                </li>

                <li class="nav-item mt-4 mb-2 px-2">
                    <small class="text-uppercase fw-semibold" style="font-size: 0.7rem; color: #94a3b8; letter-spacing: 0.05em;">Configuration</small>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#"><i class="bi bi-briefcase"></i> Portfolio Settings</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#"><i class="bi bi-credit-card"></i> Billing</a>
                </li>
            </ul>
        </div>

        <!-- Main Content Area -->
        <div class="flex-grow-1" style="min-width: 0;">
            <!-- Topbar -->
            <div class="topbar d-flex align-items-center justify-content-between px-4">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0" style="font-size: 0.875rem;">
                        <li class="breadcrumb-item"><a href="#" class="text-decoration-none text-muted">Workspace</a></li>
                        <li class="breadcrumb-item active fw-medium text-dark" aria-current="page"><?= $title ?? 'Dashboard' ?></li>
                    </ol>
                </nav>
                <div class="d-flex align-items-center gap-3">
                    <button class="btn btn-link text-muted p-0"><i class="bi bi-bell"></i></button>
                    <div class="dropdown">
                        <a href="#" class="d-flex align-items-center text-decoration-none dropdown-toggle text-dark" data-bs-toggle="dropdown" style="font-size: 0.875rem;">
                            <div class="rounded-circle d-flex align-items-center justify-content-center me-2 fw-bold" style="width: 32px; height: 32px; background-color: #e2e8f0; color: #475569; font-size: 0.75rem;">
                                JD
                            </div>
                            <span class="fw-medium">John Doe</span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end shadow-sm border-0 mt-2" style="font-size: 0.875rem;">
                            <li><a class="dropdown-item" href="#">Account Settings</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item text-danger" href="#">Sign out</a></li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Inject Content -->
            <div class="p-4 p-md-5">
                <?= $this->renderSection('content') ?>
            </div>
        </div>
    </div>
    
    <!-- Bootstrap JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
