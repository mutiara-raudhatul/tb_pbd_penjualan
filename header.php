<!DOCTYPE html>
<html>
<head>
<style>
#logo{
    float:left;
    width:12%;
}

img {
  margin-top: 10px;
  width: 140px;
  height: 100px;
}

body {
  font-size: 18px;
}

ul {
  list-style-type: none;
  margin: 0;
  padding: 0;
  overflow: hidden;
  background-color: Teal;
  position: -webkit-sticky; 
  position: sticky;
  top: 0;
}

li {
  float: left;
}

li a {
  display: block;
  color: white;
  text-align: center;
  padding: 14px 16px;
  text-decoration: none;
}

li a:hover {
  background-color: LightSeaGreen;
}

.active {
  background-color: LightSeaGreen;
}
</style>
</head>
<body style="background-color: honeydew">

<div style="background-color: #bfd9bf">
<div id="logo">
            <img src="logos.png">
</div>
<div class="header">
  <h2>Sasuai Swalayan</h2>
  <p>Sasuai Swalayan <br>
  Jl. Soekarno Hatta <br>
  Gantiang</p>
</div>

<ul>
  <li><a href="list-data-pelanggan.php">Pelanggan</a></li>
  <li><a href="list-data-departemen.php">Departemen</a></li>
  <li><a href="list-data-jenis-transaksi.php">Jenis Transaksi</a></li>
  <li><a href="list-data-pembayaran.php">Pembayaran</a></li>
  <li><a href="list-data.php">Penjualan</a></li>
</ul>
</div>
</body>
</html>
