<?php
session_start();
include 'Koneksi.php';

// Handle add to cart
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_to_cart'])) {
    $id_barang = intval($_POST['id_barang']);
    $quantity = intval($_POST['quantity']);
    
    // Initialize cart if not set
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }

    // Add or update item in cart
    if (isset($_SESSION['cart'][$id_barang])) {
        $_SESSION['cart'][$id_barang] += $quantity;
    } else {
        $_SESSION['cart'][$id_barang] = $quantity;
    }

    // Redirect to avoid form resubmission
    header("Location: shopping.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Dashboard</title>
        <!-- Favicon-->
        <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
        <!-- Bootstrap icons-->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="css/styles.css" rel="stylesheet" />
    </head>
    <body>
    <!-- Navigation-->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container px-4 px-lg-5">
            <a class="navbar-brand" href="index.html">Med Care Market</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
                    <li class="nav-item"><a class="nav-link active" aria-current="page" href="TentangKami.php">Tentang Kami</a></li>
                    <li class="nav-item"><a class="nav-link" href="artikel_page.php">Artikel</a></li>
                    <li class="nav-item"><a class="nav-link" href="Shopping.php">Shopping</a></li>
                </ul>
                <div class="d-flex align-items-center ms-auto">
                    <a href="keranjang.php" class="btn btn-outline-dark me-2">
                        <i class="bi-cart-fill me-1"></i>
                        Cart
                        <span class="badge bg-dark text-white ms-1 rounded-pill">
                            <?php echo isset($_SESSION['cart']) ? array_sum($_SESSION['cart']) : 0; ?>
                        </span>
                    </a>
                    <button class="btn btn-warning btn-sm" name="riwayat_transaksi" onclick="window.location.href='riwayat.php';">Riwayat Pemesanan</button>
                </div>
            </div>
        </div>
    </nav>

    <!-- Header-->
    <header class="bg-dark py-5">
        <div class="container px-4 px-lg-5 my-5">
            <div class="text-center text-white">
                <h1 class="display-4 fw-bolder">Welcome to Our Store</h1>
                <p class="lead fw-normal text-white-50 mb-0">Enjoy your shopping here</p>
            </div>
        </div>
    </header>
    <!-- Section-->
    <section class="py-5">
    <div class="container px-4 px-lg-5 mt-5">
        <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
            <?php
            $sql = "SELECT * FROM barang";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                $data_gambar = $row['gambar'];

                    ?>
                    <div class="col mb-5">
                        <div class="card h-100">
                            <form method="post" action="shopping.php">
                                <img class="card-img-top" src="admin_RPL/<?php echo $data_gambar; ?>" alt="Product Image">
                                <div class="card-body">
                                    <h5 class="card-title"><?php echo htmlspecialchars($row['nama_barang']); ?></h5>
                                    <p class="card-text"><?php echo htmlspecialchars($row['merk']); ?></p>
                                    <p class="card-text">Rp <?php echo number_format($row['harga'], 0, ',', '.'); ?></p>
                                    <input type="hidden" name="id_barang" value="<?php echo $row['id_barang']; ?>">
                                    <input type="number" name="quantity" value="1" min="1" max="<?php echo $row['stok']; ?>" class="form-control mb-2">
                                    <button type="submit" name="add_to_cart" class="btn btn-primary">Add to Cart</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <?php
                }
            }
            ?>
        </div>
    </div>
</section>
<!-- Footer-->
<footer class="py-5 bg-dark">
    <div class="container"><p class="m-0 text-center text-white">Copyright &copy; Your Website 2023</p></div>
</footer>
<!-- Bootstrap core JS-->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
<!-- Core theme JS-->
<script src="js/scripts.js"></script>
</body>
</html>