<?php
    include '../connect.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>update user</title>
    <style>
        <style>
/* Reset dasar */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: Arial, sans-serif;
}

/* BODY */
body {
    background-color: #f4f4f9;
    color: #333;
    line-height: 1.6;
    padding: 20px;
}

/* FORM CONTAINER */
form {
    background-color: #fff;
    max-width: 500px;
    margin: 50px auto;
    padding: 30px;
    border-radius: 10px;
    box-shadow: 0 4px 12px rgba(0,0,0,0.1);
}

/* JUDUL */
h1 {
    text-align: center;
    color: #6c5ce7;
    margin-bottom: 25px;
}

h1::before {
    content: "➕ "; /* Emoji tambah */
}

/* LABEL */
form label {
    display: block;
    margin-top: 15px;
    font-weight: bold;
    color: #333;
}

/* INPUT FIELD */
form input[type="text"],
form input[type="email"],
form input[type="password"] {
    width: 100%;
    padding: 10px;
    margin-top: 5px;
    border-radius: 5px;
    border: 1px solid #ccc;
    transition: 0.3s;
}

form input[type="text"]:focus,
form input[type="email"]:focus,
form input[type="password"]:focus {
    border-color: #6c5ce7;
    outline: none;
}

/* BUTTON SIMPAN */
form button {
    display: block;
    width: 100%;
    padding: 12px;
    margin-top: 25px;
    background-color: #6c5ce7;
    color: #fff;
    font-size: 1rem;
    font-weight: bold;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    transition: 0.3s;
}

form button:hover {
    background-color: #341f97;
}

/* LINK KEMBALI */
.back-link {
    display: block;
    text-align: center;
    margin-top: 20px;
    text-decoration: none;
    color: #6c5ce7;
    font-weight: bold;
    transition: 0.3s;
}

.back-link:hover {
    color: #341f97;
}
</style>
    </style>
</head>
<body>
    <h1>Tambah Data User</h1>
    <form method="post">
        Nama: <input type="text" name="nama"><br><br>
        Email: <input type="email" name="email"><br><br>
        Password: <input type="password" name="password"><br><br>

        <button type="submit" name="simpan">Simpan</button>
    </form>
</body>
</html>

<?php
if(isset($_POST['simpan'])) {
    mysqli_query($conn, "INSERT INTO data_pngguna (nama, email, `password`) VALUES(
    '$_POST[nama]',
    '$_POST[email]',
    '$_POST[password]'
    )");

    header("location: datapengguna.php");
}
?>