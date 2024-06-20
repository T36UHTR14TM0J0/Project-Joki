<?php 
include "../koneksi/koneksi.php";

function query_read($query){
    global $koneksi;

    $result   = mysqli_query($koneksi,$query);
    $rows     = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    return $rows;
}
session_start();

$id_konsumen = $_SESSION['sess_id'];
$data_pesanan    = mysqli_query($koneksi,"SELECT * FROM tbl_pesanan JOIN tbl_produk ON tbl_pesanan.id_produk = tbl_produk.id_produk WHERE id_konsumen = '$id_konsumen' AND status = 'selesai' OR status ='batal'");
?>

<div class="container">
	<div class="row">
	<div class="card m-auto shadow-md col-lg">
		<div class="card-header bg-secondary text-light">
		    <div id="text-judul" class="row">
		       <h4 class="alert-heading">RIWAYAT PESANAN</h4>
		    </div>
		</div>
		<div class="card-body">
			<div class="row">
				<?php foreach ($data_pesanan as $dp): ?>
					<?php 
						if ($dp['status'] == 'selesai') {
							$color = 'badge-success';
							$notif = "Pesanan selesai";
						}else{
							$color = 'badge-danger';
							$notif = "Pesanan dibatalkan";
						}

					?>
					<div class="col-lg mt-2">
						<div class="card">
							<div class="card-header">
								<div class="row">
									<p class="badge m-auto badge-md <?php echo $color; ?>"><?php echo $notif; ?></p>
								</div>
								<div class="row mt-2">
									<table cellpadding="2">
										<tr>
											<th>ID PESANAN</th>
											<th>:</th>
											<td><?php echo $dp['id_pesanan']; ?></td>
										</tr>
										<tr>
											<th>TANGGAL PESANAN</th>
											<th>:</th>
											<td><?php echo date('d-m-Y',strtotime($dp['tanggal_pesanan'])); ?></td>
										</tr>
									</table>
								</div>
							</div>
							<div class="card-body">
								<table class="table table-bordered " id="dataTable" width="100%" cellspacing="0" align="center">
									<tr>
										<th>NAMA PRODUK</th>
										<th>JUMLAH</th>
										<th>TOTAL HARGA</th>
									</tr>
									<?php $sub_total = 0; ?>
										<tr>
											<td><?php echo $dp['nama_produk']; ?></td>
											<td><?php echo $dp['jumlah']; ?></td>
											<td><?php echo number_format($dp['total_harga'],0,',','.'); ?></td>
										</tr>
					
								</table>
							</div>
							
						</div>
					</div>	

				<?php endforeach ?>
			</div>
		</div>
	</div>
</div>
</div>