<?php
include '../connect.php';
$id = mysqli_real_escape_string($conn, $_GET['id']);

// Ambil data mempelai berdasarkan id
$data = mysqli_query($conn, "SELECT * FROM data_mempelai WHERE id='$id'");
$item = mysqli_fetch_assoc($data);

// PROSES UPDATE DIPINDAHKAN KE SINI (Paling Atas)
if(isset($_POST['update'])) {
    $nama = mysqli_real_escape_string($conn, $_POST['nama']);
    $keterangan = mysqli_real_escape_string($conn, $_POST['keterangan']);

    mysqli_query($conn, "UPDATE data_mempelai SET
         nama='$nama',
         keterangan='$keterangan'
         WHERE id='$id'
    ");

    // Redirect akan berfungsi normal sekarang
    header("location: indexmempelai.php");
    exit; 
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data Mempelai - Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
    
    <style>
    /* ===================== RESET & BASE ===================== */
    body {
        margin: 0;
        font-family: 'Plus Jakarta Sans', sans-serif;
        display: flex;
        flex-direction: column;
        background: #f5f5f7;
        min-height: 100vh;
    }

    a { text-decoration: none; }

    /* ===================== NAVBAR / SIDEBAR (MOBILE) ===================== */
    .navbar {
        width: 100%;
        background: #4f46e5;
        color: #fff;
        display: flex;
        flex-direction: column;
        padding: 0 20px;
        box-sizing: border-box;
        max-height: 0;
        overflow: hidden;
        transition: max-height 0.4s ease, padding 0.4s ease;
    }

    .navbar.active {
        max-height: 500px;
        padding: 15px 20px;
    }

    .mobile-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        width: 100%;
        background: #4f46e5;
        padding: 15px 20px;
        box-sizing: border-box;
        position: sticky;
        top: 0;
        z-index: 998;
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    }

    .mobile-header h4 {
        margin: 0;
        color: #fff;
        font-size: 1.1rem;
    }

    .toggle-btn {
        cursor: pointer;
        font-size: 1.8rem;
        color: #fff;
        display: block;
    }

    .profile {
        text-align: center;
        margin-bottom: 20px;
    }

    .profile img {
        width: 70px;
        height: 70px;
        border-radius: 50%;
        object-fit: cover;
        border: 3px solid #fff;
        margin-bottom: 8px;
    }

    .profile h4 {
        font-size: 1rem;
        color: #fff;
        margin: 0;
    }

    /* ===================== NAV LINKS ===================== */
    .nav-menu {
        display: flex;
        flex-direction: column;
        gap: 10px;
        width: 100%;
    }

    .nav-menu a {
        display: flex;
        align-items: center;
        gap: 10px;
        color: #fff;
        padding: 12px 15px;
        border-radius: 8px;
        transition: all 0.3s;
        font-weight: 600;
        font-size: 0.95rem;
    }

    .nav-menu a i {
        min-width: 20px;
        text-align: center;
        font-size: 1.2rem;
    }

    .nav-menu a.active, 
    .nav-menu a:hover {
        background: rgba(255,255,255,0.2);
    }

    .nav-menu a.logout {
        color: #f87171;
        margin-top: 15px;
    }

    .nav-menu a.logout:hover {
        background: rgba(248, 113, 113, 0.1);
    }

    /* ===================== MAIN CONTENT ===================== */
    .main-content {
        flex: 1;
        padding: 20px;
    }

    .main-content h2 {
        font-size: 1.6rem;
        margin-bottom: 25px;
        color: #1e1b4b;
        font-weight: 700;
    }

    /* ===================== RESPONSIVE (LAPTOP / DESKTOP) ===================== */
    @media (min-width: 768px) {
        body {
            flex-direction: row;
        }

        .mobile-header {
            display: none;
        }

        .navbar {
            width: 220px;
            height: 100vh;
            max-height: none;
            position: sticky;
            top: 0;
            padding: 20px;
            overflow: visible;
        }

        .profile {
            margin-bottom: 30px;
        }

        .profile img {
            width: 80px;
            height: 80px;
        }

        .nav-menu {
            height: 100%;
        }

        .nav-menu a.logout {
            margin-top: auto;
        }

        .main-content {
            padding: 30px;
        }

        .main-content h2 {
            font-size: 1.8rem;
        }
    }

    /* ===================== FORM STYLE ===================== */
    .form-card {
        background: #fff;
        padding: 25px;
        border-radius: 12px;
        box-shadow: 0 6px 20px rgba(0,0,0,0.05);
        max-width: 600px;
        width: 100%;
        box-sizing: border-box;
    }

    .form-group {
        margin-bottom: 20px;
    }

    .form-group label {
        display: block;
        margin-bottom: 8px;
        font-weight: 600;
        color: #374151;
        font-size: 0.95rem;
    }

    .form-control {
        width: 100%;
        padding: 10px 14px;
        border: 1px solid #d1d5db;
        border-radius: 8px;
        font-size: 0.95rem;
        color: #1f2937;
        background-color: #fff;
        box-sizing: border-box;
        transition: border-color 0.2s, box-shadow 0.2s;
    }

    .form-control:focus {
        outline: none;
        border-color: #4f46e5;
        box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.15);
    }

    select.form-control {
        cursor: pointer;
    }

    /* ===================== BUTTONS ===================== */
    .btn-group {
        display: flex;
        gap: 10px;
        margin-top: 25px;
    }

    .btn {
        padding: 10px 20px;
        border-radius: 8px;
        font-weight: 600;
        font-size: 0.95rem;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        transition: all 0.2s;
        border: none;
    }

    .btn-submit {
        background: #10b981;
        color: #fff;
        box-shadow: 0 2px 6px rgba(16,185,129,0.3);
    }

    .btn-submit:hover {
        background: #059669;
        transform: translateY(-1px);
    }

    .btn-cancel {
        background: #9ca3af;
        color: #fff;
    }

    .btn-cancel:hover {
        background: #4b5563;
        transform: translateY(-1px);
    }
    </style>
