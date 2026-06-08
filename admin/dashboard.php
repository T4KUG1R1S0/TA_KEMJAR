<?php
/** @var mysqli $conn */
include "../middleware/auth.php";
include "../config/koneksi.php";

if($_SESSION['role'] != 'admin'){
    die("Akses ditolak");
}

$totalPasien = mysqli_fetch_assoc(
    mysqli_query($conn,"SELECT COUNT(*) as total FROM users WHERE role='pasien'")
)['total'];

$totalDokter = mysqli_fetch_assoc(
    mysqli_query($conn,"SELECT COUNT(*) as total FROM users WHERE role='dokter'")
)['total'];

$totalRekam = mysqli_fetch_assoc(
    mysqli_query($conn,"SELECT COUNT(*) as total FROM rekam_medis")
)['total'];

?>

<!DOCTYPE html>
<html>
<head>

<title>Admin Dashboard</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<link rel="stylesheet" href="../assets/css/style.css">

</head>

<body>

<nav class="navbar navbar-dark">

<div class="container">

<span class="navbar-brand">
🏥 MediSecure Admin
</span>

<a href="../auth/logout.php" class="btn btn-light">
Logout
</a>

</div>

</nav>

<div class="container dashboard-container">

<h2 class="dashboard-title">
Dashboard Administrator
</h2>

<div class="row">

<div class="col-md-4">

<div class="stat-card bg-pasien">

<h5>Total Pasien</h5>

<div class="stat-number">
<?= $totalPasien ?>
</div>

</div>

</div>

<div class="col-md-4">

<div class="stat-card bg-dokter">

<h5>Total Dokter</h5>

<div class="stat-number">
<?= $totalDokter ?>
</div>

</div>

</div>

<div class="col-md-4">

<div class="stat-card bg-rekam">

<h5>Total Rekam Medis</h5>

<div class="stat-number">
<?= $totalRekam ?>
</div>

</div>

</div>

</div>

<div class="row mt-4">

<div class="col-md-4">

<a href="dokter.php" class="text-decoration-none">

<div class="menu-card">

<div class="menu-icon">
👨‍⚕️
</div>

<div class="menu-title">
Kelola Dokter
</div>

</div>

</a>

</div>

<div class="col-md-4">

<a href="pasien.php" class="text-decoration-none">

<div class="menu-card">

<div class="menu-icon">
🧑‍🤝‍🧑
</div>

<div class="menu-title">
Kelola Pasien
</div>

</div>

</a>

</div>

</div>

</div>

</body>
</html>