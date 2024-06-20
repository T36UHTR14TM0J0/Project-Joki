 <!-- Begin Page Content -->
<div class="container-fluid">     
	<div class="card shadow bg-info pt-3">
		<div class="container">
			<h3 class="text-title text-light text-center"> DETAIL DATA OBAT</h3>
		</div>
	</div>

	<div class="row">
        <div class="container">
            <!-- DataTales Example -->
            <div class="card shadow mb-4 mt-2 col-md-12 float-left">
               
                <div class="card-body">
                  <table class="table">
                      <?php foreach ($data_obat as $du): ?>
                        <tr>
                          <th>Id Obat</th>
                          <td><?php echo $du['id_obat']; ?></td>
                      </tr>
                      <tr>
                          <th>Nama Obat</th>
                          <td><?php echo  $du['nama_obat']; ?></td>
                      </tr>
                      <tr>
                          <th>Harga Beli</th>
                          <td>Rp.&nbsp;<?php echo number_format($du['harga_beli'],0,',','.');  ?></td>
                      </tr>
                      <tr>
                          <th>Harga Jual</th>
                          <td>Rp.&nbsp;<?php echo  number_format($du['harga_jual'],0,',','.');; ?></td>
                      </tr>
                      <tr>
                          <th>Stok</th>
                          <td><?php echo  $du['stok']; ?></td>
                      </tr>
                      <tr>
                          <th>Satuan</th>
                          <td><?php echo  $du['satuan']; ?></td>
                      </tr>
                    
                      <?php endforeach ?>
                      
                  </table>
                
                </div>
            </div>

        </div>
    </div>
    <div class="row mb-3">
        <div class="container">
            <a href="<?php echo base_url('Obat'); ?>"><button type="button" class="btn btn-danger"><<-Kembali</button></a>
        </div>
    </div>
 </div>
<!-- /.container-fluid -->