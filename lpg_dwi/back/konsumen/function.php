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





// FUNGSI MENYIMPAN EDIT DATA USERS
function update($data){
	global $koneksi;
	$id_konsumen	= $data['id'];
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
			$password_lama = query_select("SELECT * FROM tbl_konsumen WHERE id_konsumen = '$id_konsumen'")[0];
			$password = $password_lama["password"];
		}else{
			$password = md5($password_baru);
			
			
		}

		$query = "UPDATE tbl_konsumen
				SET 
				nik 			= '$nik',
				nama_lengkap 		= '$nama_lengkap',
				alamat		= '$alamat',
				email 			= '$email',
				no_hp 		= '$no_hp',
				username 		= '$username',
				password		= '$password'
				WHERE id_konsumen = '$id_konsumen'
			";	

		
	
		

		mysqli_query($koneksi,$query);

		return mysqli_affected_rows($koneksi);


}


// FUNGSI HAPUS DATA USERS
function delete($id){
	global $koneksi;
	mysqli_query($koneksi,"DELETE FROM tbl_konsumen WHERE id_konsumen = '$id'");

	return mysqli_affected_rows($koneksi);
}

 ?>