 <!-- Begin Page Content -->
<div class="container-fluid">     
	<div class="card shadow bg-info text-center text-light pt-3">
		<div class="container">
			<h3 class="text-title"> DETAIL RESEP OBAT</h3>
		</div>
	</div>

	<div class="row">
        <div class="container">
            <!-- DataTales Example -->
            <div class="card shadow mb-4 mt-2 col-md-12 float-left">
               
                <div class="card-body">
                  <table class="table">
                      <?php foreach ($resep_obat as $ro): ?>
                        <tr>
                          <th>Id Resep</th>
                          <td><?php echo $ro['id_resep']; ?></td>
                      </tr>
                      <tr>
                          <th>Tanggal Resep</th>
                          <td><?php echo  date('d-m-Y',strtotime($ro['tgl_resep'])); ?></td>
                      </tr>
                      <tr>
                          <th>Nama Pasien</th>
                          <td><?php echo  $ro['nama_pasien']; ?></td>
                      </tr>
                      <tr>
                          <th>Nama Obat</th>
                          <td><?php echo  $ro['nama_obat']; ?></td>
                      </tr>
                      <tr>
                        <th>Jumlah</th>
                        <td><?php echo $ro['jml_obat'] ?></td>
                      </tr>
                    
                      <?php endforeach ?>
                      
                  </table>
                
                </div>
            </div>

        </div>
    </div>
    <div class="row mb-3">
        <div class="container">
            <a href="<?php echo base_url('resep_obat'); ?>"><button type="button" class="btn btn-danger"><<-Kembali</button></a>
        </div>
    </div>
 </div>
<!-- /.container-fluid -->