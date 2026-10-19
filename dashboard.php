<?php
session_start();
if (!isset($_SESSION['login'])) header("Location: login.php");
include 'koneksi.php';

// Ambil total karyawan
$res = mysqli_query($conn, "SELECT COUNT(*) as total FROM karyawan");
$count = mysqli_fetch_assoc($res);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard - PT Maju Jaya</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h2>Selamat Datang di Sistem SIPA PT Maju Jaya</h2>
        <hr>
        <div style="display: flex; gap: 20px;">
            <div style="background: #3498db; color: white; padding: 20px; border-radius: 8px; flex: 1;">
                <h3>Total Karyawan</h3>
                <h1 style="font-size: 40px;"><?= $count['total']; ?></h1>
            </div>
            <div style="flex: 2;">
                <p>Gunakan navigasi di bawah untuk mengelola data:</p>
                <a href="index_karyawan.php" class="btn btn-add">Kelola Karyawan</a>
                <a href="logout.php" class="btn btn-delete">Logout</a>
            </div>
        </div>
    </div>
    <div style="margin-top: 20px; border-top: 1px solid #eee; padding-top: 10px;">
    <p>Pengaturan Sistem:</p>
    <a href="registrasi.php" class="btn btn-edit"> + Tambah User Admin Baru</a>
</div>
</body>
</html>