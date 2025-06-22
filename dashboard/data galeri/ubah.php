<?php
require("functions.php");

$id = $_GET["id"];
$glr = query("SELECT * FROM galeri WHERE id = $id")[0];

if (isset($_POST["submit"])) {

    if (ubah($_POST, $_FILES) > 0) {
        $success = true;
        $glr = query("SELECT * FROM galeri WHERE id = $id")[0];
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
    <title>Ubah Data Galeri</title>
    <link rel="stylesheet" href="ubah.css">
</head>

<body>
    <div class="heading">
        <h1>Ubah Data Galeri</h1>
    </div>
    <form action="" method="post" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?= $glr["id"]; ?>">
        <input type="hidden" name="gambarLama" value="<?= $glr["gambar"]; ?> ">
        <div>
            <div class="nama-btn">
                <label for="nama">Nama</label>
                <input type="text" name="nama" id="nama" required value="<?= $glr["nama"]; ?>">
            </div>
            <div class="upload-btn full center">
                <input type="file" name="gambar" id="gambar" accept="image/*" onchange="previewImage(event)">
                <img id="preview" src="images/<?= $glr['gambar']; ?>" style="max-width:200px; margin-top: 10px; margin-bottom:10px;">
                <label for="gambar">Ubah Gambar</label>
            </div>

            <div class="submit-btn center">
                <button type="submit" name="submit">Ubah Data</button>
            </div>
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
                window.location.href = 'galeri.php';
            });
        <?php elseif (isset($error)): ?>
            Swal.fire({
                icon: 'error',
                title: 'Gagal!',
                text: 'Data gagal diubah!',
                confirmButtonText: 'OK',
                customClass: {
                    popup: 'my-swal-button',
                    confirmButton: 'my-ok-button'
                }
            }).then(() => {
                window.location.href = 'galeri.php';
            });
        <?php endif; ?>
    </script>
</body>

</html>