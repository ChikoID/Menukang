
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menukang - Temukan Tukang Terpercaya</title>

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Google Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        :root {
            --green: #3F7D45;
            --light-green: #78A95A;
            --soft: #F5F6F3;
            --dark: #26352A;
        }

        * {
            font-family: 'Poppins', sans-serif;
        }

        body {
            color: var(--dark);
            background: white;
        }

        .navbar {
            background: var(--green);
            padding: 17px 0;
        }

        .navbar-brand {
            color: white;
            font-size: 25px;
            font-weight: 800;
            letter-spacing: 1px;
        }

        .navbar-brand:hover {
            color: white;
        }

        .navbar .nav-link {
            color: rgba(255,255,255,.9);
            font-size: 14px;
            margin: 0 8px;
        }

        .navbar .nav-link:hover {
            color: #D8F0C9;
        }

        .btn-login {
            background: white;
            color: var(--green);
            border-radius: 8px;
            padding: 9px 23px;
            font-weight: 600;
        }

        .btn-login:hover {
            background: #eaf2e8;
            color: var(--green);
        }

        .hero {
            background: var(--soft);
            padding: 90px 0;
        }

        .hero h1 {
            font-size: clamp(32px, 4vw, 49px);
            font-weight: 800;
            line-height: 1.3;
            margin-bottom: 22px;
        }

        .hero h1 span {
            color: var(--green);
        }

        .hero p {
            color: #68736A;
            line-height: 1.9;
            font-size: 15px;
            max-width: 500px;
        }

        .btn-main {
            background: var(--green);
            color: white;
            padding: 13px 27px;
            border-radius: 9px;
            font-weight: 600;
            border: none;
        }

        .btn-main:hover {
            background: #326638;
            color: white;
        }

        .hero-image {
            width: 100%;
            height: 370px;
            object-fit: cover;
            border-radius: 22px;
            box-shadow: 0 15px 35px rgba(0,0,0,.12);
        }

        .section-padding {
            padding: 80px 0;
        }

        .section-title {
            font-weight: 700;
            color: var(--dark);
        }

        .section-desc {
            color: #7B847C;
            font-size: 14px;
        }

        .category-card {
            background: white;
            border: 1px solid #E9EDE8;
            border-radius: 16px;
            overflow: hidden;
            transition: .3s;
            height: 100%;
        }

        .category-card:hover {
            transform: translateY(-7px);
            box-shadow: 0 12px 28px rgba(0,0,0,.08);
        }

        .category-card img {
            width: 100%;
            height: 220px;
            object-fit: cover;
        }

        .category-content {
            padding: 23px;
        }

        .category-content h5 {
            font-weight: 700;
            font-size: 18px;
        }

        .category-content p {
            color: #7B847C;
            font-size: 13px;
            line-height: 1.8;
        }

        .btn-outline-green {
            border: 1px solid var(--green);
            color: var(--green);
            border-radius: 8px;
            font-weight: 600;
            font-size: 13px;
            padding: 9px 17px;
        }

        .btn-outline-green:hover {
            background: var(--green);
            color: white;
        }

        .benefit-section {
            background: var(--soft);
        }

        .benefit-card {
            background: white;
            border-radius: 14px;
            padding: 27px 20px;
            height: 100%;
        }

        .benefit-icon {
            background: #EAF2E8;
            color: var(--green);
            width: 53px;
            height: 53px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 12px;
            font-size: 25px;
            margin-bottom: 18px;
        }

        .benefit-card h6 {
            font-weight: 700;
        }

        .benefit-card p {
            color: #7B847C;
            font-size: 13px;
            line-height: 1.8;
        }

        .cta {
            background: var(--green);
            border-radius: 20px;
            padding: 55px 25px;
            color: white;
        }

        .cta h2 {
            font-weight: 700;
        }

        .btn-white {
            background: white;
            color: var(--green);
            padding: 12px 25px;
            border-radius: 9px;
            font-weight: 600;
        }

        .footer {
            background: #26352A;
            color: white;
            padding: 45px 0 20px;
        }

        .footer p {
            color: #C1C9C1;
            font-size: 13px;
            line-height: 1.8;
        }

        .footer a {
            color: #C1C9C1;
            text-decoration: none;
            font-size: 13px;
        }

        .footer a:hover {
            color: white;
        }

        @media (max-width: 768px) {
            .hero {
                padding: 55px 0;
            }

            .hero-image {
                height: 260px;
                margin-top: 35px;
            }

            .section-padding {
                padding: 55px 0;
            }
        }
    </style>
</head>

<body>

<!-- NAVBAR -->
<nav class="navbar navbar-expand-lg navbar-dark sticky-top">
    <div class="container">
        <a class="navbar-brand" href="#">MENUKANG.</a>

        <button class="navbar-toggler" type="button"
            data-bs-toggle="collapse" data-bs-target="#navbarMenu">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarMenu">
            <ul class="navbar-nav ms-auto align-items-lg-center">
                <li class="nav-item">
                    <a class="nav-link" href="#home">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#tentang">Tentang Kami</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#layanan">Layanan</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#keunggulan">Keunggulan</a>
                </li>
                <li class="nav-item ms-lg-3">
                    <a href="/login" class="btn btn-login">Login</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<!-- HERO -->
