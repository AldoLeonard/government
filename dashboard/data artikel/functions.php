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

function add($data)
{
    global $conn;
    $judul = htmlspecialchars($data["judul"]);
    $tanggal = htmlspecialchars($data["tanggal"]);
    $deskripsi = htmlspecialchars($data["deskripsi"]);
    $isi = htmlspecialchars($data["isi_artikel"]);

    $gambar = upload();
    if (!$gambar) {
        header("Location: tambah.php"); 
        exit;
    }

    $query = "INSERT INTO artikel VALUES(null, '$judul', '$tanggal', '$deskripsi', '$isi', '$gambar', 0)";
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


function delete($id)
{
    global $conn;
    mysqli_query($conn, "DELETE FROM artikel WHERE id = $id");
    return mysqli_affected_rows($conn);
}

function edit($data, $files)
{
    global $conn;
    if (session_status() === PHP_SESSION_NONE) session_start();

    $id = $data["id"];
    $judul = htmlspecialchars($data["judul"]);
    $tanggal = htmlspecialchars($data["tanggal"]);
    $deskripsi = htmlspecialchars($data["deskripsi"]);
    $isi = htmlspecialchars($data["isi_artikel"]);
    $gambarLama = htmlspecialchars($data["gambarLama"]);

    // cek apakah user upload gambar baru
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

    $query = "UPDATE artikel SET
                judul = '$judul',
                tanggal = '$tanggal',
                deskripsi = '$deskripsi',
                isi_artikel = '$isi',
                gambar = '$gambar'
              WHERE id = $id";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}



function search($keyword)
{
    $query = "SELECT * FROM artikel 
            WHERE
            judul LIKE '%$keyword%'
            ";
    return query($query);
}
