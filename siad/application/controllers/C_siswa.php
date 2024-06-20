<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_siswa extends CI_Controller {

	public function __construct(){
		parent::__construct();
          if ($this->session->userdata('is_login') != "true") {
                $this->session->set_userdata("pesan_error","Silahkan login terlebih dahulu!");
                redirect(base_url("Auth"));
            }
		$this->load->Model("M_siakad");
		$data	= [];
	}

	public function index()
	{
		$data['title']	= "Data Siswa";
		$data['Data_siswa']  = $this->M_siakad->getData('tbl_siswa','*',"JOIN tbl_kelas ON tbl_siswa.id_kelas = tbl_kelas.id_kelas");
		$this->load->view('template/header',$data);
		$this->load->view('template/navbar');
		$this->load->view('template/sidebar');
		$this->load->view('siswa/v_siswa',$data);
		$this->load->view('template/footer');


	}

    public function add(){
        $data['title']          = "Tambah Siswa";
        $data['kelas']          = $this->M_siakad->getData('tbl_kelas','*');
        $this->load->view('template/header',$data);
        $this->load->view('template/navbar');
        $this->load->view('template/sidebar');
        $this->load->view('siswa/v_add_siswa',$data);
        $this->load->view('template/footer');
   
    }

	public function proses_add(){
		$nis                            = $this->input->post("nis");
        $nisn                           = $this->input->post("nisn");
		$nama_lengkap	                = htmlspecialchars(strtolower($this->input->post("nama_lengkap")));
        $id_kelas                       = $this->input->post("id_kelas");
        $semester                       = $this->input->post("semester");
		$tahun_ajaran				    = $this->input->post("tahun_ajaran");
		
		$cek_ = $this->M_siakad->cekId('tbl_siswa',"WHERE nis = '$nis'");
        if ($cek_ > 0) {
            $this->session->set_userdata("pesan_error","Data siswa sudah terdaftar ...");
                redirect('C_siswa');
                exit;
        }

        

            $tambah_data_siswa = array(
                'nis'    		    => $nis, 
                'nisn'    	        => $nisn,
                'nama_lengkap'      => $nama_lengkap, 
                'semester'          => $semester,
                'tahun_ajaran'      => $tahun_ajaran,
                'id_kelas'          => $id_kelas
            );

            $res = $this->M_siakad->addData('tbl_siswa', $tambah_data_siswa);
            if ($res >= 1) {
                $this->session->set_userdata("pesan_sukses","Data siswa berhasil disimpan ...");
                redirect('C_siswa');
            }else{
                  $this->session->set_userdata("pesan_error","Data siswa gagal disimpan ...");
                redirect('C_siswa');
            }


		
	}

	public function edit($nis){
        $data['title']  = "Edit Siswa";
        $data['Data_siswa'] = $this->M_siakad->getData('tbl_siswa','*',"WHERE nis = '$nis'");
        $data['Data_kelas'] = $this->M_siakad->getData('tbl_kelas','*');
        $this->load->view('template/header',$data);
        $this->load->view('template/navbar');
        $this->load->view('template/sidebar');
        $this->load->view('siswa/v_edit_siswa',$data);
        $this->load->view('template/footer');

	}

    public function proses_edit($nis){
        $nis                            = $this->input->post("nis");
        $nisn                           = $this->input->post("nisn");
        $nama_lengkap                   = htmlspecialchars(strtolower($this->input->post("nama_lengkap")));
        $id_kelas                       = $this->input->post("id_kelas");
        $semester                       = $this->input->post("semester");
        $tahun_ajaran                   = $this->input->post("tahun_ajaran");

         if (!isset($nis) || trim($nis) == '') 
        {
            $this->session->set_userdata("pesan_error","Data siswa gagal diedit ...");
            redirect('C_siswa/edit/' . $nis);
        } else {
            
            $update_data_siswa = array(
                'nis'               => $nis, 
                'nisn'              => $nisn,
                'nama_lengkap'      => $nama_lengkap, 
                'semester'          => $semester,
                'tahun_ajaran'      => $tahun_ajaran,
                'id_kelas'          => $id_kelas

            );
            $where1  = array('nis' => $nis);
            $res1    = $this->M_siakad->UpdateData('tbl_siswa', $update_data_siswa, $where1);
            if ($res1 >= 1) {
                $this->session->set_userdata("pesan_sukses","Data siswa berhasil diedit ...");
                redirect('C_siswa');
            }else{
                $this->session->set_userdata("pesan_error","Data siswa gagal diedit ...");
                redirect('C_siswa/edit/' . $id_bayi);
            }
        }
    }

    public function detail($nis){
        $data['title']  = "Detail Siswa";
        $data['Data_siswa'] = $this->M_siakad->getData('tbl_siswa','*',"JOIN tbl_kelas ON tbl_siswa.id_kelas = tbl_kelas.id_kelas WHERE nis='$nis'"); 
        $this->load->view('template/header',$data);
        $this->load->view('template/navbar');
        $this->load->view('template/sidebar');
        $this->load->view('siswa/v_detail_siswa',$data);
        $this->load->view('template/footer');
        
    }

	public function delete($nis){
        $where = array('nis' => $nis);
        $res = $this->M_siakad->HapusData('tbl_siswa', $where);
        if ($res >= 1) {
            $this->session->set_userdata("pesan_sukses","Data siswa berhasil di hapus ...");
            redirect('C_siswa');
        }else{
            $this->session->set_userdata("pesan_error","Data siswa gagal di hapus !");
            redirect('C_siswa');
        }
	}


}
