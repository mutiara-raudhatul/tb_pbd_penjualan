<?php

include("config.php");

// cek apakah tombol daftar sudah diklik atau blum?
if(isset($_POST['submit'])){

    // ambil data dari formulir
    $kode_dept= $_POST['kode_dept'];
    $nama_dept= $_POST['nama_dept'];

    
    $sqlcheck = "SELECT kode_dept FROM departemen WHERE kode_dept='$kode_dept'";
    $sqlcheck1 = "SELECT nama_dept FROM departemen WHERE nama_dept='$nama_dept'";

    $querycheck = mysqli_query($db,$sqlcheck);
    $querycheck1 = mysqli_query($db,$sqlcheck1);

    $cekkode    =mysqli_num_rows ($querycheck);
    $cekkode1    =mysqli_num_rows ($querycheck1);

    if ($cekkode> 0) {
        echo '<script language="javascript">
              alert ("Kode departemen telah terdaftar di dalam database");
              window.location="list-data-departemen.php";
              </script>';
        exit();
    }
    else{
        if ($cekkode1> 0) {
            echo '<script language="javascript">
                  alert ("Nama Departemen telah terdaftar di dalam database");
                  window.location="list-data-departemen.php";
                  </script>';
            exit();
        } else {
            // buat query
            $sql = "INSERT INTO `departemen`(`kode_dept`, `nama_dept`) VALUES ('$kode_dept', '$nama_dept')";
            $query = mysqli_query($db, $sql);
            echo '<script language="javascript">
                  alert ("Departemen berhasil ditambahkan");
                  window.location="list-data-departemen.php";
                  </script>';
        }
    }

} else {
    header('Location: list-data-departemen.php');
}

?>