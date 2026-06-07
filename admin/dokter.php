include "../config/koneksi.php";

if(isset($_POST['simpan'])){

$nama=$_POST['nama'];
$email=$_POST['email'];
$spesialis=$_POST['spesialis'];

$password=password_hash(
"doctor123",
PASSWORD_DEFAULT
);

mysqli_query(
$conn,
"INSERT INTO users
(nama,email,password,role)

VALUES

('$nama',
'$email',
'$password',
'dokter')"
);

$user_id=mysqli_insert_id($conn);

mysqli_query(
$conn,
"INSERT INTO dokter
(user_id,spesialis)

VALUES

('$user_id',
'$spesialis')"
);
}
<form method="POST">

<input
type="text"
name="nama"
placeholder="Nama Dokter"
class="form-control mb-2">

<input
type="email"
name="email"
placeholder="Email"
class="form-control mb-2">

<input
type="text"
name="spesialis"
placeholder="Spesialis"
class="form-control mb-2">

<button
name="simpan"
class="btn btn-primary">

Tambah

</button>

</form>

$query=mysqli_query(
$conn,
"SELECT
users.nama,
users.email,
dokter.spesialis

FROM dokter

JOIN users
ON dokter.user_id=users.id"
);

<table class="table table-bordered">

<tr>

<th>Nama</th>
<th>Email</th>
<th>Spesialis</th>

</tr>

<?php while($d=mysqli_fetch_assoc($query)){ ?>

<tr>

<td><?= htmlspecialchars($d['nama']) ?></td>

<td><?= htmlspecialchars($d['email']) ?></td>

<td><?= htmlspecialchars($d['spesialis']) ?></td>

</tr>

<?php } ?>

</table>