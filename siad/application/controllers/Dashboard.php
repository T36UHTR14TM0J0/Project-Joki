<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	public function __construct(){
		parent::__construct();
          if ($this->session->userdata('is_login') != "true") {
                $this->session->set_userdata("pesan_error","Silahkan login terlebih dahulu!");
                redirect(base_url("Auth"));
            }
		$this->load->Model("M_siakad");
        $this->load->helper('convert_uang');
		$this->data = array();
	}

	public function index()
	{
		$this->data['title']	= "Dashboard";
		$jml_siswa = $this->M_siakad->getData('tbl_siswa','*');
		$this->data['jml_siswa'] = count($jml_siswa);
		$data_pembayaran = $this->M_siakad->getData('tbl_pembayaran','*');
		$jml_pembayaran = 0;
		foreach ($data_pembayaran as $dp) {
			$jml_pembayaran += $dp['nominal'];
		}
		$this->data['jml_pembayaran'] = $jml_pembayaran;
		$this->load->view('template/header',$this->data);
		$this->load->view('template/navbar');
		$this->load->view('template/sidebar');
		$this->load->view('v_dashboard',$this->data);
		$this->load->view('template/footer');


	}
}
