<?php 
include "kodepj.php";

include "koneksi.php";

$kode = $_GET['kodepj'];

$kasir = $data['nama'];
?>
<?php
$hari = date('l');
/*$new = date('l, F d, Y', strtotime($Today));*/
if ($hari=="Sunday") {
	echo "Minggu";
}elseif ($hari=="Monday") {
	echo "Senin";
}elseif ($hari=="Tuesday") {
	echo "Selasa";
}elseif ($hari=="Wednesday") {
	echo "Rabu";
}elseif ($hari=="Thursday") {
	echo("Kamis");
}elseif ($hari=="Friday") {
	echo "Jum'at";
}elseif ($hari=="Saturday") {
	echo "Sabtu";
}
?>

<?php
$tgl1 =date('d');
echo $tgl1;
$bulan =date('F');
if ($bulan=="January") {
	echo " Januari ";
}elseif ($bulan=="February") {
	echo " Februari ";
}elseif ($bulan=="March") {
	echo " Maret ";
}elseif ($bulan=="April") {
	echo " April ";
}elseif ($bulan=="May") {
	echo " Mei ";
}elseif ($bulan=="June") {
	echo " Juni ";
}elseif ($bulan=="July") {
	echo " Juli ";
}elseif ($bulan=="August") {
	echo " Agustus ";
}elseif ($bulan=="September") {
	echo " September ";
}elseif ($bulan=="October") {
	echo " Oktober ";
}elseif ($bulan=="November") {
	echo " November ";
}elseif ($bulan=="December") {
	echo " Desember ";
}
$tahun=date('Y');
echo $tahun;
?>

<script type="text/javascript">        
    function tampilkanwaktu(){         //fungsi ini akan dipanggil di bodyOnLoad dieksekusi tiap 1000ms = 1detik    
    var waktu = new Date();            //membuat object date berdasarkan waktu saat 
    var sh = waktu.getHours() + "";    //memunculkan nilai jam, //tambahan script + "" supaya variable sh bertipe string sehingga bisa dihitung panjangnya : sh.length    //ambil nilai menit
    var sm = waktu.getMinutes() + "";  //memunculkan nilai detik    
    var ss = waktu.getSeconds() + "";  //memunculkan jam:menit:detik dengan menambahkan angka 0 jika angkanya cuma satu digit (0-9)
    document.getElementById("clock").innerHTML = (sh.length==1?"0"+sh:sh) + ":" + (sm.length==1?"0"+sm:sm) + ":" + (ss.length==1?"0"+ss:ss);
}
</script>
<body onload="tampilkanwaktu();setInterval('tampilkanwaktu()', 1000);">        
	<span id="clock"></span> 
</body>
<div class="row clearfix">
	<div class="body">
		<form method="POST">
			<div class="col-md-2">
				<p>Kode Penjualan</p>
				<input type="text" name="kode" value="<?php echo $kode; ?> " class="form-control" readonly="" />
			</div>

			<div class="col-md-2">
				<p>Kode Barang</p>
				<input type="text" name="kode_barang" id="terpilih" autocomplete="off" onkeyup="this.value = this.value.toUpperCase()" class="form-control" autofocus="" required/>

				<button data-toggle="modal" data-id="<? php echo $data27->kode_barang ?> " data-target="#defaultModal" type="button" style="padding: 5px 60px;" href="javascript:void(0);" class="btn bg-blue waves-effect" ><i class="material-icons">search</i></button>
				<!-- <button onclick="window.open('page/penjualan/cetakk.php', 'ratting','width=600px, top=20px, height=600px, left=375px;')"></button> -->
			</div>

			<div class="col-md-2">
				<p>Jumlah</p>    
				<input type="number" name="jumlah" value="1" min="1" placeholder="Jumlah" class="form-control" />
			</div>


			<div class="col-md-2">
				<p>Diskon</p>   
				<input type="number" name="diskonb" value="0" min="0" placeholder="Diskon" class="form-control" />
			</div>

			<div class="col-md-2">
				<p><br></p>
				<input type="submit" name="simpan" style="padding: 7px 10px;" value="Tambahkan" class="btn btn-primary">
				<p><br></p>
			</div>

		</form>
	</body>
</div>
</div>
<?php


