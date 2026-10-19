<?php
include 'koneksi.php';
$id = $_GET['id'];
mysqli_query($conn, "DELETE FROM karyawan WHERE id = $id");
header("Location: index_karyawan.php?pesan=hapus_sukses");
?>