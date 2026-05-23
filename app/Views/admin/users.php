<?= $this->extend('admin/layout') ?>

<?= $this->section('content') ?>

<?php
$summary = $summary ?? ['total' => 0, 'active' => 0, 'inactive' => 0, 'withRole' => 0];
$roleCounts = $roleCounts ?? [];
$users = $users ?? [];
?>

<div class="row">
    <div class="col-md-6 col-xl-3 grid-margin stretch-card">
        <div class="card card-shell">
            <div class="card-body">
                <p class="text-muted mb-2">Total Users</p>
                <h3 class="mb-1"><?= esc((string) $summary['total']) ?></h3>
                <p class="small text-muted mb-0">Semua akun internal yang dapat mengakses platform.</p>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-xl-3 grid-margin stretch-card">
        <div class="card card-shell">
            <div class="card-body">
                <p class="text-muted mb-2">Akun Active</p>
                <h3 class="mb-1"><?= esc((string) $summary['active']) ?></h3>
                <p class="small text-muted mb-0">Akun yang masih diizinkan beroperasi.</p>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-xl-3 grid-margin stretch-card">
        <div class="card card-shell">
            <div class="card-body">
                <p class="text-muted mb-2">Akun Inactive</p>
                <h3 class="mb-1"><?= esc((string) $summary['inactive']) ?></h3>
                <p class="small text-muted mb-0">Perlu ditinjau untuk clean-up akses atau reaktivasi.</p>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-xl-3 grid-margin stretch-card">
        <div class="card card-shell">
            <div class="card-body">
                <p class="text-muted mb-2">Role Assigned</p>
                <h3 class="mb-1"><?= esc((string) $summary['withRole']) ?></h3>
                <p class="small text-muted mb-0">Akun dengan tanggung jawab yang sudah dipetakan.</p>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-xl-4 grid-margin stretch-card">
        <div class="card card-shell">
            <div class="card-body">
                <h4 class="section-title">Governance Snapshot</h4>
                <p class="section-copy mb-3">Owner dapat melihat apakah tim internal sudah memiliki distribusi role yang cukup sehat.</p>
                <?php if ($roleCounts === []): ?>
                    <div class="text-muted small">Belum ada role pengguna yang terdaftar.</div>
                <?php endif; ?>
                <?php foreach ($roleCounts as $role => $count): ?>
                    <div class="d-flex justify-content-between align-items-center border rounded-4 p-3 mb-3">
                        <div>
                            <div class="fw-semibold"><?= esc($role === 'unknown' ? 'Unassigned' : ucfirst($role)) ?></div>
                            <div class="text-muted small">Distribusi kewenangan untuk role ini.</div>
                        </div>
                        <span class="badge badge-opacity-primary"><?= esc((string) $count) ?></span>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>

    <div class="col-xl-8 grid-margin stretch-card">
        <div class="card card-shell-table">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <div>
                        <h4 class="section-title">User Governance Table</h4>
                        <p class="section-copy">Audit singkat identitas, role, dan status akun untuk kebutuhan kontrol akses.</p>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Status</th>
                            <th>Created</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php if ($users === []): ?>
                            <tr>
                                <td colspan="5" class="text-center text-muted py-4">Belum ada user internal terdaftar.</td>
                            </tr>
                        <?php endif; ?>
                        <?php foreach ($users as $user): ?>
                            <tr>
                                <td>
                                    <strong><?= esc($user['name'] ?: 'Tanpa Nama') ?></strong>
                                </td>
                                <td><?= esc($user['email']) ?></td>
                                <td><span class="badge badge-opacity-info"><?= esc($user['role_label']) ?></span></td>
                                <td>
                                    <span class="badge badge-opacity-<?= $user['status_label'] === 'Active' ? 'success' : 'warning' ?>">
                                        <?= esc($user['status_label']) ?>
                                    </span>
                                </td>
                                <td><?= esc($user['created_at'] ?? '-') ?></td>
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
