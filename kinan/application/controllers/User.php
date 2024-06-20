<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

    public function __construct() {
        parent::__construct();
        if ($this->session->userdata('status') != "login") {
            $this->session->set_userdata("notif_gagal","Silahkan login terlebih dahulu!");
            redirect(base_url("Welcome"));
        }
        $this->load->model('ModelPosyandu');
        $this->data = array();    
    }

    public function index() {
        $this->data['title']    = 'USERS';
        $this->data['user']     = $this->ModelPosyandu->getData('user', '*');
        $this->load->view('template/header',$this->data);
        $this->load->view('template/sidebar');
        $this->load->view('user/v_user');
        $this->load->view('template/footer');
    }

    public function add() {
        $this->data['title'] = 'FORM TAMBAH USER';
        $this->load->view('template/header',$this->data);
        $this->load->view('template/sidebar');
        $this->load->view('user/v_add');
        $this->load->view('template/footer');
    }
    public function processAdd() {
        $data   = $this->ModelPosyandu->dataTerakhir('user','id_user');
        $user   = $this->ModelPosyandu->getData('user', 'MAX(RIGHT(id_user,3)) AS last');
        $lastId = array('last' => $user[0]['last']);
        $last   = implode("", $lastId);
        $kode   = "";
        $baru   = 1;

        if ($data->num_rows() > 0) {
            $baru = $last + 1;
            $kode = str_pad($baru, 4, "0", STR_PAD_LEFT);
        }

        $nama_lengkap   = $_POST['nama_lengkap'];
        $username       = $_POST['username'];
        $password       = $_POST['password'];
        $level          = $_POST['level'];

        if (!isset($nama_lengkap) || trim($nama_lengkap) == '' || !isset($username) || trim($username) == '' || !isset($password) || trim($password) == '') {
            $id_user = NULL;
        } else {
            $id_user = 'USER' . $kode;
        }

        if ($id_user == NULL) {
            $this->session->set_userdata("notif_gagal","Data user gagal di daftarkan !");
            redirect('User/add');
        } else {
            $tambah_data = array(
                'id_user'        => $id_user,
                'nama_lengkap'  => $nama_lengkap, 
                'username'  => $username,
                'password'  => sha1(md5($password)), 
                'level'     => $level
            );
            $res = $this->ModelPosyandu->addData('user', $tambah_data);
            if ($res >= 1) {
                $this->session->set_userdata("notif_sukses","Data user berhasil di daftarkan ...");
                redirect('User');
            }
        }
    }

  
    public function detail($idUser) {
            $data['data_user'] = $this->ModelPosyandu->getData('user', '*',"WHERE id_user = '$idUser'");
            $this->data['title'] = 'DETAIL USER';
            $this->load->view('template/header',$this->data);
            $this->load->view('template/sidebar');
            $this->load->view('user/v_detail',$data);
            $this->load->view('template/footer');
    }

    public function edit($idUser) {
         $data['data_user'] = $this->ModelPosyandu->getData('user', '*',"WHERE id_user = '$idUser'");
            $this->data['title'] = 'FORM EDIT USER';
            $this->load->view('template/header',$this->data);
            $this->load->view('template/sidebar');
            $this->load->view('user/v_edit',$data);
            $this->load->view('template/footer');
    }

    public function doUpdate() {
        $idUser         = $_POST['idUser'];
        $nama_lengkap   = $_POST['nama_lengkap'];
        $username       = $_POST['username'];
        $password       = $_POST['password'];
        $level          = $_POST['level'];
        if (
            !isset($username) || trim($username) == '' ||
            !isset($nama_lengkap) || trim($nama_lengkap) == ''
        ) 
        {
            $this->session->set_userdata("notif_gagal","Data user gagal di perbarui ...");
            redirect('User/edit/' . $idUser);
        } else {

            if ($password == '') {
                $update_data = array(
                    'nama_lengkap'  => $nama_lengkap,
                    'username'      => $username,
                    'level'         => $level
                );
            }else{
                $update_data = array(
                    'nama_lengkap'  => $nama_lengkap,
                    'username'      => $username,
                    'password'      => sha1(md5($password)),
                    'level'         => $level
                );
            }
       

            

            $where  = array('id_user' => $idUser);
            $res    = $this->ModelPosyandu->UpdateData('user', $update_data, $where);
            if ($res >= 1) {
                $this->session->set_userdata("notif_sukses","Data user berhasil di perbarui ...");
                redirect('User');
            }
        }
    }

    public function delete($idUser) {
        $where = array('id_user' => $idUser);
        $res = $this->ModelPosyandu->HapusData('user', $where);
        if ($res >= 1) {
            $this->session->set_userdata("notif_sukses","Data user berhasil di hapus ...");
            redirect('User');
        }else{
            $this->session->set_userdata("notif_gagal","Data user gagal di hapus !");
            redirect('User');
        }
    }

}
