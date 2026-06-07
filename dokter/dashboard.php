<?php

include "../middleware/auth.php";

if($_SESSION['role']!='dokter'){
    die("Akses ditolak");
}
?>

<h1>Dashboard Dokter</h1>

<a href="rekam_medis.php">
Kelola Rekam Medis
</a>