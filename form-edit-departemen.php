<?php 
    include("config.php"); 
    include("header.php"); 


// kalau tidak ada id di query string
if( !isset($_GET['kode_dept']) ){
    header('Location: list-data-departemen.php');
}

//ambil id dari query string
$kode_dept= $_GET['kode_dept'];

// buat query untuk ambil data dari database
$sql = "SELECT `kode_dept`, `nama_dept` FROM `departemen` WHERE kode_dept='$kode_dept'";
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
    <title>Formulir Edit Data Departemen | Sasuai Swalayan</title>
            <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
</head>

<body>
    <form action="proses-edit-departemen.php" method="POST" style="margin-top: 2%; margin-left: 5%; margin-right: 40%;">
        <header>
            <h3>Formulir Edit Data Departemen</h3>
        </header>
            <table>
                    <tr>
                        <td><label for="kode_dept" class="form-label">Kode Departemen </label><br>
                            <input type="text" class="form-control" name="kode_dept" readonly value="<?php echo $data_c['kode_dept'] ?>" /></td>
                    </tr>
                    <tr>
                        <td><label for="nama_dept" class="form-label">Nama Departemen </label><br>
                            <input type="text" class="form-control"name="nama_dept" value="<?php echo $data_c['nama_dept'] ?>" /></td>
                    </tr>            
                    <tr>
                        <td><br><input type="submit" name="submit" class="btn btn-primary"></td>
                    </tr>
            </table>
    </form>
    </body>
</html>