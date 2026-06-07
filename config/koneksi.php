<?php

$host = "localhost";
$user = "root";
$pass = "";
$db   = "medisecure";

$conn = mysqli_connect(
    $host,
    $user,
    $pass,
    $db
);

if(!$conn){
    die("Koneksi gagal");
}