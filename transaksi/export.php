
<?php
session_start();
include "../config/conn.php";

// Header untuk mengunduh file Excel
header("Content-Type: application/vnd.ms-excel; charset=utf-8");
header("Content-Disposition: attachment; filename=laporan_peminjam_buku.xls");
header("Pragma: no-cache");
header("Expires: 0");

// Mengambil data dari database
$query = mysqli_query($conn, "
    SELECT
        a.nama AS nama_peminjam,
        b.judul AS judul_buku,
        p.lama_pinjam,
        u.username AS nama_kasir
    FROM pemimjaman p
    INNER JOIN anggota a
        ON p.id_anggota = a.id_anggota
    INNER JOIN detail_pinjam d
        ON p.id_pinjam = d.id_pinjam
    INNER JOIN user u
        ON p.id_user = u.user_id
    LEFT JOIN buku b
        ON d.id_buku = b.id_buku
");

// Menghentikan proses jika query gagal
if (!$query) {
    die("Query gagal: " . mysqli_error($conn));
}
?>

<table border="1">
    <thead>
        <tr>
            <th>No</th>
            <th>Nama Peminjam</th>
            <th>Buku</th>
            <th>Tanggal Pengembalian</th>
            <th>Nama Kasir</th>
        </tr>
    </thead>

    <tbody>
        <?php
        $no = 1;

        while ($row = mysqli_fetch_assoc($query)) {
        ?>
            <tr>
                <td><?= $no++ ?></td>
                <td><?= htmlspecialchars($row['nama_peminjam'] ?? '', ENT_QUOTES, 'UTF-8') ?></td>
                <td><?= htmlspecialchars($row['judul_buku'] ?? '', ENT_QUOTES, 'UTF-8') ?></td>
                <td><?= htmlspecialchars($row['lama_pinjam'] ?? '', ENT_QUOTES, 'UTF-8') ?></td>
                <td><?= htmlspecialchars($row['nama_kasir'] ?? '', ENT_QUOTES, 'UTF-8') ?></td>
            </tr>
        <?php } ?>
    </tbody>
</table>
