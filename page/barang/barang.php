   <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                Data barang
                           
<a href="?page=barang&aksi=tambah" style="float: right" class="btn btn-primary">+Tambah Barang</a>
 <a href="page/barang/cetak.php" style="float: right" target="blank" class="btn btn-default">Cetak</a>                        
</h2>
                                
                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                    <thead>
                                        <tr>
                                            <th style="width: 10;" >No</th>
                                            <th style="width: 10;" >Kode Barang</th>
                                            <th style="width: 10;" >Nama Barang</th>
                                            <th style="width: 10;" >Supplier</th>
                                            <th style="width: 10;" >Tanggal Beli</th>
                                            <th style="width: 10;" >Satuan</th>
                                            <th style="width: 10;" >Harga Beli</th>
                                            <th style="width: 10;" >Stok</th>
                                            <th style="width: 10;" >Harga Jual</th>
                                            <th style="width: 10;" >Profit</th>
                                            <th style="width: 10;" >Aksi</th>
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
                                            <td><?php echo $data['supplier'] ?></td>
                                            <td><?php echo $data['tglbeli'] ?></td>
                                            <td><?php echo $data['satuan'] ?></td>
                                            <td><?php echo "Rp"."&nbsp". number_format($data['harga_beli']) ?></td>
                                            <td><?php echo $data['stok'] ?></td>
                                            <td><?php echo "Rp"."&nbsp". number_format($data['harga_jual']) ?></td>
                                            <td><?php echo "Rp"."&nbsp". number_format($data['profit']) ?></td>
                                            <td>
                                                <a onclick="return confirm('Apakah anda yakin ingin mengubah data ini?')" style="width: 60px;" href="?page=barang&aksi=ubah&id=<?php echo $data['kode_barang'] ?>" class="btn btn-success">Ubah</a>    
                                                <a onclick="return confirm('Apakah anda yakin akan menghapus data ini?')" style="width: 60px;" href="?page=barang&aksi=hapus&id=<?php echo $data['kode_barang'] ?>" class="btn btn-danger">Hapus</a> 
                                            </td>
                                        </tr>
                                        <?php } ?>

                                    </tbody>
                                </table>
                               
                               
                            </div>