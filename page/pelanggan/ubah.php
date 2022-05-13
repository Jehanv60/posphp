<?php
$kode = $_GET['id'];

$sql = $koneksi->query("select * from tb_pelanggan where kode_pelanggan = '$kode'");
$tampil=$sql->fetch_assoc();



?>

 <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                Tambah Pelanggan
                                
                            </h2>
                        </div>
                            <div class="body">
                            <form method="POST">
                            <label for="">Nama</label> 
                            <div class="form-group">
                                <div class="form-line">
                                <input type="text" name="namas" value="<?php echo $tampil['namas']; ?>" class="form-control" />
                                </div>
                            </div>
                            <label for="">Alamat</label> 
                            <div class="form-group">
                                <div class="form-line">
                                <input type="text" name="alamat" value="<?php echo $tampil['alamat']; ?>" class="form-control" />
                                </div>
                            </div>

                           
                                <label for="">Telpon</label> 
                            <div class="form-group">
                                <div class="form-line">
                                <input type="number" name="telpon" value="<?php echo $tampil['telpon']; ?>" class="form-control" />
                                </div>
                            </div>

                            <label for="">Email</label> 
                            <div class="form-group">
                                <div class="form-line">
                                <input type="text" name="email" value="<?php echo $tampil['email']; ?>" class="form-control" />
                                </div>
                            </div>

                            
                           	<input type="submit" name="simpan" value="simpan" class="btn btn-primary">

                    </form>

    <?php
    	if(isset($_POST['simpan'])){

    		$namas = $_POST['namas'];
    		$alamat = $_POST['alamat'];
    		$telpon = $_POST['telpon'];
    		$email = $_POST['email'];
    		

    		$sql = $koneksi->query("update tb_pelanggan set namas='$namas', alamat='$alamat', telpon='$telpon', email='$email' where kode_pelanggan='$kode'");

    		if ($sql){
    			?>
    			<script type="text/javascript">
    				alert("Data Pelanggan Berhasil Diubah");
    				window.location.href="?page=pelanggan";
    			</script>
    			<?php
    		}
    	}
    ?>