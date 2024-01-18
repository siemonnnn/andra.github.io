<?php
// Mengambil informasi file Excel yang diunggah
$excelFile = $_FILES['excel_file']['tmp_name'];

// Memuat library PhpSpreadsheet
require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\IOFactory;

// Memuat file Excel
$spreadsheet = IOFactory::load($excelFile);

// Mengambil sheet pertama
$sheet = $spreadsheet->getActiveSheet();

// Mendapatkan data dari setiap baris
$data = [];
foreach ($sheet->getRowIterator() as $row) {
    $rowData = [];
    foreach ($row->getCellIterator() as $cell) {
        $rowData[] = $cell->getValue();
    }
    $data[] = $rowData;
}

// Menghubungkan ke database
$dsn = 'mysql:host=localhost;dbname=tokohadi';
$username = 'root';
$password = '';

try {
    $dbh = new PDO($dsn, $username, $password);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Menyimpan data ke dalam database
    $stmt = $dbh->prepare("INSERT INTO transaksi (id, transaction_date, produk) VALUES (?, ?, ?)");

    foreach ($data as $row) {
        $stmt->execute($row);
    }

    echo '
    <script>
        alert("File Excel berhasil diunggah dan data telah disimpan.");
        window.location.href = "index.php?menu=data_transaksi";
    </script>';
} catch (PDOException $e) {
    echo "Koneksi database gagal: " . $e->getMessage();
}
?>
