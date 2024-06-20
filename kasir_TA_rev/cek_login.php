<?php 
// ======================================================================================================================================//
//                                                    PROSES PENGECEKAN DATA LOGIN USER 	                                             //
// ======================================================================================================================================//



session_start();
include 'admin/koneksi.php'; //INCLUDE KONEKSI DATABASE

$username = $_POST['username']; // MENAMPUNG NILAI INPUT POST USERNAME KEDALAM VARIABEL USERNAME
$password = md5($_POST['password']); // MENAMPUNG NILAI INPUT POST PASSWORD KEDALAM VARIABEL PASSWORD DAN DI ENKRIPSI MENGGUNAKAN MD5

$query = "SELECT * FROM tbl_users WHERE username = '$username' AND password='$password'"; // SYNTAX SQL CEK APAKAH USERNAME & PASSWORD BENAR 

$result = mysqli_query($koneksi,$query); // MENJALANKAN PROSES QUERY
$num_row = mysqli_num_rows($result); // MENCARI DATA USER 
$row = mysqli_fetch_assoc($result); // MENAMPUNG DATA USER KEDALAM VARIABEL ARRAY

if ($num_row >=1) {
	$Arr_Return		= array(
						'status'		=> 1
	);

	// MEMBUAT SESSION USER YANG LOGIN
	$_SESSION['id_user']  = $row['id_user'];
	$_SESSION['username'] = $row['username'];
	$_SESSION["level"] 	  = $row["level"];
	$_SESSION['login']	  = TRUE;
}else{
	$Arr_Return		= array(
						'status'		=> 2
					);
}

echo json_encode($Arr_Return);

 ?>