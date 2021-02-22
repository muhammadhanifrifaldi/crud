<?php 
$hanif = mysqli_connect("localhost", "root", "", "pertemuan9");
$result = mysqli_query($hanif, "SELECT * FROM mahasiswa");
//while($mhs = mysqli_fetch_assoc($result)){
//var_dump($mhs["nama"]);
//}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Halaman Admin</title>
</head>
<body>
    <h1>Daftar Mahasiswa</h1>

    <table border="1" cellpadding="10" cellspacing="0">

        <tr>
            <th>No.</th>
            <th>Aksi</th>
            <th>Gambar</th>
            <th>NRP</th>
            <th>Nama</th>
            <th>Email</th>
            <th>Jurusan</th>
        </tr>
<?php $i = 1; ?>
<?php while ($row = mysqli_fetch_assoc ($result)): ?>
        <tr>
            <td><?= $i; ?></td>
            <td>
                <a href="">Create</a>
                <a href="">Update</a>
                <a href="">Delete</a>
            </td>
            <td>
                <img src="img/<?= $row["gambar"]; ?>" width="100" alt="">
            </td>
            <td><?= $row["nrp"]; ?></td>
            <td><?= $row["nama"]; ?></td>
            <td><?= $row["email"]; ?></td>
            <td><?= $row["jurusan"]; ?></td>
        </tr>
<?php $i++; ?>
<?php endwhile; ?>
    </table>
</body>
</html>