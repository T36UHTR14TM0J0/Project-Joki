<?php 
// ======================================================================================================================================//
//                                             				     PAGES HOME 						                                     //
// ======================================================================================================================================//




include "koneksi.php";
$date_sekarang = date("Y-m-d",time()+60*60*24*1);  // MENGHITUNG TANGGAL SEKARANG
$date_sebelum = date('Y-m-d',time()-60*60*24*30); //MENGHITUNG 30 HARI SEBELUM TANGGAL SEKARANG
$data_laporan = mysqli_query($koneksi,"SELECT * FROM tbl_transaksi "); // MENGAMBIL DATA TRANSAKSI BERDASARKAN PERIODE TANGGAL

$total_pemasukan   = 0;
$total_pengeluaran = 0;
$total 			   = 0;
$total_seluruh     = 0;
$laba 				= 0;
$rugi				= 0;

// PERHITUNGAN TOTAL PEMASUKAN,TOTAL PENGELUARAN, DAN TOTAL KESELURUHAN
while ($row_laporan = mysqli_fetch_assoc($data_laporan)) {
		$total = $row_laporan["harga"] * $row_laporan["qty"];
	if ($row_laporan["kategori"] === "in") {
		$total_pemasukan += $total;
	}

	if ($row_laporan["kategori"] === "out") {
		$total_pengeluaran += $total;
	}

	$total_seluruh  = $total_pemasukan + $total_pengeluaran;
}

if($total_pemasukan > $total_pengeluaran){
	$laba = $total_pemasukan - $total_pengeluaran;
}else{
	$rugi = $total_pengeluaran - $total_pemasukan;
}


 ?>

<!-- JUDUL CONTENT HOME -->
<div class="alert alert-success" role="alert">
	  <h4 class="alert-heading text-center text-uppercase">WELCOME <?php echo $_SESSION['username'] ?></h4>
	  
</div>


<!-- BOX CONTENT HOME -->
<div class="jumbotron jumbotron-fluid p-3">
	<h5 class="text-title text-danger">Periode : <?php echo date('d-m-Y',strtotime($date_sebelum)) . " sampai " . date('d-m-Y',strtotime($date_sekarang)); ?></h5>
	<div class="row m-auto justify-content-md-center">
		<!-- BOX PEMASUKAN -->
		<div class="col-md-3 ml-1">
			<div class="card bg-info mb-3" style="max-width: 18rem;">
			  <div class="card-header text-center bg-info text-light">PEMASUKAN</div>
			  <div class="card-body text-light text-center">
			    <h4 class="card-title">Rp. <?=number_format($total_pemasukan,0,",",".");?></h4>
			  </div>
			</div>
		</div>

		<!-- BOX PENGELUARAN -->
		<div class="col-md-3 ml-1">
			<div class="card bg-secondary mb-3" style="max-width: 18rem;">
			  <div class="card-header text-center bg-secondary text-light">PENGELUARAN</div>
			  <div class="card-body text-light text-center">
			    <h4 class="card-title">Rp. <?=number_format($total_pengeluaran,0,",",".");?></h4>
			  </div>
			</div>
		</div>

		<!-- BOX TOTAL KESELURUHAN -->
		<div class="col-md-3 ml-1">
			<div class="card bg-warning mb-3" style="max-width: 18rem;">
			  <div class="card-header text-center bg-warning text-light">TOTAL</div>
			  <div class="card-body text-light text-center">
			    <h4 class="card-title">Rp. <?=number_format($total_seluruh,0,",",".");?></h4>
			  </div>
			</div>
		</div>	
		<!-- BOX LABA -->
		<div class="col-md-3 ml-1">
			<div class="card bg-success mb-3" style="max-width: 18rem;">
			  <div class="card-header text-center bg-success text-light">LABA</div>
			  <div class="card-body text-light text-center">
			    <h4 class="card-title">Rp. <?=number_format($laba,0,",",".");?></h4>
			  </div>
			</div>
		</div>

			<div class="col-md-3 ml-1">
			<div class="card bg-danger mb-3" style="max-width: 18rem;">
			  <div class="card-header text-center bg-danger text-light">RUGI</div>
			  <div class="card-body text-light text-center">
			    <h4 class="card-title">Rp. <?=number_format($rugi,0,",",".");?></h4>
			  </div>
			</div>
		</div>
	</div>

	<!-- LINK REL VIEW ALL LAPORAN  -->
	<div class="row justify-content-md-center">
		<div class="col-md-6 text-center">
			<a href="index.php?pages=laporan" class="btn btn-outline-secondary"><<- Views All ->></a>
		</div>
	</div>	
</div>


