<div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                Tambah Pelanggan
                                
                            </h2>
<?php  
session_start();
if($_POST['simpan']){

    
$namas = $_POST['namas'];
$alamat = $_POST['alamat'];
$telpon = $_POST['telpon'];
$email = $_POST['email'];
            

$error=array();
if (empty($namas)){
    $error['namas']="Nama tidak boleh kosong";
}
if (empty($alamat)){
    $error['alamat']="Alamat tidak boleh kosong";
}
if (empty($telpon)){
    $error['telpon']="Telpon tidak boleh kosong";
}
if (empty($email)){
    $error['email']="Email tidak boleh kosong";
}
if (empty($error)){
    
            $sql = $koneksi->query("insert into tb_pelanggan (namas, alamat, telpon, email) values('$namas', '$alamat', '$telpon', '$email')");

            if ($sql){
                ?>
                <script type="text/javascript">
                    alert("Data Pelanggan Berhasil Disimpan");
                    window.location.href="?page=pelanggan";
                </script>
                <?php
            }
}else{  
        $_SESSION['error'] = $error;  
        $_SESSION['post'] = $_POST;  
        header("location: pelanggan.php");  
    }  
    }
?>  
                        </div>
                            <div class="body">
                            <form action="" method="POST">
                            <label for="">Nama</label> 
                            <div class="form-group">
                                <div class="form-line">
                                <input type="text" name="namas" value="<?php echo isset($_POST['namas']) ? $_POST['namas'] : '';?>" class="form-control" />
                                </div>
                                 <p style="color:red;"><?php echo isset($error['namas']) ? $error['namas'] : '';?></p>
                            </div>
                            <label for="">Alamat</label> 
                            <div class="form-group">
                                <div class="form-line">
                                <input type="text" name="alamat" value="<?php echo isset($_POST['alamat']) ? $_POST['alamat'] : '';?>" class="form-control" />
                                </div>
                                <p style="color:red;"><?php echo isset($error['alamat']) ? $error['alamat'] : '';?></p>
                            </div>

                           
                                <label for="">Telpon</label> 
                            <div class="form-group">
                                <div class="form-line">
                                <input type="number" name="telpon" value="<?php echo isset($_POST['telpon']) ? $_POST['telpon'] : '';?>" class="form-control" />
                                </div>
                                <p style="color:red;"><?php echo isset($error['telpon']) ? $error['telpon'] : '';?></p>
                            </div>

                            <label for="">Email</label> 
                            <div class="form-group">
                                <div class="form-line">
                                <input type="text" name="email" value="<?php echo isset($_POST['email']) ? $_POST['email'] : '';?>" class="form-control" />
                                </div>
                                <p style="color:red;"><?php echo isset($error['email']) ? $error['email'] : '';?></p>
                            </div>

                            
                           	<input type="submit" name="simpan" value="simpan" class="btn btn-primary">

                    </form>

    