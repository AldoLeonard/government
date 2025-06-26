<?php
session_start();
require("functions.php");

$galeri = query("SELECT * FROM galeri ORDER BY id ASC");
$berita = query("SELECT * FROM berita ORDER BY tanggal DESC LIMIT 9");
$berita_populer = query("SELECT * FROM berita ORDER BY views DESC LIMIT 5");
$artikel = query("SELECT * FROM artikel ORDER BY tanggal DESC LIMIT 3");

if (isset($_POST["cari"])) {
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <script src="https://code.jquery.com/jquery-3.4.1.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css" />
</head>

<body>

    <nav>
        <a href="">
            <div class="logo">
                <div class="logo-img"><img src="images/logo1.png" alt="" width="40px"></div>
                <div class="logo-text"><span>Kab</span>
                    <p>Cirebon</p>
                </div>
            </div>
        </a>
        <input type="checkbox" id="click">
        <label for="click" class="menu-btn"><i class="fas fa-bars"></i></label>
        <ul>
            <li><a href="#beranda">Beranda</a></li>
            <li><a href="#profil">Profil</a></li>
            <li><a href="#berita">Berita</a></li>
            <li><a href="#tentang">Tentang</a></li>

            <li>
                <?php if (isset($_SESSION['user'])) : ?>
                    <div class="user-dropdown">
                        <button class="user-btn">
                            <?= htmlspecialchars($_SESSION['user']['username']) ?>
                            <i class='bx bx-chevron-down'></i>
                        </button>
                        <div class="dropdown-menu">
                            <a href="dashboard/dashboard.php">Masuk ke Dashboard</a>
                            <a href="login/logout.php">Logout</a>
                        </div>
                    </div>
                <?php else : ?>
                    <a class="active" href="login/login.php"><i class='bx bx-user-circle'></i>Masuk</a>
                <?php endif; ?>
            </li>
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
                        <iframe width="100%" height="315" src="https://www.youtube-nocookie.com/embed/MNFpoSCCf8E?rel=0&modestbranding=1&playsinline=1" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
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
                <!-- search box mobile -->
                <div class="search-box-mobile">
                    <form action="" method="post">
                        <i class="bx bx-search"></i>
                        <input type="text" name="keyword" placeholder="Cari Berita..."
                            autocomplete="off" id="keyword-mobile">
                    </form>
                    <div id="search-result-mobile"></div>
                </div>
                <div class="pattern-1">
                </div>
                <section class="post container">
                    <?php $i = 1;  ?>
                    <?php foreach ($berita as $row) : ?>
                        <!-- post box 1 -->
                        <div class="post-box">
                            <a href="detail.php?id=<?= $row['id']; ?>">
                                <img src="../government/dashboard/data berita/images/<?php echo $row['gambar']; ?>" alt="" width="100%" height="150px">
                                <h2 class="category"><?= $row['kategori']; ?></h2>
                                <div class="post-title">
                                    <?= $row['judul']; ?>
                                </div>
                                <span class="post-date"><?= $row['tanggal']; ?></span>
                                <p class="post-description"><?= $row['deskripsi']; ?></p>
                            </a>
                        </div>
                        <?php $i++;  ?>
                    <?php endforeach; ?>
                </section>
            </div>
            <div class="berita-kanan">
                <!-- search box web -->
                <form action="" method="post">
                    <div class="search-box">
                        <i class="bx bx-search"></i>
                        <input type="text" name="keyword" placeholder="Cari Berita..."
                            autocomplete="off" id="keyword-desktop">
                </form>
                <div id="search-result"></div>
            </div>
            <div class="twibbon">
                <div class="twibbon-title">
                    <h1>BERITA POPULER</h1>
                </div>
                <div class="twibbon-card">
                    <?php foreach ($berita_populer as $pop): ?>
                        <div class="text-populer">
                            <a href="detail.php?id=<?= $pop['id']; ?>">
                                <?= substr($pop['judul'], 0, 60); ?>
                            </a>
                        </div>
                    <?php endforeach; ?>
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
                            <?php foreach ($galeri as $row) : ?>
                                <div class="swiper-slide">
                                    <div class="slide-wrapper">
                                        <img src="../government/dashboard/data galeri/images/<?php echo $row['gambar']; ?>" alt="">
                                        <div class="swiper-caption">
                                            <p><?= $row['nama']; ?></p>
                                        </div>
                                    </div>
                                </div>
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
                <?php foreach ($artikel as $row): ?>
                    <div class="post-box">
                        <a href="detail_artikel.php?id=<?= $row['id']; ?>">
                            <img src="../government/dashboard/data artikel/images/<?= $row['gambar']; ?>" alt="" class="post-img">
                            <h2 class="category">Artikel</h2>
                            <a href="" class="post-title"><?= $row['judul']; ?></a>
                            <span class="post-date"><?= $row['tanggal']; ?></span>
                            <p class="post-description"><?= $row['deskripsi']; ?></p>
                        </a>
                    </div>
                <?php endforeach; ?>
            </section>
        </div>
    </section>

    <section class="info-container" id="tentang">
        <div class="informasi-kec">
            <div class="info-text">
                <h1>01</h1>
                <h3>Jumlah Penduduk</h3>
                <p>2.099.089 jiwa</p>
            </div>
            <div class="info-text">
                <h1>02</h1>
                <h3>Luas Wilayah</h3>
                <p> 984,52 km²</p>
            </div>
            <div class="info-text">
                <h1>03</h1>
                <h3>Sebaran Penduduk</h3>
                <p>2.132 jiwa/km²</p>
            </div>
        </div>
    </section>



    <footer>
        <div class="footer-content">
            <p>Gemah Ripah Loh Jinawi adalah perjuangan masyarakat sebagai bagian bangsa Indonesia bercita-cita menciptakan ketentraman/perdamaian, kesuburan, keadilan, kemakmuran, tata raharja serta mulia abad.</p>
            <ul class="socials">
                <li><a href="https://web.facebook.com/cirebonkab"><i class="fa fa-facebook"></i></a></li>
                <li><a href="https://x.com/cirebonkab?t=HuhgMG3H9JlC5R2Rin6WUw&s=09"><i class="fa fa-twitter"></i></a></li>
                <li><a href="https://youtube.com/@cirebonkabtv?si=D73ahb_r69uRCdgm"><i class="fa fa-youtube"></i></a></li>
            </ul>
        </div>
        <div class="copyright">
            <p>&copy;2023 Pemerintah Kabupaten Cirebon</p>
        </div>
    </footer>


    <!-- link to js -->
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
        document.querySelectorAll("nav ul li a").forEach(link => {
            link.addEventListener("click", () => {
                document.getElementById("click").checked = false;
            });
        });
        var keyword = document.getElementById('keyword');
        var tombolCari = document.getElementById('tombol-cari');
        var container = document.getElementById('container');

        function liveSearch(inputId) {
            const input = document.getElementById(inputId);
            const searchBoxMobile = document.getElementById("search-result-mobile");
            const searchBox = document.getElementById("search-result");

            input.addEventListener("keyup", function() {
                const keyword = this.value.trim();

                if (keyword === "") {
                    searchBoxMobile.style.display = "none";
                    searchBoxMobile.innerHTML = "";
                    searchBox.style.display = "none";
                    searchBox.innerHTML = "";
                    return;
                }

                const xhr = new XMLHttpRequest();
                xhr.onreadystatechange = function() {
                    if (xhr.readyState === 4 && xhr.status === 200) {
                        const result = xhr.responseText.trim();

                        if (result !== "") {
                            searchBoxMobile.innerHTML = result;
                            searchBoxMobile.style.display = "block";
                        } else {
                            searchBoxMobile.innerHTML = "<div class='search-item'>Tidak ditemukan berita.</div>";
                            searchBoxMobile.style.display = "block";
                        }
                        if (result !== "") {
                            searchBox.innerHTML = result;
                            searchBox.style.display = "block";
                        } else {
                            searchBox.innerHTML = "<div class='search-item'>Tidak ditemukan berita.</div>";
                            searchBox.style.display = "block";
                        }
                    }
                };
                xhr.open("GET", "search.php?keyword=" + encodeURIComponent(keyword), true);
                xhr.send();
            });
        }

        liveSearch("keyword-desktop");
        liveSearch("keyword-mobile");
    </script>

</body>

</html>