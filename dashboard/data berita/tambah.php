<?php
require("functions.php");
if (isset($_POST["submit"])) {

    if (tambahb($_POST) > 0) {
        $success = true;
    } else {
        $error = true;
    }
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="shortcut icon" type="x-icon" href="../../images/logo1.png">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Data Berita</title>
    <link rel="stylesheet" href="tambah.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />

</head>

<body>
    <div class="heading">
        <h1>Tambah Data Berita</h1>
    </div>
    <form action="" method="post" enctype="multipart/form-data">
        <!-- baris 1 -->
        <div class="form-row">
            <div class="nama-btn">
                <label for="kategori">Kategori</label>
                <input type="text" name="kategori" id="kategori" required>
            </div>
            <div class="nama-btn">
                <label for="tanggal">Tanggal</label>
                <input type="text" name="tanggal" id="tanggal" required>
            </div>
        </div>
        <!-- baris 2 -->
        <div class="form-row">
            <div class="nama-btn">
                <label for="judul">Judul</label>
                <textarea name="judul" id="judul" rows="3" style=" border: 1px solid #000; border-radius: 5px; padding: 10px;" required></textarea>
            </div>
            <div class="nama-btn">
                <label for="deskripsi">Deskripsi</label>
                <textarea name="deskripsi" id="deskripsi" rows="3" style=" border: 1px solid #000; border-radius: 5px; padding: 10px;" required></textarea>
            </div>
        </div>

        <!-- baris isi -->
        <div class="nama-btn full">
            <label for="isi_berita">Isi Berita</label>
            <textarea name="isi_berita" id="isi_berita" rows="5" style="width: 300px; border: 1px solid #000; border-radius: 5px; padding: 10px;" required></textarea>
        </div>

        <div class="upload-btn full center">
            <input type="file" name="gambar" id="gambar" accept="image/*" onchange="previewImage(event)" required>
            <img id="preview" style="max-width:200px; margin-top: 10px; margin-bottom:10px;">
            <label for="gambar">Upload Gambar</label>
        </div>

        <div class="submit-btn center">
            <button type="submit" name="submit">Tambah Data</button>
        </div>
    </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function previewImage(event) {
            const image = document.getElementById('preview');
            image.src = URL.createObjectURL(event.target.files[0]);
            image.onload = () => URL.revokeObjectURL(image.src);
        }

        <?php if (isset($success)): ?>
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: 'Data berhasil ditambahkan!',
                confirmButtonText: 'OK',
                customClass: {
                    popup: 'my-swal-popup',
                    confirmButton: 'my-ok-button'
                }
            }).then(() => {
                window.location.href = 'berita.php';
            });
        <?php elseif (isset($error)): ?>
            Swal.fire({
                icon: 'error',
                title: 'Gagal!',
                text: 'Data gagal ditambahkan!',
                confirmButtonText: 'OK',
                customClass: {
                    popup: 'my-swal-popup',
                    confirmButton: 'my-ok-button'
                }
            }).then(() => {
                window.location.href = 'berita.php';
            });
        <?php endif; ?>
    </script>
</body>

</html>