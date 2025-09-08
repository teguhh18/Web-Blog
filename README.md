# 📰 Web Blog - Laravel News Platform

<p align="center">
  <img src="https://img.shields.io/badge/Laravel-10.x-red.svg" alt="Laravel Version">
  <img src="https://img.shields.io/badge/PHP-8.1+-blue.svg" alt="PHP Version">
  <img src="https://img.shields.io/badge/Bootstrap-5.x-purple.svg" alt="Bootstrap Version">
  <img src="https://img.shields.io/badge/AI-Gemini%20Powered-green.svg" alt="AI Powered">
</p>

Sebuah platform berita modern yang dibangun dengan Laravel, dilengkapi dengan fitur AI untuk pembuatan konten otomatis dan manajemen berita yang komprehensif.

## ✨ Fitur Utama

### 🎯 Fitur User (Frontend)
- **Beranda Dinamis** - Tampilan berita terbaru dan populer
- **Kategori Berita** - Navigasi berita berdasarkan kategori
- **Pencarian** - Cari berita dengan kata kunci
- **Sistem Komentar** - Interaksi pengguna pada artikel
- **Share ke Media Sosial** - Bagikan artikel ke Facebook, Twitter, WhatsApp, LinkedIn
- **Profil User** - Kelola profil dan password
- **Responsive Design** - Tampilan optimal di semua perangkat

### 🛠️ Fitur Admin (Backend)
- **Dashboard Analytics** - Statistik berita, user, dan kategori
- **Manajemen Berita** - CRUD lengkap untuk artikel
- **Manajemen Kategori** - Organisasi konten berdasarkan topik
- **Manajemen User** - Kelola pengguna dan administrator
- **Sistem Komentar** - Moderasi komentar pengguna
- **Upload Gambar** - Media management untuk artikel

### 🤖 Fitur AI (Gemini Integration)
- **Auto Content Generation** - Buat artikel otomatis dengan AI
- **AI Image Generation** - Generate gambar berdasarkan konten artikel
- **Custom AI Roles** - Sesuaikan peran AI untuk berbagai jenis konten
- **Smart Prompting** - Template prompt yang dioptimalkan

## 🚀 Teknologi yang Digunakan

### Backend
- **Laravel 10.x** - PHP Framework
- **MySQL** - Database
- **Laravel Sanctum** - Authentication
- **Eloquent ORM** - Database interactions
- **Blade Templating** - View engine

### Frontend
- **Bootstrap 5** - CSS Framework
- **jQuery** - JavaScript library
- **SweetAlert2** - Beautiful alerts
- **Trix Editor** - Rich text editor
- **AOS** - Animate on scroll

### AI & External APIs
- **Google Gemini AI** - Content generation
- **HTTP Client** - API integrations

### Development Tools
- **Laravel Debugbar** - Development debugging
- **Laravel Pint** - Code styling
- **Faker** - Test data generation

## 📋 Persyaratan Sistem

- PHP >= 8.1
- Composer
- MySQL/MariaDB
- Web Server (Apache/Nginx)

## 🔧 Instalasi

### 1. Clone Repository
```bash
git clone https://github.com/teguhh18/Web-Blog.git
cd Web-Blog
```

### 2. Install Dependencies
```bash
# Install PHP dependencies
composer install


### 3. Environment Setup
```bash
# Copy environment file
cp .env.example .env

# Generate application key
php artisan key:generate
```

### 4. Database Configuration
Edit file `.env` dan sesuaikan konfigurasi database:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=web_blog
DB_USERNAME=root
DB_PASSWORD=
```

### 5. AI API Configuration
Tambahkan API keys ke file `.env`:
```env
# Google Gemini AI
GEMINI_API_KEY=your_gemini_api_key_here


### 6. Database Migration & Seeding
```bash
# Run migrations
php artisan migrate

# Seed database with sample data
php artisan db:seed
```

### 7. Storage Link
```bash
# Create storage link for public file access
php artisan storage:link
```

### 8. Start Development Server
```bash
php artisan serve
```

Aplikasi akan tersedia di `http://localhost:8000`

## 🔐 Default Login

### Admin
- **Email:** admin@example.com
- **Password:** password

### User
- **Email:** user@example.com
- **Password:** password

## 📁 Struktur Project

```
Web-Blog/
├── app/
│   ├── Http/Controllers/     # Controllers
│   ├── Models/              # Eloquent Models
│   ├── Policies/            # Authorization Policies
│   └── Providers/           # Service Providers
├── database/
│   ├── migrations/          # Database migrations
│   ├── seeders/            # Database seeders
│   └── factories/          # Model factories
├── resources/
│   ├── views/              # Blade templates
│   │   ├── admin/          # Admin panel views
│   │   └── user/           # Frontend views
│   ├── css/                # Stylesheets
│   └── js/                 # JavaScript files
├── routes/
│   ├── web.php             # Web routes
│   └── api.php             # API routes
└── public/                 # Public assets
```

## 🎮 Cara Penggunaan

### Untuk Admin
1. Login ke panel admin di `/login-user`
2. Gunakan dashboard untuk melihat statistik
3. Kelola berita di menu "Berita" dengan fitur AI
4. Atur kategori di menu "Kategori"
5. Moderasi komentar di menu "Komentar"

### Untuk User
1. Registrasi akun baru di `/register`
2. Browse berita di halaman utama
3. Baca artikel lengkap dan berikan komentar
4. Bagikan artikel ke media sosial
5. Kelola profil di menu user

### AI Content Generation
1. Masuk ke menu "Berita AI" di admin panel
2. Pilih role AI yang sesuai
3. Masukkan prompt atau topik
4. AI akan generate konten artikel
5. Generate gambar berdasarkan konten (opsional)
6. Review dan publish artikel

## 🛡️ Keamanan

- **CSRF Protection** - Semua form dilindungi CSRF token
- **Authentication** - Sistem login yang aman
- **Authorization** - Policy-based access control
- **File Upload Validation** - Validasi ketat untuk upload file
- **SQL Injection Prevention** - Eloquent ORM protection

## 🚀 Deployment

### Server Requirements
- PHP 8.1+
- MySQL 5.7+
- Apache/Nginx
- Composer
- SSL Certificate (Recommended)

### Deployment Steps
1. Upload files ke server
2. Install dependencies: `composer install --optimize-autoloader --no-dev`
3. Set permissions untuk storage dan bootstrap/cache
4. Configure web server
5. Setup SSL certificate
6. Run migrations: `php artisan migrate --force`

## 🤝 Contributing

1. Fork repository
2. Create feature branch (`git checkout -b feature/amazing-feature`)
3. Commit changes (`git commit -m 'Add amazing feature'`)
4. Push to branch (`git push origin feature/amazing-feature`)
5. Open Pull Request

## 📝 License

Project ini menggunakan [MIT License](https://opensource.org/licenses/MIT).

## 👥 Team

- **Developer:** Teguhh18
- **GitHub:** [@teguhh18](https://github.com/teguhh18)

## 📞 Support

Jika Anda mengalami masalah atau memiliki pertanyaan:

1. Buka issue di GitHub repository
2. Dokumentasi Laravel: [laravel.com/docs](https://laravel.com/docs)
3. Community Discord/Forum

---

<p align="center">
  Dibuat dengan ❤️ menggunakan Laravel & AI Technology
</p>
