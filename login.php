<?php
session_start();

if ( isset($_SESSION['apriori_parfum_id']) ) {
    header("location:index.php");
}

$login = 0;
if (isset($_GET['login'])) {
    $login = $_GET['login'];
}

if ($login == 1) {
    $komen = "Silahkan Login Ulang, Cek username dan Password Anda!!";
}

include_once "fungsi.php";
?>

<!DOCTYPE html>
<html lang="en">
    <head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
        <meta charset="utf-8" />
        <title>Toko H. Hadi</title>
        <link href="assets/images/icon/ok.gif" rel="shortcut icon" />
        <meta name="description" content="overview &amp; stats" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />

        <!-- bootstrap & fontawesome -->
        <link rel="stylesheet" href="assets/css/bootstrap.min.css" />
        <link rel="stylesheet" href="assets/font-awesome/4.5.0/css/font-awesome.min.css" />

        <!-- page specific plugin styles -->

        <!-- text fonts -->
        <link rel="stylesheet" href="assets/css/fonts.googleapis.com.css" />

        <!-- ace styles -->
        <link rel="stylesheet" href="assets/css/ace.min.css" class="ace-main-stylesheet" id="main-ace-style" />

        <!--[if lte IE 9]>
                <link rel="stylesheet" href="assets/css/ace-part2.min.css" class="ace-main-stylesheet" />
        <![endif]-->
        <link rel="stylesheet" href="assets/css/ace-skins.min.css" />
        <link rel="stylesheet" href="assets/css/ace-rtl.min.css" />

        <!--[if lte IE 9]>
          <link rel="stylesheet" href="assets/css/ace-ie.min.css" />
        <![endif]-->

        <!-- inline styles related to this page -->

        <!-- ace settings handler -->
        <script src="assets/js/ace-extra.min.js"></script>

        <!-- HTML5shiv and Respond.js for IE8 to support HTML5 elements and media queries -->

        <!--[if lte IE 8]>
        <script src="assets/js/html5shiv.min.js"></script>
        <script src="assets/js/respond.min.js"></script>
        <![endif]-->
        <style>
        img {
            max-width: 40%;
            height: 50;
            margin-left: 80px;
        }
        .login-form-border {
        border: 1px solid #ccc;
        padding: 20px;
        border-radius: 5px;
    }
    .col-sm-6 {
        width: 300px;
        text-align: right;
    }

    .header {
        text-align: center;
        margin-top: 0;
    }

    .well {
        background-color: #f5f5f5;
        border: 1px solid #ccc;
        padding: 10px;
        border-radius: 5px;
    }

    .form-group {
        margin-bottom: 10px;
    }

    .form-control {
        width: 100%;
        padding: 5px;
        font-size: 12px;
        border-radius: 4px;
        border: 1px solid #ccc;
    }

    .btn-primary {
        background-color: #007bff;
        border-color: #007bff;
        color: #fff;
        padding: 5px;
        font-size: 12px;
        border-radius: 4px;
    }

    .btn-primary:hover {
        background-color: #0069d9;
        border-color: #0062cc;
    }
    .carousel-inner {
        max-width: 600px; /* Menentukan lebar maksimum container slide show */
        margin: 0 auto; /* Mengatur margin untuk membuat slide show berada di tengah */
    }
    
    .carousel-inner .item {
        text-align: center; /* Mengatur posisi gambar menjadi di tengah */
    }
    
    .carousel-inner img {
        max-width: 100%; /* Menyesuaikan lebar gambar agar tidak melebihi container */
        height: auto; /* Mengatur tinggi gambar sesuai proporsi */
    }
    .position-relative {
    display: flex;
    flex-direction: column;
}
.form-wrapper {
    position: absolute;
    top: 0;
    right: 0;
    margin-top: 20px; /* Sesuaikan dengan jarak yang diinginkan */
    margin-right: 20px; /* Sesuaikan dengan jarak yang diinginkan */
}
.col-sm-7 {
    /* Tambahkan gaya lain yang diperlukan */
}

.slideshow-wrapper {
    margin-top: 20px; /* Atur jarak antara elemen "Toko H. Hadi" dan slide show */
    /* Tambahkan gaya lain yang diperlukan */
}

.slideshow-container {
    /* Tambahkan gaya lain yang diperlukan */
}

.mySlides {
    /* Tambahkan gaya lain yang diperlukan */
}
.slideshow-wrapper {
  text-align: center;
}

.slideshow-container {
  display: inline-block;
  position: relative;
}

.mySlides {
  display: none;
}

.slideshow-container img {
  display: block;
  margin-left: auto;
  margin-right: auto;
}
    </style>
    </head>

    <body class="no-skin">
        <!--HEADER-->
        <?php
        include "header.php";
        ?>
        <div class="main-container ace-save-state" id="main-container">
            <script type="text/javascript">
                try {
                    ace.settings.loadState('main-container')
                } catch (e) {
                }
            </script>
