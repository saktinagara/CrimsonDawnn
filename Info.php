<?php
include 'config.php';
$sql = "SELECT * FROM berita ORDER BY tanggal DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Info Berita</title>
    <link rel="stylesheet" href="css/info-style.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <style>
        .berita-container {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 20px;
            padding: 20px;
        }

        .card {
            background: white;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            display: flex;
            flex-direction: column;
        }

        .card-with-image {
            margin-bottom: 30px;
        }

        .card-image {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }

        .card-header {
            padding: 15px;
            background: #5DC7B6;
            color: white;
        }

        .card-header h2 {
            margin: 0;
            font-size: 1.2em;
            color: white;
        }

        .card-body {
            padding: 20px;
            flex-grow: 1;
            background: white;
        }

        .card-body p {
            margin: 0;
            color: #666;
            line-height: 1.5;
        }

        .timestamp {
            padding: 15px 20px;
            color: #666;
            font-size: 0.9em;
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .timestamp i {
            color: #666;
        }

        .content-wrapper {
            padding: 20px;
            max-width: 1200px;
            margin: 80px auto 0;
        }

        .back-button {
            display: inline-flex;
            align-items: center;
            padding: 10px;
            color: #333;
            text-decoration: none;
            margin-bottom: 20px;
        }

        .back-button i {
            margin-right: 5px;
        }

        h1 {
            color: #5DC7B6;
            margin-bottom: 30px;
        }

        footer {
            text-align: center;
            padding: 20px;
            color: #666;
            margin-top: 40px;
        }
    </style>
</head>
<body>
    <header>
        <div class="header-content">
            <h1><a href="welcome.php">Crimson Dawn</a></h1>
            <nav class="global-nav">
                <ul>
                    <li><a href="#beranda">About Us</a></li>
                    <li><a href="#main-co">Services</a></li>
                    <li><a href="#contact">Contact</a></li>
                    <li><a href="index.php">Sign up</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <div class="content-wrapper">
        <a href="javascript:history.back()" class="back-button">
            <i class="fas fa-arrow-left"></i>
        </a>
        
        <h1>Info Berita</h1>

        <div class="berita-container">
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $hasImage = !empty($row['gambar']);
                    $cardClass = $hasImage ? 'card card-with-image' : 'card';
                    
                    echo "<div class='$cardClass'>";
                    
                    if ($hasImage) {
                        echo "<img src='" . htmlspecialchars($row['gambar']) . "' alt='Gambar Berita' class='card-image'>";
                    }
                    
                    echo "<div class='card-header'>";
                    echo "<h2>" . htmlspecialchars($row['judul']) . "</h2>";
                    echo "</div>";
                    
                    echo "<div class='card-body'>";
                    echo "<p>" . htmlspecialchars($row['konten']) . "</p>";
                    echo "</div>";
                    
                    echo "<div class='timestamp'>";
                    echo "<i class='far fa-clock'></i> " . date('d-m-Y H:i', strtotime($row['tanggal']));
                    echo "</div>";
                    
                    echo "</div>";
                }
            } else {
                echo "<div class='card'>";
                echo "<div class='card-body'>";
                echo "<p>Tidak ada berita yang tersedia.</p>";
                echo "</div>";
                echo "</div>";
            }
            ?>
        </div>

        <footer>
            <p>&copy; <?= date('Y') ?> Info Berita. Semua hak dilindungi.</p>
        </footer>
    </div>
</body>
</html>

<?php $conn->close(); ?>