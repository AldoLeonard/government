<?php

require("../functions.php");
session_start(); 
$galeri = query("SELECT * FROM galeri ORDER BY id ASC");

//tombol cari diklik
if (isset($_POST["cari"])) {
  $galeri = cari($_POST["keyword"]);
}

if (!isset($_SESSION['user'])) {
    header("Location: ../login/login.php");
    exit;
}

$username = $_SESSION['user']['username'];
$email = $_SESSION['user']['email'];

$totalBerita = query ("SELECT COUNT(*) AS total FROM berita")[0]['total'];
$totalArtikel = query ("SELECT COUNT(*) AS total FROM artikel")[0]['total'];
$totalViewsBerita = query ("SELECT SUM(views) AS total FROM berita")[0]['total'];
$totalViewsArtikel = query ("SELECT SUM(views) AS total FROM artikel")[0]['total'];
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <meta charset="UTF-8">
  <link rel="shortcut icon" type="x-icon" href="../images/logo1.png">
  <title>Dashboard</title>
  <link rel="stylesheet" href="dashboard.css">
  <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
  <div class="sidebar close">
    <ul class="nav-links">
      <li>
        <a href="#"><i class='bx bx-grid-alt'></i></a>
        <ul class="sub-menu blank">
          <li><a class="link_name" href="#">Dashboard</a></li>
        </ul>
      </li>
      <li>
        <div class="iocn-link">
          <a href="#"><i class='bx bx-collection'></i></a>
        </div>
        <ul class="sub-menu">
          <li><a href="data berita/berita.php">Berita</a></li>
          <li><a href="data artikel/artikel.php">Artikel</a></li>
          <li><a href="data galeri/galeri.php">Galeri</a></li>
        </ul>
      </li>
    </ul>
    <div class="profile-hover">
        <div class="profile-icon">
          <i class='bx bx-user'></i>
        </div>
        <div class="profile-dropdown">
          <div class="profile-name"><?= $username; ?></div>
          <div class="profile-email"><?= $email; ?></div>
          <div><a href="../homepage.php">Kembali</a></div>
          </div>
      </div>
  </div>

  <section class="home-section">
    <div class="home-content">
      <span class="text">
        <h1>Dashboard</h1>
      </span>
    </div>
    <div class="cards">
      <div class="card">
        <h3>Total Berita</h3>
        <p><?= $totalBerita ?></p>
      </div>
      <div class="card">
        <h3>Total Artikel</h3>
        <p><?= $totalArtikel ?></p>
      </div>
      <div class="card">
        <h3>Total Views Berita</h3>
        <p><?= $totalViewsBerita ?></p>
      </div>
      <div class="card">
        <h3>Total Views Artikel</h3>
        <p><?= $totalViewsArtikel ?></p>
      </div>
    </div>
  </section>
</body>

</html>