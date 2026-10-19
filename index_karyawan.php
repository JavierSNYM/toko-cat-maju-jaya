<?php
session_start();
if (!isset($_SESSION['login'])) header("Location: login.php");
include 'koneksi.php';

// Penjelasan: Menangkap parameter 'pesan' dari URL untuk notifikasi
$pesan = "";
if(isset($_GET['status'])) {
    if($_GET['status'] == 'sukses_tambah') $pesan = "Data berhasil ditambahkan!";
    if($_GET['status'] == 'sukses_hapus') $pesan = "Data berhasil dihapus!";
}

$search = $_GET['search'] ?? '';
$filter = $_GET['filter'] ?? '';

$sql = "SELECT * FROM karyawan WHERE nama LIKE '%$search%'";
if($filter) $sql .= " AND jabatan = '$filter'";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h2>Data Karyawan PT Maju Jaya</h2>

        <?php if($pesan): ?>
            <div class="alert alert-success"><?= $pesan; ?></div>
        <?php endif; ?>

        <form method="get" style="margin-bottom: 20px;">
            <input type="text" name="search" placeholder="Cari nama..." value="<?= $search ?>">
            <select name="filter">
                <option value="">Semua Jabatan</option>
                <option value="Manager">Manager</option>
                <option value="Staff">Staff</option>
                <option value="Programmer">Programmer</option>
            </select>
            <button type="submit" class="btn btn-edit">Cari & Filter</button>
            <a href="index_karyawan.php" class="btn btn-delete">Reset</a>
        </form>

        <a href="tambah.php" class="btn btn-add">+ Tambah Karyawan</a>

        <table>
            <tr>
                <th>ID</th><th>Nama</th><th>Jabatan</th><th>Email</th><th>Aksi</th>
            </tr>
            <?php while($row = mysqli_fetch_assoc($result)): ?>
            <tr>
                <td><?= $row['id']; ?></td>
                <td><?= $row['nama']; ?></td>
                <td><?= $row['jabatan']; ?></td>
                <td><?= $row['email']; ?></td>
                <td>
                    <a href="edit.php?id=<?= $row['id']; ?>" class="btn btn-edit">Edit</a>
                    <a href="hapus.php?id=<?= $row['id']; ?>" class="btn btn-delete" onclick="return confirm('Hapus data ini?')">Hapus</a>
                </td>
            </tr>
            <?php endwhile; ?>
        </table>
        <br>
        <a href="dashboard.php"> Kembali ke Dashboard</a>
    </div>
</body>
</html>