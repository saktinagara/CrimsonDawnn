<?php
include 'config.php';
session_start();

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

$sql = "SELECT * FROM laporan ORDER BY created_at DESC";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Data Laporan</title>
    <link rel="stylesheet" href="css/admin-style.css?v=1.0">
</head>
<body>
    <div class="container">
        <div class="header">
        <a href="keluar.php" class="logout-btn">Keluar</a>
        </div>

        <h1>Data Laporan Kriminalitas</h1>

        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>JENIS</th>
                        <th>LOKASI</th>
                        <th>TANGGAL</th>
                        <th>DESKRIPSI</th>
                        <th>KONTAK</th>
                        <th>LATITUDE</th>
                        <th>LONGITUDE</th>
                        <th>WAKTU LAPORAN</th>
                        <th>AKSI</th>
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
                                <td><button class='hapus' onclick='if(confirm(\"Apakah Anda yakin ingin menghapus data ini?\")) window.location.href=\"?delete_id={$row['id']}\";'>Hapus</button></td>
                            </tr>";
                        }
                    } else {
                        echo "<tr><td colspan='10' style='text-align: center;'>Belum ada laporan.</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
<?php $conn->close(); ?>