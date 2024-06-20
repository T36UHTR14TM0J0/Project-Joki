<?php 


include "../koneksi/koneksi.php";
$date_sekarang = date("Y-m-d",time()+60*60*24*1);  // MENGHITUNG TANGGAL SEKARANG
$date_sebelum = date('Y-m-d',time()-60*60*24*30); //MENGHITUNG 30 HARI SEBELUM TANGGAL SEKARANG
$data_laporan = mysqli_query($koneksi,"SELECT * FROM tbl_transaksi "); // MENGAMBIL DATA TRANSAKSI BERDASARKAN PERIODE TANGGAL

$total_pemasukan   = 0;
$total_pengeluaran = 0;
$total 			   = 0;
$total_seluruh     = 0;


// PERHITUNGAN TOTAL PEMASUKAN,TOTAL PENGELUARAN, DAN TOTAL KESELURUHAN
while ($row_laporan = mysqli_fetch_assoc($data_laporan)) {
		$total = $row_laporan["total_harga"];
	if ($row_laporan["keterangan"] == "masuk") {
		$total_pemasukan += $total;
	}

	if ($row_laporan["keterangan"] == "keluar") {
		$total_pengeluaran += $total;
	}

	$total_seluruh  = $total_pemasukan + $total_pengeluaran;
}


 ?>

<!-- BOX CONTENT HOME -->
<div class="jumbotron jumbotron-fluid p-3">
	<h5 class="text-title text-light p-2 text-center bg-secondary">Laporan satu bulan terakhir periode : <?php echo date('d-m-Y',strtotime($date_sebelum)) . " sampai " . date('d-m-Y',strtotime($date_sekarang)); ?></h5>
	<div class="row m-auto justify-content-md-center pt-5">
		<!-- BOX PEMASUKAN -->
		<div class="col-md-3 ml-1">
			<div class="card border border-success mb-3" style="max-width: 18rem;">
			  <div class="card-header text-center bg-success text-light">PEMASUKAN</div>
			  <div class="card-body text-success text-center">
			    <h4 class="card-title">Rp. <?=number_format($total_pemasukan,0,",",".");?></h4>
			  </div>
			</div>
		</div>

		<!-- BOX PENGELUARAN -->
		<div class="col-md-3 ml-1">
			<div class="card border border-danger mb-3" style="max-width: 18rem;">
			  <div class="card-header text-center bg-danger text-light">PENGELUARAN</div>
			  <div class="card-body text-danger text-center">
			    <h4 class="card-title">Rp. <?=number_format($total_pengeluaran,0,",",".");?></h4>
			  </div>
			</div>
		</div>

		<!-- BOX TOTAL KESELURUHAN -->
		<div class="col-md-3 ml-1">
			<div class="card border border-warning mb-3" style="max-width: 18rem;">
			  <div class="card-header text-center bg-warning text-light">TOTAL</div>
			  <div class="card-body text-warning text-center">
			    <h4 class="card-title">Rp. <?=number_format($total_seluruh,0,",",".");?></h4>
			  </div>
			</div>
		</div>	
		
	</div>
</div>


