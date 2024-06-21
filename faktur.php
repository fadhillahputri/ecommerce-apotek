<?php
session_start();
include 'Koneksi.php';

// Pastikan pengguna telah login
if (!isset($_SESSION['id_user']) || !isset($_GET['id_transaksi'])) {
    header("Location: login.html");
    exit();
}

$id_transaksi = intval($_GET['id_transaksi']);

// Ambil data transaksi
$sql = "SELECT t.*, u.nama AS nama_user
        FROM transaksi t
        JOIN user u ON t.id_user = u.id_user
        WHERE t.id_transaksi = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id_transaksi);
$stmt->execute();
$result = $stmt->get_result();
$transaksi = $result->fetch_assoc();

if (!$transaksi) {
    echo "Transaksi tidak ditemukan.";
    exit();
}

// Ambil detail transaksi
$sql_detail = "SELECT dt.*, b.nama_barang, b.harga, b.gambar
               FROM detail_transaksi dt
               JOIN barang b ON dt.id_barang = b.id_barang
               WHERE dt.id_transaksi = ?";
$stmt_detail = $conn->prepare($sql_detail);
$stmt_detail->bind_param("i", $id_transaksi);
$stmt_detail->execute();
$result_detail = $stmt_detail->get_result();

$barang = [];
while ($row = $result_detail->fetch_assoc()) {
    $data_gambar = $row['gambar'];
    $barang[] = $row;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Faktur Belanja</title>
    <link href="css/styles.css" rel="stylesheet" />
</head>
<body>
    <div class="container">
        <h1 class="mt-4 mb-4">Faktur Belanja</h1>
        <div class="faktur">
            <p><strong>Nama Pelanggan:</strong> <?php echo htmlspecialchars($transaksi['nama_user']); ?></p>
            <p><strong>Tanggal Transaksi:</strong> <?php echo htmlspecialchars($transaksi['tanggal_transaksi']); ?></p>
            <p><strong>Alamat Pengiriman:</strong> <?php echo htmlspecialchars($transaksi['alamat_pengiriman']); ?></p>
            <p><strong>Total Harga:</strong> Rp <?php echo number_format($transaksi['total_harga'], 0, ',', '.'); ?></p>
            <hr>
            <h3>Detail Barang</h3>
            <?php if (count($barang) > 0): ?>
                <ul>
                    <?php foreach ($barang as $item): ?>
                        <li>
                            <img src="admin_RPL/<?php echo htmlspecialchars($item['gambar']); ?>" alt="Gambar Barang" style="width: 50px; height: 50px;"/>
                            <span><?php echo htmlspecialchars($item['nama_barang']); ?> - Rp <?php echo number_format($item['harga'], 0, ',', '.'); ?></span>
                        </li>
                    <?php endforeach; ?>
                </ul>
            <?php else: ?>
                <p>Barang tidak ditemukan.</p>
            <?php endif; ?>
        </div>
        <a href="index.html" class="btn btn-secondary">Kembali</a>
    </div>
</body>
</html>
