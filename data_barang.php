<?php
//session_start();
if (!isset($_SESSION['apriori_toko_id'])) {
    header("location:index.php?menu=forbidden");
}

include_once "database.php";
include_once "fungsi.php";
include_once "mining.php";
?>
<div class="main-content">
    <div class="main-content-inner">
        <div class="page-content">
            <div class="page-header">
                <h1>
                    Data Barang
                </h1>
            </div><!-- /.page-header -->
<?php
//object database class
$db_object = new database();

$pesan_error = $pesan_success = "";
if(isset($_GET['pesan_error'])){
    $pesan_error = $_GET['pesan_error'];
}
if(isset($_GET['pesan_success'])){
    $pesan_success = $_GET['pesan_success'];
}

$sql = "SELECT
        *
        FROM
         barang ";
$query=$db_object->db_query($sql);
$jumlah=$db_object->db_num_rows($query);
?>

<div class="row">
    <div class="col-sm-12">
        <div class="widget-box">
            <div class="widget-body">
                <div class="widget-main">
<!--            <form method="post" action="">
                <div class="form-group">
                    <input name="submit" type="submit" value="Proses" class="btn btn-success">
                </div>
            </form>-->

            <?php
            if (!empty($pesan_error)) {
                display_error($pesan_error);
            }
            if (!empty($pesan_success)) {
                display_success($pesan_success);
            }


            //echo "Jumlah data: ".$jumlah."<br>";
            if($jumlah==0){
                    echo "Data kosong...";
            }
            else{
            ?>
            <?php
            }
            ?>
             <?php
if(isset($_GET['kode'])){
    // $sql = "TRUNCATE transaksi";
    // $db_object->db_query($sql);
    // echo "delete broooo";
    $sql = "delete
            FROM
             barang where id='$_GET[kode]'";
    $query=$db_object->db_query($sql);
    echo "<h2 class='text-danger'>Data Telah Terhapus</h2> <br>";
    echo "<meta http-equiv=refresh content=2;URL='index.php?menu=data_barang'>";
    // $jumlah=$db_object->db_num_rows($query);
}


?>
<?php

if( isset($_POST['edit'])){
    // $sql = "TRUNCATE transaksi";
    // $db_object->db_query($sql);

    echo "<h2 class='text-danger'>Data Telah DI EDIT</h2> <br>";
    $sql = "
    UPDATE barang
    SET nama='$_POST[barangedit]'
    WHERE id='$_POST[idedit]'";
    $query=$db_object->db_query($sql);
    // echo "<h2 class='text-danger'>Data Telah DI EDIT</h2> <br>";
    echo "<meta http-equiv=refresh content=2;URL='index.php?menu=data_barang'>";
    $jumlah1=$db_object->db_num_rows($query);
}

?>
<style>
.aksi-col {
  width: 120px; /* Ubah nilai 100px sesuai dengan kebutuhan Anda */
}
</style>
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter">
  TAMBAH BARANG
</button>
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Tambah Barang</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form action="" method="post">
    <div class="form-group">
    <label for="exampleInputPassword1">Nama Barang</label>
    <input type="text" name="transaksi" class="form-control" id="exampleInputPassword1" placeholder="Masukan Nama Barang....">
  </div>
  </div>
<div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
    <button type="submit" name="proses" class="btn btn-primary">Save changes</button>
</div>
</form>
    </div>
  </div>
</div>

            <table class='table table-bordered table-striped  table-hover'>
                <tr>
                <th>No</th>
                <th>Nama Barang</th>
                <th>Aksi</th>
             
                
                </tr>
                <?php
                    $no=1;
                    while($row=$db_object->db_fetch_array($query)){
//                       
                            echo "<tr>";
                            echo "<td>".$no."</td>";
                            echo "<td>".($row['nama'])."</td>";
                            echo "<td class='aksi-col'><form method='post'><center>
                            <a href='?menu=data_barang&kode=".$row['id']."'  class='btn btn-danger m-3 btn-xs' >
                            Hapus</a><a class='btn btn-warning btn-xs' data-toggle='modal'  data-target='#modal".$row['id']."'>
                            Edit</a></center></form></td>";
                        
                           
                        echo "</tr>";
                        $no++;
                    
                    ?>
                    <form action="" method="post">
                        <div class="modal fade" id="modal<?php echo $row['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenter2Title" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Edit Barang</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form action="/lontong.php" method="get">
    <div class="form-group">
    <label for="exampleInputPassword1">Nama Barang</label>
    <input type="text" name="barangedit" value="<?php echo $row['nama'] ?>" class="form-control" id="exampleInputPassword1" placeholder="Masukan Nama barang">
  </div>
  <input type="hidden" id="custId" name="idedit" value="<?php echo $row['id'] ?>">

  <div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
    <button value="submit" type="submit" name="edit" class="btn btn-primary">Save changes</button>
</div>
</form>
</div>

<?php
}
?>
            </table>
            
           
<?php
    if(isset($_POST['proses'])){
    
        $sql = "INSERT INTO barang set nama = '$_POST[transaksi]'";
    $db_object->db_query($sql);
    }
        ?>
  
                </div>
            </div>
        </div>
    </div>
</div>