</head>
<body>

<div class="mobile-header">
    <h4>Admin Panel</h4>
    <div class="toggle-btn" id="menuBtnMobile"><i class='bx bx-menu'></i></div>
</div>

<nav class="navbar" id="sidebar">
    <div class="profile" style="margin-top: 15px;">
        <img src="pp.jpg" alt="Foto Admin">
        <h4>Admin Panel</h4>
    </div>
    
    <div class="nav-menu">
         <a href="../data-tamu/indextamu.php"><i class='bx bx-group'></i><span>Data Tamu</span></a>
         <a href="../data-users/datapengguna.php"><i class='bx bx-group'></i><span>Data Pengguna</span></a>
         <a href="indexmempelai.php" class="active"><i class='bx bx-user'></i><span>Data Mempelai</span></a>
         <a href="../login.php" class="logout"><i class='bx bx-log-out'></i><span>Logout</span></a>
    </div>
</nav>

<div class="main-content">
    <h2>Ubah Data Mempelai</h2>

    <div class="form-card">
        <form method="post">
            <div class="form-group">
                <label for="nama">Nama Mempelai / Orang Tua</label>
                <input type="text" id="nama" name="nama" class="form-control" value="<?= htmlspecialchars($item['nama']); ?>" required>
            </div>

            <div class="form-group">
                <label for="keterangan">Status Hubungan</label>
                <select id="keterangan" name="keterangan" class="form-control" required>
                    <option value="">-- Pilih Status --</option>
                    <option value="mempelai wanita" <?= $item['keterangan'] == 'mempelai wanita' ? 'selected' : ''; ?>>Mempelai Wanita</option>
                    <option value="mempelai pria" <?= $item['keterangan'] == 'mempelai pria' ? 'selected' : ''; ?>>Mempelai Pria</option>
                    <option value="orang tua mempelai wanita" <?= $item['keterangan'] == 'orang tua mempelai wanita' ? 'selected' : ''; ?>>Orang Tua Mempelai Wanita</option>
                    <option value="orang tua mempelai pria" <?= $item['keterangan'] == 'orang tua mempelai pria' ? 'selected' : ''; ?>>Orang Tua Mempelai Pria</option>
                </select>
            </div>

            <div class="btn-group">
                <button type="submit" name="update" class="btn btn-submit"><i class='bx bx-save'></i> Update</button>
                <a href="indexmempelai.php" class="btn btn-cancel"><i class='bx bx-arrow-back'></i> Batal</a>
            </div>
        </form>    
    </div>
</div>

<script>
const menuBtnMobile = document.getElementById('menuBtnMobile');
const sidebar = document.getElementById('sidebar');

function handleToggleMobile() {
    sidebar.classList.toggle('active');
    
    const icon = menuBtnMobile.querySelector('i');
    if (sidebar.classList.contains('active')) {
        icon.className = 'bx bx-x'; 
    } else {
        icon.className = 'bx bx-menu'; 
    }
}

menuBtnMobile.addEventListener('click', handleToggleMobile);

window.addEventListener('resize', () => {
    if (window.innerWidth >= 768) {
        sidebar.classList.remove('active');
        menuBtnMobile.querySelector('i').className = 'bx bx-menu';
    }
});
</script>

</body>
</html>