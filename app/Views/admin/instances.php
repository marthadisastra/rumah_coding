<?= $this->extend('admin/layout') ?>

<?= $this->section('content') ?>
<?php $summary = $summary ?? ['total' => 0, 'open' => 0, 'connecting' => 0, 'problem' => 0]; $instances = $instances ?? []; ?>
<div class="row">
    <div class="col-md-3 grid-margin stretch-card"><div class="card card-shell"><div class="card-body"><p class="text-muted mb-2">Total</p><h3><?= esc((string) $summary['total']) ?></h3></div></div></div>
    <div class="col-md-3 grid-margin stretch-card"><div class="card card-shell"><div class="card-body"><p class="text-muted mb-2">Open</p><h3><?= esc((string) $summary['open']) ?></h3></div></div></div>
    <div class="col-md-3 grid-margin stretch-card"><div class="card card-shell"><div class="card-body"><p class="text-muted mb-2">Connecting</p><h3><?= esc((string) $summary['connecting']) ?></h3></div></div></div>
    <div class="col-md-3 grid-margin stretch-card"><div class="card card-shell"><div class="card-body"><p class="text-muted mb-2">Need Action</p><h3><?= esc((string) $summary['problem']) ?></h3></div></div></div>
</div>
<div class="card card-shell-table"><div class="card-body"><h4 class="section-title">Tenant Instances</h4><p class="section-copy mb-3">Pantau kesehatan koneksi WA tiap tenant.</p><div class="table-responsive"><table class="table table-hover mb-0"><thead><tr><th>Instance</th><th>Tenant</th><th>Phone</th><th>Status</th><th>Updated</th></tr></thead><tbody><?php if ($instances === []): ?><tr><td colspan="5" class="text-center text-muted py-4">Belum ada data instance.</td></tr><?php endif; ?><?php foreach ($instances as $row): ?><tr><td><strong><?= esc($row['instance_name']) ?></strong></td><td><?= esc($row['tenant_name'] ?: '-') ?></td><td><?= esc($row['phone_number'] ?: '-') ?></td><td><span class="badge badge-opacity-<?= ($row['connection_status'] ?? '') === 'open' ? 'success' : ((($row['connection_status'] ?? '') === 'connecting') ? 'warning' : 'danger') ?>"><?= esc($row['connection_status'] ?: '-') ?></span></td><td><?= esc($row['updated_at'] ?: $row['created_at']) ?></td></tr><?php endforeach; ?></tbody></table></div></div></div>
<?= $this->endSection() ?>
