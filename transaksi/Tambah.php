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
        <p class="fs-3 text-light" >Tambah Data Peminjam Buku</p>
     </div>
     <!-- increase form -->
      <div class="m-5" >
        <form method="post">
            <div class="mb-3" >
                <label class="form-label">Nama Peminjam</label>
                <select name="id_anggota" class="form-control mb-3" required>
                    <option value="">-- Pilih Nama Member --</option>
                    <?php
                    $q = mysqli_query($conn,"SELECT * FROM anggota");
                    while($k=mysqli_fetch_assoc($q)){
                    echo "<option value='$k[id_anggota]'>$k[nama]</option>";
                    }
                    ?>
                </select>
            </div>

            <div class="mb-3" >
                <label class="form-label">Nama Buku</label>
                <select name="id_buku" class="form-control mb-3" required>
                    <option value="">-- Pilih Buku --</option>
                    <?php
                    $q = mysqli_query($conn,"SELECT * FROM buku");
                    while($k=mysqli_fetch_assoc($q)){
                    echo "<option value='$k[id_buku]'>$k[judul]</option>";
                    }
                    ?>
                </select>
            </div>
            
            <div class="mb-3" >
                <label class="form-label">Lama Pinjam</label>
                <input name="lama_pinjam" type="date" class="form-control mb-2" required>
            </div>
            
            <div class="mb-3" >
                <label class="form-label">Nama Kasir</label>
                <select name="id_user" class="form-control mb-3" required>
                    <option value="">-- Pilih Nama Kasir --</option>
                    <?php
                    $q = mysqli_query($conn,"SELECT * FROM user");
                    while($k=mysqli_fetch_assoc($q)){
                    echo "<option value='$k[user_id]'>$k[username]</option>";
                    }
                    ?>
                </select>
            </div>
            
        <button name="simpan" class="btn btn-success">Simpan</button>
        <a href="index.php" class="btn btn-secondary">Kembali</a>
        </form>
        <?php
            if (isset($_POST['simpan'])) {

                $lama_pinjam =  $_POST['lama_pinjam'];
                $id_anggota = (int) $_POST['id_anggota'];
                $id_user = (int) $_POST['id_user'];
                $id_buku = (int) $_POST['id_buku'];

                try {

                    // Memulai transaksi database
                    mysqli_begin_transaction($conn);

                    // 1. INSERT KE TABEL PEMIMJAMAN
                    $query1 = mysqli_prepare($conn, "
                        INSERT INTO pemimjaman
                        (lama_pinjam, id_anggota, id_user)
                        VALUES (?, ?, ?)
                    ");

                    mysqli_stmt_bind_param(
                        $query1,
                        "sii",
                        $lama_pinjam,
                        $id_anggota,
                        $id_user
                    );

                    mysqli_stmt_execute($query1);

                    // 2. AMBIL ID PEMINJAMAN YANG BARU DIBUAT
                    $id_pinjam = mysqli_insert_id($conn);

                    // 3. INSERT KE TABEL DETAIL_PINJAM
                    $query2 = mysqli_prepare($conn, "
                        INSERT INTO detail_pinjam
                        (id_pinjam, id_buku)
                        VALUES (?, ?)
                    ");

                    mysqli_stmt_bind_param(
                        $query2,
                        "ii",
                        $id_pinjam,
                        $id_buku
                    );

                    mysqli_stmt_execute($query2);

                    // 4. SIMPAN KEDUA INSERT
                    mysqli_commit($conn);

                    $_SESSION['success'] = "Data Berhasil Ditambah";

                    header("Location: index.php");
                    exit;

                } catch (Throwable $e) {

                    // Batalkan kedua INSERT jika terjadi error
                    mysqli_rollback($conn);

                    die("Gagal menyimpan data: " . $e->getMessage());
                }
            }
        ?>
      </div>
</body>
</html>