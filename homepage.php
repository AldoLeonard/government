<?php
require("functions.php");
$galeri = query("SELECT * FROM galeri ORDER BY id ASC");
$berita = query("SELECT * FROM berita ORDER BY id ASC");

if(isset($_POST["cari"])) {
    $berita = cary($_POST["keyword"]);
}


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="shortcut icon" type="x-icon" href="images/logo1.png">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kabupaten Cirebon</title>
    <link rel="stylesheet" href="homepage.css">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.8/css/line.css">
    <link rel="stylesheet" href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/font-awesome-line-awesome/css/all.min.css">
    <script src="https://kit.fontawesome.com/b68f1a1f02.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
    <script src="https://code.jquery.com/jquery-3.4.1.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css"/>
</head>
<body>

    <nav>
        <a href="">
        <div class="logo">
        <div class="logo-img"><img src="images/logo1.png" alt="" width="40px"></div>
        <div class="logo-text"><span>Kab</span><p>Cirebon</p></div>
         </div>
         </a>
        <input type="checkbox" id="click">
        <label for="click" class="menu-btn">
          <i class="fas fa-bars"></i>
        </label>
        <ul>
          <li><a  href="#beranda">Beranda</a></li>
          <li><a href="#profil">Profil</a></li>
          <li><a href="#berita">Berita</a></li>
          <li><a href="#tentang">Tentang</a></li>
          <li><a class="active" href="login/login.php"><i class='bx bx-user-circle'></i>Masuk</a></li>
        </ul>
      </nav>

    


    <section class="beranda" id="beranda">
        <div class="inner-beranda">
            <h1>Selamat Datang Di Kabupaten Cirebon</h1>
            <p>Terwujudnya Kabupaten Cirebon, Berbudaya, Sejahtera, Agamis, Maju dan Aman</p>
        </div>
    </section>

    <section class="container-pemerintahan" id="profil">
        <section class="profil-container">
            <div class="profil">
                <div class="profil-isi">
                <div class="profil-text">
                    <h1>Profil Singkat Kabupaten Cirebon</h1>
                    <p>Kabupaten Cirebon adalah kabupaten di Provinsi Jawa Barat, Indonesia. Ibu kotanya adalah Kecamatan Sumber. Kabupaten ini berada di ujung timur Jawa Barat serta menjadi pintu gerbang masuk provinsi Jawa Barat dari wilayah timur Jawa. Kabupaten Cirebon, yang bentuk nonformalnya adalah Cirbon atau Cerbon, merupakan produsen beras unggulan yang berada di jalur Pantura. Kabupaten Cirebon merupakan bagian dari wilayah Propinsi Jawa Barat yang terletak dibagian timur dan merupakan batas, sekaligus sebagai pintu gerbang Propinsi Jawa Tengah. Dalam sektor pertanian Kabupaten Cirebon merupakan salah satu daerah produsen beras yang terletak dijalur pantura.</p>
                    <a href="https://id.wikipedia.org/wiki/Kabupaten_Cirebon" class="profil-btn">Selengkapnya</a>
                </div>
                <div class="profil-content">
                    <iframe width="560" height="315" src="https://www.youtube.com/embed/MNFpoSCCf8E?si=ei4im_2MX5AmTROC" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                </div>
                </div>
            </div>
        </section>
    </section>

    <section id="berita">
        <div class="berita">
            <div class="berita-kiri">
                <div class="berita-judul">
                    <h1>Berita</h1>
                    <p>Baca Berita Terkini di Kabupaten Cirebon</p>
                </div>
                <div class="pattern-1">
                    
                </div>
                
                <section class="post container">
                <?php $i=1;  ?>
                 <?php foreach( $berita as $row) : ?>
                    <!-- post box 1 -->
                    <div class="post-box">
                        <img src="images/<?php echo $row['gambar']; ?>" alt="" width="100%" height="150px">
                        <h2 class="category"><?= $row['kategori']; ?></h2>
                        <a href="" class="post-title">
                        <?= $row['judul']; ?>
                        </a>
                        <span class="post-date"><?= $row['tanggal']; ?></span>
                        <p class="post-description"><?= $row['deskripsi']; ?></p>
                    </div>
                    <?php $i++;  ?>
                 <?php endforeach; ?> 
                </section>  
                 
            </div>
            <div class="berita-kanan">
                <form action="" method="post">
            <div class="search-box">
            <i class="bx bx-search"></i>
            <input type="text" name="keyword" placeholder="Cari Berita..."
            autocomplete="off" id="keyword">
            <button type="submit" name="cari" id="tombol-cari"></button>
                </form>
                <div class="live-box">
                    
                </div>
        </div>
                <div class="twibbon">
                    <div class="twibbon-title">
                        <h1>BERITA POPULER</h1>
                    </div>
                    <div class="twibbon-card">
                        <div class="text-populer">
                            <h3>Rotasi Mutasi Pejabat di Pemkab Cirebon, Bupati Imron Geser 177 Pejabat, 92 Promosi, Oktober Ada Lagi</h3>
                        </div>
                        <div class="text-populer">
                            <h3>Bupati Lantik 468 Pejabat Fungsional di Pemkab Cirebon, Paling Banyak Dilantik dari Kalangan Guru</h3>
                        </div>
                        <div class="text-populer">
                            <h3>Mutasi Pemkab Cirebon, Ada ASN Baru 8 Bulan Jadi Sekdis Digeser, Bupati: Pertimbangan Baperjakat</h3>
                        </div>
                        <div class="text-populer">
                            <h3>Jelang Idul Adha, Ratusan Ternak di Kab Cirebon Terjangkit Lato-lato, Paling Banyak di Kecamatan Ini</h3>
                        </div>
                        <div class="text-populer">
                            <h3>400 Ekor Hewan Terinfeksi LSD, Kabupaten Cirebon Masih Tunggu Kiriman Vaksin</h3>
                        </div>
                    </div>
                </div>
                <div class="pattern-2">
                    
                </div>
                
                <div class="pariwisata">
                    <div class="wisata-title">
                        <h1>Gallery</h1>
                    </div>
                <div class="swiper-box">
                    <!-- Slider main container -->
                    <div class="swiper">
                    <!-- Additional required wrapper -->
                    <div class="swiper-wrapper">
                    <!-- Slides -->
                    <?php foreach( $galeri as $row) : ?>
                    <div class="swiper-slide"><p><?= $row['nama']; ?></p><img src="../tubes/dashboard/data galeri/images/<?php echo $row['gambar']; ?>" alt="" ></div>

                    
                    <?php endforeach ?>
                    </div>
                    
                    <!-- If we need pagination -->
                    <div class="swiper-pagination"></div>
                </div>
                
                </div>
                    
                </div>
                
            </div>
        </div>
        <div class="berita-bawah">
            <div class="berita-judul">
                <h1>Artikel</h1>
                <p>Temukan Artikel Mengenai Kabupaten Cirebon</p>
            </div>
            <div class="pattern-3">
                
            </div>
        <section class="post container">
            <!-- post box 1 -->
            <div class="post-box">
                <img src="images/artikel1.png" alt="" class="post-img">
                <h2 class="category">Artikel</h2>
                <a href="" class="post-title">
                    7 Nama Desa Terunik di Kabupaten Cirebon Jawa Barat, Aneh tapi Nyata, Nomor 4 Namanya Mirip Perabotan
                </a>
                <span class="post-date">09 Februari 2023</span>
                <p class="post-description">Ternyata ada 7 desa di Kabupaten Cirebon, Jawa Barat yang memiliki nama sangat unik dan beda dari yang lain. Bagaimana tidak, desa di Kabupaten Cirebon ini memiliki nama yang unik. Bahkan ada yang menyerupai nama perabotan dapur.</p>
            </div>
            <!-- post box 2 -->
            <div class="post-box">
                <img src="images/artikel2.png" alt="" class="post-img">
                <h2 class="category">Artikel</h2>
                <a href="" class="post-title">
                    10 SMA Terbaik di Kabupaten Cirebon dengan Keunggulan yang Bermanfaat Untuk Meraih Kesuksesan Siswa!
                </a>
                <span class="post-date">15 Mei 2023</span>
                <p class="post-description"> Selamat datang di artikel ini yang akan membahas mengenai 10 SMA terbaik di Kabupaten Cirebon yang dapat dijadikan referensi bagi siswa SMP yang akan mempersiapkan diri untuk penerimaan peserta didik baru atau PPDB.</p>
            </div>
            <!-- post box 3 -->
            <div class="post-box">
                <img src="images/artikel3.png" alt="" class="post-img">
                <h2 class="category">Artikel</h2>
                <a href="" class="post-title">
                    5 Daerah Tersepi di Kabupaten Cirebon: Warga Sumber Jangan Kaget, Juaranya Bukan Karangsembung, tapi...
                </a>
                <span class="post-date">16 Mei 2023</span>
                <p class="post-description">siapa yang tidak kenal dengan kabupaten Cirebon, pastinya daerah ini sudah tak asing lagi. Cirebon sering dijuluki sebagai kota udang karena lokasinya yang sangat berdekatan dengan laut.</p>
            </div>
    </section>
