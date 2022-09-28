<?php

include("config.php");

if(isset($_GET['status_bayar']) ){

    // ambil id dari query string
    $status_bayar = $_GET['status_bayar'];

    // buat query hapus
    $sql = "DELETE FROM status_pembayaran WHERE status_bayar='$status_bayar'";
    $query = mysqli_query($db, $sql);

    // apakah query hapus berhasil?
    if($query ){
        echo "<script> 
            alert('Data berhasil dihapus!');
            document.location.href = 'list-data-pembayaran.php';
            </script>";    
    } else {
        echo "<script> 
            alert('Data gagal dihapus, karena jenis pembayaran sudah tercatat terdapat transaksi terjadi!');
            document.location.href = 'list-data-pembayaran.php';
            </script>";
    }

} else {
    header('Location: list-data-pembayaran.php');
}

?>