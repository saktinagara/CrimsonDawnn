<?php
include 'config.php';
session_start();

// Proses Tambah Data
if (isset($_POST['add'])) {
    $judul = $_POST['judul'];
    $konten = $_POST['konten'];
    
    $sql_add = "INSERT INTO berita (judul, konten, tanggal) VALUES (?, ?, NOW())";
    $stmt = $conn->prepare($sql_add);
    $stmt->bind_param("ss", $judul, $konten);
    $stmt->execute();
}

// Proses Hapus Data
if (isset($_GET['delete_id'])) {
    $delete_id = $_GET['delete_id'];
    $sql_delete = "DELETE FROM berita WHERE id = ?";
    $stmt = $conn->prepare($sql_delete);
    $stmt->bind_param("i", $delete_id);
    $stmt->execute();
}

// Proses Edit Data
if (isset($_POST['edit'])) {
    $edit_id = $_POST['edit_id'];
    $judul = $_POST['judul'];
    $konten = $_POST['konten'];
    
    $sql_edit = "UPDATE berita SET judul = ?, konten = ? WHERE id = ?";
    $stmt = $conn->prepare($sql_edit);
    $stmt->bind_param("ssi", $judul, $konten, $edit_id);
    if($stmt->execute()) {
        echo "<script>alert('Data berhasil diperbarui!'); window.location='dashboard.php';</script>";
    } else {
        echo "<script>alert('Gagal memperbarui data!'); window.location='dashboard.php';</script>";
    }
}

// Ambil Data Berita
$sql = "SELECT * FROM berita ORDER BY tanggal DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Info Berita</title>
    <link rel="stylesheet" href="css/dashboard-style.css">
</head>
<body>
    <h1>Dashboard Berita</h1>

    <h2>Tambah Berita</h2>
    <form action="" method="POST">
        <input type="text" name="judul" placeholder="Judul" required>
        <textarea name="konten" placeholder="Konten" required></textarea>
        <button type="submit" name="add">Tambah</button>
    </form>

    <!-- Form Edit yang Tersembunyi -->
    <div id="editForm" style="display:none;">
        <h2>Edit Berita</h2>
        <form action="" method="POST">
            <input type="hidden" name="edit_id" id="edit_id">
            <input type="text" name="judul" id="edit_judul" required>
            <textarea name="konten" id="edit_konten" required></textarea>
            <button type="submit" name="edit">Simpan Perubahan</button>
            <button type="button" onclick="hideEditForm()">Batal</button>
        </form>
    </div>

    <h2>Daftar Berita</h2>
    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>Judul</th>
                <th>Konten</th>
                <th>Tanggal</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>
                        <td>{$row['id']}</td>
                        <td>{$row['judul']}</td>
                        <td>{$row['konten']}</td>
                        <td>{$row['tanggal']}</td>
                        <td class='action-buttons'>
                            <a href='?delete_id={$row['id']}' onclick='return confirm(\"Apakah Anda yakin ingin menghapus data ini?\")'>Hapus</a>
                            <button type='button' onclick='showEditForm({$row['id']}, \"{$row['judul']}\", \"{$row['konten']}\")'>Edit</button>
                        </td>
                    </tr>";
                }
            } else {
                echo "<tr><td colspan='5'>Belum ada berita.</td></tr>";
            }
            ?>
        </tbody>
    </table>

    <script>
        function showEditForm(id, judul, konten) {
            document.getElementById('editForm').style.display = 'block';
            document.getElementById('edit_id').value = id;
            document.getElementById('edit_judul').value = judul;
            document.getElementById('edit_konten').value = konten;
            window.scrollTo(0, document.getElementById('editForm').offsetTop);
        }

        function hideEditForm() {
            document.getElementById('editForm').style.display = 'none';
        }
    </script>
</body>
</html>

<?php
$conn->close();
?>