<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="card">
          <div class="card-body border border-primary rounded-lg shadow-sm">
            <div class="row">
              <div class="col-sm-6">
                <h1 class="text-primary">&nbsp;DETAIL KELAS</h1>
              </div>
            </div>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </div>


   <section class="content-body">
      <?php foreach ($Data_kelas as $Dk): ?>
         <div class="container">
            <div class="card text-center">
               <div class="card-body">
                  <div class="table-responsive" style="overflow-x: auto;">
                     <table id="table-detail"  width="100%" cellspacing="0" cellpadding="5">
                        <tr align="left">
                           <th>ID KELAS</th>
                           <th>:</th>
                           <td><?php echo $Dk["id_kelas"]; ?></td>
                         </tr>
                         <tr align="left">
                           <th>NAMA KELAS</th>
                           <th>:</th>
                           <td><?php echo $Dk["nama_kelas"]; ?></td>
                         </tr>
                         <tr align="left">
                           <th>JUMLAH SISWA</th>
                           <th>:</th>
                           <td><?php echo $Dk["jml_siswa"]; ?></td>
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
   </section>

</div>
   
  <script type="text/javascript">
    $('#btn-kembali').click(function(){
      window.location.href = "<?php echo base_url('C_kelas'); ?>";
    })
  </script>