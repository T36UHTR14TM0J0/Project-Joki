<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('status') != "login") {
            $this->session->set_userdata("notif_gagal","Silahkan login terlebih dahulu!");
            redirect(base_url("Login"));
        }
        $this->load->model('ModelPosyandu');
        $this->data = array();
    }

	public function index() {
		 $this->data['title']               = 'Beranda';
         $this->data['pasien']              = $this->ModelPosyandu->getData('pasien', '*');
        $this->data['transaksi_obat']       = $this->ModelPosyandu->getData('transaksi_obat', '*');
        $this->data['transaksi_periksa']    = $this->ModelPosyandu->getData('transaksi_periksa', '*');
         $this->data['umum']                = $this->ModelPosyandu->getData('umum', '*');
        $this->data['bayi']                 = $this->ModelPosyandu->getData('bayi', '*');
        $this->data['bumil']                = $this->ModelPosyandu->getData('ibu_hamil', '*');
        $this->data['kb']                   = $this->ModelPosyandu->getData('kb', '*');
        $this->data["jml_bayi"]             = count($this->data['bayi']);
        $this->data["jml_bumil"]            = count($this->data['bumil']);
        $this->data["jml_kb"]               = count($this->data['kb']);
        $this->data["jml_pasien"]           = count($this->data['pasien']);
        $this->data["jml_umum"]             = count($this->data['umum']);
        $this->data["jml_transaksi_obat"]   = count($this->data['transaksi_obat']);
        $this->data["jml_transaksi_periksa"] = count($this->data['transaksi_periksa']);
        $this->load->view('template/header',$this->data);
        $this->load->view('template/sidebar');
        $this->load->view('home');
        $this->load->view('template/footer');	
	}
}
