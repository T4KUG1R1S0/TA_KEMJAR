<?php

include "../middleware/auth.php";

if($_SESSION['role']!='pasien'){
    die("Akses ditolak");
}
?>

<h1>Dashboard Pasien</h1>

<a href="rekam_medis.php">
Lihat Rekam Medis
</a>

<br><br>

<a href="upload.php">
Upload Hasil Lab
</a>