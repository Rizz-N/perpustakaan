<?php
    session_start();
    include "../config/conn.php";
    mysqli_query($conn, "DELETE FROM kategori_buku WHERE id_kategori='$_GET[id]'");
    
    $_SESSION['success'] = "Data Berhasil Dihapus";
    header("location: index.php");
    exit;
?>