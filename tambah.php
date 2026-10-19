<?php
include 'koneksi.php';
if (isset($_POST['submit'])) {
    $nama = mysqli_real_escape_string($conn, $_POST['nama']);
    $email = $_POST['email'];
    $jabatan = $_POST['jabatan'];
    $tgl = $_POST['tanggal_bergabung'];

    // Validasi Sederhana
    if (empty($nama) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "<script>alert('Data tidak valid!');</script>";
    } else {
        mysqli_query($conn, "INSERT INTO karyawan VALUES('', '$nama', '$jabatan', '$email', '', '$tgl')");
        header("Location: index_karyawan.php");
    }
}
?>
<form method="post">
    <input type="text" name="nama" placeholder="Nama Lengkap" required><br>
    <input type="email" name="email" placeholder="Email" required><br>
    <select name="jabatan">
        <option value="Manager">Manager</option>
        <option value="Staff">Staff</option>
    </select><br>
    <input type="date" name="tanggal_bergabung" required><br>
    <button type="submit" name="submit">Simpan</button>
</form>