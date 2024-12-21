<?php
include 'config.php';
session_start();

header("Cache-Control: no-cache, no-store, must-revalidate");
header("Pragma: no-cache");
header("Expires: 0");

ini_set('upload_max_filesize', '10M');
ini_set('post_max_size', '10M');
ini_set('max_file_uploads', '20');

// Proses Tambah Data
if (isset($_POST['add'])) {
    $judul = $_POST['judul'];
    $konten = $_POST['konten'];
    $gambar_path = "";
    
    // Proses upload gambar
    if (isset($_FILES['gambar']) && $_FILES['gambar']['error'][0] !== 4) {
        $target_dir = "uploads/";
        if (!file_exists($target_dir)) {
            mkdir($target_dir, 0777, true);
        }
        
        $file_extension = pathinfo($_FILES['gambar']['name'][0], PATHINFO_EXTENSION);
        $gambar_name = uniqid() . '.' . $file_extension;
        $target_file = $target_dir . $gambar_name;
        
        if (move_uploaded_file($_FILES['gambar']['tmp_name'][0], $target_file)) {
            $gambar_path = $target_file;
        } else {
            echo "<script>alert('Error uploading file!'); window.location='dashboard.php';</script>";
            exit();
        }
    }
    
    $sql = "INSERT INTO berita (judul, konten, gambar, tanggal) VALUES (?, ?, ?, NOW())";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $judul, $konten, $gambar_path);
    
    if ($stmt->execute()) {
        echo "<script>alert('Data berhasil ditambahkan!'); window.location='dashboard.php';</script>";
    } else {
        echo "<script>alert('Gagal menambahkan data!'); window.location='dashboard.php';</script>";
    }
    exit();
}

// Proses Edit Data
if (isset($_POST['edit'])) {
    $edit_id = $_POST['edit_id'];
    $judul = $_POST['judul'];
    $konten = $_POST['konten'];
    
    if (isset($_FILES['gambar']) && $_FILES['gambar']['error'] === 0) {
        // Upload gambar baru
        $target_dir = "uploads/";
        if (!file_exists($target_dir)) {
            mkdir($target_dir, 0777, true);
        }
        
        // Hapus gambar lama
        $sql_get_image = "SELECT gambar FROM berita WHERE id = ?";
        $stmt = $conn->prepare($sql_get_image);
        $stmt->bind_param("i", $edit_id);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($row = $result->fetch_assoc()) {
            if (!empty($row['gambar']) && file_exists($row['gambar'])) {
                unlink($row['gambar']);
            }
        }
        
        // Upload gambar baru
        $file_extension = pathinfo($_FILES['gambar']['name'], PATHINFO_EXTENSION);
        $gambar_name = uniqid() . '.' . $file_extension;
        $target_file = $target_dir . $gambar_name;
        
        if (move_uploaded_file($_FILES['gambar']['tmp_name'], $target_file)) {
            $sql = "UPDATE berita SET judul=?, konten=?, gambar=? WHERE id=?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("sssi", $judul, $konten, $target_file, $edit_id);
        } else {
            echo "<script>alert('Error uploading file!'); window.location='dashboard.php';</script>";
            exit();
        }
    } else {
        // Update tanpa gambar
        $sql = "UPDATE berita SET judul=?, konten=? WHERE id=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssi", $judul, $konten, $edit_id);
    }
    
    if ($stmt->execute()) {
        echo "<script>alert('Data berhasil diupdate!'); window.location='dashboard.php';</script>";
    } else {
        echo "<script>alert('Gagal mengupdate data! Error: " . $stmt->error . "'); window.location='dashboard.php';</script>";
    }
    exit();
}

