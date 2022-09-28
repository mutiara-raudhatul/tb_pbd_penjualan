<?php

include("config.php");

// cek apakah tombol simpan sudah diklik atau blum?
if(isset($_POST['submit'])){

    // ambil data dari formulir
    $status_bayar         = $_POST['status_bayar'];
    $nama_pembayaran      = $_POST['nama_pembayaran'];

    $sqlcheck = "SELECT status_bayar FROM status_pembayaran WHERE NOT EXISTS 
                (SELECT status_bayar FROM status_pembayaran WHERE status_bayar='$status_bayar')";
    $querycheck = mysqli_query($db,$sqlcheck);
    $cekkode    =mysqli_num_rows ($querycheck);

    if ($cekkode> 0) {
            echo '<script language="javascript">
                  alert ("Kode status pembayaran tidak dapat diubah");
                  window.location="list-data-pembayaran.php";
                  </script>';
            exit();
    } else{
            // buat query update
            $sql = "UPDATE status_pembayaran SET status_bayar='$status_bayar', nama_pembayaran='$nama_pembayaran'
                    WHERE status_bayar ='$status_bayar'";

            $query = mysqli_query($db, $sql);

            // apakah query update berhasil?
            if( $query ) {
                echo '<script language="javascript">
                      alert ("Berhasil menyimpan perubahan");
                      window.location="list-data-pembayaran.php";
                      </script>';
            } else {
                echo '<script language="javascript">
                      alert ("Gagal menyimpan perubahan");
                      window.location="list-data-pembayaran.php";
                      </script>';
            }
    }
} else {
    header('Location: list-data-departemen.php');
}

?>