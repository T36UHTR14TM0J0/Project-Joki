<?php 
// ======================================================================================================================================//
//                                                    HALAMAN FUNCTION PRODUCT 					                                         //
// ======================================================================================================================================//




include "koneksi.php"; // memanggil file koneksi.php
include "convertrupiah.php"; // memanggil file convertrupiah.php


// ======================================================================================================================================//
// 															FUNGSI MENAMPILKAN DATA PRODUK												//
// ======================================================================================================================================//
function query_read($query){
 	global $koneksi;

 	$result = mysqli_query($koneksi,$query);
 	$rows = [];
 	while ($row = mysqli_fetch_assoc($result)) {
 		$rows[] = $row;
 	}

 
 	return $rows;
 }

// 														END FUNGSI MENAMPILKAN DATA PRODUK
// ======================================================================================================================================//

// ======================================================================================================================================//
// 															FUNGSI TAMBAH DATA PRODUK 													 //
// ======================================================================================================================================//
 function insert($data){
	global $koneksi; 	//Memanggil variabel koneksi ke database

	// MDENDEKLARASIKAN INPUTDAN FORM TAMBAH KEDALAM VARIABEL
	$id_user			= $_SESSION["id_user"];
	$kode_produk 		= $data['kode_produk'];
	$kode_transaksi		= $data["kode_transaksi"];
	$nama_produk 		= $data['nama_produk'];
	$qty_stock 			= $data['qty_stock'];
	$harga_jual 		= convert_to_number($data['harga_jual']);
	$total_harga_jual 	= convert_to_number($data['total_harga_jual']);
	$tanggal 			= date('Y-m-d H:i:s');
	$harga_beli 		= convert_to_number($data["harga_beli"]);
	$total_harga_beli 	= convert_to_number($data["total_harga_beli"]);
	$kategori 			= "out";

	// MENGAMBIL DATA PRODUK DENGAN NAMA PRODUK YANG DI INPUT USER
	$result_user = mysqli_query($koneksi,"SELECT * FROM tbl_product WHERE nama_produk = '$nama_produk'");
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
		$query_In_produk 	= "INSERT INTO tbl_product VALUES ('$kode_produk','$nama_produk','$qty_stock','$harga_jual','$harga_beli')";
		$insert_produk 		= mysqli_query($koneksi,$query_In_produk);
		
		// $query_In_produk sql untuk menyimpan data produk di tabel tbl_transaksi
		$query_In_transaksi = "INSERT INTO tbl_transaksi VALUES ('','$id_user','$kode_transaksi','$tanggal','$kategori','$kode_produk','$nama_produk','$qty_stock','$harga_beli')";
		$insert_stock 		= mysqli_query($koneksi,$query_In_transaksi);

		
		return	mysqli_affected_rows($koneksi);

	}
}

// 														END FUNGSI TAMBAH DATA PRODUK
// ======================================================================================================================================//

// ======================================================================================================================================//
// 															FUNGSI UPDATE DATA PRODUK 													 //
// ======================================================================================================================================//
function update_product($data){
	global $koneksi;

	// MDENDEKLARASIKAN INPUTDAN FORM EDIT KEDALAM VARIABEL
	$kode_produk		= $data['kode_produk'];
	$nama_produk		= $data["nama_produk"];
	$harga_jual 		= convert_to_number($data["harga_jual"]);
	$total_harga_jual 	= convert_to_number($data['total_harga_jual']);

	// MENYIMPAN QUERY UPDATE KEDALAM VARIABEL
	$query_update 		= "UPDATE tbl_product
							SET 
							harga_jual			= '$harga_jual'
							WHERE kode_produk 	= '$kode_produk'
						";

	// PROSES QUERY UPDATE
	$update_harga = mysqli_query($koneksi,$query_update);

	return mysqli_affected_rows($koneksi);
}

// 														END FUNGSI EDIT DATA PRODUK
// ======================================================================================================================================//


// ======================================================================================================================================//
// 															FUNGSI TAMBAH STOCK PRODUK 													 //
// ======================================================================================================================================//
function tambah_stock($data){
	global $koneksi;

	// MENDEKLARISIKAN HASIL INPUTAN KEDALAM VARIABEL
	$id_user			= $_SESSION["id_user"];
	$kode_produk		= $data['kode_produk'];
	$kode_transaksi		= $data["kode_transaksi"];
	$nama_produk		= $data["nama_produk"];
	$qty_stock 				= $data["qty_stock"];
	$harga_beli 		= convert_to_number($data["harga_beli"]);
	$total_harga_beli	= convert_to_number($data["total_harga_beli"]);
	$tanggal			= date('Y-m-d H:i:s');
	$kategori			= "out";



	$result 			= query_read("SELECT * FROM tbl_product WHERE kode_produk = '$kode_produk'")[0];
	$qty_update			= $qty_stock + $result["qty_stock"];

	
	$query_update = "UPDATE tbl_product
					SET 
					qty_stock			= '$qty_update',
					harga_beli 			= '$harga_beli'
					WHERE kode_produk 	= '$kode_produk'
				";


	
	$insert_transaksi = "INSERT INTO tbl_transaksi
						 VALUES 
						 (
						 	'',
						 	'$id_user',
						 	'$kode_transaksi',
						 	'$tanggal',
						 	'$kategori',
						 	'$kode_produk',
						 	'$nama_produk',
						 	'$qty_stock',
						 	'$harga_beli')";

	$update_stock 	  = mysqli_query($koneksi,$query_update);
	$insert_transaksi = mysqli_query($koneksi,$insert_transaksi);

	return mysqli_affected_rows($koneksi);
}

// 														END FUNGSI TAMBAH STOCK PRODUK
// ======================================================================================================================================//


// ======================================================================================================================================//
// 															FUNGSI TAMBAH STOCK PRODUK 													 //
// ======================================================================================================================================//
function delete($id){
	global $koneksi;
	mysqli_query($koneksi,"DELETE FROM tbl_product WHERE kode_produk='$id'");

	return mysqli_affected_rows($koneksi);
}

// 														END FUNGSI HAPUS DATA PRODUK
// ======================================================================================================================================//

 ?>
