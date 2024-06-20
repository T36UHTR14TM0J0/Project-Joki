 <!-- Begin Page Content -->
<div class="container-fluid">     
	<div class="card shadow bg-info pt-3">
		<div class="container">
			<h3 class="text-title text-light text-center"> DETAIL PEMERIKSAAN KB</h3>
		</div>
	</div>

	<div class="row">
        <div class="container">
            <!-- DataTales Example -->
            <div class="card shadow mb-4 mt-2 col-md-12 float-left">
               
                <div class="card-body">
                  <table class="table">
                      <?php foreach ($data_kb as $dk): ?>
                      <tr>
                          <th>ID Registrasi</th>
                          <td><?php echo $dk['id_registrasi']; ?></td>
                      </tr>
                      <tr>
                          <th>Tanggal Periksa</th>
                          <td><?php echo date('d-m-Y',strtotime($dk['tgl_periksa'])); ?></td>
                      </tr>
                      <tr>
                          <th>ID Kb</th>
                          <td><?php echo $dk['id_kb']; ?></td>
                      </tr>
                      <tr>
                          <th>Nama Istri</th>
                          <td><?php echo $dk['nama_pasien']; ?></td>
                      </tr>
                          <tr>
                          <th>Nama Suami</th>
                          <td><?php echo  $dk['nama_suami']; ?></td>
                      </tr>
                      <tr>
                          <th>Tekanan Darah</th>
                          <td><?php echo  $dk['td']; ?></td>
                      </tr>
                      <tr>
                          <th>Berat Badan</th>
                          <td><?php echo  number_format($dk['bb'],1,',','.'); ?>&nbsp;Kg</td>
                      </tr>
                      <tr>
                          <th>Jenis Kb</th>
                          <td><?php echo  $dk['jenis_kb']; ?></td>
                      </tr>
                      <tr>
                          <th>Tanggal Kembali</th>
                          <td><?php echo date('d-m-Y',strtotime($dk['tgl_kembali'])) ?></td>
                      </tr>
                       <tr>
                          <th>Biaya</th>
                          <td><?php echo "Rp.".number_format($dk['biaya'],0,',','.'); ?></td>
                      </tr>
                      
                   
                      <?php endforeach ?>
                      
                  </table>
                
                </div>
            </div>

        </div>
    </div>
    <div class="row mb-3">
        <div class="container">
            <a href="<?php echo base_url('Pel_kb'); ?>"><button type="button" class="btn btn-danger"><<-Kembali</button></a>
        </div>
    </div>
 </div>
<!-- /.container-fluid -->