<?php
require("functions.php");

// ambil ID dari URL
$id = $_GET['id'];

// ambil data berita berdasarkan ID
$artikel = query("SELECT * FROM artikel WHERE id = $id")[0];

mysqli_query($conn, "UPDATE artikel SET views = views + 1 WHERE id = $id");
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="shortcut icon" type="x-icon" href="images/logo1.png">
  <title><?= htmlspecialchars($artikel['judul']);?></title>
  <link rel="stylesheet" href="detail_artikel.css">
</head>

<body>
  <div class="container">
    <a href="homepage.php" class="back-button">Kembali</a>
    <h1 class="judul"><?= $artikel['judul']; ?></h1>
    <p class="tanggal"><?= $artikel['tanggal']; ?></p>
    <img src="dashboard/data artikel/images/<?= $artikel['gambar']; ?>" alt="gambar artikel" class="gambar">
    <p class="isi_artikel"><?= nl2br($artikel['isi_artikel']); ?></p>
  </div>
</body>

</html>