<?php
    session_start();
    include "../config/conn.php";
    mysqli_query($conn, "DELETE FROM pemimjaman WHERE id_pinjam='$_GET[id]'");
    
    $_SESSION['success'] = "Data Berhasil Dihapus";
    header("location: index.php");
    exit;
?>