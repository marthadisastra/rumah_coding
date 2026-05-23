<?= $this->extend('Modules\Core\Views\layout') ?>

<?= $this->section('content') ?>
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h3 class="mb-1 fw-bold" style="letter-spacing: -0.02em;">WhatsApp Instances</h3>
        <p class="text-muted mb-0" style="font-size: 0.875rem;">Kelola device / nomor WhatsApp penghubung server ke Evolution API.</p>
    </div>
    <button class="btn btn-primary fw-medium"><i class="bi bi-plus-lg me-1"></i> Add New Device</button>
</div>

<!-- Minimalist DataTables Style Table View -->
<div class="card">
    <div class="card-header border-bottom-0 pb-0 pt-3 bg-white d-flex justify-content-between align-items-center">
        <div style="width: 250px;">
            <input type="text" class="form-control form-control-sm border-secondary-subtle" placeholder="Search resources...">
        </div>
        <div class="text-muted" style="font-size: 0.875rem;">Showing 2 results</div>
    </div>
    <div class="card-body p-0 mt-3">
        <table class="table align-middle mb-0">
            <thead>
                <tr>
                    <th class="ps-4">Instance Name</th>
                    <th>Phone Number</th>
                    <th>Status</th>
                    <th class="text-end pe-4">Actions</th>
                </tr>
            </thead>
            <tbody>
                <!-- Row 1 -->
                <tr>
                    <td class="ps-4">
                        <div class="fw-medium text-dark" style="font-size: 0.95rem;">CS Pusat Jakarta</div>
                        <div class="text-muted" style="font-size: 0.8rem; font-family: monospace;">UUID-8X2A-99B</div>
                    </td>
                    <td class="text-muted" style="font-size: 0.95rem;">+62 812-3456-7890</td>
                    <td><span class="badge bg-success-subtle">Connected</span></td>
                    <td class="text-end pe-4">
                        <button class="btn btn-sm btn-outline-secondary me-1" title="Resync Connection"><i class="bi bi-arrow-repeat"></i></button>
                        <button class="btn btn-sm btn-outline-secondary text-danger" title="Delete Instance"><i class="bi bi-trash"></i></button>
                    </td>
                </tr>
                <!-- Row 2 -->
                <tr>
                    <td class="ps-4">
                        <div class="fw-medium text-dark" style="font-size: 0.95rem;">CS Cabang Bali</div>
                        <div class="text-muted" style="font-size: 0.8rem; font-family: monospace;">UUID-3M1C-77X</div>
                    </td>
                    <td class="text-muted" style="font-size: 0.95rem;">—</td>
                    <td><span class="badge bg-secondary-subtle">Disconnected</span></td>
                    <td class="text-end pe-4">
                        <button class="btn btn-sm btn-outline-secondary me-1" title="Scan QR Code"><i class="bi bi-qr-code"></i></button>
                        <button class="btn btn-sm btn-outline-secondary text-danger" title="Delete Instance"><i class="bi bi-trash"></i></button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<!-- Empty State (Uncomment to render testing) -->
<!--
<div class="card text-center py-5 mt-4">
    <div class="d-flex justify-content-center mb-3">
        <div class="rounded-circle d-flex align-items-center justify-content-center" style="width: 48px; height: 48px; background-color: #f1f5f9; border: 1px solid #e2e8f0;">
            <i class="bi bi-hdd-network text-muted fs-5"></i>
        </div>
    </div>
    <h5 class="fw-bold text-dark mb-1">No instances found</h5>
    <p class="text-muted mb-4" style="font-size: 0.9rem; max-width: 400px; margin: 0 auto;">Anda belum menghubungkan nomor WhatsApp ke engine. Tambahkan device pertama Anda untuk memulai pengiriman pesan.</p>
    <div>
        <button class="btn btn-primary fw-medium"><i class="bi bi-plus-lg me-1"></i> Add New Device</button>
    </div>
</div>
-->
<?= $this->endSection() ?>
