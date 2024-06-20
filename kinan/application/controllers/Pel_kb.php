<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Pel_kb extends CI_Controller {
 
    public function __construct() {
        parent::__construct();
        if ($this->session->userdata('status') != "login") {
            $this->session->set_userdata("notif_gagal","Silahkan login terlebih dahulu!");
            redirect(base_url("Welcome"));
        }
        $this->load->model('ModelPosyandu');
        $this->load->helper('convert_number');
        $this->data = array();
    }

// ################## FUNGSI INDEX / MENAMPILKAN FILE BAYI ######################## //
    public function index() {
       

        $this->data['title'] = 'Pemeriksaan kb';
        $this->data['kb'] = $this->ModelPosyandu->getData('kb', '*',"JOIN pasien ON kb.id_pasien = pasien.id_pasien ORDER BY pasien.id_registrasi DESC");
        $this->load->view('template/header',$this->data);
        $this->load->view('template/sidebar');
        $this->load->view('pel_kb/v_kb');
        $this->load->view('template/footer');
    }
// ################## END FUNGSI INDEX ########################################## //

    public function ambil_data_pasien(){
        $id_registrasi = $_POST['id_registrasi'];
        $data = $this->ModelPosyandu->getData('pasien', '*',"JOIN registrasi ON registrasi.id_registrasi = pasien.id_registrasi WHERE pasien.id_registrasi = '$id_registrasi'");
        $data_pilih = array();
        if ($data) {
            $data_pilih = array(
                'id_pasien' => $data[0]["id_pasien"],
                'nama_pasien' => $data[0]["nama_pasien"]
            );
        }

        echo json_encode($data_pilih);

    }

// ############ FUNGSI ADD / MENAMPILKAN FORM TAMBAH DATA BAYI ################# //
    public function add() {
        $data   = $this->ModelPosyandu->dataTerakhir('kb','id_kb');
        $data_kb= $this->ModelPosyandu->getData('kb', 'MAX(RIGHT(id_kb,3)) AS last');
        $lastId = array('last' => $data_kb[0]['last']);
        $last   = intval(implode("", $lastId));
        $kode   = "";
        $baru   = 1;

        if ($data->num_rows() > 0) {
            $baru = $last + 1;
            $kode = str_pad($baru, 3, "0", STR_PAD_LEFT);
        }
        $this->data['title']  = 'Form Tambah';
        $this->data['id_kb']  = 'KB' . $kode;
        $this->data['id_registrasi'] = $this->ModelPosyandu->getData('pasien', '*','JOIN registrasi ON registrasi.id_registrasi = pasien.id_registrasi WHERE jenis_pel = "pel_kb"');
        $this->load->view('template/header',$this->data);
        $this->load->view('template/sidebar');
        $this->load->view('pel_kb/v_add');
        $this->load->view('template/footer');
    }
// ############################# END FUNGSI ADD ############################### //


// ################## FUNGSI PROSES TAMBAH ######################## //
    public function processAdd() {
        $id_registrasi  = $this->input->post('id_registrasi');
        $tgl_periksa    = $this->input->post('tgl_periksa');
        $id_kb          = $this->input->post('id_kb');
        $id_pasien      = $this->input->post('id_pasien');
        $nama_pasien    = $this->input->post('nama_istri');
        $nama_suami     = $this->input->post('nama_suami');
        $td             = $this->input->post('td');
        $bb             = str_replace(',', '.', $this->input->post('bb'));
        $jenis_kb             = $this->input->post('jenis_kb');
        $tgl_kembali    = $this->input->post('tgl_kembali');
        $biaya          = convert_to_number($this->input->post('biaya'));

            $tambah_data = array(
                'id_kb'        => $id_kb, 
                'tgl_periksa'  => $tgl_periksa,
                'id_pasien'    => $id_pasien, 
                'nama_pasien'  => $nama_pasien,
                'nama_suami'   => $nama_suami, 
                'td'           => $td,
                'bb'           => $bb,
                'jenis_kb'     => $jenis_kb,
                'tgl_kembali'  => $tgl_kembali,
                'biaya'        => $biaya

            );

            $res = $this->ModelPosyandu->addData('kb', $tambah_data);
            if ($res >= 1) {
                $this->session->set_userdata("notif_sukses","Data berhasil disimpan ...");
                redirect('pel_kb');
            }else{
                $this->session->set_userdata("notif_gagal","Data gagal disimpan ...");
                redirect('pel_kb');
            }
    }
// ################## END FUNGSI PROSES TAMBAH ######################## //

     public function edit($id_kb) {
         $data['data_kb'] = $this->ModelPosyandu->getData('kb', '*',"JOIN pasien ON kb.id_pasien = pasien.id_pasien WHERE id_kb = '$id_kb'");
            $this->data['title'] = 'Form Edit';
            $this->load->view('template/header',$this->data);
            $this->load->view('template/sidebar');
            $this->load->view('pel_kb/v_edit',$data);
            $this->load->view('template/footer');
    }

    public function doUpdate() {
        $id_kb          = $this->input->post('id_kb');
        $tgl_periksa    = $this->input->post('tgl_periksa');
        $id_pasien      = $this->input->post('id_pasien');
        $nama_pasien    = $this->input->post('nama_pasien');
        $nama_suami     = $this->input->post('nama_suami');
        $td             = $this->input->post('td');
        $jenis_kb             = $this->input->post('jenis_kb');
        $bb             = str_replace(',', '.', $this->input->post('bb'));
        $tgl_kembali    = $this->input->post('tgl_kembali');
        $biaya          = convert_to_number($this->input->post('biaya'));
    
            
        if (
            !isset($id_kb) || trim($id_kb) == ''
        ) 
        {
            $this->session->set_userdata("notif_gagal","Data gagal diedit ...");
            redirect('pel_kb/edit/' . $id_kb);
        } else {
       
            $update_data = array( 
                'tgl_periksa'    => $tgl_periksa,
                'nama_pasien'    => $nama_pasien,
                'nama_suami'     => $nama_suami, 
                'td'             => $td,
                'bb'             => $bb,
                'jenis_kb'       => $jenis_kb,
                'tgl_kembali'    => $tgl_kembali,
                'biaya'          => $biaya

            );


            $where  = array('id_kb' => $id_kb);
            $res    = $this->ModelPosyandu->UpdateData('kb', $update_data, $where);
            if ($res >= 1) {
                $this->session->set_userdata("notif_sukses","Data berhasil diedit...");
                redirect('pel_kb');
            }else{
                $this->session->set_userdata("notif_gagal","Data gagal diedit ...");
                redirect('pel_kb/edit/' . $id_kb);
            }
        }
    }

     public function detail($id_kb) {
            $data['data_kb'] = $this->ModelPosyandu->getData('kb', '*',"JOIN pasien ON kb.id_pasien = pasien.id_pasien WHERE kb.id_kb= '$id_kb'");
            $this->data['title'] = 'Detail';
            $this->load->view('template/header',$this->data);
            $this->load->view('template/sidebar');
            $this->load->view('pel_kb/v_detail',$data);
            $this->load->view('template/footer');
    }

    public function delete($id_kb) {
        $where = array('id_kb' => $id_kb);
        $res = $this->ModelPosyandu->HapusData('kb', $where);
        if ($res >= 1) {
            $this->session->set_userdata("notif_sukses","Data berhasil di hapus ...");
            redirect('pel_kb');
        }else{
            $this->session->set_userdata("notif_gagal","Data gagal di hapus !");
            redirect('pel_kb');
        }
    }

}
