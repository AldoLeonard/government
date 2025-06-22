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

function tambahb($data)
{
    global $conn;
    $kategori = htmlspecialchars($data["kategori"]);
    $judul = htmlspecialchars($data["judul"]);
    $tanggal = htmlspecialchars($data["tanggal"]);
    $deskripsi = htmlspecialchars($data["deskripsi"]);
    $isi = htmlspecialchars($data["isi_berita"]);
    //upload gambar
    $gambar = upload();
    if (!$gambar) {
        return false;
    }

    $query = "INSERT INTO berita VALUES(null, '$kategori', '$judul', '$tanggal', '$deskripsi', '$isi', '$gambar', null)";
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


function hafus($id)
{
    global $conn;
    mysqli_query($conn, "DELETE FROM berita WHERE id = $id");
    return mysqli_affected_rows($conn);
}

function uvah($data, $files)
{
    global $conn;
    $id = $data["id"];
    $kategori = htmlspecialchars($data["kategori"]);
    $judul = htmlspecialchars($data["judul"]);
    $tanggal = htmlspecialchars($data["tanggal"]);
    $deskripsi = htmlspecialchars($data["deskripsi"]);
    $isi = htmlspecialchars($data["isi_berita"]);
    $gambarLama = htmlspecialchars($data["gambarLama"]);

    // cek apakah user upload gambar baru
    if ($files['gambar']['error'] === 4) {
        $gambar = $gambarLama;
    } else {
        $gambar = upload();
        if (!$gambar) {
            return false; // Gagal upload
        }
        // Hapus gambar lama
        if (file_exists("images/" . $gambarLama) && $gambarLama != ".jpg") {
            unlink("images/" . $gambarLama);
        }
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


function cary($keyword)
{
    $query = "SELECT * FROM berita 
            WHERE
            judul LIKE '%$keyword%'
            ";
    return query($query);
}

