<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "medcaremarket";

$conn = mysqli_connect($servername, $username, $password, $dbname);
 if (!$conn) {
    die("connection failed: " . mysqli_connect_error());
 }
 else {

 }

if(isset($_POST['btn_login'])) {
    $data_email = $_POST['email'];
    $data_password = ($_POST['password']);

    $sql = "SELECT * FROM owner WHERE email='$data_email' AND password= '$data_password'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)){
            $_SESSION["email"] = $data_email;
            $_SESSION["password"] = $data_password;
        } 
        header('location:index.php');
    } else {
      header('location:login.php');
    }
}

if(isset($_POST['btn_hapus_artikel'])){
  $id_hapus = $_POST['id_hapus_artikel'];

    // sql to delete a record
  $sql_hapus_artikel = "DELETE FROM artikel WHERE id_artikel = '$id_hapus'";

  if (mysqli_query($conn, $sql_hapus_artikel)) {
  } else {
    echo "Error deleting record: " . mysqli_error($conn);
  }

}

if(isset($_POST['btn_simpan'])){

    $target_dir = "gambar/";
    $target_file = $target_dir . basename($_FILES["gambar"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

    // Check if image file is a actual image or fake image
    $check = getimagesize($_FILES["gambar"]["tmp_name"]);
      if($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
      } else {
        echo "File is not an image.";
        $uploadOk = 0;
      }

    // Check if file already exists
    if (file_exists($target_file)) {
      echo "Sorry, file already exists.";
      $uploadOk = 0;
    }

    // Check file size
    if ($_FILES["gambar"]["size"] > 50000000) {
      echo "Sorry, your file is too large.";
      $uploadOk = 0;
    }

    // Allow certain file formats
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    && $imageFileType != "gif" ) {
      echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
      $uploadOk = 0;
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
      echo "Sorry, your file was not uploaded.";
    // if everything is ok, try to upload file
    } else {
      if (move_uploaded_file($_FILES["gambar"]["tmp_name"], $target_file)) {
        echo "The file ". htmlspecialchars( basename( $_FILES["gambar"]["name"])). " has been uploaded.";
      } else {
        echo "Sorry, there was an error uploading your file.";
      }
    }

    $data_judul = $_POST['judul'];
    $data_isi = $_POST['isi'];
    $data_gambar = $target_file;

    $sql = "INSERT INTO artikel (judul, isi, gambar) VALUES ('$data_judul', '$data_isi', '$data_gambar')";

    if (mysqli_query($conn, $sql)) {
    }  else  {
      
    }
}

if(isset($_POST['btn_ubah_artikel'])){
  $target_dir = "gambar/";
  $target_file = $target_dir . basename($_FILES["gambar"]["name"]);
  $uploadOk = 1;
  $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

  // Check if image file is a actual image or fake image
  $check = getimagesize($_FILES["gambar"]["tmp_name"]);
    if($check !== false) {
      echo "File is an image - " . $check["mime"] . ".";
      $uploadOk = 1;
    } else {
      echo "File is not an image.";
      $uploadOk = 0;
    }

  // Check if file already exists
  if (file_exists($target_file)) {
    echo "Sorry, file already exists.";
    $uploadOk = 0;
  }

  // Check file size
  if ($_FILES["gambar"]["size"] > 50000000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
  }

  // Allow certain file formats
  if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
  && $imageFileType != "gif" ) {
    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
  }

  // Check if $uploadOk is set to 0 by an error
  if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
  // if everything is ok, try to upload file
  } else {
    if (move_uploaded_file($_FILES["gambar"]["tmp_name"], $target_file)) {
      echo "The file ". htmlspecialchars( basename( $_FILES["gambar"]["name"])). " has been uploaded.";
    } else {
      echo "Sorry, there was an error uploading your file.";
    }
  }

  $data_judul = $_POST['judul'];
  $data_isi = $_POST['isi'];
  $data_gambar = $target_file;
  $id_ubah = $_POST['id_artikel_ubah'];

  $sql_update_artikel = "UPDATE artikel SET judul='$data_judul', isi = '$data_isi', gambar = '$data_gambar' 
  WHERE id_artikel='$id_ubah'";
  
  if (mysqli_query($conn, $sql_update_artikel)) {
  }  else  {
    

  }               
}

if(isset($_POST['btn_simpan_owner'])){
  $data_nama = $_POST['nama'];
  $data_email = $_POST['email'];
  $data_no = $_POST['no_tlp'];
  $data_ttl = $_POST['ttl'];
  $data_alamat =$_POST['alamat'];
  $data_password = $_POST['password'];
  
  $sql = "INSERT INTO owner (nama, email, no_telepon, tempat_tgl_lahir, alamat, password) VALUES ('$data_nama', '$data_email', '$data_no', '$data_ttl', '$data_alamat', '$data_password')";

  if (mysqli_query($conn, $sql)) {
    header('location:owner.php');
  } else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
  }
}

if(isset($_POST['btn_hapus_owner'])){
  $id_hapus = $_POST['id_hapus_owner'];

  // sql to delete a record
  $sql_hapus_artikel = "DELETE FROM owner WHERE id_owner = '$id_hapus'";

  if (mysqli_query($conn, $sql_hapus_artikel)) {
  } else {
    echo "Error deleting record: " . mysqli_error($conn);
  }

}

