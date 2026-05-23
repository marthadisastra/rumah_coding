<?= $this->extend('admin/layout') ?>

<?= $this->section('content') ?>
<?php
$summary = $summary ?? ['total' => 0, 'active' => 0, 'recommended' => 0];
$insights = $insights ?? ['lowestPrice' => 0, 'highestPrice' => 0, 'averagePrice' => 0];
$packages = $packages ?? [];
?>
<div class="row">
    <div class="col-md-4 grid-margin stretch-card"><div class="card card-shell"><div class="card-body"><p class="text-muted mb-2">Total Paket</p><h3><?= esc((string) $summary['total']) ?></h3><p class="small text-muted mb-0">Seluruh paket yang tersedia di katalog pricing.</p></div></div></div>
    <div class="col-md-4 grid-margin stretch-card"><div class="card card-shell"><div class="card-body"><p class="text-muted mb-2">Paket Active</p><h3><?= esc((string) $summary['active']) ?></h3><p class="small text-muted mb-0">Paket yang saat ini ditampilkan untuk penjualan.</p></div></div></div>
    <div class="col-md-4 grid-margin stretch-card"><div class="card card-shell"><div class="card-body"><p class="text-muted mb-2">Recommended</p><h3><?= esc((string) $summary['recommended']) ?></h3><p class="small text-muted mb-0">Paket utama yang ingin didorong sebagai best-fit offer.</p></div></div></div>
</div>

<div class="row">
    <div class="col-xl-4 grid-margin stretch-card">
        <div class="card card-shell">
            <div class="card-body">
                <h4 class="section-title">Pricing Range</h4>
                <p class="section-copy mb-3">Owner bisa membaca posisi harga bawah, atas, dan rata-rata katalog.</p>
                <div class="border rounded-4 p-3 mb-3"><div class="text-muted small">Lowest</div><div class="h4 mb-0">Rp<?= number_format((int) $insights['lowestPrice'], 0, ',', '.') ?></div></div>
                <div class="border rounded-4 p-3 mb-3"><div class="text-muted small">Highest</div><div class="h4 mb-0">Rp<?= number_format((int) $insights['highestPrice'], 0, ',', '.') ?></div></div>
                <div class="border rounded-4 p-3"><div class="text-muted small">Average</div><div class="h4 mb-0">Rp<?= number_format((int) $insights['averagePrice'], 0, ',', '.') ?></div></div>
            </div>
        </div>
    </div>
    <div class="col-xl-8 grid-margin stretch-card">
        <div class="card card-shell-table">
            <div class="card-body">
                <h4 class="section-title">Management Pricing</h4>
                <p class="section-copy mb-3">Edit tiap paket langsung dari panel ini untuk menjaga positioning produk dan monetisasi.</p>
                <div class="accordion" id="pricingAccordion">
                    <?php foreach ($packages as $index => $package): ?>
                        <div class="accordion-item border rounded-4 mb-3 overflow-hidden">
                            <h2 class="accordion-header" id="heading-<?= esc((string) $package['id']) ?>">
                                <button class="accordion-button <?= $index === 0 ? '' : 'collapsed' ?>" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-<?= esc((string) $package['id']) ?>">
                                    <div class="d-flex w-100 justify-content-between align-items-center me-3">
                                        <div>
                                            <strong><?= esc($package['name']) ?></strong>
                                            <div class="small text-muted"><?= esc($package['slug'] ?? '-') ?> • <?= esc((string) $package['max_instances']) ?> instance • <?= esc((string) $package['max_messages']) ?> pesan</div>
                                        </div>
                                        <span class="badge badge-opacity-primary">Rp<?= number_format((int) ($package['price'] ?? 0), 0, ',', '.') ?></span>
                                    </div>
                                </button>
                            </h2>
                            <div id="collapse-<?= esc((string) $package['id']) ?>" class="accordion-collapse collapse <?= $index === 0 ? 'show' : '' ?>" data-bs-parent="#pricingAccordion">
                                <div class="accordion-body">
                                    <form action="<?= site_url('/admin/save-package') ?>" method="post">
                                        <?= csrf_field() ?>
                                        <input type="hidden" name="id" value="<?= esc((string) $package['id']) ?>">
                                        <div class="row g-3">
                                            <div class="col-md-4"><label class="form-label">Nama</label><input name="name" class="form-control" value="<?= esc($package['name']) ?>"></div>
                                            <div class="col-md-4"><label class="form-label">Harga</label><input name="price" class="form-control" value="<?= esc((string) $package['price']) ?>"></div>
                                            <div class="col-md-4"><label class="form-label">Urutan</label><input name="sort_order" class="form-control" value="<?= esc((string) $package['sort_order']) ?>"></div>
                                            <div class="col-md-4"><label class="form-label">Max Instances</label><input name="max_instances" class="form-control" value="<?= esc((string) $package['max_instances']) ?>"></div>
                                            <div class="col-md-4"><label class="form-label">Max Messages</label><input name="max_messages" class="form-control" value="<?= esc((string) $package['max_messages']) ?>"></div>
                                            <div class="col-md-4"><label class="form-label">Max Portfolios</label><input name="max_portfolios" class="form-control" value="<?= esc((string) $package['max_portfolios']) ?>"></div>
                                            <div class="col-12"><label class="form-label">Features (pisahkan dengan koma)</label><textarea name="features" class="form-control" rows="3"><?= esc(implode(', ', $package['features_list'] ?? [])) ?></textarea></div>
                                            <div class="col-12 d-flex flex-wrap gap-3">
                                                <label class="form-check"><input class="form-check-input" type="checkbox" name="is_recommended" value="1" <?= ((int) ($package['is_recommended'] ?? 0) === 1) ? 'checked' : '' ?>> <span class="form-check-label">Recommended</span></label>
                                                <label class="form-check"><input class="form-check-input" type="checkbox" name="is_active" value="1" <?= ((int) ($package['is_active'] ?? 0) === 1) ? 'checked' : '' ?>> <span class="form-check-label">Active</span></label>
                                            </div>
                                            <div class="col-12"><button class="btn btn-primary">Simpan Paket</button></div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
