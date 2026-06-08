<?php
/** @var mysqli $conn */
include "../middleware/auth.php";
include "../config/koneksi.php";

if($_SESSION['role'] != 'dokter'){
    die("Akses ditolak");
}

/* TAMBAH REKAM MEDIS */

if(isset($_POST['simpan'])){

    $pasien_id = $_POST['pasien_id'];
    $keluhan = $_POST['keluhan'];
    $diagnosa = $_POST['diagnosa'];
    $tanggal = date('Y-m-d');

    $stmt = $conn->prepare("
        INSERT INTO rekam_medis
        (pasien_id, keluhan, diagnosa, tanggal_pemeriksaan)
        VALUES (?,?,?,?)
    ");

    $stmt->bind_param(
        "isss",
        $pasien_id,
        $keluhan,
        $diagnosa,
        $tanggal
    );

    $stmt->execute();

    header("Location: rekam_medis.php");
    exit;
}

/* DATA PASIEN */

$pasien = mysqli_query($conn,"
SELECT
    pasien.id,
    users.nama
FROM pasien
JOIN users
ON pasien.user_id = users.id
");

/* DATA REKAM MEDIS */

$data = mysqli_query($conn,"
SELECT
    rm.*,
    users.nama

FROM rekam_medis rm

JOIN pasien
ON rm.pasien_id = pasien.id

JOIN users
ON pasien.user_id = users.id

ORDER BY rm.id DESC
");

?>

<!DOCTYPE html>
<html>

<head>

<meta charset="UTF-8">

<title>Rekam Medis</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<link rel="stylesheet" href="../assets/css/style.css">

</head>

<body>

<nav class="navbar navbar-dark">

<div class="container">

<span class="navbar-brand">
🏥 MediSecure
</span>

<a href="dashboard.php" class="btn btn-light">
Kembali
</a>

</div>

</nav>

<div class="container mt-4">

<h2 class="dashboard-title">
Rekam Medis Pasien
</h2>

<div class="card p-4 mb-4">

<h4>Tambah Rekam Medis</h4>

<form method="POST">

<div class="mb-3">

<label>Pasien</label>

<select
name="pasien_id"
class="form-control"
required>

<option value="">
Pilih Pasien
</option>

<?php while($p = mysqli_fetch_assoc($pasien)){ ?>

<option value="<?= $p['id'] ?>">
<?= htmlspecialchars($p['nama']) ?>
</option>

<?php } ?>

</select>

</div>

<div class="mb-3">

<label>Keluhan</label>

<textarea
name="keluhan"
class="form-control"
required></textarea>

</div>

<div class="mb-3">

<label>Diagnosa</label>

<textarea
name="diagnosa"
class="form-control"
required></textarea>

</div>

<button
type="submit"
name="simpan"
class="btn btn-success">

Simpan

</button>

</form>

</div>

<div class="card p-4">

<h4>Data Rekam Medis</h4>

<table class="table table-bordered table-hover">

<thead>

<tr>

<th>No</th>
<th>Pasien</th>
<th>Keluhan</th>
<th>Diagnosa</th>
<th>Tanggal</th>

</tr>

</thead>

<tbody>

<?php
$no=1;

while($row=mysqli_fetch_assoc($data)){
?>

<tr>

<td><?= $no++ ?></td>

<td><?= htmlspecialchars($row['nama']) ?></td>

<td><?= htmlspecialchars($row['keluhan']) ?></td>

<td><?= htmlspecialchars($row['diagnosa']) ?></td>

<td><?= $row['tanggal_pemeriksaan'] ?></td>

</tr>

<?php } ?>

</tbody>

</table>

</div>

</div>

</body>
</html>