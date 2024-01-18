<?php
//session_start();
if (!isset($_SESSION['apriori_parfum_id'])) {
    header("location:index.php?menu=forbidden");
}

include_once "database.php";
include_once "fungsi.php";
include_once "import/excel_reader2.php";
?>
<div class="main-content">
    <div class="main-content-inner">
        <div class="page-content">
            <div class="page-header">
                <h1>
                    Data Transaksi
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

if(isset($_POST['submit'])){
    // if(!$input_error){
    $data = new Spreadsheet_Excel_Reader($_FILES['file_data_transaksi']['tmp_name']);

        $baris = $data->rowcount($sheet_index=0);
        $column = $data->colcount($sheet_index=0);
        //import data excel dari baris kedua, karena baris pertama adalah nama kolom
        // $temp_date = $temp_produk = "";
        for ($i=2; $i<=$baris; $i++) {
            for($c=1; $c<=$column; $c++){
                $value[$c] = $data->val($i, $c);
            }

            // if($i==2){
            //     $temp_produk .= $value[3];
            // }
            // else{
            //     if($temp_date == $value[1]){
            //         $temp_produk .= ",".$value[3];
            //     }
            //     else{
                    $table = "transaksi";
                    // $produkIn = get_produk_to_in($temp_produk);
                    $temp_date = format_date($value[1]);
                    $produkIn = $value[2];
                    
                    //mencegah ada jarak spasi
                    $produkIn = str_replace(" ,", ",", $produkIn);
                    $produkIn = str_replace("  ,", ",", $produkIn);
                    $produkIn = str_replace("   ,", ",", $produkIn);
                    $produkIn = str_replace("    ,", ",", $produkIn);
                    $produkIn = str_replace(", ", ",", $produkIn);
                    $produkIn = str_replace(",  ", ",", $produkIn);
                    $produkIn = str_replace(",   ", ",", $produkIn);
                    $produkIn = str_replace(",    ", ",", $produkIn);
                    //$item1 = explode(",", $produkIn);
                    
                    
//                    $field_value = array("transaction_date"=>($temp_date),
//                        "produk"=>$produkIn);
//                    $query = $db_object->insert_record($table, $field_value);
//                    INSERT INTO transaksi (transaction_date, produk)
//                    VALUES
//                    ('2016-06-01', 'nipple pigeon L'),
//                    ('2016-06-01', 'nipple ninio'),
//                    ('2016-06-01', 'mamamia L36'),
//                    ('2016-06-01', 'sweety FP XL34')
                    $sql = "INSERT INTO transaksi (transaction_date, produk) VALUES ";
                    $value_in = array();
                    //foreach ($item1 as $key => $isi) {
                      //  $value_in[] = "('$temp_date' , '$isi' )";
                    //}
                    //$value_to_sql_in = implode(",", $value_in);
                    //$sql .= $value_to_sql_in;
                    $sql .= " ('$temp_date', '$produkIn')";
                    $db_object->db_query($sql);

            //         $temp_produk = $value[3];
            //     }
            // }
            
            // $temp_date = $value[1];
        }
        ?>
        <script> location.replace("?menu=data_transaksi&pesan_success=Data berhasil disimpan"); </script>
        <?php
}

if(isset($_POST['delete'])){
    $sql = "TRUNCATE transaksi";
    $db_object->db_query($sql);
    ?>
        <script> location.replace("?menu=data_transaksi&pesan_success=Data transaksi berhasil dihapus"); </script>
        <?php
}

$sql = "SELECT
        *
        FROM
         transaksi";
$query=$db_object->db_query($sql);
$jumlah1=$db_object->db_num_rows($query);

?>     
<style>
  .table td {
    font-size: 12px; /* Ubah ukuran font sesuai kebutuhan */
  }
</style>       
<form action="upload.php" method="post" enctype="multipart/form-data">
  <input type="file" name="excel_file">
  <input type="submit" value="Upload">
</form>

<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter">
  TAMBAH TRANSAKSI
</button>

