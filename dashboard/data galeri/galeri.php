<?php
require("functions.php");
$galeri = query("SELECT * FROM galeri ORDER BY id ASC");

//tombol cari diklik
if(isset($_POST["cari"])) {
    $galeri = cari($_POST["keyword"]);
}
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8">
    <title> Dashboard</title>
    <link rel="stylesheet" href="galeri.css">
    <!-- Boxiocns CDN Link -->
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
   </head>
<body>
  <div class="sidebar close">
    <div class="logo-details">
      <span class="logo_name">Government</span>
    </div>
    <ul class="nav-links">
      <li>
        <a href="#">
          <i class='bx bx-grid-alt' ></i>
          <span class="link_name">Dashboard</span>
        </a>
        <ul class="sub-menu blank">
          <li><a class="link_name" href="../dashboard.php">Dashboard</a></li>
        </ul>
      </li>
      <li>
        <div class="iocn-link">
          <a href="#">
            <i class='bx bx-collection' ></i>
            <span class="link_name">Update</span>
          </a>
          <i class='bx bxs-chevron-down arrow' ></i>
        </div>
        <ul class="sub-menu">
          <li><a class="link_name" href="#">Update</a></li>
          <li><a href="../data berita/berita.php">Berita</a></li>
          <li><a href="#">Artikel</a></li>
          <li><a href="#">Galeri</a></li>
        </ul>
      </li>
      <li>
        <a href="#">
          <i class='bx bx-pie-chart-alt-2' ></i>
          <span class="link_name">Analytics</span>
        </a>
        <ul class="sub-menu blank">
          <li><a class="link_name" href="#">Analytics</a></li>
        </ul>
      </li>
      <li>
        <a href="#">
          <i class='bx bx-line-chart' ></i>
          <span class="link_name">Chart</span>
        </a>
        <ul class="sub-menu blank">
          <li><a class="link_name" href="#">Chart</a></li>
        </ul>
      <li>
        <a href="#">
          <i class='bx bx-cog' ></i>
          <span class="link_name">Setting</span>
        </a>
        <ul class="sub-menu blank">
          <li><a class="link_name" href="#">Setting</a></li>
        </ul>
      </li>
      <li>
    <div class="profile-details">
      <div class="profile-content">
        <img src="images/pani.png" alt="profileImg">
      </div>
      <div class="name-job">
        <div class="profile_name">Aldo Leonard</div>
        <div class="job">ADMIN</div>
      </div>
      <a href="../../homepage.php"><i class='bx bx-log-out'></i></a>
    </div>
  </li>
</ul>
  </div>
  <section class="home-section">
    <div class="home-content">
      <i class='bx bx-menu' ></i>
      <span class="text"><h1>Daftar galeri</h1></span>
    </div>
    <div class="galeri-container">
    <div class="tambah-btn">
    <a href="tambah.php">Tambah Data Galeri</a>
    </div>
    <br><br>

    <form action="" method="post">
    <div class="search-box">
            <i class="bx bx-search"></i>
            <input type="text" name="keyword" autofocus  placeholder="Cari Galeri..."
            autocomplete="off" id="keyword">
            <button type="submit" name="cari" id="tombol-cari"></button>
        </div>
    </form>

    <div class="table-responsive" id="container">
    <table>
        <thead>
        <tr>
            <th>Nomer</th>
            <th>Nama</th>
            <th>Gambar</th>
            <th>Aksi</th>
        </tr>
        <?php $i=1;  ?>
        <?php foreach( $galeri as $row) : ?>
        </thead>
        <tbody>
        <tr>
            <div class="table-text">
            <td class="text"><?= $i; ?></td>
            <td class="text"><?= $row['nama']; ?></td>
            <td class="image"><img src="images/<?php echo $row['gambar']; ?>" alt="" ></td>
            <td>
                <span class="action_btn">
                <a href="ubah.php?id=<?php echo $row['id']; ?>">Ubah</a> 
                <a href="hapus.php?id=<?php echo $row['id']; ?>" onclick="return confirm('Yakin?');">Hapus</a>
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
 
  <script src="script.js"></script>
  <script>
  let arrow = document.querySelectorAll(".arrow");
  for (var i = 0; i < arrow.length; i++) {
    arrow[i].addEventListener("click", (e)=>{
   let arrowParent = e.target.parentElement.parentElement;//selecting main parent of arrow
   arrowParent.classList.toggle("showMenu");
    });
  }
  let sidebar = document.querySelector(".sidebar");
  let sidebarBtn = document.querySelector(".bx-menu");
  console.log(sidebarBtn);
  sidebarBtn.addEventListener("click", ()=>{
    sidebar.classList.toggle("close");
  });
  </script>
</body>
</html>