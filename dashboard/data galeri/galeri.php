<?php
require("functions.php");
if (isset($_GET['hapus'])) {
  $id = $_GET['hapus'];
  $hapusSukses = hapus($id) > 0;
  echo "<script>
  let hapusSukses = " . ($hapusSukses ? 'true' : 'false') . ";
  </script>";
}

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
  <link rel="shortcut icon" type="x-icon" href="../../images/logo1.png">
  <title> Data Galeri</title>
  <link rel="stylesheet" href="galeri.css">
  <!-- Boxiocns CDN Link -->
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
        </div>
        <ul class="sub-menu">
          <li><a href="../data berita/berita.php">Berita</a></li>
          <li><a href="#">Artikel</a></li>
          <li><a href="galeri.php">Galeri</a></li>
        </ul>
      </li>
      <li>
        <!-- <div class="profile-details">
      <div class="profile-content">
        <img src="../../images/pani.png" alt="profileImg">
      </div>
      <div class="name-job">
        <div class="profile_name">Aldo Leonard</div>
        <div class="job">ADMIN</div>
      </div>
      <a href="../../homepage.php"><i class='bx bx-log-out'></i></a>
    </div> -->
      </li>
    </ul>
  </div>
  <section class="home-section">
    <div class="home-content">
      <span class="text">
        <h1>Daftar Galeri</h1>
      </span>
    </div>
    <div class="galeri-container">
      <div class="tambah-btn">
        <a href="tambah.php">Tambah Data Galeri</a>
      </div>
      <br><br>

      <form action="" method="post">
        <div class="search-box">
          <i class="bx bx-search"></i>
          <input type="text" name="keyword" autofocus placeholder="Cari Galeri..."
            autocomplete="off" id="keyword">
          <button type="submit" name="cari" id="tombol-cari"></button>
        </div>
      </form>

      <div class="table-responsive" id="container">
        <table>
          <thead>
            <tr>
              <th>No</th>
              <th>Nama</th>
              <th>Gambar</th>
              <th>Aksi</th>
            </tr>
            <?php $i = 1;  ?>
            <?php foreach ($galeri as $row) : ?>
          </thead>
          <tbody>
            <tr>
              <div class="table-text">
                <td class="text1"><?= $i; ?></td>
                <td class="text"><?= $row['nama']; ?></td>
                <td class="image"><img src="images/<?php echo $row['gambar']; ?>" alt="" width="300px"></td>
                <td>
                  <span class="action_btn">
                    <a href="ubah.php?id=<?php echo $row['id']; ?>">Ubah</a>
                    <a href="#" onclick="konfirmasiHapus(<?= $row['id']; ?>); return false;">Hapus</a>
                  </span>
                </td>
              </div>
            </tr>
            <?php $i++;  ?>
          <?php endforeach; ?>
          </tbody>

        </table>
      </div>
    </div>
  </section>

  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <script src="script.js"></script>
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
          confirmButton: 'my-confirm-button',
          cancelButton: 'my-cancel-button'
        }
      }).then((result) => {
        if (result.isConfirmed) {
          window.location.href = "galeri.php?hapus=" + id;
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
            confirmButton: 'my-ok-button'
          }
        }).then(() => {
          window.location.href = 'galeri.php';
        });
      } else {
        Swal.fire({
          icon: 'error',
          title: 'Gagal!',
          text: 'Data gagal dihapus.',
          confirmButtonText: 'OK',
          customClass: {
            confirmButtonText: 'my-ok-button'
          }
        }).then(() => {
          window.location.href = 'galeri.php';
        });
      }
    }
  </script>
</body>

</html>