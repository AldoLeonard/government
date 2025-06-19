<?php
require ("functions.php");
 if( isset($_POST["submit"]))   {

    

    if(tambahb($_POST) > 0) {
        echo "
        <script>
        alert('Data Berhasil Ditambahkan!');
         document.location.href = 'berita.php';
         </script>
        ";
    } else {
        echo "<script>
        alert('Data Gagal Ditambahkan!');
        document.location.href = 'berita.php';
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
    <h1>Tambah Data Berita</h1>
    </div>
    <div>
    <form action="" method="post" enctype="multipart/form-data">
        <ul class="box">
        <li class="nama-btn">
                <label for="kategori">Kategori</label>
                <input type="text" name="kategori" id="kategori" require>
            </li>
        <li class="nama-btn">
                <label for="judul">Judul</label>
                <input type="text" name="judul" id="judul" require>
            </li>
        <li class="nama-btn">
                <label for="tanggal">Tanggal</label>
                <input type="text" name="tanggal" id="tanggal" require>
            </li>
        <li class="nama-btn">
                <label for="deskripsi">Deskripsi</label>
                <input type="text" name="deskripsi" id="deskripsi" require>
            </li>
        <li class="nama-btn">
                <label for="isi_berita">Isi Berita</label>
                <textarea name="isi_berita" id="isi_berita" rows="10" required></textarea>
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