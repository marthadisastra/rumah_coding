import type {
  BlogPostDetail,
  BlogSummary,
  FaqSummary,
  LeadSummary,
  PortfolioDetail,
  PortfolioSummary,
  PricingSummary,
  WebhookSummary,
} from "@/types/cms";

export const dashboardStats = [
  { label: "Qualified leads", value: "128", change: "+18%" },
  { label: "Published posts", value: "42", change: "+6" },
  { label: "Webhook success", value: "99.2%", change: "24h" },
  { label: "WA sessions", value: "7", change: "5 live" },
];

export const blogPosts: BlogPostDetail[] = [
  {
    title: "Building reliable enrollment funnels",
    slug: "reliable-enrollment-funnels",
    status: "Published",
    author: "Product",
    updatedAt: "28 May 2026",
    views: "8.4k",
    excerpt:
      "Cara menyusun landing page, WhatsApp follow-up, dan handoff ke tim sales supaya funnel pendidikan tidak bocor di tengah.",
    readingTime: "6 min read",
    category: "Growth Operations",
    seoDescription:
      "Strategi membangun funnel enrollment yang konsisten untuk website pendidikan dan bootcamp.",
    content: [
      "Funnel enrollment yang sehat jarang gagal di headline. Biasanya yang bermasalah justru transisi antar langkah: pengunjung membaca artikel, klik CTA, masuk WhatsApp, lalu percakapan berhenti tanpa konteks.",
      "Karena itu halaman marketing harus diperlakukan sebagai bagian dari sistem operasional. Form, CTA, routing lead, dan notifikasi tim harus ditata dalam satu alur yang jelas, bukan berdiri sendiri-sendiri.",
      "Di Rumah Coding, struktur yang paling masuk akal adalah memisahkan permukaan publik dari panel operasional. Konten tetap ringan untuk pengunjung, sementara admin bisa memantau konten, pricing, lead, dan webhook tanpa menyentuh sistem lama.",
      "Jika setiap konten blog punya CTA yang jelas, tagging sumber lead, dan follow-up WhatsApp yang konsisten, tim tidak hanya dapat traffic. Tim juga dapat konteks yang cukup untuk closing.",
    ],
  },
  {
    title: "A field guide to WhatsApp follow-up",
    slug: "whatsapp-follow-up-guide",
    status: "Draft",
    author: "Growth",
    updatedAt: "27 May 2026",
    views: "Preview",
    excerpt:
      "Draft panduan internal untuk response time, template balasan, dan segmentasi minat calon peserta.",
    readingTime: "5 min read",
    category: "Internal Playbook",
    seoDescription: "Draft panduan WhatsApp follow-up untuk tim growth.",
    content: [
      "Artikel ini masih draft dan seharusnya tidak tampil di halaman publik.",
    ],
  },
  {
    title: "Operational SEO for local education brands",
    slug: "operational-seo-education",
    status: "Published",
    author: "Marketing",
    updatedAt: "24 May 2026",
    views: "4.1k",
    excerpt:
      "SEO bukan cuma urusan ranking. Untuk brand pendidikan lokal, SEO harus menyatu dengan lead intent, credibility, dan struktur halaman.",
    readingTime: "7 min read",
    category: "SEO",
    seoDescription:
      "Pendekatan SEO operasional untuk brand edukasi lokal yang ingin traffic dan inquiry tumbuh bersama.",
    content: [
      "Banyak website pendidikan mengejar keyword, tapi lupa menyiapkan halaman yang membantu orang mengambil keputusan. Akibatnya traffic datang, namun inquiry tetap tipis.",
      "SEO operasional dimulai dari pemetaan intent. Artikel informasional memberi pintu masuk, pricing menjawab keberatan, portfolio memberi bukti kerja, dan FAQ menutup celah pertanyaan yang berulang.",
      "Ketika struktur itu disambungkan dengan CMS yang rapi, tim bisa menambah halaman tanpa mengulang masalah yang sama setiap bulan. Ini jauh lebih penting daripada sekadar menulis banyak artikel.",
      "Target akhirnya sederhana: setiap halaman publik harus punya peran yang jelas dalam perjalanan pengunjung, bukan hanya menjadi arsip konten.",
    ],
  },
];

