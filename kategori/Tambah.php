<?php 
    session_start();
    include "../config/conn.php"
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include "../config/style.php" ?>
    <title>Document</title>
</head>
<body>
    <?php include "../component/navbar.php" ?>
    <!-- hero increase section -->
    <div class="d-flex justify-content-center align-items-center w-100 bg-success mt-5" style="height: 25vh;" >
        <p class="fs-3 text-light" >Tambah Data Kategori Buku</p>
     </div>
     <!-- increase form -->
      <div class="m-5" >
        <form method="post">
            <div class="mb-3" >
                <label class="form-label">Nama Kategori</label>
                <input name="kategori" type="text" class="form-control mb-2" placeholder="kategori buku" required>
            </div>
            
        <button name="simpan" class="btn btn-success">Simpan</button>
        <a href="index.php" class="btn btn-secondary">Kembali</a>
        </form>
        <?php
            if(isset($_POST['simpan'])){
                mysqli_query($conn,"INSERT INTO kategori_buku (kategori) VALUES(
                '$_POST[kategori]'
                )");

                 $_SESSION['success'] = "Data Berhasil Ditambah";

                header("location: index.php");
                exit;
            }
        ?>
      </div>
</body>
</html>