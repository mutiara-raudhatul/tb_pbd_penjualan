<?php

include("config.php");

if( isset($_GET['no_transaksi_jual']) ){

    // ambil id dari query string
    $no_transaksi_jual = $_GET['no_transaksi_jual'];

    // buat query hapus
    $sql = "DELETE FROM transaksi_penjualan WHERE no_transaksi_jual=$no_transaksi_jual";
    $query = mysqli_query($db, $sql);

    // apakah query hapus berhasil?
    if( $query ){
        header('Location: list-data.php');
    } else {
        die("gagal menghapus...");
    }

} else {
        header('Location: list-data.php');
}

?>