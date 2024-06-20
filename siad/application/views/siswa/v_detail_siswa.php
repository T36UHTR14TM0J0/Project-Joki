<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- **** JUDUL HALAMAN ***-->
    <div class="content-header">
      <div class="container-fluid">
        <div class="card">
          <div class="card-body border border-primary rounded-lg shadow-sm">
            <div class="row">
              <div class="col-sm-6">
                <h1 class="text-primary">&nbsp;DETAIL SISWA</h1>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

   <div class="content-body">
      <?php foreach ($Data_siswa as $ds): ?>
         <div class="container">
            <div class="card text-center">
               <div class="card-body">
                  <div class="table-responsive" style="overflow-x: auto;">
                     <table id="table-detail"  width="100%" cellspacing="0" cellpadding="5">
                        <tr align="left">
                           <th>NIS</th>
                           <th>:</th>
                           <td><?php echo $ds["nis"]; ?></td>
                         </tr>

                        <tr align="left">
                           <th>NISN</th>
                           <th>:</th>
                           <td><?php echo $ds["nisn"]; ?></td>
                         </tr>
                         <tr align="left">
                           <th>NAMA LENGKAP</th>
                           <th>:</th>
                           <td><?php echo $ds["nama_lengkap"]; ?></td>
                         </tr>

                        <tr align="left">
                           <th>KELAS</th>
                           <th>:</th>
                           <td><?php echo $ds["nama_kelas"]; ?></td>
                         </tr>
                        <tr align="left">
                           <th>SEMESTER</th>
                           <th>:</th>
                           <td><?php echo $ds["semester"]; ?></td>
                         </tr>

                        <tr align="left">
                           <th>TAHUN AJARAN</th>
                           <th>:</th>
                           <td><?php echo $ds["tahun_ajaran"]; ?></td>
                         </tr>

                       </table>
                  </div>
                  <div class="card-footer">
                      <button id="btn-kembali" class="btn btn-sm btn-danger">Kembali</button>
                  </div>
               </div>
            </div>
         </div>
      <?php endforeach; ?>
   </div>

</div>
   
  <script type="text/javascript">
    $('#btn-kembali').click(function(){
      window.location.href = "<?php echo base_url('C_siswa'); ?>";
    })
  </script>