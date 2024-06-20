<?php 
// ======================================================================================================================================//
//                                                    PROSES PENGECEKAN DATA LOGIN USER 	                                             //
// ======================================================================================================================================//


session_start();
include 'koneksi/koneksi.php'; //INCLUDE KONEKSI DATABASE
// FUNGSI QUERY SELECT / FUNGSI MENAMPILKAN DATA USERS

function query_select($query){
	global $koneksi;
	$result 	= mysqli_query($koneksi,$query);
	$rows 		= [];

	while ($row = mysqli_fetch_assoc($result)){
		$rows[] = $row;

	}
	return $rows;
}

$nik 			= str_replace(' ','',$_POST['nik']); // MENAMPUNG NILAI INPUT POST NIK KEDALAM VARIABEL NIK
$nama_lengkap 	= $_POST['nama_lengkap']; // MENAMPUNG NILAI INPUT POST NAMA LENGKAP KEDALAM VARIABEL NAMA LENGKAP
$alamat 		= $_POST['alamat']; // MENAMPUNG NILAI INPUT POST ALAMAT KEDALAM VARIABEL ALAMAT
$email = $_POST['email']; // MENAMPUNG NILAI INPUT POST EMAIL KEDALAM VARIABEL EMAIL
$no_hp = str_replace('-','',$_POST['no_hp']); // MENAMPUNG NILAI INPUT POST NO HP KEDALAM VARIABEL NO HP
$username = $_POST['username']; // MENAMPUNG NILAI INPUT POST USERNAME KEDALAM VARIABEL USERNAME
$password = md5($_POST['password']); // MENAMPUNG NILAI INPUT POST PASSWORD KEDALAM VARIABEL PASSWORD DAN DI ENKRIPSI MENGGUNAKAN MD5

$level = "konsumen";



$query = "SELECT * FROM tbl_konsumen WHERE nik = '$nik'"; // SYNTAX SQL CEK APAKAH NIK SUDAH TERDAFTAR

$result = mysqli_query($koneksi,$query); // MENJALANKAN PROSES QUERY
$num_row = mysqli_num_rows($result); // MENCARI DATA USER 
$row = mysqli_fetch_assoc($result); // MENAMPUNG DATA USER KEDALAM VARIABEL ARRAY

if ($num_row >=1) {
	
	$Arr_Return		= array(
						'status'		=> 2
	);

}else{
    $query       = query_select("SELECT max(id_konsumen) as kodeTerbesar FROM tbl_konsumen")[0];
    $KodeUser 	 = $query['kodeTerbesar'];
    $urutan		 = (int) substr($KodeUser, 2, 2);
    $urutan++;
    $KodeUser = "U" . sprintf("%02s", $urutan);
	mysqli_query($koneksi,"INSERT INTO tbl_konsumen VALUES ('$KodeUser','$nik','$nama_lengkap','$alamat','$email','$no_hp','$username','$password')");

	$Arr_Return		= array(
						'status'		=> 1
					);
}

echo json_encode($Arr_Return);

 ?>