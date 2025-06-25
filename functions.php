<?php
$conn = mysqli_connect("localhost", "root", "", "tubes");

function query($query)
{
    global $conn;
    $result = mysqli_query($conn, $query);
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }

    return $rows;
}

function tambah($data)
{
    global $conn;
    $nama = htmlspecialchars($data["nama"]);
    //upload gambar
    $gambar = upload();
    if (!$gambar) {
        return false;
    }

    $query = "INSERT INTO galeri VALUES(null, '$nama', '$gambar')";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function tambahb($data)
{
    global $conn;
    $kategori = htmlspecialchars($data["kategori"]);
    $judul = htmlspecialchars($data["judul"]);
    $tanggal = htmlspecialchars($data["tanggal"]);
    $deskripsi = htmlspecialchars($data["deskripsi"]);
    //upload gambar
    $gambar = upload();
    if (!$gambar) {
        return false;
    }

    $query = "INSERT INTO berita VALUES(null, '$kategori', '$judul', '$tanggal', '$deskripsi', '$gambar')";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function upload()
{
    $namaFile = $_FILES['gambar']['name'];
    $ukuranFile = $_FILES['gambar']['size'];
    $error = $_FILES['gambar']['error'];
    $tmpName = $_FILES['gambar']['tmp_name'];

    //cek apakah tidak ada gambar yang diupload
    if ($error === 4) {
        return ['status' => false, 'message' => 'Pilih gambar dulu'];
    }

    //cek apakah yang diupload adalah gambar
    $ekstensiGambarValid = ['jpg', 'jpeg', 'png'];
    $ekstensiGambar = explode('.', $namaFile);
    $ekstensiGambar = strtolower(end($ekstensiGambar));
    if (!in_array($ekstensiGambar, $ekstensiGambarValid)) {
        return ['status' => false, 'message' => 'Yang anda upload bukan gambar'];
    }

    //cek jika ukurannya terlalu besar
    if ($ukuranFile > 5000000) {
        return ['status' => false, 'message' => 'Ukuran gambar terlalu besar'];
    }

   $namaFileBaru = uniqid() . '.' . $ekstensiGambar;
    move_uploaded_file($tmpName, 'images/' . $namaFileBaru);
    return ['status' => true, 'file' => $namaFileBaru];
}

function hapus($id)
{
    global $conn;
    mysqli_query($conn, "DELETE FROM galeri WHERE id = $id");
    return mysqli_affected_rows($conn);
}
function hafus($id)
{
    global $conn;
    mysqli_query($conn, "DELETE FROM berita WHERE id = $id");
    return mysqli_affected_rows($conn);
}

function ubah($data)
{
    global $conn;
    $id = $data["id"];
    $nama = htmlspecialchars($data["nama"]);
    $gambarLama = htmlspecialchars($data["gambarLama"]);

    //cek apakah user pilih gambar baru atau tidak
    if ($_FILES['gambar']['error'] === 4) {
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
function uvah($data)
{
    global $conn;
    $id = $data["id"];
    $kategori = htmlspecialchars($data["kategori"]);
    $judul = htmlspecialchars($data["judul"]);
    $tanggal = htmlspecialchars($data["tanggal"]);
    $deskripsi = htmlspecialchars($data["deskripsi"]);
    $gambarLama = htmlspecialchars($data["gambarLama"]);

    //cek apakah user pilih gambar baru atau tidak
    if ($_FILES['gambar']['error'] === 4) {
        $gambar = $gambarLama;
    } else {
        $gambar = upload();
    }

    $gambar = htmlspecialchars($data["gambar"]);

    $query = "UPDATE berita SET
                kategori = '$kategori',
                judul = '$judul',
                tanggal = '$tanggal',
                deskripsi = '$deskripsi',
                gambar = '$gambar'
                WHERE id = $id
                ";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function cari($keyword)
{
    $query = "SELECT * FROM galeri 
            WHERE
            nama LIKE '%$keyword%'
            ";
    return query($query);
}
function cary($keyword)
{
    $query = "SELECT * FROM berita 
            WHERE
            judul LIKE '%$keyword%'
            ";
    return query($query);
}

function registrasi($data)
{
    global $conn;

    $username = strtolower(stripslashes($data["username"]));
    $email = $data["email"];
    $password = mysqli_real_escape_string($conn, $data["password"]);

    // Validasi email harus @gmail.com
    if (!preg_match("/^[\w\-\.]+@gmail\.com$/", $email)) {
        $_SESSION['register_error'] = 'Email harus menggunakan @gmail.com';
        return false;
    }

    // Validasi password minimal 8 karakter
    if (strlen($password) < 8) {
        $_SESSION['register_error'] = 'Password harus minimal 8 karakter';
        return false;
    }

    // Cek username sudah ada atau belum
    $result = mysqli_query($conn, "SELECT username FROM user WHERE username = '$username'");
    if (mysqli_fetch_assoc($result)) {
        $_SESSION['register_error'] = 'Username sudah terdaftar';
        return false;
    }

    // Enkripsi password
    $password = password_hash($password, PASSWORD_DEFAULT);

    // Tambahkan user baru ke database
    mysqli_query($conn, "INSERT INTO user VALUES (NULL, '$username', '$email', '$password')");

    return mysqli_affected_rows($conn);
}

