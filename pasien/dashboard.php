<?php

include "../middleware/auth.php";

if($_SESSION['role'] != 'pasien'){
    die("Akses ditolak");
}

?>

<!DOCTYPE html>
<html>
<head>

<title>Dashboard Pasien</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<link rel="stylesheet" href="../assets/css/style.css">

</head>

<body>

<nav class="navbar navbar-dark">

<div class="container">

<span class="navbar-brand">
🏥 MediSecure
</span>

<a href="../auth/logout.php" class="btn btn-light">
Logout
</a>

</div>

</nav>

<div class="container dashboard-container">

<h2 class="dashboard-title">

Halo,
<?= $_SESSION['nama'] ?>

👋

</h2>

<div class="row">

<div class="col-md-6">

<a href="rekam_medis.php" class="text-decoration-none">

<div class="menu-card">

<div class="menu-icon">
📋
</div>

<div class="menu-title">
Lihat Rekam Medis
</div>

</div>

</a>

</div>

<div class="col-md-6">

<a href="upload.php" class="text-decoration-none">

<div class="menu-card">

<div class="menu-icon">
🧪
</div>

<div class="menu-title">
Upload Hasil Lab
</div>

</div>

</a>

</div>

</div>

</div>

</body>
</html>