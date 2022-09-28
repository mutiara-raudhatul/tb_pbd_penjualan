<?php

include("config.php");

if( isset($_GET['kode_jenis_transaksi']) ){

    // ambil id dari query string
    $kode_jenis_transaksi = $_GET['kode_jenis_transaksi'];

    // buat query hapus
    $sql = "DELETE FROM jenis_transaksi WHERE kode_jenis_transaksi='$kode_jenis_transaksi'";
    $query = mysqli_query($db, $sql);

    // apakah query hapus berhasil?
    if( $query ){
        echo "<script> 
            alert('Data berhasil dihapus!');
            document.location.href = 'list-data-jenis-transaksi.php';
            </script>";
    } else {
        echo "<script> 
            alert('Data gagal dihapus, karena jenis transaksi sudah tercatat pada transaksi penjualan!');
            document.location.href = 'list-data-jenis-transaksi.php';
            </script>";
    }

} else {
    header('Location: list-data-jenis-transaksi.php');
}

?>