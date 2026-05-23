<?= $this->extend('admin/layout') ?>

<?= $this->section('content') ?>

<?php $summary = $summary ?? ['total' => 0, 'fresh' => 0, 'stale' => 0]; ?>

<div class="row">
    <div class="col-md-4 grid-margin stretch-card">
        <div class="card card-shell">
            <div class="card-body">
                <p class="text-muted mb-2">Total Entries</p>
                <h3 class="mb-1"><?= esc((string) $summary['total']) ?></h3>
                <p class="small text-muted mb-0">Jumlah halaman dan entry CMS yang saat ini dikelola.</p>
            </div>
        </div>
    </div>
    <div class="col-md-4 grid-margin stretch-card">
        <div class="card card-shell">
            <div class="card-body">
                <p class="text-muted mb-2">Fresh Content</p>
                <h3 class="mb-1"><?= esc((string) $summary['fresh']) ?></h3>
                <p class="small text-muted mb-0">Konten yang diperbarui dalam 30 hari terakhir.</p>
            </div>
        </div>
    </div>
    <div class="col-md-4 grid-margin stretch-card">
        <div class="card card-shell">
            <div class="card-body">
                <p class="text-muted mb-2">Need Review</p>
                <h3 class="mb-1"><?= esc((string) $summary['stale']) ?></h3>
                <p class="small text-muted mb-0">Konten yang perlu audit ulang karena sudah cukup lama tidak disentuh.</p>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12 grid-margin stretch-card">
        <div class="card card-shell-table">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap gap-2">
                    <div>
                        <h4 class="section-title">Content Control Center</h4>
                        <p class="section-copy">Pantau kualitas, kebaruan, dan kesiapan halaman publik agar brand dan kepatuhan bisnis tetap terjaga.</p>
                    </div>
                    <a href="<?= site_url('/admin/content/create') ?>" class="btn btn-primary">Create Content</a>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead>
                        <tr>
                            <th>Page</th>
                            <th>Language</th>
                            <th>Body Size</th>
                            <th>Freshness</th>
                            <th>Effective Date</th>
                            <th>Updated</th>
                            <th class="text-end">Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php if ($pages === []): ?>
                            <tr>
                                <td colspan="7" class="text-center text-muted py-4">Belum ada konten CMS.</td>
                            </tr>
                        <?php endif; ?>
                        <?php foreach ($pages as $page): ?>
                            <tr>
                                <td>
                                    <strong><?= esc($page['title']) ?></strong>
                                    <div class="text-muted small"><?= esc($page['page_key']) ?></div>
                                </td>
                                <td><span class="badge badge-opacity-info"><?= esc(strtoupper((string) ($page['lang'] ?? 'id'))) ?></span></td>
                                <td><?= esc((string) ($page['body_length'] ?? 0)) ?> chars</td>
                                <td>
                                    <span class="badge badge-opacity-<?= esc($page['freshness_tone'] ?? 'warning') ?>">
                                        <?= esc($page['freshness_label'] ?? 'Monitor') ?>
                                    </span>
                                </td>
                                <td><?= esc($page['effective_date'] ?? '-') ?></td>
                                <td>
                                    <?= esc($page['updated_at'] ?? '-') ?>
                                    <?php if (isset($page['updated_days'])): ?>
                                        <div class="text-muted small"><?= esc((string) $page['updated_days']) ?> hari lalu</div>
                                    <?php endif; ?>
                                </td>
                                <td class="text-end">
                                    <a href="<?= site_url('/admin/content/edit/' . $page['id']) ?>" class="btn btn-sm btn-outline-primary me-2">Edit</a>
                                    <a href="<?= site_url('/admin/content/delete/' . $page['id']) ?>" class="btn btn-sm btn-outline-danger" onclick="return confirm('Hapus konten ini?')">Delete</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
