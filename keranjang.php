<?php
session_start();
include 'Koneksi.php';

// Pastikan pengguna telah login
if (!isset($_SESSION['id_user'])) {
    header("Location: login.html");
    exit();
}

$cart_items = isset($_SESSION['cart']) ? $_SESSION['cart'] : [];
$checkout_success = false;
$id_transaksi = null;

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['checkout'])) {
    $id_user = $_SESSION['id_user'];
    $alamat_pengiriman = isset($_POST['alamat']) ? $_POST['alamat'] : 'Alamat User'; // Ambil alamat dari form input

    $total_harga = 0;
    foreach ($cart_items as $id_barang => $quantity) {
        $sql = "SELECT harga, stok FROM barang WHERE id_barang = $id_barang";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            if ($row['stok'] < $quantity) {
                echo "Stok tidak cukup untuk barang: " . htmlspecialchars($id_barang);
                exit();
            }
            $total_harga += $row['harga'] * $quantity;
        }
    }

    $stmt = $conn->prepare("INSERT INTO transaksi (id_user, tanggal_transaksi, total_harga, status_transaksi, alamat_pengiriman) VALUES (?, NOW(), ?, 'PENDING', ?)");
    $stmt->bind_param("iis", $id_user, $total_harga, $alamat_pengiriman);

    if ($stmt->execute()) {
        $id_transaksi = $stmt->insert_id;

        foreach ($cart_items as $id_barang => $quantity) {
            $stmt_detail = $conn->prepare("INSERT INTO detail_transaksi (id_transaksi, id_barang, jumlah) VALUES (?, ?, ?)");
            $stmt_detail->bind_param("iii", $id_transaksi, $id_barang, $quantity);
            $stmt_detail->execute();

            // Kurangi stok barang
            $stmt_update = $conn->prepare("UPDATE barang SET stok = stok - ? WHERE id_barang = ?");
            $stmt_update->bind_param("ii", $quantity, $id_barang);
            $stmt_update->execute();
        }
        unset($_SESSION['cart']);
        $checkout_success = true;
    } else {
        echo "Error: " . $stmt->error;
    }
    $stmt->close();
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Keranjang Belanja</title>
    <link href="css/styles.css" rel="stylesheet" />
</head>
<body>
    <div class="container">
        <h1 class="mt-4 mb-4">Keranjang Belanja</h1>
        <?php if ($checkout_success): ?>
            <p>Checkout berhasil!</p>
            <a href="faktur.php?id_transaksi=<?php echo $id_transaksi; ?>" class="btn btn-success">Lihat Faktur</a>
        <?php else: ?>
            <?php if (count($cart_items) > 0): ?>
                <?php
                $sql = "SELECT * FROM barang WHERE id_barang IN (" . implode(',', array_map('intval', array_keys($cart_items))) . ")";
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        $data_gambar = $row['gambar'];
                        $quantity = $cart_items[$row['id_barang']];
                        ?>
                        <div class="card mb-3">
                            <img class="card-img-top" src="admin_RPL/<?php echo $data_gambar; ?>" alt="Product Image" />
                            <div class="card-body">
                                <h5 class="card-title"><?php echo htmlspecialchars($row['nama_barang']); ?></h5>
                                <p class="card-text"><?php echo htmlspecialchars($row['merk']); ?></p>
                                <p class="card-text">Rp <?php echo number_format($row['harga'], 0, ',', '.'); ?></p>
                                <p class="card-text">Jumlah: <?php echo $quantity; ?></p>
                            </div>
                        </div>
                        <?php
                    }
                }
                ?>
                <form method="post" action="keranjang.php">
                    <div class="form-group">
                        <label for="alamat">Alamat Pengiriman</label>
                        <input type="text" class="form-control" id="alamat" name="alamat" required>
                    </div>
                    <button class="btn btn-primary" type="submit" name="checkout">Checkout</button>
                </form>
            <?php else: ?>
                <p>Keranjang belanja Anda kosong.</p>
            <?php endif; ?>
        <?php endif; ?>
    </div>
</body>
</html>
