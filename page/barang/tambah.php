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
$sama=$sql->fetch_assoc();

?>
<div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                Tambah Barang                          
                            </h2>
<?php  
session_start();
if($_POST['simpan']){ 
$kode = $_POST['kode'];
$nama = $_POST['nama'];
$supplier = $_POST['supplier'];
$tglbeli = $_POST['tglbeli'];
$satuan = $_POST['satuan'];
$hbeli = $_POST['hbeli'];
$jumlah1 = $_POST['stok'];
$stok = $_POST['stok'];
$hjual = $_POST['hjual'];
$profit = $_POST['profit'];

$error=array();
if (empty($kode)){
    $error['kode']="Kode tidak boleh kosong";
}
if (empty($nama)){
    $error['nama']="Nama tidak boleh kosong";
}
if (empty($tglbeli)){
    $error['tglbeli']="Tanggal tidak boleh kosong";
}
if (empty($hbeli)){
    $error['hbeli']="Harga Beli tidak boleh kosong";
}
if (empty($stok)){
    $error['stok']="Stok tidak boleh kosong";
}
if (empty($hjual)){
    $error['hjual']="Harga Jual tidak boleh kosong";
}
if (empty($error)){


$sql = $koneksi->query("select * from tb_barang where kode_barang = '$kode'");
$sama=$sql->fetch_assoc();
        $sisa = $sama['kode_barang'];

        if($sisa = $sisa){
            ?>
            <script type="text/javascript">
                alert("Kode barang sudah ada");
            </script>
            <?php
        }
    
            $sql = $koneksi->query("insert into tb_barang values('$kode', '$nama', '$satuan', '$hbeli', '$jumlah1', '$stok', '$hjual', '$profit', '$supplier', '$tglbeli')");
           
            if ($sql){
                ?>
                <script type="text/javascript">
                    alert("Data Berhasil Disimpan");
                    window.location.href="?page=barang";
                </script>
                <?php
            }
}else{  
        $_SESSION['error'] = $error;  
        $_SESSION['post'] = $_POST;  
        header("location: barang.php");  
    }  
    }  
?>  
<?php 
$sql5 = $koneksi->query("select * from tb_pelanggan");
            while ($data = $sql5->fetch_assoc()){
             ?>
                        </div>
                            <div class="body">
                            <form action ="" method="POST">
                            <label for="">kode barang</label> 
                            <div class="form-group">
                                <div class="form-line">
                                <input type="text" name="kode" onkeyup="this.value = this.value.toUpperCase()" value="<?php echo isset($_POST['kode']) ? $_POST['kode'] : '';?>" class="form-control" />
                               
                             </div>
                             <p style="color:red;"><?php echo isset($error['kode']) ? $error['kode'] : '';?></p> 
                         </div>
                            <label for="">Nama Barang</label> 
                            <div class="form-group">
                                <div class="form-line">
                                <input type="text" name="nama" value="<?php echo isset($_POST['nama']) ? $_POST['nama'] : '';?>" class="form-control" />
                                </div>
                                <p style="color:red;"><?php echo isset($error['nama']) ? $error['nama'] : '';?></p>
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
                                <input type="date" name="tglbeli" value="<?php echo isset($_POST['tglbeli']) ? $_POST['tglbeli'] : '';?>" class="form-control" />
                                </div>
                                <p style="color:red;"><?php echo isset($error['tglbeli']) ? $error['tglbeli'] : '';?></p>
                            </div>

                            <label for="">Satuan</label> 
                            <div class="form-group">
                            	<div class="form-line">
                                    <select name="satuan" class="form-control show-tick">
                                        <option value="">-- Pilih --</option>
                                        <option value="Lusin">Lusin</option>
                                        <option value="Pack">Pack</option>
                                        <option value="Pcs">Pcs</option>
                                        
                                    </select>
                                </div>
                            </div>
                                <label for="">Harga Beli</label> 
                            <div class="form-group">
                                <div class="form-line">
                                <input type="number" name="hbeli" min="1" value="<?php echo isset($_POST['hbeli']) ? $_POST['hbeli'] : '';?>" id="harga_beli" onkeyup="sum()" class="form-control" />
                                </div>
                                <p style="color:red;"><?php echo isset($error['hbeli']) ? $error['hbeli'] : '';?></p>
                            </div>

                            <label for="">Stok</label> 
                            <div class="form-group">
                                <div class="form-line">
                                <input type="number" name="stok" min="1" value="<?php echo isset($_POST['stok']) ? $_POST['stok'] : '';?>" class="form-control" />
                                </div>
                                <p style="color:red;"><?php echo isset($error['stok']) ? $error['stok'] : '';?></p>
                            </div>
                            <label for="">Harga Jual</label> 
                            <div class="form-group">
                                <div class="form-line">
                                <input type="number" name="hjual" min="1" value="<?php echo isset($_POST['hjual']) ? $_POST['hjual'] : '';?>" id="harga_jual" onkeyup="sum()" class="form-control" />
                                </div>
                                <p style="color:red;"><?php echo isset($error['hjual']) ? $error['hjual'] : '';?></p>
                            </div>

                            <label for="">Profit</label> 
                            <div class="form-group">
                                <div class="form-line">
                                <input type="number" name="profit" id="profit" readonly="" style="background-color: #e7e3e9;" value="0" class="form-control" />
                                </div>
                            </div>
                           	<input type="submit" name="simpan" value="simpan" class="btn btn-primary">
                 <?php } ?>
                 </form> 