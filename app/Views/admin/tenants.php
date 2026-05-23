<?= $this->extend('admin/layout') ?>

<?= $this->section('content') ?>

<?php
$summary = $summary ?? ['total' => 0, 'active' => 0, 'inactive' => 0, 'suspended' => 0];
$tenants = $tenants ?? [];
?>

<div class="row">
    <div class="col-md-6 col-xl-3 grid-margin stretch-card">
        <div class="card card-shell">
            <div class="card-body">
                <p class="text-muted mb-2">Total Tenant</p>
                <h3 class="mb-1"><?= esc((string) $summary['total']) ?></h3>
                <p class="small text-muted mb-0">Seluruh customer organisasi yang tercatat di sistem.</p>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-xl-3 grid-margin stretch-card">
        <div class="card card-shell">
            <div class="card-body">
                <p class="text-muted mb-2">Active</p>
                <h3 class="mb-1"><?= esc((string) $summary['active']) ?></h3>
                <p class="small text-muted mb-0">Tenant siap dilayani dan berpotensi menjadi sumber growth.</p>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-xl-3 grid-margin stretch-card">
        <div class="card card-shell">
            <div class="card-body">
                <p class="text-muted mb-2">Inactive</p>
                <h3 class="mb-1"><?= esc((string) $summary['inactive']) ?></h3>
                <p class="small text-muted mb-0">Tenant yang perlu campaign reactivation atau onboarding ulang.</p>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-xl-3 grid-margin stretch-card">
        <div class="card card-shell">
            <div class="card-body">
                <p class="text-muted mb-2">Suspended</p>
                <h3 class="mb-1"><?= esc((string) $summary['suspended']) ?></h3>
                <p class="small text-muted mb-0">Akun bermasalah yang berpotensi menambah risiko operasional.</p>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12 grid-margin stretch-card">
        <div class="card card-shell-table">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <div>
                        <h4 class="section-title">Tenant Operations Board</h4>
                        <p class="section-copy">Owner dapat melihat kualitas aktivasi tenant dari instance yang online, volume queue, serta aset kontak dan portofolio yang dikelola.</p>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead>
                        <tr>
                            <th>Tenant</th>
                            <th>Status</th>
                            <th>WA Health</th>
                            <th>Contacts</th>
                            <th>Portfolios</th>
                            <th>Queues</th>
                            <th>Failed</th>
                            <th>Created</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php if ($tenants === []): ?>
                            <tr>
                                <td colspan="8" class="text-center text-muted py-4">Belum ada tenant tersedia.</td>
                            </tr>
                        <?php endif; ?>
                        <?php foreach ($tenants as $tenant): ?>
                            <?php
                            $status = (string) ($tenant['status'] ?? 'inactive');
                            $statusTone = $status === 'active' ? 'success' : ($status === 'suspended' ? 'danger' : 'warning');
                            ?>
                            <tr>
                                <td>
                                    <strong><?= esc($tenant['owner_name'] ?? 'Tenant') ?></strong>
                                    <div class="text-muted small"><?= esc($tenant['email'] ?? '-') ?></div>
                                </td>
                                <td><span class="badge badge-opacity-<?= esc($statusTone) ?>"><?= esc(ucfirst($status)) ?></span></td>
                                <td>
                                    <span class="badge badge-opacity-primary"><?= esc((string) ($tenant['open_instances'] ?? 0)) ?>/<?= esc((string) ($tenant['total_instances'] ?? 0)) ?> open</span>
                                </td>
                                <td><?= esc((string) ($tenant['total_contacts'] ?? 0)) ?></td>
                                <td><?= esc((string) ($tenant['total_portfolios'] ?? 0)) ?></td>
                                <td><?= esc((string) ($tenant['total_queues'] ?? 0)) ?></td>
                                <td><?= esc((string) ($tenant['failed_queues'] ?? 0)) ?></td>
                                <td><?= esc($tenant['created_at'] ?? '-') ?></td>
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
