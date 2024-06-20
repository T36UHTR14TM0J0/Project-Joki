 <!-- Begin Page Content -->
<div class="container-fluid">     
	<div class="card shadow bg-info text-light pt-3">
		<div class="container">
			<h3 class="text-title text-center"> DETAIL PEMERIKSAAN UMUM</h3>
		</div>
	</div>

	<div class="row">
        <div class="container">
            <!-- DataTales Example -->
            <div class="card shadow mb-4 mt-2 col-md-12 float-left">
               
                <div class="card-body">
                  <table class="table">
                      <?php foreach ($data_pel_biasa as $dpb): ?>
                      <tr>
                          <th>Id Registrasi</th>
                          <td><?php echo $dpb['id_registrasi']; ?></td>
                      </tr>
                      <tr>
                          <th>Tanggal Periksa</th>
                          <td><?php echo  date('d-m-Y',strtotime($dpb['tgl_periksa'])); ?></td>
                      </tr>
                       <tr>
                          <th>Id Pasien</th>
                          <td><?php echo $dpb['id']; ?></td>
                      </tr>
                      <tr>
                          <th>Nama Pasien</th>
                          <td><?php echo  $dpb['nama_pasien']; ?></td>
                      </tr>
                       <tr>
                          <th>Tinggi Badan</th>
                          <td><?php echo  $dpb['tb']." cm";?></td>
                      </tr>
                       <tr>
                          <th>Berat Badan</th>
                          <td><?php echo  $dpb['bb']." kg"; ?></td>
                      </tr>
                       <tr>
                          <th>Tekanan Darah</th>
                          <td><?php echo  $dpb['td']." mmHg"; ?></td>
                      </tr>
                      <tr>
                          <th>Keluhan</th>
                          <td><?php echo  $dpb['keluhan']; ?></td>
                      </tr>   
                      <tr>
                          <th>Biaya</th>
                          <td><?php echo  "Rp. ".number_format($dpb['biaya'],'0',',','.') ; ?></td>
                      </tr>                    
                      <?php endforeach ?>
                      
                  </table>
                
                </div>
            </div>

            

        </div>
    </div>
    <div class="row mb-3">
        <div class="container">
            <a href="<?php echo base_url('pel_umum'); ?>"><button type="button" class="btn btn-danger"><<-Kembali</button></a>
        </div>
    </div>
 </div>
<!-- /.container-fluid -->