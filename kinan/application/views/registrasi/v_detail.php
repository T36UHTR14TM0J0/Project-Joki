 <!-- Begin Page Content -->
<div class="container-fluid">     
	<div class="card shadow bg-info pt-3">
		<div class="container">
			<h3 class="text-title text-light"> DETAIL DATA REGISTRASI</h3>
		</div>
	</div>

	<div class="row">
        <div class="container">
            <!-- DataTales Example -->
            <div class="card shadow mb-4 mt-2 col-md-12 float-left">
               
                <div class="card-body">
                  <table class="table">
                      <?php foreach ($data_reg as $dr): 
                           if ($dr["jenis_pel"] == "pel_kb") {
                                $jenis_pel = "Pemeriksaan Kb";
                            }else if($dr["jenis_pel"] == "pel_bumil"){
                                $jenis_pel = "Pemeriksaan Ibu Hamil";
                            }else if($dr["jenis_pel"] == "Pel_bayi"){
                                $jenis_pel = "Pemeriksaan Bayi & Balita";
                            }else{
                                $jenis_pel = "Pemeriksaan Umum";
                            }
                      ?>
                      <tr>
                          <th>ID Registrasi</th>
                          <td><?php echo $dr['id_registrasi']; ?></td>
                      </tr>
                      <tr>
                          <th>Tanggal Registrasi</th>
                          <td><?php echo date('d-m-Y',strtotime($dr['tgl_reg'])); ?></td>
                      </tr>
                      <tr>
                          <th>ID Pasien</th>
                          <td><?php echo $dr['id_pasien']; ?></td>
                      </tr>
                      <tr>
                          <th>Nama Pasien</th>
                          <td><?php echo $dr['nama_pasien']; ?></td>
                      </tr>
                      <tr>
                          <th>Jenis Pemeriksaan</th>
                          <td><?php echo $jenis_pel; ?></td>
                      </tr>
                      <?php endforeach ?>
                      
                  </table>
                 
                
                </div>
            </div>

        </div>
    </div>
    <div class="row mb-3">
        <div class="container">
            <a href="<?php echo base_url('Registrasi'); ?>"><button type="button" class="btn btn-danger"><<-Kembali</button></a>
        </div>
    </div>
 </div>
<!-- /.container-fluid -->