// Proses Hapus Data
if (isset($_GET['delete_id'])) {
    try {
        $conn->begin_transaction();
        
        $delete_id = $_GET['delete_id'];
        
        // Ambil informasi gambar sebelum menghapus
        $sql_get_image = "SELECT gambar FROM berita WHERE id = ?";
        $stmt = $conn->prepare($sql_get_image);
        $stmt->bind_param("i", $delete_id);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($row = $result->fetch_assoc()) {
            if (!empty($row['gambar']) && file_exists($row['gambar'])) {
                unlink($row['gambar']);
            }
        }
        
        // Hapus reactions terlebih dahulu
        $sql_delete_reactions = "DELETE FROM berita_reactions WHERE berita_id = ?";
        $stmt_reactions = $conn->prepare($sql_delete_reactions);
        $stmt_reactions->bind_param("i", $delete_id);
        $stmt_reactions->execute();
        
        // Hapus berita
        $sql_delete_berita = "DELETE FROM berita WHERE id = ?";
        $stmt_berita = $conn->prepare($sql_delete_berita);
        $stmt_berita->bind_param("i", $delete_id);
        
        if ($stmt_berita->execute()) {
            $conn->commit();
            echo "<script>alert('Data berhasil dihapus!'); window.location='dashboard.php';</script>";
        } else {
            throw new Exception("Gagal menghapus berita");
        }
    } catch (Exception $e) {
        $conn->rollback();
        echo "<script>alert('Gagal menghapus data: " . $e->getMessage() . "'); window.location='dashboard.php';</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Info Berita</title>
    <link rel="stylesheet" href="css/dashboard-style.css">
    <style>
        .table-container {
            overflow-x: auto;
        }
        
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            background-color: #1a1a1a;
            color: white;
        }
        
        th, td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #333;
        }
        
        th {
            background-color: #5DC7B6;
            color: white;
            font-weight: normal;
        }
        
        tr:hover {
            background-color: #2a2a2a;
        }
        
        .action-buttons {
            display: flex;
            gap: 8px;
            justify-content: flex-start;
            align-items: center;
        }

        .action-buttons a, 
        .action-buttons button {
            padding: 6px 16px;
            border-radius: 4px;
            text-decoration: none;
            cursor: pointer;
            border: none;
            font-size: 14px;
            font-weight: 500;
            transition: all 0.2s ease;
            min-width: 70px;
            text-align: center;
        }

        .action-buttons a {
            background-color: #dc3545;
            color: white;
            line-height: 24px;
            display: inline-block;
        }

        .action-buttons button {
            background-color: #5DC7B6;
            color: white;
            line-height: 24px;
        }

        .action-buttons a:hover {
            background-color: #c82333;
            transform: translateY(-1px);
        }

        .action-buttons button:hover {
            background-color: #4ca899;
            transform: translateY(-1px);
        }   

        .thumbnail {
            max-width: 100px;
            max-height: 100px;
            object-fit: cover;
        }

        form {
            background-color: #2a2a2a;
            padding: 20px;
            border-radius: 8px;
            margin-bottom: 20px;
        }

        input[type="text"],
        textarea {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            background-color: #333;
            border: 1px solid #444;
            color: white;
            border-radius: 4px;
        }

        textarea {
            min-height: 100px;
            resize: vertical;
        }

        button[type="submit"] {
            background-color: #5DC7B6;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        button[type="submit"]:hover {
            background-color: #4ca899;
        }

        #editForm {
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <?php include 'navbaradmin.php'; ?>
    
    <div class="container">
        <h1>Dashboard Berita</h1>

        <h2>Tambah Berita</h2>
        <form action="dashboard.php" method="POST" enctype="multipart/form-data">
            <input type="text" name="judul" placeholder="Judul" required>
            <textarea name="konten" placeholder="Konten" required></textarea>
            <input type="file" name="gambar[]" accept="image/*">
            <small>*Pilih file gambar</small>
            <button type="submit" name="add">Tambah</button>
        </form>

        <!-- Form Edit -->
        <div id="editForm" style="display:none;">
            <h2>Edit Berita</h2>
            <form action="dashboard.php" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="edit_id" id="edit_id">
                <input type="text" name="judul" id="edit_judul" required>
                <textarea name="konten" id="edit_konten" required></textarea>
                <input type="file" name="gambar" accept="image/*">
                <p class="file-note">*Biarkan kosong jika tidak ingin mengubah gambar</p>
                <button type="submit" name="edit">Simpan Perubahan</button>
                <button type="button" onclick="hideEditForm()">Batal</button>
            </form>
        </div>

        <h2>Daftar Berita</h2>
        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Judul</th>
                        <th>Konten</th>
                        <th>Gambar</th>
                        <th>Tanggal</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sql = "SELECT * FROM berita ORDER BY tanggal DESC";
                    $result = $conn->query($sql);
                    
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>
                                <td>{$row['id']}</td>
                                <td>{$row['judul']}</td>
                                <td>{$row['konten']}</td>
                                <td>" . (!empty($row['gambar']) ? 
                                    "<img src='{$row['gambar']}' alt='Gambar Berita' class='thumbnail'>" : 
                                    "Tidak ada gambar") . "</td>
                                <td>" . date('Y-m-d H:i:s', strtotime($row['tanggal'])) . "</td>
                                <td class='action-buttons'>
                                    <a href='javascript:void(0)' onclick='confirmDelete({$row['id']})'>Hapus</a>
                                    <button type='button' onclick='showEditForm({$row['id']}, `{$row['judul']}`, `{$row['konten']}`)'>Edit</button>
                                </td>
                            </tr>";
                        }
                    } else {
                        echo "<tr><td colspan='6'>Belum ada berita.</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>

    <script>
        function confirmDelete(id) {
            if (confirm('Apakah Anda yakin ingin menghapus data ini?')) {
                window.location.href = 'dashboard.php?delete_id=' + id;
            }
        }

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

<?php $conn->close(); ?>