<?= $this->extend('admin/layout') ?>

<?= $this->section('content') ?>

<?php
$data = $dashboardData ?? [];
$kpis = $data['kpis'] ?? [];
$tenantStatuses = $data['tenantStatuses'] ?? [];
$instanceStatuses = $data['instanceStatuses'] ?? [];
$queueStatuses = $data['queueStatuses'] ?? [];
$pricingInsights = $data['pricingInsights'] ?? [];
$cmsFreshness = $data['cmsFreshness'] ?? [];
$alerts = $data['alerts'] ?? [];
$recentContent = $data['recentContent'] ?? [];
$topTenants = $data['topTenants'] ?? [];
$packages = $packages ?? [];
$pages = $pages ?? [];
?>

<div class="row">
    <?php foreach ($kpis as $kpi): ?>
        <div class="col-md-6 col-xl-3 grid-margin stretch-card">
            <div class="card card-shell">
                <div class="card-body">
                    <div class="d-flex align-items-start justify-content-between">
                        <div>
                            <p class="text-muted mb-2"><?= esc($kpi['label']) ?></p>
                            <h3 class="mb-1"><?= esc($kpi['value']) ?></h3>
                            <p class="mb-0 text-muted small"><?= esc($kpi['meta']) ?></p>
                        </div>
                        <div class="rounded-circle d-flex align-items-center justify-content-center badge-soft-<?= esc($kpi['tone']) ?>" style="width:52px;height:52px;">
                            <i class="typcn <?= esc($kpi['icon']) ?>" style="font-size:1.4rem;"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>

