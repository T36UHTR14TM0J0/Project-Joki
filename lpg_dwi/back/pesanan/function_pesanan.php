<?php 
// session_start();
include "../koneksi/koneksi.php"; // memanggil file koneksi.php
include "convertrupiah.php"; // memanggil file convertrupiah.php



function query_read($query){
 	global $koneksi;

 	$result = mysqli_query($koneksi,$query);
 	$rows = [];
 	while ($row = mysqli_fetch_assoc($result)) {
 		$rows[] = $row;
 	}

 
 	return $rows;
 }

 function insert($data){
	global $koneksi; 	//Memanggil variabel koneksi ke database
	$id_pesanan 		= $data['id_pesanan'];
	$id_konsumen 		= $_SESSION['sess_id'];
	$tanggal 			= date('Y-m-d H:i:s');
	$query_pesanan = "SELECT * FROM tbl_pesanan JOIN tbl_konsumen ON tbl_pesanan.id_konsumen = tbl_konsumen.id_konsumen JOIN tbl_produk ON tbl_pesanan.id_produk = tbl_produk.id_produk WHERE tbl_pesanan.id_pesanan = '$id_pesanan'";
	$result_pesanan         = mysqli_query($koneksi,$query_pesanan);
	$row_pesanan			= mysqli_fetch_assoc($result_pesanan);
	$id_produk	 			= $row_pesanan['id_produk'];
	$status 	 			= $row_pesanan['status'];
	$qty_pesan   			= $row_pesanan['jumlah'];
	$stock        			= $row_pesanan["stok"];
	$nama_produk  			= $row_pesanan['nama_produk'];
	$total_stock  			= $stock - $qty_pesan;
	$total_harga			= $row_pesanan['total_harga'];

	if ($status == 'pesan') {
		$query_update = "UPDATE tbl_produk
			SET 
				stok					= '$total_stock'
				WHERE id_produk 	= '$id_produk'
			";
		$update_stock = mysqli_query($koneksi,$query_update);
	}

	if($status == 'pesan'){
		$status_update = 'antar';
	}

	if ($status == 'antar') {
		$status_update = 'selesai' ;
		$insert_transaksi = mysqli_query($koneksi,"INSERT INTO tbl_transaksi VALUES ('','$id_konsumen','$id_produk','$tanggal','$qty_pesan','$total_harga','masuk')");
	}
	



	// MENYIMPAN QUERY UPDATE KEDALAM VARIABEL
	$query_update 		= "UPDATE tbl_pesanan
							SET 
							status			= '$status_update'
							WHERE id_pesanan 	= '$id_pesanan'
						";

	// PROSES QUERY UPDATE
	$update_harga = mysqli_query($koneksi,$query_update);
		
		return	mysqli_affected_rows($koneksi);

}
