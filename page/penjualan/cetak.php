<?php 

error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));

    include "koneksi.php";

$kasir = $_GET['kasir'];

$kode_pj = $_GET['kode_pjl'];

 ?>

<table align="center">
	<tr>
		<h4 style="text-align: center">Aplikasi Point Of Sale</h4>
	</tr>

	<tr>
		<td style="text-align: center">Alamat Toko</td>
	</tr>
</table>

<table>

	<?php 

		$sql = $koneksi->query("select * from tb_penjualan where kode_penjualan='$kode_pj'");

		$tampil = $sql->fetch_assoc();

	 ?>
	<tr>
		
		<td>Kode Penjualan &nbsp&nbsp</td>
		<td>:&nbsp&nbsp <?php echo $tampil['kode_penjualan']; ?></td>

	</tr>

	<tr>
		
		<td>Tanggal Penjualan &nbsp&nbsp</td>
		<td>:&nbsp&nbsp <?php echo $tampil['tgl_penjualan']; ?></td>

	</tr> 

	<tr>
		
		<td>Tanggal Penjualan &nbsp&nbsp</td>
		<td>:&nbsp&nbsp <?php echo $tampil['waktu']; ?></td>

	</tr> 

	<tr>
		
		<td>Nama Kasir &nbsp&nbsp</td>
		<td>:&nbsp&nbsp <?php echo $kasir ?></td>

	</tr>

	<td><hr></td><td><hr></td><td><hr></td><td><hr></td>


	<?php 

		$sql5 = $koneksi->query("select * from tb_penjualan, tb_penjualan_detail, tb_barang where tb_penjualan.kode_penjualan=tb_penjualan_detail.kode_penjualan and tb_penjualan.kode_barang=tb_barang.kode_barang and tb_penjualan.kode_penjualan='$kode_pj'");

		while($tampil2 = $sql5->fetch_assoc()){
			
			
	?>

	<tr>
		<td><?php echo "x ".$tampil2['jumlah'] ?></td>
		<td><?php echo $tampil2['nama_barang'] ?></td>
		<td><?php echo "Rp"."&nbsp". number_format($tampil2['harga_jual']).',-'; ?></td>
		<td><?php echo "Rp"."&nbsp". number_format($tampil2['total']).',-'; ?></td>
	</tr>

	<?php 

		$diskon = $tampil2['diskon'];
		$potongan = $tampil2['potongan'];
		$bayar = $tampil2['bayar'];
		$kembali = $tampil2['kembali'];
		$total_b = $tampil2['total_b'];
		$total_bayar= $total_bayar + $tampil2['total'];

		

	?>
	<?php } ?>

		<td><hr></td><td><hr></td><td><hr></td><td><hr></td>


	<tr>
		
		<th colspan="3" style="text-align: left;">Total</th>
		<td>: <?php echo "Rp"."&nbsp". number_format($total_bayar).',-'; ?></td>

	</tr>
<!-- 
	<tr>
		
		<th colspan="3" style="text-align: left;">PPN 10%</th>
		<td>: <?php echo $diskon .'%'; ?></td>

	</tr>

	<tr>
		
		<th colspan="3" style="text-align: left;">Potongan Pajak</th>
		<td>: <?php echo "Rp"."&nbsp". number_format($potongan).',-'; ?></td>

	</tr>

	<tr>
		
		<th colspan="3" style="text-align: left;">Sub Total</th>
		<td>: <?php echo "Rp"."&nbsp". number_format($total_b).',-'; ?></td>

	</tr>
 -->
	<tr>
		
		<th colspan="3" style="text-align: left;">Bayar</th>
		<td>: <?php echo "Rp"."&nbsp". number_format($bayar).',-'; ?></td>

	</tr>

	<tr>
		
		<th colspan="3" style="text-align: left;">Kembali</th>
		<td>: <?php echo "Rp"."&nbsp". number_format($kembali).',-'; ?></td>


	</tr>
		

</table>
<br>
<table align="center">
	<tr>
		<td style="text-align: center">Barang yang sudah dibeli tidak dapat dikembalikan atau ditukar</td>
	</tr>
	<tr>
		<td style="text-align: center">Terima kasih atas kunjungan anda</td>
	</tr>
</table>

<br>

<input type="button" value="Print" onclick="window.print()">
