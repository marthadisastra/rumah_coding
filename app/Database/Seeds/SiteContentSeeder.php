<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class SiteContentSeeder extends Seeder
{
    public function run()
    {
        $pages = [
            [
                'page_key'       => 'privacy_policy',
                'lang'           => 'id',
                'title'          => 'Kebijakan Privasi',
                'effective_date' => '2026-05-01',
                'body'           => '<p>Rumah Coding memprioritaskan keamanan dan kerahasiaan data Anda. Kebijakan Privasi ini disusun berdasarkan Undang-Undang No. 27 Tahun 2022 tentang Pelindungan Data Pribadi (UU PDP) Republik Indonesia.</p>

<h2>1. Pengumpulan Data Pribadi</h2>
<p>Kami hanya mengumpulkan data yang esensial untuk penyediaan kelancaran operasional layanan infrastruktur SaaS. Data yang dikumpulkan meliputi: nama entitas perusahaan, alamat email korporat, kelengkapan informasi penagihan, kredensial konfigurasi sesi WhatsApp, dan rekam jejak aktivitas (log) akses sistem untuk audit internal.</p>

<h2>2. Peruntukan dan Pemrosesan Data</h2>
<p>Infrastruktur kami bertindak sebagai medium transit bagi paket data transmisi pesan. Isi pesan transmisi diproses secara terenkripsi hanya untuk dieksekusi menuju destinasi endpoint WhatsApp resmi milik Penyewa. <strong>Kami sama sekali tidak membaca, mengeksploitasi, maupun memperjualbelikan isi teks kampanye Anda kepada pihak ketiga manapun.</strong></p>

<h2>3. Pengamanan Basis Data</h2>
<p>Seluruh jalur transmisi diwajibkan melewati konfigurasi aman terenkripsi standar perbankan (HTTPS TLS dan WSS). Dalam level basis data, privasi diisolasi dengan teknik Row-Level Security Structure demi menghalau percampuran indeks atau intervensi parsial antar-Klien.</p>

<h2>4. Hak Peniadaan & Penghapusan Data</h2>
<p>Sebagai instrumen kepatuhan terhadap hak subjek UU PDP, pihak perusahaan berhak mengajukan permohonan perbaikan (audit) maupun permintaan pemusnahan total (<em>Right to Erasure</em>) seluruh data yang tersimpan di server produksi kami. Pengajuan dapat dilayangkan melalui surel: <em>privacy@rumahcoding.com</em>.</p>',
                'updated_at'     => date('Y-m-d H:i:s'),
            ],
            [
                'page_key'       => 'terms_of_service',
                'lang'           => 'id',
                'title'          => 'Syarat dan Ketentuan Layanan',
                'effective_date' => '2026-05-01',
                'body'           => '<p>Dengan melakukan registrasi dan memanfaatkan alur koneksi API pada layanan SaaS Rumah Coding, Anda selaku Klien ("Penyewa") sepakat dan tunduk secara penuh atas klausul Syarat dan Ketentuan berikut.</p>

<h2>1. Kepatuhan Penggunaan Penyiaran Elektronik (UU ITE)</h2>
<p>Seluruh entitas operasi layanan transmisi ini diatur selaras mengikuti konstitusi Republik Indonesia, terutama Undang-Undang No. 19 Tahun 2016 tentang Informasi dan Transaksi Elektronik (UU ITE). Klien dilarang keras menggunakan saluran sistem kami untuk pengiriman bermuatan pesan asusila, intimidasi, terorisme, perjudian daring terlarang, penipuan (scam/phishing), atau tindakan ilegal lainnya. Pelanggaran atas klausul ini membuahkan sanksi instan berupa terminasi akses layanan tanpa hak arbitrase ganti rugi.</p>

<h2>2. Ketentuan Integrasi Pihak Meta & WhatsApp LLC</h2>
<p>Layanan Rumah Coding merupakan solusi B2B agnostik yang sama sekali bukan produk turunan kepemilikan Meta Platforms, Inc. atau WhatsApp LLC. Kemungkinan pemblokiran koneksi nomor akibat keluhan anti-Spam dari komunitas merupakan di luar ranah garansi kami. Proses verifikasi ulang (un-ban) berada dalam kendali masing-masing organisasi Klien.</p>

<h2>3. Service Level Agreement (SLA)</h2>
<p>Platform Rumah Coding dikembangkan untuk menjaga standar reliabilitas server awan 99%. Tagihan sewa berlangganan ditagihkan dengan prinsip siklus perpanjangan prabayar per bulan.</p>

<h2>4. Kebijakan Penggunaan Adil (Fair Usage Policy)</h2>
<p>Kampanye berulang harus menghormati parameter kecepatan (throttle bandwidth sistem dengan interval tertunda) demi menjaga stabilitas node konektivitas bersama. Eksploitasi di luar batas wajar API Gateway kami akan dikunci secara otomatis oleh sistem secara preventif.</p>',
                'updated_at'     => date('Y-m-d H:i:s'),
            ],
        ];

        $this->db->table('site_content')->insertBatch($pages);
    }
}
