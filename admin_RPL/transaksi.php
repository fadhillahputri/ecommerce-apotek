<?php
require 'function.php';
error_reporting(E_ALL);
ini_set('display_errors', 1);

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>MEDCAREMARKET</title>

    <!-- Custom fonts for this template -->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

    <!-- Custom styles for this page -->
    <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
                <div class="sidebar-brand-icon rotate-n-15">
                </div>
                <div class="sidebar-brand-text mx-3">HALAMAN UTAMA</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link" href="index.php">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>

            <li class="nav-item active">
                <a class="nav-link" href="user.php">
                <i class="bi bi-person-hearts"></i>
                    <span>Data User</span></a>
            </li>

            <li class="nav-item active">
                <a class="nav-link" href="owner.php">
                <i class="bi bi-people"></i>
                    <span>Data Pegawai</span></a>
            </li>

            <li class="nav-item active">
                <a class="nav-link" href="barang.php">
                <i class="bi bi-bag-heart"></i>
                    <span>Barang</span></a>
            </li>

            <li class="nav-item active">
                <a class="nav-link" href="transaksi.php">
                <i class="bi bi-cart-check-fill"></i>
                    <span>Transaksi</span></a>
            </li>

            <li class="nav-item active">
                <a class="nav-link" href="artikel.php">               
                <i class="bi bi-file-text"></i>
                    <span>Artikel</span></a>
            </li>

            <li class="nav-item active">
                <a class="nav-link" href="logout.php">
                <i class="bi bi-door-closed-fill"></i>
                    <span>Logout</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

            <!-- Sidebar Message -->
            <div class="sidebar-card d-none d-lg-flex">
                <img class="sidebar-card-illustration mb-2" src="img/undraw_rocket.svg" alt="...">
                <p class="text-center mb-2"><strong>Logged in as:</strong> 
                <?php echo $_SESSION["email"]; ?>
                </p>
            </div>

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <form class="form-inline">
                        <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                            <i class="fa fa-bars"></i>
                        </button>
                    </form>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                        <li class="nav-item dropdown no-arrow d-sm-none">
                            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-search fa-fw"></i>
                            </a>
                            <!-- Dropdown - Messages -->
                            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                                aria-labelledby="searchDropdown">
                                <form class="form-inline mr-auto w-100 navbar-search">
                                    <div class="input-group">
                                        <input type="text" class="form-control bg-light border-0 small"
                                            placeholder="Search for..." aria-label="Search"
                                            aria-describedby="basic-addon2">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="button">
                                                <i class="fas fa-search fa-sm"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </li>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">ADMIN</span>
                                <img class="img-profile rounded-circle"
                                    src="img/undraw_profile.svg">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">TRANSAKSI</h1>
                    <p class="mb-4">Kelola Transaksi Disini</p>

                    <!-- Data Tabel -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <button class="btn btn-primary" name="btn_kategori_baru" id="btn_kategori_baru" data-toggle="modal" data-target="#ModalKategori">
                                Transaksi Baru
                            </button>
                        </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Nama Pengguna</th>
                                        <th>Alamat Transaksi</th>
                                        <th>Waktu Transaksi</th>
                                        <th>Detail Transaksi</th>
                                        <th>Status Transaksi</th>
                                    </tr>
                                </thead> 
                                <tbody>
                                <?php 
                                        $sql = "SELECT 
                                        u.id_user, u.nama, u.email, 
                                        t.id_transaksi, t.tanggal_transaksi, t.total_harga, t.status_transaksi, t.alamat_pengiriman
                                            FROM user u
                                            JOIN transaksi t ON u.id_user = t.id_user
                                            GROUP BY t.id_transaksi
                                            ORDER BY t.id_transaksi DESC";
                                        $result = mysqli_query($conn, $sql);
                                        $nomor = 0;
                                        if (mysqli_num_rows($result) > 0) {
                                            while($row = mysqli_fetch_assoc($result)) {
                                                $nomor++;
                                                $data_nama = $row['nama'];
                                                $data_tanggal = $row['tanggal_transaksi'];
                                                $data_alamat = $row['alamat_pengiriman'];
                                                $status = $row['status_transaksi'];
                                                $total_harga = $row['total_harga'];
                                                $data_id_transaksi = $row['id_transaksi'];
                                    ?>
                                    <tr>
                                        <td><?php echo $nomor; ?></td>
                                        <td><?php echo $data_nama; ?></td>
                                        <td><?php echo $data_alamat; ?></td>
                                        <td><?php echo $data_tanggal; ?></td>
                                        <td>
                                            <button class="btn btn-danger btn-sm" name="btn_detail_transaksi" data-toggle="modal" data-target="#modaldetail<?php echo $data_id_transaksi; ?>">Lihat Detail</button>
                                        </td>
                                        <td><?php echo $status; ?></td>
                                    </tr>
                                <!-- Modal Detail -->
                                <div class="modal fade" id="modaldetail<?php echo $data_id_transaksi; ?>">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <!-- Modal Header -->
                                            <div class="modal-header">
                                                <h4 class="modal-title">Detail Transaksi <?php echo $data_nama;?></h4>
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            </div>
                                            
                                            <!-- Modal Body -->
                                            <div class="modal-body">
                                                <form method="POST">
                                                    <?php 
                                                    $detail_sql = "SELECT 
                                                                    dt.id_detail_transaksi, dt.jumlah,
                                                                    b.id_barang, b.nama_barang, b.merk, b.harga, b.stok, b.deskripsi, b.gambar
                                                                FROM detail_transaksi dt
                                                                JOIN barang b ON dt.id_barang = b.id_barang
                                                                WHERE dt.id_transaksi = $data_id_transaksi";
                                                    $detail_result = mysqli_query($conn, $detail_sql);
                                                    if (mysqli_num_rows($detail_result) > 0) {
                                                        while($detail_row = mysqli_fetch_assoc($detail_result)) {
                                                            $nama_barang = $detail_row['nama_barang'];
                                                            $merk_barang = $detail_row['merk'];
                                                            $harga_barang = $detail_row['harga'];
                                                            $jumlah_barang = $detail_row['jumlah'];
                                                    ?>
                                                    <div class="mb-3 row">
                                                        <label for="namaBarang" class="col-sm-4 col-form-label">Nama Produk:</label>
                                                        <div class="col-sm-8">
                                                            <input type="text" class="form-control" id="namaBarang" value="<?php echo $nama_barang; ?>" name="namaBarang" readonly>
                                                        </div>
                                                    </div>
                                                    <div class="mb-3 row">
                                                        <label for="merkBarang" class="col-sm-4 col-form-label">Merk:</label>
                                                        <div class="col-sm-8">
                                                            <input type="text" class="form-control" id="merkBarang" value="<?php echo $merk_barang; ?>" name="merkBarang" readonly>
                                                        </div>
                                                    </div>
                                                    <div class="mb-3 row">
                                                        <label for="hargaBarang" class="col-sm-4 col-form-label">Harga perSatuan:</label>
                                                        <div class="col-sm-8">
                                                            <input type="text" class="form-control" id="hargaBarang" value="<?php echo $harga_barang; ?>" name="harga" readonly>
                                                        </div>
                                                    </div>
                                                    <div class="mb-3 row">
                                                        <label for="jumlahBarang" class="col-sm-4 col-form-label">Jumlah:</label>
                                                        <div class="col-sm-8">
                                                            <input type="number" class="form-control" id="jumlahBarang" value="<?php echo $jumlah_barang; ?>" name="jumlahBarang" readonly>
                                                        </div>
                                                    </div>
                                                    <?php 
                                                        }
                                                    }
                                                    ?>
                                                    <div class="mb-3 row">
                                                        <label for="totalHarga" class="col-sm-4 col-form-label">Total Harga:</label>
                                                        <div class="col-sm-8">
                                                            <input type="number" class="form-control" id="totalHarga" value="<?php echo $row['total_harga']; ?>" name="totalHarga" readonly>
                                                        </div>
                                                    </div>
                                                    <input type="hidden" name="id_ubah_status" value="<?php echo $data_id_transaksi; ?>">
                                                    <button type="submit" class="btn btn-danger" name="btn_ganti_status">Kirim Barang</button>
                                                </form> 
                                            </div>

                                            <!-- Modal Footer -->
                                            <div class="modal-footer">
                                                <button class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                    <?php
                                        } 
                                    } else {
                                        echo "0 results";
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    </div>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="logout.php">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/datatables-demo.js"></script>
    <script src="https://cdn.ckeditor.com/ckeditor5/41.4.2/super-build/ckeditor.js"></script>
    
    <!-- The Modal Form Kategori-->
    <div class="modal fade" data-backdrop="static" id="ModalKategori">
        <div class="modal-dialog modal-l">
        <div class="modal-content">
        
            <!-- Modal Header -->
            <div class="modal-header">
            <h4 class="modal-title">Tambah Kategori</h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            
            <!-- Modal body -->
            <div class="modal-body">
                <form method="POST" enctype="multipart/form-data">
                    <div class="mb-3 mt-3">
                        <label for="nama" class="form-label">Nama Kategori:</label>
                        <input type="text" class="form-control" id="nama" placeholder="Masukkan Nama Kategori" name="nama">
                    </div>
                    <div class="mb-3">
                        <label for="keterangan">Keterangan: </label>
                        <textarea class="form-control" rows="5" id="keterangan" placeholder="Penjelasan Kategori" name="keterangan"></textarea>
                    <div class="mb-3 mt-3 d-flex justify-content-end gap-3">
                        <button class="btn btn-primary" name="btn_simpan_kategori">Simpan</button>
                        <button class="btn btn-danger" data-dismiss="modal">Tutup</button>
                    </div>
                </form> 
            </div>           
        </div>
        </div>
    </div>
</body>

</html>
