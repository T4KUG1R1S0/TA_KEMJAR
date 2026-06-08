<?php
/** @var mysqli $conn */

include "../config/koneksi.php";

$message = "";

if(isset($_POST['register'])){

    $nama = trim($_POST['nama']);
    $email = trim($_POST['email']);
    $password = password_hash(
        trim($_POST['password']),
        PASSWORD_DEFAULT
    );
    
    $cek = mysqli_query(
        $conn,
        "SELECT id FROM users WHERE email='$email'"
    );

    if(mysqli_num_rows($cek) > 0){

        $message = "
        <div class='alert alert-danger'>
            Email sudah digunakan
        </div>";

    }else{

        mysqli_query(
            $conn,
            "INSERT INTO users
            (
                nama,
                email,
                password,
                role
            )
            VALUES
            (
                '$nama',
                '$email',
                '$password',
                'pasien'
            )"
        );

        $user_id = mysqli_insert_id($conn);

        mysqli_query(
            $conn,
            "INSERT INTO pasien
            (
                user_id
            )
            VALUES
            (
                '$user_id'
            )"
        );

        $message = "
        <div class='alert alert-success'>
            Registrasi berhasil
        </div>";
    }
}

?>

<!DOCTYPE html>
<html lang="id">
<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

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

            <input
            type="text"
            name="nama"
            class="form-control mb-3"
            placeholder="Nama Lengkap"
            required>

            <input
            type="email"
            name="email"
            class="form-control mb-3"
            placeholder="Email"
            required>

            <input
            type="password"
            name="password"
            class="form-control mb-3"
            placeholder="Password"
            required>

            <button
            type="submit"
            name="register"
            class="btn btn-primary w-100">

                Daftar

            </button>

        </form>

        <div class="text-center mt-3">
            Sudah punya akun?
            <a href="login.php">Login</a>
        </div>

    </div>

</div>

</body>
</html>