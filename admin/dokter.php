<?php

/** @var mysqli $conn */

include "../middleware/auth.php";
include "../config/koneksi.php";

if ($_SESSION['role'] != 'admin') {
    die("Akses Ditolak");
}

/*
|--------------------------------------------------------------------------
| HAPUS DOKTER
|--------------------------------------------------------------------------
*/

if (isset($_GET['hapus'])) {

    $id = (int)$_GET['hapus'];

    $cek = mysqli_query(
        $conn,
        "SELECT user_id FROM dokter WHERE id='$id'"
    );

    $data = mysqli_fetch_assoc($cek);

    if ($data) {

        mysqli_query(
            $conn,
            "DELETE FROM users WHERE id='{$data['user_id']}'"
        );
    }

    header("Location: dokter.php");
    exit;
}

/*
|--------------------------------------------------------------------------
| TAMBAH DOKTER
|--------------------------------------------------------------------------
*/

if (isset($_POST['simpan'])) {

    $nama = trim($_POST['nama']);
    $email = trim($_POST['email']);
    $spesialis = trim($_POST['spesialis']);

    $password = password_hash(
        "doctor123",
        PASSWORD_DEFAULT
    );

    $stmt = $conn->prepare(
        "INSERT INTO users
        (nama,email,password,role)
        VALUES (?,?,?,'dokter')"
    );

    $stmt->bind_param(
        "sss",
        $nama,
        $email,
        $password
    );

    if ($stmt->execute()) {

        $user_id = mysqli_insert_id($conn);

        $stmt2 = $conn->prepare(
            "INSERT INTO dokter
            (user_id,spesialis)
            VALUES (?,?)"
        );

        $stmt2->bind_param(
            "is",
            $user_id,
            $spesialis
        );

        $stmt2->execute();
    }

    header("Location: dokter.php");
    exit;
}

/*
|--------------------------------------------------------------------------
| TAMPIL DATA DOKTER
|--------------------------------------------------------------------------
*/

$query = mysqli_query(
    $conn,
    "SELECT
        dokter.id,
        users.nama,
        users.email,
        dokter.spesialis

    FROM dokter

    JOIN users
    ON dokter.user_id = users.id

    ORDER BY dokter.id DESC"
);

?>

<!DOCTYPE html>
<html>

<head>

    <title>Kelola Dokter</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body>

<div class="container mt-4">

    <h2>Kelola Dokter</h2>

    <a href="dashboard.php" class="btn btn-secondary mb-3">
        Kembali
    </a>

    <div class="card p-3 mb-4">

        <h4>Tambah Dokter</h4>

        <form method="POST">

            <div class="mb-2">
                <input
                    type="text"
                    name="nama"
                    class="form-control"
                    placeholder="Nama Dokter"
                    required>
            </div>

            <div class="mb-2">
                <input
                    type="email"
                    name="email"
                    class="form-control"
                    placeholder="Email"
                    required>
            </div>

            <div class="mb-2">
                <input
                    type="text"
                    name="spesialis"
                    class="form-control"
                    placeholder="Spesialis"
                    required>
            </div>

            <button
                type="submit"
                name="simpan"
                class="btn btn-primary">

                Simpan

            </button>

        </form>

    </div>

    <table class="table table-bordered table-striped">

        <thead>

        <tr>
            <th>No</th>
            <th>Nama</th>
            <th>Email</th>
            <th>Spesialis</th>
            <th>Aksi</th>
        </tr>

        </thead>

        <tbody>

        <?php $no = 1; ?>

        <?php while ($row = mysqli_fetch_assoc($query)) : ?>

            <tr>

                <td><?= $no++ ?></td>

                <td><?= htmlspecialchars($row['nama']) ?></td>

                <td><?= htmlspecialchars($row['email']) ?></td>

                <td><?= htmlspecialchars($row['spesialis']) ?></td>

                <td>

                    <a
                        href="?hapus=<?= $row['id'] ?>"
                        class="btn btn-danger btn-sm"
                        onclick="return confirm('Hapus dokter ini?')">

                        Hapus

                    </a>

                </td>

            </tr>

        <?php endwhile; ?>

        </tbody>

    </table>

</div>

</body>
</html>