<!-- Modal Lupa Password -->
<div class="modal fade" id="forgotPasswordModal" tabindex="-1" role="dialog" aria-labelledby="forgotPasswordModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="forgotPasswordModalLabel">Lupa Password</h4>
            </div>
            <div class="modal-body">
                <!-- Isi form lupa password di sini -->
                <!-- Contoh: -->
                <form method="post" action="forgot_password.php">
                    <!-- Tambahkan input dan tombol submit di sini -->
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal Daftar Baru -->
<div class="modal fade" id="registerModal" tabindex="-1" role="dialog" aria-labelledby="registerModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="registerModalLabel">Daftar Baru</h4>
            </div>
            <div class="modal-body">
                <!-- Isi form daftar baru di sini -->
                <!-- Contoh: -->
                <form method="post" action="register.php">
                    <!-- Tambahkan input dan tombol submit di sini -->
                </form>
            </div>
        </div>
    </div>
</div>

            <!--CONTENT MAIN-->
            <div class="main-content">
    <div class="main-content-inner">
        <div class="position-relative">
            <div class="col-sm-4">
                <h1 style="text-align: center;">TOKO H. HADI</h1>
                <p class="lead" style="text-align: justify;">
                Menyediakan berbagai jenis barang kebutuhan sehari-hari, seperti makanan ringan, minuman, bumbu dapur, peralatan rumah tangga, produk kebersihan, dan barang-barang sehari-hari lainnya. Dengan harga yang terjangkau
                </p>
            </div>

            <div class="slideshow-wrapper">
                <div class="slideshow-container" style="margin-top: -160px;">
                    <div class="mySlides">
                        <img src="gambar1.jpg" alt="Gambar 1" style="width:800px;">
                    </div>

                    <div class="mySlides">
                        <img src="gambar3.jpeg" alt="Gambar 2" style="width:800px;">
                    </div>

                    <div class="mySlides">
                        <img src="gambar2.jpg" alt="Gambar 3" style="width:800px;">
                    </div>
                </div>
            </div>


            <script>
                var slideIndex = 0;
                showSlides();

                function showSlides() {
                    var i;
                    var slides = document.getElementsByClassName("mySlides");
                    for (i = 0; i < slides.length; i++) {
                        slides[i].style.display = "none";
                    }
                    slideIndex++;
                    if (slideIndex > slides.length) {
                        slideIndex = 1;
                    }
                    slides[slideIndex - 1].style.display = "block";
                    setTimeout(showSlides, 3000); // Ganti gambar setiap 3 detik
                }
            </script>
        </div>

        <div class="form-wrapper" style="float: right; margin-top:100px; margin-bottom: 40px; margin-right: 20px;">
            <div id="login-box" class="login-box visible widget-box no-border" style="border: 1px solid #ccc; padding: 10px; width: 400px; margin-top:100px;">
                <div class="widget-body">
                    <div class="widget-main">
                        <p style="text-align: center; font-family: 'Times New Roman', Times, serif; font-size:24px;">Silahkan Login</p>
                        <?php
                            if (isset($komen)) {
                                display_error("Password atau Username salah");
                            }
                        ?>
                        <form method="post" action="cek-login.php">
                            <fieldset>
                                <div class="form-group">
                                    <span class="block input-icon input-icon-right">
                                        <input type="text" class="form-control" name="username" placeholder="Username" />
                                        <i class="ace-icon fa fa-user"></i>
                                    </span>
                                </div>
                                <div class="form-group">
                                    <span class="block input-icon input-icon-right">
                                        <input type="password" class="form-control" name="password" placeholder="Password" />
                                        <i class="ace-icon fa fa-key"></i>
                                    </span>
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary btn-block">
                                        <i class="ace-icon fa fa-sign-in"></i>
                                        Login
                                    </button>
                                </div>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
            <div class="form-group">
    <a href="lupa_password.php" data-toggle="modal" data-target="#forgotPasswordModal">Lupa password?</a>
</div>
<div class="form-group">
    <a href="daftar.php" data-toggle="modal" data-target="#registerModal">Daftar baru</a>
</div>
        
    </div>
</div>

            <!--FOOTER-->
            <?php
            include "footer.php";
            ?>

            <a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-sm btn-inverse">
                <i class="ace-icon fa fa-angle-double-up icon-only bigger-110"></i>
            </a>
        </div><!-- /.main-container -->

        <!-- basic scripts -->

        <!--[if !IE]> -->
        <script src="assets/js/jquery-2.1.4.min.js"></script>

        <!-- <![endif]-->

        <!--[if IE]>
<script src="assets/js/jquery-1.11.3.min.js"></script>
<![endif]-->
        <script type="text/javascript">
                if ('ontouchstart' in document.documentElement)
                    document.write("<script src='assets/js/jquery.mobile.custom.min.js'>" + "<" + "/script>");
        </script>
        <script src="assets/js/bootstrap.min.js"></script>

        <!-- page specific plugin scripts -->

        <!--[if lte IE 8]>
          <script src="assets/js/excanvas.min.js"></script>
        <![endif]-->
        <script src="assets/js/jquery-ui.custom.min.js"></script>
        <script src="assets/js/jquery.ui.touch-punch.min.js"></script>
        <script src="assets/js/jquery.easypiechart.min.js"></script>
        <script src="assets/js/jquery.sparkline.index.min.js"></script>
        <script src="assets/js/jquery.flot.min.js"></script>
        <script src="assets/js/jquery.flot.pie.min.js"></script>
        <script src="assets/js/jquery.flot.resize.min.js"></script>

        <!-- ace scripts -->
        <script src="assets/js/ace-elements.min.js"></script>
        <script src="assets/js/ace.min.js"></script>

        
    </body>
</html>


