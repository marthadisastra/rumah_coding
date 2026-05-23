<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - WA Gateway</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-gradient-to-br from-blue-50 to-indigo-100 min-h-screen flex items-center justify-center p-4">
    <div class="max-w-md w-full">
        <!-- Logo & Header -->
        <div class="text-center mb-8">
            <div class="inline-flex items-center justify-center w-16 h-16 bg-green-500 rounded-full mb-4">
                <i class="fab fa-whatsapp text-white text-3xl"></i>
            </div>
            <h1 class="text-3xl font-bold text-gray-800">WA Gateway</h1>
            <p class="text-gray-600 mt-2">Daftar Akun Baru</p>
        </div>

        <!-- Register Form -->
        <div class="bg-white rounded-2xl shadow-xl p-8">
            <?php if (session()->getFlashdata('success')): ?>
                <div class="mb-6 p-4 bg-green-50 border border-green-200 rounded-lg">
                    <div class="flex items-center">
                        <i class="fas fa-check-circle text-green-500 mr-2"></i>
                        <span class="text-green-700"><?= session()->getFlashdata('success') ?></span>
                    </div>
                </div>
            <?php endif; ?>

            <?php if (session()->getFlashdata('error')): ?>
                <div class="mb-6 p-4 bg-red-50 border border-red-200 rounded-lg">
                    <div class="flex items-center">
                        <i class="fas fa-exclamation-circle text-red-500 mr-2"></i>
                        <span class="text-red-700"><?= session()->getFlashdata('error') ?></span>
                    </div>
                </div>
            <?php endif; ?>

            <?php if (session()->getFlashdata('errors')): ?>
                <div class="mb-6 p-4 bg-red-50 border border-red-200 rounded-lg">
                    <ul class="list-disc list-inside text-red-700">
                        <?php foreach (session()->getFlashdata('errors') as $error): ?>
                            <li><?= esc($error) ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endif; ?>

            <form action="<?= site_url('/tenant/doRegister') ?>" method="post">
                <?= csrf_field() ?>
                
                <!-- Owner Name Field -->
                <div class="mb-4">
                    <label for="owner_name" class="block text-sm font-medium text-gray-700 mb-2">
                        <i class="fas fa-user mr-2"></i>Nama Lengkap
                    </label>
                    <input 
                        type="text" 
                        id="owner_name" 
                        name="owner_name" 
                        value="<?= old('owner_name') ?>"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent transition-all"
                        placeholder="John Doe"
                        required
                    >
                </div>

                <!-- Email Field -->
                <div class="mb-4">
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
                        <i class="fas fa-envelope mr-2"></i>Email
                    </label>
                    <input 
                        type="email" 
                        id="email" 
                        name="email" 
                        value="<?= old('email') ?>"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent transition-all"
                        placeholder="nama@email.com"
                        required
                    >
                </div>

                <!-- Password Field -->
                <div class="mb-4">
                    <label for="password" class="block text-sm font-medium text-gray-700 mb-2">
                        <i class="fas fa-lock mr-2"></i>Password
                    </label>
                    <input 
                        type="password" 
                        id="password" 
                        name="password" 
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent transition-all"
                        placeholder="Minimal 8 karakter"
                        required
                    >
                    <p class="text-xs text-gray-500 mt-1">
                        <i class="fas fa-info-circle mr-1"></i>
                        Harus mengandung huruf besar, huruf kecil, dan angka
                    </p>
                </div>

                <!-- Confirm Password Field -->
                <div class="mb-6">
                    <label for="password_confirm" class="block text-sm font-medium text-gray-700 mb-2">
                        <i class="fas fa-lock mr-2"></i>Konfirmasi Password
                    </label>
                    <input 
                        type="password" 
                        id="password_confirm" 
                        name="password_confirm" 
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent transition-all"
                        placeholder="Ulangi password"
                        required
                    >
                </div>

                <!-- Terms & Conditions -->
                <div class="mb-6">
                    <label class="flex items-start">
                        <input type="checkbox" class="w-4 h-4 text-green-500 border-gray-300 rounded focus:ring-green-500 mt-1" required>
                        <span class="ml-2 text-sm text-gray-600">
                            Saya setuju dengan 
                            <a href="<?= site_url('/terms') ?>" class="text-green-600 hover:text-green-700 font-medium" target="_blank">Syarat & Ketentuan</a>
                            dan 
                            <a href="<?= site_url('/privacy') ?>" class="text-green-600 hover:text-green-700 font-medium" target="_blank">Kebijakan Privasi</a>
                        </span>
                    </label>
                </div>

                <!-- Submit Button -->
                <button 
                    type="submit" 
                    class="w-full bg-green-500 hover:bg-green-600 text-white font-semibold py-3 px-4 rounded-lg transition-colors duration-200 flex items-center justify-center"
                >
                    <i class="fas fa-user-plus mr-2"></i>
                    Daftar Sekarang
                </button>
            </form>

            <!-- Login Link -->
            <div class="mt-6 text-center">
                <p class="text-gray-600">
                    Sudah punya akun? 
                    <a href="<?= site_url('/tenant/login') ?>" class="text-green-600 hover:text-green-700 font-semibold">
                        Login di sini
                    </a>
                </p>
            </div>

            <!-- Back to Home -->
            <div class="mt-4 text-center">
                <a href="<?= site_url('/') ?>" class="text-sm text-gray-500 hover:text-gray-700">
                    <i class="fas fa-arrow-left mr-1"></i>Kembali ke Beranda
                </a>
            </div>
        </div>

        <!-- Footer -->
        <div class="mt-8 text-center text-sm text-gray-500">
            <p>&copy; <?= date('Y') ?> WA Gateway. All rights reserved.</p>
        </div>
    </div>
</body>
</html>
