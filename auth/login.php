<?php

session_start();

include "../config/koneksi.php";

$error = "";

if(isset($_POST['login'])){

    $email = $_POST['email'];

    $stmt = $conn->prepare(
        "SELECT * FROM users
        WHERE email=?"
    );

    $stmt->bind_param(
        "s",
        $email
    );

    $stmt->execute();

    $result = $stmt->get_result();

    $user = $result->fetch_assoc();

    if(
        $user &&
        password_verify(
            $_POST['password'],
            $user['password']
        )
    ){

        session_regenerate_id(true);

        $_SESSION['id'] = $user['id'];
        $_SESSION['nama'] = $user['nama'];
        $_SESSION['role'] = $user['role'];

        if($user['role']=="admin"){
            header("Location: ../admin/dashboard.php");
        }

        elseif($user['role']=="dokter"){
            header("Location: ../dokter/dashboard.php");
        }

        else{
            header("Location: ../pasien/dashboard.php");
        }

        exit();

    }

    $error = "Email atau Password salah";
}
?>