<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Pel_bumil extends CI_Controller {

    public function __construct() {
        parent::__construct();
        if ($this->session->userdata('status') != "login") {
            $this->session->set_userdata("notif_gagal","Silahkan login terlebih dahulu!");
            redirect(base_url("Welcome"));
        }
        $this->load->helper('convert_number');
        $this->load->model('ModelPosyandu');
        $this->data = array();
    }

// ################## FUNGSI INDEX / MENAMPILKAN FILE BAYI ######################## //
    public function index() {
        $this->data['title']         = 'Pemeriksaan Ibu Hamil';
        $this->data['ibu_hamil']     = $this->ModelPosyandu->getData('ibu_hamil', '*',"JOIN pasien ON ibu_hamil.id_pasien = pasien.id_pasien ");
        $this->load->view('template/header',$this->data);
        $this->load->view('template/sidebar');
        $this->load->view('pel_bumil/v_bumil');
        $this->load->view('template/footer');
    }
// ################## END FUNGSI INDEX ########################################## //

    public function ambil_data_pasien(){
        $id_registrasi = $this->input->post('id_registrasi');
        $data        = $this->ModelPosyandu->getData('pasien', '*',"JOIN registrasi ON registrasi.id_registrasi = pasien.id_registrasi WHERE pasien.id_registrasi = '$id_registrasi'");
        $data_pilih  = array();
        if ($data) {
            $data_pilih     = array(
                'id_pasien' => $data[0]["id_pasien"],
                'nama_bumil' => $data[0]["nama_pasien"]
            );
        }

        echo json_encode($data_pilih);

    }

// ############ FUNGSI ADD / MENAMPILKAN FORM TAMBAH DATA BAYI ################# //
    public function add() {
        $data       = $this->ModelPosyandu->dataTerakhir('ibu_hamil','id_bumil');
        $data_bumil = $this->ModelPosyandu->getData('ibu_hamil', 'MAX(RIGHT(id_bumil,3)) AS last');
        $lastId     = array('last' => $data_bumil[0]['last']);
        $last       = intval(implode("", $lastId));
        $kode       = "";
        $baru       = 1;

        if ($data->num_rows() > 0) {
            $baru   = $last + 1;
            $kode   = str_pad($baru, 3, "0", STR_PAD_LEFT);
        }
        $this->data['title']        = 'Form Tambah';
        $this->data['id_bumil']     = 'Bumil' . $kode;
        $this->data['id_registrasi']       = $this->ModelPosyandu->getData('pasien', '*','JOIN registrasi ON registrasi.id_registrasi = pasien.id_registrasi WHERE jenis_pel = "pel_bumil"');
        $this->load->view('template/header',$this->data);
        $this->load->view('template/sidebar');
        $this->load->view('pel_bumil/v_add');
        $this->load->view('template/footer');
    }
// ############################# END FUNGSI ADD ############################### //


################## FUNGSI PROSES TAMBAH ######################## //
    public function processAdd() {
       

        $id_bumil           = $this->input->post('id_bumil');
        $tgl_periksa        = $this->input->post('tgl_periksa');
        $id_pasien          = $this->input->post('id_pasien');
        $nama_pasien        = $this->input->post('nama_bumil');
        $jenis              = $this->input->post('jenis');
        $hpht               = $this->input->post('hpht');
        $nama_suami           = $this->input->post('nama_suami');
        $td                 = $this->input->post('td');
        $bb                 = str_replace(',', '.',$this->input->post('bb'));
        $hpl                = $this->input->post('hpl');
        $tfu                = $this->input->post('tfu');
        $presentasi         =  $this->input->post('presentasi');
        $djj                = $this->input->post('djj');
        $tindakan           = $this->input->post('tindakan');
        $tgl_kembali        = $this->input->post('tgl_kembali');
         $biaya          = convert_to_number($this->input->post('biaya'));

            $tambah_data = array(
                'id_bumil'           => $id_bumil, 
                'tgl_periksa'        => $tgl_periksa,
                'id_pasien'          => $id_pasien, 
                'nama_pasien'        => $nama_pasien,
                'jenis'              => $jenis, 
                'hpht'               => $hpht,
                'nama_suami'           => $nama_suami,
                'td'                 => $td,
                'bb'                 => $bb,
                'hpl'                => $hpl,
      
                'tfu'                => $tfu, 
                'presentasi'         => $presentasi,
                'djj'                => $djj, 
                'tindakan'           => $tindakan,
                'tgl_kembali'        => $tgl_kembali,
                'biaya'              => $biaya

            );

            $res = $this->ModelPosyandu->addData('ibu_hamil', $tambah_data);
            if ($res >= 1) {
                $this->session->set_userdata("notif_sukses","Data berhasil disimpan ...");
                redirect('pel_bumil');
            }else{
                $this->session->set_userdata("notif_gagal","Data gagal disimpan ...");
                redirect('pel_bumil/add');
            }
    }
// ################## END FUNGSI PROSES TAMBAH ######################## //

     public function edit($id_bumil) {
         $data['data_bumil'] = $this->ModelPosyandu->getData('ibu_hamil', '*',"JOIN pasien ON ibu_hamil.id_pasien = pasien.id_pasien WHERE id_bumil = '$id_bumil'");
            $this->data['title'] = 'Form Edit';
            $this->load->view('template/header',$this->data);
            $this->load->view('template/sidebar');
            $this->load->view('pel_bumil/v_edit',$data);
            $this->load->view('template/footer');
    }

    public function doUpdate() {
      
        $id_bumil        = $this->input->post('id_bumil');
        $tgl_periksa     = $this->input->post('tgl_periksa');
        $jenis           = $this->input->post('jenis');
        $hpht            = $this->input->post('hpht');
        $nama_suami        = $this->input->post('nama_suami');
        $td              = $this->input->post('td');
        $bb              = str_replace(',','.',$this->input->post('bb'));
        $hpl             = $this->input->post('hpl');
        $tfu             = $this->input->post('tfu');
        $presentasi      = $this->input->post('presentasi');
        $djj             = $this->input->post('djj');
        $tindakan        = $this->input->post('tindakan');
        $tgl_kembali     = $this->input->post('tgl_kembali');
         $biaya          = convert_to_number($this->input->post('biaya'));
    
            
        if (!isset($id_bumil) || trim($id_bumil) == '') 
        {
            $this->session->set_userdata("notif_gagal","Data ibu hamil gagal diedit ...");
            redirect('pel_bumil/edit/' . $id_bumil);
        } else {
       
            $update_data = array( 
                'id_bumil'      => $id_bumil, 
                'tgl_periksa'   => $tgl_periksa,
                'jenis'         => $jenis, 
                'hpht'          => $hpht,
                'nama_suami'      => $nama_suami,
                'td'            => $td,
                'bb'            => $bb,
                'hpl'           => $hpl,
                'tfu'           => $tfu, 
                'presentasi'    => $presentasi,
                'djj'           => $djj, 
                'tindakan'      => $tindakan,
                'tgl_kembali'   => $tgl_kembali,
                'biaya'         => $biaya

            );


            $where  = array('id_bumil' => $id_bumil);
            $res    = $this->ModelPosyandu->UpdateData('ibu_hamil', $update_data, $where);
            if ($res >= 1) {
                $this->session->set_userdata("notif_sukses","Data berhasil diedit ...");
                redirect('pel_bumil');
            }else{
                $this->session->set_userdata("notif_gagal","Data gagal diedit ...");
                redirect('pel_bumil');
            }
        }
    }

     public function detail($id_bumil) {
            $data['data_bumil'] = $this->ModelPosyandu->getData('ibu_hamil', '*',"JOIN pasien ON ibu_hamil.id_pasien = pasien.id_pasien WHERE id_bumil= '$id_bumil'");
            $this->data['title'] = 'Detail';
            $this->load->view('template/header',$this->data);
            $this->load->view('template/sidebar');
            $this->load->view('pel_bumil/v_detail',$data);
            $this->load->view('template/footer');
    }

    public function delete($id_bumil) {
        $where = array('id_bumil' => $id_bumil);
        $res = $this->ModelPosyandu->HapusData('ibu_hamil', $where);
        if ($res >= 1) {
            $this->session->set_userdata("notif_sukses","Data berhasil di hapus ...");
            redirect('pel_bumil');
        }else{
            $this->session->set_userdata("notif_gagal","Data gagal di hapus !");
            redirect('pel_bumil');
        }
    }

}
