<?php 

// ======================================================================================================================================//
//                                                    HALAMAN FUNCTION DATA USERS 				                                         //
// ======================================================================================================================================//


include "koneksi.php";

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
	$username = $data['username'];
	$password = md5($data['password']);
	$level    = $data["level"];

	$result_user = mysqli_query($koneksi,"SELECT * FROM tbl_users WHERE username = '$username'");
	$cek 		 = mysqli_num_rows($result_user);

	if ($cek > 0) {
		 echo "<script>
		 window.location.href = 'index.php?pages=user&aksi=tambah&notif_gagal=Data User sudah ada';
		 </script>";
		 exit;
	}else{
		 	// mengambil data barang dengan kode paling besar
            $query       = query_select("SELECT max(id_user) as kodeTerbesar FROM tbl_users WHERE level = '$level'")[0];
            $KodeUser 	 = $query['kodeTerbesar'];
            $urutan		 = (int) substr($KodeUser, 2, 2);
            $urutan++;
             
            if ($level === "penjual") {
            	$KodeUser = "K" . sprintf("%02s", $urutan);
            }else{
            	$KodeUser = "A" . sprintf("%02s", $urutan);
            }

		mysqli_query($koneksi,"INSERT INTO tbl_users VALUES ('$KodeUser','$level','$username','$password')");
		
		return	mysqli_affected_rows($koneksi);

	}
}


// FUNGSI MENYIMPAN EDIT DATA USERS
function update($data){
	global $koneksi;
	$id_user	= $data['id'];
	$level		= $data["level"];
	$username	= $data['username'];
	$password_baru	= trim($data['password']);
	$password_lama = "";
	$password ="";


		if($password_baru === "" || $password_baru === null){
			$password_lama = query_select("SELECT * FROM tbl_users WHERE id_user = '$id_user'")[0];
			$password = $password_lama["password"];
		}else{
			$password = md5($password_baru);
			
			
		}

		$query = "UPDATE tbl_users
				SET 
				level 			= '$level',
				username 		= '$username',
				password		= '$password'
				WHERE id_user = '$id_user'
			";	

		
	
		

		mysqli_query($koneksi,$query);

		return mysqli_affected_rows($koneksi);


}


// FUNGSI HAPUS DATA USERS
function delete($id){
	global $koneksi;
	mysqli_query($koneksi,"DELETE FROM tbl_users WHERE id_user = '$id'");

	return mysqli_affected_rows($koneksi);
}

 ?>