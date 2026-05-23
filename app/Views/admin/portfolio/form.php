<?= $this->extend('admin/layout') ?>

<?= $this->section('content') ?>
<?php $tenants = $tenants ?? []; $portfolio = $portfolio ?? []; ?>
<div class="row">
    <div class="col-xl-8 grid-margin stretch-card">
        <div class="card card-shell">
            <div class="card-body">
                <h4 class="section-title mb-3"><?= esc($title ?? 'Portfolio Form') ?></h4>
                <form action="<?= site_url('/admin/portfolio/' . $action) ?>" method="post">
                    <?= csrf_field() ?>
                    <div class="row g-3">
                        <div class="col-md-6"><label class="form-label">Tenant</label><select name="tenant_id" class="form-select" required><option value="">Pilih tenant</option><?php foreach ($tenants as $tenant): ?><option value="<?= esc((string) $tenant['id']) ?>" <?= ((string) ($portfolio['tenant_id'] ?? '') === (string) $tenant['id']) ? 'selected' : '' ?>><?= esc($tenant['owner_name']) ?> - <?= esc($tenant['email']) ?></option><?php endforeach; ?></select></div>
                        <div class="col-md-6"><label class="form-label">Title</label><input name="title" class="form-control" value="<?= esc($portfolio['title'] ?? '') ?>" required></div>
                        <div class="col-md-6"><label class="form-label">Slug</label><input name="slug" class="form-control" value="<?= esc($portfolio['slug'] ?? '') ?>" required></div>
                        <div class="col-md-6"><label class="form-label">Tech Stack</label><input name="tech_stack" class="form-control" value="<?= esc($portfolio['tech_stack'] ?? '') ?>"></div>
                        <div class="col-md-6"><label class="form-label">Thumbnail URL</label><input name="thumbnail_image" class="form-control" value="<?= esc($portfolio['thumbnail_image'] ?? '') ?>"></div>
                        <div class="col-md-6"><label class="form-label">Demo URL</label><input name="demo_url" class="form-control" value="<?= esc($portfolio['demo_url'] ?? '') ?>"></div>
                        <div class="col-12"><label class="form-label">Description</label><textarea name="description" class="form-control" rows="6"><?= esc($portfolio['description'] ?? '') ?></textarea></div>
                        <div class="col-12"><label class="form-check"><input class="form-check-input" type="checkbox" name="is_published" value="1" <?= ((int) ($portfolio['is_published'] ?? 0) === 1) ? 'checked' : '' ?>> <span class="form-check-label">Published</span></label></div>
                        <div class="col-12 d-flex gap-2"><button class="btn btn-primary">Simpan Portfolio</button><a href="<?= site_url('/admin/portfolio') ?>" class="btn btn-light">Batal</a></div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="col-xl-4 grid-margin stretch-card"><div class="card card-shell"><div class="card-body"><h4 class="section-title">Portfolio Notes</h4><p class="section-copy">Gunakan slug unik dan deskripsi singkat yang kuat supaya halaman portfolio mudah dibaca calon klien.</p></div></div></div>
</div>
<?= $this->endSection() ?>
