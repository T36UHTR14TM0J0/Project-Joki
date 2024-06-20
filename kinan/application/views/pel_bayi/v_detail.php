 <!-- Begin Page Content -->
<div class="container-fluid">     
	<div class="card shadow bg-info text-light text-center pt-3">
		<div class="container">
			<h3 class="text-title text-grey"> DETAIL PEMERIKSAAN BAYI</h3>
		</div>
	</div>

	<div class="row">
        <div class="container">
            <!-- DataTales Example -->
            <div class="card shadow mb-4 mt-2 col-md-12 float-left">
               
                <div class="card-body">

                  <table class="table">
                      <?php foreach ($data_bayi as $by): ?>
                      <tr>
                          <th>ID Registrasi</th>
                          <td><?php echo $by['id_registrasi']; ?></td>
                      </tr>
                      <tr>
                          <th>Tanggal Periksa</th>
                          <td><?php echo date('d-m-Y',strtotime($by['tgl_periksa'])); ?></td>
                      </tr>
                      <tr>
                          <th>ID Bayi</th>
                          <td><?php echo $by['id_bayi']; ?></td>
                      </tr>
                      <tr>
                          <th>Nama Bayi</th>
                          <td><?php echo $by['nama_bayi']; ?></td>
                      </tr>
                      <tr>
                          <th>Nama Ibu</th>
                          <td><?php echo  $by['nama_ibu']; ?></td>
                      </tr>
                      <tr>
                          <th>Jenis</th>
                          <td><?php echo  $by['jenis']; ?></td>
                      </tr>
                      <tr>
                          <th>Jenis Imunisasi</th>
                          <td><?php echo  $by['jenis_imun']; ?></td>
                      </tr>
                          <tr>
                          <th>Berat Bayi</th>
                          <td><?php echo number_format( $by['bb'],1,',','.').' kg'; ?></td>
                      </tr>
                      <tr>
                          <th>Tinggi / Panjang Bayi</th>
                          <td><?php echo  number_format($by['tb'],1,',','.').' cm'; ?></td>
                      </tr>
                      <tr>
                          <th>Biaya</th>
                          <td><?php echo "Rp.".number_format($by['biaya'],0,',','.'); ?></td>
                      </tr>
                      
        
                      <?php endforeach ?>
                      
                  </table>
                     
                </div>
            </div>

        </div>
    </div>
    <div class="row mb-3">
        <div class="container">
            <a href="<?php echo base_url('pel_bayi'); ?>"><button type="button" class="btn btn-danger"><<-Kembali</button></a>
        </div>
    </div>
 </div>
<!-- /.container-fluid -->