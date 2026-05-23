<?php
include '../connect.php';
$id = $_GET['id'];

// 1. PROSES UPDATE DATA (Wajib di paling atas agar fungsi header() tidak error)
if (isset($_POST['update'])) {
    $nama      = mysqli_real_escape_string($conn, $_POST['nama']);
    $kehadiran = mysqli_real_escape_string($conn, $_POST['kehadiran']);
    $sesi      = mysqli_real_escape_string($conn, $_POST['waktu']); // Menangkap nilai dropdown sesi
    $pesan     = mysqli_real_escape_string($conn, $_POST['pesan']);

    mysqli_query($conn, "UPDATE data_tamu SET
        nama='$nama',
        kehadiran='$kehadiran',
        waktu='$sesi',
        pesan='$pesan'
        WHERE id='$id'
    ");

    header("location: indextamu.php");
    exit;
}

// 2. AMBIL DATA TAMU UNTUK DITAMPILKAN DI FORM
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
    color: #312e81;
    font-size: 1.8rem;
    font-weight: 800;
    letter-spacing: -0.02em;
}

h1::before {
    display: none;
}

/* --- FORM GROUP --- */
.form-group {
    margin-bottom: 20px;
}

form label {
    display: block;
    margin-bottom: 8px;
    font-weight: 700;
    font-size: 0.9rem;
    color: #4338ca;
}

form input[type="text"],
form select,
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
    appearance: none; /* Menghilangkan style default select browser */
    -webkit-appearance: none;
}

form input[type="text"]:focus,
form select:focus,
form textarea:focus {
    border-color: #7c3aed;
    background-color: #ffffff;
    box-shadow: 0 0 0 4px rgba(124, 58, 237, 0.1);
}

form textarea {
    resize: vertical;
    min-height: 100px;
    font-family: inherit;
}

form button {
    display: block;
    width: 100%;
    padding: 14px;
    margin-top: 30px;
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
            <input type="text" name="nama" value="<?= htmlspecialchars($item['nama'] ?? ''); ?>" required>
        </div>

        <div class="form-group">
            <label>Kehadiran</label>
            <input type="text" name="kehadiran" value="<?= htmlspecialchars($item['kehadiran'] ?? ''); ?>" required>
        </div>

        <div class="form-group">
            <label>Sesi Kedatangan</label>
            <select name="waktu">
                <option value="">Pilih Sesi--</option>
                <option value="Sesi Akad (08:00 - 10:00 WIB)" <?= ($item['waktu'] == 'Sesi Akad (08:00 - 10:00 WIB)') ? 'selected' : ''; ?>>Sesi 1 (08:00 - 10:00 WIB)</option>
                <option value="Sesi Resepsi (11:00 - Selesai)" <?= ($item['waktu'] == 'Sesi Resepsi (11:00 - Selesai)') ? 'selected' : ''; ?>>Sesi 2 (11:00 - Selesai)</option>
            </select>
        </div>

        <div class="form-group">
            <label>Pesan</label>
            <textarea name="pesan" required><?= htmlspecialchars($item['pesan'] ?? ''); ?></textarea>
        </div>

        <button type="submit" name="update">Update Data</button>
        
        <center>
            <a href="indextamu.php" class="back-btn">← Kembali ke Daftar</a>
        </center>
    </form>

</body>
</html>