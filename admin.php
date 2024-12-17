<?php
include 'config.php';
session_start();

// Proses Hapus Data
if (isset($_GET['delete_id'])) {
    $delete_id = $_GET['delete_id'];
    $sql_delete = "DELETE FROM laporan WHERE id = ?";
    $stmt = $conn->prepare($sql_delete);
    $stmt->bind_param("i", $delete_id);
    if ($stmt->execute()) {
        echo "<script>alert('Data berhasil dihapus!'); window.location='admin.php';</script>";
    } else {
        echo "<script>alert('Terjadi kesalahan saat menghapus data!'); window.location='admin.php';</script>";
    }
}

// Ambil Data Laporan
$sql = "SELECT * FROM laporan ORDER BY created_at DESC";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Data Laporan</title>
    <link rel="stylesheet" href="css/admin-style.css">
</head>
<body>
    <h1>Data Laporan</h1>
    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>Jenis</th>
                <th>Lokasi</th>
                <th>Tanggal</th>
                <th>Deskripsi</th>
                <th>Kontak</th>
                <th>Latitude</th>
                <th>Longitude</th>
                <th>Waktu Laporan</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>
                        <td>{$row['id']}</td>
                        <td>{$row['jenis']}</td>
                        <td>{$row['lokasi']}</td>
                        <td>{$row['tanggal']}</td>
                        <td>{$row['deskripsi']}</td>
                        <td>{$row['kontak']}</td>
                        <td>{$row['lat']}</td>
                        <td>{$row['lng']}</td>
                        <td>{$row['created_at']}</td>
                        <td><a href='?delete_id={$row['id']}' onclick='return confirm(\"Apakah Anda yakin ingin menghapus data ini?\")'>Hapus</a></td>
                    </tr>";
                }
            } else {
                echo "<tr><td colspan='10'>Belum ada laporan.</td></tr>";
            }
            ?>
        </tbody>
    </table>
</body>
</html>
<?php
$conn->close();
?>
