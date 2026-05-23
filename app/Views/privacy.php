<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= esc($page['title'] ?? 'Kebijakan Privasi') ?> - Rumah Coding</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        :root { --primary:#0f172a; --bg-light:#f8fafc; --text-muted:#64748b; --border-color:#e2e8f0; }
        body { font-family:'Inter',sans-serif; background:#ffffff; color:var(--primary); }
        .navbar { border-bottom:1px solid var(--border-color); background:rgba(255,255,255,.95); backdrop-filter:blur(8px); padding:1rem 0; }
        .page-header { background:var(--bg-light); padding:80px 0 60px; border-bottom:1px solid var(--border-color); text-align:center; }
        .content-area { padding:60px 0 100px; max-width:800px; margin:0 auto; color:var(--text-muted); line-height:1.8; }
        .content-area h2 { color:var(--primary); font-weight:700; margin-top:40px; margin-bottom:20px; font-size:1.25rem; }
        .content-area p, .content-area li { margin-bottom:15px; text-align:justify; }
        .footer { padding:40px 0; border-top:1px solid var(--border-color); background:#ffffff; }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg sticky-top">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center fw-bold" href="/" style="color:var(--primary);text-decoration:none;">
                <img src="<?= base_url('assets/images/logo.png') ?>" alt="Rumah Coding" height="32" class="me-2">
                <span class="fs-5" style="letter-spacing:-0.02em;">Rumah Coding</span>
            </a>
        </div>
    </nav>

    <div class="page-header">
        <div class="container">
            <h1 class="fw-bold mb-3 text-dark" style="font-size:2.5rem;letter-spacing:-0.02em;">
                <?= esc($page['title'] ?? 'Kebijakan Privasi') ?>
            </h1>
            <p class="text-muted mb-0">
                Berlaku Efektif: <?= isset($page['effective_date']) ? date('d F Y', strtotime($page['effective_date'])) : '' ?>
            </p>
        </div>
    </div>

    <div class="container content-area px-4">
        <?= $page['body'] ?? '' ?>
    </div>

    <footer class="footer">
        <div class="container text-center text-muted" style="font-size:0.85rem;">
            &copy; <?= date('Y') ?> Rumah Coding. Hak Cipta Dilindungi Undang-Undang Republik Indonesia.
            &nbsp;|&nbsp;
            <a href="/terms-of-service" class="text-muted text-decoration-none">Syarat & Ketentuan</a>
        </div>
    </footer>
</body>
</html>
