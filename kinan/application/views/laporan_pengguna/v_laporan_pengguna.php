 <!-- Begin Page Content -->
<div class="container-fluid">     
  <div class="card shadow bg-info pt-3">
    <div class="container">
      <h3 class="text-title text-light"> LAPORAN DATA PENGGUNA</h3>
    </div>
  </div>

  <!-- DataTales Example -->
    <div class="card shadow mb-4 mt-2">
        <div class="card-header py-3">
          <form action="" method="POST" id="form-search">
               <div class="row">
               
                <button id="btn-report" class="btn btn-info" name="btn-report" onclick="export_();" type="button">Cetak</button>
                
            </form>
        </div>


    
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th style="text-align: center;">Id User</th>
                            <th style="text-align: center;">Nama Lengkap</th>
                            <th style="text-align: center;">Username</th>
                            <th style="text-align: center;">Password</th>
                            <th style="text-align: center;">Level</th>
                        </tr>
                    </thead>
                    <tbody>
            <?php foreach($laporan as $l){

            ?>
                        <tr style="font-size: 14px">
                          <td style="text-align: center;"><?php echo $l['id_user']; ?></td>
                          <td style="text-align: center;"><?php echo $l['nama_lengkap']; ?></td>
                          <td style="text-align: center;"><?php echo $l['username']; ?></td>
                          <td style="text-align: center;"><?php echo $l['password']; ?></td>
                          <?php 
                              if ($l['level'] === "0") {
                                $level = "admin";
                              }else if ($l['level'] === "1") {
                                $level = "apoteker";
                              }else{
                                $level = "bidan";
                              }
                          ?>
                          <td style="text-align: center;"><?php echo $level; ?></td>
                                                             
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
            var baseurl   = 'Laporan_pengguna' +'/cetak';
            window.open(baseurl,'_blank');      
        };
    </script>

