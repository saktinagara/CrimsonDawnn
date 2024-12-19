<?php

    $cards = [
        [
            "title" => "Selamat Datang di Jaringan Keamanan Publik",
            "content" => "Kami berkomitmen untuk menjaga keamanan dan kesejahteraan warga kota. Gunakan layanan kami untuk tetap terinformasi dan berpartisipasi dalam menjaga keamanan komunitas kita.",
            "button_text" => "",
            "button_link" => ""
        ],
        [
            "title" => "Berita Kriminalitas",
            "content" => "Tekan tombol di bawah untuk melihat lebih lanjut.",
            "button_text" => "Buka",
            "button_link" => "Info.php"
        ],
        [
            "title" => "Sistem Pelaporan Tips Anonim",
            "content" => "Laporkan aktivitas mencurigakan secara anonim untuk membantu menjaga keamanan komunitas kita.",
            "button_text" => "Buat Laporan",
            "button_link" => "Lapor.php"
        ]
    ];
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crimson Dawn</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/style.css">
    <style>
        html {
            scroll-behavior: smooth;
        }
    </style>
</head>
</head>
<body>
<header>
    <div class="header-content">
        <h1><a href="welcome.php">Crimson Dawn</a></h1>
        <nav class="global-nav">
            <ul>
                <li><a href="#about">About Us</a></li>
                <li><a href="#main-co">Services</a></li>
                <li><a href="#contact">Contact</a></li>
                <li><a href="index.php">Sign up</a></li>
            </ul>
        </nav>
    </div>
</header>

    <!-- Hero Section -->
    <section class="hero" id="about">
        <h2>FIGHT CRIME WITH US</h2>
        <i>"Justice thrives when we stand together. Join us to fight crime and make a difference."</i>
    </section>

    <!-- Main Content -->
<main>
    <section class="main-content" id="main-co">
        <h2 class="section-title">OUR SERVICES</h2>
        <div class="card-container">
            <!-- Card 1: Berita Kriminalitas -->
            <section id="kesiapsiagaan" class="content-card">
                <div class="service-card">
                    <div class="card-icon">
                        <img src="img/news" alt="News Icon">
                    </div>
                    <h3>Berita Kriminalitas</h3>
                    <p>Tekan tombol di bawah untuk melihat berita mengenai kejahatan-kejahatan lebih lanjut.</p>
                    <a href="Info.php" class="btn">Buka</a>
                </div>
            </section>

            <!-- Card 2: Pelaporan Anonim -->
            <section id="laporan" class="content-card">
                <div class="service-card">
                    <div class="card-icon">
                        <img src="img/report-icon.png" alt="Report Icon">
                    </div>
                    <h3>Sistem Pelaporan</h3>
                    <p>Laporkan aktivitas mencurigakan secara anonim untuk membantu menjaga keamanan komunitas kita.</p>
                    <a href="Lapor.php" class="btn">Buat Laporan</a>
                </div>
            </section>
        </div>
    </section>
</main>

<!-- Section Why Choose Us -->
<section id="why-choose-us" class="why-choose-us">
    <h2 class="section-title">Why Choose Us</h2>
    <div class="why-container">
        <!-- Item 1 -->
        <div class="why-bar">
            <div class="why-icon">
                <img src="https://cdn-icons-png.flaticon.com/512/3135/3135715.png" alt="Keamanan" />
            </div>
            <div class="why-content">
                <h3>Keamanan Terjamin</h3>
                <p>Kami memastikan layanan aman dengan enkripsi tingkat tinggi untuk melindungi data Anda.</p>
            </div>
        </div>
        <!-- Item 2 -->
        <div class="why-bar">
            <div class="why-icon">
                <img src="https://cdn-icons-png.flaticon.com/512/3565/3565401.png" alt="Support" />
            </div>
            <div class="why-content">
                <h3>Pelayanan 24/7</h3>
                <p>Tim kami selalu siap membantu Anda kapan saja, di mana saja dengan cepat.</p>
            </div>
        </div>
        <!-- Item 3 -->
        <div class="why-bar">
            <div class="why-icon">
                <img src="https://cdn-icons-png.flaticon.com/512/753/753318.png" alt="Mudah Digunakan" />
            </div>
            <div class="why-content">
                <h3>Mudah Digunakan</h3>
                <p>Antarmuka yang ramah pengguna dan sederhana memudahkan akses layanan kami.</p>
            </div>
        </div>
    </div>
</section>

    <!-- Footer Section -->
<footer class="footer" id="contact">
    <div class="footer-container">
        <div class="footer-brand">
            <h3>Crimson<span>Dawn</span>.</h3>
            <p>All content on this website is protected by copyright and may not be used 
                <br> without permission from SafetyNet Group.</p>
            <div class="social-icons">
                <a href="#"><i class="fa fa-facebook"></i></a>
                <a href="#"><i class="fa fa-twitter"></i></a>
                <a href="#"><i class="fa fa-instagram"></i></a>
            </div>
        </div>

        <div class="footer-links">
            <div class="footer-column">
                <h4>Company</h4>
                <ul>
                    <li><a href="#">About Us</a></li>
                    <li><a href="#">Our Services</a></li>
                    <li><a href="#">Contact</a></li>
                </ul>
            </div>
            <div class="footer-column">
                <h4>Contact</h4>
                <ul>
                    <li>CrimsonDawn.id</li>
                    <li>crimsondawn@safetynet.com</li>
                </ul>
            </div>
        </div>
    </div>
    <div class="footer-bottom">
        <p>&copy; 2023 CrimsonDawn. All Rights Reserved.</p>
    </div>
</footer>

<script>
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            document.querySelector(this.getAttribute('href')).scrollIntoView({
                behavior: 'smooth'
            });
        });
    });
</script>

</body>
</html>
