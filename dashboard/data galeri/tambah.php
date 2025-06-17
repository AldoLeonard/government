<?php
require ("functions.php");
 if( isset($_POST["submit"]))   {

    

    if(tambah($_POST) > 0) {
        echo "
        <script>
        alert('Data Berhasil Ditambahkan!');
         document.location.href = '../data galeri/galeri.php';
         </script>
        ";
    } else {
        echo "<script>
        alert('Data Gagal Ditambahkan!');
        document.location.href = '../data galeri/galeri.php';
        </script>";
    }
 }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="tambah.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
</head>
<body>
    <div class="heading">
    <h1>Tambah Data Galeri</h1>
    </div>
    <div>
    <form action="" method="post" enctype="multipart/form-data">
        <ul class="box">
            <li class="nama-btn">
                <label for="nama">Nama</label>
                <input type="text" name="nama" id="nama" require>
            </li>
            <li class="upload-btn">
                <label for="gambar">Upload Gambar</label>
                <input type="file" name="gambar" id="gambar" require>
            </li>
            <li class="submit-btn">
                <button type="submit" name="submit">Tambah Data!</button>
            </li>
        </ul>
        

    </form>
    </div>
   
</body>
</html>