</div>
    </section>

    <section class="info-container" id="tentang">
        <div class="informasi-kec">
            <div class="info-text">
                <h1 style="top: 418%; right: 75%;">01</h1>
                <h3>Jumlah Penduduk</h3>
                <p>2.099.089 jiwa</p>
            </div>
            <div class="info-text">
                <h1 style="top: 418%; right: 43.5%;">02</h1>
                <h3>Luas Wilayah</h3>
                <p> 984,52 km²</p>
            </div>
            <div class="info-text">
                <h1 style="top: 418%; right: 14%;">03</h1>
                <h3>Sebaran Penduduk</h3>
                <p>2.132 jiwa/km²</p>
            </div>
        </div>
            </section>

    

  <footer>
    <div class="footer-content">
        <p>Gemah Ripah Loh Jinawi adalah perjuangan masyarakat sebagai bagian bangsa Indonesia bercita-cita menciptakan ketentraman/perdamaian, kesuburan, keadilan, kemakmuran, tata raharja serta mulia abad.</p>
        <ul class="socials">
            <li><a href="#"><i class="fa fa-facebook"></i></a></li>
            <li><a href="#"><i class="fa fa-twitter"></i></a></li>
            <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
            <li><a href="#"><i class="fa fa-youtube"></i></a></li>
        </ul>
    </div>
    <div class="copyright">
        <p>&copy;2023 Pemerintah Kabupaten Cirebon</p>
    </div>
</footer>


    <!-- link to js -->
    <script src="script.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>

    <script>
        const swiper = new Swiper('.swiper', {
            autoplay: {
                delay: 3000,
                disableOnInteraction: false,
            },
  // Optional parameters
  loop: true,

  // If we need pagination
  pagination: {
    el: '.swiper-pagination',
    clickable: true,
  },


});
    </script>

</body>
</html>