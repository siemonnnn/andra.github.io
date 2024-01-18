

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<style>
    .text-left {
        font-family: Times, sans-serif;
        font-size: 17px;
        text-align: justify;
        margin: 0 auto;
        max-width: 100%;
        width: 66%;
        font-weight: bold;
    }

    .image-left {
        position: fixed;
        left: 0;
        top: 0;
        margin: 10px 10px 10px 40px;
        width: 45px;
    }
    .marquee {
        position: fixed;
        top: 10px;
        right: 10px;
        font-family: Times, sans-serif;
        font-size: 18px;
        color: #ffffff;
        width: 200px; /* Ubah lebar sesuai kebutuhan */
        overflow: hidden;
        white-space: nowrap;
    }
</style>

<div id="navbar" class="navbar position-sticky">
    <div class="navbar-container position-sticky" id="navbar-container">
        <button type="button" class="navbar-toggle menu-toggler pull-left" id="menu-toggler" data-target="#sidebar">
            <span class="sr-only">Toggle sidebar</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <div class="navbar-header pull-left position-sticky">
            <a href="index.php" class="navbar-brand">
                <p class="text-left">
                    <img src="Unisla.png" alt="Gambar Anda" class="image-left">
                    IMPLEMENTASI METODE DATA MINING MARKET BASKET ANALYSIS UNTUK SISTEM PREDIKSI ITEMSET KEMUNGKINAN PENJUALAN BARANG MENGGUNAKAN ALGORITMA APRIORI
                </p>
            </a>
        </div>
    </div><!-- /.navbar-container -->

    <marquee class="marquee"><?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();

}

// Periksa apakah session 'apriori_parfum_username' ada dan bukan kosong
if (isset($_SESSION['apriori_parfum_username']) && !empty($_SESSION['apriori_parfum_username'])) {
    $username = $_SESSION['apriori_parfum_username'];
    echo 'HALOO ' . $username . '  :)';
}
?></marquee>
</div>