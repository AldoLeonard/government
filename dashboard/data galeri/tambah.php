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
    <link rel="shortcut icon" type="x-icon" href="../../images/logo1.png">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Data Galeri</title>
    <link rel="stylesheet" href="tambah.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
</head>
<body>
    <div class="heading">
    <h1>Tambah Data Galeri</h1>
    </div>
    <div>
    <form action="" method="post" enctype="multipart/form-data">
        <div class="form-row">
            <div class="nama-btn">
                <label for="nama">Nama</label>
                <input type="text" name="nama" id="nama" required>
            </div>
            <div class="upload-btn full center">
                <input type="file" name="gambar" id="gambar" accept="image/*" onchange="previewImage(event)" required>
                <img id="preview" style="max-width:200px; margin-top: 10px; margin-bottom:10px;">
                <label for="gambar">Upload Gambar</label>
            </div>
            <div class="submit-btn center">
                <button type="submit" name="submit">Tambah Data</button>
            </div>
        </div>  
    </form>
    </div>
   <script>
        function previewImage(event) {
            const image = document.getElementById('preview');
            image.src = URL.createObjectURL(event.target.files[0]);
            image.onload = () => URL.revokeObjectURL(image.src);
        }
   </script>
</body>
</html>