<?php

include "../middleware/auth.php";

if($_SESSION['role'] != 'dokter'){
    die("Akses Ditolak");
}
?>

<h1>Dashboard Dokter</h1>

<p>
Selamat datang
<?= htmlspecialchars($_SESSION['nama']) ?>
</p>

<a href="../auth/logout.php">
Logout
</a>

<?php
include "../middleware/auth.php";

if($_SESSION['role']!='admin'){
    die("Akses Ditolak");
}
?>

<!DOCTYPE html>
<html>
<head>

<title>Admin Dashboard</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body>

<nav class="navbar navbar-dark bg-dark">

<div class="container-fluid">

<span class="navbar-brand">
MediSecure Admin
</span>

<a
href="../auth/logout.php"
class="btn btn-danger">

Logout

</a>

</div>

</nav>

<div class="container mt-4">

<div class="row">

<div class="col-md-4">

<div class="card p-3">

<h4>Kelola Dokter</h4>

<a
href="dokter.php"
class="btn btn-primary">

Masuk

</a>

</div>

</div>

<div class="col-md-4">

<div class="card p-3">

<h4>Kelola Pasien</h4>

<a
href="pasien.php"
class="btn btn-success">

Masuk

</a>

</div>

</div>

<div class="col-md-4">

<div class="card p-3">

<h4>Activity Log</h4>

<a
href="logs.php"
class="btn btn-warning">

Masuk

</a>

</div>

</div>

</div>

</div>

</body>
</html>

<a
href="rekam_medis.php"
class="btn btn-primary">

Kelola Rekam Medis

</a>