<div class="row">
    <div class="col-xl-8 grid-margin stretch-card">
        <div class="card card-shell">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-start flex-wrap gap-3 mb-4">
                    <div>
                        <h4 class="section-title">Command Center Owner</h4>
                        <p class="section-copy">Menyatukan sinyal pertumbuhan tenant, stabilitas WhatsApp gateway, dan kualitas execution queue agar owner bisa memutuskan fokus scale berikutnya.</p>
                    </div>
                    <div class="badge badge-opacity-primary px-3 py-2">
                        Health score <?= esc((string) ($data['healthScore'] ?? 0)) ?>/100
                    </div>
                </div>

                <div class="row g-3">
                    <div class="col-md-4">
                        <div class="border rounded-4 p-3 h-100">
                            <p class="text-muted small mb-2">Tenant mix</p>
                            <div class="d-flex justify-content-between mb-2"><span>Active</span><strong><?= esc((string) ($tenantStatuses['active'] ?? 0)) ?></strong></div>
                            <div class="d-flex justify-content-between mb-2"><span>Inactive</span><strong><?= esc((string) ($tenantStatuses['inactive'] ?? 0)) ?></strong></div>
                            <div class="d-flex justify-content-between"><span>Suspended</span><strong><?= esc((string) ($tenantStatuses['suspended'] ?? 0)) ?></strong></div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="border rounded-4 p-3 h-100">
                            <p class="text-muted small mb-2">Instance health</p>
                            <div class="d-flex justify-content-between mb-2"><span>Open</span><strong><?= esc((string) ($instanceStatuses['open'] ?? 0)) ?></strong></div>
                            <div class="d-flex justify-content-between mb-2"><span>Connecting</span><strong><?= esc((string) ($instanceStatuses['connecting'] ?? 0)) ?></strong></div>
                            <div class="d-flex justify-content-between mb-2"><span>QR Code</span><strong><?= esc((string) ($instanceStatuses['qrcode'] ?? 0)) ?></strong></div>
                            <div class="d-flex justify-content-between"><span>Close</span><strong><?= esc((string) ($instanceStatuses['close'] ?? 0)) ?></strong></div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="border rounded-4 p-3 h-100">
                            <p class="text-muted small mb-2">Queue discipline</p>
                            <div class="d-flex justify-content-between mb-2"><span>Pending</span><strong><?= esc((string) ($queueStatuses['pending'] ?? 0)) ?></strong></div>
                            <div class="d-flex justify-content-between mb-2"><span>Processing</span><strong><?= esc((string) ($queueStatuses['processing'] ?? 0)) ?></strong></div>
                            <div class="d-flex justify-content-between mb-2"><span>Sent</span><strong><?= esc((string) ($queueStatuses['sent'] ?? 0)) ?></strong></div>
                            <div class="d-flex justify-content-between"><span>Failed</span><strong><?= esc((string) ($queueStatuses['failed'] ?? 0)) ?></strong></div>
                        </div>
                    </div>
                </div>

                <div class="mt-4">
                    <?php foreach ($alerts as $alert): ?>
                        <div class="alert alert-<?= esc($alert['tone']) ?> alert-shell mb-3">
                            <strong><?= esc($alert['title']) ?></strong><br>
                            <span><?= esc($alert['body']) ?></span>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-4 grid-margin stretch-card">
        <div class="card card-shell">
            <div class="card-body">
                <h4 class="section-title">Decision Notes</h4>
                <p class="section-copy mb-3">Insight singkat yang membantu owner memutuskan prioritas penguatan produk dan operasi.</p>
                <?php foreach (($data['decisionNotes'] ?? []) as $note): ?>
                    <div class="d-flex align-items-start gap-2 border rounded-4 p-3 mb-3">
                        <span class="badge badge-opacity-primary mt-1"><i class="typcn typcn-lightbulb"></i></span>
                        <span class="text-muted small"><?= esc($note) ?></span>
                    </div>
                <?php endforeach; ?>

                <div class="border rounded-4 p-3">
                    <p class="text-muted small mb-2">CMS readiness</p>
                    <div class="d-flex justify-content-between mb-2"><span>Fresh pages</span><strong><?= esc((string) ($cmsFreshness['freshCount'] ?? 0)) ?></strong></div>
                    <div class="d-flex justify-content-between"><span>Need review</span><strong><?= esc((string) ($cmsFreshness['staleCount'] ?? 0)) ?></strong></div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-xl-7 grid-margin stretch-card">
        <div class="card card-shell-table">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <div>
                        <h4 class="section-title">Top Tenant Activity</h4>
                        <p class="section-copy">Tenant dengan bobot aktivitas tertinggi berdasarkan queue dan instance yang aktif.</p>
                    </div>
                    <a href="<?= site_url('/admin/tenants') ?>" class="btn btn-sm btn-outline-primary">Lihat Modul Tenant</a>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead>
                        <tr>
                            <th>Owner</th>
                            <th>Status</th>
                            <th>Instances</th>
                            <th>Queues</th>
                            <th>Failed</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php if ($topTenants === []): ?>
                            <tr>
                                <td colspan="5" class="text-center text-muted py-4">Belum ada data tenant untuk ditampilkan.</td>
                            </tr>
                        <?php endif; ?>
                        <?php foreach ($topTenants as $tenant): ?>
                            <tr>
                                <td>
                                    <strong><?= esc($tenant['owner_name'] ?? 'Tenant') ?></strong>
                                </td>
                                <td><span class="badge badge-opacity-primary"><?= esc(ucfirst((string) ($tenant['status'] ?? '-'))) ?></span></td>
                                <td><?= esc((string) ($tenant['total_instances'] ?? 0)) ?></td>
                                <td><?= esc((string) ($tenant['total_queues'] ?? 0)) ?></td>
                                <td><?= esc((string) ($tenant['failed_queues'] ?? 0)) ?></td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-5 grid-margin stretch-card">
        <div class="card card-shell">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <div>
                        <h4 class="section-title">Pricing Direction</h4>
                        <p class="section-copy">Snapshot struktur monetisasi dari katalog paket yang aktif.</p>
                    </div>
                    <span class="badge badge-opacity-success"><?= esc((string) ($pricingInsights['activeCount'] ?? 0)) ?> active</span>
                </div>
                <div class="row g-3 mb-3">
                    <div class="col-6">
                        <div class="border rounded-4 p-3 h-100">
                            <p class="text-muted small mb-1">Lowest price</p>
                            <h5 class="mb-0">Rp<?= number_format((int) ($pricingInsights['lowestPrice'] ?? 0), 0, ',', '.') ?></h5>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="border rounded-4 p-3 h-100">
                            <p class="text-muted small mb-1">Highest price</p>
                            <h5 class="mb-0">Rp<?= number_format((int) ($pricingInsights['highestPrice'] ?? 0), 0, ',', '.') ?></h5>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="border rounded-4 p-3">
                            <p class="text-muted small mb-1">Average package price</p>
                            <h5 class="mb-0">Rp<?= number_format((int) ($pricingInsights['averagePrice'] ?? 0), 0, ',', '.') ?></h5>
                        </div>
                    </div>
                </div>

                <?php foreach (array_slice($packages, 0, 4) as $package): ?>
                    <div class="d-flex justify-content-between align-items-center border-top py-3">
                        <div>
                            <div class="fw-semibold"><?= esc($package['name']) ?></div>
                            <div class="text-muted small">
                                <?= esc((string) $package['max_instances']) ?> instance • <?= esc((string) $package['max_messages']) ?> pesan
                            </div>
                        </div>
                        <div class="text-end">
                            <div class="fw-semibold">Rp<?= number_format((int) ($package['price'] ?? 0), 0, ',', '.') ?></div>
                            <?php if ((int) ($package['is_recommended'] ?? 0) === 1): ?>
                                <span class="badge badge-opacity-warning">Recommended</span>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-xl-6 grid-margin stretch-card">
        <div class="card card-shell-table">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <div>
                        <h4 class="section-title">Recent CMS Updates</h4>
                        <p class="section-copy">Membantu memastikan halaman legal dan informasi publik tidak stale.</p>
                    </div>
                    <a href="<?= site_url('/admin/content') ?>" class="btn btn-sm btn-outline-primary">Kelola Konten</a>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead>
                        <tr>
                            <th>Page</th>
                            <th>Effective</th>
                            <th>Updated</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php if ($recentContent === []): ?>
                            <tr>
                                <td colspan="3" class="text-center text-muted py-4">Belum ada konten terbaru.</td>
                            </tr>
                        <?php endif; ?>
                        <?php foreach ($recentContent as $row): ?>
                            <tr>
                                <td>
                                    <strong><?= esc($row['title'] ?? $row['page_key']) ?></strong>
                                    <div class="text-muted small"><?= esc($row['page_key'] ?? '-') ?></div>
                                </td>
                                <td><?= esc($row['effective_date'] ?? '-') ?></td>
                                <td><?= esc($row['updated_at'] ?? '-') ?></td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-6 grid-margin stretch-card">
        <div class="card card-shell">
            <div class="card-body">
                <h4 class="section-title">CMS & Pricing Coverage</h4>
                <p class="section-copy mb-3">Ringkasan modul inti yang memengaruhi citra brand dan kelengkapan funnel bisnis.</p>

                <div class="d-flex justify-content-between align-items-center border rounded-4 p-3 mb-3">
                    <div>
                        <div class="fw-semibold">Total halaman CMS</div>
                        <div class="text-muted small">Termasuk privacy policy, terms, dan halaman tambahan.</div>
                    </div>
                    <div class="h4 mb-0"><?= esc((string) count($pages)) ?></div>
                </div>

                <div class="d-flex justify-content-between align-items-center border rounded-4 p-3 mb-3">
                    <div>
                        <div class="fw-semibold">Paket pricing tersedia</div>
                        <div class="text-muted small">Jumlah katalog yang bisa langsung dijual atau ditawarkan.</div>
                    </div>
                    <div class="h4 mb-0"><?= esc((string) count($packages)) ?></div>
                </div>

                <div class="d-flex justify-content-between align-items-center border rounded-4 p-3">
                    <div>
                        <div class="fw-semibold">Role pengguna terpetakan</div>
                        <div class="text-muted small">Mencerminkan seberapa rapi governance tim internal.</div>
                    </div>
                    <div class="h4 mb-0"><?= esc((string) count($data['roleCounts'] ?? [])) ?></div>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
