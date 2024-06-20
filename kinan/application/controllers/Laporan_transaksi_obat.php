<?php

defined('BASEPATH') OR exit('No direct script access allowed');
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Laporan_transaksi_obat extends CI_Controller {

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
        // $status = $this->input->post('status');
        $tgl_awal = $this->input->post('tgl_awal');
        $tgl_akhir = $this->input->post('tgl_akhir');
        
        if( isset($tgl_awal) && isset($tgl_akhir)){
            // 
             $laporan = $this->ModelPosyandu->getData('transaksi_obat', '*',"WHERE tgl_transaksi BETWEEN '$tgl_awal' AND '$tgl_akhir'");
        }else{
           $laporan = $this->ModelPosyandu->getData('transaksi_obat', '*'); 
        }
        // 
        $this->data['title'] = 'LAPORAN';
        $this->load->view('template/header',$this->data);
        $this->load->view('template/sidebar');
        $this->load->view('laporan_transaksi_obat/v_laporan_transaksi_obat', array('laporan' => $laporan));
        $this->load->view('template/footer');
    }

    function cetak(){
            $this->data['title']    ='Laporan obat';
            $this->data['tanggal_awal'] = $this->input->get('tgl_awal');
            $this->data['tanggal_akhir'] = $this->input->get('tgl_akhir');
            $this->data['tanggal_cetak'] = date('d-m-Y');
            $this->data['logo']         = base_url('assets/images/logo-ulfi.png');
            $this->data['logo_ibi']         = base_url('assets/images/logo-ibi.png');
            $this->data['nama_pencetak']    = $this->session->userdata['nama_lengkap'];
            $tgl_awal = $this->data['tanggal_awal'];
            $tgl_akhir = $this->data['tanggal_akhir'];
            $this->data['row_obat'] = $this->ModelPosyandu->getData('transaksi_obat','*',"WHERE tgl_transaksi BETWEEN '$tgl_awal' AND '$tgl_akhir'");//MENAMPILKAN DATA LAPORAN DARI TBL_TRANSAKSI 
            // $this->load->view('laporan_obat/cetak_obat',$this->data);

            require_once __DIR__ .'/../third_party/vendor/autoload.php';
            $mpdf = new \Mpdf\Mpdf([
                    'mode' => 'utf-8'
            ]);
            $html = $this->load->view("laporan_transaksi_obat/cetak_transaksi_obat",$this->data,true);
            $mpdf->WriteHTML($html);
            $mpdf->Output("Laporan_transaksi_obat_".$tgl_awal."-".$tgl_akhir.".pdf" ,'I');
         
    }

   


}
