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
        <h3>Data Departemen</h3>
    </header>

    <nav>
        <a href="form-tambah-departemen.php"><button type="button" class="btn btn-primary" href="form-tambah-departemen.php">[+] Tambah Baru</button></a>        
    

    </nav>

    <br>

    <table class="table table-hover">
        <thead>
            <tr>
                <th>No</th>
                <th>Kode Departemen</th>
                <th>Nama Departemen</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>

            <?php
            $sql = "SELECT * FROM departemen";
            $query = mysqli_query($db, $sql);
            
            $i=1;
            while($data_c = mysqli_fetch_array($query)){
                echo "<tr>";
                        
                echo "<td>".$i."</td>";
                echo "<td>".$data_c['kode_dept']."</td>";
                echo "<td>".$data_c['nama_dept']."</td>";

                echo "<td>";
                echo "<a href='form-edit-departemen.php?kode_dept=".$data_c['kode_dept']."' class='btn btn-success'>Update</a> | ";
                ?>
                <a href="hapus-departemen.php?kode_dept=<?php echo $data_c['kode_dept']?>" class='btn btn-danger' onclick = "return confirm('Yakin Data Akan Dihapus');">Delete</a>
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