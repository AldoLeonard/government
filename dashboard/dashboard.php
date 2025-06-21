<?php
require("../functions.php");
$galeri = query("SELECT * FROM galeri ORDER BY id ASC");

//tombol cari diklik
if (isset($_POST["cari"])) {
  $galeri = cari($_POST["keyword"]);
}
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
          <li><a href="#">Artikel</a></li>
          <li><a href="data galeri/galeri.php">Galeri</a></li>
        </ul>
      </li>
      <!-- <li class="profile">
        <div class="profile-details">
          <div class="profile-content">
            <img src="../images/pani.png" alt="profileImg">
          </div>
        </div>
        <ul class="profile-sub">
          <li class="name">Aldo Leonard</li>
          <li class="job">Admin</li>
          <li><a href="../homepage.php">Logout</a></li>
        </ul>
      </li> -->
    </ul>
  </div>

  <section class="home-section">
    <div class="home-content">
      <span class="text">
        <h1>Dashboard</h1>
      </span>
    </div>
  </section>
</body>

</html>