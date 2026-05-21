<?php
    include '../connect.php';
    $id = $_GET['id'];

    $data = mysqli_query($conn, "SELECT * FROM data_tamu WHERE id = '$id'");
    $item = mysqli_fetch_array($data);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Tamu</title>
    <style>
/* --- RESET & BASE STYLES --- */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: 'Plus Jakarta Sans', 'Inter', system-ui, sans-serif;
}

body {
    /* Latar belakang dinamis abu-abu keunguan halus, sama dengan halaman dashboard */
    background: radial-gradient(circle at top right, #fdf2f8, #f5f3ff, #f8fafc);
    color: #1e1b4b;
    line-height: 1.5;
    padding: 30px;
    min-height: 100vh;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
}

/* --- FORM CONTAINER --- */
form {
    background-color: #ffffff;
    width: 100%;
    max-width: 520px;
    padding: 40px;
    border-radius: 20px;
    box-shadow: 0 20px 40px -15px rgba(0, 0, 0, 0.05);
    border: 1px solid rgba(226, 232, 240, 0.8);
    margin-top: 20px;
}

/* --- JUDUL --- */
h1 {
    text-align: center;
    color: #312e81; /* Indigo pekat */
    font-size: 1.8rem;
    font-weight: 800;
    letter-spacing: -0.02em;
}

/* Menghilangkan emoji bawaan lama */
h1::before {
    display: none;
}

/* --- FORM GROUP / WRAPPER TEKS --- */
.form-group {
    margin-bottom: 20px;
}

/* LABEL INPUT */
form label {
    display: block;
    margin-bottom: 8px;
    font-weight: 700;
    font-size: 0.9rem;
    color: #4338ca; /* Indigo cerah */
}

/* --- INPUT FIELDS (Text, Time, & Textarea) --- */
form input[type="text"],
form input[type="time"],
form textarea {
    width: 100%;
    padding: 12px 16px;
    border-radius: 12px;
    border: 1px solid #e2e8f0;
    background-color: #f8fafc;
    color: #334155;
    font-size: 0.95rem;
    font-weight: 500;
    transition: all 0.2s ease;
    outline: none;
}

/* Efek Fokus pada Input Box */
form input[type="text"]:focus,
form input[type="time"]:focus,
form textarea:focus {
    border-color: #7c3aed;
    background-color: #ffffff;
    box-shadow: 0 0 0 4px rgba(124, 58, 237, 0.1);
}

/* Khusus Textarea / Kolom Pesan agar bisa di-resize vertikal saja */
form textarea {
    resize: vertical;
    min-height: 100px;
    font-family: inherit;
}

/* --- BUTTON UPDATE GRADASI --- */
form button {
    display: block;
    width: 100%;
    padding: 14px;
    margin-top: 30px;
    /* Gradasi warna mewah serasi dengan tombol edit sebelumnya */
    background: linear-gradient(135deg, #06b6d4, #3b82f6);
    color: #ffffff;
    font-size: 1rem;
    font-weight: 700;
    border: none;
    border-radius: 12px;
    cursor: pointer;
    box-shadow: 0 4px 14px rgba(59, 130, 246, 0.4);
    transition: all 0.2s ease;
}

form button:hover {
    background: linear-gradient(135deg, #0891b2, #2563eb);
    box-shadow: 0 6px 20px rgba(59, 130, 246, 0.55);
    transform: translateY(-2px);
}

/* --- TOMBOL KEMBALI (BACK LINK) --- */
.back-btn {
    display: inline-block;
    margin-top: 20px;
    text-decoration: none;
    color: #64748b;
    font-size: 0.9rem;
    font-weight: 600;
    transition: color 0.2s ease;
}

.back-btn:hover {
    color: #4f46e5;
}
    </style>
</head>
<body>

    <h1>Edit Data Tamu</h1>

    <form method="post">
        <div class="form-group">
            <label>Nama</label>
            <input type="text" name="nama" value="<?= $item['nama']; ?>" required>
        </div>

        <div class="form-group">
            <label>Kehadiran</label>
            <input type="text" name="kehadiran" value="<?= $item['kehadiran']; ?>" required>
        </div>

        <div class="form-group">
            <label>Waktu</label>
            <input type="time" name="waktu" value="<?= $item['waktu']; ?>" required>
        </div>

        <div class="form-group">
            <label>Pesan</label>
            <!-- Mengubah input type="pesan" (yang tidak valid dalam HTML) menjadi textarea agar lebih rapi menampung teks panjang -->
            <textarea name="pesan" required><?= $item['pesan']; ?></textarea>
        </div>

        <button type="submit" name="update">Update Data</button>
        
        <center>
            <a href="indextamu.php" class="back-btn">← Kembali ke Daftar</a>
        </center>
    </form>

</body>
</html>

<?php
    if(isset($_POST['update'])){
    mysqli_query($conn, "UPDATE data_tamu SET
        nama='$_POST[nama]',
        kehadiran='$_POST[kehadiran]',
        waktu='$_POST[waktu]',
        pesan='$_POST[pesan]'
        WHERE id='$id'
    ");

    header("location: indextamu.php");
}    
?>