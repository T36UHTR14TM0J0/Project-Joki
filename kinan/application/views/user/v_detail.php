 <!-- Begin Page Content -->
<div class="container-fluid">     
	<div class="card shadow bg-light pt-3">
		<div class="container">
			<h3 class="text-title text-grey"> DETAIL DATA USER</h3>
		</div>
	</div>

	<div class="row">
        <div class="container">
            <!-- DataTales Example -->
            <div class="card shadow mb-4 mt-2 col-md-12 float-left">
               
                <div class="card-body">
                  <table class="table">
                      <?php foreach ($data_user as $du): ?>
                        <tr>
                          <th>ID User</th>
                          <td><?php echo $du['id_user']; ?></td>
                      </tr>
                      <tr>
                          <th>Nama lengkap</th>
                          <td><?php echo  $du['nama_lengkap']; ?></td>
                      </tr>
                      <tr>
                          <th>Username</th>
                          <td><?php echo  $du['username']; ?></td>
                      </tr>
                      <tr>
                          <th>Password</th>
                          <td><?php echo  $du['password']; ?></td>
                      </tr>
                      <?php 
                        if ($du['level'] == 0) {
                          $level = "admin";
                        }else if($du["level"] == 1){
                          $level = "apoteker";
                        }else{
                          $level = "bidan";
                        }

                      ?>
                      <tr>
                          <th>Level</th>
                          <td><?php echo  $level; ?></td>
                      </tr>
                      <?php endforeach ?>
                      
                  </table>
                
                </div>
            </div>

        </div>
    </div>
    <div class="row mb-3">
        <div class="container">
            <a href="<?php echo base_url('User'); ?>"><button type="button" class="btn btn-danger"><<-Kembali</button></a>
        </div>
    </div>
 </div>
<!-- /.container-fluid -->