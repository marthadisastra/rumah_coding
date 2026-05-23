<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pricing Plans - Rumah Coding</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        :root { --primary:#0f172a; --bg-light:#f8fafc; --text-dark:#0f172a; --text-muted:#64748b; --border-color:#e2e8f0; --accent:#2563eb; }
        body { font-family:'Inter',sans-serif; background:#ffffff; color:var(--text-dark); }
        .navbar { border-bottom:1px solid var(--border-color); background:rgba(255,255,255,.95); backdrop-filter:blur(8px); padding:1rem 0; }
        .pricing { padding:80px 0 100px; }
        .pricing-card { border:1px solid var(--border-color); border-radius:12px; background:#ffffff; padding:2rem 1.5rem; height:100%; transition:transform .2s; box-shadow:0 4px 6px -1px rgba(0,0,0,.05); }
        .pricing-card:hover { transform:translateY(-5px); box-shadow:0 10px 15px -3px rgba(0,0,0,.1); }
        .pricing-card.popular { border:2px solid var(--accent); position:relative; }
        .popular-badge { position:absolute; top:-12px; left:50%; transform:translateX(-50%); background:var(--accent); color:#fff; padding:4px 12px; border-radius:20px; font-size:.75rem; font-weight:700; text-transform:uppercase; letter-spacing:.05em; }
        .price { font-size:2.25rem; font-weight:800; letter-spacing:-.04em; margin-bottom:.5rem; }
        .price span { font-size:.9rem; font-weight:500; opacity:.6; }
        .pricing-features { list-style:none; padding:0; margin:1.5rem 0; text-align:left; }
        .pricing-features li { display:flex; align-items:flex-start; margin-bottom:.8rem; font-size:.85rem; }
        .pricing-features li i { margin-right:.6rem; font-size:1rem; }
        .footer { padding:40px 0; border-top:1px solid var(--border-color); background:#f8fafc; }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg sticky-top">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center fw-bold" href="/" style="color:var(--primary);text-decoration:none;">
                <img src="<?= base_url('assets/images/logo.png') ?>" alt="Rumah Coding" height="32" class="me-2">
                <span class="fs-5" style="letter-spacing:-0.02em;">Rumah Coding</span>
            </a>
            <div class="d-flex gap-2 ms-auto">
                <a href="/login" class="btn btn-outline-dark btn-sm fw-semibold px-3 py-2">Sign In</a>
                <a href="/register" class="btn btn-dark btn-sm fw-semibold px-3 py-2">Get Started</a>
            </div>
        </div>
    </nav>

    <div class="container mt-4">
        <a href="/" class="text-decoration-none text-muted" style="font-size:.85rem;"><i class="bi bi-arrow-left"></i> Back to Home</a>
    </div>

    <section class="pricing">
        <div class="container">
            <h2 class="text-center fw-bold mb-2" style="font-size:2.5rem;letter-spacing:-.02em;">Paket Berlangganan</h2>
            <p class="text-center text-muted mb-5" style="font-size:1.1rem;max-width:600px;margin:0 auto 2rem;">
                Pilih paket integrasi WhatsApp yang sejalan dengan kebutuhan bisnis Anda.
            </p>

            <div class="row g-4 justify-content-center">
                <?php foreach ($packages as $pkg): ?>
                <?php
                    $isDark         = (bool) $pkg['is_dark_card'];
                    $isPopular      = (bool) $pkg['is_recommended'];
                    $priceFormatted = ($pkg['price'] === 0) ? 'Rp 0' : 'Rp ' . number_format($pkg['price'] / 1000, 0) . 'k';
                    $cardClass      = 'pricing-card text-center' . ($isPopular ? ' popular' : '');
                    $cardStyle      = $isDark ? 'style="background-color:var(--primary);border:none;"' : '';
                ?>
                <div class="col-lg-3 col-md-6">
                    <div class="<?= $cardClass ?>" <?= $cardStyle ?>>
                        <?php if ($isPopular): ?><div class="popular-badge">RECOMMENDED</div><?php endif; ?>
                        <h3 class="fs-6 fw-bold mb-2"
                            style="letter-spacing:.05em;<?= $isDark ? 'color:#94a3b8;' : ($isPopular ? 'color:var(--accent);' : 'color:var(--text-muted);') ?>">
                            <?= strtoupper(esc($pkg['name'])) ?>
                        </h3>
                        <div class="price <?= $isDark ? 'text-white' : 'text-dark' ?>">
                            <?= $priceFormatted ?><span>/bln</span>
                        </div>
                        <hr <?= $isDark ? 'style="border-color:#334155;margin-top:1rem;margin-bottom:1rem;"' : 'class="border-secondary-subtle my-3"' ?>>
                        <ul class="pricing-features <?= $isDark ? 'text-white' : 'text-dark' ?>">
                            <?php foreach ($pkg['features'] as $feat): ?>
                            <li>
                                <?php if ($isDark): ?>
                                    <i class="bi bi-rocket-takeoff-fill text-warning me-2"></i>
                                <?php elseif ($isPopular): ?>
                                    <i class="bi bi-check2-all" style="color:var(--accent)"></i>&nbsp;
                                <?php else: ?>
                                    <i class="bi bi-check2 text-muted"></i>&nbsp;
                                <?php endif; ?>
                                <?= esc($feat) ?>
                            </li>
                            <?php endforeach; ?>
                        </ul>
                        <?php if ($isDark): ?>
                            <a href="mailto:sales@rumahcoding.com" class="btn btn-light w-100 fw-bold mt-2">Contact Sales</a>
                        <?php elseif ($isPopular): ?>
                            <a href="/register" class="btn btn-primary w-100 fw-bold mt-2" style="background-color:var(--accent);border-color:var(--accent);">Upgrade to <?= esc($pkg['name']) ?></a>
                        <?php elseif ($pkg['price'] === 0): ?>
                            <a href="/register" class="btn btn-outline-primary w-100 fw-bold mt-2">Start Free</a>
                        <?php else: ?>
                            <a href="/register" class="btn btn-outline-primary w-100 fw-bold mt-2">Subscribe <?= esc($pkg['name']) ?></a>
                        <?php endif; ?>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <footer class="footer">
        <div class="container text-center text-muted" style="font-size:.85rem;">
            &copy; <?= date('Y') ?> Rumah Coding. All rights reserved.
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
