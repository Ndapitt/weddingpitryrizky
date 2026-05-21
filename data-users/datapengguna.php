<?php
include '../connect.php';
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Data Pengguna - Admin Dashboard</title>
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

/* Ketika Navbar Aktif di HP (Slide Down) */
.navbar.active {
    max-height: 500px;
    padding: 15px 20px;
}

/* Header Mobile (Tempat Tombol Menu) */
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

/* Profil Admin */
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

/* ===================== TABLE ===================== */
.add {
    display: inline-block;
    padding: 8px 18px;
    background: #10b981;
    color: #fff;
    border-radius: 8px;
    margin-bottom: 15px;
    font-weight: 600;
    transition: all 0.2s;
}

.add:hover {
    background: #059669;
    transform: translateY(-2px);
}

.table-container {
    overflow-x: auto;
}

table {
    width: 100%;
    border-collapse: collapse;
    background: #fff;
    border-radius: 12px;
    overflow: hidden;
    box-shadow: 0 6px 20px rgba(0,0,0,0.05);
}

th, td {
    padding: 14px 16px;
    text-align: left;
}

th {
    background: #e0e7ff;
    color: #312e81;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.03em;
}

td {
    color: #4b5563;
}

tr:nth-child(even) {
    background: #f9fafb;
}

tr:hover {
    background: #f0f0ff;
    transition: 0.2s;
}

/* ===================== ACTION BUTTONS ===================== */
.actions a {
    padding: 6px 12px;
    border-radius: 6px;
    color: #fff;
    font-size: 0.85rem;
    margin-right: 5px;
    transition: all 0.2s;
}

.edit-btn {
    background: #3b82f6;
    box-shadow: 0 2px 6px rgba(59,130,246,0.3);
}

.edit-btn:hover { background: #2563eb; }

.delete-btn {
    background: #ef4444;
    box-shadow: 0 2px 6px rgba(239,68,68,0.3);
}

.delete-btn:hover { background: #dc2626; }
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
        <a href="../data-tamu/indextamu.php"><i class='bx bx-user'></i><span>Data Tamu</span></a>
        <a href="datapengguna.php" class="active"><i class='bx bx-group'></i><span>Data Pengguna</span></a>
        <a href="../login.php" class="logout"><i class='bx bx-log-out'></i><span>Logout</span></a>
    </div>
</nav>

<div class="main-content">
    <h2>Daftar Data Pengguna</h2>
    <a href="tambahpengguna.php" class="add">+ Tambah Data</a>
    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Password</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $data = mysqli_query($conn, "SELECT * FROM data_pngguna");
                while($item = mysqli_fetch_array($data)) {
                ?>
                <tr>
                    <td><?= $item['id']; ?></td>
                    <td><?= htmlspecialchars($item['nama']); ?></td>
                    <td><?= htmlspecialchars($item['email']); ?></td>
                    <td><?= htmlspecialchars($item['password']); ?></td>
                    <td class="actions">
                        <a href="editpengguna.php?id=<?= $item['id']; ?>" class="edit-btn">Edit</a>
                        <a href="hapuspengguna.php?id=<?= $item['id']; ?>" class="delete-btn" onclick="return confirm('Yakin ingin menghapus data ini?')">Hapus</a>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>

<script>
const menuBtnMobile = document.getElementById('menuBtnMobile');
const sidebar = document.getElementById('sidebar');

// Fungsi kontrol buka/tutup menu di tampilan HP
function handleToggleMobile() {
    sidebar.classList.toggle('active');
    
    const icon = menuBtnMobile.querySelector('i');
    if (sidebar.classList.contains('active')) {
        icon.className = 'bx bx-x'; // Berubah jadi ikon silang saat menu terbuka
    } else {
        icon.className = 'bx bx-menu'; // Kembali ke ikon garis tiga saat menu ditutup
    }
}

menuBtnMobile.addEventListener('click', handleToggleMobile);

// Mencegah bug layout jika user mengubah ukuran browser dari HP ke Laptop secara langsung
window.addEventListener('resize', () => {
    if (window.innerWidth >= 768) {
        sidebar.classList.remove('active');
        menuBtnMobile.querySelector('i').className = 'bx bx-menu';
    }
});
</script>

</body>
</html>