<?php
/** @var mysqli $conn */

include "../middleware/auth.php";
include "../config/koneksi.php";

if($_SESSION['role'] != 'dokter'){
    die("Akses ditolak");
}

if(isset($_POST['simpan'])){

    $pasien_id = $_POST['pasien_id'];
    $keluhan = $_POST['keluhan'];
    $diagnosa = $_POST['diagnosa'];
    $tindakan = $_POST['tindakan'];

    $dokter = mysqli_query(
        $conn,
        "SELECT id FROM dokter
        WHERE user_id='".$_SESSION['id']."'"
    );

    $dokterData = mysqli_fetch_assoc($dokter);

    $dokter_id = $dokterData['id'];

    mysqli_query(
        $conn,
        "INSERT INTO rekam_medis
        (
            pasien_id,
            dokter_id,
            keluhan,
            diagnosa,
            tindakan
        )
        VALUES
        (
            '$pasien_id',
            '$dokter_id',
            '$keluhan',
            '$diagnosa',
            '$tindakan'
        )"
    );

    header("Location: rekam_medis.php");
    exit;
}

$pasien = mysqli_query(
    $conn,
    "SELECT p.id,u.nama
    FROM pasien p
    JOIN users u ON p.user_id=u.id"
);

$data = mysqli_query(
    $conn,
    "SELECT
    rm.*,
    u.nama as pasien
    FROM rekam_medis rm
    JOIN pasien p ON rm.pasien_id=p.id
    JOIN users u ON p.user_id=u.id
    ORDER BY rm.id DESC"
);

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
📋 Rekam Medis
</span>

<a href="dashboard.php" class="btn btn-light">
Dashboard
</a>

</div>

</nav>

<div class="container page-container">

<div class="medical-card mb-4">

<h3>Tambah Rekam Medis</h3>

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

<?php while($p=mysqli_fetch_assoc($pasien)){ ?>

<option value="<?= $p['id'] ?>">
<?= $p['nama'] ?>
</option>

<?php } ?>

</select>

</div>

<div class="mb-3">

<textarea
name="keluhan"
class="form-control"
placeholder="Keluhan"
required></textarea>

</div>

<div class="mb-3">

<textarea
name="diagnosa"
class="form-control"
placeholder="Diagnosa"
required></textarea>

</div>

<div class="mb-3">

<textarea
name="tindakan"
class="form-control"
placeholder="Tindakan"></textarea>

</div>

<button
name="simpan"
class="btn btn-success">

Simpan

</button>

</form>

</div>

<div class="medical-card">

<h3>Data Rekam Medis</h3>

<table class="table">

<thead>

<tr>

<th>Pasien</th>
<th>Keluhan</th>
<th>Diagnosa</th>
<th>Tindakan</th>

</tr>

</thead>

<tbody>

<?php while($row=mysqli_fetch_assoc($data)){ ?>

<tr>

<td><?= $row['pasien'] ?></td>
<td><?= $row['keluhan'] ?></td>
<td><?= $row['diagnosa'] ?></td>
<td><?= $row['tindakan'] ?></td>

</tr>

<?php } ?>

</tbody>

</table>

</div>

</div>

</body>
</html>