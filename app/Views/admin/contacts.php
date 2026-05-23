<?= $this->extend('admin/layout') ?>

<?= $this->section('content') ?>
<?php $summary = $summary ?? ['total' => 0, 'tagged' => 0]; $contacts = $contacts ?? []; ?>
<div class="row">
    <div class="col-md-6 grid-margin stretch-card"><div class="card card-shell"><div class="card-body"><p class="text-muted mb-2">Total Contacts</p><h3><?= esc((string) $summary['total']) ?></h3><p class="small text-muted mb-0">Seluruh nomor yang tersimpan di tenant.</p></div></div></div>
    <div class="col-md-6 grid-margin stretch-card"><div class="card card-shell"><div class="card-body"><p class="text-muted mb-2">Tagged Contacts</p><h3><?= esc((string) $summary['tagged']) ?></h3><p class="small text-muted mb-0">Kontak yang sudah memiliki segmentasi atau tag.</p></div></div></div>
</div>
<div class="card card-shell-table"><div class="card-body"><h4 class="section-title">Tenant Contacts</h4><p class="section-copy mb-3">Lihat kualitas data kontak untuk kebutuhan campaign dan follow-up.</p><div class="table-responsive"><table class="table table-hover mb-0"><thead><tr><th>Name</th><th>Tenant</th><th>Phone</th><th>Tags</th><th>Created</th></tr></thead><tbody><?php if ($contacts === []): ?><tr><td colspan="5" class="text-center text-muted py-4">Belum ada data kontak.</td></tr><?php endif; ?><?php foreach ($contacts as $row): ?><tr><td><strong><?= esc($row['contact_name']) ?></strong></td><td><?= esc($row['tenant_name'] ?: '-') ?></td><td><?= esc($row['phone_number']) ?></td><td><?= esc($row['tags'] ?: '-') ?></td><td><?= esc($row['created_at'] ?: '-') ?></td></tr><?php endforeach; ?></tbody></table></div></div></div>
<?= $this->endSection() ?>
