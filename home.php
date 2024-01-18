<div class="main-content">
    <div class="main-content-inner">
        <div class="page-content">
            <div class="page-header">
                <h1 class="text-center">
                    Grafik Penjualan Barang Terlaris
                </h1>
            </div><!-- /.page-header -->
            <html>
<head>
    
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <canvas id="chart"></canvas>

    <?php
    // Koneksi ke database
    $koneksi = mysqli_connect("localhost", "root", "", "tokohadi");

    // Memperoleh data barang dari tabel
    $query = "SELECT * FROM barang order by jumlah desc";
    $result = mysqli_query($koneksi, $query);

    // Mengambil data dari hasil query
    $labels = array();
    $jumlah = array();
    $total = array();
    while ($row = mysqli_fetch_assoc($result)) {
        $labels[] = $row['nama'];
        $jumlah[] = $row['jumlah'];
        $total[] = $row['total_barang'];
    }

    // Menutup koneksi database
    mysqli_close($koneksi);
    ?>

    <script>
        // Data barang dari PHP
        var labels = <?php echo json_encode($labels); ?>;
        var jumlah = <?php echo json_encode($jumlah); ?>;
        var total = <?php echo json_encode($total); ?>;

        // Menggambar chart menggunakan Chart.js
        var ctx = document.getElementById('chart').getContext('2d');

        var chart = new Chart(ctx, {
        
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Jumlah Barang',
                    data: jumlah,
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                }]
            },
            options: {
    plugins: {
      legend: {
        display: true,
        position: "bottom",
        labels: {
          boxWidth: 20,
          color: "black",
          font: {
            size: 12,
            weight: "bold"
          }
        }
      },
      tooltip: {
        cornerRadius: 0,
        caretSize: 0,
        padding: 10,
        backgroundColor: 'black',
        borderColor: "gray",
        borderWidth: 5,
        titleMarginBottom: 4,
        titleFont: {
          "weight": "bold",
          "size": 22
        }
      }
    }
  }
});
        
    </script>
</body>
</html>
            <div class="row">
                <div class="col-xs-12">
                    <!-- PAGE CONTENT BEGINS -->


                    <div class="row">
                        <center>
                            
                        </center>

                    </div><!-- /.row -->

                    <div class="hr hr32 hr-dotted"></div>
<td></td>
                    <!-- PAGE CONTENT ENDS -->
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.page-content -->
    </div>
</div><!-- /.main-content -->
