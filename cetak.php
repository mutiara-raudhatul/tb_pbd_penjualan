<?php 

    include("config.php"); 
?>

<!DOCTYPE html>
<html>
<head>
    <title>Program Penjualan | Sasuai Swalayan</title>
    <link rel="stylesheet" type="text/css" href="styles.css">

    <style type="text/css">
        hr {
        display: block;
        margin-top: 0.5em;
        margin-bottom: 0.5em;
        margin-left: auto;
        margin-right: auto;
        border-style: inset;
        border-width: 1px;
        }
        th{
          padding: 8px;
          text-align: left;
          border-top: 1px solid #ddd;
          border-bottom: 1px solid #ddd;
        }
    </style>
</head>

<body>
        <?php

        if (isset($_POST['submit'])) {
            $date1 = $_POST['date1'];
            $date2 = $_POST['date2'];

            if (!empty($date1) && !empty($date2)) {
                // perintah tampil data berdasarkan range tanggal
                $sqlfilter = "SELECT * FROM transaksi_penjualan WHERE tanggal_transaksi BETWEEN '$date1' and '$date2'";
                $query = mysqli_query($db, $sqlfilter);
                ?> 
                <div id="logo">
                    <img src="logo.jpg">
                </div>
                <div id="judul">
                    <h3>LAPORAN PENJUALAN REKAP
                        <div id="info-periode">
                            <?php 
                                echo "Periode : ".date('d/m/y', strtotime($date1))."-".date('d/m/y', strtotime($date2));
                            ?>
                        </div>
                    <br>Sasuai Swalayan
                    <br>Jl. Soekarno Hatta
                    <br>Gantiang
                    </h3>  
                </div>
                <br>

            <table>
            <thead align="center" >
                 <tr>
                    <th width="60px">Nomor Transaksi</th>
                    <th width="80px">Tanggal Transaksi</th>
                    <th width="40px">Dept</th>
                    <th width="100px">Kode Pelanggan</th>
                    <th width="90px">Jumlah Item</th>
                    <th width="90px">Subtotal</th>
                    <th width="90px">Pot. %</th>
                    <th width="90px">Pajak %</th>
                    <th width="90px">Biaya Lain</th>
                    <th width="90px">Total Akhir</th>
                    <th width="90px">Bayar Tunai</th>
                    <th width="100px">Bayar Kredit</th>
                </tr>
            </thead>
            <tbody align="center">
                <?php
                $sqlsum = "SELECT sum(jumlah_item), sum(subtotal), sum(potongan*subtotal) as pot, sum((subtotal-(potongan*subtotal))*pajak) as paj, sum(biaya_lain), sum(subtotal-(potongan*subtotal)+((subtotal-(potongan*subtotal))*pajak)+biaya_lain) as total  FROM transaksi_penjualan WHERE tanggal_transaksi BETWEEN '$date1' AND '$date2'";
                $querysum = mysqli_query($db, $sqlsum);


                $i=1;
                while($data_jual = mysqli_fetch_array($query)){
                    echo "<tr>";
                        echo "<td>".$data_jual['no_transaksi_jual']."/".$data_jual['kode_jenis_transaksi']."/".$data_jual['kode_dept']."/".date('mY', strtotime($data_jual["tanggal_transaksi"]))."</td>";

                        echo "<td>".date('d/m/Y', strtotime($data_jual["tanggal_transaksi"]))."</td>";

                        echo "<td>".$data_jual['kode_dept']."</td>";
                        echo "<td>".$data_jual['kode_pelanggan']."</td>";
                        echo "<td>".$data_jual['jumlah_item'].".00</td>";
                        echo "<td>".$data_jual['subtotal'].".00</td>";
                        $pot=$data_jual['subtotal']*$data_jual['potongan'];

                        $persen=100;
                        echo "<td>".$data_jual['potongan']*$persen.".00</td>";

                        $paj=($data_jual['subtotal']-$pot)*$data_jual['pajak'];
                        echo "<td>".$data_jual['pajak']*$persen.".00</td>";
                        echo "<td>".$data_jual['biaya_lain'].".00</td>";

                        //total akhir
                        $total=$data_jual['subtotal']-$pot+$paj+$data_jual['biaya_lain'];
                        echo "<td>".$total."</td>";

                        //pembayaran
                        if ($data_jual['status_bayar']=='T'){
                            echo "<td>".$total.".00</td>";
                            echo "<td> 0 </td>";
                        } else if ($data_jual['status_bayar']=='K'){ 
                            echo "<td> 0 </td>";
                            echo "<td>".$total.".00</td>";
                        }
                    echo "</tr>";
                  
                $i++;          
                }
                $j=1;
                   while ($sum = mysqli_fetch_array($querysum)) {
                ?>            
            </tbody>
            </table >
            <hr>
                <div style="float: right; margin-right: 10%;">
            <table>
                <?php 
                    echo "<tr><td width='230px'><b><i> TOTAL KESELURUHAN <i></b></td>";
                    echo "<td align='right'> Jumlah Item </td><td width='150px' align='left'>: ".number_format($sum['sum(jumlah_item)']).".00</td></tr>";
                    echo "<tr><td></td><td align='right'> Subtotal </td><td align='left'>: Rp.".number_format($sum['sum(subtotal)']).".00</td></tr>";
                    echo "<tr><td></td><td align='right'> Potongan </td><td align='left'>: Rp.".number_format($sum['pot']).".00</td></tr>";
                    echo "<tr><td></td><td align='right'> Pajak </td><td align='left'>: Rp.".number_format($sum['paj']).".00</td></tr>";
                    echo "<tr><td></td><td align='right'> Biaya_lain </td><td align='left'>: Rp.".number_format($sum['sum(biaya_lain)']).".00</td></tr>";
                    echo "<tr><td></td><td align='right'> Total Akhir </td><td align='left'>: Rp.".number_format($sum['total']).".00</td></tr>";
                    
                    $sqltunai = "SELECT sum(subtotal-(potongan*subtotal)+((subtotal-(potongan*subtotal))*pajak)+biaya_lain) as tunai FROM transaksi_penjualan WHERE status_bayar='T' AND tanggal_transaksi BETWEEN '$date1' AND '$date2'";
                    $querytunai = mysqli_query($db, $sqltunai); 
                    while ($tunai = mysqli_fetch_array($querytunai)) {
                        echo "<tr><td width='200px'></td><td> Bayar Tunai </td><td>: Rp.".number_format($tunai['tunai']).".00</td></tr>";
                    }

                    $sqlkredit = "SELECT sum(subtotal-(potongan*subtotal)+((subtotal-(potongan*subtotal))*pajak)+biaya_lain) as kredit FROM transaksi_penjualan WHERE status_bayar='K' AND tanggal_transaksi BETWEEN '$date1' AND '$date2'";
                    $querykredit = mysqli_query($db, $sqlkredit);
                    while ($kredit = mysqli_fetch_array($querykredit)) {
                        echo "<tr><td width='200px'></td><td> Bayar Kredit </td><td>: Rp.".number_format($kredit['kredit']).".00</td></tr>";
                    }

                    $j++; 
                    } 
                 ?>            
                 </div>  
            </table>
        <?php 
            }
        } else {
             header('Location: list-data.php');
        }
        ?>        

    <script>
        window.print();
    </script>
    </body>
</html>