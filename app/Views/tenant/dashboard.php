<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= esc($title ?? 'Dashboard') ?> - WA Gateway</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-gray-50">
    <!-- Top Navigation -->
    <nav class="bg-white shadow-sm border-b border-gray-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <div class="flex-shrink-0 flex items-center">
                        <i class="fab fa-whatsapp text-green-500 text-2xl mr-2"></i>
                        <span class="font-bold text-xl text-gray-800">WA Gateway</span>
                    </div>
                </div>
                <div class="flex items-center space-x-4">
                    <span class="text-sm text-gray-600">Halo, <?= esc(session()->get('tenant_name')) ?></span>
                    <a href="<?= site_url('/tenant/logout') ?>" class="text-sm text-red-600 hover:text-red-700 font-medium">
                        <i class="fas fa-sign-out-alt mr-1"></i>Logout
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Page Header -->
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-900"><?= esc($page_title ?? 'Dashboard') ?></h1>
            <p class="mt-2 text-sm text-gray-600">Overview akun WhatsApp Gateway Anda</p>
        </div>

        <?php if (session()->getFlashdata('success')): ?>
            <div class="mb-6 p-4 bg-green-50 border border-green-200 rounded-lg">
                <div class="flex items-center">
                    <i class="fas fa-check-circle text-green-500 mr-2"></i>
                    <span class="text-green-700"><?= session()->getFlashdata('success') ?></span>
                </div>
            </div>
        <?php endif; ?>

        <!-- Stats Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            <!-- Total Instances -->
            <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-200">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-600">Total Instances</p>
                        <p class="text-3xl font-bold text-gray-900 mt-2"><?= $total_instances ?? 0 ?></p>
                    </div>
                    <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center">
                        <i class="fas fa-server text-blue-600 text-xl"></i>
                    </div>
                </div>
            </div>

            <!-- Active Instances -->
            <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-200">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-600">Instance Aktif</p>
                        <p class="text-3xl font-bold text-green-600 mt-2"><?= $active_instances ?? 0 ?></p>
                    </div>
                    <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center">
                        <i class="fas fa-check-circle text-green-600 text-xl"></i>
                    </div>
                </div>
            </div>

            <!-- Pending Messages -->
            <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-200">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-600">Pesan Antri</p>
                        <p class="text-3xl font-bold text-yellow-600 mt-2"><?= $pending_messages ?? 0 ?></p>
                    </div>
                    <div class="w-12 h-12 bg-yellow-100 rounded-full flex items-center justify-center">
                        <i class="fas fa-clock text-yellow-600 text-xl"></i>
                    </div>
                </div>
            </div>

            <!-- Sent Messages Today -->
            <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-200">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-600">Terkirim Hari Ini</p>
                        <p class="text-3xl font-bold text-indigo-600 mt-2"><?= $sent_messages ?? 0 ?></p>
                    </div>
                    <div class="w-12 h-12 bg-indigo-100 rounded-full flex items-center justify-center">
                        <i class="fas fa-paper-plane text-indigo-600 text-xl"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Instances & Messages -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <!-- Recent Instances -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center">
                    <h2 class="text-lg font-semibold text-gray-900">Instance Terbaru</h2>
                    <a href="<?= site_url('/tenant/instances') ?>" class="text-sm text-green-600 hover:text-green-700 font-medium">
                        Lihat Semua <i class="fas fa-arrow-right ml-1"></i>
                    </a>
                </div>
                <div class="divide-y divide-gray-200">
                    <?php if (!empty($recent_instances)): ?>
                        <?php foreach ($recent_instances as $instance): ?>
                            <div class="px-6 py-4 hover:bg-gray-50 transition-colors">
                                <div class="flex items-center justify-between">
                                    <div>
                                        <h3 class="font-medium text-gray-900"><?= esc($instance['name']) ?></h3>
                                        <p class="text-sm text-gray-500 mt-1"><?= esc($instance['phone'] ?? 'Belum terhubung') ?></p>
                                    </div>
                                    <span class="px-3 py-1 text-xs font-medium rounded-full 
                                        <?= $instance['status'] === 'connected' ? 'bg-green-100 text-green-700' : 
                                            ($instance['status'] === 'disconnected' ? 'bg-red-100 text-red-700' : 'bg-yellow-100 text-yellow-700') ?>">
                                        <?= ucfirst($instance['status']) ?>
                                    </span>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <div class="px-6 py-8 text-center">
                            <i class="fas fa-inbox text-gray-400 text-4xl mb-3"></i>
                            <p class="text-gray-500">Belum ada instance</p>
                            <a href="<?= site_url('/tenant/instances/create') ?>" class="mt-3 inline-block text-green-600 hover:text-green-700 font-medium">
                                Buat Instance Baru <i class="fas fa-plus ml-1"></i>
                            </a>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Recent Messages -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center">
                    <h2 class="text-lg font-semibold text-gray-900">Pesan Terbaru</h2>
                    <a href="<?= site_url('/tenant/messages/history') ?>" class="text-sm text-green-600 hover:text-green-700 font-medium">
                        Lihat Semua <i class="fas fa-arrow-right ml-1"></i>
                    </a>
                </div>
                <div class="divide-y divide-gray-200">
                    <?php if (!empty($recent_messages)): ?>
                        <?php foreach ($recent_messages as $message): ?>
                            <div class="px-6 py-4 hover:bg-gray-50 transition-colors">
                                <div class="flex items-center justify-between">
                                    <div>
                                        <p class="text-sm font-medium text-gray-900"><?= esc($message['phone']) ?></p>
                                        <p class="text-xs text-gray-500 mt-1"><?= esc(substr($message['message'], 0, 50)) ?>...</p>
                                    </div>
                                    <span class="px-3 py-1 text-xs font-medium rounded-full 
                                        <?= $message['status'] === 'sent' ? 'bg-green-100 text-green-700' : 
                                            ($message['status'] === 'failed' ? 'bg-red-100 text-red-700' : 'bg-yellow-100 text-yellow-700') ?>">
                                        <?= ucfirst($message['status']) ?>
                                    </span>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <div class="px-6 py-8 text-center">
                            <i class="fas fa-inbox text-gray-400 text-4xl mb-3"></i>
                            <p class="text-gray-500">Belum ada pesan</p>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="mt-8 bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <h2 class="text-lg font-semibold text-gray-900 mb-4">Aksi Cepat</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                <a href="<?= site_url('/tenant/instances/create') ?>" class="flex items-center p-4 border border-gray-200 rounded-lg hover:border-green-500 hover:bg-green-50 transition-all">
                    <div class="w-10 h-10 bg-green-100 rounded-full flex items-center justify-center mr-3">
                        <i class="fas fa-plus text-green-600"></i>
                    </div>
                    <div>
                        <p class="font-medium text-gray-900">Instance Baru</p>
                        <p class="text-xs text-gray-500">Buat instance WhatsApp</p>
                    </div>
                </a>
                
                <a href="<?= site_url('/tenant/messages/send') ?>" class="flex items-center p-4 border border-gray-200 rounded-lg hover:border-blue-500 hover:bg-blue-50 transition-all">
                    <div class="w-10 h-10 bg-blue-100 rounded-full flex items-center justify-center mr-3">
                        <i class="fas fa-paper-plane text-blue-600"></i>
                    </div>
                    <div>
                        <p class="font-medium text-gray-900">Kirim Pesan</p>
                        <p class="text-xs text-gray-500">Kirim pesan manual</p>
                    </div>
                </a>
                
                <a href="<?= site_url('/tenant/messages/history') ?>" class="flex items-center p-4 border border-gray-200 rounded-lg hover:border-purple-500 hover:bg-purple-50 transition-all">
                    <div class="w-10 h-10 bg-purple-100 rounded-full flex items-center justify-center mr-3">
                        <i class="fas fa-history text-purple-600"></i>
                    </div>
                    <div>
                        <p class="font-medium text-gray-900">Riwayat</p>
                        <p class="text-xs text-gray-500">Lihat riwayat pesan</p>
                    </div>
                </a>
                
                <a href="<?= site_url('/tenant/profile') ?>" class="flex items-center p-4 border border-gray-200 rounded-lg hover:border-orange-500 hover:bg-orange-50 transition-all">
                    <div class="w-10 h-10 bg-orange-100 rounded-full flex items-center justify-center mr-3">
                        <i class="fas fa-user-cog text-orange-600"></i>
                    </div>
                    <div>
                        <p class="font-medium text-gray-900">Profil</p>
                        <p class="text-xs text-gray-500">Kelola akun Anda</p>
                    </div>
                </a>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-white border-t border-gray-200 mt-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
            <div class="flex justify-between items-center">
                <p class="text-sm text-gray-500">&copy; <?= date('Y') ?> WA Gateway. All rights reserved.</p>
                <div class="flex space-x-4">
                    <a href="<?= site_url('/api-reference') ?>" class="text-sm text-gray-500 hover:text-gray-700">API Docs</a>
                    <a href="<?= site_url('/status') ?>" class="text-sm text-gray-500 hover:text-gray-700">Status</a>
                </div>
            </div>
        </div>
    </footer>
</body>
</html>
