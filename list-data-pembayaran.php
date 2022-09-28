<?php 
    include("config.php"); 
    include("header.php"); 
?>

<!DOCTYPE html>
<html>
<head>
    <title>Program Penjualan | Sasuai Swalayan</title>
<!--     <link rel="stylesheet" type="text/css" href="styles.css"> -->
<!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
</head>

<body>
    <form style="margin-left: 5%; margin-right: 5%;">
    <header>
        <h3>Data Jenis Status Pembayaran</h3>
    </header>

    <nav>
        <a href="form-tambah-pembayaran.php"><button type="button" class="btn btn-primary" href="form-tambah-pembayaran.php">[+] Tambah Baru</button></a>        
    

    </nav>

    <br>

    <table class="table table-hover">
        <thead>
            <tr>
                <th>No</th>
                <th>Status Bayar</th>
                <th>Nama Pembayaran</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>

            <?php
            $sql = "SELECT * FROM status_pembayaran";
            $query = mysqli_query($db, $sql);
            
            $i=1;
            while($data_c = mysqli_fetch_array($query)){
                echo "<tr>";
                        
                echo "<td>".$i."</td>";
                echo "<td>".$data_c['status_bayar']."</td>";
                echo "<td>".$data_c['nama_pembayaran']."</td>";

                echo "<td>";
                echo "<a href='form-edit-pembayaran.php?status_bayar=".$data_c['status_bayar']."' class='btn btn-success'>Update</a> | ";
                ?>
                <a href="hapus-pembayaran.php?status_bayar=<?php echo $data_c['status_bayar']?>" class='btn btn-danger' onclick = "return confirm('Yakin Data Akan Dihapus');">Delete</a>
                <?php 
                echo "</td>";
                echo "</tr>";
                $i++; 
            }
            ?>

        </tbody>
    </table>

    <p>Total: <?php echo mysqli_num_rows($query) ?></p>
    </form>
    </body>
</html>