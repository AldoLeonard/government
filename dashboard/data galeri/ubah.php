<?php
require ("functions.php");

$id = $_GET["id"];
$glr = query("SELECT * FROM galeri WHERE id = $id")[0];

 if( isset($_POST["submit"]))   {

    if( ubah($_POST) > 0) {
        echo "
        <script>
         alert('Data Berhasil Diubah!');
         document.location.href = 'galeri.php';
         </script>
        ";
    } else {
        echo "<script>
        alert('Data Gagal Diubah!');
        document.location.href = 'galeri.php';
        </script>";
    }
 }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ubah Data</title>
    <link rel="stylesheet" href="ubah.css">
</head>
<body>
<div class="heading">
    <h1>Ubah Data Galeri</h1>
    </div>
    <form action="" method="post" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?= $glr["id"];?>">
        <input type="hidden" name="gambarLama" value="<?= $glr["gambar"]; ?> ">
        <ul>
            <li class="nama-btn">
                <label for="nama">Nama</label>
                <input type="text" name="nama" id="nama" require value="<?= $glr["nama"]; ?> ">
            </li>
            <li class="upload-btn">
            <div class="gambar-lama">
                <img src="images/<?= $glr["gambar"]; ?>" alt="">
                
                <label for="gambar">UBAH GAMBAR</label>
                <input type="file" name="gambar" id="gambar">
                </div>
            </li>
            <li class="submit-btn">
                <button type="submit" name="submit">Ubah Data!</button>
            </li>
        </ul>
    </form> 
    
</body>
</html>