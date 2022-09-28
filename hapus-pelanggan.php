<?php

include("config.php");

if(isset($_GET['kode_pelanggan']) ){

    // ambil id dari query string
    $kode_pelanggan = $_GET['kode_pelanggan'];

    // buat query hapus
    $sql = "DELETE FROM pelanggan WHERE kode_pelanggan='$kode_pelanggan'";
    $query = mysqli_query($db, $sql);

    // apakah query hapus berhasil?
    if( $query ){
        echo "<script> 
            alert('Data berhasil dihapus!');
            document.location.href = 'list-data-pelanggan.php';
            </script>";;
    } else {
        echo "<script> 
            alert('Data gagal dihapus, karena pelanggan sudah tercatat melakukan transaksi!');
            document.location.href = 'list-data-pelanggan.php';
            </script>";
    }

} else {
    header('Location: list-data-pelanggan.php');
}

?>