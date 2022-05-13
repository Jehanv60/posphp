<?php 
 
 include "koneksi.php";

 ?>
 <script type="text/javascript">
    function post_value(s){
    opener.document.getElementById('terpilih').value = s;
self.close();
} 

 </script>

<table border="1"  width="100%" style="border-collapse: collapse;">

	<caption>Laporan Data Barang</caption>
	<thead>
		<tr>
			<th>No</th>
			<th>Kode Barang</th>
			<th>Nama Barang</th>
            <th>Stok</th>
            <th>Aksi</th>

		</tr>
	</thead>
	<tbody>
	 <?php
    $no=1;
    	$sql = $koneksi->query("select * from tb_barang");

    while ($data = $sql->fetch_assoc()){

?>
    <tr>

        <td><?php echo $no++; ?></td>
        <td><?php echo $data['kode_barang'] ?></td>
        <td><?php echo $data['nama_barang'] ?></td>
        <td><?php echo $data['stok'] ?></td>
        <td><input type="submit" value="pilih" href='#' onclick="post_value('<?php echo $data['kode_barang'] ?>')"></input></td>
        
   
         
    </tr>
    <?php } ?>
</tbody>

</table>

