<?php
include 'Koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $no_telepon = $_POST['no_telepon'];
    $tempat_tanggal_lahir = $_POST['tempat_tanggal_lahir'];
    $alamat = $_POST['alamat'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT); // Mengenkripsi password

    $sql = "INSERT INTO user (nama, email, no_telepon, tempat_tanggal_lahir, alamat, password) VALUES ('$nama', '$email', '$no_telepon', '$tempat_tanggal_lahir', '$alamat', '$password')";

    if ($conn->query($sql) === TRUE) {
        header("Location: login.html");
        exit();

    } else {
        echo "Error: " . $sql . "<br>" . $conn-> error;
    }

    $conn->close();
}
?>
