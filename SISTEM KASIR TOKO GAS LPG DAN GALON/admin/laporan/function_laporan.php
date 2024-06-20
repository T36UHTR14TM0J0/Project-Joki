<?php 
// ======================================================================================================================================//
//                                                    HALAMAN FUNCTION LAPORAN 					                                         //
// ======================================================================================================================================//


include "koneksi.php"; //MEMANGGIL FILE KONEKSI DATABASE

// QUERY MENAMPILKAN / MENGAMBIL DATA DARI DATABASE
function query_read($query){
	global $koneksi;
	$result 	= mysqli_query($koneksi,$query);
	$rows 		= [];

	while ($row = mysqli_fetch_assoc($result)){
		$rows[] = $row;

	}
	return $rows;
}


// FUNGSI PENCARIAN DATA TRANSAKSI / FILTER TANGGAL
function search($search){
	$kode_produk 	= $search["pnama_produk"];
	$tgl_awal		=$search['tgl_awal'];
	$tgl_akhir		=$search['tgl_akhir'];

	$query = "SELECT * FROM tbl_transaksi";

	if (isset($kode_produk) && isset($tgl_awal) && isset($tgl_akhir)) {
		$query = $query . " WHERE kode_product = '".$kode_produk."' AND tanggal BETWEEN '$tgl_awal' AND '$tgl_akhir' ORDER BY tanggal ASC";
	}

	if ($kode_produk == 'All') {
		$query ="SELECT * FROM tbl_transaksi WHERE tanggal BETWEEN '$tgl_awal' AND '$tgl_akhir' ORDER BY tanggal ASC";
	}
	
	return query_read($query);
}



?>