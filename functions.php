<?php 
$hanif = mysqli_connect("localhost", "root", "", "pertemuan9");

function query ($query) {
    global $hanif;
    $result = mysqli_query($hanif, $query);
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)){
        $rows[] = $row;
    }
    return $rows;
}


function  tambah ($data) {
    global $hanif;
$nrp =htmlspecialchars($data["nrp"]);
$nama =htmlspecialchars($data["nama"]);
$email =htmlspecialchars($data["email"]);
$jurusan = $data["jurusan"];
$gambar = $data["gambar"];

$gambar = upload();
if(!$gambar) {
    return false;
}

$query = "INSERT INTO mahasiswa
            VALUES
            ('', '$nrp', '$nama', '$email', '$jurusan', '$gambar')
            ";
        mysqli_query($hanif, $query);

        return mysqli_affected_rows($hanif);
}

function upload () {
    $namafile = $_FILES['gambar']['name'];
    $ukuranfile = $_FILES['gambar']['size'];
    $error = $_FILES['gambar']['error'];
    $tmpName = $_FILES['gambar']['tmp_name'];

    if($error === 4) {
        echo "<script>
                alert('Pilih Gambar Terlebih Dahulu !');
             </script>";
        return false;
    }

    $ekstensiGambarValid = ['jpg', 'jpeg', 'png'];
    $ekstensiGambar = explode ('.', $namafile);
    $ekstensiGambar = strtolower(end($ekstensiGambar));
    if( !in_array($ekstensiGambar, $ekstensiGambarValid)) {
        echo "<script>
                alert('Yang Anda Upload Bukan Gambar !');
             </script>";
        return false;
    }

    //Gambar siap diupload
    move_uploaded_file($tmpName, 'img/' . $namafile);

    return $namafile;
}


function hapus ($id) {
    global $hanif;
    mysqli_query($hanif,"DELETE FROM mahasiswa WHERE id = $id");

    return mysqli_affected_rows($hanif);
}

function  ubah ($data) {
    global $hanif;
$id = $data["id"];
$nrp =htmlspecialchars($data["nrp"]);
$nama =htmlspecialchars($data["nama"]);
$email =htmlspecialchars($data["email"]);
$jurusan = $data["jurusan"];
$gambar = $data["gambar"];

$query = "UPDATE mahasiswa SET
            nrp = '$nrp',
            nama = '$nama',
            email = '$email',
            jurusan = '$jurusan',
            gambar = '$gambar'
            WHERE id = $id
            ";
        mysqli_query($hanif, $query);

        return mysqli_affected_rows($hanif);
}

function cari ($keyword) {
    $query = "SELECT * FROM mahasiswa
                    WHERE
            nama LIKE '%$keyword%' OR
            nrp LIKE '%$keyword%'
    ";
    return query ($query);
}

function registrasi ($data) {
    global $hanif;

    $username = strtolower (stripcslashes ($data ["username"]));
    $password = mysqli_real_escape_string($hanif, $data["password"]);
    $password2 = mysqli_real_escape_string($hanif, $data["password2"]);

    //username sudah ada atau belum
    $result = mysqli_query($hanif, "SELECT username FROM user WHERE username='$username'");
    
    if (mysqli_fetch_assoc($result)) {
        echo "<script>
            alert ('username sudah terdaftar!');
        </script>";
        return false;
    }

// cek konfirmasi
    if ( $password !== $password2 ) {
        echo "<script>
                alert ('konfirmasi password tidak sesuai');
        </script>";
        return false;
    }
    //enskripsi
    $password = password_hash($password, PASSWORD_DEFAULT);

    //TAMBAH USER KE DB
    mysqli_query($hanif, "INSERT INTO user VALUES('', '$username', '$password')");

    return mysqli_affected_rows($hanif);
}
?>