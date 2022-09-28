<?php

include("config.php");

// cek apakah tombol simpan sudah diklik atau blum?
if(isset($_POST['submit'])){

    // ambil data dari formulir
    $kode_jenis_transaksi   = $_POST['kode_jenis_transaksi'];
    $nama_jenis_transaksi   = $_POST['nama_jenis_transaksi'];

    $sqlcheck = "SELECT kode_jenis_transaksi FROM jenis_transaksi WHERE NOT EXISTS 
                (SELECT kode_jenis_transaksi FROM jenis_transaksi WHERE kode_jenis_transaksi='$kode_jenis_transaksi')";
    $querycheck = mysqli_query($db,$sqlcheck);
    $cekkode    =mysqli_num_rows ($querycheck);

    if ($cekkode> 0) {
        echo '<script language="javascript">
              alert ("kode jenis_transaksi tidak dapat diubah");
              window.location="list-data-jenis-transaksi.php";
              </script>';
        exit();
    }
    else{
        // buat query update
        $sql = "UPDATE jenis_transaksi SET kode_jenis_transaksi='$kode_jenis_transaksi', nama_jenis_transaksi='$nama_jenis_transaksi' WHERE kode_jenis_transaksi ='$kode_jenis_transaksi'";

        $query = mysqli_query($db, $sql);

        // apakah query update berhasil?
        if( $query ) {
            echo '<script language="javascript">
                  alert ("Berhasil menyimpan perubahan");
                  window.location="list-data-jenis-transaksi.php";
                  </script>';
        } else {
            echo '<script language="javascript">
                  alert ("Gagal menyimpan perubahan");
                  window.location="list-data-jenis-transaksi.php";
                  </script>';
        }
    }
} else {
    header('Location: list-data-jenis-transaksi.php');
}

?>