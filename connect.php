<?php
$conn = mysqli_connect("localhost", "root","","db_undangan");
if (!$conn) {
    die("koneksi gagal: " . mysqli_connect_error());
}
?>