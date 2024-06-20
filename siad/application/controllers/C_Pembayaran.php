<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_Pembayaran extends CI_Controller {

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
		$this->data['title']	= "Pembayaran";
		$this->data['Data_jenis_pembayaran']  = $this->M_siakad->getData('tbl_jenis_pembayaran','*');
		$this->load->view('template/header',$this->data);
		$this->load->view('template/navbar');
		$this->load->view('template/sidebar');
		$this->load->view('pembayaran/v_pembayaran',$this->data);
		$this->load->view('template/footer');


	}

	public function ambil_data_nominal(){
        $kode_jenis_pembayaran = $_POST['kode_jenis_pembayaran'];
        $data = $this->M_siakad->getData('tbl_jenis_pembayaran', 'nominal'," WHERE kode_jenis_pembayaran = '$kode_jenis_pembayaran'");
        $data_nominal = array();

        $nominal = $data[0]['nominal'];
            $data_nominal = array(
            	'nominal' => $nominal
            );
 

        echo json_encode($data_nominal);

    }

    public function ambil_data_siswa(){
        $cnis = $_POST['cnis'];
        $data = $this->M_siakad->getData('tbl_siswa', '*'," JOIN tbl_kelas ON tbl_siswa.id_kelas = tbl_kelas.id_kelas WHERE tbl_siswa.nis = '$cnis'");
        $data_siswa = array();

            $data_siswa = array(
            	'nis' => $data[0]['nis'],
            	'nama_lengkap' => $data[0]['nama_lengkap'],
            	'nama_kelas' => $data[0]['nama_kelas'],
            	'tahun_ajaran' => $data[0]['tahun_ajaran']
            );
 

        echo json_encode($data_siswa);

    }


    public function pembayaran(){

        $data           = $this->M_siakad->dataTerakhir('tbl_pembayaran','kode_jenis_pembayaran');
        $pembayaran     = $this->M_siakad->getData('tbl_pembayaran', 'MAX(RIGHT(kode_pembayaran,4)) AS last');
        $lastId         = array('last' => $pembayaran[0]['last']);
        $last           = intval(implode("", $lastId));
        $kode           = "";
        $baru           = 1;
         if ($data->num_rows() > 0) {
            $baru   = $last + 1;
            $kode   = str_pad($baru, 4, "0", STR_PAD_LEFT);
        }

        $kode_pembayaran        = date('dmy').$kode;
        $nis                    = htmlspecialchars($this->input->post('nis'));
        $nama_lengkap           = htmlspecialchars($this->input->post('nama_lengkap'));
        $kelas                  = htmlspecialchars($this->input->post('kelas'));
        $tgl_pembayaran         = $this->input->post('tgl_pembayaran');
        $kode_jenis_pembayaran  = $this->input->post('kode_jenis_pembayaran');
        $tahun_ajaran                  = $this->input->post('tahun_ajaran');
        $bln_pembayaran         = $this->input->post('bln_pembayaran');
        $nominal                = str_replace('.','',$this->input->post('nominal'));
        
         $transaksi_pembayaran = array(
            'kode_pembayaran'   => $kode_pembayaran,
            'tgl_pembayaran'    => $tgl_pembayaran,
            'bln_pembayaran'    => $bln_pembayaran,
            'kode_jenis_pembayaran'     => $kode_jenis_pembayaran,
            'nis'             => $nis,
            'tahun_ajaran'             => $tahun_ajaran,
            'nominal'          => $nominal 
        );

        $this->db->trans_begin();
        $this->db->insert('tbl_pembayaran',$transaksi_pembayaran);
        if ($this->db->trans_status() !== TRUE){
            $this->db->trans_rollback();
            $Arr_Return     = array(
                'status'    => 2,
                'pesan'     => 'Proses pembayaran gagal. Silahkan coba kembali...'
        );
            $this->session->set_userdata('notif_gagal', 'Proses pembayaran gagal.Silahkan coba kembali...');
        }else{
            $this->db->trans_commit();
            $Arr_Return     = array(
                
                'kode_pembayaran' => $kode_pembayaran,
                'status'    => 1,
                'pesan'     => 'Proses pembayaran sukses...'
            );
            $this->session->set_userdata('notif_sukses', 'Proses pembayaran sukses...');
        }

        echo json_encode($Arr_Return);
    }

    public function print_pembayaran(){
        $kode_pembayaran = $this->uri->segment(3);
        $this->data['title']        = 'Print pembayaran';
        $this->data['nama_sekolah'] = 'SMK PANCA KARYA SENTUL';
        $this->data['logo']         =  base_url('assets/img/logo-sekolah.png');
        $this->data['alamat']       = 'Jl.Desa Sanja Rt 06 Rw 06, Karang Asem Barat, Kec.Citeureup, Kab.Bogor Jawa Barat';
        $this->data['kode_pembayaran'] = $kode_pembayaran;
        $this->data['pembayaran_siswa'] = $this->M_siakad->getData('tbl_siswa','*',"JOIN tbl_kelas ON tbl_siswa.id_kelas = tbl_kelas.id_kelas JOIN tbl_pembayaran ON tbl_siswa.nis = tbl_pembayaran.nis JOIN tbl_jenis_pembayaran ON tbl_pembayaran.kode_jenis_pembayaran = tbl_jenis_pembayaran.kode_jenis_pembayaran WHERE tbl_pembayaran.kode_pembayaran = '$kode_pembayaran'");

        require_once __DIR__ .'/../third_party/vendor/autoload.php';
        $mpdf = new \Mpdf\Mpdf([
                    'mode' => 'utf-8', 
                    'format' => [210,150]
        ]);
        $html = $this->load->view("pembayaran/v_print_pembayaran",$this->data,true);
        $mpdf->WriteHTML($html);
        $mpdf->Output("bukti_pembayaran".$kode_pembayaran.".pdf" ,'I');

        // $this->load->view('pembayaran/v_print_pembayaran',$this->data);
    }
}
