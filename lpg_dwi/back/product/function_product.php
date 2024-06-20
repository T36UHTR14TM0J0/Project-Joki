<?php 




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

	// MDENDEKLARASIKAN INPUTDAN FORM TAMBAH KEDALAM VARIABEL
	$id_pemilik			= $_SESSION["sess_id"];
	$id_produk 			= $data['id_produk'];
	$nama_produk 		= $data['nama_produk'];
	$stok 				= $data['stok'];
	$harga_jual 		= convert_to_number($data['harga_jual']);
	$total_harga_jual 	= convert_to_number($data['total_harga_jual']);
	$tanggal 			= date('Y-m-d H:i:s');
	$harga_beli 		= convert_to_number($data["harga_beli"]);
	$total_harga_beli 	= convert_to_number($data["total_harga_beli"]);
	$keterangan 		= "keluar";

	// MENGAMBIL DATA PRODUK DENGAN NAMA PRODUK YANG DI INPUT USER
	$result_user = mysqli_query($koneksi,"SELECT * FROM tbl_produk WHERE nama_produk = '$nama_produk'");
	$cek = mysqli_num_rows($result_user);

	// MELAKUKAN PENGECEKAN APAKAH PRODUK SUDAH ADA DI DATABASE
	if ($cek > 0) {
		 echo "<script>
		 window.location.href = 'index.php?pages=product&aksi=tambah&notif_gagal=Data Produk sudah ada';
		 </script>";
		 exit;
	}else{


		// JIKA PRODUK TIDAK ADA DI SISTEM MAKA LAKUKAN INSERT //
		// $query_In_produk sql untuk menyimpan data produk di tabel tbl_produk
		$query_In_produk 	= "INSERT INTO tbl_produk VALUES ('$id_produk','$nama_produk','$stok','$harga_jual','$harga_beli')";
		$insert_produk 		= mysqli_query($koneksi,$query_In_produk);
		
		// $query_In_produk sql untuk menyimpan data produk di tabel tbl_transaksi
		$query_In_transaksi = "INSERT INTO tbl_transaksi VALUES ('','$id_pemilik','$id_produk','$tanggal','$stok','$total_harga_beli','$keterangan')";
		$insert_stock 		= mysqli_query($koneksi,$query_In_transaksi);

		
		return	mysqli_affected_rows($koneksi);

	}
}

function update_product($data){
	global $koneksi;

	// MDENDEKLARASIKAN INPUT sDAN FORM EDIT KEDALAM VARIABEL
	$id_produk			= $data['id_produk'];
	$nama_produk		= $data["nama_produk"];
	$harga_jual 		= convert_to_number($data["harga_jual"]);
	$total_harga_jual 	= convert_to_number($data['total_harga_jual']);

	// MENYIMPAN QUERY UPDATE KEDALAM VARIABEL
	$query_update 		= "UPDATE tbl_produk
							SET 
							nama_produk			= '$nama_produk',
							harga_jual			= '$harga_jual'
							WHERE id_produk 	= '$id_produk'
						";

	// PROSES QUERY UPDATE
	$update_harga = mysqli_query($koneksi,$query_update);

	return mysqli_affected_rows($koneksi);
}

function tambah_stock($data){
	global $koneksi;

	// MENDEKLARISIKAN HASIL INPUTAN KEDALAM VARIABEL
	$id_pemilik			= $_SESSION["sess_id"];
	$id_produk			= $data['id_produk'];
	$nama_produk		= $data["nama_produk"];
	$stok 				= $data["stok"];
	$harga_beli 		= convert_to_number($data["harga_beli"]);
	$total_harga_beli	= convert_to_number($data["total_harga_beli"]);
	$tanggal			= date('Y-m-d H:i:s');
	$keterangan			= "keluar";



	$result 			= query_read("SELECT * FROM tbl_produk WHERE id_produk = '$id_produk'")[0];
	$stok_update			= $stok + $result["stok"];

	
	$query_update = "UPDATE tbl_produk
					SET 
					stok					= '$stok_update',
					harga_beli 			= '$harga_beli'
					WHERE id_produk 	= '$id_produk'
				";


	
	$insert_transaksi = "INSERT INTO tbl_transaksi
						 VALUES 
						 (
						 	'',
						 	'$id_pemilik',
						 	'$id_produk',
						 	'$tanggal',
						 	'$stok',
						 	'$total_harga_beli',
						 	'$keterangan')";

	$update_stock 	  = mysqli_query($koneksi,$query_update);
	$insert_transaksi = mysqli_query($koneksi,$insert_transaksi);

	return mysqli_affected_rows($koneksi);
}


function delete($id){
	global $koneksi;
	mysqli_query($koneksi,"DELETE FROM tbl_produk WHERE id_produk='$id'");

	return mysqli_affected_rows($koneksi);
}



 ?>
