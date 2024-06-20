<?php 
	date_default_timezone_set('Asia/Jakarta');
	include "../koneksi/koneksi.php";
	include "../back/convertrupiah.php";
	session_start();

	function query_read($query){
    global $koneksi;

    $result   = mysqli_query($koneksi,$query);
    $rows     = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }

 
    return $rows;
 }

	$query          = query_read("SELECT max(id_pesanan) as kodeTerbesar FROM tbl_pesanan")[0]; // mengambil data barang dengan kode paling besar
	$id_pesanan  = $query['kodeTerbesar'];
	$urutan         = (int) substr($id_pesanan, 6, 3); // mengambil angka dari kode barang terbesar, menggunakan fungsi substr           
	$urutan++;  // bilangan yang diambil ini ditambah 1 untuk menentukan nomor urut berikutnya        
	
	

	$id_pesanan 	= date("dmy").sprintf("%03s", $urutan);
	$id_konsumen	= $_SESSION["sess_id"];
	$tgl_pesan 		= $_POST['tgl_pesan'];
	$id_produk		= $_POST['id_produk'];
	$jumlah			= $_POST['jumlah'];
	$total_harga 	= convert_to_number($_POST['total_harga']);
	$status			= "pesan";
	
	
	$insert_pesanan 		= mysqli_query($koneksi,"INSERT INTO tbl_pesanan VALUES ('$id_pesanan','$id_konsumen','$id_produk','$tgl_pesan','$status','$jumlah','$total_harga')");

	 $Arr_Return = array();
	
	if ($insert_pesanan) {
		$Arr_Return		= array(
			'status'    => 1,
			'pesan'		=> 'Proses pesanan Berhasil'
			);
	}else{
		$Arr_Return		= array(
			'status'    => 2,
			'pesan'		=> 'Proses pesanan Gagal'
			);
	}

	echo json_encode($Arr_Return);

 ?>