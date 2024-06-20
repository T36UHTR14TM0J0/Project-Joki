<!-- ### CONTENT WRAPPER ### -->
<div class="content-wrapper">

  <!-- **** JUDUL HALAMAN ***-->
  <div class="content-header">
    <div class="container-fluid">
      <div class="card">
        <div class="card-body border border-primary rounded-lg shadow-sm">
          <div class="row">
            <div class="col-sm-6">
              <h1 class="text-primary">&nbsp;DATA USERS</h1>
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
            <a href="<?php echo base_url('C_user/add') ?>" class="btn btn-sm btn-primary">Tambah</a>
          </div>
        </div>

        <!-- **** BOX TABLE KELAS **** -->
        <div class="card-body">
          <div class="table-responsive" style="overflow-x: auto;">
            <table id="example1" class="table table-bordered table-hover" class="table table-bordered"  width="100%" cellspacing="0">

              <thead>
                <tr class="text-primary">
                  <th style="text-align: center;">NO</th>
                  <th style="text-align: center;">ID USER</th>
                  <th style="text-align: center;">USERNAME</th>
                  <th style="text-align: center;">PASSWORD</th>
                  <th style="text-align: center;">AKSI</th>
                </tr>
              </thead>

              <tbody>
              <?php 
                $no = 1;
                foreach ($Data_user as $Du):
              ?>
                  <tr>
                    <td><?php echo $no++; ?></td>
                    <td><?php echo $Du["id_user"]; ?></td>
                    <td><?php echo $Du["username"]; ?></td>
                    <td><?php echo $Du["password"]; ?></td>
                    <td>
                      <a href="<?php echo base_url('C_user/edit/').$Du['id_user']; ?>" class="btn btn-sm btn-success">Edit</a>
                      <a href="<?php echo base_url('C_user/delete/').$Du['id_user']; ?>" class="btn btn-sm btn-danger">Hapus</a>
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
 