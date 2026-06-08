<?php
/** @var mysqli $conn */

include "../middleware/auth.php";

if($_SESSION['role'] != 'pasien'){
    die("Akses ditolak");
}

?>

<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Dashboard Pasien</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="../assets/css/style.css">

</head>

<body>

<nav class="navbar navbar-expand-lg navbar-dark">

    <div class="container">

        <a class="navbar-brand" href="#">
            🏥 MediSecure
        </a>

        <div>

            <span class="text-white me-3">
                <?= htmlspecialchars($_SESSION['nama']) ?>
            </span>

            <a
                href="../auth/logout.php"
                class="btn btn-danger">

                Logout

            </a>

        </div>

    </div>

</nav>

<div class="container dashboard-container">

    <h1 class="dashboard-title">
        Dashboard Pasien
    </h1>

    <p class="welcome-text">
        Selamat datang di sistem rekam medis MediSecure
    </p>

    <div class="row">

        <div class="col-md-6 mb-4">

            <div class="menu-card">

                <div class="menu-icon">
                    📋
                </div>

                <h4 class="menu-title">
                    Rekam Medis
                </h4>

                <p>
                    Lihat seluruh riwayat pemeriksaan kesehatan Anda.
                </p>

                <a
                    href="rekam_medis.php"
                    class="btn btn-primary btn-menu">

                    Lihat Rekam Medis

                </a>

            </div>

        </div>

        <div class="col-md-6 mb-4">

            <div class="menu-card">

                <div class="menu-icon">
                    🧪
                </div>

                <h4 class="menu-title">
                    Upload Hasil Lab
                </h4>

                <p>
                    Upload hasil pemeriksaan laboratorium dengan aman.
                </p>

                <a
                    href="upload.php"
                    class="btn btn-success btn-menu">

                    Upload File

                </a>

            </div>

        </div>

    </div>

</div>

</body>
</html>