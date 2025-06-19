<?php
require ("functions.php");

$id = $_GET["id"];
$brt = query("SELECT * FROM berita WHERE id = $id")[0];

 if( isset($_POST["submit"]))   {

    if(uvah($_POST) > 0) {
        echo "
        <script>
         alert('Data Berhasil Diubah!');
         document.location.href = 'berita.php';
         </script>
        ";
    } else {
        echo "<script>
        alert('Data Gagal Diubah!');
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
    <title>Ubah Data</title>
    <link rel="stylesheet" href="ubah.css">
</head>
<body>
<div class="heading">
    <h1>Ubah Data Galeri</h1>
    </div>
    <form action="" method="post" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?= $brt["id"];?>">
        <input type="hidden" name="gambarLama" value="<?= $brt["gambar"];?>">
        <ul>
            <li class="nama-btn">
                <label for="kategori">Kategori</label>
                <input type="text" name="kategori" id="kategori" require value="<?= $brt["kategori"]; ?> ">
            </li>
            <li class="nama-btn">
                <label for="judul">Judul</label>
                <input type="text" name="judul" id="judul" require value="<?= $brt["judul"]; ?> ">
            </li>
            <li class="nama-btn">
                <label for="tanggal">Tanggal</label>
                <input type="text" name="tanggal" id="tanggal" require value="<?= $brt["tanggal"]; ?> ">
            </li>
            <li class="nama-btn">
                <label for="deskripsi">Deskripsi</label>
                <input type="text" name="deskripsi" id="deskripsi" require value="<?= $brt["deskripsi"]; ?> ">
            </li>
            <li class="nama-btn">
                <label for="isi_berita">Isi Berita</label>
                <input type="isi_berita" name="isi_berita" id="isi_berita" require value="<?= $brt["isi_berita"]; ?> ">
                <!-- <textarea name="isi_berita" id="isi_berita" rows="10" required></textarea> -->
            </li>
            <li class="upload-btn">
            <div class="gambar-lama">
                <img src="images/<?= $brt['gambar']; ?>" alt="">
                </div>
                <label for="gambar">UBAH GAMBAR</label>
                
                <input type="file" name="gambar" id="gambar" require >
            </li>
            <li class="submit-btn">
                <button type="submit" name="submit">Ubah Data!</button>
            </li>
        </ul>
    </form>
    
</body>
</html>