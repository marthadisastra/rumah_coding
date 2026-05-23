<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Service Status - Rumah Coding</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        :root { --primary: #0f172a; --bg-light: #f8fafc; --text-dark: #0f172a; --text-muted: #64748b; --border-color: #e2e8f0; }
        body { font-family: 'Inter', sans-serif; background-color: #f8fafc; color: var(--text-dark); }
        .navbar { border-bottom: 1px solid var(--border-color); background-color: rgba(255, 255, 255, 0.95); backdrop-filter: blur(8px); padding: 1rem 0; }
        
        .status-container { max-width: 800px; margin: 40px auto 100px; }
        .status-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem; }
        .status-banner { background-color: #10b981; color: white; padding: 1.5rem; border-radius: 8px; font-weight: 600; font-size: 1.25rem; display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem; box-shadow: 0 4px 6px -1px rgba(16, 185, 129, 0.2); }
        
        .component-card { background: white; border: 1px solid var(--border-color); border-radius: 8px; overflow: hidden; margin-bottom: 3rem; box-shadow: 0 1px 3px 0 rgba(0,0,0,0.1); }
        .component-item { padding: 1rem 1.5rem; border-bottom: 1px solid var(--border-color); display: flex; justify-content: space-between; align-items: center; }
        .component-item:last-child { border-bottom: none; }
        .component-name { font-weight: 600; font-size: 0.95rem; }
        .component-status { color: #10b981; font-weight: 600; font-size: 0.85rem; display: flex; align-items: center; letter-spacing: 0.05em; text-transform: uppercase; }
        .component-status i { margin-right: 0.4rem; font-size: 1.1rem; }
        
        .history-item { margin-bottom: 2rem; }
        .history-date { font-weight: 700; font-size: 1.1rem; margin-bottom: 0.5rem; border-bottom: 1px solid var(--border-color); padding-bottom: 0.5rem; }
        .history-content { color: var(--text-muted); font-size: 0.95rem; }
    </style>
</head>
<body>

    <nav class="navbar navbar-expand-lg sticky-top">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center fw-bold" href="/" style="color: var(--primary); text-decoration: none;">
                <img src="<?= base_url('assets/images/logo.png') ?>" alt="Rumah Coding" height="32" class="me-2">
                <span class="fs-5" style="letter-spacing: -0.02em;">Rumah Coding</span>
            </a>
            <div class="ms-auto text-muted" style="font-size: 0.85rem;">
                <a href="/" class="text-decoration-none text-muted fw-medium"><i class="bi bi-arrow-left"></i> Back to Home</a>
            </div>
        </div>
    </nav>

    <div class="container status-container px-4">
        <div class="status-header">
            <h1 class="fw-bold fs-3 m-0" style="letter-spacing:-0.02em;">System Status</h1>
            <button class="btn btn-outline-dark btn-sm fw-bold px-3">Subscribe to Updates</button>
        </div>

        <div class="status-banner">
            <div>All Systems Operational</div>
            <i class="bi bi-check-circle-fill"></i>
        </div>

        <h3 class="fw-bold fs-5 mb-3">Service Components</h3>
        <div class="component-card">
            <div class="component-item">
                <span class="component-name">Core Framework API</span>
                <span class="component-status"><i class="bi bi-check-circle-fill"></i> Operational</span>
            </div>
            <div class="component-item">
                <span class="component-name">WhatsApp Headless Nodes</span>
                <span class="component-status"><i class="bi bi-check-circle-fill"></i> Operational</span>
            </div>
            <div class="component-item">
                <span class="component-name">Webhook Delivery Pipeline</span>
                <span class="component-status"><i class="bi bi-check-circle-fill"></i> Operational</span>
            </div>
            <div class="component-item">
                <span class="component-name">Tenant Portfolio Dashboard</span>
                <span class="component-status"><i class="bi bi-check-circle-fill"></i> Operational</span>
            </div>
            <div class="component-item">
                <span class="component-name">RabbitMQ Async Queue</span>
                <span class="component-status"><i class="bi bi-check-circle-fill"></i> Operational</span>
            </div>
        </div>

        <h3 class="fw-bold fs-5 mt-5 mb-4">Past Incidents</h3>
        <div class="history-item">
            <div class="history-date">May 19, 2026</div>
            <div class="history-content">No incidents reported today.</div>
        </div>
        <div class="history-item">
            <div class="history-date">May 18, 2026</div>
            <div class="history-content">No incidents reported today.</div>
        </div>
        <div class="history-item">
            <div class="history-date">May 17, 2026</div>
            <div class="history-content">
                <strong class="text-dark">Resolved</strong> - We mitigated a slight delay in Webhook responses between 03:00 - 03:15 WIB due to scheduled database rotation tuning. All queued logs have been successfully flushed to tenant destinations.
            </div>
        </div>
    </div>

</body>
</html>
