<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

	function __construct(){
		Parent::__construct();
		if ($this->session->userdata('is_login') === "true") {
                redirect(base_url("Dashboard"));
        }
		$this->load->Model("M_siakad");

	}

	public function index()
	{
		$this->load->view('v_login');
	}

	public function Login(){
		$username 	= $this->input->post("username");
		$password 	= $this->input->post("password");
		$where = [
			"username" => $username
		];

		$cek = $this->M_siakad->cek_login("tbl_users",$where)->num_rows();
		$data_user = $this->M_siakad->getData('tbl_users','*',"WHERE username = '$username'");
		if($cek > 0){
			if (password_verify($password, $data_user[0]['password'])) {
				$sess_data = [
					"id_user"  	=> $data_user[0]["id_user"],
					"username"	=> $data_user[0]["username"],
					"is_login"	=> true,
					"pesan_sukses" => "Berhasil login ..."	
				];
				$this->session->set_userdata($sess_data);
				redirect("Dashboard");
			}else{
				$this->session->set_userdata("pesan_error","Username / password salah..!");
				redirect("Auth");
			}
				
		}else{
			$this->session->set_userdata("pesan_error","Username / password salah...!");
				redirect("Auth");
		}
	}



	// ##### FUNGSI LOGOUT ##### //
	public function logout(){

  	$this->session->unset_userdata("id_user");
  	$this->session->unset_userdata("username");
  	$this->session->unset_userdata("level");
  	$this->session->unset_userdata("is_login");
  	$this->session->sess_destroy();
  	$this->session->set_userdata("pesan_sukses","Berhasil Logout..");
  	redirect("Auth");
  }
}
