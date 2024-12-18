<?php
    $title = "Crimson Dawn";
    $navigation = [
        "Beranda" => "#beranda",
        "Kesiapsiagaan Bencana" => "#kesiapsiagaan",
        "Laporan Anonim" => "#laporan"
    ];
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
    </head>
<body>
    <!-- Header -->
    <header>
        <h1 class="header-title"><?= $title ?></h1>
        <a href="Register.php" class="register-btn">Daftar</a>
    </header>
    
    <!-- Navbar -->
    <nav>
        <ul>
            <?php foreach ($navigation as $name => $link): ?>
                <li><a href="<?= $link ?>"><?= $name ?></a></li>
            <?php endforeach; ?>
        </ul>
    </nav>

    <!-- Main Content -->
    <main>
        <?php foreach ($cards as $card): ?>
            <section class="card">
                <h2><?= $card['title'] ?></h2>
                <p><?= $card['content'] ?></p>
                <?php if ($card['button_text']): ?>
                    <a href="<?= $card['button_link'] ?>" class="btn"><?= $card['button_text'] ?></a>
                <?php endif; ?>
            </section>
        <?php endforeach; ?>
    </main>

<!-- Footer -->
<footer>
    <div class="footer-container">
        <div class="footer-left">
            <h3>CRIMSON DAWN</h3>
            <p>
                Kami hadir untuk mendukung keamanan komunitas dengan menyediakan informasi terpercaya dan layanan pelaporan yang cepat dan anonim.
            </p>
            <div class="social-icons">
                <a href="#"><img src="icons/facebook.png" alt="Facebook"></a>
                <a href="#"><img src="icons/twitter.png" alt="Twitter"></a>
                <a href="#"><img src="icons/youtube.png" alt="YouTube"></a>
            </div>
        </div>
        <div class="footer-center">
            <h4>Menu</h4>
            <ul>
                <?php foreach ($navigation as $name => $link): ?>
                    <li><a href="<?= $link ?>"><?= $name ?></a></li>
                <?php endforeach; ?>
            </ul>
        </div>
        <div class="footer-right">
            <h4>Kontak Kami</h4>
            <p><i class="fas fa-map-marker-alt"></i> 123 Jalan Raya Keamanan, Kota Aman</p>
            <p><i class="fas fa-phone"></i> 0812-3456-7890</p>
            <p><i class="fas fa-envelope"></i> support@crimsondawn.com</p>
        </div>
    </div>
    <p class="footer-bottom">&copy; <?= date('Y') ?> Crimson Dawn | Semua Hak Dilindungi</p>
</footer>

</body>
</html>

<!-- <!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Crimson Dawn</title>
</head>
<body>
    <header>
        <h1 class="header-title">Crimson Dawn</h1>
        <a href="Register.html" class="register-btn">Daftar</a>
    </header>
    
    <nav>
        <ul>
            <li><a href="#beranda">Beranda</a></li>
            <li><a href="#kesiapsiagaan">Kesiapsiagaan Bencana</a></li>
            <li><a href="#laporan">Laporan Anonim</a></li>
        </ul>
    </nav>
    
    <main>
        <section id="beranda" class="card">
            <h2>Selamat Datang di Jaringan Keamanan Publik</h2>
            <p>Kami berkomitmen untuk menjaga keamanan dan kesejahteraan warga kota. Gunakan layanan kami untuk tetap terinformasi dan berpartisipasi dalam menjaga keamanan komunitas kita.</p>
        </section>
        
        <section id="kesiapsiagaan" class="card">
            <h2>Berita Kriminalitas</h2>
            <p>Tekan tombol di bawah untuk melihat lebih lanjut.</p>
            <a href="Info.php" class="btn">Buka</a>
        </section>
        
        <section id="laporan" class="card">
            <h2>Sistem Pelaporan Tips Anonim</h2>
            <p>Laporkan aktivitas mencurigakan secara anonim untuk membantu menjaga keamanan komunitas kita.</p>
            <a href="Lapor.php" class="btn">Buat Laporan</a>
        </section>
    </main>
    
</body>
</html> -->
