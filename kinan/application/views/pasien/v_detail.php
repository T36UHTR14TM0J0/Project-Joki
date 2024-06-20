 <!-- Begin Page Content -->
<div class="container-fluid">     
	<div class="card shadow bg-info pt-3">
		<div class="container">
			<h3 class="text-title text-light"> DETAIL DATA PASIEN</h3>
		</div>
	</div>

	<div class="row">
        <div class="container">
            <!-- DataTales Example -->
            <div class="card shadow mb-4 mt-2 col-md-12 float-left">
               
                <div class="card-body">
                  <table class="table">
                      <?php foreach ($data_pasien as $dp): ?>
                      <tr>
                          <th>ID Registrasi</th>
                          <td><?php echo $dp['id_registrasi']; ?></td>
                      </tr>
                      <tr>
                          <th>ID Pasien</th>
                          <td><?php echo $dp['id_pasien']; ?></td>
                      </tr>
                      <tr>
                          <th>No Ktp</th>
                          <td><?php echo $dp['no_ktp']; ?></td>
                      </tr>
                      <tr>
                          <th>Nama Pasien</th>
                          <td><?php echo  $dp['nama_pasien']; ?></td>
                      </tr>
                      <tr>
                          <th>Tempat,Tanggal Lahir</th>
                          <td><?php echo  $dp['tmpt_lahir'].','.date('d-m-Y',strtotime($dp['tgl_lahir'])); ?></td>
                      </tr>
                          <tr>
                          <th>Umur</th>
                          <td><?php echo  $dp['umur'] ?></td>
                      </tr>
                      <tr>
                          <th>Jenis Kelamin</th>
                          <td><?php echo  ($dp['jk'] == 'L') ? 'Laki - Laki' : 'Perempuan'; ?></td>
                      </tr>
                      <tr>
                          <th>Alamat</th>
                          <td><?php echo  $dp['alamat']; ?></td>
                      </tr>
                      
                      <tr>
                          <th>No Hp</th>
                          <td><?php echo  $dp['no_tlp']; ?></td>
                      </tr>

                      <?php if ($dp["jenis_pel"] == "pel_umum"){
                                $jenis_pel = "Pemeriksaan Umum";
                            }else if($dp["jenis_pel"] == "pel_kb"){
                                $jenis_pel = "Pemeriksaan Kb";
                            }else if($dp["jenis_pel"] == "pel_bumil"){
                                $jenis_pel = "Pemeriksaan Ibu Hamil";
                            }else{
                                $jenis_pel = "Pemeriksaan Bayi & Balita";
                            }
                      ?>
                        
                      
                      <tr>
                          <th>Jenis Periksa</th>
                          <td><?php echo  $jenis_pel ?></td>
                      </tr>

                     
                      <?php endforeach ?>
                      
                  </table>
                 
                
                </div>
            </div>

        </div>
    </div>
    <div class="row mb-3">
        <div class="container">
            <a href="<?php echo base_url('Pasien'); ?>"><button type="button" class="btn btn-danger"><<-Kembali</button></a>
        </div>
    </div>
 </div>
<!-- /.container-fluid -->