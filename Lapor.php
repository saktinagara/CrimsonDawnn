<?php
include 'config.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $jenis = $_POST['jenis'];
    $lokasi = $_POST['lokasi'];
    $tanggal = $_POST['tanggal'];
    $deskripsi = $_POST['deskripsi'];
    $kontak = $_POST['kontak'];
    $lat = $_POST['lat'];
    $lng = $_POST['lng'];

    $stmt = $conn->prepare("INSERT INTO laporan (jenis, lokasi, tanggal, deskripsi, kontak, lat, lng) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssss", $jenis, $lokasi, $tanggal, $deskripsi, $kontak, $lat, $lng);

    if ($stmt->execute()) {
        echo "<script>alert('Laporan Anda telah diterima. Terima kasih atas partisipasi Anda.');</script>";
    } else {
        echo "<script>alert('Terjadi kesalahan. Silakan coba lagi.');</script>";
    }

    $stmt->close();
    $conn->close();
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulir Pelaporan</title>
    <link rel="stylesheet" href="css/lapor-style.css">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
    <style>
        #map { height: 400px; width: 100%; }
    </style>
</head>
<body>
    <a href="welcome.php" class="back-button">Kembali</a>
    <div class="container">
        <h1>Formulir Pelaporan</h1>
        <form id="laporanForm" method="POST" action="">
            <label for="jenis">Jenis Laporan:</label>
            <select id="jenis" name="jenis" required>
                <option value="">Pilih jenis laporan</option>
                <option value="kejahatan">Kejahatan</option>
                <option value="kecelakaan">Kecelakaan</option>
                <option value="bencana">Bencana</option>
                <option value="lainnya">Lainnya</option>
            </select>

            <label for="lokasi">Lokasi Kejadian:</label>
            <input type="text" id="lokasi" name="lokasi" required>

            <label for="tanggal">Tanggal Kejadian:</label>
            <input type="date" id="tanggal" name="tanggal" required>

            <label for="deskripsi">Deskripsi Kejadian:</label>
            <textarea id="deskripsi" name="deskripsi" rows="5" required></textarea>

            <label for="kontak">Kontak (opsional):</label>
            <input type="text" id="kontak" name="kontak">

            <div id="map"></div>
            <input type="hidden" id="lat" name="lat">
            <input type="hidden" id="lng" name="lng">

            <button type="submit">Kirim Laporan</button>
        </form>
    </div>
    <script>
        var map = L.map('map').setView([-6.2088, 106.8456], 13);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);

        map.on('click', function(e) {
            var lat = e.latlng.lat;
            var lng = e.latlng.lng;
            document.getElementById('lat').value = lat;
            document.getElementById('lng').value = lng;
            L.marker([lat, lng]).addTo(map);
        });
    </script>
</body>
</html>
