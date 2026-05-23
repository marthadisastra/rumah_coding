<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= esc($portfolio->title) ?> - <?= esc($tenant->owner_name ?? 'Company') ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; background-color: #f8fafc; color: #334155; }
        .page-header { background: #ffffff; border-bottom: 1px solid #e2e8f0; padding: 3rem 0 2rem; }
        .page-header h1 { font-size: 2rem; font-weight: 700; margin-bottom: 0.5rem; }
        .page-header p { color: #64748b; font-size: 1rem; max-width: 720px; line-height: 1.7; }
        .tag-pill { display: inline-flex; gap: 0.4rem; flex-wrap: wrap; margin-top: 1rem; }
        .tag-pill span { background: #f8fafc; border: 1px solid #e2e8f0; color: #475569; font-size: 0.78rem; font-weight: 600; padding: 0.45rem 0.75rem; border-radius: 999px; }
        .content-card { background: #ffffff; border: 1px solid #e2e8f0; border-radius: 1rem; padding: 2rem; }
        .content-card h2 { font-size: 1.15rem; font-weight: 700; margin-bottom: 1rem; }
        .content-card p { color: #475569; line-height: 1.75; margin-bottom: 1rem; }
        .content-card .meta { display: grid; grid-template-columns: repeat(2, minmax(0, 1fr)); gap: 1rem; margin-bottom: 1.75rem; }
        .content-card .meta dt { color: #475569; font-size: 0.85rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.04em; }
        .content-card .meta dd { margin: 0; color: #0f172a; font-size: 0.95rem; }
        .feature-list { list-style: none; padding: 0; margin: 0; }
        .feature-list li { margin-bottom: 0.85rem; padding-left: 1.65rem; position: relative; color: #475569; }
        .feature-list li::before { content: '•'; position: absolute; left: 0; top: 0; color: #2563eb; font-size: 1.1rem; line-height: 1; }
        .btn-primary { background-color: #1d4ed8; border-color: #1d4ed8; }
        .btn-primary:hover { background-color: #1e40af; border-color: #1e40af; }
    </style>
</head>
<body>
    <header class="page-header">
        <div class="container">
            <a href="/p/<?= esc($tenantIdentifier) ?>" class="text-decoration-none text-muted mb-3 d-inline-block">&larr; Kembali ke semua portfolio</a>
            <h1><?= esc($portfolio->title) ?></h1>
            <p><?= esc($portfolio->description) ?></p>
            <div class="tag-pill">
                <span><?= esc($portfolio->category) ?></span>
                <?php foreach ($portfolio->tech_stack as $tech): ?>
                    <span><?= esc($tech) ?></span>
                <?php endforeach ?>
            </div>
        </div>
    </header>

    <main class="container my-5">
        <div class="row gy-4">
            <div class="col-lg-7">
                <div class="content-card mb-4">
                    <h2>Preview Capture</h2>
                    <div class="ratio ratio-16x9 rounded overflow-hidden shadow-sm" style="background-color:#f8fafc; border: 1px solid #e2e8f0;">
                        <?php if (! empty($portfolio->preview_image)): ?>
                            <img src="<?= esc($portfolio->preview_image) ?>" alt="Preview <?= esc($portfolio->title) ?>" class="img-fluid w-100 h-100" style="object-fit: cover;">
                        <?php else: ?>
                            <div class="d-flex align-items-center justify-content-center h-100 text-muted">Preview capture belum tersedia</div>
                        <?php endif ?>
                    </div>
                </div>

                <div class="content-card">
                    <h2>Project Overview</h2>
                    <p><?= esc($portfolio->overview) ?></p>
                    <h2>Business Challenge</h2>
                    <p><?= esc($portfolio->challenge) ?></p>
                    <h2>Our Solution</h2>
                    <p><?= esc($portfolio->solution) ?></p>
                    <h2>Impact & Results</h2>
                    <p><?= esc($portfolio->results) ?></p>
                </div>
            </div>
            <div class="col-lg-5">
                <div class="content-card">
                    <dl class="meta">
                        <div>
                            <dt>Klien</dt>
                            <dd><?= esc($portfolio->client) ?></dd>
                        </div>
                        <div>
                            <dt>Tahun</dt>
                            <dd><?= esc($portfolio->year) ?></dd>
                        </div>
                    </dl>
                    <h2>Core Features</h2>
                    <ul class="feature-list">
                        <?php foreach ($portfolio->features as $feature): ?>
                            <li><?= esc($feature) ?></li>
                        <?php endforeach ?>
                    </ul>
                    <h2 class="mt-4">Tech Stack</h2>
                    <ul class="feature-list">
                        <?php foreach ($portfolio->tech_stack as $tech): ?>
                            <li><?= esc($tech) ?></li>
                        <?php endforeach ?>
                    </ul>
                    <?php if (! empty($portfolio->demo_url) && $portfolio->demo_url !== '#'): ?>
                        <a href="<?= esc($portfolio->demo_url) ?>" class="btn btn-primary w-100 mt-4">Lihat Demo</a>
                    <?php else: ?>
                        <a href="javascript:void(0)" class="btn btn-primary w-100 mt-4 disabled" aria-disabled="true">Demo segera hadir</a>
                    <?php endif ?>
                </div>
            </div>
        </div>
    </main>

    <footer class="py-4 border-top" style="background-color: #ffffff;">
        <div class="container text-center text-muted" style="font-size: 0.875rem;">
            &copy; 2026 <?= esc($tenant->owner_name ?? 'Company') ?>. Built with CodeIgniter 4.
        </div>
    </footer>
</body>
</html>