if(isset($_POST['btn_hapus_user'])){
  $id_hapus = $_POST['id_hapus_user'];

  // sql to delete a record
  $sql_hapus_artikel = "DELETE FROM user WHERE id_user = '$id_hapus'";

  if (mysqli_query($conn, $sql_hapus_artikel)) {
  } else {
    echo "Error deleting record: " . mysqli_error($conn);
  }

}

if(isset($_POST['btn_ubah_barang'])){
    $target_dir = "gambar/";
    $target_file = $target_dir . basename($_FILES["gambar"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

    // Check if image file is a actual image or fake image
    $check = getimagesize($_FILES["gambar"]["tmp_name"]);
      if($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
      } else {
        echo "File is not an image.";
        $uploadOk = 0;
      }

    // Check if file already exists
    if (file_exists($target_file)) {
      echo "Sorry, file already exists.";
      $uploadOk = 0;
    }

    // Check file size
    if ($_FILES["gambar"]["size"] > 50000000) {
      echo "Sorry, your file is too large.";
      $uploadOk = 0;
    }

    // Allow certain file formats
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    && $imageFileType != "gif" ) {
      echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
      $uploadOk = 0;
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
      echo "Sorry, your file was not uploaded.";
    // if everything is ok, try to upload file
    } else {
      if (move_uploaded_file($_FILES["gambar"]["tmp_name"], $target_file)) {
        echo "The file ". htmlspecialchars( basename( $_FILES["gambar"]["name"])). " has been uploaded.";
      } else {
        echo "Sorry, there was an error uploading your file.";
      }
    }

    $data_kategori = $_POST['kategori'];
    $data_nama = $_POST['nama'];
    $data_merk = $_POST['merk'];
    $data_deskripsi = $_POST['deskripsi'];
    $data_gambar = $target_file;
    $data_harga = $_POST['harga'];
    $data_stok = $_POST['stok'];
    $id_ubah = $_POST['id_ubah_barang'];
  
    $sql_update_artikel = "UPDATE barang SET id_kategori='$data_kategori', nama_barang = '$data_nama', merk = '$data_merk', harga = '$data_harga', stok = '$data_stok', deskripsi = '$data_deskripsi', gambar = '$data_gambar' 
    WHERE id_barang='$id_ubah'";
    
    if (mysqli_query($conn, $sql_update_artikel)) {
    }  else  {
      

    }               
}

if(isset($_POST['btn_hapus_barang'])){
  $id_hapus = $_POST['id_hapus_barang'];

  // sql to delete a record
  $sql_hapus_artikel = "DELETE FROM barang WHERE id_barang = '$id_hapus'";

  if (mysqli_query($conn, $sql_hapus_artikel)) {
  } else {
    echo "Error deleting record: " . mysqli_error($conn);
  }

}

if(isset($_POST['btn_tambah_barang'])){
  $target_dir = "gambar/";
  $target_file = $target_dir . basename($_FILES["gambar"]["name"]);
  $uploadOk = 1;
  $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

  // Check if image file is a actual image or fake image
  $check = getimagesize($_FILES["gambar"]["tmp_name"]);
    if($check !== false) {
      echo "File is an image - " . $check["mime"] . ".";
      $uploadOk = 1;
    } else {
      echo "File is not an image.";
      $uploadOk = 0;
    }

  // Check if file already exists
  if (file_exists($target_file)) {
    echo "Sorry, file already exists.";
    $uploadOk = 0;
  }

  // Check file size
  if ($_FILES["gambar"]["size"] > 50000000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
  }

  // Allow certain file formats
  if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
  && $imageFileType != "gif" ) {
    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
  }

  // Check if $uploadOk is set to 0 by an error
  if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
  // if everything is ok, try to upload file
  } else {
    if (move_uploaded_file($_FILES["gambar"]["tmp_name"], $target_file)) {
      echo "The file ". htmlspecialchars( basename( $_FILES["gambar"]["name"])). " has been uploaded.";
    } else {
      echo "Sorry, there was an error uploading your file.";
    }
  }

  $data_kategori = $_POST['id_kategori'];
  $data_nama = $_POST['nama'];
  $data_merk = $_POST['merk'];
  $data_deskripsi = $_POST['deskripsi'];
  $data_gambar = $target_file;
  $data_harga = $_POST['harga'];
  $data_stok = $_POST['stok'];

  $sql_simpan_barang = "INSERT INTO barang (id_kategori, nama_barang, merk, deskripsi, harga, gambar, stok) VALUES ('$data_kategori', '$data_nama', '$data_merk', '$data_deskripsi', '$data_harga', '$data_gambar', $data_stok)";
  
  if (mysqli_query($conn, $sql_simpan_barang)) {
  }  else  {
    
  }               
}

if (isset($_POST['btn_ganti_status'])) {
  $status = "DIKIRIM";
  $id_update = $_POST['id_ubah_status'];
  
  $sql = "UPDATE transaksi SET status_transaksi='$status' WHERE id_transaksi='$id_update'";

  if (mysqli_query($conn, $sql)) {
      header('location:transaksi.php');
  } else {
      echo "Error updating record: " . mysqli_error($conn);
  }
}

if (isset($_POST['btn_ganti_status_user'])) {
  $status = "SELESAI";
  $id_update = $_POST['id_ubah_status'];
  
  $sql = "UPDATE transaksi SET status_transaksi='$status' WHERE id_transaksi='$id_update'";

  if (mysqli_query($conn, $sql)) {
      header('location:riwayat.php');
  } else {
      echo "Error updating record: " . mysqli_error($conn);
  }
}


?>