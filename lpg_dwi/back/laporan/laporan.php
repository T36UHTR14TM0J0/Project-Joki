
<?php
// ======================================================================================================================================//
//                                                   HALAMAN REPORT LAPORAN TRANSAKSI                                                    //
// ======================================================================================================================================//



include 'function_laporan.php'; //MEMANGGIL FILE FUNCTION LAPORAN

?>
    <!-- JUDUL HALAMAN REPORT LAPORAN -->
    <div id="text-judul" class="row">
        <div class="alert alert-secondary" role="alert" style="width: 100%;">
              <h4 class="alert-heading">DATA LAPORAN KEUANGAN</h4>
              
        </div>
    </div>



    <!-- BOX CONTENT REPORT LAPORAN-->
     <div class="card shadow mb-4">
        <div class="card-header bg-secondary text-light py-3">
            <form action="#" method="POST" id="form-search">
               <div class="row">
                  
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
                            <th>Pemilik</th>
                            <th>Nama Produk</th>
                            <th>Tanggal</th>
                            <th>Keterangan</th>
                            <th>Jumlah</th>
                            <th>Total Harga</th>
                            
                        </tr>
                    </thead> 
                    <tbody>
                        <?php $no = 1; ?>
                        <!-- PROSES FILTER & SEARCH DATA LAPORAN -->
                        <?php 
                            if (isset($_POST['btn-search'])) {

                                $data = search($_POST);

                         
                            }else{
                                $data = query_read("SELECT * FROM tbl_transaksi JOIN tbl_pemilik ON tbl_transaksi.id_pemilik = tbl_pemilik.id_pemilik JOIN tbl_produk ON tbl_transaksi.id_produk = tbl_produk.id_produk ORDER BY tanggal ASC");
                            }

                         ?>
                       
                       <?php 
                          $totalmasuk = 0;
                          $totalkeluar = 0;
                          $total = 0;
                        
                        ?>
                    <?php foreach ($data as $d) { 
                        $total = $d['total_harga'];
                    ?>
                        <tr>
                            <td><?php echo $no++; ?></td>
                            <td><?php echo $d['nama_lengkap']; ?></td>
                            <td><?php echo $d["nama_produk"]; ?></td>
                            <td><?php echo date("d-m-Y",strtotime($d["tanggal"])); ?></td>
                            <td><?php echo $d["keterangan"]; ?></td>
                            <td><?php echo $d["jumlah"]; ?></td>
                            <td><?php echo number_format($total,0,',','.'); ?></td>
                        </tr>

                        <?php 
                            if ($d["keterangan"] == "masuk") {
                               $totalmasuk += $total; 
                             } else{
                                $totalkeluar += $total;
                             }

                             
                         ?>

                    <?php } ?>
                   
                    </tbody>    
                    <tfoot>
                       <tr>
                          <th colspan="6" align="right" ><right>Total Pemasukkan :</right></th>
                          <th colspan="2"><?php echo "Rp. " . number_format($totalmasuk,0,',','.'); ?></th>
                        </tr>
                        <tr>
                          <th colspan="6" align="right"><right>Total Pengeluaran :</right></th>
                          <th colspan="2"><?php echo "Rp. " . number_format($totalkeluar,0,',','.'); ?></th>
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
            var start = $('#tgl_awal').val();
            var last  = $('#tgl_akhir').val();
            var baseurl   = 'laporan' +'/report.php?tgl_awal=' + start + '&&tgl_akhir=' + last;
            window.open(baseurl,'_blank');      
        };
    </script>
