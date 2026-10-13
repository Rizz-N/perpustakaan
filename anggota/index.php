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
        <p class="fs-3 text-light" >Data Anggota</p>
     </div>
     <!-- Tambah data -->
      <div class="d-flex justify-content-between w-80 mx-5 my-4" >
        <p>Data Member Aktif Alexandria</p>
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
                        Nama
                    </th>
                    <th>
                        Alamat
                    </th>
                    <th>
                        Telephon
                    </th>
                    <th>
                        Email
                    </th>
                    <th>
                        tanggal Lahir
                    </th>
                    <th>
                        Aksi
                    </th>
                </tr>
            </thead>
            <tbody class="table-light"  >
                <?php 
                    $no = 1;
                    $query=mysqli_query($conn, "SELECT * FROM anggota");
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
                        <?= $row['alamat'] ?>
                    </td>
                    <td>
                        <?= $row['no_hp'] ?>
                    </td>
                    <td>
                        <?= $row['email'] ?>
                    </td>
                    <td>
                        <?= $row['tgl_lahir'] ?>
                    </td>
                    <td>
                        <a href="edit.php?id=<?= $row['id_anggota'] ?>" 
                        class="btn btn-warning">
                            Edit
                        </a>
                        <button type="button"
                            class="btn btn-danger"
                            data-bs-toggle="modal"
                            data-bs-target="#modalHapus<?= $row['id_anggota'] ?>">
                            Hapus
                        </button>
                    </td>
                </tr>
                <!-- modal delete Member -->
                <div class="modal fade"
                    id="modalHapus<?= $row['id_anggota'] ?>"
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
                                Yakin ingin menghapus anggota ini?
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Tidak</button>

                                <a href="delete.php?id=<?= $row['id_anggota'] ?>"
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