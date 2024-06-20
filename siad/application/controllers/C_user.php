<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_user extends CI_Controller {

	public function __construct(){
		parent::__construct();
          if ($this->session->userdata('is_login') != "true") {
                $this->session->set_userdata("pesan_error","Silahkan login terlebih dahulu!");
                redirect(base_url("Auth"));
            }
		$this->load->Model("M_siakad");
		$this->data = array();
	}

	public function index()
	{
		$this->data['title']	= "Management User";
		$this->data['Data_user']  = $this->M_siakad->getData('tbl_users','*');
		$this->load->view('template/header',$this->data);
		$this->load->view('template/navbar');
		$this->load->view('template/sidebar');
		$this->load->view('user/v_user',$this->data);
		$this->load->view('template/footer');


	}

    public function add(){
         // id user
        $data   = $this->M_siakad->dataTerakhir('tbl_users','id_user');
        $user  = $this->M_siakad->getData('tbl_users', 'MAX(RIGHT(id_user,4)) AS last');
        $lastId = array('last' => $user[0]['last']);
        $last   = intval(implode("", $lastId));
        $kode   = "";
        $baru   = 1;
         if ($data->num_rows() > 0) {
            $baru   = $last + 1;
            $kode   = str_pad($baru, 4, "0", STR_PAD_LEFT);
        }
        $this->data['id_user']    = 'U' . $kode;
        $this->data['title']  = "Tambah User";
        $this->load->view('template/header',$this->data);
        $this->load->view('template/navbar');
        $this->load->view('template/sidebar');
        $this->load->view('user/v_add_user',$this->data);
        $this->load->view('template/footer');
   
    }

	public function proses_add(){
		$id_user 			= $this->input->post("id_user");
		$username		    = htmlspecialchars(strtolower($this->input->post("username")));
		$password			= $this->input->post("password");
		

		$cek_ = $this->M_siakad->cekId('tbl_users',"WHERE username = '$username'");
        if ($cek_ > 0) {
            $this->session->set_userdata("pesan_error","Username sudah terdaftar ...");
                redirect('C_user');
                exit;
        }

        $tambah_data_user = array(
            'id_user' 		=> $id_user, 
            'username'   	=> $username,
            'password'		=> password_hash($password, PASSWORD_DEFAULT)
        );

        $res = $this->M_siakad->addData('tbl_users', $tambah_data_user);
        if ($res >= 1) {
            $this->session->set_userdata("pesan_sukses","Data user berhasil disimpan ...");
            redirect('C_user');
        }else{
            $this->session->set_userdata("pesan_error","Data user gagal disimpan ...");
            redirect('C_user');
        }		
	}

	public function edit($id_user){
        $this->data['title']  = "Edit User";
        $this->data['Data_user'] = $this->M_siakad->getData('tbl_users','*',"WHERE id_user = '$id_user'");
        $this->load->view('template/header',$this->data);
        $this->load->view('template/navbar');
        $this->load->view('template/sidebar');
        $this->load->view('user/v_edit_user',$this->data);
        $this->load->view('template/footer');

	}

    public function proses_edit(){
        $id_user            = $this->input->post("id_user");
        $username           = htmlspecialchars(strtolower($this->input->post("username")));
        $password           = $this->input->post("password");

         if (!isset($id_user) || trim($id_user) == '') 
        {
            $this->session->set_userdata("pesan_error","Data user gagal diedit ...");
            redirect('C_user/edit/' . $id_user);
        } else {
            $password_lama = $this->M_siakad->getData('tbl_users','password',"WHERE id_user = '$id_user'");

            if ($password == '' || $password == null) {
                $password_baru = $password_lama[0]['password'];
            }else{
                $password_baru = password_hash($password, PASSWORD_DEFAULT);
            }
            
            $update_data_user = array(
                'username'          => $username,
                'password'     => $password_baru
            );

          
            $where1  = array('id_user' => $id_user);
            $res1    = $this->M_siakad->UpdateData('tbl_users', $update_data_user, $where1);    
            if ($res1 >= 1) {
                $this->session->set_userdata("pesan_sukses","Data user berhasil diedit ...");
                redirect('C_user');
            }else{
                $this->session->set_userdata("pesan_error","Data user gagal diedit ...");
                redirect('C_user/edit/' . $id_user);
            }
        }
    }

	public function delete($id_user){
        $where = array('id_user' => $id_user);
        $res = $this->M_siakad->HapusData('tbl_users', $where);
        if ($res >= 1) {
            $this->session->set_userdata("pesan_sukses","Data user berhasil dihapus ...");
            redirect('C_user');
        }else{
            $this->session->set_userdata("pesan_error","Data user gagal dihapus ...");
            redirect('C_user');
        }
	}


}
