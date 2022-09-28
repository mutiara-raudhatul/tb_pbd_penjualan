<?php 
include("config.php");
    //field potongan otomatis
        // Deklarasi variable keyword
        $kode_pelanggan = $_GET['kode_pelanggan'];

        $sql = mysqli_query($db, "SELECT potongan FROM pelanggan WHERE kode_pelanggan='$kode_pelanggan'");
        $pelanggan = mysqli_fetch_array($sql);
        $data = array(
        	'potongan'=>$pelanggan['potongan']
        );
        echo json_encode($data);

 ?>