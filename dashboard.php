<?php
session_start();
include "connect.php";

// Pastikan user sudah login
if(!isset($_SESSION['user'])) {
    header("location: login.php");
    exit;
}

// Ambil data user dari session
$user = $_SESSION['user'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 30px;
            background-color: #f4f4f9;
        }

        h1 {
            color: #333;
            text-align: center;
        }

        p {
            text-align: center;
            font-size: 18px;
            color: #555;
        }

        .menu {
            margin-top: 30px;
            text-align: center;
        }

        .menu a {
            display: inline-block;
            text-decoration: none;
            background-color: #4CAF50;
            color: white;
            padding: 15px 25px;
            margin: 10px;
            border-radius: 5px;
            font-weight: bold;
            transition: 0.3s;
        }

        .menu a:hover {
            background-color: #45a049;
        }

        .menu a.logout {
            background-color: #f44336;
        }

        .menu a.logout:hover {
            background-color: #d32f2f;
        }
    </style>
</head>
<body>
    <h1>Selamat Datang, <?= htmlspecialchars($user['nama']); ?>!</h1>
    <p>Pilih menu di bawah untuk masuk ke data:</p>

    <div class="menu">
        <a href="data-users/datapengguna.php">Data pengguna</a>
        <a href="data-tamu/indextamu.php">data tamu</a>
        <a href="login.php" class="logout">Logout</a>
    </div>
</body>
</html>