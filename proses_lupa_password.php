<?php
include 'database.php';

$servername = "localhost";
$username = "root"; // Ganti dengan username MySQL Anda
$password = ""; // Ganti dengan password MySQL Anda
$dbname = "tokohadi"; // Ganti dengan nama database Anda

// Membuat koneksi
$conn = new mysqli($servername, $username, $password, $dbname);

// Cek koneksi
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

if ($_POST) {
    $username = $_POST['username'];
    $new_password = md5($_POST['new_password']);

    // Memeriksa apakah username ada di database
    $check_user = "SELECT * FROM users WHERE username = ?";
    $stmt = $conn->prepare($check_user);
    $stmt->bind_param('s', $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Update password
        $update_password = "UPDATE users SET password = ? WHERE username = ?";
        $stmt = $conn->prepare($update_password);
        $stmt->bind_param('ss', $new_password, $username);
        $stmt->execute();

        // Tampilkan pop-up berhasil menggunakan JavaScript
        echo '
        <script>
            alert("Password berhasil diperbarui. Silakan login kembali.");
            window.location.href = "login.php";
        </script>';
    } else {
        // Tampilkan pop-up username tidak ditemukan menggunakan JavaScript
        echo '
        <script>
            alert("Username tidak ditemukan.");
            window.location.href = "lupa_password.php";
        </script>';
    }
} else {
    header('Location: lupa_password.php');
}

$conn->close();
?>
