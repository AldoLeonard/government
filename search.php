<?php
require("functions.php");

if (isset($_GET['keyword'])) {
    $keyword = htmlspecialchars($_GET["keyword"]);
    $berita = cary($keyword); // fungsi sudah kamu punya

    if (!empty($berita)) {
        foreach ($berita as $row) {
            echo "<div class='search-item'>";
            echo "<a href='detail.php?id={$row['id']}'>" . htmlspecialchars($row['judul']) . "</a>";
            echo "</div>";
        }
    } else {
        echo "<div class='search-item'>Tidak ditemukan berita.</div>";
    }
}
?>
