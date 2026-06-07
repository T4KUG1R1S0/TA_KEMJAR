<?php

/** @var mysqli $conn */

include "../middleware/auth.php";
include "../config/koneksi.php";

$query = mysqli_query($conn,"
SELECT
users.nama,
users.email,
pasien.no_telp,
pasien.alamat

FROM pasien

JOIN users
ON pasien.user_id = users.id
");

?>

<h2>Data Pasien</h2>

<table border="1" cellpadding="10">

<tr>
<th>Nama</th>
<th>Email</th>
<th>No Telp</th>
<th>Alamat</th>
</tr>

<?php while($row=mysqli_fetch_assoc($query)){ ?>

<tr>
<td><?= htmlspecialchars($row['nama']) ?></td>
<td><?= htmlspecialchars($row['email']) ?></td>
<td><?= htmlspecialchars($row['no_telp']) ?></td>
<td><?= htmlspecialchars($row['alamat']) ?></td>
</tr>

<?php } ?>

</table>