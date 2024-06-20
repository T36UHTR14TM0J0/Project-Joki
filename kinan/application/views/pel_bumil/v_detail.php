 <!-- Begin Page Content -->
<div class="container-fluid">     
	<div class="card shadow bg-info pt-3">
		<div class="container">
			<h3 class="text-title text-light text-center"> DETAIL PEMERIKSAAN IBU HAMIL</h3>
		</div>
	</div>

	<div class="row">
        <div class="container">
            <!-- DataTales Example -->
            <div class="card shadow mb-4 mt-2 col-md-12 float-left">
               
                <div class="card-body">

                  <table class="table">
                      <?php foreach ($data_bumil as $db): ?>
                      <tr>
                          <th>ID Registrasi</th>
                          <td><?php echo $db['id_registrasi']; ?></td>
                      </tr>
                      <tr>
                          <th>Tanggal Periksa</th>
                          <td><?php echo date('d-m-Y',strtotime($db['tgl_periksa'])); ?></td>
                      </tr>
                       <tr>
                          <th>ID Ibu Hamil</th>
                          <td><?php echo $db['id_bumil']; ?></td>
                      </tr>
                      <tr>
                          <th>Nama Ibu Hamil</th>
                          <td><?php echo $db['nama_pasien']; ?></td>
                      </tr>
                      <tr>
                          <th>Jenis Periksa</th>
                          <td><?php echo  $db['jenis']; ?></td>
                      </tr>
                      <tr>
                          <th>Hari Perkiraan Haid Terakhir</th>
                          <td><?php echo  date('d-m-Y',strtotime($db['hpht'])); ?></td>
                      </tr>
                          <tr>
                          <th>Taksiran</th>
                          <td><?php echo  $db['taksiran']; ?></td>
                      </tr>
                      <tr>
                          <th>Tekanan Darah</th>
                          <td><?php echo  $db['td']; ?></td>
                      </tr>
                       <tr>
                          <th>Berat Badan</th>
                          <td><?php echo  $db['bb'].' '.'Kg'; ?></td>
                      </tr>
                       <tr>
                          <th>Hari Perkiraan Lahir</th>
                          <td><?php echo  date('d-m-Y',strtotime($db['hpl'])); ?></td>
                      </tr>
                       <tr>
                          <th>Tinggi Fundus Uteri</th>
                          <td><?php echo  $db['tfu'].' '.'Cm'; ?></td>
                      </tr>
                       <tr>
                          <th>Presentasi</th>
                          <td><?php echo  $db['presentasi']; ?></td>
                      </tr>
                       <tr>
                          <th>Detak Jantung Janin</th>
                          <td><?php echo  $db['djj']; ?></td>
                      </tr>
                       <tr>
                          <th>Tindakan</th>
                          <td><?php echo  $db['tindakan']; ?></td>
                      </tr>
                       <tr>
                          <th>Tanggal Kembali</th>
                          <td><?php echo  date('d-m-Y',strtotime($db['tgl_kembali'])); ?></td>
                      </tr>
                      <tr>
                        <th>Biaya</th>
                        <td><?php echo "Rp.".number_format($db['biaya'],0,',','.'); ?></td>
                      </tr>
                      
        
                      <?php endforeach ?>
                      
                  </table>
                     
                </div>
            </div>

        </div>
    </div>
    <div class="row mb-3">
        <div class="container">
            <a href="<?php echo base_url('pel_bumil'); ?>"><button type="button" class="btn btn-danger"><<-Kembali</button></a>
        </div>
    </div>
 </div>
<!-- /.container-fluid -->