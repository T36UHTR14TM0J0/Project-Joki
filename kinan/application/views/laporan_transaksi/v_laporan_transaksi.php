 <!-- Begin Page Content -->
<div class="container-fluid">     
	<div class="card shadow bg-info pt-3">
		<div class="container">
			<h3 class="text-title text-light"> DATA LAPORAN TRANSAKSI PERIKSA</h3>
		</div>
	</div>

	<!-- DataTales Example -->
    <div class="card shadow mb-4 mt-2">
        <div class="card-header py-3">
          <form action="" method="POST" id="form-search">
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
                <button type="submit" id="btn-search" class="btn btn-warning" name="btn-search">Cari</button>
                <button id="btn-report" class="btn btn-info" name="btn-report" onclick="export_();" type="button">Cetak</button>
                <button type="button" id="btn-transaksi-obat" class="btn btn-success" name="btn-transaksi-obat">Laporan Transaksi Obat</button>
                
            </form>
        </div>


    
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th style="text-align: center;">No</th>
                            <th style="text-align: center;">id transaksi</th>
                            <th style="text-align: center;">Tanggal</th>
                            <th style="text-align: center;">Nama Pasien</th>
                             <th style="text-align: center;">Jenis Periksa</th>
                            <th style="text-align: center;">Biaya</th>

                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                          $no = 1;
                          $total = 0;
                         ?>
						<?php foreach($laporan as $l){?>
                            <tr style="font-size: 14px">
                                 <td style="text-align: center;"><?php echo $no++; ?></td>
                                  <td style="text-align: center;"><?php echo $l['id_transaksi']; ?></td>
                                    <td style="text-align: center;"><?php echo $l['tgl_transaksi']; ?></td>
                                   <td style="text-align: center;"><?php echo $l['nama_pasien']; ?></td>
                                <td style="text-align: center;"><?php echo $l['jenis_periksa']; ?></td>
                                <td style="text-align: center;"><?php echo "Rp. " .number_format($l['biaya'],'0',',','.'); ?></td>
        
                               <?php 
                                $total += $l["biaya"];
                               ?>
                            </tr>

                        <?php } ?>
					</tbody>
                     <tfoot>
                       <tr>
                          <th colspan="5" align="center" ><center>Total :</center></th>
                          <th><?php echo "Rp. " . number_format($total,0,',','.'); ?></th>
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
            var baseurl   = 'Laporan_transaksi' +'/cetak?tgl_awal=' + start + '&&tgl_akhir=' + last;
            window.open(baseurl,'_blank');      
        };


        $("#btn-transaksi-obat").click(function(event){

          window.location.href = "<?php echo base_url('laporan_transaksi_obat'); ?>"
        });

    </script>

