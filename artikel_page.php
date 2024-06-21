<?php
require 'admin_RPL/function.php';
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Home - Blog Kesehatan</title>
        <!-- Favicon-->
        <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="css/styles.css" rel="stylesheet" />
        <style type="text/css">
        .tentang {
            text-align: justify;
        }
        .article-container {
            margin-bottom: 20px;
        }
        .card-body {
            text-align: justify;
        }
        </style>
    </head>
    <body>
        <!-- Responsive navbar-->
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container">
                <a class="navbar-brand" href="#!">MedCareMarket</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                        <li class="nav-item"><a class="nav-link" href="index.html">Home</a></li>
                    </ul>
                </div>
            </div>
        </nav>
        <!-- Page header with logo and tagline-->
        <header class="py-5 bg-light border-bottom mb-4">
            <div class="container">
                <div class="text-center my-5">
                    <h1 class="fw-bolder">Informasi dan Tips Kesehatan</h1>
                </div>
            </div>
        </header>
        <!-- Page content-->
        <div class="container">
            <div class="row">
                <!-- Blog entries-->
                <div class="col-lg-12">
                    <!-- Featured blog post-->
                    <!-- Nested row for non-featured blog posts-->
                    <div class="row">
                    <?php
                    $sql = "SELECT 
                    *
                    FROM 
                        artikel
                    ";
                    $result = mysqli_query($conn, $sql);
                    $nomor = 0;
                    if (mysqli_num_rows($result) > 0) {
                        while($row = mysqli_fetch_assoc($result)) {
                            $nomor++;
                            $data_judul = $row['judul'];
                            $data_gambar = $row['gambar'];
                            $data_isi = $row['isi'];
                    ?>
                        <div class="col-12 col-md-6 col-lg-4 article-container">
                            <!-- Blog post-->
                            <div class="card mb-4">
                                <a href="#!"><img class="card-img-top" src="admin_RPL/<?php echo $data_gambar; ?>" alt="..." /></a>
                                <div class="card-body">
                                    <h2 class="card-title h4"><?php echo $data_judul; ?></h2>
                                    <p class="card-text"><?php echo $data_isi; ?></p>
                                </div>
                            </div>
                        </div>
                    <?php
                        }
                    }
                    ?>
                    </div>
                </div>
                
                <!-- Side widgets-->
                
            </div>
        </div>
        <!-- Footer-->
        <footer class="py-5 bg-dark">
            <div class="container"><p class="m-0 text-center text-white">Copyright &copy; MedCareMarket</p></div>
        </footer>
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="js/scripts.js"></script>
    </body>
</html>
