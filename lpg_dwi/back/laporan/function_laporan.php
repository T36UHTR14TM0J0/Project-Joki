<?php 
// ======================================================================================================================================//
//                                                    HALAMAN FUNCTION LAPORAN 					                                         //
// ======================================================================================================================================//


include "../koneksi/koneksi.php"; //MEMANGGIL FILE KONEKSI DATABASE

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
	$tgl_awal		=$search['tgl_awal'];
	$tgl_akhir		=$search['tgl_akhir'];

	$query = "SELECT * FROM tbl_transaksi JOIN tbl_pemilik ON tbl_transaksi.id_pemilik = tbl_pemilik.id_pemilik JOIN tbl_produk ON tbl_transaksi.id_produk = tbl_produk.id_produk";

	if ( $tgl_awal != null && $tgl_akhir != null) {
		$query = $query . " WHERE tanggal BETWEEN '$tgl_awal' AND '$tgl_akhir' ORDER BY tanggal ASC";
	}


	return query_read($query);
}



?>