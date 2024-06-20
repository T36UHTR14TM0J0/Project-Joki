

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- **** JUDUL HALAMAN ***-->
    <div class="content-header">
      <div class="container-fluid">
        <div class="card">
          <div class="card-body border border-primary rounded-lg shadow-sm">
            <div class="row">
              <div class="col-sm-6">
                <h1 class="text-primary">&nbsp;DATA SISWA</h1>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="content-body">
      <div class="container">
        <div class="card text-center">
          <div class="card-header">
            <div class="row">
              <a href="<?php echo base_url('C_siswa/add') ?>" class="btn btn-sm btn-primary">Tambah</a>
            </div>
          </div>
          <div class="card-body">
            <div class="table-responsive" style="overflow-x: auto;">
              <table id="example1" class="table table-bordered table-hover" class="table table-bordered"  width="100%" cellspacing="0">
                <thead>
                  <tr class="text-primary">
                    <th style="text-align: center;">NO</th>
                    <th style="text-align: center;">NIS</th>
                    <th style="text-align: center;">NISN</th>
                    <th style="text-align: center;">NAMA LENGKAP</th>
                    <th style="text-align: center;">KELAS</th>
                    <th style="text-align: center;">AKSI</th>
                  </tr>
                </thead>
                <tbody>
                  <?php $no = 1; ?>
                  <?php foreach ($Data_siswa as $ds): ?>
                    <tr>
                      <td><?php echo $no++; ?></td>
                      <td><?php echo $ds["nis"]; ?></td>
                      <td><?php echo $ds["nisn"]; ?></td>
                      <td><?php echo $ds["nama_lengkap"]; ?></td>
                      <td><?php echo $ds["nama_kelas"]; ?></td>
                      <td>
                        <a href="<?php echo base_url('C_siswa/detail/').$ds['nis']; ?>" class="btn btn-sm btn-info">Detail</a>
                        <a href="<?php echo base_url('C_siswa/edit/').$ds['nis']; ?>" class="btn btn-sm btn-success">Edit</a>
                        <a href="<?php echo base_url('C_siswa/delete/').$ds['nis']; ?>" class="btn btn-sm btn-danger">Hapus</a>
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

 