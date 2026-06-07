<?php

include "../config/koneksi.php";

$message = "";

if(isset($_POST['register'])){

    $nama = htmlspecialchars($_POST['nama']);
    $email = htmlspecialchars($_POST['email']);

    $password = password_hash(
        $_POST['password'],
        PASSWORD_DEFAULT
    );

    $stmt = $conn->prepare(
        "INSERT INTO users
        (nama,email,password,role)
        VALUES (?,?,?,'pasien')"
    );

    $stmt->bind_param(
        "sss",
        $nama,
        $email,
        $password
    );

    if($stmt->execute()){
        $message = "Registrasi berhasil";
    }else{
        $message = "Registrasi gagal";
    }

}
?>

<!DOCTYPE html>
<html>
<head>

<title>Register</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body>

<div class="container mt-5">

<h2>Register Pasien</h2>

<?= $message ?>

<form method="POST">

<div class="mb-3">
<label>Nama</label>
<input
type="text"
name="nama"
class="form-control"
required>
</div>

<div class="mb-3">
<label>Email</label>
<input
type="email"
name="email"
class="form-control"
required>
</div>

<div class="mb-3">
<label>Password</label>
<input
type="password"
name="password"
class="form-control"
required>
</div>

<button
name="register"
class="btn btn-success">

Register

</button>

</form>

</div>

</body>
</html>