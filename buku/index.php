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
        <p class="fs-3 text-light" >Data Buku</p>
     </div>
     <!-- Tambah data -->
      <div class="d-flex justify-content-between w-80 mx-5 my-4" >
        <p>Data Buku Alexandria</p>
        <a href="tambah.php" class="btn btn-success" >TAMBAH +</a>
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
                        Judul
                    </th>
                    <th>
                        Pengarang
                    </th>
                    <th>
                        Penerbit
                    </th>
                    <th>
                        Kategori
                    </th>
                    <th>
                        Tahun
                    </th>
                    <th>
                        ISBN
                    </th>
                    <th>
                        Tanggal Masuk
                    </th>
                    <th>
                        Jumlah Halaman
                    </th>
                    <th>
                        Aksi
                    </th>
                </tr>
            </thead>
            <tbody class="table-light"  >
                <?php 
                    $no = 1;
                    $query=mysqli_query($conn, "SELECT b.*, k.kategori FROM buku b JOIN kategori_buku k ON b.id_kategori=k.id_kategori");
                    while ($row = mysqli_fetch_assoc($query))
                {
               ?>
                <tr>
                    <td>
                        <?= $no++ ?>
                    </td>
                    <td>
                        <?= $row['judul'] ?>
                    </td>
                    <td>
                        <?= $row['pengarang'] ?>
                    </td>
                    <td>
                        <?= $row['penerbit'] ?>
                    </td>
                    <td>
                        <?= $row['kategori'] ?>
                    </td>
                    <td>
                        <?= $row['tahun'] ?>
                    </td>
                    <td>
                        <?= $row['isbn'] ?>
                    </td>
                    <td>
                        <?= $row['tgl_input'] ?>
                    </td>
                    <td>
                        <?= $row['jml_halaman'] ?>
                    </td>
                    <td>
                        <a href="edit.php?id=<?= $row['id_buku'] ?>" 
                        class="btn btn-warning">
                            Edit
                        </a>
                        <button type="button"
                            class="btn btn-danger"
                            data-bs-toggle="modal"
                            data-bs-target="#modalHapus<?= $row['id_buku'] ?>">
                            Hapus
                        </button>
                    </td>
                </tr>
                <!-- modal delete Member -->
                <div class="modal fade"
                    id="modalHapus<?= $row['id_buku'] ?>"
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
                                Yakin ingin menghapus Buku ini?
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Tidak</button>

                                <a href="delete.php?id=<?= $row['id_buku'] ?>"
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