<?php
/** @var mysqli $conn */

include "../middleware/auth.php";
include "../config/koneksi.php";

if($_SESSION['role'] != 'dokter'){
    die("Akses ditolak");
}

$query = mysqli_query($conn,"
    SELECT *
    FROM users
    WHERE role='pasien'
");

?>

<!DOCTYPE html>
<html>
<head>
<title>Data Pasien</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="../assets/css/style.css">

</head>
<body>

<div class="container mt-4">

    <h2>Data Pasien</h2>

    <table class="table table-bordered">

        <tr>
            <th>ID</th>
            <th>Nama</th>
            <th>Email</th>
        </tr>

        <?php while($row = mysqli_fetch_assoc($query)){ ?>

        <tr>
            <td><?= $row['id'] ?></td>
            <td><?= $row['nama'] ?></td>
            <td><?= $row['email'] ?></td>
        </tr>

        <?php } ?>

    </table>

</div>

</body>
</html>