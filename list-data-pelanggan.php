<?php 
    include("config.php"); 
    include("header.php"); 

    if (isset($_POST['submitdel'])) {
      if(isset($_POST['aksi']) && $_POST['aksi']=='hapus'){

        $sql = "DELETE FROM pelanggan WHERE kode_pelanggan=?";
        if($stmt = mysqli_prepare($db, $sql)){
          mysqli_stmt_bind_param($stmt, "s", $kode_pelanggan);
          $kode_pelanggan = trim($_POST["kode_pelanggan"]);
  
          if(mysqli_stmt_execute($stmt)){
            $message_sukses="Data berhasil dihapus";
          } else{
            $message_gagal="Data gagal dihapus, cek pelanggan sudah melakukan transaksi";
          }
        }
      }
    }
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
        <h3>Data Pelanggan</h3>
        <a href="form-tambah-pelanggan.php"><button type="button" class="btn btn-primary">[+] Tambah Baru</button></a>       
    </header>
        
    <br>

    <table class="table table-hover" >
        <?php if(isset($message_sukses)){ ?>
          <div class="alert alert-success" role="alert">
            <?php echo $message_sukses; ?>
          </div>
        <?php } else if (isset($message_gagal)){ ?>
          <div class="alert alert-danger" role="alert">
            <?php echo $message_gagal; ?>
          </div>
        <?php } ?>
        <thead>
            <tr>
                <th>No</th>
                <th>Kode Pelangan</th>
                <th>Nama Pelanggan</th>
                <th>Potongan (%)</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>

            <?php
            $sql = "SELECT * FROM pelanggan";
            $query = mysqli_query($db, $sql);
            
            $i=1;
            while($data_c = mysqli_fetch_array($query)){
                echo "<tr>";
                        
                echo "<td>".$i."</td>";
                echo "<td>".$data_c['kode_pelanggan']."</td>";
                echo "<td>".$data_c['nama_pelanggan']."</td>";
                $persen=100;
                echo "<td>".$data_c['potongan']*$persen.".00</td>";

                ?>
                <td>
               <form method="POST" action="list-data-pelanggan.php" onsubmit="return confirm('Apakah data ini akan dihapus?');">
                  <a href="form-edit-pelanggan.php?kode_pelanggan=<?php echo $data_c['kode_pelanggan'] ?>" class='btn btn-success btn-sm'>Update</a> 
                  <input type="hidden" name="aksi" value="hapus">
                  <input type="hidden" name="kode_pelanggan" value="<?php echo $data_c['kode_pelanggan'] ?>">
                  <button type="submit" name="submitdel" class="btn btn-sm btn-danger">Delete</button>
                </form>
                </td>
                <?php 
                $i++; 
            }
            ?>

        </tbody>
    </table>
    <p>Total: <?php echo mysqli_num_rows($query) ?></p>
    </form>

    </body>
</html>