<section class="hero" id="home">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <span class="badge rounded-pill mb-3"
                    style="background:#E1EDDD;color:#3F7D45;padding:10px 16px;">
                    Solusi Kebutuhan Tenaga Kerja
                </span>

                <h1>
                    Butuh Tukang?
                    Temukan Solusinya di
                    <span>Menukang!</span>
                </h1>

                <p>
                    Bingung mencari tukang untuk kebutuhan bangunan
                    atau kebun? Menukang hadir untuk membantu Anda
                    menemukan tenaga kerja sesuai kebutuhan dengan
                    lebih mudah dan praktis.
                </p>

                <a href="#layanan" class="btn btn-main mt-3">
                    Cari Tukang &nbsp; →
                </a>
            </div>

            <div class="col-lg-6">
                <img
                    src="https://images.unsplash.com/photo-1504307651254-35680f356dfd?w=1000"
                    class="hero-image"
                    alt="Pekerja konstruksi">
            </div>
        </div>
    </div>
</section>

<!-- TENTANG -->
<section class="section-padding" id="tentang">
    <div class="container text-center">
        <h2 class="section-title">Tentang Menukang</h2>

        <p class="section-desc mx-auto mt-3" style="max-width:700px;">
            Menukang merupakan platform yang memudahkan masyarakat
            dalam menemukan tenaga kerja untuk kebutuhan pembangunan,
            renovasi, maupun perawatan taman dan kebun.
            Kami hadir untuk menghubungkan pengguna dengan tukang
            sesuai kategori pekerjaan yang dibutuhkan.
        </p>
    </div>
</section>

<!-- LAYANAN -->
<section class="section-padding" style="background:#F5F6F3;" id="layanan">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="section-title">Layanan Kami</h2>
            <p class="section-desc mt-2">
                Pilih kategori tukang sesuai kebutuhan Anda.
            </p>
        </div>

        <div class="row g-4">
            <div class="col-md-6">
                <div class="category-card">
                    <img
                        src="https://images.unsplash.com/photo-1503387762-592deb58ef4e?w=900"
                        alt="Tukang bangunan">

                    <div class="category-content">
                        <h5>Tukang Bangunan</h5>

                        <p>
                            Membantu kebutuhan pembangunan rumah,
                            renovasi, perbaikan, dan pekerjaan
                            konstruksi lainnya.
                        </p>

                        <a href="/tukang/bangunan"
                            class="btn btn-outline-green">
                            Lihat Tukang →
                        </a>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="category-card">
                    <img
                        src="https://images.unsplash.com/photo-1416879595882-3373a0480b5b?w=900"
                        alt="Tukang kebun">

                    <div class="category-content">
                        <h5>Tukang Kebun</h5>

                        <p>
                            Membantu perawatan taman, pemangkasan
                            tanaman, penataan kebun, dan menjaga
                            kebersihan lingkungan.
                        </p>

                        <a href="/tukang/kebun"
                            class="btn btn-outline-green">
                            Lihat Tukang →
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- KEUNGGULAN -->
<section class="section-padding benefit-section" id="keunggulan">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="section-title">Kenapa Memilih Menukang?</h2>
            <p class="section-desc mt-2">
                Kemudahan dalam menemukan tenaga kerja untuk kebutuhan Anda.
            </p>
        </div>

        <div class="row g-4">
            <div class="col-md-4">
                <div class="benefit-card">
                    <div class="benefit-icon">🔎</div>
                    <h6>Mudah Menemukan Tukang</h6>
                    <p>
                        Temukan tenaga kerja sesuai kategori
                        pekerjaan yang Anda butuhkan.
                    </p>
                </div>
            </div>

            <div class="col-md-4">
                <div class="benefit-card">
                    <div class="benefit-icon">🛠️</div>
                    <h6>Pilihan Layanan</h6>
                    <p>
                        Tersedia pilihan tukang bangunan dan
                        tukang kebun dalam satu platform.
                    </p>
                </div>
            </div>

            <div class="col-md-4">
                <div class="benefit-card">
                    <div class="benefit-icon">⚡</div>
                    <h6>Praktis dan Efisien</h6>
                    <p>
                        Membantu proses pencarian tenaga kerja
                        menjadi lebih mudah dan terorganisir.
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- CTA -->
<section class="section-padding">
    <div class="container">
        <div class="cta text-center">
            <h2>Temukan Tukang yang Anda Butuhkan!</h2>

            <p class="mt-3 mb-4" style="color:#E1EDE0;">
                Mulai cari tenaga kerja sesuai kebutuhan Anda
                bersama Menukang.
            </p>

            <a href="#layanan" class="btn btn-white">
                Mulai Sekarang →
            </a>
        </div>
    </div>
</section>

<!-- FOOTER -->
<footer class="footer">
    <div class="container">
        <div class="row g-4">
            <div class="col-md-6">
                <h4 class="fw-bold">MENUKANG.</h4>
                <p class="mt-3">
                    Solusi mudah untuk menemukan tenaga kerja
                    bangunan dan kebun sesuai kebutuhan Anda.
                </p>
            </div>

            <div class="col-md-3">
                <h6 class="fw-bold mb-3">Navigasi</h6>
                <p><a href="#home">Home</a></p>
                <p><a href="#tentang">Tentang Kami</a></p>
                <p><a href="#layanan">Layanan</a></p>
            </div>

            <div class="col-md-3">
                <h6 class="fw-bold mb-3">Layanan</h6>
                <p><a href="#layanan">Tukang Bangunan</a></p>
                <p><a href="#layanan">Tukang Kebun</a></p>
            </div>
        </div>

        <hr style="border-color:#607064;">

        <p class="text-center mb-0">
            © 2026 Menukang. All Rights Reserved.
        </p>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
