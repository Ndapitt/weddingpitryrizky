<?php
// ===================== CONNECT & SESSION =====================
include "connect.php"; // Pastikan file connect.php benar
session_start();

// ===================== PROSES LOGIN =====================
if ($_POST) {
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    // Ambil user dari database
    $query = mysqli_query($conn, "SELECT * FROM data_pngguna WHERE email='$email'");
    $user = mysqli_fetch_assoc($query);

    if ($user) {
        // Cek password (plaintext saat ini)
        if ($password === $user['password']) {
            $_SESSION['user'] = $user;
            header("Location: data-tamu/indextamu.php");
            exit;
        } else {
            $error = "Password salah!";
        }
    } else {
        $error = "Email/Password Anda salah!";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Login - Admin Dashboard</title>
<link href="https://cdn.jsdelivr.net/npm/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
<style>
/* ===================== RESET & BASE ===================== */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: 'Plus Jakarta Sans', 'Inter', system-ui, sans-serif;
}
body {
    height: 100vh;
    display: flex;
    justify-content: center;
    align-items: center;
    background: linear-gradient(135deg, #4f46e5, #7c3aed, #f472b6);
    padding: 20px;
}

/* ===================== LOGIN CONTAINER ===================== */
.login-container {
    background-color: #ffffff;
    padding: 50px 40px;
    border-radius: 24px;
    box-shadow: 0 25px 50px -12px rgba(79, 70, 229, 0.2);
    width: 100%;
    max-width: 400px;
    text-align: center;
    position: relative;
    overflow: hidden;
    border: 1px solid rgba(226, 232, 240, 0.8);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}
.login-container:hover {
    transform: translateY(-3px);
    box-shadow: 0 35px 60px -15px rgba(79,70,229,0.25);
}

/* ===================== TITLE ===================== */
.login-container h1 {
    margin-bottom: 35px;
    font-size: 2rem;
    font-weight: 800;
    letter-spacing: -0.03em;
    background: linear-gradient(135deg, #4f46e5, #db2777);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
}

/* ===================== FORM INPUT ===================== */
.login-form input {
    width: 100%;
    padding: 14px 18px;
    margin-bottom: 20px;
    border: 1px solid #e2e8f0;
    border-radius: 14px;
    font-size: 0.95rem;
    font-weight: 500;
    background-color: #f8fafc;
    color: #334155;
    transition: all 0.25s ease;
    outline: none;
}
.login-form input:focus {
    border-color: #7c3aed;
    background-color: #ffffff;
    box-shadow: 0 0 0 5px rgba(124, 58, 237, 0.2);
}

/* ===================== BUTTON ===================== */
.login-form button {
    width: 100%;
    padding: 15px;
    background: linear-gradient(135deg, #4f46e5, #7c3aed, #db2777);
    color: #fff;
    font-size: 1rem;
    font-weight: 700;
    border: none;
    border-radius: 14px;
    cursor: pointer;
    box-shadow: 0 4px 14px rgba(124, 58, 237, 0.35);
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
}
.login-form button:hover {
    box-shadow: 0 6px 25px rgba(124, 58, 237, 0.45);
    transform: translateY(-2px) scale(1.02);
    opacity: 0.95;
}

/* ===================== ERROR MESSAGE ===================== */
.error {
    color: #dc2626;
    margin-top: 18px;
    font-size: 0.9rem;
    font-weight: 700;
    background-color: #fef2f2;
    padding: 12px;
    border-radius: 10px;
    border: 1px solid #fee2e2;
    transition: all 0.3s ease;
}

/* ===================== PLACEHOLDER ===================== */
::placeholder {
    color: #94a3b8;
    font-weight: 400;
}
</style>
</head>
<body>
<div class="login-container">
    <h1>LOGIN</h1>
    <form method="POST" class="login-form">
        <input type="email" name="email" placeholder="Masukkan Email Anda" required>
        <input type="password" name="password" placeholder="Masukkan Password Anda" required>
        <button type="submit"><i class='bx bx-log-in'></i> Masuk Aplikasi</button>
    </form>

    <?php if(isset($error)) { ?>
        <p class="error"><?= $error ?></p>
    <?php } ?>
</div>
</body>
</html>