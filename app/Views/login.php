<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign In - Rumah Coding</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; background-color: #f8fafc; color: #0f172a; height: 100vh; display: flex; align-items: center; justify-content: center; }
        .auth-card { background: white; border: 1px solid #e2e8f0; border-radius: 12px; padding: 2.5rem; width: 100%; max-width: 400px; box-shadow: 0 10px 15px -3px rgba(0,0,0,0.05); }
        .btn-primary { background-color: #0f172a; border-color: #0f172a; }
        .btn-primary:hover { background-color: #1e293b; border-color: #1e293b; }
        .form-control { border-color: #cbd5e1; }
        .form-control:focus { border-color: #0f172a; box-shadow: none; }
    </style>
</head>
<body>
    <div class="auth-card">
        <div class="text-center mb-4">
            <img src="<?= base_url('assets/images/logo.png') ?>" alt="Rumah Coding" height="40" class="mb-3">
            <h4 class="fw-bold">Welcome back</h4>
            <p class="text-muted" style="font-size: 0.9rem;">Sign in to your dashboard</p>
        </div>
        <form action="/dashboard" method="GET">
            <div class="mb-3">
                <label class="form-label fw-medium" style="font-size: 0.9rem;">Email address</label>
                <input type="email" class="form-control" placeholder="name@company.com" required>
            </div>
            <div class="mb-4">
                <div class="d-flex justify-content-between">
                    <label class="form-label fw-medium" style="font-size: 0.9rem;">Password</label>
                    <a href="#" class="text-decoration-none text-primary" style="font-size: 0.85rem;">Forgot password?</a>
                </div>
                <input type="password" class="form-control" placeholder="••••••••" required>
            </div>
            <button type="submit" class="btn btn-primary w-100 fw-bold py-2">Sign In</button>
        </form>
        <div class="text-center mt-4 text-muted" style="font-size: 0.875rem;">
            Don't have an account? <a href="/register" class="text-decoration-none text-primary fw-medium">Sign up</a>
        </div>
        <div class="text-center mt-3">
            <a href="/" class="text-decoration-none text-muted" style="font-size: 0.875rem;">&larr; Back to Home</a>
        </div>
    </div>
</body>
</html>
