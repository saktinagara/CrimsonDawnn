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
    $stmt->execute();
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
    <link rel="stylesheet" href="css/admin-style.css">
</head>
<body>
    <h1>Dashboard Berita</h1>

    <h2>Tambah Berita</h2>
    <form action="" method="POST">
        <input type="text" name="judul" placeholder="Judul" required>
        <textarea name="konten" placeholder="Konten" required></textarea>
        <button type="submit" name="add">Tambah</button>
    </form>

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
                        <td>
                            <a href='?delete_id={$row['id']}' onclick='return confirm(\"Apakah Anda yakin ingin menghapus data ini?\")'>Hapus</a>
                            <button type='button' onclick='editBerita({$row['id']}, \"{$row['judul']}\", \"{$row['konten']}\")'>Edit</button>
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
        function editBerita(id, judul, konten) {
            const form = document.createElement('form');
            form.method = 'POST';
            form.innerHTML = `
                <input type="hidden" name="edit_id" value="${id}">
                <input type="text" name="judul" value="${judul}" required>
                <textarea name="konten" required>${konten}</textarea>
                <button type="submit" name="edit">Simpan</button>
            `;
            document.body.appendChild(form);
            form.submit();
        }
    </script>
</body>
</html>

<?php
$conn->close();
?>