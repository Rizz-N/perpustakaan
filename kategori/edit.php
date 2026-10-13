<?php
    session_start();
    
    include "../config/conn.php";
    
    $data = mysqli_fetch_assoc(mysqli_query(
    $conn,
    "SELECT * FROM kategori_buku WHERE id_kategori ='$_GET[id]'"
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
        <p class="fs-3 text-light" >Edit Data Kategori Buku</p>
     </div>
     <!-- form edit section -->
      <div class="m-5" >
         <form method="post">
            <div class="mb-3">
                <label>ID</label>
                <input type="text" class="form-control" value="<?= $data['id_kategori'] ?>" readonly>
            </div>
            
            <div class="mb-3">
                <label>Kategori Buku</label>
                <input type="text" name="kategori"
                value="<?= $data['kategori'] ?>" class="form-control" required>
            </div>
            
        
            <button name="update" class="btn btn-success">Update</button>
            
            <a href="index.php" class="btn btn-secondary">Kembali</a>
        </form>

        <?php
            

            if (isset($_POST['update'])) {
                mysqli_query($conn, "UPDATE kategori_buku SET
                kategori='$_POST[kategori]'
                WHERE id_kategori='$_GET[id]'
                ");

                $_SESSION['success'] = "Data Berhasil Diupdate";

                header("location: index.php");
                exit;
            }
        ?>
      </div>
</body>
</html>