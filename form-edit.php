<?php 
    include("config.php"); 
    include("header.php"); 


// kalau tidak ada id di query string
if( !isset($_GET['no_transaksi_jual']) ){
    header('Location: list-data.php');
}

//ambil id dari query string
$no_transaksi_jual= $_GET['no_transaksi_jual'];

// buat query untuk ambil data dari database
$sql = "SELECT * FROM transaksi_penjualan WHERE no_transaksi_jual='$no_transaksi_jual'";
$query = mysqli_query($db, $sql);
$data_jual = mysqli_fetch_assoc($query);

// jika data yang di-edit tidak ditemukan
if( mysqli_num_rows($query) < 1 ){
    die("data tidak ditemukan...");
}

?>


<!DOCTYPE html>
<html>
<head>
    <title>Formulir Edit Data Penjualan | Sasuai Swalayan</title>
        <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
</head>

<body>

    <?php 

        // mengambil data no_transaksi_jual dengan nomor paling besar
        $query = mysqli_query($db, "SELECT max(no_transaksi_jual) as nomorTerbesar FROM transaksi_penjualan");
        $data = mysqli_fetch_array($query);
        $nomorTransaksi = $data['nomorTerbesar'];
         
        // mengambil angka dari nomor transaksi terbesar, menggunakan fungsi substr
        // dan diubah ke integer dengan (int)
        $urutan = (int) substr($nomorTransaksi, 3, 3);
         
        // bilangan yang diambil ini ditambah 1 untuk menentukan nomor urut berikutnya
        $urutan++;
         
        // membentuk nomor transaksi baru
        // perintah sprintf("%05s", $urutan); berguna untuk membuat string menjadi 5 karakter
        // misalnya perintah sprintf("%05s", 15); maka akan menghasilkan '00015'
        $nomorTransaksi = sprintf("%05s", $urutan);

     ?>
    <form action="proses-edit.php" method="POST" style="margin-top: 2%; margin-left: 5%; margin-right: 40%;">
            <header>
                <h3>Formulir Edit Data Penjualan</h3>
            </header>
            <table> 
                    <tr>
                        <td><label for="no_transaksi_jual" class="form-label">Nomor Transaksi :</label>
                            <input type="text" class="form-control" name="no_transaksi_jual" readonly value="<?php echo $data_jual['no_transaksi_jual'] ?>" /></td>

                        <td><label for="kode_jenis_transaksi" class="form-label">Jenis Transaksi :</label>
                            <select name="kode_jenis_transaksi" class="form-control">
                                <option value="" hidden>select jenis</option>

                                <?php 
                                $query = "SELECT * FROM jenis_transaksi";
                                $result = mysqli_query($db, $query);
                                $kode_jenis_transaksi   = $_POST['kode_jenis_transaksi'];

                                while($data = mysqli_fetch_assoc($result) ){?>
                                    <option value="<?php echo $data['kode_jenis_transaksi']; ?>" selected><?php echo $data['nama_jenis_transaksi']; ?></option>
                                <?php } ?>
                            </select>
                        </td>

                        <td><label for="kode_dept" class="form-label">Departemen :</label>
                            <select name="kode_dept" class="form-control">
                                <option value="" hidden>select departemen</option>

                                <?php 
                                $query = "SELECT * FROM departemen";
                                $result = mysqli_query($db, $query);
                                $kode_dept   = $_POST['kode_dept'];

                                while($data = mysqli_fetch_assoc($result) ){?>
                                    <option value="<?php echo $data['kode_dept']; ?>" selected><?php echo $data['nama_dept']; ?></option>
                                <?php } ?>
                            </select>
                        </td>

                        <td><label for="tanggal_transaksi" class="form-label">Tanggal Transaksi :</label>
                            <input type="date" class="form-control" name="tanggal_transaksi" value="<?php echo $data_jual['tanggal_transaksi'] ?>" /></td>
                    </tr> 
                    <tr> <td><br></td></tr>
                    <tr>
                        <td><label for="kode_pelanggan"class="form-label" >Kode Pelanggan </label></td>
                        <td><input type="text" class="form-control" name="kode_pelanggan" value="<?php echo $data_jual['kode_pelanggan'] ?>" onkeyup="autofill()"/></td>
                    </tr>
   
                    <tr>
                        <td><label for="jumlah_item" class="form-label">Jumlah Item </label></td>
                        <td><input type="number" min="0" class="form-control" name="jumlah_item" value="<?php echo $data_jual['jumlah_item'] ?>" /></td>
                    </tr>
                    <tr>
                        <td><label for="subtotal" class="form-label">Sub Total </label></td>
                        <td><input type="number" min="0" class="form-control" name="subtotal" value="<?php echo $data_jual['subtotal'] ?>" /></td>                 
                    </tr>
                    <tr>
                        <td><label for="potongan" class="form-label">Potongan </label></td>
                        <td><input type="number" class="form-control" name="potongan" step="0.01" id="potongan" value="<?php echo $data_jual['potongan']?>"  readonly/></td>
                    </tr>            
                    <tr>
                        <td><label for="pajak" class="form-label">Pajak </label></td>
                        <td><input type="number" min="0" class="form-control" name="pajak" step="0.01" value="<?php echo $data_jual['pajak']?>" /></td>
                    </tr>
                    <tr>
                        <td><label for="biaya_lain" class="form-label" >Biaya Lain </label></td>
                        <td><input type="number" min="0" class="form-control" name="biaya_lain" value="<?php echo $data_jual['biaya_lain']?>" /></td>
                    </tr>
                    <tr>
                        <td><label for="status_bayar" class="form-label">Status Bayar </label></td>
                        <td>
                            <select name="status_bayar" class="form-control">
                                <option value="" hidden>select jenis</option>

                                <?php 
                                $query = "SELECT * FROM status_pembayaran";
                                $result = mysqli_query($db, $query);
                                $status_bayar   = $_POST['status_bayar'];

                                while($data = mysqli_fetch_assoc($result) ){?>
                                    <option value="<?php echo $data['status_bayar']; ?>" selected><?php echo $data['nama_pembayaran']; ?></option>
                                <?php } ?>
                        </select>
                        </td>
                    </tr>
                    <tr>
                        <td><input type="submit" name="simpan" class="btn btn-primary" ></td>
                    </tr>
            </table>

            <!-- Cara Edit Text Radio Button dan Selected -->
            <!--         <p>
                        <label for="jenis_kelamin">Jenis Kelamin: </label>
                        <?php $jk = $siswa['jenis_kelamin']; ?>
                        <label><input type="radio" name="jenis_kelamin" value="laki-laki" <?php echo ($jk == 'laki-laki') ? "checked": "" ?>> Laki-laki</label>
                        <label><input type="radio" name="jenis_kelamin" value="perempuan" <?php echo ($jk == 'perempuan') ? "checked": "" ?>> Perempuan</label>
                    </p>
                    <p>
                        <label for="agama">Agama: </label>
                        <?php $agama = $siswa['agama']; ?>
                        <select name="agama">
                            <option <?php echo ($agama == 'Islam') ? "selected": "" ?>>Islam</option>
                            <option <?php echo ($agama == 'Kristen') ? "selected": "" ?>>Kristen</option>
                            <option <?php echo ($agama == 'Hindu') ? "selected": "" ?>>Hindu</option>
                            <option <?php echo ($agama == 'Budha') ? "selected": "" ?>>Budha</option>
                            <option <?php echo ($agama == 'Atheis') ? "selected": "" ?>>Atheis</option>
                        </select>
                    </p> -->
    </form>

    </body>
</html>