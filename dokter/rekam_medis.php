<h3>Daftar Rekam Medis</h3>

<?php
/** @var mysqli $conn */
$data = mysqli_query($conn,"
SELECT
rm.*,
u.nama

FROM rekam_medis rm

JOIN pasien p
ON rm.pasien_id=p.id

JOIN users u
ON p.user_id=u.id

ORDER BY rm.id DESC
");

?>

<table border="1" cellpadding="10">

<tr>
<th>Pasien</th>
<th>Keluhan</th>
<th>Diagnosa</th>
<th>Tanggal</th>
</tr>

<?php while($d=mysqli_fetch_assoc($data)){ ?>

<tr>

<td><?= htmlspecialchars($d['nama']) ?></td>

<td><?= htmlspecialchars($d['keluhan']) ?></td>

<td><?= htmlspecialchars($d['diagnosa']) ?></td>

<td><?= $d['tanggal_pemeriksaan'] ?></td>

</tr>

<?php } ?>

</table>