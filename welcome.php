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
                    <img src="image/news.jpg" alt="News Icon">
                    </div>
                    <h3>News Crime</h3>
                    <p>Press the button below to see news about more crimes.</p>
                    <a href="Info.php" class="btn">Open</a>
                </div>
            </section>

            <!-- Card 2: Pelaporan Anonim -->
            <section id="laporan" class="content-card">
                <div class="service-card">
                    <div class="card-icon">
                    <img src="image/report.jpg" alt="Report Icon">
                    </div>
                    <h3>Reporting System</h3>
                    <p>
                    Report suspicious activity anonymously to help keep our community safe.</p>
                    <a href="Lapor.php" class="btn">Make a Report</a>
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
                <h3>Guaranteed Security</h3>
                <p>
                We ensure secure services with high-level encryption to protect your data.</p>
            </div>
        </div>
        <!-- Item 2 -->
        <div class="why-bar">
            <div class="why-icon">
                <img src="https://cdn-icons-png.flaticon.com/512/3565/3565401.png" alt="Support" />
            </div>
            <div class="why-content">
                <h3>24/7 Service</h3>
                <p>
                Our team is always ready to help you anytime, anywhere quickly.</p>
            </div>
        </div>
        <!-- Item 3 -->
        <div class="why-bar">
            <div class="why-icon">
                <img src="https://cdn-icons-png.flaticon.com/512/753/753318.png" alt="Mudah Digunakan" />
            </div>
            <div class="why-content">
                <h3>Easy to Use</h3>
                <p>User friendly and simple interface makes it easy to access our services.</p>
            </div>
        </div>
    </div>
</section>

    <!-- Footer Section -->
<footer class="footer" id="contact">
    <div class="footer-container">
        <div class="footer-brand">
            <h3>Crimson<span>Dawn</span></h3>
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

                    <!-- easter egg -->
                    <li><a href="game.php" class="transparent-btn" style="opacity: 0;">+</a></li>
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
