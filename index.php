<?php

session_start();

include "kodepj.php";

include "koneksi.php";

if($_SESSION['Admin'] || $_SESSION['Kasir']){
    ?>
    <!DOCTYPE html>
    <html>

    <head>
        <div class="table-responsive">
            <meta charset="UTF-8">
            <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
            <title>Aplikasi Point Of Sale</title>
            <!-- Favicon-->
            <link rel="icon" href="../../favicon.ico" type="image/x-icon">
            <!-- Google Fonts -->
            <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
            <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">
            <!-- Bootstrap Core Css -->
            <link href="plugins/bootstrap/css/bootstrap.css" rel="stylesheet">
            <!-- Waves Effect Css -->
            <link href="plugins/node-waves/waves.css" rel="stylesheet" />
            <!-- Animation Css -->
            <link href="plugins/animate-css/animate.css" rel="stylesheet" />
            <link href="plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css" rel="stylesheet">
            <link href="plugins/bootstrap-select/css/bootstrap-select.css" rel="stylesheet" />
            <!-- Custom Css -->
            <link href="css/style.css" rel="stylesheet">
            <!-- AdminBSB Themes. You can choose a theme from css/themes instead of get all themes -->
            <link href="css/themes/all-themes.css" rel="stylesheet" />
        </head>
        <body class="theme-blue">
            <div class="page-loader-wrapper">
                <div class="loader">
                    <div class="preloader">
                        <div class="spinner-layer pl-blue">
                            <div class="circle-clipper left">
                                <div class="circle"></div>
                            </div>
                            <div class="circle-clipper right">
                                <div class="circle"></div>
                            </div>
                        </div>
                    </div>
                    <p>Mohon Tunggu...</p>
                </div>
            </div>
            <div class="overlay"></div>
            <nav class="navbar">
                <div class="container-fluid">
                    <div class="navbar-header">
                        <a href="javascript:void(0);" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse" aria-expanded="false"></a>
                        <a href="javascript:void(0);" class="bars"></a>
                        <a class="navbar-brand" href="http://localhost/projectpos/">Aplikasi Point Of Sale</a>
                    </div>
                </div>
            </nav>

            <?php 

            if($_SESSION['Admin']){
              $user = $_SESSION['Admin'];

          }elseif ($_SESSION['Kasir']){
              $user = $_SESSION['Kasir'];
          }

          $sql = $koneksi->query("select * from tb_pengguna where id='$user'");
          $data = $sql->fetch_assoc();
          ?>

          <section>
            <!-- Left Sidebar -->
            <aside id="leftsidebar" class="sidebar">
                <div class="user-info">
                    <div class="image">
                        <img src="images/<?php echo $data['foto'] ?>" width="50" height="50" alt="User" />
                    </div>
                    <div class="info-container">
                        <div class="name" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?php echo $data['nama']; ?></div>
                        <div class="email">Anda Login Sebagai, <?php echo $data['level']; ?></div>
                        <div class="btn-group user-helper-dropdown">
                            <i class="material-icons" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">keyboard_arrow_down</i>
                            <ul class="dropdown-menu pull-right">
                                <li><a href="?page=info"><i class="material-icons">person</i>Profile</a></li>
                                <li role="separator" class="divider"></li>
                                
                                
                                <li><a href="logout.php"><i class="material-icons">input</i>Log Out</a></li>

                            </ul>
                        </div>
                    </div>
                </div>
                <!-- #User Info -->
                <!-- Menu -->
                <div class="menu">
                    <ul class="list">
                        <li class="header">MENU UTAMA</li>
                        <li>
                            <a href="index.php">
                                <i class="material-icons">home</i>
                                <span>Home</span>
                            </a>
                        </li>
                        <?php  if($_SESSION['Admin']){?>
                        <li>
                            <a href="javascript:void(0);" class="menu-toggle">
                                <i class="material-icons">history</i>
                                <span>Master Data</span>
                            </a>
                            <ul class="ml-menu">
                                <li>
                                    <a href="?page=barang">
                                        <i class="material-icons">view_module</i>
                                        <span>Barang</span>
                                    </a>

                                    <a href="?page=pelanggan">
                                        <i class="material-icons">supervisor_account</i>
                                        <span>Supplier</span>
                                    </a>

                                    <a href="?page=pengguna">
                                        <i class="material-icons">account_circle</i>
                                        <span>Akun</span>
                                    </a>
                                </ul>
                            </li>

                            <?php } ?>
                            <li>
                                <a href="javascript:void(0);" class="menu-toggle">
                                    <i class="material-icons">history</i>
                                    <span>Transaksi</span>
                                </a>
                                <ul class="ml-menu">
                                    <li>
                                        <a href="?page=penjualan&kodepj=<?php echo $kode; ?>">
                                            <i class="material-icons">shopping_cart</i>
                                            <span>Penjualan</span>
                                        </a>

                                        <a data-toggle="modal" data-target="#smallModal">
                                            <i class="material-icons">show_chart</i>
                                            <span>Laporan Penjualan dan Pembelian</span>
                                        </a>
                                        

                                    </li>
                                </ul>
                            </div>
                            <!-- #Menu -->
                            <!-- Footer -->
                            <div class="legal">
                                <div class="copyright">
                                    &copy; 2016 - 2017 <a href="javascript:void(0);">AdminBSB - Material Design</a>.
                                </div>
                                <div class="version">
                                    <b>Version: </b> 1.0.5
                                </div>
                            </div>
                            <!-- #Footer -->
                        </aside>
                        <section class="content">
                            <div class="container-fluid">
                                <div class="block-header">
                                    <?php
                                    $page = $_GET['page'];
                                    $aksi = $_GET['aksi'];
                                    if($_SESSION['Admin']){
                                       if ($page == "barang"){
                                          if($aksi == ""){
                                             include "page/barang/barang.php";
                                         }
                                         
                                         if($aksi == "tambah"){
                                             include "page/barang/tambah.php";
                                         }

                                         if($aksi == "ubah"){
                                             include "page/barang/ubah.php";
                                         }

                                         if($aksi == "hapus"){
                                             include "page/barang/hapus.php";
                                         }
                                     }

                                     if ($page == "pelanggan"){
                                      if($aksi == ""){
                                         include "page/pelanggan/pelanggan.php";
                                     }

                                     if($aksi == "tambah"){
                                         include "page/pelanggan/tambah.php";
                                     }

                                     if($aksi == "ubah"){
                                         include "page/pelanggan/ubah.php";
                                     }

                                     if($aksi == "hapus"){
                                         include "page/pelanggan/hapus.php";
                                     }
                                 }

                                 if ($page == "beli"){
                                    if($aksi == ""){
                                        include "page/beli/tambah.php";
                                    }
                                }

                                if ($page == "pengguna"){
                                  if($aksi == ""){
                                     include "page/pengguna/pengguna.php";
                                 }

                                 if($aksi == "tambah"){
                                     include "page/pengguna/tambah.php";
                                 }

                                 if($aksi == "ubah"){
                                     include "page/pengguna/ubah.php";
                                 }

                                 if($aksi == "hapus"){
                                     include "page/pengguna/hapus.php";
                                 }
                             }
                         }
                         if ($page == "penjualan"){
                          if($aksi == ""){
                             include "page/penjualan/penjualan.php";
                         }

                         if($aksi == "tambah"){
                             include "page/penjualan/tambah.php";
                         }

                         if($aksi == "kurang"){
                             include "page/penjualan/kurang.php";
                         }

                         if($aksi == "hapus"){
                             include "page/penjualan/hapus.php";
                         }
                     }
                     
                     if($page == ""){
                      include "home.php";
                  }
                  ?>
              </div>
          </div>
      </section>
      <script src="plugins/jquery/jquery.min.js"></script>
      <script src="plugins/bootstrap/js/bootstrap.js"></script>
      <script src="plugins/bootstrap-select/js/bootstrap-select.js"></script>
      <script src="plugins/jquery-slimscroll/jquery.slimscroll.js"></script>
      <script src="plugins/node-waves/waves.js"></script>
      <script src="plugins/jquery-datatable/jquery.dataTables.js"></script>
      <script src="plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js"></script>
      <script src="plugins/jquery-datatable/extensions/export/dataTables.buttons.min.js"></script>
      <script src="js/admin.js"></script>
      <script src="js/pages/tables/jquery-datatable.js"></script>
      <script src="js/demo.js"></script>
  </body>
  </html>

  <?php 

}else{
  header("location:login.php");
}
?>

<div class="modal fade" id="smallModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="smallModalLabel">Laporan Penjualan</h4>
            </div>
            <div class="modal-body">
                <form method="POST" action="page/penjualan/laporan.php" target="blank">
                    <label for="">Tanggal Awal</label> 
                    <div class="form-group">
                        <div class="form-line">
                            <input type="date" name="tgl_awal" value="<?php echo date('Y-m-d'); ?>" class="form-control" />
                        </div>
                    </div>

                    <label for="">Tanggal Akhir</label> 
                    <div class="form-group">
                        <div class="form-line">
                            <input type="date" name="tgl_akhir" value="<?php echo date('Y-m-d'); ?>" class="form-control" />
                        </div>
                    </div>
                    
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary waves-effect">Cetak</button>
                        <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">CLOSE</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        if($_SESSION['Admin']){
            alert("Data Berhasil Dihapus");
            window.location.href="?page=home";
        }
    </script>