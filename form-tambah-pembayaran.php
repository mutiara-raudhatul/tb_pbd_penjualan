<?php 
    include("config.php"); 
    include("header.php"); 
?>

<!DOCTYPE html>
<html>
<head>
    <title>Penambahan Data Jenis Status Pembayaran</title>
    <link rel="stylesheet" type="text/css" href="style.css">
            <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
</head>

<body>

    <?php 
        include("config.php");?>
        <?php if(isset($_GET['status'])): ?>
                <p>
                    <?php
                        if($_GET['status'] == 'sukses'){
                            echo "<script>
                                alert('Data berhasil ditambahkan');
                                document.location.href = 'list-data-pembayaran.php';
                                </script>";
                        } else {
                            echo "<script>
                                alert('Data gagal ditambahkan');
                                document.location.href = 'list-data-pembayaran.php';
                                </script>";                
                        }
                    ?>
                </p>
            <?php endif; ?>

    <form action="proses-tambah-pembayaran.php" method="POST" style="margin-top: 2%; margin-left: 5%; margin-right: 40%;">
            <header>
                <h3>Formulir Penambahan Data Pembayaran</h3>
            </header>        
            <table>
                <tr>
                    <td><label for="status_bayar" class="form-label">Status Pembayaran : </label><br>
                        <input type="text" class="form-control" name="status_bayar" id="status_bayar" required autocomplete="off"></td>
                </tr>
                <tr>
                    <td><label for="nama_pembayaran" class="form-label"class="form-control">Nama Pembayaran : </label><br>
                        <input type="text" class="form-control" name="nama_pembayaran" id="nama_pembayaran" required autocomplete="off"></td>
                </tr>
                <tr>
                    <td><br><input type="submit" class="btn btn-primary" name="submit"></td>
                </tr>
            </table>
    </form>
    <br><br><br>
    </body>
</html>
