<?php
    session_start();
    
    include "../config/conn.php";
    
    $data = mysqli_fetch_assoc(mysqli_query(
    $conn,
    "SELECT * FROM buku WHERE id_buku ='$_GET[id]'"
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
        <p class="fs-3 text-light" >Edit Data Buku</p>
     </div>
     <!-- form edit section -->
      <div class="m-5" >
         <form method="post">
            <div class="mb-3">
                <label>ID</label>
                <input type="text" class="form-control" value="<?= $data['id_buku'] ?>" readonly>
            </div>
            
           <div class="mb-3">
                <label>Judul</label>
                <input type="text" name="judul"
                value="<?= $data['judul'] ?>" class="form-control" required>
            </div>
            
            <div class="mb-3">
                <label>Pengarang</label>
                <input type="text" name="pengarang"
                value="<?= $data['pengarang'] ?>" class="form-control" required>
            </div>

            <div class="mb-3">
                <label>Penerbit</label>
                <input type="text" name="penerbit"
                value="<?= $data['penerbit'] ?>" class="form-control" required>
            </div>

            <div class="mb-3">
                <label>tahun</label>
                <input type="text" name="tahun"
                value="<?= $data['tahun'] ?>" class="form-control" required>
            </div>

            <div class="mb-3">
                <label>ISBN</label>
                <input type="text" name="isbn"
                value="<?= $data['isbn'] ?>" class="form-control" required>
            </div>
            <div class="mb-3">
                <label>Jumlah Halaman</label>
                <input type="text" name="jml_halaman"
                value="<?= $data['jml_halaman'] ?>" class="form-control" required>
            </div>

            <div class="mb-3">
                <label>kategori</label>
                <select name="id_kategori" class="form-control" required>
                    <?php
                    $q = mysqli_query($conn, "SELECT * FROM kategori_buku");
                    while ($k = mysqli_fetch_assoc($q)) {
                    $selected = ($k['id_kategori'] == $data['id_kategori']) ? "selected" : "";
                    echo "<option value='$k[id_kategori]' $selected>
                    $k[kategori]
                    </option>";
                    }
                    ?>
                </select>
            </div>
        
            <button name="update" class="btn btn-success">Update</button>
            
            <a href="index.php" class="btn btn-secondary">Kembali</a>
        </form>

        <?php
            

             if (isset($_POST['update'])) {
                mysqli_query($conn, "UPDATE buku SET
                judul='$_POST[judul]',
                pengarang='$_POST[pengarang]',
                penerbit='$_POST[penerbit]',
                tahun='$_POST[tahun]',
                isbn='$_POST[isbn]',
                jml_halaman='$_POST[jml_halaman]',
                id_kategori='$_POST[id_kategori]'
                WHERE id_buku='$_GET[id]'
                ");

                $_SESSION['success'] = "Data Berhasil Diupdate";

                header("location: index.php");
                exit;
            }
        ?>
      </div>
</body>
</html>