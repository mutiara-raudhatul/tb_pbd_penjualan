<?php 
    include("config.php"); 
    include("header.php"); 
?>

<!DOCTYPE html>
<html>
<head>
    <title>Penambahan Data Pelanggan</title>
    <link rel="stylesheet" type="text/css" href="style.css">

    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
</head>

<body>

    <form action="proses-tambah-pelanggan.php" method="POST" style="margin-top: 2%; margin-left: 5%; margin-right: 40%;">
        <h3>Formulir Penambahan Data Pelanggan</h3>
          <div class="mb-3">
            <label for="kode_pelanggan" class="form-label">Kode Pelanggan :</label>
            <input type="text" name="kode_pelanggan" class="form-control" id="kode_pelanggan" autocomplete="off" required="required">
          </div>
          <div class="mb-3">
            <label for="nama_pelanggan" class="form-label">Nama Pelanggan :</label>
            <input type="text" name="nama_pelanggan" class="form-control" id="nama_pelanggan" autocomplete="off" required="required">
          </div>
          <div class="mb-3">
            <label for="potongan" class="form-label">Potongan</label>
            <input type="number" name="potongan" step="0.01" class="form-control" id="potongan" autocomplete="off" required="required">
          </div>
          <button type="submit"  name="submit" class="btn btn-primary">Submit</button>

    </form>
    <br><br><br>
    </body>
</html>
