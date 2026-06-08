<?php
/** @var mysqli $conn */


session_start();
if(empty($_SESSION['csrf_token'])){
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}
include "../config/koneksi.php";

$error = "";

if(isset($_POST['login'])){

if(
    !isset($_POST['csrf_token']) ||
    $_POST['csrf_token'] !== $_SESSION['csrf_token']
){
    die("CSRF Detected");
}

    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    $stmt = $conn->prepare(
        "SELECT * FROM users WHERE email=?"
    );

    $stmt->bind_param(
        "s",
        $email
    );

    $stmt->execute();

    $result = $stmt->get_result();

    if($result->num_rows > 0){

        $user = $result->fetch_assoc();

        // LOGIN SEMENTARA PLAINTEXT
        if(
            password_verify(
                $password,
                $user['password']
            )
        ){

            session_regenerate_id(true);

            $_SESSION['id'] = $user['id'];
            $_SESSION['nama'] = $user['nama'];
            $_SESSION['role'] = $user['role'];

            if($user['role'] == 'admin'){

                header(
                    "Location: ../admin/dashboard.php"
                );
                exit;

            }elseif($user['role'] == 'dokter'){

                header(
                    "Location: ../dokter/dashboard.php"
                );
                exit;

            }else{

                header(
                    "Location: ../pasien/dashboard.php"
                );
                exit;
            }
        }
    }

    $error = "
    <div class='alert alert-danger'>
        Email atau Password salah
    </div>";
}
?>

<!DOCTYPE html>
<html lang="id">

<head>

<meta charset="UTF-8">

<meta name="viewport"
content="width=device-width, initial-scale=1.0">

<title>Login MediSecure</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
rel="stylesheet">

<link rel="stylesheet"
href="../assets/css/style.css">

</head>

<body>

<div class="login-container">

<div class="login-card">

<h2 class="login-title">
🏥 MediSecure Login
</h2>

<?= $error ?>

<form method="POST">

<input
    type="hidden"
    name="csrf_token"
    value="<?= $_SESSION['csrf_token'] ?>"
>

<div class="mb-3">

<input
type="email"
name="email"
class="form-control"
placeholder="Masukkan Email"
required>

</div>

<div class="mb-3">

<input
type="password"
name="password"
class="form-control"
placeholder="Masukkan Password"
required>

</div>

<button
type="submit"
name="login"
class="btn btn-primary w-100">

Login

</button>

</form>

<div class="text-center mt-3">

Belum punya akun?

<a href="register.php">
Daftar
</a>

</div>

</div>

</div>

</body>
</html>