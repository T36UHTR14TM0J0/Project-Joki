<?php 
// ======================================================================================================================================//
//                                                    PROSES PENGECEKAN DATA LOGIN USER 	                                             //
// ======================================================================================================================================//



session_start();
include 'koneksi/koneksi.php';

$username = $_POST['username']; 
$password = md5($_POST['password']); 
$opsi 	  = $_POST['opsi'];

if ($opsi == 'pemilik') {
	$query = "SELECT * FROM tbl_pemilik WHERE username = '$username' AND password='$password'";
	$result = mysqli_query($koneksi,$query); 
	$num_row = mysqli_num_rows($result); 
	$row = mysqli_fetch_assoc($result);
	$sess_id = $row['id_pemilik'];
}else{
	$query = "SELECT * FROM tbl_konsumen WHERE username = '$username' AND password='$password'";
	$result = mysqli_query($koneksi,$query); 
	$num_row = mysqli_num_rows($result); 
	$row = mysqli_fetch_assoc($result);
	$sess_id = $row['id_konsumen'];
}


if ($num_row >=1) {
	
	$_SESSION['sess_id']  = $sess_id;
	$_SESSION['username'] = $row['username'];
	$_SESSION['login']	  = TRUE;
	$_SESSION['opsi']	  = $opsi;
	$Arr_Return		= array(
						'status'		=> 1,
						'opsi'			=> $opsi
	);
}else{
	$Arr_Return		= array(
						'status'		=> 2
					);
}

echo json_encode($Arr_Return);

 ?>