export const publicBlogPosts: BlogSummary[] = blogPosts
  .filter((post) => post.status === "Published")
  .map((post) => ({
    title: post.title,
    slug: post.slug,
    status: post.status,
    author: post.author,
    updatedAt: post.updatedAt,
    views: post.views,
    excerpt: post.excerpt,
  }));

export function getPublishedBlogSlugs() {
  return publicBlogPosts.map((post) => post.slug);
}

export function getPublicBlogPostBySlug(slug: string) {
  const post = blogPosts.find((entry) => entry.slug === slug && entry.status === "Published");
  return post ?? null;
}

export const portfolioProjects: PortfolioDetail[] = [
  {
    name: "Rumah Coding Corporate Site",
    slug: "rumah-coding-corporate-site",
    category: "Marketing Website",
    year: "2026",
    status: "Published",
    summary:
      "Website company profile dan lead generation dengan struktur CMS, pricing, FAQ, dan funnel inquiry yang lebih rapi.",
    headline: "Permukaan publik yang ringan untuk calon klien, panel konten yang fokus untuk operasional internal.",
    client: "Rumah Coding",
    website: "https://example.com",
    stack: ["Next.js", "TypeScript", "Tailwind CSS", "Prisma", "MySQL"],
    challenges: [
      "Situs lama bercampur antara kebutuhan publik dan kebutuhan operasional internal.",
      "Konten pricing, FAQ, dan blog sulit dikembangkan tanpa menyentuh sistem lama.",
      "Lead butuh alur yang lebih jelas ke WhatsApp dan panel admin.",
    ],
    features: [
      "Landing page dan halaman layanan yang SEO-ready.",
      "Blog, pricing, FAQ, dan portfolio dengan struktur data terpisah.",
      "Admin dashboard untuk monitoring konten, lead, dan webhook.",
      "Arsitektur siap dipasang di reverse proxy tanpa mematikan sistem lama.",
    ],
    results: [
      "Permukaan publik menjadi lebih bersih dan fokus pada konversi.",
      "Konten baru bisa ditambah tanpa menyentuh kode route lama.",
      "Tim punya fondasi yang lebih aman untuk migrasi bertahap.",
    ],
    detail: [
      "Project ini dirancang sebagai second system, bukan rewrite agresif. Tujuannya menjaga website lama tetap jalan sambil menyiapkan jalur migrasi yang lebih tenang.",
      "Kami memisahkan concern antara halaman publik dan panel admin. Pengunjung hanya melihat halaman marketing, sementara kebutuhan internal diletakkan di area admin dengan login.",
      "Struktur kontennya dibuat CMS-ready sejak awal supaya halaman-halaman baru seperti portfolio, artikel, dan pricing bisa terus bertambah tanpa memicu refactor besar.",
    ],
  },
  {
    name: "WhatsApp Lead Console",
    slug: "whatsapp-lead-console",
    category: "Internal Dashboard",
    year: "2025",
    status: "Published",
    summary:
      "Dashboard internal untuk memantau health gateway WhatsApp, routing lead, dan histori webhook dalam satu permukaan kerja.",
    headline: "Satu panel untuk melihat dari mana lead masuk, bagaimana follow-up berjalan, dan event apa yang gagal.",
    client: "Private Client",
    stack: ["Next.js", "Node.js", "MySQL", "Webhook Integrations"],
    challenges: [
      "Tim operasional harus bolak-balik antar tool untuk melihat lead dan status gateway.",
      "Kesalahan webhook sulit ditelusuri karena log tersebar.",
      "Tidak ada tampilan ringkas untuk prioritas follow-up harian.",
    ],
    features: [
      "Ringkasan lead harian dan status pipeline.",
      "Tabel webhook log dengan source, event, dan response code.",
      "Status account WhatsApp dan indikator sesi aktif.",
    ],
    results: [
      "Waktu triage lead turun karena tim tidak lagi cek banyak panel.",
      "Masalah integrasi lebih cepat ditemukan lewat log terpusat.",
      "Tim support punya konteks lebih lengkap saat follow-up.",
    ],
    detail: [
      "Fokus utama produk ini adalah kejelasan operasional. Bukan sekadar dashboard cantik, tapi panel kerja yang membantu tim memutuskan apa yang harus direspons sekarang.",
      "Kami sengaja memakai komposisi data yang padat namun tetap rapi: summary cards untuk skala cepat, lalu tabel untuk detail yang bisa dipindai.",
    ],
  },
  {
    name: "Learning Portal Operations",
    slug: "learning-portal-operations",
    category: "CMS Platform",
    year: "2024",
    status: "Published",
    summary:
      "Portal konten dan administrasi untuk program belajar yang membutuhkan publishing workflow, role access, dan manajemen halaman.",
    headline: "CMS yang disusun untuk tim kecil: cepat dipelihara, jelas ownership-nya, dan enak dikembangkan bertahap.",
    client: "Education Team",
    stack: ["CodeIgniter", "MySQL", "Bootstrap", "REST API"],
    challenges: [
      "Tim non-teknis butuh mengelola halaman tanpa ketergantungan ke developer.",
      "Hak akses editor dan admin belum terpisah dengan baik.",
      "Pembaruan konten sering berbenturan dengan kebutuhan maintenance lain.",
    ],
    features: [
      "Role-based access untuk editor dan admin.",
      "Manajemen halaman, artikel, dan FAQ.",
      "Dokumentasi API untuk integrasi antar sistem.",
    ],
    results: [
      "Waktu publish konten lebih singkat.",
      "Perubahan editorial tidak lagi mengganggu maintenance teknis.",
      "Arah migrasi ke stack baru lebih mudah direncanakan.",
    ],
    detail: [
      "Project ini menjadi dasar penting untuk memahami pola kerja tim konten. Banyak keputusan di aplikasi Next.js sekarang terinspirasi dari pelajaran praktis di sini.",
      "Yang paling berharga bukan hanya fitur, tapi pembagian tanggung jawab yang menjadi lebih jelas antara operasional, konten, dan engineering.",
    ],
  },
];

