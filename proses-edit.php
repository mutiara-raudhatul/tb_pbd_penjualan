<?php

include("config.php");

// cek apakah tombol simpan sudah diklik atau blum?
if(isset($_POST['simpan'])){

    // ambil data dari formulir
    $no_transaksi_jual      = $_POST['no_transaksi_jual'];
    $kode_jenis_transaksi   = $_POST['kode_jenis_transaksi'];
    $kode_dept              = $_POST['kode_dept'];
    $kode_pelanggan         = $_POST['kode_pelanggan'];
    $tanggal_transaksi      = $_POST['tanggal_transaksi'];
    $jumlah_item            = $_POST['jumlah_item'];
    $subtotal               = $_POST['subtotal'];
    $potongan               = $_POST['potongan'];
    $pajak                  = $_POST['pajak'];
    $biaya_lain             = $_POST['biaya_lain'];
    $status_bayar           = $_POST['status_bayar'];

    // buat query update
    $sql = "UPDATE transaksi_penjualan SET 
                no_transaksi_jual   ='$no_transaksi_jual', 
                kode_jenis_transaksi='$kode_jenis_transaksi', 
                kode_dept           ='$kode_dept', 
                kode_pelanggan      ='$kode_pelanggan', 
                tanggal_transaksi   ='$tanggal_transaksi', 
                jumlah_item         ='$jumlah_item',
                subtotal            ='$subtotal',
                potongan            ='$potongan',
                pajak               ='$pajak',
                biaya_lain          ='$biaya_lain',
                status_bayar        ='$status_bayar'
            WHERE no_transaksi_jual ='$no_transaksi_jual'";

    $query = mysqli_query($db, $sql);

    // apakah query update berhasil?
    if( $query ) {
        // kalau berhasil alihkan ke halaman list-data.php
        echo '<script language="javascript">
                alert ("Berhasil menyimpan perubahan");
                window.location="list-data.php";
              </script>';
    } else {
        // kalau gagal tampilkan pesan
        echo '<script language="javascript">
                alert ("Gagal menyimpan perubahan");
                window.location="list-data-departemen.php";
              </script>';
    }


} else {
    header('Location: list-data.php');
}

?>