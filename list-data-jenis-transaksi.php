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
        <h3>Data Jenis Transaksi</h3>
    </header>

    <nav>
        <a href="form-tambah-jenis-transaksi.php"><button type="button" class="btn btn-primary">[+] Tambah Baru</button></a>
    </nav>

    <br>

    <table class="table table-hover">
    <thead>
        <tr>
            <th>No</th>
            <th>Kode Jenis Transaksi</th>
            <th>Nama Jenis Transaksi</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>

        <?php
        $sql = "SELECT * FROM jenis_transaksi";
        $query = mysqli_query($db, $sql);
        
        $i=1;
        while($data_c = mysqli_fetch_array($query)){
            echo "<tr>";
                    
            echo "<td>".$i."</td>";
            echo "<td>".$data_c['kode_jenis_transaksi']."</td>";
            echo "<td>".$data_c['nama_jenis_transaksi']."</td>";      
            echo "<td>";
            echo "<a href='form-edit-jenis-transaksi.php?kode_jenis_transaksi=".$data_c['kode_jenis_transaksi']."' class='btn btn-success'>Update</a> | ";
        ?>
            <a href="hapus-jenis-transaksi.php?kode_jenis_transaksi=<?php echo $data_c['kode_jenis_transaksi']?>" class='btn btn-danger' onclick = "return confirm('Yakin Data Akan Dihapus');">Delete</a>
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