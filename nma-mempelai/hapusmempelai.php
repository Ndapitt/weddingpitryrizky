<?php
   include '../connect.php';
   $id = $_GET['id'];

   mysqli_query($conn, "DELETE FROM data_mempelai WHERE id='$id'");

   header("location: indexmempelai.php");
?>