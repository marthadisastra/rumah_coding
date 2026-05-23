<?php

namespace App\Libraries;

use CodeIgniter\Database\BaseConnection;
use Throwable;

class AdminPanelService
{
    public function __construct(private readonly BaseConnection $db)
    {
    }

    public function getShellMetrics(): array
    {
        $counts = [
            'tenants' => $this->count('tenants'),
            'users' => $this->count('users'),
            'content' => $this->count('site_content'),
            'packages' => $this->count('pricing_packages'),
            'instances' => $this->count('wa_instances'),
            'queues' => $this->count('message_queues'),
            'portfolios' => $this->count('portfolios'),
            'contacts' => $this->count('contacts'),
        ];

        return [
            'counts' => $counts,
            'pendingQueues' => $this->countWhere('message_queues', ['status' => 'pending']),
            'failedQueues' => $this->countWhere('message_queues', ['status' => 'failed']),
            'openInstances' => $this->countWhere('wa_instances', ['connection_status' => 'open']),
            'activeTenants' => $this->countWhere('tenants', ['status' => 'active']),
        ];
    }

    public function getDashboardData(): array
    {
        $counts = [
            'tenants' => $this->count('tenants'),
            'users' => $this->count('users'),
            'instances' => $this->count('wa_instances'),
            'contacts' => $this->count('contacts'),
            'queues' => $this->count('message_queues'),
            'portfolios' => $this->count('portfolios'),
            'content' => $this->count('site_content'),
            'packages' => $this->count('pricing_packages'),
        ];

        $tenantStatuses = $this->groupCount('tenants', 'status', ['active', 'inactive', 'suspended']);
        $instanceStatuses = $this->groupCount('wa_instances', 'connection_status', ['open', 'connecting', 'qrcode', 'close']);
        $queueStatuses = $this->groupCount('message_queues', 'status', ['pending', 'processing', 'sent', 'failed']);
        $roleCounts = $this->groupCount('users', 'role');

        $activePackages = $this->getActivePackages();
        $pricingInsights = $this->getPricingInsights($activePackages);
        $cmsFreshness = $this->getCmsFreshness();

        $alerts = [];
        if (($queueStatuses['failed'] ?? 0) > 0) {
            $alerts[] = [
                'tone' => 'danger',
                'title' => 'Queue pesan gagal perlu perhatian',
                'body' => ($queueStatuses['failed'] ?? 0) . ' pesan berada pada status failed dan perlu investigasi retry atau kualitas koneksi instance.',
            ];
        }
        if (($instanceStatuses['close'] ?? 0) > 0) {
            $alerts[] = [
                'tone' => 'warning',
                'title' => 'Sebagian instance WhatsApp belum online',
                'body' => ($instanceStatuses['close'] ?? 0) . ' instance masih berstatus close. Ini berisiko menahan aktivasi tenant dan delivery message.',
            ];
        }
        if (($cmsFreshness['staleCount'] ?? 0) > 0) {
            $alerts[] = [
                'tone' => 'info',
                'title' => 'Konten hukum/CMS perlu review berkala',
                'body' => ($cmsFreshness['staleCount'] ?? 0) . ' halaman belum diperbarui lebih dari 30 hari sehingga baik untuk dijadwalkan review kepatuhan.',
            ];
        }

        if ($alerts === []) {
            $alerts[] = [
                'tone' => 'success',
                'title' => 'Tidak ada alert operasional kritikal',
                'body' => 'Data inti admin panel saat ini tidak menunjukkan bottleneck besar pada tenant, instance, maupun pipeline pesan.',
            ];
        }

        $estimatedHealthScore = 100;
        $estimatedHealthScore -= min(30, (int) (($queueStatuses['failed'] ?? 0) * 6));
        $estimatedHealthScore -= min(25, (int) (($instanceStatuses['close'] ?? 0) * 5));
        $estimatedHealthScore -= min(20, (int) (($tenantStatuses['suspended'] ?? 0) * 7));
        $estimatedHealthScore = max(32, $estimatedHealthScore);

        return [
            'kpis' => [
                [
                    'label' => 'Tenant Aktif',
                    'value' => number_format((int) ($tenantStatuses['active'] ?? 0)),
                    'meta' => number_format($counts['tenants']) . ' total tenant',
                    'icon' => 'typcn-group',
                    'tone' => 'primary',
                ],
                [
                    'label' => 'WA Instance Online',
                    'value' => number_format((int) ($instanceStatuses['open'] ?? 0)),
                    'meta' => number_format($counts['instances']) . ' instance terdaftar',
                    'icon' => 'typcn-wi-fi',
                    'tone' => 'success',
                ],
                [
                    'label' => 'Queue Menunggu',
                    'value' => number_format((int) ($queueStatuses['pending'] ?? 0)),
                    'meta' => number_format((int) ($queueStatuses['failed'] ?? 0)) . ' failed queue',
                    'icon' => 'typcn-time',
                    'tone' => 'warning',
                ],
                [
                    'label' => 'Konten CMS',
                    'value' => number_format($counts['content']),
                    'meta' => number_format($cmsFreshness['freshCount']) . ' halaman masih fresh',
                    'icon' => 'typcn-document-text',
                    'tone' => 'info',
                ],
            ],
            'tenantStatuses' => $tenantStatuses,
            'instanceStatuses' => $instanceStatuses,
            'queueStatuses' => $queueStatuses,
            'roleCounts' => $roleCounts,
            'counts' => $counts,
            'activePackages' => $activePackages,
            'pricingInsights' => $pricingInsights,
            'cmsFreshness' => $cmsFreshness,
            'recentContent' => $this->recentContent(),
            'topTenants' => $this->topTenants(),
            'alerts' => $alerts,
            'healthScore' => $estimatedHealthScore,
            'decisionNotes' => [
                'Owner dapat membaca kesiapan scale tenant dari perbandingan tenant aktif, instance online, dan volume queue yang menunggu.',
                'Portofolio dan kontak memberi sinyal seberapa matang tenant memakai ekosistem Rumah Coding di luar sekadar aktivasi akun.',
                'Harga paket aktif dan komposisinya menampilkan kesiapan monetisasi, walau belum mencerminkan MRR aktual karena data subscription belum tersedia.',
            ],
        ];
    }

