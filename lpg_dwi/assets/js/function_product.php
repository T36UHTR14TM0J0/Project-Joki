<?php 
include "koneksi.php";

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
	global $koneksi;
	$kode_produk 		= $data['kode_produk'];
	$nama_produk 		= $data['nama_produk'];
	$qty_stock 			= $data['qty_stock'];
	$harga_jual 		= $data['harga_jual'];
	$total_harga_jual 	= $data['tot_harga_jual'];




	$result_user = mysqli_query($koneksi,"SELECT * FROM tbl_product WHERE nama_produk = '$nama_produk'");
	$cek = mysqli_num_rows($result_user);

	if ($cek > 0) {
		 echo "<script>
		 window.location.href = 'index.php?pages=product&aksi=tambah&notif_gagal=Data Produk sudah ada';
		 </script>";
		 exit;
	}else{
		// insert table product
		$insert_produk = mysqli_query($koneksi,"INSERT INTO tbl_product VALUES ('$kode_produk','$nama_produk','$qty_stock','$harga_jual')");

		$tanggal = date('Y-m-d H:i:s');
		$harga = $data["harga_beli"];
		$total 	= $data["tot_harga_beli"];
		$kategori = "out";
		$insert_stock = mysqli_query($koneksi,"INSERT INTO tbl_laporan VALUES ('','$tanggal','$kode_produk','$nama_produk','$kategori','$qty_stock','$harga','$total')");

		
		return	mysqli_affected_rows($koneksi);

	}
}

function update_product($data){
	global $koneksi;
	$kode_produk		= $data['kode_produk'];
	$nama_produk		= $data["nama_produk"];
	$qty_stock 			= $data["qty_stock"];
	$harga_jual 		= $data["harga_jual"];


		$query_update = "UPDATE tbl_product
					SET 
					harga_jual			= '$harga_jual'
					WHERE kode_produk 	= '$kode_produk'
				";


	$update_harga = mysqli_query($koneksi,$query_update);

	return mysqli_affected_rows($koneksi);
}

function tambah_stock($data){
	global $koneksi;
	$kode_produk		= $data['kode_produk'];
	$nama_produk		= $data["nama_produk"];
	$qty 				= $data["qty"];
	$harga 				= $data["harga"];
	$total				= $data["total"];
	$tanggal			= date('Y-m-d H:i:s');
	$kategori			= "out";


	$result = query_read("SELECT * FROM tbl_product WHERE kode_produk = '$kode_produk'")[0];
	$qty_stock		= $qty + $result["qty_stock"];

		$query_update = "UPDATE tbl_product
					SET 
					qty_stock			= '$qty_stock'
					WHERE kode_produk 	= '$kode_produk'
				";


	
		$insert_laporan = "INSERT INTO tbl_laporan
						 VALUES 
						 (
						 	'',
						 	'$tanggal',
						 	'$kode_produk',
						 	'$nama_produk',
						 	'$kategori',
						 	'$qty',
						 	'$harga',
						 	'$total')";

	$update_stock = mysqli_query($koneksi,$query_update);
	$insert_laporan = mysqli_query($koneksi,$insert_laporan);

	return mysqli_affected_rows($koneksi);
}


function delete($id){
	global $koneksi;
	mysqli_query($koneksi,"DELETE FROM tbl_product WHERE kode_produk='$id'");

	return mysqli_affected_rows($koneksi);
}

 ?>
