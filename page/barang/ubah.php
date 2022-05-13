<script>
function sum() {
	var harga_beli = document.getElementById('harga_beli').value;
	var harga_jual = document.getElementById('harga_jual').value;
	var result =parseInt(harga_jual) - parseInt(harga_beli);
	if (!isNaN(result)){
		document.getElementById('profit').value = result;
	}
}
</script>

<?php
$kode2 = $_GET['id'];

$sql = $koneksi->query("select * from tb_barang where kode_barang = '$kode2'");
$tampil=$sql->fetch_assoc();

$satuan = $tampil['satuan'];

?>

<?php 
$sql5 = $koneksi->query("select * from tb_pelanggan");
            while ($data = $sql5->fetch_assoc()){
             ?>

<div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                Ubah Barang
                                
                            </h2>
                        </div>
                            <div class="body">
                            <form method="POST">
                            <label for="">kode barang</label> 
                            <div class="form-group">
                                <div class="form-line">
                                <input type="text" name="kode" onkeyup="this.value = this.value.toUpperCase()" value="<?php echo $tampil['kode_barang']; ?>" class="form-control" />
                                </div>
                            </div>
                            <label for="">Nama Barang</label> 
                            <div class="form-group">
                                <div class="form-line">
                                <input type="text" name="nama" value="<?php echo $tampil['nama_barang']; ?>" class="form-control" />
                                </div>
                            </div>

                            <label for="">Supplier</label> 
                            <div class="form-group">
                                <div class="form-line">
                                    <select name="supplier" class="form-control show-tick">
                                        <?php 
                                        do {
                                         ?>

                                        <option value="<?php echo $data['namas'] ?>"> <?php echo $data['namas'] ?>
                                        </option>
                                        <?php 
                                        }while ($data = $sql5->fetch_assoc());{

                                        }  ?>
                                        
                                        
                                    </select>
                                </div>
                            </div>

                             <label for="">Tanggal Beli</label> 
                            <div class="form-group">
                                <div class="form-line">
                                <input type="date" name="tglbeli" value="<?php echo $tampil['tglbeli']; ?>" class="form-control" />
                                </div>
                            </div>

                            <label for="">Satuan</label> 
                            <div class="form-group">
                            	<div class="form-line">
                                    <select name="satuan" class="form-control show-tick">
                                        
                                        <option value="Lusin" <?php if($satuan=='Lusin') { echo "selected"; }  ?>>Lusin</option>
                                        <option value="Pack" <?php if($satuan=='Pack') { echo "selected"; }  ?>>Pack</option>
                                        <option value="Pcs" <?php if($satuan=='Pcs') { echo "selected"; }  ?>>Pcs</option>
                                        
                                    </select>
                                </div>
                            </div>
                                <label for="">Harga Beli</label> 
                            <div class="form-group">
                                <div class="form-line">
                                <input type="number" min="1" name="hbeli"  id="harga_beli" onkeyup="sum()" value="<?php echo $tampil['harga_beli']; ?>" class="form-control" />
                                </div>
                            </div>

                            <label for="">Stok</label> 
                            <div class="form-group">
                                <div class="form-line">
                                <input type="number" min="1" name="stok" value="<?php echo $tampil['stok']; ?>" class="form-control" />
                                </div>
                            </div>

                            <label for="">Harga Jual</label> 
                            <div class="form-group">
                                <div class="form-line">
                                <input type="number" min="1" name="hjual"  id="harga_jual" onkeyup="sum()" value="<?php echo $tampil['harga_jual']; ?>" class="form-control" />
                                </div>
                            </div>

                            <label for="">Profit</label> 
                            <div class="form-group">
                                <div class="form-line">
                                <input type="number" name="profit"  id="profit" value="<?php echo $tampil['profit']; ?>" readonly="" style="background-color: #e7e3e9;" value="0" class="form-control" />
                                </div>
                            </div>
                           	<input type="submit" name="simpan" value="simpan" class="btn btn-primary">
                    </form>

    <?php
    	if(isset($_POST['simpan'])){
    		$kode = $_POST['kode'];
    		$nama = $_POST['nama'];
            $supplier = $_POST['supplier'];
            $tglbeli = $_POST['tglbeli'];
    		$satuan = $_POST['satuan'];
    		$hbeli = $_POST['hbeli'];
    		$stok = $_POST['stok'];
    		$hjual = $_POST['hjual'];
    		$profit = $_POST['profit'];
$sql7 = $koneksi->query("select * from tb_barang where kode_barang = '$kode'");
$sama=$sql7->fetch_assoc();
        $sisa = $sama['kode_barang'];

        if($sisa = $sisa){
            ?>
            <script type="text/javascript">
                alert("Kode barang sudah ada");
            </script>
            <?php
        }
    		$sql2 = $koneksi->query("update tb_barang set kode_barang='$kode', nama_barang='$nama', satuan='$satuan', harga_beli='$hbeli', stok='$stok', harga_jual='$hjual', profit='$profit' , supplier='$supplier', tglbeli='$tglbeli' where kode_barang='$kode2'");

    		if ($sql2){
    			?>
    			<script type="text/javascript">
    				alert("Data Berhasil Diubah");
    				window.location.href="?page=barang";
    			</script>
    			<?php
    		}
    	}
    ?>
    <?php } ?>