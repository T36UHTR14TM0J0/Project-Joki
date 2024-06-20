 <!-- Begin Page Content -->
<div class="container-fluid">     
	<div class="card shadow bg-info pt-3">
		<div class="container">
			<h3 class="text-title text-light"> DATA LAPORAN TRANSAKSI OBAT</h3>
		</div>
	</div>

	<!-- DataTales Example -->
    <div class="card shadow mb-4 mt-2">
        <div class="card-header py-3">
          <form action="" method="POST" id="form-search">
               <div class="row">
                <!-- FORM INPUT PILIH PRODUK -->
                  <!--  <div class="col-md-3">
                        <label for="status">Pilih Status</label>
                        <select class="form-control " id="status" name="status">
                            <option value="all">All</option>
                            <option value="masuk">Masuk</option>
                            <option value="keluar">Keluar</option>
                        </select>
                   </div> -->
                  
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
                <button type="submit" id="btn-search" class="btn btn-warning" name="btn-search">Cari</button>
                <button id="btn-report" class="btn btn-info" name="btn-report" onclick="export_();" type="button">Cetak</button>
                
            </form>
        </div>


    
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th style="text-align: center;">Id Transaksi</th>
                            <th style="text-align: center;">Tanggal</th>
                            <th style="text-align: center;">status</th>
                            <th style="text-align: center;">Id User</th>
                             <th style="text-align: center;">Id Obat</th>
                            <th style="text-align: center;">Nama Obat</th>
                            <th style="text-align: center;">Qty</th>
                            <th style="text-align: center;">Satuan</th>
                            <th style="text-align: center;">Harga</th>
                            <th style="text-align: center;">Total</th>

                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                             $totalmasuk = 0;
                          $totalkeluar = 0;
                          $total = 0;
                         ?>
						<?php foreach($laporan as $l){

            ?>
                            <tr style="font-size: 14px">
                                 <td style="text-align: center;"><?php echo $l['id_transaksi']; ?></td>
                                  <td style="text-align: center;"><?php echo $l['tgl_transaksi']; ?></td>
                                    <td style="text-align: center;"><?php echo $l['status']; ?></td>
                                   <td style="text-align: center;"><?php echo $l['id_user']; ?></td>
                                <td style="text-align: center;"><?php echo $l['id_obat']; ?></td>
                                <td style="text-align: center;"><?php echo $l['nama_obat']; ?></td>
                                 <td style="text-align: center;"><?php echo $l['qty']; ?></td>
                                <td style="text-align: center;"><?php echo $l['satuan']?></td>
                                <td style="text-align: center;"><?php echo "Rp. " .number_format($l['harga'],'0',',','.'); ?></td>
                                <?php 
                                    $total = $l['harga'] * $l['qty'];
                                ?>
                                <td style="text-align: center;"><?php echo "Rp. " .number_format($total,'0',',','.');?></td>
                               
                            </tr>

                            <?php 

                            if ($l["status"] == "masuk") {
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
                          <th colspan="8" align="center" ><center>Total Pemasukkan :</center></th>
                          <th colspan="2"><?php echo "Rp. " . number_format($totalmasuk,0,',','.'); ?></th>
                        </tr>
                        <tr>
                          <th colspan="8" align="center"><center>Total Pengeluaran :</center></th>
                          <th colspan="2"><?php echo "Rp. " . number_format($totalkeluar,0,',','.'); ?></th>
                        </tr>
                    </tfoot>
            	</table>
        	</div>
    	</div>
    </div>
 </div>
<!-- /.container-fluid -->

  <!-- SCRIPT JAVASCRIPT JQUERY -->
    <script type="text/javascript">
        // $("#pnama_produk").select2(); 

        // FUNCTION EXPORT EXCEL
        function export_(){   
           event.preventDefault(); //prevent default action 
            // var kode_produk = $('#pnama_produk').val();
            var start = $('#tgl_awal').val();
            var last  = $('#tgl_akhir').val();
            var baseurl   = 'Laporan_obat' +'/cetak?tgl_awal=' + start + '&&tgl_akhir=' + last;
            window.open(baseurl,'_blank');      
        };
    </script>

