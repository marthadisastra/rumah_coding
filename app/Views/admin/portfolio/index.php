<?= $this->extend('admin/layout') ?>

<?= $this->section('content') ?>
<?php $summary = $summary ?? ['total' => 0, 'published' => 0, 'draft' => 0]; $portfolios = $portfolios ?? []; ?>
<div class="row">
    <div class="col-md-4 grid-margin stretch-card"><div class="card card-shell"><div class="card-body"><p class="text-muted mb-2">Total Portfolio</p><h3><?= esc((string) $summary['total']) ?></h3><p class="small text-muted mb-0">Total showcase yang dikelola tenant atau tim internal.</p></div></div></div>
    <div class="col-md-4 grid-margin stretch-card"><div class="card card-shell"><div class="card-body"><p class="text-muted mb-2">Published</p><h3><?= esc((string) $summary['published']) ?></h3><p class="small text-muted mb-0">Portfolio yang sudah tampil publik.</p></div></div></div>
    <div class="col-md-4 grid-margin stretch-card"><div class="card card-shell"><div class="card-body"><p class="text-muted mb-2">Draft</p><h3><?= esc((string) $summary['draft']) ?></h3><p class="small text-muted mb-0">Masih perlu revisi sebelum dipublikasikan.</p></div></div></div>
</div>
<div class="row">
    <div class="col-12 grid-margin stretch-card">
        <div class="card card-shell-table">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <div><h4 class="section-title">Management Portfolio</h4><p class="section-copy">Kelola showcase proyek tenant secara rapi untuk kebutuhan presales dan branding.</p></div>
                    <a href="<?= site_url('/admin/portfolio/create') ?>" class="btn btn-primary">Tambah Portfolio</a>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead><tr><th>Title</th><th>Tenant</th><th>Tech Stack</th><th>Status</th><th>Updated</th><th class="text-end">Actions</th></tr></thead>
                        <tbody>
                        <?php if ($portfolios === []): ?><tr><td colspan="6" class="text-center text-muted py-4">Belum ada data portfolio.</td></tr><?php endif; ?>
                        <?php foreach ($portfolios as $row): ?>
                            <tr>
                                <td><strong><?= esc($row['title']) ?></strong><div class="small text-muted"><?= esc($row['slug']) ?></div></td>
                                <td><?= esc($row['tenant_name'] ?: '-') ?></td>
                                <td><?= esc($row['tech_stack'] ?: '-') ?></td>
                                <td><span class="badge badge-opacity-<?= ((int) ($row['is_published'] ?? 0) === 1) ? 'success' : 'warning' ?>"><?= ((int) ($row['is_published'] ?? 0) === 1) ? 'Published' : 'Draft' ?></span></td>
                                <td><?= esc($row['updated_at'] ?: $row['created_at']) ?></td>
                                <td class="text-end"><a class="btn btn-sm btn-outline-primary me-2" href="<?= site_url('/admin/portfolio/edit/' . $row['id']) ?>">Edit</a><a class="btn btn-sm btn-outline-danger" href="<?= site_url('/admin/portfolio/delete/' . $row['id']) ?>" onclick="return confirm('Hapus portfolio ini?')">Delete</a></td>
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
