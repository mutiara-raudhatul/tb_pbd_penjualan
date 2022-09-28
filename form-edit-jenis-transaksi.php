<?php 
    include("config.php"); 
    include("header.php"); 


// kalau tidak ada id di query string
if( !isset($_GET['kode_jenis_transaksi']) ){
    header('Location: list-data-jenis-transaksi.php');
}

//ambil id dari query string
$kode_jenis_transaksi= $_GET['kode_jenis_transaksi'];

// buat query untuk ambil data dari database
$sql = "SELECT * FROM jenis_transaksi WHERE kode_jenis_transaksi='$kode_jenis_transaksi'";
$query = mysqli_query($db, $sql);
$data_c = mysqli_fetch_assoc($query);

// jika data yang di-edit tidak ditemukan
if( mysqli_num_rows($query) < 1 ){
    die("data tidak ditemukan...");
}

?>


<!DOCTYPE html>
<html>
<head>
    <title>Formulir Edit Data Jenis Transaksi | Sasuai Swalayan</title>
            <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
</head>

<body>


    <form action="proses-edit-jenis-transaksi.php" method="POST" style="margin-top: 2%; margin-left: 5%; margin-right: 40%;">
        <header>
            <h3>Formulir Edit Data Jenis Transaksi</h3>
        </header>
        <fieldset>
            <table>
                    <tr>
                        <td><label for="kode_jenis_transaksi" class="form-label">Kode Jenis Transaksi </label><br>
                            <input type="text" class="form-control" name="kode_jenis_transaksi" readonly value="<?php echo $data_c['kode_jenis_transaksi'] ?>" /></td>
                    </tr>
                    <tr>
                        <td><label for="nama_jenis_transaksi" class="form-label">Nama Jenis Transaksi </label><br>
                            <input type="text" class="form-control" name="nama_jenis_transaksi" value="<?php echo $data_c['nama_jenis_transaksi'] ?>" /></td>
                    </tr>           
                    <tr>
                        <td><br><input type="submit" name="submit" class="btn btn-primary"></td>
                    </tr>
            </table>
        </fieldset>
    </form>

    </body>
</html>