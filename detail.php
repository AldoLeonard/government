<?php
require("functions.php");

// ambil ID dari URL
$id = $_GET['id'];

// ambil data berita berdasarkan ID
$berita = query("SELECT * FROM berita WHERE id = $id")[0];

mysqli_query($conn, "UPDATE berita SET views = views + 1 WHERE id = $id");
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Detail Berita</title>
  <link rel="stylesheet" href="detail.css">
</head>

<body>
  <div class="container">
    <a href="homepage.php" class="back-button">← Kembali</a>
    <h1 class="judul"><?= $berita['judul']; ?></h1>
    <p class="tanggal"><?= $berita['tanggal']; ?> | <?= $berita['kategori']; ?></p>
    <img src="dashboard/data berita/images/<?= $berita['gambar']; ?>" alt="gambar berita" class="gambar">
    <p class="isi"><?= nl2br($berita['isi_berita']); ?></p>
  </div>
</body>

</html>