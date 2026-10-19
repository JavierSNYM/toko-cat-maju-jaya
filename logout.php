<?php 
session_start();
// Penjelasan: Menghapus semua session yang tersimpan agar user tidak bisa kembali ke dashboard tanpa login
session_destroy();
header("Location: login.php");
exit;
?>