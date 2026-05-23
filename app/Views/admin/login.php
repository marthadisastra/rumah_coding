<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Admin Login - RumahCoding</title>
    <link rel="stylesheet" href="/assets/star_full/dist/assets/vendors/feather/feather.css">
    <link rel="stylesheet" href="/assets/star_full/dist/assets/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="/assets/star_full/dist/assets/vendors/ti-icons/css/themify-icons.css">
    <link rel="stylesheet" href="/assets/star_full/dist/assets/vendors/simple-line-icons/css/simple-line-icons.css">
    <link rel="stylesheet" href="/assets/star_full/dist/assets/vendors/typicons/typicons.css">
    <link rel="stylesheet" href="/assets/star_full/dist/assets/vendors/css/vendor.bundle.base.css">
    <link rel="stylesheet" href="/assets/star_full/dist/assets/css/style.css">
    <link rel="shortcut icon" href="/assets/star_full/dist/assets/images/favicon.png">
    <style>
        body {
            background:
                radial-gradient(circle at top left, rgba(53, 112, 255, 0.18), transparent 22%),
                linear-gradient(135deg, #eef3fb 0%, #f7f9fd 48%, #eef3fb 100%);
        }

        .auth-shell {
            min-height: 100vh;
        }

        .auth-form-light {
            border-radius: 28px;
            border: 1px solid rgba(17, 32, 59, 0.08);
            box-shadow: 0 24px 60px rgba(17, 32, 59, 0.12);
        }

        .auth-brand-mark {
            display: inline-flex;
            align-items: center;
            gap: 0.85rem;
            margin-bottom: 1.25rem;
        }

        .auth-brand-mark img {
            width: 48px;
            height: 48px;
        }

        .auth-brand-copy h4 {
            margin-bottom: 0.2rem;
            font-size: 1.35rem;
        }

        .auth-brand-copy p {
            margin-bottom: 0;
            color: #6d7b95;
            font-size: 0.92rem;
        }

        .auth-side-note {
            background: linear-gradient(135deg, #10203c 0%, #1f3e6c 100%);
            color: #fff;
            border-radius: 28px;
            padding: 2rem;
            min-height: 100%;
            box-shadow: 0 24px 60px rgba(17, 32, 59, 0.16);
        }

        .auth-side-note .badge {
            background: rgba(255,255,255,0.12);
            color: #fff;
            border: 1px solid rgba(255,255,255,0.14);
        }

        .auth-side-note p {
            color: rgba(255,255,255,0.76);
        }

        @media (max-width: 991.98px) {
            .auth-side-note {
                margin-top: 1rem;
            }
        }
    </style>
</head>
<body>
<div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
        <div class="content-wrapper d-flex align-items-center auth auth-shell px-3 px-sm-4">
            <div class="row w-100 mx-0 justify-content-center">
                <div class="col-12 col-xl-10">
                    <div class="row g-4 align-items-stretch">
                        <div class="col-lg-6">
                            <div class="auth-form-light text-left py-5 px-4 px-sm-5 h-100">
                                <div class="auth-brand-mark">
                                    <img src="/assets/star_full/dist/assets/images/logo-mini.svg" alt="RumahCoding">
                                    <div class="auth-brand-copy">
                                        <h4>RumahCoding Admin</h4>
                                        <p>Masuk untuk mengelola CMS, pricing, portfolio, dan operasi tenant.</p>
                                    </div>
                                </div>

                                <?php if (session()->getFlashdata('error')) : ?>
                                    <div class="alert alert-danger py-2"><?= esc(session()->getFlashdata('error')) ?></div>
                                <?php endif ?>

                                <form class="pt-2" action="" method="post">
                                    <?= csrf_field() ?>
                                    <div class="form-group">
                                        <label class="form-label">Email admin</label>
                                        <input type="email" name="email" class="form-control form-control-lg" placeholder="admin@rumahcoding.id" value="<?= esc(old('email')) ?>" required>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Password</label>
                                        <input type="password" name="password" class="form-control form-control-lg" placeholder="Masukkan password" required>
                                    </div>
                                    <div class="mt-4 d-grid gap-2">
                                        <button class="btn btn-primary btn-lg fw-medium auth-form-btn" type="submit">Masuk ke Admin Panel</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="auth-side-note">
                                <span class="badge mb-3">Owner Operations Workspace</span>
                                <h3 class="mb-3 text-white">Satu panel untuk mengarahkan bisnis, konten, dan tenant operations.</h3>
                                <p class="mb-4">Gunakan panel ini untuk memantau halaman CMS, katalog pricing, showcase portfolio, kesehatan WA instance, serta stabilitas message queue dalam satu workspace yang konsisten.</p>
                                <div class="row g-3">
                                    <div class="col-sm-6">
                                        <div class="bg-white bg-opacity-10 rounded-4 p-3 h-100">
                                            <div class="fw-semibold text-white mb-1">Management Page</div>
                                            <div class="small">Kontrol konten utama dan halaman legal.</div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="bg-white bg-opacity-10 rounded-4 p-3 h-100">
                                            <div class="fw-semibold text-white mb-1">Management Pricing</div>
                                            <div class="small">Atur paket, limits, dan posisi monetisasi.</div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="bg-white bg-opacity-10 rounded-4 p-3 h-100">
                                            <div class="fw-semibold text-white mb-1">Portfolio Management</div>
                                            <div class="small">Kelola showcase proyek tenant untuk presales.</div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="bg-white bg-opacity-10 rounded-4 p-3 h-100">
                                            <div class="fw-semibold text-white mb-1">Tenant Operations</div>
                                            <div class="small">Pantau instance, contacts, queue, dan performance.</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="/assets/star_full/dist/assets/vendors/js/vendor.bundle.base.js"></script>
<script src="/assets/star_full/dist/assets/js/off-canvas.js"></script>
<script src="/assets/star_full/dist/assets/js/template.js"></script>
<script src="/assets/star_full/dist/assets/js/settings.js"></script>
<script src="/assets/star_full/dist/assets/js/hoverable-collapse.js"></script>
</body>
</html>