    public function getUsersData(): array
    {
        $rows = [];

        try {
            $rows = $this->db->table('users')
                ->select('id, name, email, role, is_active, created_at, updated_at')
                ->orderBy('created_at', 'DESC')
                ->get()
                ->getResultArray();
        } catch (Throwable) {
            $rows = [];
        }

        $roles = $this->groupCount('users', 'role');

        return [
            'summary' => [
                'total' => count($rows),
                'active' => count(array_filter($rows, static fn (array $row): bool => (int) ($row['is_active'] ?? 0) === 1)),
                'inactive' => count(array_filter($rows, static fn (array $row): bool => (int) ($row['is_active'] ?? 0) !== 1)),
                'withRole' => count(array_filter($rows, static fn (array $row): bool => trim((string) ($row['role'] ?? '')) !== '')),
            ],
            'roleCounts' => $roles,
            'users' => array_map(function (array $row): array {
                $row['status_label'] = ((int) ($row['is_active'] ?? 0) === 1) ? 'Active' : 'Inactive';
                $row['role_label'] = trim((string) ($row['role'] ?? '')) !== '' ? (string) $row['role'] : 'Unassigned';
                return $row;
            }, $rows),
        ];
    }

    public function getTenantsData(): array
    {
        $rows = [];

        try {
            $rows = $this->db->query(
                'SELECT t.id, t.owner_name, t.email, t.status, t.created_at, t.updated_at,
                        COUNT(DISTINCT wi.id) AS total_instances,
                        SUM(CASE WHEN wi.connection_status = "open" THEN 1 ELSE 0 END) AS open_instances,
                        COUNT(DISTINCT c.id) AS total_contacts,
                        COUNT(DISTINCT p.id) AS total_portfolios,
                        COUNT(DISTINCT mq.id) AS total_queues,
                        SUM(CASE WHEN mq.status = "failed" THEN 1 ELSE 0 END) AS failed_queues
                 FROM tenants t
                 LEFT JOIN wa_instances wi ON wi.tenant_id = t.id
                 LEFT JOIN contacts c ON c.tenant_id = t.id
                 LEFT JOIN portfolios p ON p.tenant_id = t.id
                 LEFT JOIN message_queues mq ON mq.tenant_id = t.id
                 GROUP BY t.id, t.owner_name, t.email, t.status, t.created_at, t.updated_at
                 ORDER BY t.created_at DESC'
            )->getResultArray();
        } catch (Throwable) {
            $rows = [];
        }

        return [
            'summary' => [
                'total' => count($rows),
                'active' => count(array_filter($rows, static fn (array $row): bool => ($row['status'] ?? '') === 'active')),
                'suspended' => count(array_filter($rows, static fn (array $row): bool => ($row['status'] ?? '') === 'suspended')),
                'inactive' => count(array_filter($rows, static fn (array $row): bool => ($row['status'] ?? '') === 'inactive')),
            ],
            'tenants' => $rows,
        ];
    }

