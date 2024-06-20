<?php

defined('BASEPATH') OR exit('No direct script access allowed');
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Laporan_pengguna extends CI_Controller {

    public function __construct() {
        parent::__construct();
        if ($this->session->userdata('status') != "login") {
            $this->session->set_userdata("notif_gagal","Silahkan login terlebih dahulu!");
            redirect(base_url("Welcome"));
        }
        $this->data = array();
        $this->load->model('ModelPosyandu');
    }

    public function index() {
      
        $laporan = $this->ModelPosyandu->getData('user', '*'); 
        // 
        $this->data['title'] = 'LAPORAN';
        $this->load->view('template/header',$this->data);
        $this->load->view('template/sidebar');
        $this->load->view('laporan_pengguna/v_laporan_pengguna', array('laporan' => $laporan));
        $this->load->view('template/footer');
    }

    function cetak(){

            $this->data['title']            ='Laporan data pengguna';
            $this->data['tanggal_cetak']    = date('d-m-Y');
            $this->data['logo']             = base_url('assets/images/logo-ulfi.png');
            $this->data['logo_ibi']         = base_url('assets/images/logo-ibi.png');
            $this->data['row_pengguna']      = $this->ModelPosyandu->getData('user','*');
            $this->data['nama_pencetak']    = $this->session->userdata['nama_lengkap'];
            // $this->load->view('laporan_pasien/cetak_pasien',$this->data);
            $tanggal_cetak = $this->data['tanggal_cetak'];

            require_once __DIR__ .'/../third_party/vendor/autoload.php';
            $mpdf = new \Mpdf\Mpdf([
                    'mode' => 'utf-8',
                    'format' => 'A4'
            ]);
            $html = $this->load->view("laporan_pengguna/cetak_pengguna",$this->data,true);
            $mpdf->setDisplayMode('fullpage');
            $mpdf->WriteHTML($html);
            $mpdf->Output("Laporan_data_pengguna_".$tanggal_cetak.".pdf" ,'I');
            
          
    }

   


}
