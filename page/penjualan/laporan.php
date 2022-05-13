<?php 
error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
    include "koneksi.php";


?>
<style>
	@media print{
		input.noPrint{
			display: none;
		}
	}	
</style>

<table border="1"  width="100%" style="border-collapse: collapse;">

	<?php 	 
	$tgl_awal = $_POST['tgl_awal'];
	$tgl_akhir = $_POST['tgl_akhir']; 
	?>
	<caption>Laporan Penjualan dari <?php echo date('d F Y', strtotime($tgl_awal)) ?> sampai <?php echo date('d F Y', strtotime($tgl_akhir)) ?></caption>
	<thead>
		<tr>
			<th>No</th>
			<th>Tanggal</th>
			<th>Waktu</th>
			<th>Kode Barang</th>
			<th>Kode Penjualan</th>
			<th>Nama Barang</th>
			<th>Supplier</th>
			<th>Harga Jual</th>
			<th>Jumlah</th>
			<th>Total</th>
			<th>Profit</th>
		</tr>

	</thead>
	<tbody>
		<?php
		$tgl_awal = $_POST['tgl_awal'];
		$tgl_akhir = $_POST['tgl_akhir'];
		
		$no=1;

		$sql = $koneksi->query("select * from tb_barang, tb_penjualan where tb_barang.kode_barang=tb_penjualan.kode_barang and tgl_penjualan between '$tgl_awal' and '$tgl_akhir' order by kode_penjualan");
		while ($data = $sql->fetch_assoc()){
			$profit = $data['profit'] * $data['jumlah'];
			?>
			
			<tr>
				<td><?php echo $no++; ?></td>
				<td><?php echo date('d F Y', strtotime($data['tgl_penjualan'])) ?></td>
				<td><?php echo date('H:i:s', strtotime($data['waktu'])) ?></td>
				<td><?php echo $data['kode_barang'] ?></td>
				<td><?php echo $data['kode_penjualan'] ?></td>
				<td><?php echo $data['nama_barang'] ?></td>
				<td><?php echo $data['supplier'] ?></td>
				<td><?php echo "Rp"."&nbsp". number_format($data['harga_jual']) ?></td>
				<td><?php echo $data['jumlah'] ?></td>
				<td><?php echo "Rp"."&nbsp". number_format($data['total']) ?></td>
				<td><?php echo "Rp"."&nbsp". number_format ($profit) ?></td>
				
				
			</tr>

			<?php

			$total_pj = $total_pj+$data['total'];
			$total_profit= $total_profit+$profit;
		} 
		?>
	</tbody>

	<tr>
		
		<th colspan="9">Total Penjualan dan Profit</th>
		<td><?php echo "Rp"."&nbsp". number_format($total_pj) ?></td>
		<td><?php echo "Rp"."&nbsp". number_format($total_profit) ?></td>


	</table>
<!-- 

	<table border="1" width="50%" style="border-collapse: collapse;">
		<p>	</p>


		<caption>Laporan Pembelian dari <?php echo date('d F Y', strtotime($tgl_awal)) ?> sampai <?php echo date('d F Y', strtotime($tgl_akhir)) ?></caption>
		<thead>
			<tr>
				<th>No</th>
				<th>Kode Barang</th>
				<th>Nama Barang</th>
				<th>Supplier</th>
				<th>Tanggal</th>
				<th>Satuan</th>
				<th>Harga dibeli</th>
				<th>Jumlah</th>
				<th>Total</th>
			</tr>

		</thead>
		<tbody>
			<?php
			$tgl_awal = $_POST['tgl_awal'];
			$tgl_akhir = $_POST['tgl_akhir'];
			$no=1;
			$sql2 = $koneksi->query("select * from tb_barang where tglbeli between '$tgl_awal' and '$tgl_akhir' order by tglbeli asc");
			
			while ($data2 = $sql2->fetch_assoc()){
				
				?>
				<?php 
				$totals = ($data2['harga_beli'] * $data2['jumlah1']);


				?>
				<tr>
					<td><?php echo $no++; ?></td>
					<td><?php echo $data2['kode_barang'] ?></td>
					<td><?php echo $data2['nama_barang'] ?></td>
					<td><?php echo $data2['supplier'] ?></td>
					<td><?php echo date('d F Y', strtotime($data2['tglbeli'])) ?></td>
					<td><?php echo $data2['satuan'] ?></td>
					<td><?php echo "Rp"."&nbsp". number_format($data2['harga_beli']) ?></td>
					<td><?php echo $data2['jumlah1'] ?></td>
					<td><?php echo $totals ?></td>
					

					
				</tr>

				<?php
				$total_beli = $total_beli+$totals;
			} 
			?>
		</tbody>

		<tr>
			
			<th colspan="8">Total Pembelian</th>
			<td><?php echo "Rp"."&nbsp". number_format($total_beli) ?></td>


		</tr>

	</table>
	<br> <input type="button" class="noPrint" value="Cetak" onclick="window.print()">
