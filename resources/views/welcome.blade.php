<!doctype html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sembada Cafe — Selamat Datang</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <style>
        :root {
            --primary-color: #8B6F47;
            --secondary-color: #D4A574;
            --dark-color: #2C2416;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        /* Navbar */
        .navbar {
            background: linear-gradient(135deg, var(--dark-color) 0%, #3d3228 100%);
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        .navbar-brand {
            font-size: 1.5rem;
            color: var(--secondary-color) !important;
            letter-spacing: 1px;
        }

        /* Hero Section */
        .hero {
            background: linear-gradient(135deg, rgba(44, 36, 22, 0.7) 0%, rgba(139, 111, 71, 0.6) 100%),
                url('{{ asset("images/hero-bg.jpg") }}') center/cover no-repeat;
            color: #fff;
            min-height: 70vh;
            display: flex;
            align-items: center;
            padding: 60px 0;
        }

        .hero h1 {
            font-size: 3.5rem;
            font-weight: 800;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
            margin-bottom: 20px;
        }

        .hero .lead {
            font-size: 1.3rem;
            margin-bottom: 30px;
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.3);
        }

        /* Cards */
        .card {
            border: none;
            border-radius: 12px;
            overflow: hidden;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .card:hover {
            transform: translateY(-8px);
            box-shadow: 0 12px 24px rgba(0, 0, 0, 0.15) !important;
        }

        .card img {
            height: 180px;
            object-fit: cover;
        }

        /* Feature Section */
        .feature-card {
            text-align: center;
            padding: 30px;
            border-radius: 12px;
            background: #f8f7f5;
            transition: all 0.3s ease;
        }

        .feature-card:hover {
            background: var(--secondary-color);
            color: white;
        }

        .feature-icon {
            font-size: 3rem;
            margin-bottom: 15px;
        }

        /* Menu Section */
        .menu-section {
            background: linear-gradient(135deg, #f8f7f5 0%, #ede9e4 100%);
        }

        .menu-card-image {
            height: 200px;
            overflow: hidden;
            border-radius: 12px 12px 0 0;
        }

        .menu-price {
            font-size: 1.25rem;
            color: var(--primary-color);
            font-weight: bold;
        }

        /* Contact Section */
        .contact-section {
            background: white;
            padding: 80px 0;
        }

        .form-control {
            border: 2px solid #e0e0e0;
            border-radius: 8px;
            padding: 12px 16px;
        }

        .form-control:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.2rem rgba(139, 111, 71, 0.15);
        }

        /* Footer */
        footer {
            background: linear-gradient(135deg, var(--dark-color) 0%, #3d3228 100%);
            color: #ccc;
            padding: 40px 0;
        }

        footer a {
            color: var(--secondary-color);
            text-decoration: none;
        }

        footer a:hover {
            color: #fff;
        }

        /* Buttons */
        .btn-primary {
            background: var(--primary-color);
            border: none;
            border-radius: 8px;
            padding: 10px 24px;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            background: var(--secondary-color);
            color: white;
        }

        .btn-outline-light:hover {
            background: transparent;
            border-color: var(--secondary-color);
            color: var(--secondary-color);
        }
    </style>
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark sticky-top">
        <div class="container">
            <a class="navbar-brand" href="#">☕ Sembada Cafe</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#home">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#menu">Menu</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#tentang">Tentang</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#kontak">Kontak</a>
                    </li>
                </ul>
                <div class="d-flex ms-3 gap-2">
                    <a href="{{ route('login') }}" class="btn btn-outline-light btn-sm">Login</a>
                    <a href="{{ route('register') }}" class="btn btn-primary btn-sm">Daftar</a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <header class="hero" id="home">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 mb-4 mb-lg-0">
                    <h1>Selamat Datang di Sembada Cafe</h1>
                    <p class="lead">Temukan pengalaman kopi terbaik dengan suasana hangat dan nyaman. Bijinya dipilih,
                        disangrai dengan sempurna, dan disajikan dengan cinta.</p>
                    <div class="d-flex gap-3 flex-wrap">
                        <a href="{{ route('register') }}" class="btn btn-primary btn-lg">Bergabung Sekarang</a>
                        <a href="#menu" class="btn btn-outline-light btn-lg">Lihat Menu</a>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="card shadow-lg" style="border-radius: 16px; border: none;">
                        <img src="https://images.unsplash.com/photo-1509042239860-f550ce710b93?auto=format&fit=crop&w=600&q=80"
                            class="card-img-top" alt="Spesial Hari Ini">
                        <div class="card-body">
                            <h5 class="card-title" style="color: var(--primary-color);">🎉 Penawaran Spesial Hari Ini
                            </h5>
                            <p class="card-text">Cappuccino + Croissant Fresh hanya <strong
                                    style="color: var(--secondary-color); font-size: 1.3rem;">Rp 39.000</strong></p>
                            <p class="text-muted small">Penawaran terbatas! Pesan sekarang juga.</p>
                            <a href="#menu" class="btn btn-primary">Pesan Sekarang</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- Features Section -->
    <section class="py-5" id="tentang">
        <div class="container">
            <div class="text-center mb-5">
                <h2 style="color: var(--primary-color); font-weight: bold; font-size: 2.5rem;">Mengapa Memilih Kami?
                </h2>
                <p class="text-muted" style="font-size: 1.1rem;">Kualitas, rasa, dan pelayanan yang membuat pelanggan
                    kembali lagi.</p>
            </div>
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="feature-card">
                        <div class="feature-icon">☕</div>
                        <h5 class="fw-bold">Kopi Pilihan Premium</h5>
                        <p>Bijinya dipilih langsung dari perkebunan terbaik dan disangrai dengan keahlian khusus.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="feature-card">
                        <div class="feature-icon">🥐</div>
                        <h5 class="fw-bold">Roti & Kue Segar</h5>
                        <p>Dipanggang setiap hari oleh baker profesional kami menggunakan bahan-bahan pilihan.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="feature-card">
                        <div class="feature-icon">🌿</div>
                        <h5 class="fw-bold">Suasana Nyaman</h5>
                        <p>Tempat ideal untuk bekerja, belajar, atau sekadar bersantai bersama orang-orang terkasih.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Menu Section -->
    <section class="menu-section py-5" id="menu">
        <div class="container">
            <div class="text-center mb-5">
                <h2 style="color: var(--primary-color); font-weight: bold; font-size: 2.5rem;">Menu Populer Kami</h2>
                <p class="text-muted">Rekomendasi favorit dari barista dan pastry chef kami.</p>
            </div>
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="card shadow-sm h-100">
                        <div class="menu-card-image">
                            <img src="https://images.unsplash.com/photo-1511920170033-f8396924c348?auto=format&fit=crop&w=800&q=80"
                                class="w-100 h-100" style="object-fit: cover;" alt="Espresso">
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">Espresso</h5>
                            <p class="card-text text-muted">Shot kopi pekat dengan crema tebal yang sempurna untuk
                                memulai hari.</p>
                            <p class="menu-price">Rp 18.000</p>
                            <button class="btn btn-sm btn-primary w-100">Pesan</button>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card shadow-sm h-100">
                        <div class="menu-card-image">
                            <img src="https://images.unsplash.com/photo-1578365434892-47a6b3f0e11a?auto=format&fit=crop&w=800&q=80"
                                class="w-100 h-100" style="object-fit: cover;" alt="Caffe Latte">
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">Caffe Latte</h5>
                            <p class="card-text text-muted">Lembut dan creamy, dengan kombinasi sempurna antara espresso
                                dan susu.</p>
                            <p class="menu-price">Rp 28.000</p>
                            <button class="btn btn-sm btn-primary w-100">Pesan</button>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card shadow-sm h-100">
                        <div class="menu-card-image">
                            <img src="https://images.unsplash.com/photo-1504674900247-0877df9cc836?auto=format&fit=crop&w=800&q=80"
                                class="w-100 h-100" style="object-fit: cover;" alt="Croissant">
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">Croissant Butter</h5>
                            <p class="card-text text-muted">Renyah di luar, lembut di dalam. Pas untuk menemani
                                secangkir kopi pagi.</p>
                            <p class="menu-price">Rp 22.000</p>
                            <button class="btn btn-sm btn-primary w-100">Pesan</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="text-center mt-5">
                <a href="#" class="btn btn-primary btn-lg">Lihat Menu Lengkap</a>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section class="contact-section" id="kontak">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 mb-5 mb-lg-0">
                    <h3 style="color: var(--primary-color); font-weight: bold; margin-bottom: 20px;">Kunjungi Kami</h3>
                    <div class="mb-4">
                        <h6 class="fw-bold">📍 Lokasi</h6>
                        <p>Jl. Kopi Nikmat No. 123<br>Kota Bandung, Indonesia</p>
                    </div>
                    <div class="mb-4">
                        <h6 class="fw-bold">🕐 Jam Operasional</h6>
                        <p>Senin - Jumat: 07:00 - 21:00<br>Sabtu - Minggu: 08:00 - 22:00</p>
                    </div>
                    <div class="mb-4">
                        <h6 class="fw-bold">📞 Hubungi Kami</h6>
                        <p>(0274) 123-4567<br>hello@sembadacafe.id</p>
                    </div>
                    <a href="https://maps.google.com" target="_blank" class="btn btn-primary">
                        📍 Lihat di Google Maps
                    </a>
                </div>
                <div class="col-lg-6">
                    <h4 class="fw-bold mb-4">Berlangganan Promo Kami</h4>
                    <form>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email Anda</label>
                            <input type="email" class="form-control form-control-lg" id="email"
                                placeholder="nama@email.com" required>
                        </div>
                        <div class="mb-3">
                            <label for="name" class="form-label">Nama Lengkap</label>
                            <input type="text" class="form-control form-control-lg" id="name" placeholder="John Doe"
                                required>
                        </div>
                        <button type="submit" class="btn btn-primary btn-lg w-100">Berlangganan Gratis</button>
                    </form>
                    <p class="text-muted small mt-3">✓ Dapatkan kode diskon eksklusif untuk pelanggan setia kami.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer>
        <div class="container">
            <div class="row mb-4">
                <div class="col-md-4 mb-4 mb-md-0">
                    <h5 style="color: var(--secondary-color);">☕ Sembada Cafe</h5>
                    <p>Tempat di mana setiap cangkir kopi disiapkan dengan penuh cinta dan perhatian.</p>
                </div>
                <div class="col-md-4 mb-4 mb-md-0">
                    <h6 class="fw-bold">Quick Links</h6>
                    <ul class="list-unstyled">
                        <li><a href="#home">Home</a></li>
                        <li><a href="#menu">Menu</a></li>
                        <li><a href="#tentang">Tentang</a></li>
                        <li><a href="#kontak">Kontak</a></li>
                    </ul>
                </div>
                <div class="col-md-4">
                    <h6 class="fw-bold">Follow Us</h6>
                    <p>
                        <a href="#" class="me-2">Facebook</a>
                        <a href="#" class="me-2">Instagram</a>
                        <a href="#">Twitter</a>
                    </p>
                </div>
            </div>
            <hr style="border-color: rgba(255,255,255,0.1);">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <p class="mb-0">&copy; {{ date('Y') }} Sembada Cafe. Semua hak dilindungi.</p>
                </div>
                <div class="col-md-6 text-md-end">
                    <a href="#" class="link-secondary me-3">Kebijakan Privasi</a>
                    <a href="#" class="link-secondary">Syarat & Ketentuan</a>
                </div>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9iADZCUd0eecc96XRDrP9/NC6Pmf+0zAvc5l+JJg4OaJiuAPtjdKWAo9"
        crossorigin="anonymous"></script>
</body>

</html>