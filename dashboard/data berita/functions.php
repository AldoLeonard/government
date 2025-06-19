<?php
$conn = mysqli_connect("localhost", "root", "", "tubes");

function query($query) {
    global $conn;
    $result = mysqli_query($conn, $query);
    $rows = [];
    while( $row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }

    return $rows;
}

function tambah($data) {
    global $conn;
    $nama =htmlspecialchars($data["nama"]) ;
    //upload gambar
    $gambar = upload();
    if( !$gambar) {
        return false;
    }

    $query = "INSERT INTO galeri VALUES(null, '$nama', '$gambar')";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function tambahb($data) {
    global $conn;
    $kategori =htmlspecialchars($data["kategori"]) ;
    $judul =htmlspecialchars($data["judul"]) ;
    $tanggal =htmlspecialchars($data["tanggal"]) ;
    $deskripsi =htmlspecialchars($data["deskripsi"]) ;
    $isi =htmlspecialchars($data["isi_berita"]) ;
    //upload gambar
    $gambar = upload();
    if( !$gambar) {
        return false;
    }

    $query = "INSERT INTO berita VALUES(null, '$kategori', '$judul', '$tanggal', '$deskripsi', '$isi', '$gambar')";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function upload() {
    $namaFile = $_FILES['gambar']['name'];
    $ukuranFile = $_FILES['gambar']['size'];
    $error = $_FILES['gambar']['error'];
    $tmpName = $_FILES['gambar']['tmp_name'];

    //cek apakah tidak ada gambar yang diupload
    if($error === 4) {
        echo "
            <script>
            alert('Pilih Gambar Dulu bero!');
            </script>
        ";
        return false;
    }

    //cek apakah yang diupload adalah gambar
    $ekstensiGambarValid = ['jpg', 'jpeg', 'png'];
    $ekstensiGambar = explode('.', $namaFile);
    $ekstensiGambar = strtolower (end($ekstensiGambar));
    if(!in_array($ekstensiGambar, $ekstensiGambarValid)) {
        echo "
            <script>
            alert('Yang anda upload bukan gambar bero!');
            </script>
        ";
        return false;
    } 

    //cek jika ukurannya terlalu besar
    if($ukuranFile > 5000000) {
        echo "
            <script>
            alert('Ukuran gambar terlalu besar bero!');
            </script>
        ";
        return false;
    }

    //lolos pengecekan, gambar siap diupload
    //generate nama gambar baru
    $namaFileBaru = uniqid();
    $namaFileBaru.= '.';
    $namaFileBaru.= $ekstensiGambar;
    move_uploaded_file($tmpName, 'images/' . $namaFileBaru);
    return $namaFileBaru;
}

function hapus($id) {
    global $conn;
    mysqli_query($conn, "DELETE FROM galeri WHERE id = $id");
    return mysqli_affected_rows($conn);
}
function hafus($id) {
    global $conn;
    mysqli_query($conn, "DELETE FROM berita WHERE id = $id");
    return mysqli_affected_rows($conn);
}

function ubah($data) {
    global $conn;
    $id = $data["id"];
    $nama =htmlspecialchars($data["nama"]) ;
    $gambarLama = htmlspecialchars($data["gambarLama"]) ;

    //cek apakah user pilih gambar baru atau tidak
    if($_FILES['gambar']['error'] === 4) {
        $gambar = $gambarLama;
    } else {
        $gambar = upload();
    }

    $gambar = htmlspecialchars($data["gambar"]);

    $query = "UPDATE galeri SET
                nama = '$nama',
                gambar = '$gambar'
                WHERE id = $id
                ";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}
function uvah($data) {
    global $conn;
    $id = $data["id"];
    $kategori = htmlspecialchars($data["kategori"]);
    $judul = htmlspecialchars($data["judul"]);
    $tanggal = htmlspecialchars($data["tanggal"]);
    $deskripsi = htmlspecialchars($data["deskripsi"]);
    $isi = htmlspecialchars($data["isi_berita"]);
    $gambarLama = htmlspecialchars($data["gambarLama"]);

    // cek apakah user pilih gambar baru atau tidak
    if ($_FILES['gambar']['error'] === 4) {
        $gambar = $gambarLama;
    } else {
        $gambar = upload();
    }

    $query = "UPDATE berita SET
                kategori = '$kategori',
                judul = '$judul',
                tanggal = '$tanggal',
                deskripsi = '$deskripsi',
                isi_berita = '$isi',
                gambar = '$gambar'
              WHERE id = $id";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}


function cari($keyword) {
    $query = "SELECT * FROM galeri 
            WHERE
            nama LIKE '%$keyword%'
            ";
     return query($query);
}
function cary($keyword) {
    $query = "SELECT * FROM berita 
            WHERE
            judul LIKE '%$keyword%'
            ";
     return query($query);
}

function registrasi($data) {
    global $conn;

    $username = strtolower(stripslashes($data["username"]));
    $email = $data["email"];
    $password = mysqli_real_escape_string($conn, $data["password"]);

    //cek username udah ada tau belum
    $result = mysqli_query($conn, "SELECT username FROM user WHERE username = '$username'");

    if(mysqli_fetch_assoc($result)) {
        echo "<script>
        alert('username sudah terdaftar');
        </script>";

        return false;
    }

    //enkripsi password
    $password = password_hash($password, PASSWORD_DEFAULT);

    //tambahkan user baru ke database
    mysqli_query($conn, "INSERT INTO user VALUES (NULL, '$username', '$email', '$password')");

    return mysqli_affected_rows($conn);

}
?>