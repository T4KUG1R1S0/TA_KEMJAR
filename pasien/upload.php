<?php
/** @var mysqli $conn */
include "../middleware/auth.php";
include "../config/koneksi.php";

if ($_SESSION['role'] != 'pasien') {
    die("Akses ditolak");
}

$message = "";

if (isset($_POST['upload'])) {

    if (isset($_FILES['file']) && $_FILES['file']['error'] == 0) {

        $namaFile = $_FILES['file']['name'];
        $tmpFile  = $_FILES['file']['tmp_name'];
        $ukuran   = $_FILES['file']['size'];

        $ext = strtolower(pathinfo($namaFile, PATHINFO_EXTENSION));

        $allowed = ['pdf', 'jpg', 'jpeg', 'png'];

        if (!in_array($ext, $allowed)) {

            $message = "
            <div class='alert alert-danger'>
                Format file tidak diizinkan!
            </div>";

        } elseif ($ukuran > 5000000) {

            $message = "
            <div class='alert alert-danger'>
                Ukuran file maksimal 5MB!
            </div>";

        } else {

            $namaBaru = time() . "_" . rand(1000,9999) . "." . $ext;

            $folder = dirname(__DIR__) . "/uploads/lab/";

            if (!file_exists($folder)) {
                mkdir($folder, 0777, true);
            }

            $tujuan = $folder . $namaBaru;

            if (move_uploaded_file($tmpFile, $tujuan)) {

                $user_id = $_SESSION['id'];

                $q = mysqli_query(
                    $conn,
                    "SELECT id FROM pasien WHERE user_id='$user_id'"
                );

                $pasien = mysqli_fetch_assoc($q);

                if ($pasien) {

                    $pasien_id = $pasien['id'];

                    mysqli_query(
                        $conn,
                        "INSERT INTO hasil_lab
                        (
                            pasien_id,
                            nama_file,
                            file_path,
                            file_type
                        )
                        VALUES
                        (
                            '$pasien_id',
                            '$namaBaru',
                            '$tujuan',
                            '$ext'
                        )"
                    );

                    $message = "
                    <div class='alert alert-success'>
                        File berhasil diupload dan disimpan ke database!
                    </div>";

                } else {

                    $message = "
                    <div class='alert alert-danger'>
                        Data pasien tidak ditemukan!
                    </div>";
                }

            } else {

                $message = "
                <div class='alert alert-danger'>
                    Upload gagal!
                </div>";
            }
        }

    } else {

        $message = "
        <div class='alert alert-danger'>
            Pilih file terlebih dahulu!
        </div>";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Hasil Lab</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/style.css">
</head>

<body>

<nav class="navbar navbar-expand-lg navbar-dark">
    <div class="container">

        <a class="navbar-brand">
            🏥 MediSecure
        </a>

        <div>
            <a href="dashboard.php" class="btn btn-light me-2">
                Dashboard
            </a>

            <a href="../auth/logout.php" class="btn btn-danger">
                Logout
            </a>
        </div>

    </div>
</nav>

<div class="container page-container">

    <div class="row justify-content-center">

        <div class="col-md-8">

            <div class="medical-card">

                <h2 class="page-title">
                    🧪 Upload Hasil Laboratorium
                </h2>

                <p class="text-muted">
                    Upload PDF, JPG, JPEG, PNG maksimal 5MB
                </p>

                <?= $message ?>

                <form method="POST" enctype="multipart/form-data">

                    <div class="mb-3">
                        <label class="form-label">
                            Pilih File
                        </label>

                        <input
                            type="file"
                            name="file"
                            class="form-control"
                            required>
                    </div>

                    <button
                        type="submit"
                        name="upload"
                        class="btn btn-success">

                        Upload Sekarang

                    </button>

                </form>

            </div>

        </div>

    </div>

</div>

</body>
</html>