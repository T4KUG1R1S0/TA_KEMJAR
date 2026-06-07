<?php
/** @var mysqli $conn */
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();

include "../config/koneksi.php";

$message = "";

if(isset($_POST['register'])){

    $nama = trim($_POST['nama']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    $cek = $conn->prepare(
        "SELECT id FROM users WHERE email=?"
    );

    $cek->bind_param("s",$email);
    $cek->execute();

    if($cek->get_result()->num_rows > 0){

        $message = "
        <div class='alert alert-danger'>
            Email sudah digunakan
        </div>";

    }else{

        $hash = password_hash(
            $password,
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
            $hash
        );

        if($stmt->execute()){

            $message = "
            <div class='alert alert-success'>
                Registrasi berhasil
            </div>";

        }else{

            $message = "
            <div class='alert alert-danger'>
                Registrasi gagal
            </div>";

        }
    }
}

?>

<!DOCTYPE html>
<html lang="id">

<head>

<meta charset="UTF-8">

<title>Register MediSecure</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<link rel="stylesheet" href="../assets/css/style.css">

</head>

<body>

<div class="login-container">

<div class="login-card">

<h2 class="login-title">
🏥 Register MediSecure
</h2>

<?= $message ?>

<form method="POST">

<div class="mb-3">

<input
type="text"
name="nama"
class="form-control"
placeholder="Nama Lengkap"
required>

</div>

<div class="mb-3">

<input
type="email"
name="email"
class="form-control"
placeholder="Email"
required>

</div>

<div class="mb-3">

<input
type="password"
name="password"
class="form-control"
placeholder="Password"
required>

</div>

<button
type="submit"
name="register"
class="btn btn-primary w-100">

Daftar

</button>

</form>

<div class="text-center mt-3">

Sudah punya akun?

<a href="login.php">
Login
</a>

</div>

</div>

</div>

</body>
</html>