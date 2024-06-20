<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_jenis_pembayaran extends CI_Controller {

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
		$this->data['title']	= "Jenis Pembayaran";
		$this->data['Data_jenis_pembayaran']  = $this->M_siakad->getData('tbl_jenis_pembayaran','*');
		$this->load->view('template/header',$this->data);
		$this->load->view('template/navbar');
		$this->load->view('template/sidebar');
		$this->load->view('jenis_pembayaran/v_jenis_pembayaran',$this->data);
		$this->load->view('template/footer');


	}

    public function add(){
         // id kelas
        $data   = $this->M_siakad->dataTerakhir('tbl_jenis_pembayaran','kode_jenis_pembayaran');
        $jenis_pembayaran  = $this->M_siakad->getData('tbl_jenis_pembayaran', 'MAX(RIGHT(kode_jenis_pembayaran,4)) AS last');
        $lastId = array('last' => $jenis_pembayaran[0]['last']);
        $last   = intval(implode("", $lastId));
        $kode   = "";
        $baru   = 1;
         if ($data->num_rows() > 0) {
            $baru   = $last + 1;
            $kode   = str_pad($baru, 4, "0", STR_PAD_LEFT);
        }
        $this->data['kode_jenis_pembayaran']    = 'KJP' . $kode;
        $this->data['title']  = "Tambah Jenis Pembayaran";
        $this->load->view('template/header',$this->data);
        $this->load->view('template/navbar');
        $this->load->view('template/sidebar');
        $this->load->view('jenis_pembayaran/v_add_jenis_pembayaran',$this->data);
        $this->load->view('template/footer');
   
    }

	public function proses_add(){
		$kode_jenis_pembayaran 	= $this->input->post("kode_jenis_pembayaran");
		$nama_pembayaran		= htmlspecialchars(strtolower($this->input->post("nama_pembayaran")));
		$nominal			    = convert_to_number($this->input->post("nominal"));
		
		

		$cek_ = $this->M_siakad->cekId('tbl_jenis_pembayaran',"WHERE kode_jenis_pembayaran = '$kode_jenis_pembayaran'");
        if ($cek_ > 0) {
            $this->session->set_userdata("pesan_error","Data jenis pembayaran gagal ...");
                redirect('C_jenis_pembayaran');
                exit;
        }

        

        $tambah_jenis_pembayaran = array(
                'kode_jenis_pembayaran'    => $kode_jenis_pembayaran, 
                'nama_pembayaran'   	   => $nama_pembayaran,
                'nominal'		           => $nominal
            );

            $res = $this->M_siakad->addData('tbl_jenis_pembayaran', $tambah_jenis_pembayaran);
            if ($res >= 1) {
                $this->session->set_userdata("pesan_sukses","Data jenis pembayaran berhasil disimpan ...");
                redirect('C_jenis_pembayaran');
            }else{
                  $this->session->set_userdata("pesan_error","Data jenis pembayaran gagal disimpan ...");
                redirect('C_jenis_pembayaran');
            }


		
	}

	public function edit($kode_jenis_pembayaran){
        $this->data['title']  = "Edit Jenis Pembayaran";
        $this->data['Data_jenis_pembayaran'] = $this->M_siakad->getData('tbl_jenis_pembayaran','*',"WHERE kode_jenis_pembayaran = '$kode_jenis_pembayaran'");
        $this->load->view('template/header',$this->data);
        $this->load->view('template/navbar');
        $this->load->view('template/sidebar');
        $this->load->view('jenis_pembayaran/v_edit_jenis_pembayaran',$this->data);
        $this->load->view('template/footer');

	}

    public function proses_edit(){
        $kode_jenis_pembayaran  = $this->input->post("kode_jenis_pembayaran");
        $nama_pembayaran        = htmlspecialchars(strtolower($this->input->post("nama_pembayaran")));
        $nominal                = convert_to_number($this->input->post("nominal"));

         if (!isset($kode_jenis_pembayaran) || trim($kode_jenis_pembayaran) == '') 
        {
            $this->session->set_userdata("pesan_error","Data jenis pembayaran gagal diedit ...");
            redirect('C_jenis_pembayaran/edit/' . $kode_jenis_pembayaran);
        } else {
            
            $edit_jenis_pembayaran = array(
                'kode_jenis_pembayaran'    => $kode_jenis_pembayaran, 
                'nama_pembayaran'          => $nama_pembayaran,
                'nominal'                  => $nominal
            );

          
            $where1  = array('kode_jenis_pembayaran' => $kode_jenis_pembayaran);
            $res1    = $this->M_siakad->UpdateData('tbl_jenis_pembayaran', $edit_jenis_pembayaran, $where1);    
            if ($res1 >= 1) {
                $this->session->set_userdata("pesan_sukses","Data jenis pembayaran berhasil diedit ...");
                redirect('C_jenis_pembayaran');
            }else{
                $this->session->set_userdata("pesan_error","Data jenis pembayaran gagal diedit ...");
                redirect('C_jenis_pembayaran/edit/' . $kode_jenis_pembayaran);
            }
        }
    }

   
	public function delete($kode_jenis_pembayaran){
        $where = array('kode_jenis_pembayaran' => $kode_jenis_pembayaran);
        $res = $this->M_siakad->HapusData('tbl_jenis_pembayaran', $where);
        if ($res >= 1) {
            $this->session->set_userdata("pesan_sukses","Data jenis pembayaran berhasil di hapus ...");
            redirect('C_jenis_pembayaran');
        }else{
            $this->session->set_userdata("pesan_error","Data jenis pembayaran gagal di hapus !");
            redirect('C_jenis_pembayaran');
        }
	}


}
