# 🚀 WA Gateway - Enterprise WhatsApp Gateway Service

Platform WhatsApp Gateway unofficial berbasis CodeIgniter 4 untuk layanan B2B multi-tenant.

## 📋 Daftar Isi
- [Fitur](#fitur)
- [Persyaratan Sistem](#persyaratan-sistem)
- [Instalasi](#instalasi)
- [Konfigurasi](#konfigurasi)
- [Struktur Database](#struktur-database)
- [API Endpoints](#api-endpoints)
- [Keamanan](#keamanan)
- [Development](#development)

## ✨ Fitur

### Untuk Tenant (Pengguna)
- ✅ **Autentikasi Aman**: Login/register dengan password hashing bcrypt
- ✅ **Multi-Instance**: Kelola beberapa instance WhatsApp sekaligus
- ✅ **Dashboard Real-time**: Statistik penggunaan dan monitoring
- ✅ **Kirim Pesan**: Single message, bulk messaging, scheduled messages
- ✅ **Queue System**: Antrian pesan otomatis dengan retry mechanism
- ✅ **Riwayat Pesan**: Tracking status pengiriman pesan
- ✅ **Profile Management**: Kelola akun dan pengaturan

### Untuk Admin
- ✅ **Tenant Management**: Kelola akun tenant
- ✅ **Instance Monitoring**: Monitor semua instance aktif
- ✅ **Content Management**: Kelola konten website
- ✅ **Pricing Management**: Kelola paket harga
- ✅ **Portfolio Management**: Tampilkan software lain sebagai portfolio

### Keamanan
- ✅ CSRF Protection (aktif global)
- ✅ Password Hashing (bcrypt cost 12)
- ✅ Rate Limiting (5 request/menit per endpoint)
- ✅ Secure Headers
- ✅ Input Validation
- ✅ Session-based Authentication
- ✅ Webhook Signature Verification

## 💻 Persyaratan Sistem

### Minimum
- PHP 8.1+
- MySQL 5.7+ / MariaDB 10.3+
- Web Server (Apache/Nginx)
- 1GB RAM
- 5GB Storage

### Recommended
- PHP 8.2+
- MySQL 8.0+ / MariaDB 10.6+
- Nginx + PHP-FPM
- 2GB RAM
- 10GB+ Storage
- SSL/TLS Certificate

## 📦 Instalasi

### 1. Clone Repository
```bash
git clone <repository-url> wa-gateway
cd wa-gateway
```

### 2. Install Dependencies
```bash
composer install
```

### 3. Setup Environment
```bash
cp env .env
```

Edit file `.env` dan sesuaikan konfigurasi:

```env
CI_ENVIRONMENT = production

# Database
database.default.hostname = localhost
database.default.database = wa_gateway
database.default.username = root
database.default.password = your_password
database.default.DBDriver = MySQLi

# Encryption Key (generate dengan: php spark key:generate)
encryption.key = hex:your_encryption_key

# Security
security.csrfProtection = session
security.tokenRandomize = true

# Email (untuk reset password & notifikasi)
email.fromEmail = noreply@yourdomain.com
email.fromName = 'WA Gateway'
email.SMTPHost = smtp.gmail.com
email.SMTPUser = your_email@gmail.com
email.SMTPPass = your_app_password
email.SMTPPort = 587
```

### 4. Migrate Database
```bash
php spark migrate
```

### 5. Set Permissions
```bash
chmod -R 755 writable/
chown -R www-data:www-data writable/
```

### 6. Setup Web Server

#### Nginx Configuration
```nginx
server {
    listen 443 ssl http2;
    server_name yourdomain.com;
    
    ssl_certificate /path/to/cert.pem;
    ssl_certificate_key /path/to/key.pem;
    
    root /var/www/wa-gateway/public;
    index index.php;
    
    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }
    
    location ~ \.php$ {
        fastcgi_pass unix:/run/php/php8.2-fpm.sock;
        fastcgi_index index.php;
        include fastcgi_params;
        fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
    }
    
    location ~ /\.ht {
        deny all;
    }
    
    # Security headers
    add_header X-Frame-Options "SAMEORIGIN" always;
    add_header X-Content-Type-Options "nosniff" always;
    add_header X-XSS-Protection "1; mode=block" always;
    add_header Referrer-Policy "strict-origin-when-cross-origin" always;
}

# Redirect HTTP to HTTPS
server {
    listen 80;
    server_name yourdomain.com;
    return 301 https://$server_name$request_uri;
}
```

## 🔧 Konfigurasi

### Evolution API Integration
1. Install Evolution API di server terpisah
2. Dapatkan API URL dan API Key
3. Update konfigurasi di `app/Config/WaGateway.php`:

```php
return [
    'api_url' => 'https://evolution.yourdomain.com',
    'api_key' => 'your_evolution_api_key',
    'webhook_secret' => 'your_webhook_secret',
];
```

### Queue Worker (Optional - untuk production)
Untuk memproses antrian pesan di background:

```bash
# Buat systemd service
sudo nano /etc/systemd/system/wa-queue.service
```

```ini
[Unit]
Description=WA Gateway Queue Worker
After=network.target mysql.service

[Service]
Type=simple
User=www-data
WorkingDirectory=/var/www/wa-gateway
ExecStart=/usr/bin/php spark queue:work
Restart=always
RestartSec=5

[Install]
WantedBy=multi-user.target
```

```bash
# Enable dan start service
sudo systemctl enable wa-queue
sudo systemctl start wa-queue
sudo systemctl status wa-queue
```

## 🗄️ Struktur Database

### Tabel Utama

#### `tenants`
- id (BIGINT, PK)
- owner_name (VARCHAR)
- email (VARCHAR, UNIQUE)
- password (VARCHAR, hashed)
- status (ENUM: active/inactive/suspended)
- created_at, updated_at

#### `wa_instances`
- id (BIGINT, PK)
- tenant_id (BIGINT, FK)
- name (VARCHAR)
- instance_id (VARCHAR, UNIQUE)
- phone (VARCHAR)
- status (ENUM)
- webhook_url (VARCHAR)
- config (JSON)
- created_at, updated_at

#### `message_queues`
- id (BIGINT, PK)
- tenant_id (BIGINT, FK)
- instance_id (BIGINT, FK)
- phone (VARCHAR)
- message (TEXT)
- type (VARCHAR)
- status (ENUM)
- priority (TINYINT)
- scheduled_at (DATETIME)
- sent_at (DATETIME)
- error_message (TEXT)
- created_at, updated_at

#### `pricing_packages`
- id, name, price, features (JSON), is_active, created_at

#### `portfolios`
- id, title, description, image_url, demo_url, github_url, tech_stack (JSON), order, is_featured

## 🌐 API Endpoints

### Public Endpoints
```
GET  /                    - Landing page
GET  /pricing             - Pricing packages
GET  /api-reference       - API documentation
GET  /status              - System status
GET  /privacy-policy      - Privacy policy
GET  /terms-of-service    - Terms of service
```

### Tenant Authentication
```
GET  /tenant/login                 - Login form
POST /tenant/doLogin               - Process login (rate limited)
GET  /tenant/register              - Register form
POST /tenant/doRegister            - Process registration (rate limited)
GET  /tenant/forgot-password       - Forgot password form
POST /tenant/doForgotPassword      - Process reset request (rate limited)
GET  /tenant/logout                - Logout
```

### Tenant Dashboard (Protected)
```
GET  /tenant/dashboard             - Dashboard overview
GET  /tenant/profile               - Profile page
POST /tenant/profile/update        - Update profile
GET  /tenant/instances             - List instances
GET  /tenant/instances/create      - Create instance form
POST /tenant/instances/store       - Store new instance
GET  /tenant/instances/:id         - Instance detail
POST /tenant/instances/:id/delete  - Delete instance
GET  /tenant/messages              - Messages page
POST /tenant/messages/send         - Send message
GET  /tenant/messages/history      - Message history
```

### Admin Panel
```
GET  /admin/login                  - Admin login
POST /admin/login                  - Admin authenticate
GET  /admin                        - Admin dashboard
GET  /admin/tenants                - Manage tenants
GET  /admin/instances              - Monitor instances
GET  /admin/pricing                - Manage pricing
GET  /admin/portfolio              - Manage portfolio
GET  /admin/content                - Manage content
```

## 🔒 Keamanan

### Best Practices yang Diterapkan

1. **CSRF Protection**: Aktif di semua form POST
2. **Password Hashing**: bcrypt dengan cost 12
3. **Rate Limiting**: 5 request per menit per IP per endpoint
4. **Secure Headers**: X-Frame-Options, X-Content-Type-Options, dll
5. **Input Validation**: Semua input divalidasi sebelum diproses
6. **SQL Injection Prevention**: Menggunakan prepared statements
7. **XSS Protection**: Output escaping di semua view
8. **Session Security**: HTTPOnly cookies, secure flags

### Rekomendasi Tambahan untuk Production

1. **SSL/TLS**: Wajib menggunakan HTTPS
2. **Firewall**: Setup UFW atau Cloudflare
3. **Database Backup**: Automated daily backups
4. **Monitoring**: Setup logging dan alerting
5. **Regular Updates**: Update dependencies secara berkala
6. **Security Audit**: Penetration testing rutin

## 👨‍💻 Development

### Running in Development
```bash
php spark serve --port 8080
```

### Generate Migration
```bash
php spark make:migration create_new_table
```

### Generate Model
```bash
php spark make:model NewModel
```

### Generate Controller
```bash
php spark make:controller NewController
```

### Run Tests
```bash
php spark test
```

### Clear Cache
```bash
php spark cache:clear
php spark debugbar:clear
```

## 📝 Changelog

### Version 0.2.0 (Current)
- ✅ Basic authentication system
- ✅ CSRF protection enabled
- ✅ Password hashing implemented
- ✅ Rate limiting filter
- ✅ Tenant dashboard
- ✅ Multi-instance support foundation
- ✅ Portfolio management
- ✅ Pricing pages
- ✅ Tenant auth filter
- ✅ Webhook security library

### Roadmap
- [ ] Email notification system
- [ ] Payment gateway integration
- [ ] Advanced analytics
- [ ] Bulk messaging with CSV upload
- [ ] Scheduled messages
- [ ] API rate limiting per tenant
- [ ] Two-factor authentication
- [ ] Mobile app (React Native)

## 🤝 Contributing

Silakan fork repository ini dan buat pull request untuk kontribusi.

## 📄 License

Proprietary - All rights reserved.

## 📞 Support

Untuk dukungan teknis, hubungi:
- Email: support@yourdomain.com
- Documentation: https://docs.yourdomain.com

---

**Dibuat dengan ❤️ menggunakan CodeIgniter 4**
