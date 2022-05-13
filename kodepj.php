<?php
include "koneksi.php";
$bulan =date('Y-m-d');
$cari_kd=$koneksi->query("select max(kode_penjualan) as kodex from tb_penjualan_detail ");

$tm_cari=$cari_kd->fetch_assoc();
$hasil=$tm_cari['kodex'];
$nourut=substr($hasil,3,4);
$nourut++;
$awal = "PJ-";
$kode =  $awal.sprintf("%04s", $nourut);

 ?>
