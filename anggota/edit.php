<?php
    session_start();
    
    include "../config/conn.php";
    
    $data = mysqli_fetch_assoc(mysqli_query(
    $conn,
    "SELECT * FROM anggota WHERE id_anggota ='$_GET[id]'"
    ));
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
    <!-- hero edit section -->
    <div class="d-flex justify-content-center align-items-center w-100 bg-success mt-5" style="height: 25vh;" >
        <p class="fs-3 text-light" >Edit Data Member</p>
     </div>
     <!-- form edit section -->
      <div class="m-5" >
         <form method="post">
            <div class="mb-3">
                <label>ID</label>
                <input type="text" class="form-control" value="<?= $data['id_anggota'] ?>" readonly>
            </div>
            
            <div class="mb-3">
                <label>Nama</label>
                <input type="text" name="nama"
                value="<?= $data['nama'] ?>" class="form-control" required>
            </div>
            
            <div class="mb-3">
                <label>Alamat</label>
                <input type="text" name="alamat"
                value="<?= $data['alamat'] ?>" class="form-control" required>
            </div>

            <div class="mb-3">
                <label>No Telephon</label>
                <input type="text" name="no_hp"
                value="<?= $data['no_hp'] ?>" class="form-control" required>
            </div>

            <div class="mb-3">
                <label>Email</label>
                <input type="text" name="email"
                value="<?= $data['email'] ?>" class="form-control" required>
            </div>

            <div class="mb-3">
                <label>Tanggal Lahir</label>
                <input type="date" name="tgl_lahir"
                value="<?= $data['tgl_lahir'] ?>" class="form-control" required>
            </div>
        
            <button name="update" class="btn btn-success">Update</button>
            
            <a href="index.php" class="btn btn-secondary">Kembali</a>
        </form>

        <?php
            

            if (isset($_POST['update'])) {
                mysqli_query($conn, "UPDATE anggota SET
                nama='$_POST[nama]',
                alamat='$_POST[alamat]',
                no_hp='$_POST[no_hp]',
                email='$_POST[email]',
                tgl_lahir='$_POST[tgl_lahir]'
                WHERE id_anggota='$_GET[id]'
                ");

                $_SESSION['success'] = "Data Berhasil Diupdate";

                header("location: index.php");
                exit;
            }
        ?>
      </div>
</body>
</html>