<?php 
    include("config.php"); 
    include("header.php"); 
?>
<!DOCTYPE html>
<html>
<head>
    <title>Penambahan Data Penjualan</title>
    <link rel="stylesheet" type="text/css" href="style.css">

    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
</head>

<body>

    <?php 
        include("config.php");

        // mengambil data no_transaksi_jual dengan nomor paling besar
        $query = mysqli_query($db, "SELECT max(no_transaksi_jual) as nomorTerbesar FROM transaksi_penjualan");
        $data = mysqli_fetch_array($query);
        $nomorTransaksi = $data['nomorTerbesar'];
         
        if ($nomorTransaksi<100){
            // mengambil angka dari nomor transaksi terbesar, menggunakan fungsi substr
            // dan diubah ke integer dengan (int)
            $urutan = (int) substr($nomorTransaksi, 3, 3);
             
            // bilangan yang diambil ini ditambah 1 untuk menentukan nomor urut berikutnya
            $urutan++;
             
            // membentuk nomor transaksi baru
            // perintah sprintf("%05s", $urutan); berguna untuk membuat string menjadi 5 karakter
            // misalnya perintah sprintf("%05s", 15); maka akan menghasilkan '00015'
            $nomorTransaksi = sprintf("%05s", $urutan);
        } else {
            $nomorTransaksi++;
        }

     ?>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <script type="text/javascript">
            function autofill(){
                var kode_pelanggan = $("#kode_pelanggan").val();
                $.ajax({
                    url:'proses-ajax.php',
                    data : 'kode_pelanggan='+kode_pelanggan,
                }).success(function(data){
                    var json = data,
                    obj =JSON.parse(json);
                    $("#potongan").val(obj.potongan);
                });
            }
    </script>  

    <form action="proses-tambah.php" method="POST" style="margin-top: 2%; margin-left: 5%; margin-right: 40%;">
            <header>
                <h3>Formulir Penambahan Data Penjualan</h3>
            </header>
            <table>
                    <tr>
                        <td><label for="no_transaksi_jual" class="form-label">Nomor Transaksi :</label>
                            <input type="text" class="form-control" name="no_transaksi_jual" required="required" value="<?php echo $nomorTransaksi ?>" readonly></td>
                    
                        <td><label for="kode_jenis_transaksi" class="form-label">Jenis Transaksi :</label>
                            <select name="kode_jenis_transaksi" class="form-select" required>
                               <option value="" hidden>select jenis</option>
                                <?php 
                                $query = "SELECT * FROM jenis_transaksi";
                                $result = mysqli_query($db, $query);

                                while($data = mysqli_fetch_assoc($result) ){?>
                                    <option value="<?php echo $data['kode_jenis_transaksi']; ?>"><?php echo $data['nama_jenis_transaksi']; ?></option>
                                <?php } ?>
                          </select></td> 
                    
                        <td><label for="kode_dept" class="form-label">Departemen :</label>
                            <select name="kode_dept" class="form-select" required>
                                <option value="" hidden>select departement</option>
                                <?php 
                                $query = "SELECT * FROM departemen";
                                $result = mysqli_query($db, $query);

                                while($data = mysqli_fetch_assoc($result) ){?>
                                    <option value="<?php echo $data['kode_dept']; ?>"><?php echo $data['nama_dept']; ?></option>
                                <?php } ?>
                          </select></td> 

                        <td><label for="tanggal_transaksi" class="form-label">Tanggal Transaksi :</label>
                            <input type="date" class="form-control" name="tanggal_transaksi" required="required" ></td>
                    </tr>
                    <tr><td><br></td></tr>
                    <tr>
                        <td><label for="kode_pelanggan" class="form-label" >Kode Pelanggan </label></td>
                        <td><input type="text" class="form-control" name="kode_pelanggan" id="kode_pelanggan" onkeyup="autofill()" autocomplete="off"/></td> 
                    </tr>    
                    <tr>
                        <td><label for="jumlah_item" class="form-label">Jumlah Item </label></td>
                        <td><input type="number" min="0" class="form-control" name="jumlah_item" required="required" autocomplete="off"/></td>
                    </tr>
                    <tr>
                        <td><label for="subtotal" class="form-label">Sub Total (Rp)</label></td>
                        <td><input type="number" min="0" class="form-control" name="subtotal" required="required"  autocomplete="off"/></td>
                    </tr>
                    <tr>
                        <td><label for="potongan" class="form-label">Potongan (%) </label></td>
                        <td><input type="number" class="form-control" name="potongan" step="0.01" id="potongan" readonly required="required" autocomplete="off" /></td>
                    </tr>            
                    <tr>
                        <td><label for="pajak" class="form-label" autocomplete="off">Pajak (%)</label></td>
                        <td><input type="number" min="0" class="form-control" step="0.01" name="pajak" required="required" autocomplete="off"/></td>
                    </tr>
                    <tr>
                        <td><label for="biaya_lain" class="form-label">Biaya Lain (Rp)</label></td>
                        <td><input type="number" min="0" class="form-control" name="biaya_lain" required="required" autocomplete="off"/></td>
                    </tr>
                    <tr>
                        <td><label for="status_bayar" class="form-label">Status Bayar </label></td>

                        <td><select name="status_bayar" class="form-select" required="required" >
                                 <option value="" hidden>select metode pembayaran</option>
                                <?php 
                                $query = "SELECT * FROM status_pembayaran";
                                $result = mysqli_query($db, $query);

                                while($data = mysqli_fetch_assoc($result) ){?>
                                    <option value="<?php echo $data['status_bayar']; ?>"><?php echo $data['nama_pembayaran']; ?></option>
                                <?php } ?>
                          </select></td> 
                    </tr>
                    <tr>
                        <td><br><input type="submit" name="submit" class="btn btn-primary"></td>
                    </tr>
            </table>
    </form>
    <br><br><br><br><br>
    </body>
</html>