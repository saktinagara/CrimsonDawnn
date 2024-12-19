<?php
include 'config.php'; // Menghubungkan ke database

// Ambil Data Berita
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
</head>
<body>
    <h1>Info Berita</h1>

    <div class="berita-container">
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<div class='card'>";
                echo "<div class='card-header'>";
                echo "<h2>" . htmlspecialchars($row['judul']) . "</h2>";
                echo "</div>";
                echo "<div class='card-body'>";
                echo "<p>" . htmlspecialchars($row['konten']) . "</p>";
                echo "</div>";
                echo "<div class='card-footer'>";
                echo "<p class='timestamp'><i class='far fa-clock'></i> " . date('d-m-Y H:i', strtotime($row['tanggal'])) . "</p>";
                echo "</div>";
                echo "</div>";
            }
        } else {
            echo "<div class='card card-empty'>";
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
</body>
</html>

<?php
$conn->close(); // Menutup koneksi database
?>