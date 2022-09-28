<?php

include("config.php");

// cek apakah tombol daftar sudah diklik atau blum?
if(isset($_POST['submit'])){

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

    // buat query
    $sql = "INSERT INTO `transaksi_penjualan`(`no_transaksi_jual`, `kode_jenis_transaksi`, `kode_dept`, `kode_pelanggan`, `tanggal_transaksi`, `jumlah_item`, `subtotal`, `potongan`, `pajak`, `biaya_lain`, `status_bayar`) VALUES ('$no_transaksi_jual', '$kode_jenis_transaksi', '$kode_dept', '$kode_pelanggan', '$tanggal_transaksi', '$jumlah_item', '$subtotal', '$potongan', '$pajak', '$biaya_lain', '$status_bayar')";
    
    // echo $sql;

    // $sql = "INSERT INTO transaksi_penjualan(no_transaksi_jual,kode_jenis_transaksi,kode_dept,kode_pelanggan,tanggal_transaksi,jumlah_item,subtotal,potongan,pajak,biaya_lain,status_bayar) VALUE('$no_transaksi_jual', '$kode_jenis_transaksi', '$kode_dept', '$kode_pelanggan', '$tanggal_transaksi', '$jumlah_item', '$subtotal', '$potongan', '$pajak', '$biaya_lain', '$status_bayar')";
    
    $query = mysqli_query($db, $sql);

    // apakah query simpan berhasil?
    if( $query ) {
        // kalau berhasil alihkan ke halaman index.php dengan status=sukses
        header('Location: list-data.php?status=sukses');
    } else {
        // kalau gagal alihkan ke halaman indek.php dengan status=gagal
        header('Location: list-data.php?status=gagal');
    }

} else {
    header('Location: list-data.php');
}

?>