export const portfolioSummaries: PortfolioSummary[] = portfolioProjects.map(
  (project) => ({
    name: project.name,
    slug: project.slug,
    category: project.category,
    year: project.year,
    status: project.status,
    summary: project.summary,
    stack: project.stack,
  }),
);

export function getPortfolioSlugs() {
  return portfolioSummaries
    .filter((project) => project.status === "Published")
    .map((project) => project.slug);
}

export function getPortfolioBySlug(slug: string) {
  const project = portfolioProjects.find((entry) => entry.slug === slug && entry.status === "Published");
  return project ?? null;
}

export const faqs: FaqSummary[] = [
  {
    question: "Can students join without prior coding experience?",
    category: "Admissions",
    status: "Published",
  },
  {
    question: "How do payment plans work?",
    category: "Billing",
    status: "Published",
  },
  {
    question: "Do bootcamp graduates receive career support?",
    category: "Career",
    status: "Draft",
  },
];

export const pricingPlans: PricingSummary[] = [
  { name: "Starter", price: "IDR 499k", status: "Published", conversions: "3.8%" },
  { name: "Professional", price: "IDR 1.499m", status: "Published", conversions: "8.9%" },
  { name: "Team", price: "Custom", status: "Draft", conversions: "Preview" },
];

export const leads: LeadSummary[] = [
  {
    name: "Aulia Rahman",
    company: "Mandiri Digital",
    channel: "Pricing page",
    status: "Qualified",
    createdAt: "Today, 10:42",
  },
  {
    name: "Nadia Putri",
    company: "Freelancer",
    channel: "WhatsApp",
    status: "Contacted",
    createdAt: "Today, 09:15",
  },
  {
    name: "Rizky Pratama",
    company: "SMK Cendekia",
    channel: "Blog CTA",
    status: "New",
    createdAt: "Yesterday, 18:20",
  },
];

export const webhookLogs: WebhookSummary[] = [
  { event: "message.received", source: "whatsapp", statusCode: 200, createdAt: "2 min ago" },
  { event: "lead.created", source: "website", statusCode: 201, createdAt: "11 min ago" },
  { event: "invoice.paid", source: "billing", statusCode: 200, createdAt: "34 min ago" },
];

export const apiEndpoints = [
  { method: "GET", path: "/api/v1/posts", purpose: "List published CMS posts" },
  { method: "GET", path: "/api/v1/portfolio", purpose: "List published software portfolio entries" },
  { method: "POST", path: "/api/v1/leads", purpose: "Create a website lead" },
  { method: "POST", path: "/api/v1/webhooks/whatsapp", purpose: "Receive WhatsApp events" },
  { method: "GET", path: "/api/v1/pricing", purpose: "Read active plans" },
];
