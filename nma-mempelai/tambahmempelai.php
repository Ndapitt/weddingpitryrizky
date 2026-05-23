<?php
include '../connect.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Data Mempelai</title>
</head>
<body>
    <h1>Tambah Data</h1>
    <form method="post">
        Nama: 
        <input type="text" name="nama" value="<?= isset($_POST['nama']) ? htmlspecialchars($_POST['nama']) : ''; ?>"><br><br>

        Status: 
        <select name="keterangan">
            <option value="">-- Pilih Status --</option>
            <option value="mempelai wanita" <?= (isset($_POST['keterangan']) && $_POST['keterangan'] == 'mempelai wanita') ? 'selected' : ''; ?>>Mempelai Wanita</option>
            <option value="mempelai pria" <?= (isset($_POST['keterangan']) && $_POST['keterangan'] == 'mempelai pria') ? 'selected' : ''; ?>>Mempelai Pria</option>
            <option value="orang tua mempelai wanita" <?= (isset($_POST['keterangan']) && $_POST['keterangan'] == 'orang tua mempelai wanita') ? 'selected' : ''; ?>>Orang Tua Mempelai Wanita</option>
            <option value="orang tua mempelai pria" <?= (isset($_POST['keterangan']) && $_POST['keterangan'] == 'orang tua mempelai pria') ? 'selected' : ''; ?>>Orang Tua Mempelai Pria</option>
        </select>
        <br><br>

        <button type="submit" name="simpan">Simpan</button>
    </form>    
</body>
</html>

<?php 
if(isset($_POST['simpan'])){
    $nama = mysqli_real_escape_string($conn, $_POST['nama']);
    $keterangan = mysqli_real_escape_string($conn, $_POST['keterangan']);

    mysqli_query($conn, "INSERT INTO data_mempelai (nama, keterangan) VALUES ('$nama', '$keterangan')");
    
    header("location: indexmempelai.php");
}
?>