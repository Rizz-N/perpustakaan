<?php
    session_start();
    include "../config/conn.php";
    mysqli_query($conn, "DELETE FROM anggota WHERE id_anggota='$_GET[id]'");
    
    $_SESSION['success'] = "Data Berhasil Dihapus";
    header("location: index.php");
    exit;
?>