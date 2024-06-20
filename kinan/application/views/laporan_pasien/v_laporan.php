 <!-- Begin Page Content -->
<div class="container-fluid">     
	<div class="card shadow bg-info pt-3">
		<div class="container">
			<h3 class="text-title text-light"> DATA LAPORAN PASIEN</h3>
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
                
            </form>
        </div>


    
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th style="text-align: center;">Id Registrasi</th>
                            <th style="text-align: center;">Tanggal Registrasi</th>
                            <th style="text-align: center;">KTP</th>
                            <th style="text-align: center;">Nama Pasien</th>
                             <th style="text-align: center;">TTL</th>
                            <th style="text-align: center;">Umur</th>
                            <th style="text-align: center;">Alamat</th>
                            <th style="text-align: center;">No HP</th>
                        </tr>
                    </thead>
                    <tbody>
						<?php foreach($laporan as $l){

            ?>
                            <tr style="font-size: 14px">
                                 <td style="text-align: center;"><?php echo $l['id_registrasi']; ?></td>
                                  <td style="text-align: center;"><?php echo date("d-m-Y",strtotime($l['tgl_reg'])); ?></td>
                                    <td style="text-align: center;"><?php echo $l['no_ktp']; ?></td>
                                   <td style="text-align: center;"><?php echo $l['nama_pasien']; ?></td>
                                <td style="text-align: center;"><?php echo $l['tmpt_lahir'].",".date("d-m-Y",strtotime($l['tgl_lahir'])); ?></td>
                                <td style="text-align: center;"><?php echo $l['umur']; ?></td>
                                 <td style="text-align: center;"><?php echo $l['alamat']; ?></td>
                                <td style="text-align: center;"><?php echo $l['no_tlp']?></td>
                               
                            </tr>
                        <?php } ?>
					</tbody>
                    
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
            var baseurl   = 'Laporan_pasien' +'/cetak?tgl_awal=' + start + '&&tgl_akhir=' + last;
            window.open(baseurl,'_blank');      
        };
    </script>

