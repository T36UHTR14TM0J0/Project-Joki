<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Pasien extends CI_Controller {

    public function __construct() {
        parent::__construct();
        if ($this->session->userdata('status') != "login") {
            $this->session->set_userdata("notif_gagal","Silahkan login terlebih dahulu!");
            redirect(base_url("Welcome"));
        }
        $this->load->model('ModelPosyandu');
        $this->data = array();
    }

// ################## FUNGSI INDEX / MENAMPILKAN FILE BAYI ######################## //
    public function index() {
        $this->data['title'] = 'Data Pasien';
        $this->data['pasien'] = $this->ModelPosyandu->getData('pasien', '*','ORDER BY id_pasien DESC');
        $this->load->view('template/header',$this->data);
        $this->load->view('template/sidebar');
        $this->load->view('pasien/v_pasien');
        $this->load->view('template/footer');
    }
// ################## END FUNGSI INDEX ########################################## //

// ############ FUNGSI ADD / MENAMPILKAN FORM TAMBAH DATA BAYI ################# //
    public function add() {
        // id pasien
        $data   = $this->ModelPosyandu->dataTerakhir('pasien','id_pasien');
        $pasien = $this->ModelPosyandu->getData('pasien', 'MAX(RIGHT(id_pasien,3)) AS last');
        $lastId = array('last' => $pasien[0]['last']);
        $last   = intval(implode("", $lastId));
        $kode   = "";
        $baru   = 1;
         if ($data->num_rows() > 0) {
            $baru   = $last + 1;
            $kode   = str_pad($baru, 3, "0", STR_PAD_LEFT);
        }
        $this->data['title']        = 'Form Tambah';
        $this->data['id_pasien']    = 'PAS' . $kode;
        $this->data['data_reg']     = $this->ModelPosyandu->getData('registrasi','*',"ORDER BY id_registrasi DESC");
        $this->load->view('template/header',$this->data);
        $this->load->view('template/sidebar');
        $this->load->view('pasien/v_add');
        $this->load->view('template/footer');
    }
// ############################# END FUNGSI ADD ############################### //


// ################## FUNGSI PROSES TAMBAH ######################## //
    public function processAdd() {
       

        $id_registrasi  = $this->input->post('id_registrasi');
        $id_pasien      = $this->input->post('id_pasien');
        $nama_pasien    = htmlspecialchars($this->input->post('nama_pasien'));
        $no_ktp         = htmlspecialchars($this->input->post('no_ktp'));
        $tmpt_lahir     = htmlspecialchars($this->input->post('tmpt_lahir'));
        $tgl_lahir      = htmlspecialchars($this->input->post('tgl_lahir'));
        $umur           = $this->input->post('umur');
        $jk             = $this->input->post('jk');
        $alamat         = htmlspecialchars($this->input->post('alamat'));
        $no_tlp         = $this->input->post('no_tlp');
        $jenis_pel      = $this->input->post('jenis_pel');

        $cek_ = $this->ModelPosyandu->cekId('pasien',"WHERE no_ktp = '$no_ktp'");
        if ($cek_ > 0) {
            $this->session->set_userdata("notif_gagal","Data pasien sudah terdaftar ...");
                redirect('pasien/add');
                exit;
        }
            $tambah_data = array(
                'id_registrasi'    => $id_registrasi, 
                'id_pasien'    => $id_pasien,
                'nama_pasien'  => $nama_pasien, 
                'no_ktp'       => $no_ktp,
                'tmpt_lahir'   => $tmpt_lahir, 
                'tgl_lahir'    => $tgl_lahir,
                'umur'         => $umur, 
                'jk'           => $jk,
                'alamat'       => $alamat,
                'no_tlp'       => $no_tlp,
                'jenis_pel'    => $jenis_pel
            );
            $res = $this->ModelPosyandu->addData('pasien', $tambah_data);
            if ($res >= 1) {
                $this->session->set_userdata("notif_sukses","Data pasien berhasil disimpan ...");
                redirect('pasien');
            }else{
                  $this->session->set_userdata("notif_gagal","Data pasien gagal disimpan ...");
                redirect('pasien');
            }
    }
// ################## END FUNGSI PROSES TAMBAH ######################## //

     public function edit($id_registrasi) {
         $data['data_pasien'] = $this->ModelPosyandu->getData('pasien', '*',"WHERE id_registrasi = '$id_registrasi'");
            $this->data['title'] = 'Form Edit Pasien';
            $this->load->view('template/header',$this->data);
            $this->load->view('template/sidebar');
            $this->load->view('pasien/v_edit',$data);
            $this->load->view('template/footer');
    }

    public function doUpdate() {
        
        $id_registrasi  = $this->input->post('id_registrasi');
        $id_pasien      = $this->input->post('id_pasien');
        $nama_pasien    = $this->input->post('nama_pasien');
        $no_ktp         = $this->input->post('no_ktp');
        $tmpt_lahir     = $this->input->post('tmpt_lahir');
        $tgl_lahir      = $this->input->post('tgl_lahir');
        $umur           = $this->input->post('umur');
        $jk             =  $this->input->post('jk');
        $alamat         = $this->input->post('alamat');
        $no_tlp         = $this->input->post('no_tlp');
        $jenis_pel      = $this->input->post('jenis_pel');

        if (
            !isset($id_pasien) || trim($id_pasien) == '' ||
            !isset($no_ktp) || trim($no_ktp) == ''
        ) 
        {
            $this->session->set_userdata("notif_gagal","Data pasien gagal di edit ...");
            redirect('pasien/edit/' . $id_pasien);
        } else {
       
            $update_data = array(
                'id_registrasi'    => $id_registrasi,
                'id_pasien'    => $id_pasien,  
                'nama_pasien'  => $nama_pasien, 
                'no_ktp'       => $no_ktp,
                'tmpt_lahir'   => $tmpt_lahir, 
                'tgl_lahir'    => $tgl_lahir,
                'umur'         => $umur, 
                'jk'           => $jk,
                'alamat'       => $alamat,
                 'no_tlp'       => $no_tlp,
                'jenis_pel'    => $jenis_pel
            );

            $where  = array('id_registrasi' => $id_registrasi);
            $res    = $this->ModelPosyandu->UpdateData('pasien', $update_data, $where);
            if ($res >= 1) {
                $this->session->set_userdata("notif_sukses","Data pasien berhasil di edit ...");
                redirect('pasien');
            }
        }
    }

    public function detail($id_registrasi) {
            $data['data_pasien'] = $this->ModelPosyandu->getData('pasien', '*',"WHERE id_registrasi= '$id_registrasi'");
            $this->data['title'] = 'Detail Pasien';
            $this->load->view('template/header',$this->data);
            $this->load->view('template/sidebar');
            $this->load->view('pasien/v_detail',$data);
            $this->load->view('template/footer');
    }

    public function delete($id_registrasi) {
        $where = array('id_registrasi' => $id_registrasi);
        $res = $this->ModelPosyandu->HapusData('pasien', $where);
        $res1 = $this->ModelPosyandu->HapusData('registrasi', $where);
        if ($res >= 1) {
            $this->session->set_userdata("notif_sukses","Data pasien berhasil di hapus ...");
            redirect('pasien');
        }else{
            $this->session->set_userdata("notif_gagal","Data pasien gagal di hapus !");
            redirect('pasien');
        }
    }

   public function hitung_umur(){
        $tgl_lahir  = $this->input->post("tgl_lahir");
        $birthday   = new DateTime($tgl_lahir);
        $today      = new DateTime("today");
        if ($birthday > $today) {
            exit("0 tahun 0 bulan 0 hari");
        }
        $y = $today->diff($birthday)->y;
        $m = $today->diff($birthday)->m;
        $d = $today->diff($birthday)->d;
        $umur = $y." tahun ".$m." bulan ".$d." hari";
         $data = array(
                'umur' => $umur
        );
        echo json_encode($data);
    }

}
