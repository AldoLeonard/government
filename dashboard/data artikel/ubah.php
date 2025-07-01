<?php
session_start();
require("functions.php");

$id = $_GET["id"];
$art = query("SELECT * FROM artikel WHERE id = $id")[0];

if (isset($_POST["submit"])) {

    if (edit($_POST, $_FILES) > 0) {
        $success = true;
        $art = query("SELECT * FROM artikel WHERE id = $id")[0];
    } else {
        $error = true;
    }
}

$uploadAlert = null;
if (isset($_SESSION['upload_error'])) {
    $uploadAlert = $_SESSION['upload_error'];
    unset($_SESSION['upload_error']); // hapus setelah dibaca
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="shortcut icon" type="x-icon" href="../../images/logo1.png">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ubah Data Artikel</title>
    <link rel="stylesheet" href="ubah.css">
</head>

<body>
    <div class="heading">
        <h1>Ubah Data Artikel</h1>
    </div>
    <form action="" method="post" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?= $art["id"]; ?>">
        <input type="hidden" name="gambarLama" value="<?= $art["gambar"]; ?>">
        <!-- baris 1 -->
        <div class="form-row">
            <div class="nama-btn">
                <label for="tanggal">Tanggal</label>
                <input type="date" name="tanggal" id="tanggal" required value="<?= $art["tanggal"]; ?>">
            </div>
        </div>
        <!-- baris 2 -->
        <div class="form-row">
            <div class="nama-btn">
                <label for="judul">Judul</label>
                <textarea name="judul" id="judul" rows="3" style=" border: 1px solid #000; border-radius: 5px; padding: 10px;"><?= $art["judul"]; ?></textarea>
            </div>
            <div class="nama-btn">
                <label for="deskripsi">Deskripsi</label>
                <textarea name="deskripsi" id="deskripsi" rows="3" style=" border: 1px solid #000; border-radius: 5px; padding: 10px;" required><?= $art["deskripsi"]; ?></textarea>
            </div>
        </div>

        <!-- baris isi -->
        <div class="nama-btn full">
            <label for="isi_artikel">Isi Artikel</label>
            <textarea name="isi_artikel" id="isi_artikel" rows="5" style="width: 300px; border: 1px solid #000; border-radius: 5px; padding: 10px;" required><?= $art["isi_artikel"]; ?></textarea>
        </div>

        <div class="upload-btn full center">
            <input type="file" name="gambar" id="gambar" accept="image/*" onchange="previewImage(event)">
            <img id="preview" src="images/<?= $art['gambar']; ?>" style="max-width:200px; margin-top: 10px; margin-bottom:10px;">
            <label for="gambar">Ubah Gambar</label>
        </div>

        <div class="submit-btn center">
            <button type="submit" name="submit">Ubah Data</button>
        </div>
    </form>
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
                text: 'Data berhasil diubah!',
                confirmButtonText: 'OK',
                customClass: {
                    popup: 'my-swal-button',
                    confirmButton: 'my-ok-button'
                }
            }).then(() => {
                window.location.href = 'artikel.php';
            });
        <?php elseif (isset($error)): ?>
            Swal.fire({
                icon: 'error',
                title: 'Gagal!',
                text: 'Data gagal diubah!',
                confirmButtonText: 'OK',
                customClass: {
                    popup: 'my-swal-popup',
                    confirmButton: 'my-ok-button'
                }
            }).then(() => {
                window.location.href = 'artikel.php';
            });
        <?php endif; ?>

        <?php if (!empty($uploadAlert)): ?>
        Swal.fire({
            icon: 'error',
            title: 'Upload Gagal!',
            text: '<?= $uploadAlert; ?>',
            confirmButtonText: 'Oke',
            customClass: {
                popup: 'my-swal-popup',
                confirmButton: 'my-ok-button'
            },
            buttonStyling: false
        });
    <?php endif; ?>
    </script>

</body>

</html>