<!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Tambah Transaksi</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form action="" method="post">
  <div class="form-group">
    <label for="exampleInputEmail1">Tanggal Transaksi</label>
    <input type="date" name="tanggal" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Nama Barang</label>
    <input type="text" name="transaksi" class="form-control" id="exampleInputPassword1" placeholder="Contoh: Gula,Kopi,Tepung,dll ....">
  </div>

  <div class="">
    <?php
    $sql1 = "SELECT
    *
    FROM
     barang";

    $query2=$db_object->db_query($sql1);
    // $row2=$db_object->db_fetch_array($query2)
    $no=0;
    while($row2=$db_object->db_fetch_array($query2)){
        $no++;
           
    }
    ?>
  
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
<?php
    if(isset($_POST['proses'])){
        while ($a <= 2) {
            $a++;
            // echo "<h1>$_POST[barangs".(string)$a."]</h1>";
            // echo "$a";
        }
        $sql = "INSERT INTO transaksi set transaction_date = '$_POST[tanggal]', produk ='$_POST[transaksi]'";
    $db_object->db_query($sql);
include 'mining.php';
    $sql_trans = "SELECT * FROM transaksi";
    $result_trans = $db_object->db_query($sql_trans);
    $dataTransaksi = $item_list = array();
    $jumlah_transaksi = $db_object->db_num_rows($result_trans);
   
    $x=0;
    while($myrow = $db_object->db_fetch_array($result_trans)){
        $dataTransaksi[$x]['tanggal'] = $myrow['transaction_date'];
        $item_produk = $myrow['produk'].",";
        //mencegah ada jarak spasi
        $item_produk = str_replace(" ,", ",", $item_produk);
        $item_produk = str_replace("  ,", ",", $item_produk);
        $item_produk = str_replace("   ,", ",", $item_produk);
        $item_produk = str_replace("    ,", ",", $item_produk);
        $item_produk = str_replace(", ", ",", $item_produk);
        $item_produk = str_replace(",  ", ",", $item_produk);
        $item_produk = str_replace(",   ", ",", $item_produk);
        $item_produk = str_replace(",    ", ",", $item_produk);
        
        $dataTransaksi[$x]['produk'] = $item_produk;
        $produk = explode(",", $myrow['produk']);
        //all items
        foreach ($produk as $key => $value_produk) {
            //if(!in_array($value_produk, $item_list)){
            if(!in_array(strtoupper($value_produk), array_map('strtoupper', $item_list))){
                if(!empty($value_produk)){
                    $item_list[] = $value_produk;
                }
            }
        }
        $x++;
    }
    
    
    //build itemset 1
    // echo "<br><strong>Itemset 1:</strong><br>";
    // echo "<table class='table table-bordered table-striped  table-hover'>
    //         <tr>
    //             <th>No</th>
    //             <th>Item</th>
    //             <th>Jumlah</th>
    //             <th>Suppport</th>
    //             <th>Keterangan</th>
    //         </tr>";
    $itemset1 = $jumlahItemset1 = $supportItemset1 = $valueIn = array();
    $x=1;
    
    foreach ($item_list as $key => $item) {
        $jumlah = jumlah_itemset1($dataTransaksi, $item);
        $support = ($jumlah/$jumlah_transaksi) * 100;
        $lolos = ($support>=$min_support)?"1":"0";
        // $valueIn[] = "('$item','$jumlah','$support','$lolos','$id_process')";
        $valuekon[] = "('$item','$jumlah')";
        if($lolos){
            $itemset1[] = $item;//item yg lolos itemset1
            $jumlahItemset1[] = $jumlah;
            $supportItemset1[] = $support;
        }
        echo '<script>console.log("' . $item . '");</script>';
        // echo "<tr>";
        // echo "<td>" . $x . "</td>";
        // echo "<td>" . $item . "</td>";
        // echo "<td>" . $jumlah . "</td>";
        // echo "<td>" . price_format($support) . "</td>";
        // echo "<td>" . (($lolos==1)?"Lolos":"Tidak Lolos") . "</td>";
        // echo "</tr>";
        $x++;
    }
    
    // echo "</table>";
    //insert into itemset1 one query with many value
    // $value_insert = implode(",", $valueIn);
    $value_kont = implode(",", $valuekon);
    
    
    $sql_insert_itemset1 = "DELETE from barang";
    $db_object->db_query($sql_insert_itemset1);
    $sql_insert_itemsetkont = "INSERT INTO barang (nama, jumlah) "
            . " VALUES ".$value_kont;
            $db_object->db_query($sql_insert_itemsetkont);

   
}
?>
<!-- <div class="row">
    <div class="col-sm-4">
        <div class="widget-box">
        <form method="post" enctype="multipart/form-data" action="">
            <div class="widget-body">
                <div class="widget-main">
                    <div class="form-group">
                        <input type="file" id="id-input-file-2" name="file_data_transaksi"/>

                        <button name="submit" type="submit" value="" class="btn btn-app btn-purple btn-sm">
                            <i class="ace-icon fa fa-cloud-upload bigger-200"></i> Upload
                        </button>
                        <button name="delete" type="submit"  class="btn btn-app btn-danger btn-sm" 
                                onclick="return confirm('Are you sure?')" >
                            <i class="ace-icon fa fa-trash-o bigger-200"></i> Delete
                        </button>
                    </div>
                </div>
            </div>
        </form>
        </div>
    </div>
