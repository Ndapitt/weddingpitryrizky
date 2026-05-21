<?php
    include '../connect.php';
    $id = $_GET['id'];

    mysqli_query($conn, "DELETE FROM data_pngguna WHERE id='$id'");

    header("location: datapengguna.php");
?>