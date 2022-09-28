<?php

include("config.php");

// cek apakah tombol simpan sudah diklik atau blum?
if(isset($_POST['submit'])){

    // ambil data dari formulir
    $kode_dept         = $_POST['kode_dept'];
    $nama_dept         = $_POST['nama_dept'];

    $sqlcheck = "SELECT kode_dept FROM departemen WHERE NOT EXISTS 
                (SELECT kode_dept FROM departemen WHERE kode_dept='$kode_dept')";
    $querycheck = mysqli_query($db,$sqlcheck);
    $cekkode    =mysqli_num_rows ($querycheck);

    if ($cekkode> 0) {
            echo '<script language="javascript">
                  alert ("kode departemen tidak dapat diubah");
                  window.location="list-data-departemen.php";
                  </script>';
            exit();
    } else{
            // buat query update
            $sql = "UPDATE departemen SET kode_dept='$kode_dept', nama_dept='$nama_dept'
                    WHERE kode_dept ='$kode_dept'";

            $query = mysqli_query($db, $sql);

            // apakah query update berhasil?
            if( $query ) {
                echo '<script language="javascript">
                      alert ("Berhasil menyimpan perubahan");
                      window.location="list-data-departemen.php";
                      </script>';
            } else {
                echo '<script language="javascript">
                      alert ("Gagal menyimpan perubahan");
                      window.location="list-data-departemen.php";
                      </script>';
            }
    }
} else {
    header('Location: list-data-departemen.php');
}

?>