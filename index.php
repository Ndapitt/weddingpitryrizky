<?php
$conn = mysqli_connect("localhost", "root", "", "db_undangan") or die("Koneksi gagal");
$success = false;

if(isset($_POST['submit'])){
    $nama = mysqli_real_escape_string($conn, $_POST['nama']);
    $kehadiran = mysqli_real_escape_string($conn, $_POST['kehadiran']);
    $waktu_datang = mysqli_real_escape_string($conn, $_POST['waktu_kedatangan']); 
    $pesan_user = mysqli_real_escape_string($conn, $_POST['pesan']);
    $tgl = date("Y-m-d H:i:s");
    
    // Menggabungkan info Sesi Datang ke dalam kolom pesan agar tidak merusak struktur tabel lama Anda
    $pesan_lengkap = "[Jam Datang: " . $waktu_datang . "] " . $pesan_user;
    
    // Query disesuaikan dengan struktur kolom database indextamu.php Anda
    $query = "INSERT INTO data_tamu (nama, kehadiran, waktu, pesan) VALUES ('$nama', '$kehadiran', '$tgl', '$pesan_lengkap')";
    if(mysqli_query($conn, $query)) $success = true;
}
$buka = isset($_GET['buka']);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Undangan Pernikahan Dinda & Rizky</title>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400..900;1,400..900&family=Plus+Jakarta+Sans:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
    
    <style>
        /* ===================== MODERN RESET & VARIABLES ===================== */
        :root {
            --primary: #0f766e;
            --primary-light: rgba(240, 253, 250, 0.7);
            --primary-hover: #115e59;
            --text-dark: #1e293b;
            --text-muted: #475569;
            --shadow: 0 8px 32px 0 rgba(0, 0, 0, 0.08);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            /* Gambar dekorasi bunga kering/rustik hangat */
            background-image: url('https://images.unsplash.com/photo-1515934751635-c81c6bc9a2d8?q=80&w=1920');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            color: var(--text-dark);
            overflow-x: hidden;
            line-height: 1.6;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        /* overlay gelap tipis di body agar gambar latar belakang tidak menutupi teks */
        body::before {
            content: '';
            position: fixed;
            top: 0; left: 0; right: 0; bottom: 0;
            background: rgba(255, 255, 255, 0.2);
            z-index: -1;
        }

        h1, h2, h3 {
            font-family: 'Playfair Display', serif;
            color: #0f172a;
        }

        /* ===================== KARTU UTAMA GLASSMORPHISM (TRANSPARAN) ===================== */
        .card {
            background: rgba(255, 255, 255, 0.75); /* Transparansi dasar kartu putih 75% */
            backdrop-filter: blur(14px); /* Efek blur kaca di belakangnya */
            -webkit-backdrop-filter: blur(14px); /* Dukungan browser Safari */
            width: 100%;
            max-width: 600px;
            border-radius: 30px;
            box-shadow: var(--shadow);
            overflow: hidden;
            border: 1px solid rgba(255, 255, 255, 0.5); /* Kilauan garis tepi kaca */
        }

        /* ===================== FLOATING MUSIC BUTTON ===================== */
        .music-btn {
            position: fixed;
            bottom: 25px;
            right: 25px;
            width: 50px;
            height: 50px;
            background: var(--primary);
            color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            cursor: pointer;
            z-index: 9999;
            box-shadow: 0 4px 15px rgba(15, 118, 110, 0.4);
            transition: all 0.3s ease;
        }

        .music-btn:hover {
            transform: scale(1.1);
        }

        /* Animasi berputar saat musik berbunyi */
        .rotate-music {
            animation: spin 4s linear infinite;
        }

        @keyframes spin {
            100% { transform: rotate(360deg); }
        }

        /* ===================== STYLING: SAMPUL ===================== */
        .cover-wrapper {
            padding: 80px 30px;
            text-align: center;
        }

        .cover-subtitle {
            font-size: 0.9rem;
            text-transform: uppercase;
            letter-spacing: 4px;
            color: var(--primary);
            font-weight: 700;
            margin-bottom: 15px;
        }

        .cover-title {
            font-size: 3rem;
            font-weight: 800;
            margin-bottom: 40px;
            letter-spacing: 1px;
            color: var(--primary);
        }

        .recipient-box {
            background: rgba(255, 255, 255, 0.6);
            padding: 25px;
            border-radius: 20px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.02);
            border: 1px dashed rgba(15, 118, 110, 0.3);
            margin-bottom: 40px;
            display: inline-block;
            min-width: 280px;
        }

        .recipient-box small {
            color: var(--text-muted);
            font-size: 0.85rem;
            display: block;
            margin-bottom: 5px;
        }

        .recipient-box b {
            font-size: 1.3rem;
            color: var(--text-dark);
        }

        .btn-primary {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            background: var(--primary);
            color: #ffffff;
            padding: 16px 36px;
            border-radius: 50px;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(15, 118, 110, 0.3);
        }

        .btn-primary:hover {
            background: var(--primary-hover);
            transform: translateY(-3px);
            box-shadow: 0 6px 20px rgba(15, 118, 110, 0.4);
        }

        /* ===================== STYLING: ISI UNDANGAN ===================== */
        .content-wrapper {
            padding: 50px 30px;
            text-align: center;
        }

        .main-hero-img {
            width: 100%;
            height: 300px;
            object-fit: cover;
            border-radius: 24px;
            margin: 25px 0;
            box-shadow: 0 8px 24px rgba(0,0,0,0.05);
        }

        /* Mempelai Grid */
        .mempelai-container {
            display: grid;
            grid-template-columns: 1fr auto 1fr;
            align-items: center;
            gap: 15px;
            margin: 40px 0;
        }

        .mempelai-box b {
            font-size: 1.25rem;
            color: var(--primary);
            display: block;
            margin-bottom: 4px;
        }

        .mempelai-box small {
            color: var(--text-muted);
            font-size: 0.85rem;
        }

        .ampersand {
            font-size: 2.2rem;
            color: var(--text-muted);
            font-family: 'Playfair Display', serif;
            font-style: italic;
        }

        /* Card Acara (Akad & Resepsi) */
        .section-title {
            font-size: 1.4rem;
            letter-spacing: 2px;
            margin-top: 45px;
            margin-bottom: 25px;
            position: relative;
            display: inline-block;
        }

        .section-title::after {
            content: '';
            display: block;
            width: 60px;
            height: 2px;
            background: var(--primary);
            margin: 8px auto 0 auto;
        }

        .event-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
            margin-bottom: 30px;
        }

        .event-card {
            background: rgba(240, 253, 250, 0.6); /* Transparan hijau muda 60% */
            padding: 25px 15px;
            border-radius: 20px;
            border: 1px solid rgba(15, 118, 110, 0.15);
        }

        .event-card i {
            font-size: 1.8rem;
            color: var(--primary);
            margin-bottom: 12px;
        }

        .event-card h4 {
            margin-bottom: 10px;
            color: var(--primary);
            font-size: 1.05rem;
            letter-spacing: 1px;
        }

        .event-card p {
            font-size: 0.85rem;
            color: var(--text-dark);
        }

        .map-iframe {
            width: 100%;
            height: 220px;
            border: none;
            border-radius: 20px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.02);
            margin-bottom: 20px;
        }

        /* Turut Mengundang */
        .family-box {
            background: rgba(248, 250, 252, 0.5); /* Transparan abu tipis */
            border-radius: 20px;
            padding: 25px;
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
            text-align: left;
            margin-bottom: 50px;
            border: 1px solid rgba(0,0,0,0.03);
        }

        .family-column h5 {
            color: var(--primary);
            margin-bottom: 12px;
            font-size: 0.95rem;
        }

        .family-column ul {
            list-style: none;
        }

        .family-column ul li {
            font-size: 0.85rem;
            color: var(--text-muted);
            margin-bottom: 8px;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .family-column ul li::before {
            content: '•';
            color: var(--primary);
            font-weight: bold;
        }

        /* ===================== STYLING: FORM RSVP (TRANSPARAN LEBIH TIPIS) ===================== */
        .rsvp-form {
            background: rgba(255, 255, 255, 0.5); /* Form dibuat transparan 50% agar berlapis */
            border: 1px solid rgba(15, 118, 110, 0.15);
            border-radius: 24px;
            padding: 35px 25px;
            text-align: left;
        }

        .rsvp-form h3 {
            text-align: center;
            font-size: 1.3rem;
            margin-bottom: 25px;
            color: var(--primary);
            letter-spacing: 1px;
        }

        .alert-success {
            background-color: rgba(209, 250, 229, 0.9);
            color: #065f46;
            padding: 14px;
            border-radius: 12px;
            font-weight: 600;
            font-size: 0.9rem;
            text-align: center;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            border: 1px solid #a7f3d0;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            font-size: 0.85rem;
            font-weight: 600;
            margin-bottom: 6px;
            color: var(--text-dark);
        }

        .form-control {
            width: 100%;
            padding: 12px 16px;
            border: 1px solid rgba(15, 118, 110, 0.2);
            background: rgba(255, 255, 255, 0.7); /* Input field juga semi transparan */
            border-radius: 12px;
            font-family: inherit;
            font-size: 0.9rem;
            color: var(--text-dark);
            transition: all 0.3s;
        }

        .form-control:focus {
            outline: none;
            background: #ffffff;
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(15, 118, 110, 0.15);
        }

        button[type="submit"] {
            width: 100%;
            background: var(--primary);
            color: white;
            border: none;
            padding: 15px;
            border-radius: 12px;
            font-weight: 700;
            font-size: 0.95rem;
            cursor: pointer;
            transition: all 0.3s;
            box-shadow: 0 4px 12px rgba(15, 118, 110, 0.2);
        }

        button[type="submit"]:hover {
            background: var(--primary-hover);
            transform: translateY(-1px);
        }

        .footer-note {
            display: block;
            margin-top: 45px;
            font-size: 0.8rem;
            color: var(--primary);
            letter-spacing: 2px;
            font-weight: bold;
        }

        /* RESPONSIF LAYAR HANDPHONE */
        @media (max-width: 480px) {
            body {
                padding: 10px;
            }
            .content-wrapper {
                padding: 35px 20px;
            }
            .event-grid, .mempelai-container, .family-box {
                grid-template-columns: 1fr;
            }
            .ampersand {
                margin: 5px 0;
            }
            .cover-title {
                font-size: 2.3rem;
            }
        }
    </style>
</head>
<body>

<audio id="weddingMusic" loop>
        <source src="mus.mp3" type="audio/mpeg">
</audio>

<div id="musicToggle" class="music-btn">
    <i class='bx bx-volume-mute' id="musicIcon"></i>
</div>

<div class="card">

    <?php if (!$buka): ?>
        <div class="cover-wrapper">
            <p class="cover-subtitle">The Wedding Of</p>
            <h1 class="cover-title">Dinda & Rizky</h1>
            
            <div class="recipient-box">
                <small>Kepada Yth: </small>
                <b><?php echo isset($_GET['to']) ? htmlspecialchars($_GET['to']) : 'Tamu Undangan'; ?></b>
            </div>
            
            <br>
            <a href="?buka=true<?php echo isset($_GET['to']) ? '&to=' . urlencode($_GET['to']) : ''; ?>" class="btn-primary" id="btnBukaUndangan">
                <i class='bx bx-envelope-open'></i> Buka Undangan
            </a>
        </div>

    <?php else: ?>
        <div class="content-wrapper">
            <h2>Dinda & Rizky</h2>
            
            <img src="https://images.unsplash.com/photo-1591604466107-ec97de577aff?q=80&w=1000" alt="Foto Mempelai" class="main-hero-img">
            
            <div class="mempelai-container">
                <div class="mempelai-box">
                    <b>Dinda Kirana, S.T.</b>
                    <small>Putri Bpk. Ahmad & Ibu Siti</small>
                </div>
                <div class="ampersand">&</div>
                <div class="mempelai-box">
                    <b>Rizky Pratama, M.B.A.</b>
                    <small>Putra Bpk. Hasan & Ibu Rina</small>
                </div>
            </div>

            <h3 class="section-title">WAKTU & TEMPAT</h3>
            <div class="event-grid">
                <div class="event-card">
                    <i class='bx bx-heart-circle'></i>
                    <h4>AKAD NIKAH</h4>
                    <p>Sabtu, 12 Sept 2026<br>08:00 - 10:00 WIB<br><b>hotel mulia senayan</b></p>
                </div>
                <div class="event-card">
                    <i class='bx bx-wine'></i>
                    <h4>RESEPSI</h4>
                    <p>Sabtu, 12 Sept 2026<br>11:00 WIB - Selesai<br><b>Hotel Mulia Senayan</b></p>
                </div>
            </div>
            
            <iframe class="map-iframe" src="https://www.google.com/maps?q=Hotel+Mulia+Senayan&output=embed"></iframe>
            
            <h3 class="section-title">TURUT MENGUNDANG</h3>
            <div class="family-box">
                <div class="family-column">
                    <h5>Keluarga Wanita:</h5>
                    <ul>
                        <li>Kel. Bpk. Sastro Sudiro</li>
                        <li>Kel. Bpk. H. Moerdani</li>
                        <li>Dimas Pratama & Istri</li>
                    </ul>
                </div>
                <div class="family-column">
                    <h5>Keluarga Pria:</h5>
                    <ul>
                        <li>Kel. Prof. Dr. Soemitro</li>
                        <li>Kel. Ibu Hj. Fatimah</li>
                        <li>Bpk. Rahman Hakim & Ibu</li>
                    </ul>
                </div>
            </div>

            <div class="rsvp-form">
                <h3>RSVP & KONFIRMASI</h3>
                
                <?php if($success): ?>
                    <div class="alert-success">
                        <i class='bx bx-check-circle'></i> Konfirmasi Berhasil Dikirim!
                    </div>
                <?php endif; ?>

                <form method="POST">
                    <div class="form-group">
                        <label>Nama Lengkap</label>
                        <input type="text" name="nama" class="form-control" required placeholder="Contoh: Budi Santoso">
                    </div>

                    <div class="form-group">
                        <label>Konfirmasi Kehadiran</label>
                        <select name="kehadiran" class="form-control">
                            <option value="">--pilihan kehadiran--</option>
                            <option value="Hadir">Saya Akan Hadir</option>
                            <option value="Tidak Hadir">Berhalangan Hadir</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Rencana Jam Datang (Sesi)</label>
                        <select name="waktu_kedatangan" class="form-control">
                            <option value="">--pilihan sesi kehadiran--</option>
                            <option value="Sesi 1 (08.00-10.00)">Sesi 1 (08.00 - 10.00 WIB)</option>
                            <option value="Sesi 2 (11.00-13.00)">Sesi 2 (11.00 - 13.00 WIB)</option>
                            <option value="Sesi 3 (13.00-Selesai)">Sesi 3 (13.00 WIB - Selesai)</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Doa & Ucapan</label>
                        <textarea name="pesan" class="form-control" rows="3" placeholder="Tuliskan doa restu Anda untuk kedua mempelai..."></textarea>
                    </div>

                    <button type="submit" name="submit">KIRIM KONFIRMASI</button>
                </form>
            </div>
            
            <span class="footer-note">D&R — 2026</span>
        </div>
    <?php endif; ?>

</div>

<script>
document.addEventListener("DOMContentLoaded", function() {
    const music = document.getElementById("weddingMusic");
    const musicBtn = document.getElementById("musicToggle");
    const musicIcon = document.getElementById("musicIcon");
    const btnBuka = document.getElementById("btnBukaUndangan");

    // Fungsi menyalakan musik & animasi berputar
    function playMusic() {
        music.play();
        musicIcon.className = "bx bx-music";
        musicBtn.classList.add("rotate-music");
    }

    // Fungsi mematikan musik
    function pauseMusic() {
        music.pause();
        musicIcon.className = "bx bx-volume-mute";
        musicBtn.classList.remove("rotate-music");
    }

    // 1. JIKA DI HALAMAN UTAMA (BELUM DIKLIK BUKA): Musik menyala begitu tombol "Buka Undangan" diklik
    if (btnBuka) {
        btnBuka.addEventListener("click", function() {
            localStorage.setItem("musicPlaying", "true");
        });
    }

    // 2. JIKA DI HALAMAN ISI (SETELAH REFRESH/KIRIM FORM): Cek status localStorage agar musik tetap lanjut berputar
    if (localStorage.getItem("musicPlaying") === "true") {
        // Pemicu interaksi pertama user demi melewati proteksi kebijakan browser (autoplay block)
        document.body.addEventListener('click', function() {
            if (music.paused && !musicBtn.classList.contains('manual-paused')) {
                playMusic();
            }
        }, { once: true });
        
        // Coba putar langsung (berhasil di beberapa browser)
        music.play().then(() => {
            playMusic();
        }).catch(() => {
            console.log("Autoplay ditahan browser, menunggu ketukan layar pertama tamu.");
        });
    }

    // 3. EVENT TOMBOL PLAY/PAUSE MANUAL (Bisa diklik kapan saja)
    musicBtn.addEventListener("click", function(e) {
        e.stopPropagation();
        if (music.paused) {
            playMusic();
            musicBtn.classList.remove('manual-paused');
            localStorage.setItem("musicPlaying", "true");
        } else {
            pauseMusic();
            musicBtn.classList.add('manual-paused');
            localStorage.setItem("musicPlaying", "false");
        }
    });
});
</script>

</body>
</html>