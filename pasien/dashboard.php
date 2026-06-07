<?php

include "../middleware/auth.php";

if($_SESSION['role'] != 'pasien'){
    die("Akses Ditolak");
}
?>

<h1>Dashboard Pasien</h1>

<p>
Selamat datang
<?= htmlspecialchars($_SESSION['nama']) ?>
</p>

<a href="../auth/logout.php">
Logout
</a>

<a
href="rekam_medis.php"
class="btn btn-primary">

Lihat Rekam Medis

</a>

<a
href="upload.php"
class="btn btn-success">

Upload Hasil Lab

</a>