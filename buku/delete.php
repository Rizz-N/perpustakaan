<?php
    session_start();
    include "../config/conn.php";
    mysqli_query($conn, "DELETE FROM buku WHERE id_buku='$_GET[id]'");
    
    $_SESSION['success'] = "Data Berhasil Dihapus";
    header("location: index.php");
    exit;
?>