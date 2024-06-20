<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_kelas extends CI_Controller {

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
		$this->data['title']	= "kelas";
		$this->data['Data_kelas']  = $this->M_siakad->getData('tbl_kelas','*');
		$this->load->view('template/header',$this->data);
		$this->load->view('template/navbar');
		$this->load->view('template/sidebar');
		$this->load->view('kelas/v_kelas',$this->data);
		$this->load->view('template/footer');


	}

    public function add(){
         // id kelas
        $data   = $this->M_siakad->dataTerakhir('tbl_kelas','id_kelas');
        $kelas  = $this->M_siakad->getData('tbl_kelas', 'MAX(RIGHT(id_kelas,4)) AS last');
        $lastId = array('last' => $kelas[0]['last']);
        $last   = intval(implode("", $lastId));
        $kode   = "";
        $baru   = 1;
         if ($data->num_rows() > 0) {
            $baru   = $last + 1;
            $kode   = str_pad($baru, 4, "0", STR_PAD_LEFT);
        }
        $this->data['id_kelas']    = 'K' . $kode;
        $this->data['title']  = "Tambah Kelas";
        $this->load->view('template/header',$this->data);
        $this->load->view('template/navbar');
        $this->load->view('template/sidebar');
        $this->load->view('kelas/v_add_kelas',$this->data);
        $this->load->view('template/footer');
   
    }

	public function proses_add(){
		$id_kelas 			= $this->input->post("id_kelas");
		$nama_kelas		    = htmlspecialchars(strtolower($this->input->post("nama_kelas")));
		$jml_siswa			= $this->input->post("jml_siswa");
		

		$cek_ = $this->M_siakad->cekId('tbl_kelas',"WHERE id_kelas = '$id_kelas'");
        if ($cek_ > 0) {
            $this->session->set_userdata("pesan_error","Data kelas sudah terdaftar ...");
                redirect('C_kelas');
                exit;
        }

        $tambah_data_kelas = array(
            'id_kelas' 		=> $id_kelas, 
            'nama_kelas'   	=> $nama_kelas,
            'jml_siswa'		=> $jml_siswa
        );

        $res = $this->M_siakad->addData('tbl_kelas', $tambah_data_kelas);
        if ($res >= 1) {
            $this->session->set_userdata("pesan_sukses","Data kelas berhasil disimpan ...");
            redirect('C_kelas');
        }else{
            $this->session->set_userdata("pesan_error","Data kelas gagal disimpan ...");
            redirect('C_kelas');
        }		
	}

	public function edit($id_kelas){
        $this->data['title']  = "Edit Kelas";
        $this->data['Data_kelas'] = $this->M_siakad->getData('tbl_kelas','*',"WHERE id_kelas = '$id_kelas'");
        $this->load->view('template/header',$this->data);
        $this->load->view('template/navbar');
        $this->load->view('template/sidebar');
        $this->load->view('kelas/v_edit_kelas',$this->data);
        $this->load->view('template/footer');

	}

    public function proses_edit(){
        $id_kelas           = $this->input->post("id_kelas");
        $nama_kelas         = htmlspecialchars(strtolower($this->input->post("nama_kelas")));
        $jml_siswa          = $this->input->post("jml_siswa");

         if (!isset($id_kelas) || trim($id_kelas) == '') 
        {
            $this->session->set_userdata("pesan_error","Data kelas gagal diedit ...");
            redirect('C_kelas/edit/' . $id_kelas);
        } else {
            
            $update_data_kelas = array(
                'id_kelas'      => $id_kelas, 
                'nama_kelas'    => $nama_kelas,
                'jml_siswa'     => $jml_siswa
            );

          
            $where1  = array('id_kelas' => $id_kelas);
            $res1    = $this->M_siakad->UpdateData('tbl_kelas', $update_data_kelas, $where1);    
            if ($res1 >= 1) {
                $this->session->set_userdata("pesan_sukses","Data kelas berhasil diedit ...");
                redirect('C_kelas');
            }else{
                $this->session->set_userdata("pesan_error","Data kelas gagal diedit ...");
                redirect('C_kelas/edit/' . $kelas);
            }
        }
    }

    public function detail($id_kelas){
        $this->data['title']  = "Detail Kelas";
        $this->data['Data_kelas'] = $this->M_siakad->getData('tbl_kelas','*',"WHERE id_kelas = '$id_kelas'");
        $this->load->view('template/header',$this->data);
        $this->load->view('template/navbar');
        $this->load->view('template/sidebar');
        $this->load->view('kelas/v_detail_kelas',$this->data);
        $this->load->view('template/footer');
        
    }

	public function delete($id_kelas){
        $where = array('id_kelas' => $id_kelas);
        $res = $this->M_siakad->HapusData('tbl_kelas', $where);
        if ($res >= 1) {
            $this->session->set_userdata("pesan_sukses","Data kelas berhasil dihapus ...");
            redirect('C_kelas');
        }else{
            $this->session->set_userdata("pesan_error","Data kelas gagal dihapus ...");
            redirect('C_kelas');
        }
	}


}
