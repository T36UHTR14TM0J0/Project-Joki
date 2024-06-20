

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="card">
          <div class="card-body border border-primary rounded-lg shadow-sm">
            <div class="row">
              <div class="col-sm-6">
                <h1 class="text-primary">&nbsp;LAPORAN PEMBAYARAN</h1>
              </div>
            </div>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </div>

    <div class="content-body">
      <div class="container">
        <div class="card text-center">
          <div class="card-header">
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

                   <div class="col-md-3">
                       <div class="form-group">
                           <label for="jenis_pembayaran">Jenis Pembayaran</label>
                           <select class="form-control" name="jenis_pembayaran" id="jenis_pembayaran">
                            <option value="">All</option>
                             <?php foreach ($jenis_pembayaran as $jp): ?>
                              <option value="<?php echo $jp['kode_jenis_pembayaran']; ?>"><?php echo $jp['nama_pembayaran']; ?></option> 
                             <?php endforeach ?>
                           </select>
                       </div>
                   </div>

                   <div class="col-md-2 mt-3 pt-3">
                     <!-- BUTTON SEARCH & REPORT -->
                    <button type="submit" id="btn-search" class="btn btn-success" name="btn-search" value="cari">Cari</button>
                    <button id="btn-report" class="btn btn-secondary" name="btn-report" onclick="export_();" type="button">Cetak</button>
                   </div>
                   
               </div>
                
            </form>
          </div>
          <div class="card-body">
            <div class="table-responsive" style="overflow-x: auto;">
              <table id="example1" class="table table-bordered table-hover" class="table table-bordered"  width="100%" cellspacing="0">
                <thead>
                  <tr class="text-primary">
                    <th style="text-align: center;">NO</th>
                    <th style="text-align: center;">KODE PEMBAYARAN</th>
                    <th style="text-align: center;">TANGGAL PEMBAYARAN</th>
                    <th style="text-align: center;">BULAN PEMBAYARAN</th>
                    <th style="text-align: center;">JENIS PEMBAYARAN</th>
                    <th style="text-align: center;">NIS</th>
                    <th style="text-align: center;">NAMA SISWA</th>
                    <th style="text-align: center;">TAHUN AJARAN</th>
                    <th style="text-align: center;">NOMINAL</th>
                  </tr>
                </thead>
                <tbody>
                  <?php $no = 1; ?>
                  <?php $jml_total = 0; ?>
                  <?php foreach ($data_laporan as $dl): ?>
                    <tr>
                      <td><?php echo $no++; ?></td>
                      <td><?php echo $dl["kode_pembayaran"]; ?></td>
                      <td><?php echo date('d-m-Y',strtotime($dl["tgl_pembayaran"])); ?></td>
                      <td><?php echo $dl["bln_pembayaran"]; ?></td>
                      <td><?php echo $dl['nama_pembayaran']; ?></td>
                      <td><?php echo $dl["nis"]; ?></td>
                      <td><?php echo $dl["nama_lengkap"]; ?></td>
                      <td><?php echo $dl["tahun_ajaran"]; ?></td>
                      <td><?php echo "Rp. ". number_format($dl["nominal"],0,',','.'); ?></td>
                      

                    </tr>
                    <?php $jml_total += $dl['nominal']; ?>
                  <?php endforeach ?>
                  <tr class="text-primary">
                    <th align="center" colspan="7">JUMLAH TOTAL</th>
                    <th align="center" colspan="2"><?php echo "Rp. ". number_format($jml_total,0,',','.'); ?></th>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script type="text/javascript">
    // FUNCTION EXPORT EXCEL
        function export_(){   
           event.preventDefault(); //prevent default action 
            // var kode_produk = $('#pnama_produk').val();
            var tgl_awal = $('#tgl_awal').val();
            var tgl_akhir  = $('#tgl_akhir').val();
            var kode_jenis_pembayaran  = $('#jenis_pembayaran').val();
            var baseurl   = 'C_laporan' +'/cetak?tgl_awal=' + tgl_awal + '&&tgl_akhir=' + tgl_akhir + '&&kode_jenis_pembayaran=' + kode_jenis_pembayaran;
            window.open(baseurl,'_blank');      
        };

  </script>

 