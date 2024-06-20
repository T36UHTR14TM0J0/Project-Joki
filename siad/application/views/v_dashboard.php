
 

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="card">
          <div class="card-body border border-primary rounded-lg shadow-sm">
            <div class="row">
              <div class="col-sm-6">
                <h1 class="text-primary">&nbsp;DASHBOARD</h1>
              </div>
            </div>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </div>

    <div class="content-body">
      <div class="container">
        <div class="card text-center border border-primary rounded-lg shadow-sm">
          <div class="card-header">
            <div class="row bg-success p-2">
              <div class="container">
                <h4 class="text-title text-light text-uppercase text-center">Selamat Datang Di Sistem Administrasi Smk Panca Karya Sentul</h4>
              </div>
            </div>
          </div>
          <div class="card-body">
            <div class="row">
              <div class="col-md-4">
                <div class="card border border-primary">
                  <div class="card-header bg-info">
                    JUMLAH SISWA
                  </div>
                  <div class="card-body text-info">
                    <h2><i class="fas fa-user-graduate"></i>&nbsp;<?php echo $jml_siswa; ?></h2>
                  </div>
                </div>
              </div>
              <div class="col-md-4">
                <div class="card border border-primary">
                  <div class="card-header bg-info">
                    JUMLAH PEMBAYARAN
                  </div>
                  <div class="card-body text-info">
                    <h2><i class="fas fa-money-bill"></i>&nbsp;<?php echo number_format($jml_pembayaran,0,',','.'); ?></h2>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- /.content-wrapper -->
