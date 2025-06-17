<?php

require("functions.php");

$id = $_GET["id"];

if(hafus($id) > 0) {
    echo "
        <script>
         alert('Data Berhasil Dihapus!');
         document.location.href = 'beritaa.php';
         </script>
        ";
} else {
    echo "
    <script>
        alert('Data Gagal Dihapus!');
        document.location.href = 'beritaa.php';
        </script>
        ";
}
?>