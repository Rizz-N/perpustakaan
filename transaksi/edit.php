<?php
    session_start();
    
    include "../config/conn.php";
    
    $data = mysqli_fetch_assoc(mysqli_query(
    $conn,
    "SELECT * FROM pemimjaman WHERE id_pinjam ='$_GET[id]'"
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
        <p class="fs-3 text-light" >Edit Data Peminjam Buku</p>
     </div>
     <!-- form edit section -->
      <div class="m-5" >
         <form method="post">
            <div class="mb-3">
                <label>ID</label>
                <input type="text" class="form-control" value="<?= $data['id_pinjam'] ?>" readonly>
            </div>
            
            <div class="mb-3">
                <label>Nama</label>
                <select name="id_anggota" class="form-control" required>
                    <?php
                    $q = mysqli_query($conn, "SELECT * FROM anggota");
                    while ($k = mysqli_fetch_assoc($q)) {
                    $selected = ($k['id_anggota'] == $data['id_anggota']) ? "selected" : "";
                    echo "<option value='$k[id_anggota]' $selected>
                    $k[nama]
                    </option>";
                    }
                    ?>
                </select>
            </div>

            <div class="mb-3">
                <label>Nama Buku</label>
                <select name="id_buku" class="form-control" required>
                    <?php
                    $q = mysqli_query($conn, "SELECT * FROM buku");
                    while ($k = mysqli_fetch_assoc($q)) {
                    $selected = ($k['id_buku'] == $data['id_buku']) ? "selected" : "";
                    echo "<option value='$k[id_buku]' $selected>
                    $k[judul]
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

                $id_pinjam = (int) $_GET['id'];

                $id_anggota = (int) $_POST['id_anggota'];
                $id_buku = (int) $_POST['id_buku'];

                try {

                    // Memulai transaksi
                    mysqli_begin_transaction($conn);

                    // 1. UPDATE TABEL PEMIMJAMAN
                    $query1 = mysqli_prepare($conn, "
                        UPDATE pemimjaman SET
                            id_anggota = ?
                        WHERE id_pinjam = ?
                    ");

                    mysqli_stmt_bind_param(
                        $query1,
                        "ii",
                        $id_anggota,
                        $id_pinjam
                    );

                    mysqli_stmt_execute($query1);

                    // 2. UPDATE TABEL DETAIL_PINJAM
                    $query2 = mysqli_prepare($conn, "
                        UPDATE detail_pinjam SET
                            id_buku = ?
                        WHERE id_pinjam = ?
                    ");

                    mysqli_stmt_bind_param(
                        $query2,
                        "ii",
                        $id_buku,
                        $id_pinjam
                    );

                    mysqli_stmt_execute($query2);

                    // 3. Simpan semua perubahan
                    mysqli_commit($conn);

                    $_SESSION['success'] = "Data Berhasil Diupdate";

                    header("Location: index.php");
                    exit;

                } catch (Throwable $e) {

                    mysqli_rollback($conn);

                    die("Gagal update data: " . $e->getMessage());
                }
            }
        ?>
      </div>
</body>
</html>