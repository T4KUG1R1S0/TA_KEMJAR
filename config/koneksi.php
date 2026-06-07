<?php

$conn = mysqli_connect(
    "localhost",
    "root",
    "",
    "medisecure"
);

if (!$conn) {
    die("Koneksi database gagal");
}