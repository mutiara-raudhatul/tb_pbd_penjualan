<?php 
    include("config.php"); 
    include("header.php"); 


// kalau tidak ada id di query string
if( !isset($_GET['status_bayar']) ){
    header('Location: list-data-pembayaran.php');
}

//ambil id dari query string
$status_bayar= $_GET['status_bayar'];

// buat query untuk ambil data dari database
$sql = "SELECT `status_bayar`, `nama_pembayaran` FROM `status_pembayaran` WHERE status_bayar='$status_bayar'";
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
    <title>Formulir Edit Data Jenis Status Pembayaran | Sasuai Swalayan</title>
            <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
</head>

<body>
    <form action="proses-edit-pembayaran.php" method="POST" style="margin-top: 2%; margin-left: 5%; margin-right: 40%;">
        <header>
            <h3>Formulir Edit Data Jenis Status Pembayaran</h3>
        </header>
            <table>
                    <tr>
                        <td><label for="status_bayar" class="form-label">Status Bayar </label><br>
                            <input type="text" class="form-control" name="status_bayar" readonly value="<?php echo $data_c['status_bayar'] ?>" /></td>
                    </tr>
                    <tr>
                        <td><label for="nama_pembayaran" class="form-label">Nama Pembayaran </label><br>
                            <input type="text" class="form-control"name="nama_pembayaran" value="<?php echo $data_c['nama_pembayaran'] ?>" /></td>
                    </tr>            
                    <tr>
                        <td><br><input type="submit" name="submit" class="btn btn-primary"></td>
                    </tr>
            </table>
    </form>
    </body>
</html>