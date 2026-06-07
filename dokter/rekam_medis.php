<form method="POST">

<select
name="pasien_id"
class="form-control">

<?php

$pasien=mysqli_query(
$conn,
"SELECT * FROM pasien"
);

while($p=mysqli_fetch_assoc($pasien)){

echo "
<option value='$p[id]'>
Pasien $p[id]
</option>
";

}

?>

</select>

<textarea
name="keluhan"
class="form-control mt-2">
</textarea>

<textarea
name="diagnosa"
class="form-control mt-2">
</textarea>

<button
name="simpan"
class="btn btn-success mt-2">

Simpan

</button>

</form>