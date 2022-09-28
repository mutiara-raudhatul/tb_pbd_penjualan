<?php

include("config.php");

// cek apakah tombol daftar sudah diklik atau blum?
if(isset($_POST['submit'])){

    // ambil data dari formulir
    $kode_pelanggan= $_POST['kode_pelanggan'];
    $nama_pelanggan= $_POST['nama_pelanggan'];
    $potongan=$_POST['potongan'];


    // echo $sql;
    $sqlcheck = "SELECT kode_pelanggan FROM pelanggan WHERE kode_pelanggan='$kode_pelanggan'";
    $querycheck = mysqli_query($db,$sqlcheck);
    $cekkode    =mysqli_num_rows ($querycheck);
    if ($cekkode> 0) {
        echo '<script language="javascript">
              alert ("kode pelanggan telah terdaftar di dalam database");
              window.location="list-data-pelanggan.php";
              </script>';
        exit();
    }
    else{
        // buat query
        $sql = "INSERT INTO `pelanggan`(`kode_pelanggan`, `nama_pelanggan`, `potongan`) VALUES ('$kode_pelanggan', '$nama_pelanggan', '$potongan')";
        $query = mysqli_query($db, $sql);
        echo '<script language="javascript">
              alert ("Pelanggan berhasil ditambahkan");
              window.location="list-data-pelanggan.php";
              </script>';
    }

} else {
        header('Location: list-data-pelanggan.php');
}

?>