<?= $this->extend('admin/layout') ?>

<?= $this->section('content') ?>
<?php $summary = $summary ?? ['total' => 0, 'pending' => 0, 'sent' => 0, 'failed' => 0]; $queues = $queues ?? []; ?>
<div class="row">
    <div class="col-md-3 grid-margin stretch-card"><div class="card card-shell"><div class="card-body"><p class="text-muted mb-2">Total Queue</p><h3><?= esc((string) $summary['total']) ?></h3></div></div></div>
    <div class="col-md-3 grid-margin stretch-card"><div class="card card-shell"><div class="card-body"><p class="text-muted mb-2">Pending</p><h3><?= esc((string) $summary['pending']) ?></h3></div></div></div>
    <div class="col-md-3 grid-margin stretch-card"><div class="card card-shell"><div class="card-body"><p class="text-muted mb-2">Sent</p><h3><?= esc((string) $summary['sent']) ?></h3></div></div></div>
    <div class="col-md-3 grid-margin stretch-card"><div class="card card-shell"><div class="card-body"><p class="text-muted mb-2">Failed</p><h3><?= esc((string) $summary['failed']) ?></h3></div></div></div>
</div>
<div class="card card-shell-table"><div class="card-body"><h4 class="section-title">Message Queue</h4><p class="section-copy mb-3">Tabel operasional pesan untuk memantau delivery pipeline tenant.</p><div class="table-responsive"><table class="table table-hover mb-0"><thead><tr><th>Tenant</th><th>Instance</th><th>Receiver</th><th>Status</th><th>Scheduled</th><th>Error</th></tr></thead><tbody><?php if ($queues === []): ?><tr><td colspan="6" class="text-center text-muted py-4">Belum ada data queue.</td></tr><?php endif; ?><?php foreach ($queues as $row): ?><tr><td><?= esc($row['tenant_name'] ?: '-') ?></td><td><?= esc($row['instance_name'] ?: '-') ?></td><td><?= esc($row['receiver_number']) ?></td><td><span class="badge badge-opacity-<?= ($row['status'] ?? '') === 'sent' ? 'success' : ((($row['status'] ?? '') === 'failed') ? 'danger' : 'warning') ?>"><?= esc($row['status']) ?></span></td><td><?= esc($row['scheduled_at'] ?: '-') ?></td><td><?= esc($row['error_reason'] ?: '-') ?></td></tr><?php endforeach; ?></tbody></table></div></div></div>
<?= $this->endSection() ?>
