<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rumah Coding | Enterprise WhatsApp & Portfolio SaaS</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Google Fonts: Inter -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    
    <style>
        :root {
            --primary: #0f172a;
            --primary-hover: #1e293b;
            --bg-light: #f8fafc;
            --text-dark: #0f172a;
            --text-muted: #64748b;
            --border-color: #e2e8f0;
            --accent: #2563eb;
        }
        body { font-family: 'Inter', sans-serif; background-color: #ffffff; color: var(--text-dark); }
        
        /* Navbar */
        .navbar { border-bottom: 1px solid var(--border-color); background-color: rgba(255, 255, 255, 0.95); backdrop-filter: blur(8px); padding: 1rem 0; }
        .navbar-brand { font-weight: 800; font-size: 1.25rem; letter-spacing: -0.02em; color: var(--primary) !important; }
        .nav-link { color: var(--text-muted); font-weight: 500; font-size: 0.95rem; }
        .nav-link:hover { color: var(--text-dark); }
        .btn-outline-primary { border-color: var(--border-color); color: var(--text-dark); font-weight: 600; }
        .btn-outline-primary:hover { background-color: var(--bg-light); border-color: #cbd5e1; color: var(--text-dark); }
        .btn-primary { background-color: var(--primary); border-color: var(--primary); font-weight: 600; padding: 0.5rem 1.25rem; }
        .btn-primary:hover { background-color: var(--primary-hover); border-color: var(--primary-hover); box-shadow: none; }
        
        /* Hero Section */
        .hero { padding: 120px 0 90px; text-align: center; background-color: var(--bg-light); border-bottom: 1px solid var(--border-color); }
        .hero-title { font-size: 3.5rem; font-weight: 800; letter-spacing: -0.04em; line-height: 1.1; margin-bottom: 1.5rem; color: var(--text-dark); }
        .hero-desc { font-size: 1.25rem; color: var(--text-muted); max-width: 700px; margin: 0 auto 2.5rem auto; line-height: 1.6; }
        .hero-image-placeholder { width: 100%; max-width: 900px; height: 420px; background-color: #e2e8f0; border-radius: 12px; margin: 50px auto 0; display: flex; align-items: center; justify-content: center; color: #94a3b8; font-size: 1.5rem; font-weight: 600; border: 1px solid #cbd5e1; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05); }

        /* Features Section */
        .features { padding: 100px 0; }
        .section-title { font-size: 2.25rem; font-weight: 800; text-align: center; margin-bottom: 1rem; letter-spacing: -0.02em; }
        .section-desc { text-align: center; color: var(--text-muted); font-size: 1.125rem; max-width: 600px; margin: 0 auto 4rem auto; }
        .feature-box { padding: 2.5rem; border-radius: 12px; border: 1px solid var(--border-color); background: #ffffff; height: 100%; transition: transform 0.2s, box-shadow 0.2s; box-shadow: none; }
        .feature-box:hover { transform: translateY(-5px); border-color: #cbd5e1; box-shadow: 0 10px 15px -3px rgba(0,0,0,0.05); }
        .feature-icon { width: 48px; height: 48px; background-color: var(--bg-light); border: 1px solid var(--border-color); border-radius: 8px; display: flex; align-items: center; justify-content: center; font-size: 1.5rem; color: var(--text-dark); margin-bottom: 1.5rem; }
        .feature-title { font-size: 1.25rem; font-weight: 700; margin-bottom: 1rem; color: var(--text-dark); }
        .feature-desc { color: var(--text-muted); line-height: 1.6; font-size: 0.95rem; }

        /* Pricing Section */
        .pricing { padding: 80px 0 100px; background-color: var(--bg-light); border-top: 1px solid var(--border-color); }
        .pricing-card { border: 1px solid var(--border-color); border-radius: 12px; background: #ffffff; padding: 2rem 1.5rem; height: 100%; transition: transform 0.2s; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05); }
        .pricing-card:hover { transform: translateY(-5px); box-shadow: 0 10px 15px -3px rgba(0,0,0,0.1); }
        .pricing-card.popular { border: 2px solid var(--accent); position: relative; }
        .popular-badge { position: absolute; top: -12px; left: 50%; transform: translateX(-50%); background-color: var(--accent); color: white; padding: 4px 12px; border-radius: 20px; font-size: 0.75rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.05em; }
        .price { font-size: 2.25rem; font-weight: 800; letter-spacing: -0.04em; margin-bottom: 0.5rem; }
        .price span { font-size: 0.9rem; font-weight: 500; opacity: 0.6; }
        .pricing-features { list-style: none; padding: 0; margin: 1.5rem 0; text-align: left; }
        .pricing-features li { display: flex; align-items: start; margin-bottom: 0.8rem; font-size: 0.85rem; }
        .pricing-features li i { margin-right: 0.6rem; font-size: 1rem; margin-top: -2px; }
        
        /* Footer */
        .footer { padding: 60px 0 40px; border-top: 1px solid var(--border-color); background-color: #ffffff; }
        .footer-brand { font-weight: 800; font-size: 1.25rem; letter-spacing: -0.02em; color: var(--primary); }
        .footer-links a { color: var(--text-muted); text-decoration: none; font-size: 0.9rem; margin-bottom: 0.5rem; display: block; }
        .footer-links a:hover { color: var(--text-dark); text-decoration: underline; }
    </style>
</head>
<body>

    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg sticky-top">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="#">
                <img src="<?= base_url('assets/images/logo.png') ?>" alt="Rumah Coding" height="32" class="me-2">
                <span style="font-size: 1.1rem; letter-spacing:-0.02em;">Rumah Coding</span>
            </a>
            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav mx-auto">
                    <li class="nav-item"><a class="nav-link px-3" href="#features">Features</a></li>
                    <li class="nav-item"><a class="nav-link px-3" href="/api-reference">API Documentation</a></li>
                    <li class="nav-item"><a class="nav-link px-3" href="#pricing">Pricing</a></li>
                </ul>
                <div class="d-flex gap-2">
                    <a href="/login" class="btn btn-outline-primary">Sign In</a>
                    <a href="/register" class="btn btn-primary d-flex align-items-center"><i class="bi bi-box-arrow-in-right me-2"></i> Get Started</a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero">
        <div class="container">
            <h1 class="hero-title">Infrastructure for WhatsApp <br> & Digital Portfolios</h1>
            <p class="hero-desc">Platform B2B kelas enterprise untuk mengintegrasikan WhatsApp Messaging Gateway dan membangun Public Software Portfolio perusahaan Anda dalam satu atap yang terkendali.</p>
            <div class="d-flex gap-3 justify-content-center">
                <a href="#pricing" class="btn btn-primary btn-lg px-4 fs-6">Start for free</a>
                <a href="#api" class="btn btn-outline-primary btn-lg px-4 fs-6">Explore Documentation</a>
            </div>
            
            <div class="hero-image-placeholder" style="background: transparent; border: none; box-shadow: none; height: auto;">
                <img src="<?= base_url('assets/images/hero_mockup.png') ?>" alt="Dashboard Preview" class="img-fluid rounded shadow-lg border" style="max-height: 500px; object-fit: contain;">
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section id="features" class="features container">
        <h2 class="section-title">Built for Performance & Scale</h2>
        <p class="section-desc">Solusi modular yang dikembangkan di CodeIgniter 4. Tanpa beban berat, murni fokus pada presisi logika, kecepatan API, dan skalabilitas bisnis Anda.</p>
        
        <div class="row g-4 mt-3">
            <div class="col-md-4">
                <div class="feature-box">
                    <div class="feature-icon"><i class="bi bi-rocket-takeoff"></i></div>
                    <h3 class="feature-title">High-Throughput Gateway</h3>
                    <p class="feature-desc">Didukung oleh arsitektur Evolution API dari backend Node. Mampu menampung dan mengeksekusi antrean ribuan pesan per menit dengan interval <i>delay</i> cerdas (Anti-Banning).</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="feature-box">
                    <div class="feature-icon"><i class="bi bi-globe"></i></div>
                    <h3 class="feature-title">Digital Portfolio Engine</h3>
                    <p class="feature-desc">Fitur add-on berdedikasi bagi agensi software untuk menyusun repositori portofolio publik. Memamerkan <i>tech stack</i> andalan beserta <i>live demo</i> secara rapi ke hadapan klien potensial.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="feature-box">
                    <div class="feature-icon"><i class="bi bi-shield-lock"></i></div>
                    <h3 class="feature-title">Enterprise Security</h3>
                    <p class="feature-desc">Isolasi <i>multi-tenant</i> di ranah level-basis data (Row-Level Policy) yang secara presisi mengunci kerahasiaan direktori kontak pelanggan dan payload kampanye Anda.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Pricing Section -->
    <section id="pricing" class="pricing">
        <div class="container">
            <h2 class="section-title">Paket Berlangganan</h2>
            <p class="section-desc">Pilih paket integrasi WhatsApp yang sejalan dengan daya jelajah ekosistem bisnis Anda yang didukung penuh oleh arsitektur canggih Evolution API.</p>
            
            <div class="row g-4 mt-2 justify-content-center">
                <?php foreach ($packages as $pkg): ?>
                <?php
                    $isDark          = (bool) $pkg['is_dark_card'];
                    $isPopular       = (bool) $pkg['is_recommended'];
                    $priceFormatted  = ($pkg['price'] === 0) ? 'Rp 0' : 'Rp ' . number_format($pkg['price'] / 1000, 0) . 'k';
                    $cardClass       = 'pricing-card text-center' . ($isPopular ? ' popular' : '');
                    $cardStyle       = $isDark ? 'style="background-color: var(--primary); border: none;"' : '';
                ?>
                <div class="col-lg-3 col-md-6">
                    <div class="<?= $cardClass ?>" <?= $cardStyle ?>>
                        <?php if ($isPopular): ?><div class="popular-badge">RECOMMENDED</div><?php endif; ?>
                        <h3 class="fs-6 fw-bold mb-2"
                            style="letter-spacing:0.05em; <?= $isDark ? 'color:#94a3b8;' : ($isPopular ? 'color:var(--accent);' : 'color:var(--text-muted);') ?>">
                            <?= strtoupper(esc($pkg['name'])) ?></h3>
                        <div class="price <?= $isDark ? 'text-white' : 'text-dark' ?>">
                            <?= $priceFormatted ?><span>/bln</span></div>
                        <hr <?= $isDark ? 'style="border-color:#334155; margin-top:1rem; margin-bottom:1rem;"' : 'class="border-secondary-subtle my-3"' ?>>
                        <ul class="pricing-features <?= $isDark ? 'text-white' : 'text-dark' ?>">
                            <?php foreach ($pkg['features'] as $feat): ?>
                            <li>
                                <?php if ($isDark): ?>
                                    <i class="bi bi-rocket-takeoff-fill text-warning me-2"></i>
                                <?php elseif ($isPopular): ?>
                                    <i class="bi bi-check2-all" style="color:var(--accent)"></i>
                                <?php else: ?>
                                    <i class="bi bi-check2 text-muted"></i>
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
                            <a href="/register" class="btn btn-outline-primary w-100 fw-bold mt-2">Start Free Tryout</a>
                        <?php else: ?>
                            <a href="/register" class="btn btn-outline-primary w-100 fw-bold mt-2">Subscribe <?= esc($pkg['name']) ?></a>
                        <?php endif; ?>
                    </div>
                </div>
                <?php endforeach; ?>
            </div><!-- end .row -->
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="row g-4">
                <div class="col-md-6">
                    <div class="footer-brand d-flex align-items-center mb-3">
                        <img src="<?= base_url('assets/images/logo.png') ?>" alt="Rumah Coding" height="28" class="me-2">
                        <span style="font-size: 1.1rem; color: var(--primary);">Rumah Coding</span>
                    </div>
                    <p class="text-muted" style="font-size: 0.9rem; max-width: 350px;">Platform *messaging framework* terdesentralisasi bagi perusahaan B2B dengan komitmen *uptime* 99.9%.</p>
                </div>
                <div class="col-md-3">
                    <h6 class="fw-bold mb-3 text-dark">Ecosystem</h6>
                    <div class="footer-links">
                        <a href="/api-reference">Gateway REST API</a>
                        <a href="/p/demo">Portfolio Showcase</a>
                        <a href="/pricing">Pricing Plans</a>
                        <a href="/status">Service Status</a>
                    </div>
                </div>
                <div class="col-md-3">
                    <h6 class="fw-bold mb-3 text-dark">Resources</h6>
                    <div class="footer-links">
                        <a href="/api-reference">REST API References</a>
                        <a href="#">GitHub Repositories</a>
                        <a href="#">Webhook References</a>
                        <a href="#">Security Bulletins</a>
                    </div>
                </div>
            </div>
            <div class="mt-5 pt-4 border-top text-start text-muted d-flex justify-content-between flex-wrap" style="font-size: 0.85rem;">
                <div>&copy; 2026 SaaS Gateway by Rumah Coding. All rights reserved.</div>
                <div class="d-flex gap-3">
                    <a href="/privacy-policy" class="text-muted text-decoration-none">Privacy Policy</a>
                    <a href="/terms-of-service" class="text-muted text-decoration-none">Terms of Service</a>
                </div>
            </div>
        </div>
    </footer>

    <!-- Bootstrap Bundle JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
