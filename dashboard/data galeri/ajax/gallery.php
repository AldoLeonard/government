<?php
require ('../functions.php');
$keyword = $_GET["keyword"];

$query = "SELECT * FROM galeri 
            WHERE
            nama LIKE '%$keyword%'
            "; 
$galeri = query($query);

?>

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