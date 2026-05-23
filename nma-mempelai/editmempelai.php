<?php
include '../connect.php';
$id = $_GET['id'];

// Ambil data mempelai berdasarkan id
$data = mysqli_query($conn, "SELECT * FROM data_mempelai WHERE id='$id'");
$item = mysqli_fetch_assoc($data);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data Mempelai</title>
</head>
<body>
    <h1>Ubah Data</h1>
    <form method="post">
        Nama: 
        <input type="text" name="nama" value="<?= htmlspecialchars($item['nama']); ?>"><br><br>

        Status: 
        <select name="keterangan">
            <option value="">-- Pilih Status --</option>
            <option value="mempelai wanita" <?= $item['keterangan'] == 'mempelai wanita' ? 'selected' : ''; ?>>Mempelai Wanita</option>
            <option value="mempelai pria" <?= $item['keterangan'] == 'mempelai pria' ? 'selected' : ''; ?>>Mempelai Pria</option>
            <option value="orang tua mempelai wanita" <?= $item['keterangan'] == 'orang tua mempelai wanita' ? 'selected' : ''; ?>>Orang Tua Mempelai Wanita</option>
            <option value="orang tua mempelai pria" <?= $item['keterangan'] == 'orang tua mempelai pria' ? 'selected' : ''; ?>>Orang Tua Mempelai Pria</option>
        </select>
        <br><br>

        <button type="submit" name="update">Update</button>
    </form>    
</body>
</html>

<?php
if(isset($_POST['update'])) {
    $nama = mysqli_real_escape_string($conn, $_POST['nama']);
    $keterangan = mysqli_real_escape_string($conn, $_POST['keterangan']);

    mysqli_query($conn, "UPDATE data_mempelai SET
         nama='$nama',
         keterangan='$keterangan'
         WHERE id='$id'
    ");

    header("location: indexmempelai.php");
}
?>