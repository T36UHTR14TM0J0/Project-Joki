<?php 



include "../koneksi/koneksi.php";

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


// FUNGSI MENYIMPAN DATA USERS
function insert($data){
	global $koneksi;
	$nik 			= str_replace(' ','',$_POST['nik']); // MENAMPUNG NILAI INPUT POST NIK KEDALAM VARIABEL NIK
	$nama_lengkap 	= $_POST['nama_lengkap']; // MENAMPUNG NILAI INPUT POST NAMA LENGKAP KEDALAM VARIABEL NAMA LENGKAP
	$alamat 		= $_POST['alamat']; // MENAMPUNG NILAI INPUT POST ALAMAT KEDALAM VARIABEL ALAMAT
	$email = $_POST['email']; // MENAMPUNG NILAI INPUT POST EMAIL KEDALAM VARIABEL EMAIL
	$no_hp = str_replace('-','',$_POST['no_hp']); // MENAMPUNG NILAI INPUT POST NO HP KEDALAM VARIABEL NO HP
	$username = $_POST['username']; // MENAMPUNG NILAI INPUT POST USERNAME KEDALAM VARIABEL USERNAME
	$password = md5($_POST['password']); // MENAMPUNG NILAI INPUT POST PASSWORD KEDALAM VARIABEL PASSWORD DAN DI ENKRIPSI MENGGUNAKAN MD5


	$result_user = mysqli_query($koneksi,"SELECT * FROM tbl_pemilik WHERE nik = '$nik'");
	$cek 		 = mysqli_num_rows($result_user);

	if ($cek > 0) {
		 echo "<script>
		 window.location.href = 'index.php?pages=pemilik&aksi=tambah&notif_gagal=Data pemilik sudah ada';
		 </script>";
		 exit;
	}else{
		 	// mengambil data barang dengan kode paling besar
		    $query       = query_select("SELECT max(id_pemilik) as kodeTerbesar FROM tbl_pemilik")[0];
		    $KodeUser 	 = $query['kodeTerbesar'];
		    $urutan		 = (int) substr($KodeUser, 2, 2);
		    $urutan++;
		    $KodeUser = "U" . sprintf("%02s", $urutan);
			mysqli_query($koneksi,"INSERT INTO tbl_pemilik VALUES ('$KodeUser','$nik','$nama_lengkap','$alamat','$email','$no_hp','$username','$password')");
		
		return	mysqli_affected_rows($koneksi);

	}
}


// FUNGSI MENYIMPAN EDIT DATA USERS
function update($data){
	global $koneksi;
	$id_pemilik	= $data['id'];
	$nik 			= str_replace(' ','',$_POST['nik']); // MENAMPUNG NILAI INPUT POST NIK KEDALAM VARIABEL NIK
	$nama_lengkap 	= $_POST['nama_lengkap']; // MENAMPUNG NILAI INPUT POST NAMA LENGKAP KEDALAM VARIABEL NAMA LENGKAP
	$alamat 		= $_POST['alamat']; // MENAMPUNG NILAI INPUT POST ALAMAT KEDALAM VARIABEL ALAMAT
	$email = $_POST['email']; // MENAMPUNG NILAI INPUT POST EMAIL KEDALAM VARIABEL EMAIL
	$no_hp = str_replace('-','',$_POST['no_hp']); // MENAMPUNG NILAI INPUT POST NO HP KEDALAM VARIABEL NO HP

	$username	= $data['username'];
	$password_baru	= trim($data['password']);
	$password_lama = "";
	$password ="";


		if($password_baru === "" || $password_baru === null){
			$password_lama = query_select("SELECT * FROM tbl_pemilik WHERE id_pemilik = '$id_pemilik'")[0];
			$password = $password_lama["password"];
		}else{
			$password = md5($password_baru);
			
			
		}

		$query = "UPDATE tbl_pemilik
				SET 
				nik 			= '$nik',
				nama_lengkap 		= '$nama_lengkap',
				alamat		= '$alamat',
				email 			= '$email',
				no_hp 		= '$no_hp',
				username 		= '$username',
				password		= '$password'
				WHERE id_pemilik = '$id_pemilik'
			";	

		
	
		

		mysqli_query($koneksi,$query);

		return mysqli_affected_rows($koneksi);


}


// FUNGSI HAPUS DATA USERS
function delete($id){
	global $koneksi;
	mysqli_query($koneksi,"DELETE FROM tbl_pemilik WHERE id_pemilik = '$id'");

	return mysqli_affected_rows($koneksi);
}

 ?>