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
        <p class="fs-3 text-light" >Tambah Data Member</p>
     </div>
     <!-- increase form -->
      <div class="m-5" >
        <form method="post">
            <div class="mb-3" >
                <label class="form-label">Nama Anggota</label>
                <input name="nama" type="text" class="form-control mb-2" placeholder="Nama Anggota" required>
            </div>
            <div class="mb-3" >
                <label class="form-label">Alamat</label>
            <input name="alamat" type="text" class="form-control mb-2" placeholder="Alamat" required>
            </div>
            <div class="mb-3" >
                <label class="form-label">No Telephon</label>
            <input name="no_hp" type="text" type="number" class="form-control mb-2" placeholder="No hp">
            </div>
            <div class="mb-3" >
                <label class="form-label">Email</label>
            <input name="email" type="text" class="form-control mb-2" placeholder="Email">
            </div>
            <div class="mb-3" >
                <label class="form-label">Tanggal Lahir</label>
            <input name="tgl_lahir" type="date" class="form-control mb-2">
            </div>
            
        <button name="simpan" class="btn btn-success">Simpan</button>
        <a href="index.php" class="btn btn-secondary">Kembali</a>
        </form>
        <?php
            if(isset($_POST['simpan'])){
                mysqli_query($conn,"INSERT INTO anggota (nama, alamat, no_hp, email, tgl_lahir) VALUES(
                '$_POST[nama]',
                '$_POST[alamat]',
                '$_POST[no_hp]',
                '$_POST[email]',
                '$_POST[tgl_lahir]'
                )");

                 $_SESSION['success'] = "Data Berhasil Ditambah";

                header("location: index.php");
                exit;
            }
        ?>
      </div>
</body>
</html>