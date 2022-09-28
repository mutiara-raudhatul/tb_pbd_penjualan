<?php 
    include("config.php"); 
    include("header.php"); 


// kalau tidak ada id di query string
if( !isset($_GET['kode_pelanggan']) ){
    header('Location: list-data-pelanggan.php');
}

//ambil id dari query string
$kode_pelanggan= $_GET['kode_pelanggan'];

// buat query untuk ambil data dari database
$sql = "SELECT * FROM pelanggan WHERE kode_pelanggan='$kode_pelanggan'";
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
    <title>Formulir Edit Data Pelanggan | Sasuai Swalayan</title>
            <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
</head>

<body>


    <form action="proses-edit-pelanggan.php" method="POST" style="margin-top: 2%; margin-left: 5%; margin-right: 40%;">
        <header>
            <h3>Formulir Edit Data Pelanggan</h3>
        </header>
        <fieldset>
            <table>
                    <tr>
                        <td><label for="kode_pelanggan" class="form-label">Kode Pelanggan </label><br>
                        <input type="text" class="form-control" name="kode_pelanggan" autocomplete="off" value="<?php echo $data_c['kode_pelanggan'] ?>" /></td>
                    </tr>
                    <tr>
                        <td><label for="nama_pelanggan" class="form-label">Nama Pelanggan </label><br>
                            <input type="text" class="form-control" name="nama_pelanggan" autocomplete="off" value="<?php echo $data_c['nama_pelanggan'] ?>" /></td>
                    </tr>
                    <tr>
                        <td><label for="potongan" class="form-label">Potongan </label><br>
                            <input type="number" class="form-control" name="potongan" step="0.01" autocomplete="off" value="<?php echo $data_c['potongan']?>"  /></td>
                    </tr>            
                    <tr>
                        <td><br><input type="submit" name="submit" class="btn btn-primary"></td>
                    </tr>
            </table>
        </fieldset>
    </form>

    </body>
</html>