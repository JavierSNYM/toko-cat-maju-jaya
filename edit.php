<?php
session_start();
if (!isset($_SESSION['login'])) header("Location: login.php");
include 'koneksi.php';

// Penjelasan: Mengambil ID dari URL untuk menentukan karyawan mana yang akan diedit
$id = $_GET['id'];
$query = mysqli_query($conn, "SELECT * FROM karyawan WHERE id = $id");
$data = mysqli_fetch_assoc($query);

// Penjelasan: Proses simpan perubahan ke database
if (isset($_POST['update'])) {
    $nama = mysqli_real_escape_string($conn, $_POST['nama']);
    $email = $_POST['email'];
    $jabatan = $_POST['jabatan'];
    $alamat = mysqli_real_escape_string($conn, $_POST['alamat']);
    $tgl = $_POST['tanggal_bergabung'];

    // Validasi email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "Format email tidak valid!";
    } else {
        $update = "UPDATE karyawan SET 
                    nama='$nama', 
                    jabatan='$jabatan', 
                    email='$email', 
                    alamat='$alamat', 
                    tanggal_bergabung='$tgl' 
                    WHERE id=$id";
        
        if (mysqli_query($conn, $update)) {
            header("Location: index_karyawan.php?status=sukses_edit");
            exit;
        } else {
            $error = "Gagal memperbarui data.";
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Karyawan - PT Maju Jaya</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h2>Edit Data Karyawan</h2>
        <hr>

        <?php if(isset($error)): ?>
            <div class="alert" style="background:#f8d7da; color:#721c24;"><?= $error; ?></div>
        <?php endif; ?>

        <form method="post">
            <label>Nama Lengkap:</label><br>
            <input type="text" name="nama" value="<?= $data['nama']; ?>" required style="width:100%;"><br><br>

            <label>Email:</label><br>
            <input type="email" name="email" value="<?= $data['email']; ?>" required style="width:100%;"><br><br>

            <label>Jabatan:</label><br>
            <select name="jabatan" style="width:100%;">
                <option value="Manager" <?= ($data['jabatan'] == 'Manager') ? 'selected' : ''; ?>>Manager</option>
                <option value="Staff" <?= ($data['jabatan'] == 'Staff') ? 'selected' : ''; ?>>Staff</option>
                <option value="Programmer" <?= ($data['jabatan'] == 'Programmer') ? 'selected' : ''; ?>>Programmer</option>
            </select><br><br>

            <label>Alamat:</label><br>
            <textarea name="alamat" rows="4" style="width:100%; border-radius:4px; border:1px solid #ccc;"><?= $data['alamat']; ?></textarea><br><br>

            <label>Tanggal Bergabung:</label><br>
            <input type="date" name="tanggal_bergabung" value="<?= $data['tanggal_bergabung']; ?>" required style="width:100%;"><br><br>

            <button type="submit" name="update" class="btn btn-add">Simpan Perubahan</button>
            <a href="index_karyawan.php" class="btn btn-delete">Batal</a>
        </form>
    </div>
</body>
</html>