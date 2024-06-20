<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Registrasi extends CI_Controller {

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
       

        $this->data['title'] = 'Pendaftaran';
        $this->data['data_reg'] = $this->ModelPosyandu->getData('registrasi', '*','JOIN pasien ON registrasi.id_registrasi = pasien.id_registrasi ORDER BY tgl_reg DESC');
        $this->load->view('template/header',$this->data);
        $this->load->view('template/sidebar');
        $this->load->view('registrasi/v_regis');
        $this->load->view('template/footer');
    }
// ################## END FUNGSI INDEX ########################################## //

// ############ FUNGSI ADD / MENAMPILKAN FORM TAMBAH DATA BAYI ################# //
    public function add() {
        $data   = $this->ModelPosyandu->dataTerakhir('registrasi','id_registrasi');
        $registrasi = $this->ModelPosyandu->getData('registrasi', 'MAX(RIGHT(id_registrasi,3)) AS last');
        $lastId = array('last' => $registrasi[0]['last']);
        $last   = intval(implode("", $lastId));
        $kode   = "";
        $baru   = 1;

        if ($data->num_rows() > 0) {
            $baru   = $last + 1;
            $kode   = str_pad($baru, 3, "0", STR_PAD_LEFT);
        }


         // id pasien
        $data1   = $this->ModelPosyandu->dataTerakhir('pasien','id_pasien');
        $pasien = $this->ModelPosyandu->getData('pasien', 'MAX(RIGHT(id_pasien,3)) AS last');
        $lastId1 = array('last' => $pasien[0]['last']);
        $last1   = intval(implode("", $lastId1));
        $kode1   = "";
        $baru1   = 1;
         if ($data1->num_rows() > 0) {
            $baru1   = $last1 + 1;
            $kode1   = str_pad($baru1, 3, "0", STR_PAD_LEFT);
        }
        $this->data['id_pasien']    = 'PAS' . $kode1;
        $this->data['title']        = 'Form Registrasi';
        $this->data['id_registrasi']= 'REG' .date("dmY"). $kode;
        $this->load->view('template/header',$this->data);
        $this->load->view('template/sidebar');
        $this->load->view('registrasi/v_add');
        $this->load->view('template/footer');
    }
// ############################# END FUNGSI ADD ############################### //


// ################## FUNGSI PROSES TAMBAH ######################## //
    public function processAdd() {
       

        $id_registrasi      = $this->input->post('id_registrasi');
        $tgl_reg            = $this->input->post('tgl_reg');
        $id_pasien          = $this->input->post('id_pasien');
        $nama_pasien        = htmlspecialchars($this->input->post('nama_pasien'));
        $no_ktp             = htmlspecialchars($this->input->post('no_ktp'));
        $tmpt_lahir         = htmlspecialchars($this->input->post('tmpt_lahir'));
        $tgl_lahir          = htmlspecialchars($this->input->post('tgl_lahir'));
        $umur               = $this->input->post('umur');
        $jk                 = $this->input->post('jk');
        $alamat             = htmlspecialchars($this->input->post('alamat'));
        $no_tlp             = $this->input->post('no_tlp');
        $jenis_pel          = $this->input->post('jenis_pel');

        

        $cek_ = $this->ModelPosyandu->cekId('registrasi',"WHERE id_registrasi = '$id_registrasi'");
        if ($cek_ > 0) {
            $this->session->set_userdata("notif_gagal","Data sudah terdaftar ...");
                redirect('registrasi/add');
                exit;
        }
            $tambah_data_reg = array(
                'id_registrasi'    => $id_registrasi, 
                'tgl_reg'          => $tgl_reg
            );

            $tambah_data_pasien = array(
                'id_registrasi' => $id_registrasi, 
                'id_pasien'     => $id_pasien,
                'nama_pasien'   => $nama_pasien, 
                'no_ktp'        => $no_ktp,
                'tmpt_lahir'    => $tmpt_lahir, 
                'tgl_lahir'     => $tgl_lahir,
                'umur'          => $umur, 
                'jk'            => $jk,
                'alamat'        => $alamat,
                'no_tlp'        => $no_tlp,
                'jenis_pel'     => $jenis_pel
            );
            $res_reg = $this->ModelPosyandu->addData('registrasi', $tambah_data_reg);
            $res_pasien = $this->ModelPosyandu->addData('pasien', $tambah_data_pasien);
            if ($res_reg >= 1 && $res_pasien >=1) {
                $this->session->set_userdata("notif_sukses","Data registrasi berhasil di simpan ...");
                redirect('registrasi');
            }else{
                  $this->session->set_userdata("notif_gagal","Data registrasi gagal di simpan ...");
                redirect('registrasi');
            }
    }
// ################## END FUNGSI PROSES TAMBAH ######################## //

     public function edit($id_registrasi) {
         $data['data_reg'] = $this->ModelPosyandu->getData('registrasi', '*'," JOIN pasien ON registrasi.id_registrasi=pasien.id_registrasi WHERE pasien.id_registrasi = '$id_registrasi'");
            $this->data['title'] = 'Form Edit Registrasi';
            $this->load->view('template/header',$this->data);
            $this->load->view('template/sidebar');
            $this->load->view('Registrasi/v_edit',$data);
            $this->load->view('template/footer');
    }

    public function doUpdate() {
        
        $id_registrasi      = $this->input->post('id_registrasi');
        $tgl_reg            = $this->input->post('tgl_reg');
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
            !isset($id_registrasi) || trim($id_registrasi) == ''
        ) 
        {
            $this->session->set_userdata("notif_gagal","Data registrasi gagal di edit ...");
            redirect('Registrasi/edit/' . $id_registrasi);
        } else {
       
            $update_data_reg = array(
                'id_registrasi'     => $id_registrasi,
                'tgl_reg'           => $tgl_reg
            );

            $update_data_pasien = array(
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
            $res    = $this->ModelPosyandu->UpdateData('registrasi', $update_data_reg, $where);
            $res1    = $this->ModelPosyandu->UpdateData('pasien', $update_data_pasien, $where);
            if ($res >= 1) {
                $this->session->set_userdata("notif_sukses","Data registrasi berhasil di edit ...");
                redirect('Registrasi');
            }
        }
    }

    public function detail($id_registrasi) {
            $data['data_reg'] = $this->ModelPosyandu->getData('registrasi', '*',"JOIN pasien ON registrasi.id_registrasi = pasien.id_registrasi WHERE registrasi.id_registrasi= '$id_registrasi'");
            $this->data['title'] = 'Detail Registrasi';
            $this->load->view('template/header',$this->data);
            $this->load->view('template/sidebar');
            $this->load->view('registrasi/v_detail',$data);
            $this->load->view('template/footer');
    }

    public function delete($id_registrasi) {
        $where = array('id_registrasi' => $id_registrasi);
        $res = $this->ModelPosyandu->HapusData('registrasi', $where);
        $res1 = $this->ModelPosyandu->HapusData('pasien', $where);
        if ($res >= 1) {
            $this->session->set_userdata("notif_sukses","Data registrasi berhasil di hapus ...");
            redirect('registrasi');
        }else{
            $this->session->set_userdata("notif_gagal","Data registrasi gagal di hapus !");
            redirect('registrasi');
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
