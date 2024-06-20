<?php 
include "../koneksi.php";



 
$nama_produk = $_POST["nama_produk"];
$query = "SELECT * FROM tbl_product WHERE nama_produk = '$nama_produk' LIMIT 1";
$result = mysqli_query($koneksi,$query);
$cek_result = mysqli_fetch_assoc($result);
$data_pilih = array();
if ($cek_result) {
	$data_pilih = array(
		'kode_produk' => $cek_result["kode_produk"],
		'qty_stock'	  => $cek_result["qty_stock"],
		'harga_jual'		  => $cek_result["harga_jual"]
	);
}

echo json_encode($data_pilih);


 ?>