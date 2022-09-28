<?php

include("config.php");

// cek apakah tombol daftar sudah diklik atau blum?
if(isset($_POST['submit'])){

    // ambil data dari formulir
    $kode_jenis_transaksi= $_POST['kode_jenis_transaksi'];
    $nama_jenis_transaksi= $_POST['nama_jenis_transaksi'];


    // echo $sql;
    $sqlcheck = "SELECT kode_jenis_transaksi FROM jenis_transaksi WHERE kode_jenis_transaksi='$kode_jenis_transaksi'";
    $querycheck = mysqli_query($db,$sqlcheck);
    $cekkode    =mysqli_num_rows ($querycheck);

    $sqlcheck1 = "SELECT nama_jenis_transaksi FROM jenis_transaksi WHERE nama_jenis_transaksi='$nama_jenis_transaksi'";
    $querycheck1 = mysqli_query($db,$sqlcheck1);
    $cekkode1    =mysqli_num_rows ($querycheck1);

    if ($cekkode> 0) {
        echo '<script language="javascript">
              alert ("Kode jenis transaksi telah terdaftar di dalam database");
              window.location="list-data-jenis-transaksi.php";
              </script>';
        exit();
    }
    else{
        if ($cekkode1> 0) {
        echo '<script language="javascript">
              alert ("Nama jenis transaksi telah terdaftar di dalam database");
              window.location="list-data-jenis-transaksi.php";
              </script>';
        exit();
        } else {
        // buat query
        $sql = "INSERT INTO `jenis_transaksi`(`kode_jenis_transaksi`, `nama_jenis_transaksi`) VALUES ('$kode_jenis_transaksi', '$nama_jenis_transaksi')";        
        $query = mysqli_query($db, $sql);
        echo '<script language="javascript">
              alert ("Jenis transaksi berhasil ditambahkan");
              window.location="list-data-jenis-transaksi.php";
              </script>';
        }
    }

    // // apakah query simpan berhasil?
    // if( $query ) {
    //     // kalau berhasil alihkan ke halaman index.php dengan status=sukses
    //     header('Location: list-data-jenis-transaksi.php?status=sukses');
    // } else {
    //     // kalau gagal alihkan ke halaman indek.php dengan status=gagal
    //     header('Location: list-data-jenis-transaksi.php?status=gagal');
    // }

} 
else {
     header('Location: list-data-jenis-transaksi.php');
}

?>