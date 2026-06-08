<?php
/** @var mysqli $conn */
include "../middleware/auth.php";
include "../config/koneksi.php";

if($_SESSION['role'] != 'pasien'){
    die("Akses ditolak");
}

$user_id = $_SESSION['id'];

$stmt = $conn->prepare("
    SELECT
        rm.id,
        rm.keluhan,
        rm.diagnosa,
        rm.tanggal_pemeriksaan

    FROM rekam_medis rm

    JOIN pasien p
    ON rm.pasien_id = p.id

    WHERE p.user_id = ?

    ORDER BY rm.id DESC
");

$stmt->bind_param("i", $user_id);
$stmt->execute();

$data = $stmt->get_result();

?>

<!DOCTYPE html>
<html lang="id">

<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Rekam Medis Saya</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<link rel="stylesheet" href="../assets/css/style.css">

</head>

<body>

<nav class="navbar navbar-dark">

<div class="container">

<span class="navbar-brand">
🏥 MediSecure
</span>

<div>

<a
href="dashboard.php"
class="btn btn-light me-2">

Dashboard

</a>

<a
href="../auth/logout.php"
class="btn btn-danger">

Logout

</a>

</div>

</div>

</nav>

<div class="container page-container">

<div class="page-header">

<h2 class="page-title">
📋 Rekam Medis Saya
</h2>

</div>

<div class="medical-card">

<table class="table table-hover table-bordered">

<thead>

<tr>

<th>No</th>
<th>Keluhan</th>
<th>Diagnosa</th>
<th>Tanggal</th>

</tr>

</thead>

<tbody>

<?php

$no = 1;

if($data->num_rows > 0){

while($row = $data->fetch_assoc()){

?>

<tr>

<td><?= $no++ ?></td>

<td><?= htmlspecialchars($row['keluhan']) ?></td>

<td>

<span class="badge-medical">

<?= htmlspecialchars($row['diagnosa']) ?>

</span>

</td>

<td><?= htmlspecialchars($row['tanggal_pemeriksaan']) ?></td>

</tr>

<?php

}

}else{

?>

<tr>

<td colspan="4" class="text-center">

Belum ada data rekam medis

</td>

</tr>

<?php } ?>

</tbody>

</table>

</div>

</div>

</body>
</html>