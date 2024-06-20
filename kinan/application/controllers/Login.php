<?php
// ##### CONTROLLER LOGIN ##### //
class Login extends CI_Controller {
  function __construct()
  {
	parent::__construct();
	// session_start();
	
	$this->load->model('m_login');
	$this->load->model('ModelPosyandu');
  }

  // ##### FUNGSI INDEX ##### //
  function index()
  {
  	// cek apakah user sudah login 
	if ($this->session->userdata('status') == "login") {
        redirect(base_url("Welcome"));
    }
	$data['err_message'] = "";
	$this->load->view('login',$data);
  }

  // ##### PROSES LOGIN ##### //
  function aksi_login()
  {


  	$username = $this->input->post('username');
	$pass 	  = $this->input->post('password');		
	$password = sha1(md5($pass));

	

	$where = array(
		'username' => $username,
		'password' => $password
	);

	$cek = $this->m_login->cek_login("user",$where)->num_rows();
	$data_user = $this->ModelPosyandu->getData('user','*',"WHERE username = '$username'");
	if($cek > 0){
		
			$data_session = array(
			'id_user'		=> $data_user[0]['id_user'],
			'nama' 			=> $username,
			'nama_lengkap'	=> $data_user[0]['nama_lengkap'],
			'status' 		=> "login",
			'level'			=> $data_user[0]["level"],
			'notif_sukses' 	=> "Anda berhasil Login..."
	);
			
		// $_SESSION['username'] = $username;
		$this->session->set_userdata($data_session);
		redirect("welcome");

	}else{
		$this->session->set_userdata("notif_gagal","Username & password salah !");
		$this->load->view('login');
	}
  }

// ##### FUNGSI LOGOUT ##### //
function logout(){
 	// $data_session = array(
 	// 	'id_user',
		// 'nama',
		// 'status',
		// 'level'
		// );
  	$this->session->unset_userdata("id_user");
  	$this->session->unset_userdata("nama");
  	$this->session->unset_userdata("status");
  	$this->session->unset_userdata("level");
  	$this->session->sess_destroy();
  	$this->session->set_userdata("notif_sukses","Berhasil Logout..");
  	$this->load->view('login');
  }

}

