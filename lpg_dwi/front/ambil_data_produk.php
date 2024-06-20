<?php 
include "../koneksi/koneksi.php";

$nama_produk = $_POST["nama_produk"];
$query = "SELECT * FROM tbl_produk WHERE nama_produk = '$nama_produk' LIMIT 1";
$result = mysqli_query($koneksi,$query);
$cek_result = mysqli_fetch_assoc($result);
$data_pilih = array();
if ($cek_result) {
	$data_pilih = array(
		'id_produk' => $cek_result["id_produk"],
		'stok'	  => $cek_result["stok"],
		'harga_jual'  => $cek_result["harga_jual"]
	);
}

echo json_encode($data_pilih);


 ?>