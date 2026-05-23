<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Rumah Coding</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; background-color: #f8fafc; color: #0f172a; height: 100vh; display: flex; align-items: center; justify-content: center; overflow-y: auto;}
        .auth-card { background: white; border: 1px solid #e2e8f0; border-radius: 12px; padding: 2.5rem; width: 100%; max-width: 480px; box-shadow: 0 10px 15px -3px rgba(0,0,0,0.05); }
        .btn-primary { background-color: #2563eb; border-color: #2563eb; }
        .btn-primary:hover { background-color: #1d4ed8; border-color: #1d4ed8; }
        .form-control { border-color: #cbd5e1; }
        .form-control:focus { border-color: #2563eb; box-shadow: none; }
    </style>
</head>
<body class="py-5" style="height: auto; min-height: 100vh;">
    <div class="auth-card my-auto">
        <div class="text-center mb-4">
            <img src="<?= base_url('assets/images/logo.png') ?>" alt="Rumah Coding" height="40" class="mb-3">
            <h4 class="fw-bold">Create your workspace</h4>
            <p class="text-muted" style="font-size: 0.9rem;">Join Rumah Coding to start sending WhatsApp messages.</p>
        </div>
        <form action="/dashboard" method="GET">
            <div class="row g-3 mb-3">
                <div class="col-md-6">
                    <label class="form-label fw-medium" style="font-size: 0.9rem;">First name</label>
                    <input type="text" class="form-control" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-medium" style="font-size: 0.9rem;">Last name</label>
                    <input type="text" class="form-control" required>
                </div>
            </div>
            <div class="mb-3">
                <label class="form-label fw-medium" style="font-size: 0.9rem;">Company / Workspace URL slug</label>
                <div class="input-group">
                    <span class="input-group-text bg-light text-muted" style="font-size: 0.85rem;">rumahcoding.com/p/</span>
                    <input type="text" class="form-control" placeholder="mycompany" required>
                </div>
            </div>
            <div class="mb-3">
                <label class="form-label fw-medium" style="font-size: 0.9rem;">Work Email</label>
                <input type="email" class="form-control" placeholder="name@company.com" required>
            </div>
            <div class="mb-4">
                <label class="form-label fw-medium" style="font-size: 0.9rem;">Password</label>
                <input type="password" class="form-control" placeholder="••••••••" required>
            </div>
            <button type="submit" class="btn btn-primary w-100 fw-bold py-2">Create Account</button>
        </form>
        <div class="text-center mt-4 text-muted" style="font-size: 0.875rem;">
            Already have an account? <a href="/login" class="text-decoration-none fw-medium" style="color: #2563eb;">Sign in</a>
        </div>
        <div class="text-center mt-3">
            <a href="/" class="text-decoration-none text-muted" style="font-size: 0.875rem;">&larr; Back to Home</a>
        </div>
    </div>
</body>
</html>
