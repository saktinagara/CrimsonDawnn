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
    <link rel="stylesheet" href="css/style.css"> <!-- Ganti dengan CSS Anda -->
</head>
<body>
    <h1>Info Berita</h1>

    <div class="berita-container">
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<div class='berita-item'>";
                echo "<h2>" . htmlspecialchars($row['judul']) . "</h2>";
                echo "<p>" . htmlspecialchars($row['konten']) . "</p>";
                echo "<p><em>" . date('d-m-Y H:i', strtotime($row['tanggal'])) . "</em></p>";
                echo "</div>";
            }
        } else {
            echo "<p>Tidak ada berita yang tersedia.</p>";
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