<?php
session_start();
if ( !isset($_SESSION["login"])) {
    header("Location: login.php");
    exit;
}
require "functions.php";
$id = $_GET["id"];
$mhs = query("SELECT * FROM mahasiswa WHERE id = $id")[0];

if (isset($_POST["submit"])) {

if (ubah ($_POST) > 0 ) {
    echo " 
    <script>
        alert('data berhasil diubah!');
        document.location.href = 'index.php';    
    </script>
    ";
} else {
    echo "
    <script>
        alert('data gagal diubah!');
        document.location.href = 'index.php';    
    </script>
    ";
}
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Updatte Data Mahasiswa</title>
</head>
<body>
    <h1>Update Data Mahasiswa</h1>

    <form action="" method="post">
        <input type="hidden" name="id" value="<?= $mhs["id"];?>">
    <ul>
        <li>
            <label for="nrp">NRP : </label>
            <input type="text" name="nrp" required value = "<?= $mhs["nrp"] ?>">
        </li>
        <li>
            <label for="nrp">Nama : </label>
            <input type="text" name="nama" required value = "<?= $mhs["nama"] ?>">
        </li>
        <li>
            <label for="nrp">Email : </label>
            <input type="text" name="email" value = "<?= $mhs["email"] ?>">
        </li>
        <li>
            <label for="nrp">Jurusan : </label>
            <input type="text" name="jurusan" value = "<?= $mhs["jurusan"] ?>">
        </li>
        <li>
            <label for="nrp">Gambar : </label>
            <input type="text" name="gambar" value = "<?= $mhs["gambar"] ?>">
        </li>
        <li>
        <button type="submit" name="submit">Update Data !</button>
        </li>
    </ul>

    </form>
</body>
</html>