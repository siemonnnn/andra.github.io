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

// Ambil data dari form
$user = strip_tags(trim($_POST['username']));
$nama = strip_tags(trim($_POST['nama']));
$pass = md5(strip_tags(trim($_POST['password'])));

$sql = "INSERT INTO users (username, nama, password, level) VALUES ('$user', '$nama', '$pass', 1)";

if ($conn->query($sql) === TRUE) {
  // Pesan pop berhasil daftar
  echo '<script>alert("Pendaftaran berhasil. Silakan login."); window.location.href = "login.php";</script>';
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
