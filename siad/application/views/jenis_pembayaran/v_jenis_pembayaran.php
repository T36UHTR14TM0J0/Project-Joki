

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="card">
          <div class="card-body border border-primary rounded-lg shadow-sm">
            <div class="row">
              <div class="col-sm-6">
                <h1 class="text-primary">&nbsp;JENIS PEMBAYARAN</h1>
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
            <div class="row">
              <a href="<?php echo base_url('C_jenis_pembayaran/add') ?>" class="btn btn-sm btn-primary">Tambah</a>
            </div>
          </div>
          <div class="card-body">
            <div class="table-responsive" style="overflow-x: auto;">
              <table id="example1" class="table table-bordered table-hover" class="table table-bordered"  width="100%" cellspacing="0">
                <thead>
                  <tr class="text-primary">
                    <th style="text-align: center;">NO</th>
                    <th style="text-align: center;">KODE JENIS PEMBAYARAN</th>
                    <th style="text-align: center;">NAMA PEMBAYARAN</th>
                    <th style="text-align: center;">NOMINAL</th>
                    <th style="text-align: center;">AKSI</th>
                  </tr>
                </thead>
                <tbody>
                  <?php $no = 1; ?>
                  <?php foreach ($Data_jenis_pembayaran as $Djp): ?>
                    <tr>
                      <td><?php echo $no++; ?></td>
                      <td><?php echo $Djp["kode_jenis_pembayaran"]; ?></td>
                      <td><?php echo $Djp["nama_pembayaran"]; ?></td>
                      <td><?php echo "Rp.".number_format($Djp["nominal"],0,',','.'); ?></td>
                      <td>
                        <a href="<?php echo base_url('C_jenis_pembayaran/edit/').$Djp['kode_jenis_pembayaran']; ?>" class="btn btn-sm btn-success">Edit</a>
                        <a href="<?php echo base_url('C_jenis_pembayaran/delete/').$Djp['kode_jenis_pembayaran']; ?>" class="btn btn-sm btn-danger">Hapus</a>
                      </td>

                    </tr>
                  <?php endforeach ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

 