    public function getPricingData(): array
    {
        $packages = $this->getActivePackages();

        return [
            'summary' => [
                'total' => count($packages),
                'active' => count(array_filter($packages, static fn (array $row): bool => (int) ($row['is_active'] ?? 0) === 1)),
                'recommended' => count(array_filter($packages, static fn (array $row): bool => (int) ($row['is_recommended'] ?? 0) === 1)),
            ],
            'insights' => $this->getPricingInsights($packages),
            'packages' => array_map(function (array $row): array {
                $row['features_list'] = [];
                if (isset($row['features'])) {
                    $decoded = json_decode((string) $row['features'], true);
                    $row['features_list'] = is_array($decoded) ? $decoded : [];
                }
                return $row;
            }, $packages),
        ];
    }

    public function getPortfolioData(): array
    {
        $rows = [];

        try {
            $rows = $this->db->query(
                'SELECT p.id, p.title, p.slug, p.description, p.thumbnail_image, p.demo_url, p.tech_stack,
                        p.is_published, p.created_at, p.updated_at, t.owner_name AS tenant_name, t.email AS tenant_email
                 FROM portfolios p
                 LEFT JOIN tenants t ON t.id = p.tenant_id
                 ORDER BY p.updated_at DESC, p.created_at DESC'
            )->getResultArray();
        } catch (Throwable) {
            $rows = [];
        }

        return [
            'summary' => [
                'total' => count($rows),
                'published' => count(array_filter($rows, static fn (array $row): bool => (int) ($row['is_published'] ?? 0) === 1)),
                'draft' => count(array_filter($rows, static fn (array $row): bool => (int) ($row['is_published'] ?? 0) !== 1)),
            ],
            'portfolios' => $rows,
        ];
    }

    public function getInstancesData(): array
    {
        $rows = [];

        try {
            $rows = $this->db->query(
                'SELECT wi.id, wi.instance_name, wi.phone_number, wi.connection_status, wi.created_at, wi.updated_at,
                        t.owner_name AS tenant_name, t.email AS tenant_email
                 FROM wa_instances wi
                 LEFT JOIN tenants t ON t.id = wi.tenant_id
                 ORDER BY wi.updated_at DESC, wi.created_at DESC'
            )->getResultArray();
        } catch (Throwable) {
            $rows = [];
        }

        return [
            'summary' => [
                'total' => count($rows),
                'open' => count(array_filter($rows, static fn (array $row): bool => ($row['connection_status'] ?? '') === 'open')),
                'connecting' => count(array_filter($rows, static fn (array $row): bool => ($row['connection_status'] ?? '') === 'connecting')),
                'problem' => count(array_filter($rows, static fn (array $row): bool => in_array(($row['connection_status'] ?? ''), ['close', 'qrcode'], true))),
            ],
            'instances' => $rows,
        ];
    }

