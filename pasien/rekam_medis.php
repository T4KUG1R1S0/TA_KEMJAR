<?php
/** @var mysqli $conn */
include "../middleware/auth.php";
include "../config/koneksi.php";

$user_id = $_SESSION['id'];

$query = mysqli_query($conn,"
SELECT
rm.*

FROM rekam_medis rm

JOIN pasien p
ON rm.pasien_id=p.id

WHERE p.user_id='$user_id'
");

?>

<table border="1" cellpadding="10">

<tr>
<th>Keluhan</th>
<th>Diagnosa</th>
<th>Tanggal</th>
</tr>

<?php while($r=mysqli_fetch_assoc($query)){ ?>

<tr>

<td><?= htmlspecialchars($r['keluhan']) ?></td>

<td><?= htmlspecialchars($r['diagnosa']) ?></td>

<td><?= $r['tanggal_pemeriksaan'] ?></td>

</tr>

<?php } ?>

</table>