if(isset($_POST['simpan'])){
	date_default_timezone_set('Asia/Jakarta');
	$date = date("Y-m-d");

	$waktu = date("H:i:s");

	$kd_pj = $_POST['kode'];

	$barcode = $_POST['kode_barang'];

	$barang = $koneksi->query("select * from tb_barang where kode_barang='$barcode'");

	$data_barang=$barang->fetch_assoc();

	$harga_jual = $data_barang['harga_jual'];

	$jumlah = $_POST['jumlah'];

	$diskonb = $_POST['diskonb'];

	$kali = $jumlah * $harga_jual;

	$bagi = $kali * $diskonb/100;

	$total = $kali - $bagi; 

	$barang2 = $koneksi->query("select * from tb_barang where kode_barang='$barcode'");

	while ($data_barang2 = $barang2->fetch_assoc()){
		$sisa = $data_barang2['stok'];

		if($sisa < 1){
			?>
			<script type="text/javascript">
				alert("Stok Barang Habis");
				window.location.href="?page=penjualan&kodepj=<?php echo $kode; ?>"
			</script>
			<?php
		}
		if($jumlah > $sisa){
			?>
			<script type="text/javascript">
				alert("Stok Barang Tidak Mencukupi");
				window.location.href="?page=penjualan&kodepj=<?php echo $kode; ?>"
			</script>
			<?php
		}
		else{
			$koneksi->query("insert into tb_penjualan (kode_penjualan, kode_barang, jumlah, total, tgl_penjualan, waktu)values('$kd_pj', '$barcode', '$jumlah', '$total', '$date', '$waktu')");
		}

	}

}

?>


<form method="POST">
	<div class="row clearfix">
		<div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
			<div class="card">
				<div class="header">
					<h2>
						Daftar Barang
					</h2>
				</div>
				<div class="body">
					<div class="table-responsive">
						<table class="table table-striped ">
							<thead>
								<tr>
									<th>No</th>
									<th>Kode Barang</th>
									<th>Nama Barang</th>
									<th>Harga</th>
									<th>Jumlah</th>
									<th>Total</th>
									<th>Sisa Barang</th>
									<th>Aksi</th>
								</tr>
							</thead>
							<tbody>

								<?php
								$no=1;

								$sql = $koneksi->query("select * from tb_penjualan, tb_barang where tb_penjualan.kode_barang=tb_barang.kode_barang AND kode_penjualan='$kode'");
								while ($data = $sql->fetch_assoc()){
									?>
									<tr>
										<td><?php echo $no++; ?></td>
										<td><?php echo $data['kode_barang'] ?></td>
										<td><?php echo $data['nama_barang'] ?></td>
										<td><?php echo $data['harga_jual'] ?></td>
										<td><?php echo $data['jumlah'] ?></td>
										<td><?php echo $data['total'] ?></td>
										<td><?php echo $data['stok'] ?></td>

										<td>
											<a onclick="return confirm('Apakah anda yakin akan menghapus data ini?')" href="?page=penjualan&aksi=hapus&id=<?php echo $data['id'] ?>&kode_pj=<?php echo $data['kode_penjualan'] ?>&harga_jual=<?php echo $data['harga_jual'] ?>&kode_b=<?php echo $data['kode_barang'] ?>&jumlah=<?php echo $data['jumlah']; ?>" tittle="Hapus" class="btn btn-danger"><i class="material-icons">clear</i></a> 
										</td>
									</tr>


									<?php 
									$total_bayar = $total_bayar+$data['total'];
								} 
								?>

							</tbody>

							<tr>
                            <!-- <?php 
                            $ppn=$total_bayar*10/100;
                            $pajak=$total_bayar+$ppn;
                            ?> -->

                            <?php 
                            session_start();
                            if (isset($_POST['simpan_pj'])) {
                            	date_default_timezone_set('Asia/Jakarta');
                            	$datee = date("Y-m-d");          
                            	$total_bayar = $_POST['total_bayar'];
                            	$diskon = $_POST['diskon'];
                            	$potongan = $_POST['potongan'];
                            	$s_total = $_POST['s_total'];
                            	$bayar = $_POST['bayar'];
                            	$kembali = $_POST['kembali'];

                            	$error=array();
                            	if (empty($total_bayar)){
                            		$error['total_bayar']="Masukkan Barang!";
                            	}
                            	if (empty($error)){
                            		$sql=$koneksi->query("insert into tb_penjualan_detail(kode_penjualan, bayar, kembali, diskon, potongan, total_b, tgl_detail)values('$kode', '$bayar', '$kembali', '$diskon', '$potongan', '$s_total', '$datee')");
                            		if ($sql){
                            			?>
                            			<script type="text/javascript">
                            				alert("Data Penjualan Berhasil Disimpan");
                            				window.location.href="?page=penjualan&kodepj=<?php echo $kode; ?>"
                            			</script>
                            			<?php
                            		}
                            	}else{  
                            		$_SESSION['error'] = $error;  
                            		$_SESSION['post'] = $_POST;  
                            		header("location: penjualan.php");  
                            	}  
                            }  

                            ?>

                        </tr>

                    </div>

                </form>
            </table>
        </div>
    </div>
</div>
</div>
<?php 
if ($bayar < $s_total) {
	?>
	<script type="text/javascript">
		alert("Uang Kurang");
		window.location.href="?page=penjualan&kodepj=<?php echo $kode; ?>"
	</script>
	<?php
}