    public function getContactsData(): array
    {
        $rows = [];

        try {
            $rows = $this->db->query(
                'SELECT c.id, c.contact_name, c.phone_number, c.tags, c.created_at,
                        t.owner_name AS tenant_name, t.email AS tenant_email
                 FROM contacts c
                 LEFT JOIN tenants t ON t.id = c.tenant_id
                 ORDER BY c.created_at DESC'
            )->getResultArray();
        } catch (Throwable) {
            $rows = [];
        }

        return [
            'summary' => [
                'total' => count($rows),
                'tagged' => count(array_filter($rows, static fn (array $row): bool => trim((string) ($row['tags'] ?? '')) !== '')),
            ],
            'contacts' => $rows,
        ];
    }

    public function getQueuesData(): array
    {
        $rows = [];

        try {
            $rows = $this->db->query(
                'SELECT mq.id, mq.receiver_number, mq.status, mq.scheduled_at, mq.error_reason, mq.created_at, mq.updated_at,
                        wi.instance_name, t.owner_name AS tenant_name
                 FROM message_queues mq
                 LEFT JOIN wa_instances wi ON wi.id = mq.wa_instance_id
                 LEFT JOIN tenants t ON t.id = mq.tenant_id
                 ORDER BY mq.updated_at DESC, mq.created_at DESC'
            )->getResultArray();
        } catch (Throwable) {
            $rows = [];
        }

        return [
            'summary' => [
                'total' => count($rows),
                'pending' => count(array_filter($rows, static fn (array $row): bool => ($row['status'] ?? '') === 'pending')),
                'sent' => count(array_filter($rows, static fn (array $row): bool => ($row['status'] ?? '') === 'sent')),
                'failed' => count(array_filter($rows, static fn (array $row): bool => ($row['status'] ?? '') === 'failed')),
            ],
            'queues' => $rows,
        ];
    }

    public function getPerformanceData(): array
    {
        $tenant = $this->getTenantsData();
        $instances = $this->getInstancesData();
        $queues = $this->getQueuesData();
        $portfolio = $this->getPortfolioData();

        return [
            'summary' => [
                'activationRate' => ($tenant['summary']['total'] ?? 0) > 0
                    ? (int) round((($tenant['summary']['active'] ?? 0) / $tenant['summary']['total']) * 100)
                    : 0,
                'instanceOpenRate' => ($instances['summary']['total'] ?? 0) > 0
                    ? (int) round((($instances['summary']['open'] ?? 0) / $instances['summary']['total']) * 100)
                    : 0,
                'queueSuccessRate' => ($queues['summary']['total'] ?? 0) > 0
                    ? (int) round((($queues['summary']['sent'] ?? 0) / $queues['summary']['total']) * 100)
                    : 0,
                'portfolioPublishRate' => ($portfolio['summary']['total'] ?? 0) > 0
                    ? (int) round((($portfolio['summary']['published'] ?? 0) / $portfolio['summary']['total']) * 100)
                    : 0,
            ],
            'topTenants' => $this->topTenants(),
        ];
    }

    public function getContentData(): array
    {
        $rows = [];

        try {
            $rows = $this->db->table('site_content')
                ->select('id, page_key, lang, title, effective_date, updated_at, body')
                ->orderBy('updated_at', 'DESC')
                ->get()
                ->getResultArray();
        } catch (Throwable) {
            $rows = [];
        }

        return [
            'summary' => [
                'total' => count($rows),
                'fresh' => count(array_filter($rows, fn (array $row): bool => $this->daysSince($row['updated_at'] ?? null) <= 30)),
                'stale' => count(array_filter($rows, fn (array $row): bool => $this->daysSince($row['updated_at'] ?? null) > 30)),
            ],
            'pages' => array_map(function (array $row): array {
                $days = $this->daysSince($row['updated_at'] ?? null);
                $row['body_length'] = mb_strlen(strip_tags((string) ($row['body'] ?? '')));
                $row['freshness_label'] = $days <= 7 ? 'Fresh' : ($days <= 30 ? 'Monitor' : 'Review');
                $row['freshness_tone'] = $days <= 7 ? 'success' : ($days <= 30 ? 'warning' : 'danger');
                $row['updated_days'] = $days;
                return $row;
            }, $rows),
        ];
    }

