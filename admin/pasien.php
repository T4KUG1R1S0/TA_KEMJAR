<?php
/** @var mysqli $conn */
include "../middleware/auth.php";
include "../config/koneksi.php";

if($_SESSION['role'] != 'admin'){
    die("Akses ditolak");
}

if(isset($_GET['hapus'])){

    $id = (int)$_GET['hapus'];

    $stmt = $conn->prepare(
        "DELETE FROM users
        WHERE id=? AND role='pasien'"
    );

    $stmt->bind_param("i", $id);
    $stmt->execute();

    header("Location: pasien.php");
    exit;
}

$data = mysqli_query(
    $conn,
    "SELECT *
    FROM users
    WHERE role='pasien'
    ORDER BY id DESC"
);

?>

<!DOCTYPE html>
<html lang="id">

<head>

<meta charset="UTF-8">

<title>Kelola Pasien</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<link rel="stylesheet" href="../assets/css/style.css">

</head>

<body>

<nav class="navbar navbar-dark">

<div class="container">

<span class="navbar-brand">
🧑‍🤝‍🧑 Kelola Pasien
</span>

<a href="dashboard.php" class="btn btn-light">
Dashboard
</a>

</div>

</nav>

<div class="container page-container">

<div class="medical-card">

<h2 class="page-title">
Data Pasien
</h2>

<table class="table">

<thead>

<tr>

<th>ID</th>
<th>Nama</th>
<th>Email</th>
<th>Aksi</th>

</tr>

</thead>

<tbody>

<?php while($row = mysqli_fetch_assoc($data)){ ?>

<tr>

<td><?= htmlspecialchars($row['id']) ?></td>
<td><?= htmlspecialchars($row['nama']) ?></td>
<td><?= htmlspecialchars($row['email']) ?></td>

<td>

<a
href="?hapus=<?= $row['id'] ?>"
class="btn btn-danger btn-sm"
onclick="return confirm('Hapus pasien?')">

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