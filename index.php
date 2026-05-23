<?php
$conn = mysqli_connect("localhost", "root", "", "db_undangan") or die("Koneksi gagal");
$success = false;

if (isset($_POST['submit'])) {
    $nama      = mysqli_real_escape_string($conn, $_POST['nama']);
    $kehadiran = mysqli_real_escape_string($conn, $_POST['kehadiran']);
    
    // Mengambil nilai sesi pilihan tamu (misal: "Sesi Akad (08:00 - 10:00 WIB)")
    $sesi_tamu = mysqli_real_escape_string($conn, $_POST['waktu']); 
    
    // Murni hanya mengambil ucapan/doa dari user tanpa digabung teks sesi
    $pesan_user = mysqli_real_escape_string($conn, $_POST['pesan']);
    
    // MEMASUKKAN DATA: Sesi dimasukkan ke kolom 'waktu', Ucapan dimasukkan ke kolom 'pesan'
    $query = "INSERT INTO data_tamu (nama, kehadiran, waktu, pesan) VALUES ('$nama', '$kehadiran', '$sesi_tamu', '$pesan_user')";
    if (mysqli_query($conn, $query)) {
        $success = true;
    }
}
$buka = isset($_GET['buka']);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Undangan Pernikahan Dinda & Rizky</title>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,600;1,400&family=Montserrat:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
    <style>
        :root {
            --primary: #4a5d4e; 
            --gold: #c5a880; 
            --dark: #2c332e;
            --glass: rgba(255, 255, 255, 0.65);
        }
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: 'Montserrat', sans-serif; 
            color: var(--dark);
            background: url('https://images.unsplash.com/photo-1523438885200-e635ba2c371e?q=80&w=1920') center/cover fixed;
            min-height: 100vh; 
            display: flex; 
            align-items: center; 
            justify-content: center; 
            padding: 20px 15px;
        }
        body::before { 
            content: ''; 
            position: fixed; 
            inset: 0; 
            background: rgba(245, 242, 237, 0.35); 
            z-index: 1; 
        }
        
        .main-card { 
            background: var(--glass); 
            backdrop-filter: blur(20px); 
            -webkit-backdrop-filter: blur(20px);
            width: 100%; 
            max-width: 500px; 
            border-radius: 30px; 
            padding: 40px 20px; 
            text-align: center;
            box-shadow: 0 30px 60px rgba(74, 93, 78, 0.15); 
            border: 1px solid rgba(255, 255, 255, 0.7); 
            position: relative; 
            z-index: 2;
        }
        .guest-box, .events-section, .rsvp-form-container { 
            background: rgba(255, 255, 255, 0.4); 
            border: 1px solid rgba(255,255,255,0.4); 
            border-radius: 20px; 
            padding: 20px; 
            margin: 30px 0; 
            backdrop-filter: blur(5px); 
        }

        h1, h2, h4, .couple-name, .couple-ampersand { font-family: 'Playfair Display', serif; color: var(--primary); }
        h1 { font-size: 2.8rem; } 
        h2 { font-size: 1.6rem; }
        .cover-date, .wedding-subtitle { font-size: 0.8rem; letter-spacing: 2px; text-transform: uppercase; color: var(--gold); margin: 10px 0 30px; }
        .quote-text { font-size: 0.75rem; line-height: 1.6; color: #5a625c; font-style: italic; margin-bottom: 30px; }
        
        .btn { display: inline-flex; align-items: center; gap: 6px; background: var(--primary); color: #fff; padding: 12px 35px; border-radius: 50px; text-transform: uppercase; letter-spacing: 1px; font-size: 0.75rem; text-decoration: none; border: none; cursor: pointer; transition: 0.3s; }
        .btn:hover { background: #39483c; transform: translateY(-2px); }
        
        .single-arch-photo { width: 100%; max-width: 250px; height: 320px; object-fit: cover; border-radius: 125px 125px 20px 20px; border: 4px solid #fff; box-shadow: 0 10px 25px rgba(0,0,0,0.05); margin: 0 auto 30px; }
        .grid-2 { display: grid; grid-template-columns: 1fr 1fr; gap: 15px; }
        .couple-row { display: grid; grid-template-columns: 1fr auto 1fr; align-items: start; margin-bottom: 30px; }
        .couple-name { font-size: 1.2rem; font-weight: 600; }
        .couple-parents { font-size: 0.7rem; color: #5a625c; margin-top: 5px; }
        .couple-ampersand { font-size: 1.5rem; font-style: italic; color: var(--gold); }
        
        .event-item:first-child { border-right: 1px solid rgba(74, 93, 78, 0.15); }
        .event-item p { font-size: 0.7rem; line-height: 1.4; margin-top: 5px; }
        
        .rsvp-form-container { text-align: left; }
        .form-label { display: block; font-size: 0.65rem; font-weight: 600; text-transform: uppercase; color: #5a625c; margin-bottom: 4px; }
        .input-field { width: 100%; padding: 10px; background: rgba(255,255,255,0.6); border: 1px solid rgba(255,255,255,0.5); border-radius: 8px; font-family: inherit; font-size: 0.8rem; margin-bottom: 12px; }
        .input-field:focus { outline: none; border-color: var(--primary); background: #fff; }
        
        .music-btn { position: fixed; bottom: 25px; right: 25px; width: 45px; height: 45px; background: var(--primary); color: #fff; border-radius: 50%; display: flex; align-items: center; justify-content: center; cursor: pointer; z-index: 9999; box-shadow: 0 4px 12px rgba(0,0,0,0.15); }
        .rotate-music { animation: spin 4s linear infinite; }
        @keyframes spin { 100% { transform: rotate(360deg); } }
    </style>
</head>
<body>

    <audio id="weddingMusic" loop><source src="mus.mp3" type="audio/mpeg"></audio>
    <div id="musicToggle" class="music-btn"><i class='bx bx-volume-mute' id="musicIcon"></i></div>

    <div class="main-card">
        <?php if (!$buka): ?>
            <div class="cover-wrapper">
                <h1>Dinda & Rizky</h1>
                <div class="cover-date">12 . 09 . 2026</div>
                <div class="guest-box">
                    <span class="form-label">Kepada Yth:</span>
                    <h3 style="font-family: 'Playfair Display'; font-size: 1.4rem;"><?= isset($_GET['to']) ? htmlspecialchars($_GET['to']) : 'Tamu Undangan'; ?></h3>
                </div>
                <a href="?buka=true<?= isset($_GET['to']) ? '&to=' . urlencode($_GET['to']) : ''; ?>" class="btn" id="btnBukaUndangan">Buka Undangan</a>
            </div>
        <?php else: ?>
            <div class="content-container">
                <h2>The Wedding Of</h2>
                <div class="wedding-subtitle">Maha Suci Allah SWT yang telah mempersatukan kita</div>
                <div class="quote-text">"Dan di antara tanda-tanda kebesaran-Nya ialah Dia menciptakan pasangan-pasangan untukmu..." <b>(QS. Ar-Rum: 21)</b></div>
                
                <img src="ftommpelai.jpg" class="single-arch-photo">

                <div class="couple-row">
                    <div>
                        <div class="couple-name">Dinda Kirana, S.T.</div>
                        <div class="couple-parents">Putri dari Bpk. Ahmad & Ibu Siti</div>
                    </div>
                    <div class="couple-ampersand">&</div>
                    <div>
                        <div class="couple-name">Rizky Pratama, M.B.A.</div>
                        <div class="couple-parents">Putra dari Bpk. Hasan & Ibu Rina</div>
                    </div>
                </div>

                <div class="events-section">
                    <div class="grid-2" style="margin-bottom: 15px;">
                        <div class="event-item"><h4>Akad Nikah</h4><p>08:00 - 10:00 WIB<br><b>Hotel Mulia</b><br>Jakarta</p></div>
                        <div class="event-item"><h4>Resepsi</h4><p>11:00 - Selesai<br><b>Hotel Mulia</b><br>Jakarta</p></div>
                    </div>
                    <a href="https://www.google.com/maps?q=Hotel+Mulia+Senayan" target="_blank" class="btn" style="padding: 8px 20px;"><i class='bx bx-map-alt'></i> Google Maps</a>
                </div>

                <div class="rsvp-form-container">
                    <?php if ($success): ?>
                        <p style="color: var(--primary); font-size: 0.75rem; text-align:center; margin-bottom:10px; font-weight:600;">Terima kasih, konfirmasi Anda telah terkirim!</p>
                    <?php endif; ?>
                    <form method="POST">
                        <label class="form-label">Nama Lengkap</label>
                        <input type="text" name="nama" class="input-field" required placeholder="Nama Anda">
                        
                        <div class="grid-2">
                            <div>
                                <label class="form-label">Kehadiran</label>
                                <select name="kehadiran" class="input-field" required>
                                    <option value="">Pilih--</option>
                                    <option value="Insyaallah Hadir">Insyaallah Hadir</option>
                                    <option value="Maaf, Tidak Bisa Hadir">Maaf, Tidak Bisa Hadir</option>
                                </select>
                            </div>
                            <div>
                                <label class="form-label">Sesi Kedatangan</label>
                               <select name="waktu" class="input-field">
                                    <option value="">Pilih Sesi--</option>
                                    <option value="Sesi 1 (08:00 - 10:00 WIB)">Sesi 1 (08:00 - 10:00 WIB)</option>
                                    <option value="Sesi 2 (11:00 - Selesai)">Sesi 2 (11:00 - Selesai)</option>
                                </select>
                            </div>
                        </div>
                        
                        <label class="form-label">Ucapan / Doa</label>
                        <textarea name="pesan" class="input-field" rows="2" placeholder="Tulis doa restu Anda..."></textarea>
                        
                        <button type="submit" name="submit" class="btn" style="width:100%; justify-content:center;">Kirim Konfirmasi</button>
                    </form>
                </div>
                <div style="margin-top: 30px; font-size: 0.65rem; letter-spacing: 2px; color: #5a625c;">DINDA & RIZKY — © 2026</div>
            </div>
        <?php endif; ?>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const music = document.getElementById("weddingMusic"), musicBtn = document.getElementById("musicToggle"), musicIcon = document.getElementById("musicIcon");
            function playMusic() { music.play().then(() => { musicIcon.className = "bx bx-music"; musicBtn.classList.add("rotate-music"); }).catch(() => {}); }
            function pauseMusic() { music.pause(); musicIcon.className = "bx bx-volume-mute"; musicBtn.classList.remove("rotate-music"); }
            
            if (document.getElementById("btnBukaUndangan")) {
                document.getElementById("btnBukaUndangan").addEventListener("click", () => localStorage.setItem("musicPlaying", "true"));
            }
            if (window.location.search.includes("buka=true") && localStorage.getItem("musicPlaying") === "true") {
                playMusic();
                document.body.addEventListener('click', () => { if (music.paused) playMusic(); }, { once: true });
            }
            musicBtn.addEventListener("click", (e) => { e.stopPropagation(); music.paused ? (playMusic(), localStorage.setItem("musicPlaying", "true")) : (pauseMusic(), localStorage.setItem("musicPlaying", "false")); });
        });
    </script>
</body>
</html>