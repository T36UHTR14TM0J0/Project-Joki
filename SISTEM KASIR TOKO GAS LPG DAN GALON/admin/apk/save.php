<?php 
	date_default_timezone_set('Asia/Jakarta');
	include "../koneksi.php";
	include "../convertrupiah.php";
	session_start();

	$id_user		= $_SESSION["id_user"];
	$nama_kasir     = $_SESSION["username"];
	$kode_transaksi = $_POST["kode_transaksi"];
	$detailproduk 	= $_POST["detDetail"];
	$total_pesan 	= convert_to_number($_POST["totalpesan"]);
	$bayar 			= convert_to_number($_POST["bayar"]);
	$kembalian 		= convert_to_number($_POST["kembalian"]);
	
	$tanggal 		= date('Y-m-d H:i:s');
	$kategori		= "in";
	$total 			= count($detailproduk);



	for ($i=1; $i <= $total ; $i++) { 
		$sid_user		= $id_user;
		$skode_produk	= $detailproduk[$i]["tkode_produk"]; 
		$snama_produk	= $detailproduk[$i]["tnama_produk"];
		$sqty			= $detailproduk[$i]["tqty"];
		$sharga 		= convert_to_number($detailproduk[$i]["tharga"]);
		$stotal_harga	= convert_to_number($detailproduk[$i]["ttotal_harga"]);
	

		$insert_transaksi = mysqli_query($koneksi,"INSERT INTO tbl_transaksi VALUES ('','$id_user','$kode_transaksi','$tanggal','$kategori','$skode_produk','$snama_produk','$sqty','$sharga')");
		

 
		$query        = "SELECT * FROM tbl_product WHERE kode_produk = '$skode_produk'";
		$result       = mysqli_query($koneksi,$query);
		$cek_result   = mysqli_fetch_assoc($result);
		$stock        = $cek_result["qty_stock"];
		$kode_produk  = $cek_result["kode_produk"];
		

		$total_stock  = $stock - $detailproduk[$i]["tqty"];
		$total_harga_produk = $total_stock * $cek_result["harga_jual"];;
	

		
		$query_update = "UPDATE tbl_product
					SET 
					qty_stock					= '$total_stock'
					WHERE kode_produk 			= '$kode_produk'
				";
		$update_stock = mysqli_query($koneksi,$query_update);
	}
	

	$Arr_Return = array();
	
	if ($update_stock && $insert_transaksi) {
		$Arr_Return		= array(
			'status'    => 1,
			'nama_kasir'=> $nama_kasir,
			'kode'		=> $kode_transaksi,
			'bayar'		=> $bayar,
			'kembalian'	=> $kembalian,
			'pesan'		=> 'Proses Transaksi Berhasil'
			);
	}else{
		$Arr_Return		= array(
			'status'    => 2,
			'pesan'		=> 'Proses Transaksi Gagal'
			);
	}

	echo json_encode($Arr_Return);





 ?>