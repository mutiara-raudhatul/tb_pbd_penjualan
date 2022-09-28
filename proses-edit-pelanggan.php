<?php

include("config.php");

// cek apakah tombol simpan sudah diklik atau blum?
if(isset($_POST['submit'])){

    // ambil data dari formulir
    $kode_pelanggan         = $_POST['kode_pelanggan'];
    $nama_pelanggan         = $_POST['nama_pelanggan'];
    $potongan               = $_POST['potongan'];

    $sqlcheck = "SELECT kode_pelanggan FROM pelanggan WHERE NOT EXISTS 
                (SELECT kode_pelanggan FROM pelanggan WHERE kode_pelanggan='$kode_pelanggan')";
    $querycheck = mysqli_query($db,$sqlcheck);
    $cekkode    =mysqli_num_rows ($querycheck);
    if ($cekkode> 0) {
        echo '<script language="javascript">
              alert ("kode pelanggan tidak dapat diubah");
              window.location="list-data-pelanggan.php";
              </script>';
        exit();
    }
    else{
        // buat query update
        $sql = "UPDATE pelanggan SET kode_pelanggan='$kode_pelanggan', nama_pelanggan='$nama_pelanggan', potongan='$potongan'
                WHERE kode_pelanggan ='$kode_pelanggan'";

        $query = mysqli_query($db, $sql);

        // apakah query update berhasil?
        if( $query ) {
            echo '<script language="javascript">
                  alert ("Berhasil menyimpan perubahan");
                  window.location="list-data-pelanggan.php";
                  </script>';
        } else {
            echo '<script language="javascript">
                  alert ("Gagal menyimpan perubahan");
                  window.location="list-data-pelanggan.php";
                  </script>';
        }
    }
} else {
    header('Location: list-data-pelanggan.php');
}

?>