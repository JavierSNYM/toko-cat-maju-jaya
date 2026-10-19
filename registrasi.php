<?php
session_start();
// Penjelasan: Hanya admin yang sudah login yang boleh menambah admin baru
if (!isset($_SESSION['login'])) header("Location: login.php");
include 'koneksi.php';

if (isset($_POST['register'])) {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = $_POST['password'];
    $confirm  = $_POST['confirm_password'];

    // Validasi: Cek apakah username sudah ada
    $check = mysqli_query($conn, "SELECT username FROM admin WHERE username = '$username'");
    
    if (mysqli_num_rows($check) > 0) {
        $error = "Username sudah terdaftar!";
    } elseif ($password !== $confirm) {
        $error = "Konfirmasi password tidak cocok!";
    } else {
        // Penjelasan: Mengamankan password dengan enkripsi hash BCRYPT
        $password_aman = password_hash($password, PASSWORD_DEFAULT);
        
        $query = "INSERT INTO admin (username, password) VALUES ('$username', '$password_aman')";
        if (mysqli_query($conn, $query)) {
            echo "<script>alert('Admin baru berhasil ditambahkan!'); window.location='dashboard.php';</script>";
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Tambah Admin - PT Maju Jaya</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container" style="max-width: 500px;">
        <h2>Tambah Akun Admin Baru</h2>
        <p>Gunakan form ini untuk menambah user yang bisa login ke sistem.</p>
        
        <?php if(isset($error)) : ?>
            <div class="alert" style="background:#f8d7da; color:#721c24;"><?= $error; ?></div>
        <?php endif; ?>

        <form method="post">
            <div class="input-group">
                <label>Username Baru:</label>
                <input type="text" name="username" required style="width:100%;">
            </div>
            <div class="input-group">
                <label>Password:</label>
                <input type="password" name="password" required style="width:100%;">
            </div>
            <div class="input-group">
                <label>Konfirmasi Password:</label>
                <input type="password" name="confirm_password" required style="width:100%;">
            </div>
            <br>
            <button type="submit" name="register" class="btn btn-add">Daftarkan Admin</button>
            <a href="dashboard.php" class="btn btn-delete">Batal</a>
        </form>
    </div>
</body>
</html>