</div> -->

            <div class="row">
                <div class="col-sm-12">
                <div class="widget-box">
                    <div class="widget-body">
                    <div class="widget-main">
                    <?php
if(isset($_GET['kode'])){
    // $sql = "TRUNCATE transaksi";
    // $db_object->db_query($sql);
    // echo "delete broooo";
    $sql = "delete
            FROM
             transaksi where id='$_GET[kode]'";
    $query=$db_object->db_query($sql);
    echo "<h2 class='text-danger'>Data Telah Terhapus</h2> <br>";
    echo "<meta http-equiv=refresh content=2;URL='index.php?menu=data_transaksi'>";
    // $jumlah=$db_object->db_num_rows($query);
}

?>

<?php

if( isset($_POST['edit'])){
    // $sql = "TRUNCATE transaksi";
    // $db_object->db_query($sql);

    echo "<h2 class='text-danger'>Data Telah DI EDIT</h2> <br>";
    $sql = "
    UPDATE transaksi
    SET transaction_date='$_POST[tanggaledit]', produk='$_POST[transaksiedit]'
    WHERE id='$_POST[idedit]'";
    $query=$db_object->db_query($sql);
    // echo "<h2 class='text-danger'>Data Telah DI EDIT</h2> <br>";
    echo "<meta http-equiv=refresh content=2;URL='index.php?menu=data_transaksi'>";
    $jumlah1=$db_object->db_num_rows($query);
}

?>

            <?php
            if (!empty($pesan_error)) {
                display_error($pesan_error);
            }
            if (!empty($pesan_success)) {
                display_success($pesan_success);
            }

            echo "Jumlah data: ".$jumlah1."<br>";
            if($jumlah1==0){
                echo "Data kosong...";
            }
            else{
            ?>
            <table class='table table-bordered table-striped  table-hover'>
                <tr>
                <th>No</th>
                <th>Tanggal</th>
                <th>Produk</th>
                <th>Aksi</th>
                </tr>
                <?php
                    $no=1;
                    while($row=$db_object->db_fetch_array($query)){
                        echo "<tr>";
                            echo "<td>".$no."</td>";
                            echo "<td>".format_date2($row['transaction_date'])."</td>";
                            echo "<td>".$row['produk']."</td>";
                            echo "<td><form method='post'><center><a href='?menu=data_transaksi&kode=".$row['id']."'  class='btn btn-danger m-3 btn-xs'>Hapus</a><a class='btn btn-warning btn-xs' data-toggle='modal'  data-target='#modal".$row['id']."'>Edit</a></center></form></td>";
                        echo "</tr>";
                        $no++;
                        ?>
                        <form action="" method="post">
                        <div class="modal fade" id="modal<?php echo $row['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenter2Title" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Edit Transaksi</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form action="/lontong.php" method="get">
  <div class="form-group">
    <label for="exampleInputEmail1">Tanggal Transaksi</label>
    <input type="date" value="<?php echo $row['transaction_date'] ?>" name="tanggaledit" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Nama Barang</label>
    <input type="text" name="transaksiedit" value="<?php echo $row['produk'] ?>" class="form-control" id="exampleInputPassword1" placeholder="Contoh: Gula,Kopi,Tepung,dll ....">
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
            }
            ?>
            </div>
            </div>
                    </div>
            </div>
                </div>
        </div>
    </div>
</div>



<?php
function get_produk_to_in($produk){
    $ex = explode(",", $produk);
    //$temp = "";
    for ($i=0; $i < count($ex); $i++) { 

        $jml_key = array_keys($ex, $ex[$i]);
        if(count($jml_key)>1){
            unset($ex[$i]);
        }

        //$temp = $ex[$i];
    }
    return implode(",", $ex);
}

?>
  