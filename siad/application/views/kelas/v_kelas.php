<!-- ### CONTENT WRAPPER ### -->
<div class="content-wrapper">

  <!-- **** JUDUL HALAMAN ***-->
  <div class="content-header">
    <div class="container-fluid">
      <div class="card">
        <div class="card-body border border-primary rounded-lg shadow-sm">
          <div class="row">
            <div class="col-sm-6">
              <h1 class="text-primary">&nbsp;DATA KELAS</h1>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- **** BOX CONTENT **** -->
  <div class="content-body">
    <div class="container">
      <div class="card text-center">
 
        <!-- **** BOX TOMBOL TAMBAH **** -->
        <div class="card-header">
          <div class="row">
            <a href="<?php echo base_url('C_kelas/add') ?>" class="btn btn-sm btn-primary">Tambah</a>
          </div>
        </div>

        <!-- **** BOX TABLE KELAS **** -->
        <div class="card-body">
          <div class="table-responsive" style="overflow-x: auto;">
            <table id="example1" class="table table-bordered table-hover" class="table table-bordered"  width="100%" cellspacing="0">

              <thead>
                <tr class="text-primary">
                  <th style="text-align: center;">NO</th>
                  <th style="text-align: center;">ID KELAS</th>
                  <th style="text-align: center;">NAMA KELAS</th>
                  <th style="text-align: center;">JUMLAH SISWA</th>
                  <th style="text-align: center;">AKSI</th>
                </tr>
              </thead>

              <tbody>
              <?php 
                $no = 1;
                foreach ($Data_kelas as $Dk):
              ?>
                  <tr>
                    <td><?php echo $no++; ?></td>
                    <td><?php echo $Dk["id_kelas"]; ?></td>
                    <td><?php echo $Dk["nama_kelas"]; ?></td>
                    <td><?php echo $Dk["jml_siswa"]; ?></td>
                    <td>
                      <a href="<?php echo base_url('C_kelas/detail/').$Dk['id_kelas']; ?>" class="btn btn-sm btn-info">Detail</a>
                      <a href="<?php echo base_url('C_kelas/edit/').$Dk['id_kelas']; ?>" class="btn btn-sm btn-success">Edit</a>
                      <a href="<?php echo base_url('C_kelas/delete/').$Dk['id_kelas']; ?>" class="btn btn-sm btn-danger">Hapus</a>
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
<!-- ### CONTENT WRAPPERR ### -->
 