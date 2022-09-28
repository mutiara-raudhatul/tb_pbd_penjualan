<?php

include("config.php");

if(isset($_GET['kode_dept']) ){

    // ambil id dari query string
    $kode_dept = $_GET['kode_dept'];

    // buat query hapus
    $sql = "DELETE FROM departemen WHERE kode_dept='$kode_dept'";
    $query = mysqli_query($db, $sql);

    // apakah query hapus berhasil?
    if($query ){
        echo "<script> 
            alert('Data berhasil dihapus!');
            document.location.href = 'list-data-jenis-transaksi.php';
            </script>";    
    } else {
        echo "<script> 
            alert('Data gagal dihapus, karena departemen sudah tercatat terdapat transaksi terjadi!');
            document.location.href = 'list-data-jenis-transaksi.php';
            </script>";
    }

} else {
    header('Location: list-data-departemen.php');
}

?>