?>
<script>
function nextfieldBarcode(event){  // fungsi saat tombol enter
	if(event.keyCode == 13 || event.which == 13){
		document.getElementById('bayar').focus();
	} 
}
</script>
<script type="text/javascript">
	function hitung(){

		var total_bayar = document.getElementById('total_bayar').value;

        // var diskon = document.getElementById('diskon').value;

        // var diskon_pot = parseInt(total_bayar) * parseInt(diskon)/parseInt(100);

        // if (!isNaN(diskon_pot)){
        //     var potongan = document.getElementById('potongan').value = diskon_pot; 

        // }
        var sub_total = parseInt(total_bayar);

        // if (!isNaN(sub_total)){
        //     var s_total = document.getElementById('s_total').value = sub_total; 

        // }

        var bayar = document.getElementById('bayar').value;

        var bayar_b = parseInt(bayar) - parseInt(total_bayar);

        if (!isNaN(bayar_b)){
        	document.getElementById('kembali').value = bayar_b; 

        }
    }
</script>
<form method="POST">
	<div class="row clearfix">
		<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
			<div class="card">             
				<div class="header">
					<h2>
						Pembayaran 
					</h2>
				</div>
				<div class="body">
					<div class="table-responsive">
						<table class="table table-striped ">

							<th  style="text-align: right;">Total</th>
							<td> <input type="number" readonly="" style="text-align: right;" name="total_bayar" id="total_bayar" onkeyup="hitung();" value="<?php echo $total_bayar; ?>"><p style="color: red;"><?php echo isset($error['total_bayar']) ? $error['total_bayar'] : '';?></p> </td>

						</tr>

                <!-- <tr>

                    <th style="text-align: right;">PPN 10%</th>
                    <td> <input type="hidden" style="text-align: right;" value="10" onkeyup="hitung();" readonly="" name="diskon" id="diskon"> </td>

                </tr>

                <tr>

                    <th  style="text-align: right;">Potongan Pajak</th>
                    <td> <input type="number" style="text-align: right;" value="<?php echo $ppn ?>" name="potongan" readonly="" id="potongan"> </td>

                </tr> -->

                <!-- <tr>

                    <th  style="text-align: right;">Sub Total</th>
                    <td> <input type="number" style="text-align: right;" name="s_total" readonly="" id="s_total"> </td>

                </tr> -->

                <tr>
                	<th  style="text-align: right;">Bayar</th>
                	<td> <input type="number" autofocus="" style="text-align: right;" onkeyup="hitung();" min="1" name="bayar" id="bayar" value="<?php echo isset($_POST['bayar']) ? $_POST['bayar'] : '';?>"  >
                	</td>
                </tr>

                <tr>

                	<th  style="text-align: right;">Kembali</th>
                	<td> <input type="number" style="text-align: right;" readonly="" name="kembali" id="kembali"> 
                		<p></p>
                		<input type="submit" name="simpan_pj" value="Simpan" class="btn btn-success"> 

                		<input type="submit" name="cetak" value="Cetak" class="btn btn-success" onclick="window.open('page/penjualan/cetak.php?kode_pjl=<?php echo $kode; ?>&kasir=<?php echo $kasir; ?>','mywindow','width=500px, top=20px, height=450px, left=375px;')">

                	</td>

                </tr>
            </div>
        </div>
    </table>
</div>
</div>
<script type="text/javascript">
	$(document).ready(function post_value(s){
		$('pilih').click(function post_value(s){
			var databack = $("#defaultmodal").val().trim();
			$('#terpilih').html(databack;)
		});
	});

</script>
<div class="modal fade" id="defaultModal" tabindex="-1" role="dialog">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" id="defaultModalLabel">Data Barang</h4>
			</div>
			<div class="modal-body">
				<form method="POST" action="page/penjualan/cetakkk.php" target="blank">
					<div class="body">
						<div class="table-responsive">
							<table class="table table-bordered table-striped table-hover js-basic-example dataTable">
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

									$sql20 = $koneksi->query("select * from tb_barang");
									while ($data27 = $sql20->fetch_assoc()){
										
										?>

								
										<tr>

											<td><?php echo $no++; ?></td>
											<td><?php echo $data27['kode_barang'] ?></td>
											<td><?php echo $data27['nama_barang'] ?></td>
											<td><?php echo $data27['stok'] ?></td>
											<td><input  class="btn btn-success" type="submit" data-id="<?php $data27->kode_barang ?> " value="pilih" href='#' id="pilih" data-dismiss="modal" onclick="post_value('<?php echo $data27['kode_barang'] ?>')"></input></td>

										</tr>
										<?php } ?>
									</tbody>

								</table>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>


