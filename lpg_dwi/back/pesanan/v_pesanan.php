<?php 

include "function_pesanan.php";
if (isset($_POST['btn-simpan'])) {
  if (insert($_POST) > 0) {
    echo "<script>                    
              window.location.href='index.php?pages=pesanan&notif_success=Data Produk berhasil disimpan';
          </script>";      
    return false;

  }else{
    echo "<script>
            window.location.href='index.php?pages=pesanan&notif_gagal=Data Produk gagal disimpan';
          </script>";      
    return false;
  }
} 
?>

<?php if (isset($_GET['aksi'])): ?>

<?php if ($_GET['aksi'] === 'status'): ?>
<?php
  $id_pesanan = $_GET['id_pesanan'];
  $tampil_pesanan = query_read("SELECT * FROM tbl_pesanan JOIN tbl_konsumen ON tbl_pesanan.id_konsumen = tbl_konsumen.id_konsumen JOIN tbl_produk ON tbl_pesanan.id_produk = tbl_produk.id_produk WHERE tbl_pesanan.id_pesanan = '$id_pesanan'")[0];
 
?>

  <form action="#" method="POST" id="form-edit" class="text-uppercase">
    <div class="card shadow-lg mb-2">
      <div class="card-header bg-secondary text-light">
          <div id="text-judul" class="row">
            <h4 class="alert-heading">DETAIL INFORMASI PESANAN</h4>                
          </div>
      </div>
      <div class="card-body">
        <div class="row">
          <div class="form-group col-md-4">
            <label for="id_pesanan">Id Pesanan</label>
            <input class="form-control" type="text" name="id_pesanan" id="id_pesanan" value="<?= $tampil_pesanan['id_pesanan'];?>" readonly>
          </div>
           <div class="form-group col-md-4">
            <label for="tgl_pesanan">Tanggal Pesanan</label>
            <input class="form-control" type="date" name="tgl_pesanan" id="tgl_pesanan" value="<?= $tampil_pesanan['tanggal_pesanan'];?>" readonly>
          </div>
                       
          <div class="form-group col-md-4">
            <label for="nama_lengkap">Nama Lengkap</label>
            <input class="form-control" type="text" name="nama_lengkap" id="nama_lengkap" value="<?= $tampil_pesanan['nama_lengkap'];?>" readonly>
          </div>

          <div class="form-group col-md-4">
            <label for="alamat">alamat</label>
            <input class="form-control" type="text" name="alamat" id="alamat"  value="<?= $tampil_pesanan['alamat'];?>" readonly>
          </div>

          <div class="form-group col-md-4">
            <label for="email">email</label>
            <input class="form-control" type="text" name="email" id="email"  value="<?= $tampil_pesanan['email'];?>" readonly>
          </div>

          <div class="form-group col-md-4">
            <label for="no_hp">No hp</label>
            <input class="form-control" type="text" name="no_hp" id="no_hp"  value="<?= $tampil_pesanan['no_hp'];?>" readonly>
          </div>
          	
          </div>
          <div class="row">
	          	<h4 class="text-judul">Produk pesanan</h4>
	          </div>
	          <div class="row">
	          	<table class="table table-bordered " id="dataTable" width="100%" cellspacing="0">
	          		<tr>
	          			<th>Id produk</th>
	          			<th>Nama Produk</th>
	          			<th>Jumlah</th>
                  <th>Total Harga</th>
	          		</tr>
                <?php 
                  $total = 0; 
                  $total_pesanan = 0;
                ?>
	          		<tr>
	          			<td><?php echo $tampil_pesanan['id_produk']; ?></td>
	          			<td><?php echo $tampil_pesanan['nama_produk']; ?></td>
	          			<td><?php echo $tampil_pesanan['jumlah']; ?></td>
	          			<td><?php echo "Rp. ". number_format($tampil_pesanan['total_harga'],0,',','.'); ?></td>
	          		</tr>
	          	</table>
	          </div>
      </div>
      <div class="card-footer">
        <div class="row">
          <button id="btn-simpan" type="submit" name="btn-simpan" class="btn btn-secondary mr-2">Simpan</button>
          <button id="btn-back" class="btn btn-danger">Back</button>
        </div>
      </div>
    </div>
  </form>
<?php endif ?>

<?php else: ?>
  <?php 
   	$tampil_pesanan = query_read("SELECT * FROM tbl_pesanan JOIN tbl_konsumen ON tbl_pesanan.id_konsumen = tbl_konsumen.id_konsumen WHERE status = 'antar' OR status 
   = 'pesan' ORDER BY tanggal_pesanan DESC");
  ?>

  <!-- DATA TABEL PRODUK -->
  <div class="card shadow mb-4">
    <div class="card-header py-3 bg-secondary text-light">
      <!-- JUDUL HALAMAN -->
      <div id="text-judul" class="row">
          <h4 class="alert-heading">DATA PESANAN</h4>                  
      </div>
  </div>

  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-bordered " id="dataTable" width="100%" cellspacing="0">
        <thead>
          <tr>
           	<th>No</th>
            <th>Id Pesanan</th>
            <th>Tanggal Pesanan</th>
            <th>Nama Lengkap</th>
            <th>Alamat</th>
            <th>action</th>
          </tr>
        </thead> 
        <tbody>
        <?php $no = 1; ?>
        <?php foreach($tampil_pesanan as $tp):?>
          <tr>
            <td><?= $no++; ?></td>
            <td><?= $tp['id_pesanan'];?></td>
            <td><?= date('d-m-Y',strtotime($tp['tanggal_pesanan']));?></td>
            <td><?= $tp['nama_lengkap']; ?></td>
           	<td><?= $tp['alamat']; ?></td>
            <td>
            	<?php if ($tp['status'] == 'pesan'): ?>
            		<a href="index.php?pages=pesanan&aksi=status&id_pesanan=<?php echo $tp['id_pesanan']; ?>" class="badge badge-primary p-2" id="btn-status">
		              	Antar
		            </a>&nbsp;&nbsp;
            	<?php endif ?>

            	<?php if ($tp['status'] == 'antar'): ?>
            		<a href="index.php?pages=pesanan&aksi=status&id_pesanan=<?php echo $tp['id_pesanan']; ?>" class="badge badge-success p-2" id="btn-status">
		              Selesai
		              </a>&nbsp;&nbsp;
            	<?php endif ?>
             
              
             
            </td>
          </tr>
        <?php endforeach; ?>
        </tbody>    
      </table>
    </div>
  </div>
</div>
<?php endif; ?>

<script type="text/javascript">
	$(document).ready(function(){   
          // ACTION BUTTON KEMBALI
        $(document).on('click','#btn-back',function(event){
            event.preventDefault();
          window.location.href = "index.php?pages=pesanan";

        });
    });

</script>


