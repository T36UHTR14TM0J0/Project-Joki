<?php

defined('BASEPATH') OR exit('No direct script access allowed');
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Laporan_obat extends CI_Controller {

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
       
       
        $laporan = $this->ModelPosyandu->getData('obat', '*');  
        $this->data['title'] = 'LAPORAN OBAT';
        $this->load->view('template/header',$this->data);
        $this->load->view('template/sidebar');
        $this->load->view('laporan_obat/v_laporan', array('laporan' => $laporan));
        $this->load->view('template/footer');
    }

    function cetak(){
            $this->data['title'] = "Laporan Obat";
            $this->data['tanggal_cetak'] = date('d-m-Y');
            $this->data['logo']         = base_url('assets/images/logo-ulfi.png');
            $this->data['logo_ibi']         = base_url('assets/images/logo-ibi.png');
            $this->data['nama_pencetak']    = $this->session->userdata['nama_lengkap'];
            $this->data['row_obat'] = $this->ModelPosyandu->getData('obat','*');//MENAMPILKAN DATA LAPORAN DARI TBL_TRANSAKSI 
            // $this->load->view('laporan_obat/cetak_obat',$this->data);

            require_once __DIR__ .'/../third_party/vendor/autoload.php';
            $mpdf = new \Mpdf\Mpdf([
                    'mode' => 'utf-8'
            ]);
            $html = $this->load->view("laporan_obat/cetak_obat",$this->data,true);
            $mpdf->WriteHTML($html);
            $mpdf->Output("Laporan_obat_".$this->data['tanggal_cetak'].".pdf" ,'I');
         
    }

   


}
