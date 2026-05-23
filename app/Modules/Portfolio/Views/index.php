<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portfolio - <?= esc($tenant->owner_name ?? 'Company') ?></title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Google Fonts: Inter -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; background-color: #f8fafc; color: #334155; }
        .hero-section { background-color: #ffffff; border-bottom: 1px solid #e2e8f0; padding: 5rem 0 3.5rem 0; }
        .hero-avatar { width: 64px; height: 64px; border-radius: 0.5rem; background-color: #0f172a; color: white; display: flex; align-items: center; justify-content: center; font-size: 1.5rem; font-weight: 700; margin-bottom: 1.5rem; }
        .hero-title { font-weight: 700; color: #0f172a; font-size: 2.25rem; letter-spacing: -0.02em; margin-bottom: 1rem; }
        .hero-bio { color: #64748b; font-size: 1.1rem; max-width: 700px; line-height: 1.6; }
        .portfolio-title { font-size: 1.125rem; font-weight: 700; color: #0f172a; border-bottom: 1px solid #e2e8f0; padding-bottom: 0.75rem; margin-bottom: 2rem; text-transform: uppercase; letter-spacing: 0.05em; }
        .card { border: 1px solid #e2e8f0; border-radius: 0.5rem; box-shadow: none; transition: border-color 0.2s ease, transform 0.2s ease; background-color: #ffffff; overflow: hidden; }
        .card:hover { border-color: #cbd5e1; transform: translateY(-2px); }
        .card-img-placeholder { height: 180px; background-color: #f1f5f9; border-bottom: 1px solid #e2e8f0; display: flex; align-items: center; justify-content: center; font-size: 1.5rem; color: #94a3b8; }
        .card-body { padding: 1.5rem; }
        .card-title { font-size: 1.1rem; font-weight: 600; color: #0f172a; margin-bottom: 0.75rem; }
        .card-text { font-size: 0.875rem; color: #64748b; line-height: 1.6; margin-bottom: 1.25rem; }
        .badge-tech { background-color: #f8fafc; color: #475569; border: 1px solid #e2e8f0; font-weight: 500; font-size: 0.75rem; padding: 0.3em 0.6em; border-radius: 0.25rem; }
        .link-readmore { font-size: 0.875rem; font-weight: 600; color: #1d4ed8; text-decoration: none; }
        .link-readmore:hover { text-decoration: underline; color: #1e40af; }
    </style>
</head>
<body>
    <header class="hero-section mb-5">
        <div class="container">
            <div class="hero-avatar"><?= esc(substr($tenant->owner_name ?? 'Company', 0, 2)) ?></div>
            <h1 class="hero-title"><?= esc($tenant->owner_name ?? 'Digital Solutions Inc.') ?></h1>
            <p class="hero-bio">Kami membangun aplikasi perangkat lunak berkinerja tinggi untuk integrasi B2B, otomatisasi proses, dan platform digital yang dapat diskalakan.</p>
        </div>
    </header>

    <main class="container mb-5 pb-5">
        <h2 class="portfolio-title">Projects</h2>

        <div class="row g-4">
            <?php foreach ($portfolios as $project) : ?>
                <div class="col-md-6 col-lg-4">
                    <article class="card h-100">
                        <div class="card-img-placeholder"><?= esc($project->category) ?></div>
                        <div class="card-body d-flex flex-column">
                            <h3 class="card-title"><?= esc($project->title) ?></h3>
                            <p class="card-text flex-grow-1"><?= esc($project->description) ?></p>
                            <div class="mb-4">
                                <?php foreach ($project->tech_stack as $tech) : ?>
                                    <span class="badge-tech me-1"><?= esc($tech) ?></span>
                                <?php endforeach ?>
                            </div>
                            <div>
                                <a href="/p/<?= esc($tenantIdentifier) ?>/<?= esc($project->slug) ?>" class="link-readmore">Detail Project &rarr;</a>
                            </div>
                        </div>
                    </article>
                </div>
            <?php endforeach ?>
        </div>
    </main>

    <footer class="py-4 border-top" style="background-color: #ffffff;">
        <div class="container text-center text-muted" style="font-size: 0.875rem;">
            &copy; 2026 <?= esc($tenant->owner_name ?? 'Company') ?>. Built with CodeIgniter 4.
        </div>
    </footer>
</body>
</html>
