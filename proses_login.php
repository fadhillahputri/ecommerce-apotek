<?php
include 'Koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validasi input untuk email
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $password = $_POST['password'] ?? ''; // Gunakan null coalescing untuk mengatasi undefined array key

    // Validasi email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error_message = "Format email tidak valid.";
    } else {
        // Query untuk mendapatkan data pengguna berdasarkan email
        $sql = "SELECT * FROM user WHERE email = ?";
        $stmt = $conn->prepare($sql);

        if ($stmt === false) {
            $error_message = "Terjadi kesalahan pada query: " . $conn->error;
        } else {
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result === false) {
                $error_message = "Terjadi kesalahan dalam mendapatkan hasil: " . $stmt->error;
            } else {
                if ($result->num_rows > 0) {
                    // Ambil data pengguna
                    $user = $result->fetch_assoc();

                    // Verifikasi password hanya jika password tidak kosong
                    if (!empty($password) && password_verify($password, $user['password'])) {
                        // Password benar, set sesi pengguna
                        session_start(); // Pastikan sesi dimulai
                        $_SESSION['id_user'] = $user['id_user']; // Gunakan id_user sesuai struktur tabel
                        $_SESSION['user_email'] = $user['email'];

                        // Redirect ke halaman setelah login berhasil
                        header("Location: index.html"); // Ganti dengan halaman yang diinginkan setelah login
                        exit();
                    } else {
                        $error_message = "Password salah.";
                    }
                } else {
                    $error_message = "Email tidak ditemukan.";
                }
            }

            $stmt->close();
        }
    }
}
$conn->close();
?>
