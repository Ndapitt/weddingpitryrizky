<?php
    include '../connect.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>data mempelai</title>
</head>
<body>
    <h1>Data mempelai</h1>

    <a href="tambahmempelai.php">+Tambah Data</a><br>
        <table border="1" cellpadding="10">
        <tr>
            <th>Id</th>
            <th>Nama</th>
            <th>Status</th>
            <th>aksi</th>
        </tr>

    <?php
        $data = mysqli_query($conn, "SELECT * FROM data_mempelai");
        while($item = mysqli_fetch_array($data)) {
    ?>
    <tr>
        <td><?= $item['id']; ?></td>
        <td><?= $item['nama']; ?></td>
        <td><?= $item['keterangan']; ?></td>

        <td class="actions">
             <a href="editmempelai.php?id=<?= $item['id']; ?>" class="edit-btn">Edit</a>
            <a href="hapusmempelai.php?id=<?= $item['id']; ?>" class="delete-btn">Hapus</a>
        </td>
    </tr>
    <?php
          }
        ?>
      </table>

</body>
</html>
