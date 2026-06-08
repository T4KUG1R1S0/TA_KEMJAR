<?php
/** @var mysqli $conn */
include "../middleware/auth.php";
include "../config/koneksi.php";

if($_SESSION['role'] != 'admin'){
    die("Akses ditolak");
}

/*
TAMBAH DOKTER
*/
if(isset($_POST['tambah'])){

    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $spesialis = $_POST['spesialis'];

    $password = password_hash(
        "dokter123",
        PASSWORD_DEFAULT
    );

    $stmt = $conn->prepare(
        "INSERT INTO users
        (nama,email,password,role)
        VALUES
        (?,?,?,'dokter')"
    );

    $stmt->bind_param(
        "sss",
        $nama,
        $email,
        $password
    );

    $stmt->execute();

    $user_id = $conn->insert_id;

    $stmt2 = $conn->prepare(
        "INSERT INTO dokter
        (user_id,spesialis)
        VALUES
        (?,?)"
    );

    $stmt2->bind_param(
        "is",
        $user_id,
        $spesialis
    );

    $stmt2->execute();

    header("Location:dokter.php");
    exit;
}

/*
HAPUS
*/

if(isset($_GET['hapus'])){

    $id = (int)$_GET['hapus'];

    mysqli_query(
        $conn,
        "DELETE FROM users WHERE id=$id"
    );

    header("Location:dokter.php");
    exit;
}

$data = mysqli_query($conn,"
SELECT
u.id,
u.nama,
u.email,
d.spesialis
FROM users u
LEFT JOIN dokter d
ON u.id=d.user_id
WHERE role='dokter'
");

?>

<!DOCTYPE html>
<html>
<head>

<title>Kelola Dokter</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<link rel="stylesheet" href="../assets/css/style.css">

</head>
<body>

<nav class="navbar navbar-dark">

<div class="container">

<span class="navbar-brand">
👨‍⚕️ Kelola Dokter
</span>

<a href="dashboard.php" class="btn btn-light">
Dashboard
</a>

</div>

</nav>

<div class="container page-container">

<div class="medical-card mb-4">

<h3>Tambah Dokter</h3>

<form method="POST">

<div class="row">

<div class="col-md-4">

<input
type="text"
name="nama"
class="form-control"
placeholder="Nama Dokter"
required>

</div>

<div class="col-md-4">

<input
type="email"
name="email"
class="form-control"
placeholder="Email"
required>

</div>

<div class="col-md-4">

<input
type="text"
name="spesialis"
class="form-control"
placeholder="Spesialis"
required>

</div>

</div>

<button
name="tambah"
class="btn btn-success mt-3">

Tambah Dokter

</button>

</form>

</div>

<div class="medical-card">

<h3>Data Dokter</h3>

<table class="table">

<thead>

<tr>

<th>Nama</th>
<th>Email</th>
<th>Spesialis</th>
<th>Aksi</th>

</tr>

</thead>

<tbody>

<?php while($row=mysqli_fetch_assoc($data)){ ?>

<tr>

<td><?= $row['nama'] ?></td>
<td><?= $row['email'] ?></td>
<td><?= $row['spesialis'] ?></td>

<td>

<a
href="?hapus=<?= $row['id'] ?>"
class="btn btn-danger btn-sm"
onclick="return confirm('Hapus dokter?')">

Hapus

</a>

</td>

</tr>

<?php } ?>

</tbody>

</table>

</div>

</div>

</body>
</html>