<?= $this->extend('Modules\Core\Views\layout') ?>

<?= $this->section('content') ?>
<div class="d-flex justify-content-between align-items-center mb-4">
    <h3 class="mb-0 fw-bold" style="letter-spacing: -0.02em;">Dashboard Overview</h3>
    <div>
        <button class="btn btn-outline-secondary btn-sm me-2 fw-medium"><i class="bi bi-calendar3 me-1"></i> Last 30 Days</button>
    </div>
</div>

<!-- Stats Cards -->
<div class="row g-4 mb-5">
    <!-- Stat 1 -->
    <div class="col-md-4">
        <div class="card p-4">
            <div class="stat-label mb-3">Total Pesan Terkirim</div>
            <div class="d-flex align-items-baseline gap-2">
                <div class="stat-value">24,592</div>
            </div>
            <div class="mt-2 text-success" style="font-size: 0.875rem; font-weight: 500;">
                <i class="bi bi-arrow-up-right me-1"></i> 12.5% dari bulan lalu
            </div>
        </div>
    </div>
    <!-- Stat 2 -->
    <div class="col-md-4">
        <div class="card p-4">
            <div class="stat-label mb-3">Sisa Kuota Blast</div>
            <div class="d-flex align-items-baseline gap-2">
                <div class="stat-value">75,408</div>
            </div>
            <div class="mt-2 text-muted" style="font-size: 0.875rem; font-weight: 500;">
                Kapasitas maksimal 100K pesan
            </div>
        </div>
    </div>
    <!-- Stat 3 -->
    <div class="col-md-4">
        <div class="card p-4">
            <div class="stat-label mb-3">Device Aktif</div>
            <div class="d-flex align-items-baseline gap-2">
                <div class="stat-value">3</div>
            </div>
            <div class="mt-2 text-muted" style="font-size: 0.875rem; font-weight: 500;">
                Maksimal 5 instance terdaftar
            </div>
        </div>
    </div>
</div>

<!-- Table Area -->
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center py-3">
        <h6 class="mb-0 fw-semibold text-dark">Recent Campaign Activity</h6>
        <a href="#" class="text-decoration-none text-primary" style="font-size: 0.875rem; font-weight: 500;">View All Reports &rarr;</a>
    </div>
    <div class="card-body p-0">
        <table class="table mb-0">
            <thead>
                <tr>
                    <th class="ps-4">Campaign Name</th>
                    <th>Status</th>
                    <th>Progress</th>
                    <th class="pe-4">Scheduled Date</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="ps-4 text-dark fw-medium" style="font-size: 0.95rem;">Promo Ramadhan 2026</td>
                    <td><span class="badge bg-success-subtle">Completed</span></td>
                    <td class="text-muted" style="font-size: 0.9rem;">4,500 / 4,500</td>
                    <td class="text-muted pe-4" style="font-size: 0.9rem;">Today, 14:00</td>
                </tr>
                <tr>
                    <td class="ps-4 text-dark fw-medium" style="font-size: 0.95rem;">Reminder Keranjang Belanja</td>
                    <td><span class="badge bg-warning-subtle">Processing</span></td>
                    <td class="text-muted" style="font-size: 0.9rem;">1,200 / 5,000</td>
                    <td class="text-muted pe-4" style="font-size: 0.9rem;">Today, 09:30</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
<?= $this->endSection() ?>
