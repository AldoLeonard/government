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
        header("Location: tambah.php"); 
        exit;
    }

    $query = "INSERT INTO galeri VALUES(null, '$nama', '$gambar')";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}


function upload($required = true)
{
    if (session_status() === PHP_SESSION_NONE) session_start();

    $namaFile = $_FILES['gambar']['name'];
    $ukuranFile = $_FILES['gambar']['size'];
    $error = $_FILES['gambar']['error'];
    $tmpName = $_FILES['gambar']['tmp_name'];

    if ($error === 4) {
        if ($required) {
            $_SESSION['upload_error'] = 'Pilih gambar terlebih dahulu.';
        }
        return false;
    }

    $ekstensiGambarValid = ['jpg', 'jpeg', 'png'];
    $ekstensiGambar = strtolower(pathinfo($namaFile, PATHINFO_EXTENSION));
    if (!in_array($ekstensiGambar, $ekstensiGambarValid)) {
        $_SESSION['upload_error'] = 'File harus berupa gambar (jpg/jpeg/png).';
        return false;
    }

    if ($ukuranFile > 5000000) {
        $_SESSION['upload_error'] = 'Ukuran gambar terlalu besar. Maksimal 5MB.';
        return false;
    }

    $namaFileBaru = uniqid() . '.' . $ekstensiGambar;
    move_uploaded_file($tmpName, 'images/' . $namaFileBaru);
    return $namaFileBaru;
}

function hapus($id)
{
    global $conn;
    mysqli_query($conn, "DELETE FROM galeri WHERE id = $id");
    return mysqli_affected_rows($conn);
}

function ubah($data, $files)
{
    global $conn;
    if (session_status() === PHP_SESSION_NONE) session_start();

    $id = $data["id"];
    $nama = htmlspecialchars($data["nama"]);
    $gambarLama = htmlspecialchars($data["gambarLama"]);

    //cek apakah user pilih gambar baru atau tidak
    if ($files['gambar']['error'] === 4) {
        $gambar = $gambarLama;
    } else {
        $gambar = upload(false); // tidak wajib
        if (!$gambar) {
            // Jangan timpa pesan upload_error dari upload()!
            header("Location: ubah.php?id=" . $id);
            exit;
        }

        // Hapus gambar lama
        if (file_exists("images/" . $gambarLama) && $gambarLama != ".jpg") {
            unlink("images/" . $gambarLama);
        }
    }

    $query = "UPDATE galeri SET
                nama = '$nama',
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
