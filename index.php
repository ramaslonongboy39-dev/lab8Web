
<?php
include("koneksi.php");

// Menampilkan data barang
$sql = "SELECT * FROM data_barang";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Data Barang</title>
    <link href="style.css" rel="stylesheet" type="text/css">
</head>
<body>
    <div class="container">
        <h1>Data Barang</h1>

        <div class="main">
            <a href="tambah.php">Tambah Barang</a>

            <table>
                <tr>
                    <th>Gambar</th>
                    <th>Nama Barang</th>
                    <th>Kategori</th>
                    <th>Harga Jual</th>
                    <th>Harga Beli</th>
                    <th>Stok</th>
                    <th>Aksi</th>
                </tr>

                <?php if ($result && mysqli_num_rows($result) > 0): ?>
                    <?php while ($row = mysqli_fetch_assoc($result)): ?>
                        <tr>
                            <td>
                                <?php
                                $fileGambar = "gambar/" . $row['gambar'];

                                if (!empty($row['gambar']) && file_exists($fileGambar)):
                                ?>
                                    <img src="<?= htmlspecialchars($fileGambar); ?>"
                                         alt="<?= htmlspecialchars($row['nama']); ?>"
                                         width="80">
                                <?php else: ?>
                                    Tidak ada gambar
                                <?php endif; ?>
                            </td>

                            <td><?= htmlspecialchars($row['nama']); ?></td>
                            <td><?= htmlspecialchars($row['kategori']); ?></td>
                            <td><?= number_format($row['harga_jual'], 0, ',', '.'); ?></td>
                            <td><?= number_format($row['harga_beli'], 0, ',', '.'); ?></td>
                            <td><?= htmlspecialchars($row['stok']); ?></td>

                            <td>
                                <a href="ubah.php?id=<?= $row['id_barang']; ?>">Edit</a>
                                |
                                <a href="hapus.php?id=<?= $row['id_barang']; ?>"
                                   onclick="return confirm('Yakin ingin menghapus barang ini?')">
                                    Hapus
                                </a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="7">Belum ada data barang</td>
                    </tr>
                <?php endif; ?>
            </table>
        </div>
    </div>
</body>
</html>
