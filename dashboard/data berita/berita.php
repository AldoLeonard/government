<?php
require("functions.php");
session_start();

if (isset($_GET['hapus'])) {
  $id = $_GET['hapus'];
  $hapusSukses = hafus($id) > 0;
  echo "<script>
  let hapusSukses = " . ($hapusSukses ? 'true' : 'false') . ";
  </script>";
}
$berita = query("SELECT * FROM berita ORDER BY id ASC");

//tombol cari diklik
if (isset($_POST["cari"])) {
  $berita = cary($_POST["keyword"]);
}

if (!isset($_SESSION['user'])) {
    header("Location: ../../login/login.php");
    exit;
}

$username = $_SESSION['user']['username'];
$email = $_SESSION['user']['email'];
?>



<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <meta charset="UTF-8">
  <link rel="shortcut icon" type="x-icon" href="../../images/logo1.png">
  <title>Data Berita</title>
  <link rel="stylesheet" href="berita.css">
  <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
  <div class="sidebar close">
    <ul class="nav-links">
      <li>
        <a href="../dashboard.php">
          <i class='bx bx-grid-alt'></i>
        </a>
        <ul class="sub-menu blank">
          <li><a class="link_name" href="../dashboard.php">Dashboard</a></li>
        </ul>
      </li>
      <li>
        <div class="iocn-link">
          <a href="#">
            <i class='bx bx-collection'></i>
          </a>
          <i class='bx bxs-chevron-down arrow'></i>
        </div>
        <ul class="sub-menu">
          <li><a href="#">Berita</a></li>
          <li><a href="../data artikel/artikel.php">Artikel</a></li>
          <li><a href="../data galeri/galeri.php">Galeri</a></li>
        </ul>
      </li>
      <li>
      </li>
      <div class="profile-hover">
        <div class="profile-icon">
          <i class='bx bx-user'></i>
        </div>
        <div class="profile-dropdown">
          <div class="profile-name"><?= $username; ?></div>
          <div class="profile-email"><?= $email; ?></div>
          <div><a href="../../homepage.php">Kembali</a></div>
        </div>
      </div>
    </ul>
  </div>
  <section class="home-section">
    <div class="home-content">
      <span class="text">
        <h1>Daftar Berita</h1>
      </span>
    </div>
    <div class="galeri-container">
      <div class="tambah-btn">
        <a href="tambah.php">Tambah Data Berita</a>
      </div>
      <br><br>

      <form action="" method="post">
        <div class="search-box">
          <i class="bx bx-search"></i>
          <input type="text" name="keyword" autofocus placeholder="Cari Berita..."
            autocomplete="off">
          <button type="submit" name="cari"></button>
        </div>
      </form>
      <div class="table_responsive">
        <table>
          <thead>
            <tr>
              <th>No</th>
              <th>Kategori</th>
              <th>Judul</th>
              <th>Tanggal</th>
              <th>Deskripsi</th>
              <th>Isi Berita</th>
              <th>Gambar</th>
              <th>Views</th>
              <th>Aksi</th>
            </tr>
            <?php $i = 1;  ?>
            <?php foreach ($berita as $row) : ?>
          </thead>
          <tbody>
            <tr>
              <td class="text"><?= $i; ?></td>
              <td class="text"><?= $row['kategori']; ?></td>
              <td class="text"><?= $row['judul']; ?></td>
              <td class="text"><?= $row['tanggal']; ?></td>
              <td class="text"><?= $row['deskripsi']; ?></td>
              <td class="text"><?= $row['isi_berita']; ?></td>
              <td class="image"><img src="images/<?php echo $row['gambar']; ?>" alt="" width="300px"></td>
              <td><?= $row['views']; ?></td>
              <td>
                <span class="action_btn">
                  <a href="ubah.php?id=<?php echo $row['id']; ?>">Ubah</a>
                  <a href="#" onclick="konfirmasiHapus(<?= $row['id']; ?>); return false;">Hapus</a>
                </span>
              </td>
            </tr>
            <?php $i++;  ?>
          <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </div>
  </section>

  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <script>
    function konfirmasiHapus(id) {
      Swal.fire({
        title: 'Yakin ingin Menghapus?',
        text: "Data akan hilang permanen!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Ya, hapus!',
        cancelButtonText: 'Batal',
        customClass: {
          popup: 'my-swal-popup',
          confirmButton: 'my-confirm-button',
          cancelButton: 'my-cancel-button'
        }
      }).then((result) => {
        if (result.isConfirmed) {
          window.location.href = "berita.php?hapus=" + id;
        }
      })
    }

    if (typeof hapusSukses !== 'undefined') {
      if (hapusSukses) {
        Swal.fire({
          icon: 'success',
          title: 'Berhasil!',
          text: 'Data berhasil dihapus!',
          confirmButtonText: 'OK',
          customClass: {
            popup: 'my-swal-popup',
            confirmButton: 'my-ok-button'
          }
        }).then(() => {
          window.location.href = 'berita.php';
        });
      } else {
        Swal.fire({
          icon: 'error',
          title: 'Gagal!',
          text: 'Data gagal dihapus.',
          confirmButtonText: 'OK',
          customClass: {
            popup: 'my-swal-popup',
            confirmButtonText: 'my-ok-button'
          }
        }).then(() => {
          window.location.href = 'berita.php';
        });
      }
    }
  </script>
</body>

</html>