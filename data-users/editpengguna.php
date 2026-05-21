<?php
    include '../connect.php';
    $id = $_GET['id'];

    $data = mysqli_query($conn, "SELECT * FROM data_pngguna WHERE id = '$id'");
    $item = mysqli_fetch_array($data);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update User</title>
    <style>
/* --- RESET & BASE STYLES --- */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: 'Plus Jakarta Sans', 'Inter', system-ui, sans-serif;
}

body {
    /* Latar belakang dinamis abu-abu keunguan halus yang konsisten */
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
    max-width: 500px;
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

/* Menghapus emoji bawaan lama */
h1::before {
    display: none;
}

/* --- FORM GROUP --- */
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

/* --- INPUT FIELDS (Text & Password) --- */
form input[type="text"],
form input[type="password"] {
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

/* Efek Fokus Glow pada Input Box */
form input[type="text"]:focus,
form input[type="password"]:focus {
    border-color: #7c3aed;
    background-color: #ffffff;
    box-shadow: 0 0 0 4px rgba(124, 58, 237, 0.1);
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

    <h1>Edit Data User</h1>

    <form method="post">
        <div class="form-group">
            <label>Nama</label>
            <input type="text" name="nama" value="<?= $item['nama']; ?>" required>
        </div>

        <div class="form-group">
            <label>Email</label>
            <input type="text" name="email" value="<?= $item['email']; ?>" required>
        </div>

        <div class="form-group">
            <label>Password</label>
            <input type="password" name="password" value="<?= $item['password']; ?>" required>
        </div>

        <button type="submit" name="update">Update User</button>
        
        <center>
            <a href="datapengguna.php" class="back-btn">← Kembali ke Daftar</a>
        </center>
    </form>

</body>
</html>

<?php
    if(isset($_POST['update'])){
    mysqli_query($conn, "UPDATE data_pngguna SET
        nama='$_POST[nama]',
        email='$_POST[email]',
        `password`='$_POST[password]'
        WHERE id='$id'
    ");

    header("location: datapengguna.php");
}    
?>