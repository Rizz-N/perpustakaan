<?php
     session_start();
    include "../config/conn.php"
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include "../config/style.php"; ?>
    <title>Document</title>
</head>
<body>
    <!-- navbar -->
     <?php include "../component/navbar.php"; ?>
    <!-- hero -->
     <div class="d-flex justify-content-center align-items-center w-100 bg-success mt-5" style="height: 25vh;" >
        <p class="fs-3 text-light" >Data Peminjam Buku</p>
     </div>
     <!-- Tambah data -->
      <div class="d-flex justify-content-between w-80 mx-5 my-4" >
        <p>Data Peminjam Buku Alexandria</p>
        <div class="d-flex gap-5" >
            <a href="tambah.php" class="btn btn-success" >TAMBAH +</a>
            <a href="export.php" class="btn btn-success" >EXPORT TO EXCEL</a>
        </div>
      </div>
      <!-- alert -->
       <?php include "../component/alert.php" ?>
     <!-- table -->
      <div class="mx-5 my-2" >
          <table class="table table-success" >
            <thead>
                <tr>
                    <th>
                        No
                    </th>
                    <th>
                        Nama Peminjam
                    </th>
                    <th>
                        Buku
                    </th>
                    <th>
                        Tanggal Pengembalian
                    </th>
                    <th>
                        Nama Kasir
                    </th>
                    <th>
                        Aksi
                    </th>
                </tr>
            </thead>
            <tbody class="table-light"  >
                <?php 
                    $no = 1;
                    $query=mysqli_query($conn, "SELECT p.*, a.nama ,d.id_pinjam, d.id_buku, d.tgl_kembali, u.username, b.judul FROM pemimjaman p 
                                                INNER JOIN anggota a ON p.id_anggota = a.id_anggota
                                                INNER JOIN detail_pinjam d ON p.id_pinjam = d.id_pinjam
                                                INNER JOIN user u ON p.id_user = u.user_id
                                                LEFT JOIN buku b ON d.id_buku = b.id_buku");
                    while ($row = mysqli_fetch_assoc($query))
                {
               ?>
                <tr>
                    <td>
                        <?= $no++ ?>
                    </td>
                    <td>
                        <?= $row['nama'] ?>
                    </td>
                    <td>
                        <?= $row['judul'] ?>
                    </td>
                    <td>
                        <?= $row['lama_pinjam'] ?>
                    </td>
                    <td>
                        <?= $row['username'] ?>
                    </td>
                    <td>
                        <a href="edit.php?id=<?= $row['id_pinjam'] ?>" 
                        class="btn btn-warning">
                            Edit
                        </a>
                        <button type="button"
                            class="btn btn-danger"
                            data-bs-toggle="modal"
                            data-bs-target="#modalHapus<?= $row['id_pinjam'] ?>">
                            Hapus
                        </button>
                    </td>
                </tr>
                <!-- modal delete Member -->
                <div class="modal fade"
                    id="modalHapus<?= $row['id_pinjam'] ?>"
                    tabindex="-1"
                    aria-hidden="true">

                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Konfirmasi Hapus</h5>
                                <button type="button" class="btn-close"
                                        data-bs-dismiss="modal"></button>
                            </div>

                            <div class="modal-body">
                                Yakin ingin menghapus kategori ini?
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Tidak</button>

                                <a href="delete.php?id=<?= $row['id_pinjam'] ?>"
                                class="btn btn-danger">Ya, Hapus</a>
                            </div>
                        </div>
                    </div>
                </div>
                <?php } ?>
            </tbody>
          </table>
      </div>
      <script>
        
        setTimeout(function () {
            const alert = document.querySelector('.alert');

            if (alert) {
                bootstrap.Alert.getOrCreateInstance(alert).close();
            }
        }, 3000);

      </script>
</body>
</html>