<?php 
    include("config.php"); 
    include("header.php"); 

    if (isset($_POST['submitdel'])) {
      if(isset($_POST['aksi']) && $_POST['aksi']=='hapus'){

        $sql = "DELETE FROM transaksi_penjualan WHERE no_transaksi_jual=?";
        if($stmt = mysqli_prepare($db, $sql)){
          mysqli_stmt_bind_param($stmt, "i", $no_transaksi_jual);
          $no_transaksi_jual = trim($_POST["no_transaksi_jual"]);
  
          if(mysqli_stmt_execute($stmt)){
            $message_sukses="Data berhasil dihapus";
          } else{
            $message_gagal="Data gagal dihapus";
          }
        }
      }
    }
?>

<!DOCTYPE html>
<html>
<head>
    <title>Program Penjualan | Sasuai Swalayan</title>
<!--     <link rel="stylesheet" type="text/css" href="styles.css"> -->
    
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <style type="text/css">
        th{
          padding: 8px;
          text-align: left;
          border-top: 1px solid #ddd;
          border-bottom: 1px solid #ddd;
        }
    </style>
</head>

<body>
    <div style="margin-left: 3%; margin-right: 3%;">
    <header>
        <h3>Data Rekap Penjualan</h3>
    </header>

    <div id="menu">
        <nav>
            <a href="form-tambah.php"><button class="btn btn-primary">[+] Tambah Baru</button></a> <br>
        </nav>
    </div>
    
    <div id="form-periode">
        <form method="POST" action="cetak.php" target="_blank" >
                <label for="date1">Periode Awal </label>
                <input type="date" name="date1" id="date1" required="required">
                <label for="date2">Akhir </label>
                <input type="date" name="date2" id="date2" required="required">
                <button type="submit" name="submit" class='btn btn-secondary'>Cetak</button> 
        </form>    
    </div>

    <br>

    <table class="table table-hover">
        <?php if(isset($message_sukses)){ ?>
          <div class="alert alert-success" role="alert">
            <?php echo $message_sukses; ?>
          </div>
        <?php } else if (isset($message_gagal)){ ?>
          <div class="alert alert-danger" role="alert">
            <?php echo $message_gagal; ?>
          </div>
        <?php } ?>
    <thead align="center" >
        <tr>
            <th width="20px">No</th>
            <th width="190px">Nomor Transaksi</th>
            <th width="80px">Tanggal Transaksi</th>
            <th width="30px">Dept</th>
            <th width="100px">Kode Pelanggan</th>
            <th width="60px">Jumlah Item</th>
            <th width="90px">Subtotal</th>
            <th width="70px">Pot. %</th>
            <th width="80px">Pajak %</th>
            <th width="70px">Biaya Lain</th>
            <th width="80px">Total Akhir</th>
            <th width="80px">Bayar Tunai</th>
            <th width="80px">Bayar Kredit</th>
            <th width="150px">Aksi</th>
        </tr>
    </thead>
    <tbody align="center">
        <?php
        $sql = "SELECT * FROM transaksi_penjualan";
        $sqlsum = "SELECT sum(jumlah_item), sum(subtotal), sum(potongan*subtotal) as pot, sum((subtotal-(potongan*subtotal))*pajak) as paj, sum(biaya_lain), sum(subtotal-(potongan*subtotal)+((subtotal-(potongan*subtotal))*pajak)+biaya_lain) as total FROM transaksi_penjualan";
        $querysum = mysqli_query($db, $sqlsum); 
       
        if (isset($_POST['submit'])) {
            $date1 = $_POST['date1'];
            $date2 = $_POST['date2'];

            if (!empty($date1) && !empty($date2)) {
                // perintah tampil data berdasarkan range tanggal
                $sqlfilter = "SELECT * FROM transaksi_penjualan WHERE tanggal_transaksi BETWEEN '$date1' and '$date2'";
                $query = mysqli_query($db, $sqlfilter);

                                       
            } else {
                // perintah tampil semua data
                $query = mysqli_query($db, $sql);
            }
        } else {
         // perintah tampil semua data
          $query = mysqli_query($db, $sql);
        }

        
        $i=1;
        while($data_jual = mysqli_fetch_array($query)){
            echo "<tr>";
            
            echo "<td>".$i."</td>";
            echo "<td>".$data_jual['no_transaksi_jual']."/".$data_jual['kode_jenis_transaksi']."/".$data_jual['kode_dept']."/".date('mY', strtotime($data_jual["tanggal_transaksi"]))."</td>";

            echo "<td>".date('d/m/Y', strtotime($data_jual["tanggal_transaksi"]))."</td>";
                
 
            echo "<td>".$data_jual['kode_dept']."</td>";
            echo "<td>".$data_jual['kode_pelanggan']."</td>";
            echo "<td>".$data_jual['jumlah_item'].".00</td>";
            echo "<td>".$data_jual['subtotal']."</td>";
            $pot=$data_jual['subtotal']*$data_jual['potongan'];

            $persen=100;
            echo "<td>".$data_jual['potongan']*$persen.".00</td>";

            $paj=($data_jual['subtotal']-$pot)*$data_jual['pajak'];
            
            echo "<td>".$data_jual['pajak']*$persen.".00</td>";
            echo "<td>".$data_jual['biaya_lain']."</td>";

            //total akhir
            $total=$data_jual['subtotal']-$pot+$paj+$data_jual['biaya_lain'];
            echo "<td>".$total."</td>";

            //pembayaran
            if ($data_jual['status_bayar']=='T'){
                echo "<td>".$total."</td>";
                echo "<td> 0 </td>";
            } else if ($data_jual['status_bayar']=='K'){ 
                echo "<td> 0 </td>";
                echo "<td>".$total."</td>";
            }
            ?>
            <td>
                <form method="POST" action="list-data.php" onsubmit="return confirm('Apakah data ini akan dihapus?');">
                      <a href="form-edit.php?no_transaksi_jual=<?php echo $data_jual['no_transaksi_jual'] ?>" class='btn btn-success btn-sm'>Update</a>
                      <input type="hidden" name="aksi" value="hapus">
                      <input type="hidden" name="no_transaksi_jual" value="<?php echo $data_jual['no_transaksi_jual'] ?>">
                      <button type="submit" name="submitdel" class="btn btn-sm btn-danger">Delete</button>
                </form>
            </td>
            <!-- echo "<td>";
            echo "<a href='form-edit.php?no_transaksi_jual=".$data_jual['no_transaksi_jual']."' class='btn btn-success btn-sm'>Update</a>   |   ";
            echo "<a href='hapus.php?no_transaksi_jual=".$data_jual['no_transaksi_jual']."' class='btn btn-danger btn-sm'>Delete</a>";
            echo "</td>"; -->
        <?php 
            echo "</tr>";
            $i++; 
        }
        ?>
    </tbody>
    </table>
    <p><b>Total transaksi penjualan  : <?php echo mysqli_num_rows($query) ?> transaksi</b></p>
        <div >
            <table >
            <?php 
                $j=1;
                while ($sum = mysqli_fetch_array($querysum)) {
                    echo "<tr></tr>";
                    echo "<tr><td width='200px'><b> Total Keseluruhan :</b></td>";
                    echo "<td> Jumlah Item </td><td>: ".number_format($sum['sum(jumlah_item)'])."</td></tr>";
                    echo "<tr><td width='200px'></td><td> Subtotal </td><td>: Rp.".number_format($sum['sum(subtotal)'])."</td></tr>";
                    echo "<tr><td width='200px'></td><td> Potongan </td><td>: Rp.".number_format($sum['pot'])."</td></tr>";
                    echo "<tr><td width='200px'></td><td> Pajak </td><td>: Rp.".number_format($sum['paj'])."</td></tr>";
                    echo "<tr><td width='200px'></td><td> Biaya_lain </td><td>: Rp.".number_format($sum['sum(biaya_lain)'])."</td></tr>";
                    echo "<tr><td width='200px'></td><td> Total Akhir </td><td>: Rp.".number_format($sum['total'])."</td></tr>";

                    $sqltunai = "SELECT sum(subtotal-(potongan*subtotal)+((subtotal-(potongan*subtotal))*pajak)+biaya_lain) as tunai FROM transaksi_penjualan WHERE status_bayar='T'";
                    $querytunai = mysqli_query($db, $sqltunai); 
                    while ($tunai = mysqli_fetch_array($querytunai)) {
                        echo "<tr><td width='200px'></td><td> Bayar Tunai </td><td>: Rp.".number_format($tunai['tunai'])."</td></tr>";
                    }

                    $sqlkredit = "SELECT sum(subtotal-(potongan*subtotal)+((subtotal-(potongan*subtotal))*pajak)+biaya_lain) as kredit FROM transaksi_penjualan WHERE status_bayar='K'";
                    $querykredit = mysqli_query($db, $sqlkredit);
                    while ($kredit = mysqli_fetch_array($querykredit)) {
                        echo "<tr><td width='200px'></td><td> Bayar Kredit </td><td>: Rp.".number_format($kredit['kredit'])."</td></tr>";
                    }

                    $j++; 
                } 
            ?>
            </table>
            <br><br><br>
        </div>
            <?php if(isset($_GET['status'])): ?>
                <p>
                    <?php
                        if($_GET['status'] == 'sukses'){
                            echo "<script>
                                alert('Data berhasil ditambahkan');
                                document.location.href = 'list-data.php';
                                </script>";
                        } else {
                            echo "<script>
                                        alert('Data gagal ditambahkan');
                                        document.location.href = 'list-data.php';
                                        </script>";                
                        }
                    ?>
                </p>
            <?php endif; ?>    
    </div>
    </body>
</html>