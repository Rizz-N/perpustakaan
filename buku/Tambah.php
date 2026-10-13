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
        <p class="fs-3 text-light" >Tambah Data Buku</p>
     </div>
     <!-- increase form -->
      <div class="m-5" >
        <form method="post">
            <div class="mb-3" >
                <label class="form-label">Judul Buku</label>
                <input name="judul" type="text" class="form-control mb-2" placeholder="Judul" required>
            </div>

            <div class="mb-3" >
                <label class="form-label">pengarang</label>
            <input name="pengarang" type="text" class="form-control mb-2" placeholder="pengarang" required>
            </div>
            
            <div class="mb-3" >
                <label class="form-label">penerbit</label>
            <input name="penerbit" type="text" type="number" class="form-control mb-2" placeholder="penerbit">
            </div>
            
            <div class="mb-3" >
                <label class="form-label">tahun diterbitkan </label>
            <input name="tahun" type="text" class="form-control mb-2" placeholder="tahun">
            </div>
            
            <div class="mb-3" >
                <label class="form-label">isbn</label>
            <input name="isbn" type="text" class="form-control mb-2" placeholder="isbn">
            </div>
            
            <div class="mb-3" >
                <label class="form-label">Jumlah Halaman</label>
            <input name="jml_halaman" type="text" class="form-control mb-2" placeholder="jumlah halaman">
            </div>
            
            <div class="mb-3" >
                <label class="form-label">kategori</label>
                <select name="id_kategori" class="form-control mb-3" required>
                    <option value="">-- Pilih Kategori --</option>
                    <?php
                    $q = mysqli_query($conn,"SELECT * FROM kategori_buku");
                    while($k=mysqli_fetch_assoc($q)){
                    echo "<option value='$k[id_kategori]'>$k[kategori]</option>";
                    }
                    ?>
                </select>
            </div>
            
        <button name="simpan" class="btn btn-success">Simpan</button>
        <a href="index.php" class="btn btn-secondary">Kembali</a>
        </form>
        <?php
            if(isset($_POST['simpan'])){
                mysqli_query($conn,"INSERT INTO buku (judul, pengarang, penerbit, tahun, isbn,  jml_halaman, id_kategori) VALUES(
                '$_POST[judul]',
                '$_POST[pengarang]',
                '$_POST[penerbit]',
                '$_POST[tahun]',
                '$_POST[isbn]',
                '$_POST[jml_halaman]',
                '$_POST[id_kategori]'
                )");

                 $_SESSION['success'] = "Data Berhasil Ditambah";

                header("location: index.php");
                exit;
            }
        ?>
      </div>
</body>
</html>