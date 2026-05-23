<?php

namespace Modules\Portfolio\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\Exceptions\PageNotFoundException;

class Portfolio extends BaseController
{
    /**
     * Kode disetup khusus MOCK DATA untuk memberikan preview UI di browser
     * sehingga aplikasi tidak crash jika Anda belum menjalankan php spark migrate
     * dan belum memiliki table di MySQL.
     */
    public function index($tenantIdentifier = 'demo')
    {
        $tenant = new \stdClass();
        $tenant->owner_name = ucfirst($tenantIdentifier) . ' Digital Tech.';

        $data = [
            'tenantIdentifier' => $tenantIdentifier,
            'tenant' => $tenant,
            'portfolios' => $this->getMockPortfolios(),
        ];

        return view('\Modules\Portfolio\Views\index', $data);
    }

    public function detail($tenantIdentifier = 'demo', $slug = null)
    {
        $tenant = new \stdClass();
        $tenant->owner_name = ucfirst($tenantIdentifier) . ' Digital Tech.';

        $portfolios = $this->getMockPortfolios();

        if (empty($slug) || ! isset($portfolios[$slug])) {
            throw PageNotFoundException::forPageNotFound('Portfolio item tidak ditemukan');
        }

        $data = [
            'tenantIdentifier' => $tenantIdentifier,
            'tenant' => $tenant,
            'portfolio' => $portfolios[$slug],
        ];

        return view('\Modules\Portfolio\Views\detail', $data);
    }

    private function getMockPortfolios(): array
    {
        $item1 = new \stdClass();
        $item1->slug = 'enterprise-erp-dashboard';
        $item1->category = 'Enterprise Software';
        $item1->title = 'Enterprise ERP Dashboard';
        $item1->description = 'Sistem manajemen resource terpusat dirancang untuk industri manufaktur skala menengah dengan integrasi API pihak ketiga.';
        $item1->overview = 'Platform ERP ini membantu tim operasi, keuangan, dan produksi mendapatkan visibilitas penuh atas ketersediaan material, jadwal produksi, serta laporan real-time yang dapat diekspor.';
        $item1->preview_image = '/assets/images/portfolio/erp-dashboard-preview.png';
        $item1->tech_stack = ['CodeIgniter 4', 'PostgreSQL', 'Bootstrap 5', 'REST API'];
        $item1->features = [
            'Dasbor multi-tenant untuk operasi dan eksekutif',
            'Integrasi data inventory, HR, dan keuangan',
            'Laporan real-time dan export CSV',
            'Akses responsif untuk desktop dan tablet',
        ];
        $item1->client = 'PT. Cipta Solusi Industri';
        $item1->year = '2025';
        $item1->challenge = 'Menyatukan data inventory, HR, dan keuangan dalam satu dasbor yang mudah digunakan oleh manajer lini dan tim eksekutif.';
        $item1->solution = 'Membangun modul ERP dengan arsitektur multi-tenant, integrasi API pihak ketiga, dan dasbor analitik yang responsif untuk desktop dan tablet.';
        $item1->results = 'Pengurangan waktu laporan 65%, penurunan order backlog 28%, dan peningkatan akurasi persediaan sampai 99.3%.';
        $item1->demo_url = '#';

        $item2 = new \stdClass();
        $item2->slug = 'laundry-pos-app';
        $item2->category = 'Mobile & POS';
        $item2->title = 'Laundry Point-of-Sale App';
        $item2->description = 'Aplikasi operasi internal untuk melacak pesanan cuci dengan fitur notifikasi otomatis ke nasabah via WhatsApp gateway.';
        $item2->overview = 'Solusi mobile untuk pemilik usaha laundry yang membutuhkan alur kerja cepat, pembayaran digital, dan pelacakan status order secara real-time.';
        $item2->preview_image = '/assets/images/portfolio/laundry-pos-preview.png';
        $item2->tech_stack = ['Flutter', 'Dart', 'Firebase', 'WhatsApp API'];
        $item2->features = [
            'Point-of-sale cepat untuk transaksi laundry',
            'Manajemen order otomatis dengan status real-time',
            'Notifikasi WhatsApp untuk pelanggan',
            'Integrasi pembayaran digital dan barcode scan',
        ];
        $item2->client = 'Laundry Pro Express';
        $item2->year = '2024';
        $item2->challenge = 'Mengelola transaksi manual dan memastikan pelanggan mendapat notifikasi ketika cucian selesai.';
        $item2->solution = 'Mendesain aplikasi POS dengan fitur scan barcode, manajemen order, dan otomatisasi pesan WhatsApp untuk pemberitahuan status layanan.';
        $item2->results = 'Meningkatkan efisiensi layanan 40% dan mengurangi komplain pelanggan hingga 18%.';
        $item2->demo_url = '#';

        $item3 = new \stdClass();
        $item3->slug = 'medical-analytics-portal';
        $item3->category = 'Analytics & Healthcare';
        $item3->title = 'Medical Analytics Portal';
        $item3->description = 'Papan kendali intelijen bisnis yang mengakumulasi dan memvisualisasikan data rekam medis secara real-time untuk rumah sakit.';
        $item3->overview = 'Portal analitik untuk membantu rumah sakit memantau tren pasien, kapasitas ranjang, dan kinerja klinis menggunakan visualisasi yang mudah dicerna.';
        $item3->preview_image = '/assets/images/portfolio/medical-analytics-preview.png';
        $item3->tech_stack = ['Vue.js', 'TailwindCSS', 'Laravel', 'Chart.js'];
        $item3->features = [
            'Visualisasi KPI rumah sakit yang dapat disesuaikan',
            'Integrasi ETL data klinis dari sistem terpisah',
            'Laporan kapasitas ranjang dan tren pasien',
            'Kontrol akses departemen untuk keamanan data',
        ];
        $item3->client = 'RS Sehat Sentosa';
        $item3->year = '2025';
        $item3->challenge = 'Mengintegrasikan data klinis dari sistem berbeda menjadi satu laporan real-time yang dapat diakses oleh manajemen dan staf medis.';
        $item3->solution = 'Mengembangkan portal dengan ETL data, visualisasi KPI, dan kontrol akses per-departemen untuk keamanan informasi pasien.';
        $item3->results = 'Waktu analisis turun sampai 80% dan presentasi KPI menjadi 100% digital sehingga mendukung pengambilan keputusan lebih cepat.';
        $item3->demo_url = '#';

        return [
            $item1->slug => $item1,
            $item2->slug => $item2,
            $item3->slug => $item3,
        ];
    }
}
