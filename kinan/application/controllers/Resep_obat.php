<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Resep_obat extends CI_Controller {

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
        $this->data['title'] = 'Resep Obat';
        $resep_obat = $this->ModelPosyandu->getData('resep_obat', '*');
        $this->load->view('template/header',$this->data);
        $this->load->view('template/sidebar');
        $this->load->view('resep_obat/v_resep_obat', array('resep_obat' => $resep_obat));
        $this->load->view('template/footer');
    }

    public function add(){
        $this->data['title'] = 'Form Tambah';
        $this->data['data_reg'] = $this->ModelPosyandu->getData('registrasi','*',"JOIN pasien ON registrasi.id_registrasi = pasien.id_registrasi");
        $this->data['obat'] = $this->ModelPosyandu->getData('obat','*');
        $this->load->view('template/header',$this->data);
        $this->load->view('template/sidebar');
        $this->load->view('resep_obat/v_add');
        $this->load->view('template/footer');
    }


// ################## FUNGSI PROSES TAMBAH ######################## //
    public function processAdd() {
       
       

        $id_registrasi  = $this->input->post('id_registrasi');
        $checked_array  = $this->input->post('c_id_obat');
        $id_obat        = $this->input->post('id_obat');
        $jml_obat       = $this->input->post('jml_obat');
        $tgl_resep      = date('Y-m-d');

        $pasien         = $this->ModelPosyandu->getData('pasien', '*',"WHERE id_registrasi='$id_registrasi'");
        foreach ($pasien as $np) {
            $nama_pasien = $np['nama_pasien'];
        }

        $i = 0;
        foreach ($id_obat as $key => $value) {
               
            if (in_array($id_obat[$key], $checked_array)) {
                $data           = $this->ModelPosyandu->dataTerakhir('resep_obat','id_resep');
                $data_resep     = $this->ModelPosyandu->getData('resep_obat', 'MAX(RIGHT(id_resep,4)) AS last');
                $lastId         = array('last' => $data_resep[0]['last']);
                $last           = intval(implode("", $lastId));
                $kode           = "";
                $baru           = 1;
                if ($data->num_rows() <> 0) {
                    $baru = intval($last) + 1;
                    $kode = str_pad($baru, 4, "0", STR_PAD_LEFT);
                }else{
                    $kode = 1;
                }

                $id_resep   = 'R' . $kode;
               
                $obat       = $this->ModelPosyandu->getData('obat', '*',"WHERE id_obat='$id_obat[$key]'");
                foreach ($obat as $o) {
                    $nama_obat = $o['nama_obat'];
                    $stok      = $o['stok'];
                }
            
                if($stok < $jml_obat[$key]){
                    $this->session->set_userdata("notif_gagal","Stok obat $nama_obat tidak tersedia ...");
                    redirect('resep_obat/add');
                }

                $cek_ = $this->ModelPosyandu->cekId('resep_obat',"WHERE id_registrasi = '$id_registrasi' && id_obat = '$id_obat[$key]'");
                if ($cek_ > 0) {
                    $this->session->set_userdata("notif_gagal","Obat sudah diinput ...");
                    redirect('resep_obat/add');
                    exit;
                }
                
                $tambah_data = array(
                    'id_resep'            => $id_resep, 
                    'tgl_resep'           => $tgl_resep,
                    'id_registrasi'       => $id_registrasi, 
                    'nama_pasien'         => $nama_pasien,
                    'id_obat'             => $id_obat[$key], 
                    'nama_obat'           => $nama_obat,
                    'jml_obat'            => $jml_obat[$key]
                );

                $res      = $this->ModelPosyandu->addData('resep_obat', $tambah_data);
            }
            $i++;
           
        }
        
        // exit;
        if ($res >= 1) {
            $this->session->set_userdata("notif_sukses","Data berhasil di tambahkan ...");
            redirect('resep_obat');
        }else{
            $this->session->set_userdata("notif_gagal","Data gagal di tambahkan ...");
            redirect('resep_obat/add');
        }   

    }
// ################## END FUNGSI PROSES TAMBAH ######################## //

    public function edit($id_resep){
        $this->data['title'] = 'Form Edit';
        $this->data['resep_obat'] = $this->ModelPosyandu->getData('resep_obat','*',"WHERE id_resep='$id_resep'");
        $this->data['data_reg'] = $this->ModelPosyandu->getData('registrasi','*',"JOIN pasien ON registrasi.id_registrasi = pasien.id_registrasi");
        $this->data['obat'] = $this->ModelPosyandu->getData('obat','*');
        $this->load->view('template/header',$this->data);
        $this->load->view('template/sidebar');
        $this->load->view('resep_obat/v_edit');
        $this->load->view('template/footer');
    }

    public function doUpdate(){
        $id_resep       = $this->input->post('id_resep');
        $tgl_resep      = $this->input->post('tgl_resep');
        $id_registrasi  = $this->input->post('id_registrasi');
        $id_obat        = $this->input->post('nama_obat');
        $jml_obat       = $this->input->post('jml_obat');

        $data_pasien = $this->ModelPosyandu->getData('pasien','*',"WHERE id_registrasi='$id_registrasi'");
        foreach ($data_pasien as $dp) {
            $nama_pasien = $dp['nama_pasien'];
        }

        $data_obat = $this->ModelPosyandu->getData('obat','*',"WHERE id_obat='$id_obat'");
        foreach ($data_obat as $dp) {
            $nama_obat = $dp['nama_obat'];
        }

        $cek = $this->ModelPosyandu->cekId('resep_obat',"WHERE id_registrasi='$id_registrasi' AND id_obat='$id_obat'");

        $update_data = array(
            'tgl_resep'     => $tgl_resep,
            'id_registrasi'     => $id_registrasi,
            'nama_pasien'   => $nama_pasien,
            'id_obat'       => $id_obat,
            'nama_obat'     => $nama_obat,
            'jml_obat'      => $jml_obat
        );


        $where  = array('id_resep' => $id_resep);
        $res    = $this->ModelPosyandu->UpdateData('resep_obat', $update_data, $where);
        if ($res >= 1) {
            $this->session->set_userdata("notif_sukses","Data berhasil diedit...");
            redirect('resep_obat');
        }else{
            $this->session->set_userdata("notif_gagal","Data gagal diedit...");
            redirect('resep_obat/edit/'.$id_resep);
        }


    }

    public function detail($id_resep){
        $this->data['title'] = 'Detail Resep';
        $this->data['resep_obat'] = $this->ModelPosyandu->getData('resep_obat','*',"WHERE id_resep='$id_resep'");
        $this->load->view('template/header',$this->data);
        $this->load->view('template/sidebar');
        $this->load->view('resep_obat/v_detail');
        $this->load->view('template/footer');
    }

    public function delete($id_resep) {
        $where = array('id_resep' => $id_resep);
        $res = $this->ModelPosyandu->HapusData('resep_obat', $where);
        if ($res >= 1) {
            $this->session->set_userdata("notif_sukses","Data berhasil di hapus ...");
            redirect('resep_obat');
        }else{
            $this->session->set_userdata("notif_gagal","Data gagal di hapus !");
            redirect('resep_obat');
        }
    }
   

}
