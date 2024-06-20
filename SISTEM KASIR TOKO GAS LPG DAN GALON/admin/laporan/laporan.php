
<?php
// ======================================================================================================================================//
//                                                   HALAMAN REPORT LAPORAN TRANSAKSI                                                    //
// ======================================================================================================================================//



include 'function_laporan.php'; //MEMANGGIL FILE FUNCTION LAPORAN

?>
    <!-- JUDUL HALAMAN REPORT LAPORAN -->
    <div id="text-judul" class="row">
        <div class="alert alert-success" role="alert" style="width: 100%;">
              <h4 class="alert-heading">DATA LAPORAN</h4>
              
        </div>
    </div>

    <!-- MENGAMBIL DATA USER DARI DATABASE MELALUI FUNCTION QUERY_READ-->
    <?php $tampil_user    = query_read("SELECT * FROM tbl_users");?>

    <!-- MENGAMBIL DATA PRODUCT DARI DATABASE MELALUI FUNCTION QUERY_READ -->
    <?php $tampil_product = query_read("SELECT * FROM tbl_product");?>

    <!-- BOX CONTENT REPORT LAPORAN-->
     <div class="card shadow mb-4">
        <div class="card-header py-3">
            <form action="#" method="POST" id="form-search">
               <div class="row">
                <!-- FORM INPUT PILIH PRODUK -->
                   <div class="col-md-3">
                        <label for="pnama_produk">Pilih Produk</label>
                        <select class="form-control " id="pnama_produk" name="pnama_produk">
                            <option value="All">All</option>
                            <?php foreach ($tampil_product as $tp): ?>

                                <option value="<?php echo $tp['kode_produk'] ?>"><?php echo $tp['nama_produk'] ?></option>
                            <?php endforeach ?>
                        </select>
                   </div>
                  
                  <!-- FORM INPUT TANGGAL AWAL -->
                   <div class="col-md-3">
                       <div class="form-group">
                           <label for="tgl_awal">Tanggal Awal</label>
                           <input type="date" name="tgl_awal" id="tgl_awal" class="form-control" value="<?php echo date("Y-m-d") ?>">
                       </div>
                   </div>

                   <!-- FORM INPUT TANGGAL AKHIR -->
                   <div class="col-md-3">
                       <div class="form-group">
                           <label for="tgl_akhir">Tanggal Akhir</label>
                           <input type="date" name="tgl_akhir" id="tgl_akhir" class="form-control" value="<?php echo date("Y-m-d") ?>">
                       </div>
                   </div>
               </div>

                <!-- BUTTON SEARCH & REPORT -->
                <button type="submit" id="btn-search" class="btn btn-warning" name="btn-search">Search</button>
                <button id="btn-report" class="btn btn-info" name="btn-report" onclick="export_();" type="button">Report</button>
                
            </form>
        </div>

        <div class="card-body">
            <!-- TABLE DATA LAPORAN / TRANSAKSI -->
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Id User</th>
                            <th>Tanggal</th>
                            <th>Kode Produk</th>
                            <th>Nama Produk</th>
                            <th>kategori</th>
                            <th>qty</th>
                            <th>Harga</th>
                            <th>Total</th>
                        </tr>
                    </thead> 
                    <tbody>
                        <?php $no = 1; ?>
                        <!-- PROSES FILTER & SEARCH DATA LAPORAN -->
                        <?php 
                            if (isset($_POST['btn-search'])) {

                                $data = search($_POST);

                         
                            }else{
                                $data = query_read("SELECT * FROM tbl_transaksi ORDER BY tanggal ASC");
                            }

                         ?>
                       
                       <?php 
                          $totalmasuk = 0;
                          $totalkeluar = 0;
                          $total = 0;
                          $laba         = 0;
                          $rugi       = 0;
                        ?>
                    <?php foreach ($data as $d) { ?>
                        <tr>
                            <td><?php echo $no++; ?></td>
                            <td><?php echo $d['id_user']; ?></td>
                            <td><?php echo date("d-m-Y",strtotime($d["tanggal"])); ?></td>
                            <td><?php echo $d["kode_product"]; ?></td>
                            <td><?php echo $d["nama_product"]; ?></td>
                            <td><?php echo $d["kategori"]; ?></td>
                            <td><?php echo $d["qty"]; ?></td>
                            <td><?php echo number_format($d["harga"],0,',','.'); ?></td>
                            <?php $total = $d["qty"] * $d["harga"]; ?>
                            <td><?php echo number_format($total,0,',','.'); ?></td>
                        </tr>

                        <?php 
                            if ($d["kategori"] == "in") {
                               $totalmasuk += $total; 
                             } else{
                                $totalkeluar += $total;
                             }

                             if($totalmasuk > $totalkeluar){
                                $laba = $totalmasuk - $totalkeluar;
                              }else{
                                $rugi = $totalkeluar- $totalmasuk;
                              }

                         ?>

                    <?php } ?>
                   
                    </tbody>    
                    <tfoot>
                       <tr>
                          <th colspan="7" align="center" ><center>Total Pemasukkan (in) :</center></th>
                          <th colspan="2"><?php echo "Rp. " . number_format($totalmasuk,0,',','.'); ?></th>
                        </tr>
                        <tr>
                          <th colspan="7" align="center"><center>Total Pengeluaran (out) :</center></th>
                          <th colspan="2"><?php echo "Rp. " . number_format($totalkeluar,0,',','.'); ?></th>
                        </tr>
                        <tr>
                          <th colspan="7" align="center" ><center>Laba :</center></th>
                          <th colspan="2"><?php echo "Rp. " . number_format($laba,0,',','.'); ?></th>
                        </tr>
                        <tr>
                          <th colspan="7" align="center"><center>Rugi :</center></th>
                          <th colspan="2"><?php echo "Rp. " . number_format($rugi,0,',','.'); ?></th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
        
    </div>



    <!-- SCRIPT JAVASCRIPT JQUERY -->
    <script type="text/javascript">
        $("#pnama_produk").select2(); 

        // FUNCTION EXPORT EXCEL
        function export_(){   
           event.preventDefault(); //prevent default action 
            var kode_produk = $('#pnama_produk').val();
            var start = $('#tgl_awal').val();
            var last  = $('#tgl_akhir').val();
            var baseurl   = 'laporan' +'/report.php?kode_produk=' + kode_produk + '&&tgl_awal=' + start + '&&tgl_akhir=' + last;
            window.open(baseurl,'_blank');      
        };
    </script>
