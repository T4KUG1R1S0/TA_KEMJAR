<?php

include "../middleware/auth.php";

if($_SESSION['role'] != 'dokter'){
    die("Akses ditolak");
}

?>

<!DOCTYPE html>
<html lang="id">
<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Dashboard Dokter</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="../assets/css/style.css">

<style>

.dashboard-header{
    background:linear-gradient(135deg,#14b8a6,#0f766e);
    padding:40px;
    border-radius:25px;
    color:white;
    margin-bottom:30px;
}

.dashboard-header h2{
    font-weight:700;
}

.menu-card{
    background:white;
    border-radius:20px;
    padding:30px;
    text-align:center;
    box-shadow:0 10px 30px rgba(0,0,0,.08);
    transition:.3s;
    height:100%;
}

.menu-card:hover{
    transform:translateY(-8px);
}

.menu-icon{
    font-size:55px;
    margin-bottom:15px;
}

.menu-title{
    font-size:22px;
    font-weight:600;
    color:#0f766e;
}

.menu-desc{
    color:#64748b;
    margin-top:10px;
}

.stat-card{
    padding:25px;
    border-radius:20px;
    color:white;
    margin-bottom:25px;
}

.bg1{
    background:linear-gradient(135deg,#06b6d4,#0891b2);
}

.bg2{
    background:linear-gradient(135deg,#10b981,#059669);
}

.stat-number{
    font-size:35px;
    font-weight:700;
}

</style>

</head>

<body>

<nav class="navbar navbar-dark">

<div class="container">

<span class="navbar-brand">
👨‍⚕️ MediSecure Doctor Panel
</span>

<a href="../auth/logout.php" class="btn btn-light">
Logout
</a>

</div>

</nav>

<div class="container mt-4">

<div class="dashboard-header">

<h2>
Selamat Datang Dr.
<?= $_SESSION['nama'] ?>
</h2>

<p class="mb-0">
Kelola pasien dan rekam medis dengan mudah.
</p>

</div>

<div class="row">

<div class="col-md-6">

<div class="stat-card bg1">

<div>Total Pasien</div>

<div class="stat-number">
👥
</div>

</div>

</div>

<div class="col-md-6">

<div class="stat-card bg2">

<div>Rekam Medis</div>

<div class="stat-number">
📋
</div>

</div>

</div>

</div>

<div class="row g-4">

<div class="col-md-6">

<a href="rekam_medis.php" class="text-decoration-none">

<div class="menu-card">

<div class="menu-icon">
📋
</div>

<div class="menu-title">
Kelola Rekam Medis
</div>

<div class="menu-desc">
Tambah, edit dan lihat data rekam medis pasien.
</div>

</div>

</a>

</div>

<div class="col-md-6">

<a href="data_pasien.php" class="text-decoration-none">

<div class="menu-card">

<div class="menu-icon">
🩺
</div>

<div class="menu-title">
Data Pasien
</div>

<div class="menu-desc">
Lihat seluruh pasien yang terdaftar pada sistem.
</div>

</div>

</a>

</div>

</div>

</div>

</body>
</html>
