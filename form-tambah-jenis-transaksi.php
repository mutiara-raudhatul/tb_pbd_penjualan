<?php 
    include("config.php"); 
    include("header.php"); 
?>

<!DOCTYPE html>
<html>
<head>
    <title>Penambahan Data Jenis Transaksi</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
            <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
</head>

<body>

    <?php 
        include("config.php"); 
             if(isset($_GET['status'])): ?>
                <p>
                    <?php
                        if($_GET['status'] == 'sukses'){
                            echo "<script>
                                alert('Data berhasil ditambahkan');
                                document.location.href = 'list-data-jenis-transaksi.php';
                                </script>";
                        } else {
                            echo "<script>
                                        alert('Data gagal ditambahkan');
                                        document.location.href = 'list-data-jenis-transaksi.php';
                                        </script>";                
                        }
                    ?>
                </p>
            <?php endif; 
     ?>

    <form action="proses-tambah-jenis-transaksi.php" method="POST" style="margin-top: 2%; margin-left: 5%; margin-right: 40%;">
            <header>
                <h3>Formulir Penambahan Data Jenis Transaksi</h3>
            </header>        
				<tr>
					<td><label for="kode_jenis_transaksi" class="form-label">Kode Jenis Transaksi : </label></td>
					<td><input type="text" class="form-control" name="kode_jenis_transaksi" id="kode_jenis_transaksi" required autocomplete="off"></td>
				</tr>
				<tr>
					<td><label for="nama_jenis_transaksi" class="form-label">Nama Jenis Transaksi : </label></td>
					<td><input type="text" class="form-control" name="nama_jenis_transaksi" id="nama_jenis_transaksi" required autocomplete="off"></td>
				</tr>
				<tr>
					<td><br><input type="submit" class="btn btn-primary" name="submit"></td>
				</tr>
			</table>
    </form>
    <br><br><br>
    </body>
</html>
