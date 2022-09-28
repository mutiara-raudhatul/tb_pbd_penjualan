<?php

include("config.php");

// cek apakah tombol daftar sudah diklik atau blum?
if(isset($_POST['submit'])){

    // ambil data dari formulir
    $status_bayar= $_POST['status_bayar'];
    $nama_pembayaran= $_POST['nama_pembayaran'];

    
    $sqlcheck = "SELECT status_bayar FROM status_pembayaran WHERE status_bayar='$status_bayar'";
    $sqlcheck1 = "SELECT nama_pembayaran FROM status_pembayaran WHERE nama_pembayaran='$nama_pembayaran'";

    $querycheck = mysqli_query($db,$sqlcheck);
    $querycheck1 = mysqli_query($db,$sqlcheck1);

    $cekkode    =mysqli_num_rows ($querycheck);
    $cekkode1    =mysqli_num_rows ($querycheck1);

    if ($cekkode> 0) {
        echo '<script language="javascript">
              alert ("Kode pembayaran telah terdaftar di dalam database");
              window.location="list-data-pembayaran.php";
              </script>';
        exit();
    }
    else{
        if ($cekkode1> 0) {
            echo '<script language="javascript">
                  alert ("Nama pembayaran telah terdaftar di dalam database");
                  window.location="list-data-pembayaran.php";
                  </script>';
            exit();
        } else {
            // buat query
            $sql = "INSERT INTO `status_pembayaran`(`status_bayar`, `nama_pembayaran`) VALUES ('$status_bayar', '$nama_pembayaran')";
            $query = mysqli_query($db, $sql);
            echo '<script language="javascript">
                  alert ("Status Pembayaran berhasil ditambahkan");
                  window.location="list-data-pembayaran.php";
                  </script>';
        }
    }

} else {
    header('Location: list-data-pembayaran.php');
}

?>