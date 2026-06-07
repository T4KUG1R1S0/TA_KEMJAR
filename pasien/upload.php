<?php

include "../middleware/auth.php";

if(isset($_POST['upload'])){

    $nama = $_FILES['file']['name'];
    $tmp = $_FILES['file']['tmp_name'];

    move_uploaded_file(
        $tmp,
        "../uploads/".$nama
    );

    echo "Upload berhasil";
}
?>

<form method="POST" enctype="multipart/form-data">

<input type="file" name="file">

<button name="upload">
Upload
</button>

</form>