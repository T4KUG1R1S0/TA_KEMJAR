<?php

/** @var mysqli $conn */

include "../middleware/auth.php";
include "../config/koneksi.php";

if($_SESSION['role']!='admin'){
    die("Akses ditolak");
}

$pasien = mysqli_fetch_assoc(
mysqli_query($conn,
"SELECT COUNT(*) total FROM pasien")
);

$dokter = mysqli_fetch_assoc(
mysqli_query($conn,
"SELECT COUNT(*) total FROM dokter")
);

$rekam = mysqli_fetch_assoc(
mysqli_query($conn,
"SELECT COUNT(*) total FROM rekam_medis")
);
?>

<h1>Dashboard Admin</h1>

<p>Selamat datang <?= $_SESSION['nama'] ?></p>

<ul>
<li>Total Pasien : <?= $pasien['total'] ?></li>
<li>Total Dokter : <?= $dokter['total'] ?></li>
<li>Total Rekam Medis : <?= $rekam['total'] ?></li>
</ul>

<a href="dokter.php">Kelola Dokter</a><br>
<a href="pasien.php">Kelola Pasien</a><br>
<a href="logs.php">Activity Logs</a><br>
<a href="../auth/logout.php">Logout</a>