<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_laporan extends CI_Controller {

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

	public function index(){
		$this->data['title']	= "Laporan";
		$this->data['jenis_pembayaran'] = $this->M_siakad->getData('tbl_jenis_pembayaran','*');
		$tgl_awal = $this->input->post('tgl_awal');
        $tgl_akhir = $this->input->post('tgl_akhir');
        $kode_jenis_pembayaran = $this->input->post('jenis_pembayaran');
        $this->data['data_laporan']  = $this->M_siakad->getData('tbl_pembayaran','*',"JOIN tbl_siswa ON tbl_pembayaran.nis = tbl_siswa.nis JOIN tbl_jenis_pembayaran ON tbl_pembayaran.kode_jenis_pembayaran = tbl_jenis_pembayaran.kode_jenis_pembayaran");
        if ($tgl_awal != null && $tgl_akhir != null && $kode_jenis_pembayaran != null) {
        	
        		$this->data['data_laporan']  = $this->M_siakad->getData('tbl_pembayaran','*',"JOIN tbl_siswa ON tbl_pembayaran.nis = tbl_siswa.nis JOIN tbl_jenis_pembayaran ON tbl_pembayaran.kode_jenis_pembayaran = tbl_jenis_pembayaran.kode_jenis_pembayaran WHERE tbl_pembayaran.kode_jenis_pembayaran = '$kode_jenis_pembayaran' AND tbl_pembayaran.tgl_pembayaran BETWEEN '$tgl_awal' AND '$tgl_akhir'");
        	
        }

        if ($tgl_awal != null && $tgl_akhir != null && $kode_jenis_pembayaran == '') {
        	$this->data['data_laporan']  = $this->M_siakad->getData('tbl_pembayaran','*',"JOIN tbl_siswa ON tbl_pembayaran.nis = tbl_siswa.nis JOIN tbl_jenis_pembayaran ON tbl_pembayaran.kode_jenis_pembayaran = tbl_jenis_pembayaran.kode_jenis_pembayaran WHERE tbl_pembayaran.tgl_pembayaran BETWEEN '$tgl_awal' AND '$tgl_akhir'");
        }
        	
        
		
		$this->load->view('template/header',$this->data);
		$this->load->view('template/navbar');
		$this->load->view('template/sidebar');
		$this->load->view('laporan/v_laporan',$this->data);
		$this->load->view('template/footer');
	}

	public function cetak(){
		$this->data['title']            ='cetak laporan';
        $this->data['tanggal_awal']     = $this->input->get('tgl_awal');
        $this->data['tanggal_akhir']    = $this->input->get('tgl_akhir');
        $this->data['kode_jenis_pembayaran'] = $this->input->get('kode_jenis_pembayaran');
        $this->data['tanggal_cetak']    = date('d-m-Y');
        $this->data['nama_sekolah'] = 'SMK PANCA KARYA SENTUL';
        $this->data['logo']         =  base_url('assets/img/logo-sekolah.png');
        $this->data['alamat']       = 'Jl.Desa Sanja Rt 06 Rw 06, Karang Asem Barat, Kec.Citeureup, Kab.Bogor Jawa Barat';
        $tgl_awal                       = $this->data['tanggal_awal'];
        $tgl_akhir                      = $this->data['tanggal_akhir'];
        $kode_jenis_pembayaran			= $this->data['kode_jenis_pembayaran'];
        $this->data['nama_pencetak']    = $this->session->userdata['username'];
        $this->data['data_laporan']  = $this->M_siakad->getData('tbl_pembayaran','*',"JOIN tbl_siswa ON tbl_pembayaran.nis = tbl_siswa.nis JOIN tbl_jenis_pembayaran ON tbl_pembayaran.kode_jenis_pembayaran = tbl_jenis_pembayaran.kode_jenis_pembayaran ");
        if ($tgl_awal != null && $tgl_akhir != null && $kode_jenis_pembayaran != null) {
        	
        		$this->data['data_laporan']  = $this->M_siakad->getData('tbl_pembayaran','*',"JOIN tbl_siswa ON tbl_pembayaran.nis = tbl_siswa.nis JOIN tbl_jenis_pembayaran ON tbl_pembayaran.kode_jenis_pembayaran = tbl_jenis_pembayaran.kode_jenis_pembayaran WHERE tbl_pembayaran.kode_jenis_pembayaran = '$kode_jenis_pembayaran' AND tbl_pembayaran.tgl_pembayaran BETWEEN '$tgl_awal' AND '$tgl_akhir'");
        	
        }
        if ($tgl_awal != null && $tgl_akhir != null && $kode_jenis_pembayaran == '') {
        	$this->data['data_laporan']  = $this->M_siakad->getData('tbl_pembayaran','*',"JOIN tbl_siswa ON tbl_pembayaran.nis = tbl_siswa.nis JOIN tbl_jenis_pembayaran ON tbl_pembayaran.kode_jenis_pembayaran = tbl_jenis_pembayaran.kode_jenis_pembayaran WHERE tbl_pembayaran.tgl_pembayaran BETWEEN '$tgl_awal' AND '$tgl_akhir'");
        }

        require_once __DIR__ .'/../third_party/vendor/autoload.php';
        $mpdf = new \Mpdf\Mpdf([
                    'mode' => 'utf-8', 
                    'format' => 'A4'
        ]);
        $html = $this->load->view("laporan/cetak_laporan",$this->data,true);
        $mpdf->WriteHTML($html);
        $mpdf->Output("laporan_pembayaran-".$tgl_awal.'-'.$tgl_akhir.".pdf" ,'I');
	}
}
