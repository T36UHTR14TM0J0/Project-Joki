 <!-- Begin Page Content -->
<div class="container-fluid">     
	<div class="card shadow bg-info pt-3">
		<div class="container">
			<h3 class="text-title text-light"> DATA USERS</h3>
		</div>
	</div>

	<!-- DataTales Example -->
    <div class="card shadow mb-4 mt-2">
        <div class="card-header py-3">
            <a href="<?php echo base_url()."User/add"; ?>"><button type="button" class="btn btn-primary">Tambah</button></a>
        </div>
    
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th style="text-align: center;">ID User</th>
                            <th style="text-align: center;">Nama lengkap</th>
                            <th style="text-align: center;">Username</th>
                            <th style="text-align: center;">Password</th>
                            <th style="text-align: center;">Level</th>
                            <th style="text-align: center;">Action</th>
                        </tr>
                    </thead>
                    <tbody>
						<?php foreach($user as $u){?>
                            <?php if ($u["level"] === "0"){
                                $level = "admin";
                            }else if($u["level"] === "1"){
                                $level = "apoteker";
                            }else{
                                $level = "bidan";
                            }           
                            ?>
                            <tr style="font-size: 14px">
                                <td style="text-align: center;"><?php echo $u['id_user']; ?></td>
                                <td style="text-align: center;"><?php echo $u['nama_lengkap']; ?></td>
                                <td style="text-align: center;"><?php echo $u['username']; ?></td>
                                <td style="text-align: center;"><?php echo $u['password']; ?></td>
                                <td style="text-align: center;"><?php echo $level;?></td>
                                <td style="text-align: center;">
                                    <a href="<?php echo base_url()."User/detail/".$u['id_user']; ?>" style="text-decoration: none;" title="Informasi Lengkap"><button type="button" class="btn btn-primary btn-circle btn-sm"><i class="fa fa-list"></i></button>
                                    <a href="<?php echo base_url()."User/edit/".$u['id_user']; ?>" style="text-decoration: none;" title="Ubah Data"><button type="button" class="btn btn-warning btn-circle btn-sm"><i class="fa fa-pencil-alt"></i></button>
                                    <a href="<?php echo base_url()."User/delete/".$u['id_user']; ?>" style="text-decoration: none;" title="Hapus Data"><button type="button" class="btn btn-danger btn-circle btn-sm" onclick="return confirm('Yakin anda akan menghapus data ini ?');"><i class="fa fa-times"></i></button>
                                </td>
                            </tr>
                        <?php } ?>
					</tbody>
            	</table>
        	</div>
    	</div>
    </div>
 </div>
<!-- /.container-fluid -->