    private function recentContent(): array
    {
        try {
            return $this->db->table('site_content')
                ->select('page_key, title, updated_at, effective_date')
                ->orderBy('updated_at', 'DESC')
                ->limit(5)
                ->get()
                ->getResultArray();
        } catch (Throwable) {
            return [];
        }
    }

    private function topTenants(): array
    {
        try {
            return $this->db->query(
                'SELECT t.owner_name, t.status,
                        COUNT(DISTINCT wi.id) AS total_instances,
                        COUNT(DISTINCT mq.id) AS total_queues,
                        SUM(CASE WHEN mq.status = "failed" THEN 1 ELSE 0 END) AS failed_queues
                 FROM tenants t
                 LEFT JOIN wa_instances wi ON wi.tenant_id = t.id
                 LEFT JOIN message_queues mq ON mq.tenant_id = t.id
                 GROUP BY t.id, t.owner_name, t.status
                 ORDER BY total_queues DESC, total_instances DESC, t.owner_name ASC
                 LIMIT 5'
            )->getResultArray();
        } catch (Throwable) {
            return [];
        }
    }

    private function getActivePackages(): array
    {
        try {
            return $this->db->table('pricing_packages')
                ->select('id, name, slug, price, max_instances, max_messages, max_portfolios, features, is_active, is_recommended, sort_order')
                ->orderBy('sort_order', 'ASC')
                ->get()
                ->getResultArray();
        } catch (Throwable) {
            return [];
        }
    }

    private function getPricingInsights(array $packages): array
    {
        $active = array_values(array_filter($packages, static fn (array $package): bool => (int) ($package['is_active'] ?? 0) === 1));
        $recommended = array_values(array_filter($packages, static fn (array $package): bool => (int) ($package['is_recommended'] ?? 0) === 1));
        $prices = array_map(static fn (array $package): int => (int) ($package['price'] ?? 0), $active);

        return [
            'activeCount' => count($active),
            'recommendedCount' => count($recommended),
            'lowestPrice' => $prices !== [] ? min($prices) : 0,
            'highestPrice' => $prices !== [] ? max($prices) : 0,
            'averagePrice' => $prices !== [] ? (int) round(array_sum($prices) / count($prices)) : 0,
        ];
    }

    private function getCmsFreshness(): array
    {
        $rows = $this->recentContent();
        $all = $this->getContentData()['pages'] ?? [];

        return [
            'recent' => $rows,
            'freshCount' => count(array_filter($all, static fn (array $row): bool => ($row['updated_days'] ?? 9999) <= 30)),
            'staleCount' => count(array_filter($all, static fn (array $row): bool => ($row['updated_days'] ?? 0) > 30)),
        ];
    }

    private function count(string $table): int
    {
        try {
            return (int) $this->db->table($table)->countAllResults();
        } catch (Throwable) {
            return 0;
        }
    }

    private function countWhere(string $table, array $where): int
    {
        try {
            return (int) $this->db->table($table)->where($where)->countAllResults();
        } catch (Throwable) {
            return 0;
        }
    }

    private function groupCount(string $table, string $field, array $defaults = []): array
    {
        $result = [];

        foreach ($defaults as $default) {
            $result[$default] = 0;
        }

        try {
            $rows = $this->db->table($table)
                ->select($field . ', COUNT(*) AS aggregate_count', false)
                ->groupBy($field)
                ->get()
                ->getResultArray();

            foreach ($rows as $row) {
                $key = trim((string) ($row[$field] ?? '')) ?: 'unknown';
                $result[$key] = (int) ($row['aggregate_count'] ?? 0);
            }
        } catch (Throwable) {
            return $result;
        }

        return $result;
    }

    private function daysSince(?string $dateTime): int
    {
        if (empty($dateTime)) {
            return 9999;
        }

        try {
            $updated = new \DateTimeImmutable($dateTime);
            $today = new \DateTimeImmutable('now');
            return (int) $today->diff($updated)->format('%a');
        } catch (Throwable) {
            return 9999;
        }
    }
}
