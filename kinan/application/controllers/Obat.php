<?php

defined('BASEPATH') OR exit('No direct script access allowed');

// CONTROLLER OBAT
class Obat extends CI_Controller {

    // ##### FUNGSI CONSTRUCT ##### //
    public function __construct() {
        parent::__construct();
        if ($this->session->userdata('status') != "login") {
            $this->session->set_userdata("notif_gagal","Silahkan login terlebih dahulu!");
            redirect(base_url("Welcome"));
        }
        $this->load->helper('convert_number');
        $this->data = array();
        $this->load->model('ModelPosyandu');
    }

    // ##### FUNGSI INDEX ##### //
    public function index() {
        $this->data['title'] = 'OBAT';
        $obat = $this->ModelPosyandu->getData('obat', '*');
        $this->load->view('template/header',$this->data);
        $this->load->view('template/sidebar');
        $this->load->view('obat/v_obat', array('obat' => $obat));
        $this->load->view('template/footer');
    }

    // ##### FUNGSI ADD ##### //
    public function add() {
        $this->data['title'] = 'Tambah';
        $this->load->view('template/header');
        $this->load->view('template/sidebar');
        $this->load->view('obat/v_add');
        $this->load->view('template/footer');
    }

    // ##### PROSES TAMBAH OBAT ##### //
    public function processAdd() {
        // ##### MEMBUAT ID OBAT ##### //
        $data = $this->ModelPosyandu->dataTerakhir('obat','id_obat');
        $obat = $this->ModelPosyandu->getData('obat', 'MAX(RIGHT(id_obat,3)) AS last');
        $lastId = array('last' => $obat[0]['last']);
        $last = implode("", $lastId);
        $kode = "";
        $baru = 1;
        if ($data->num_rows() > 0) {
            $baru = intval($last) + 1;
            $kode = str_pad($baru, 4, "0", STR_PAD_LEFT);
        }

        // ##### MEMBUAT ID TRANSAKSI OBAT ##### //
        $data_t     = $this->ModelPosyandu->dataTerakhir('transaksi_obat','id_transaksi');
        $transaksi  = $this->ModelPosyandu->getData('transaksi_obat', 'MAX(RIGHT(id_transaksi,3)) AS last');
        $lastId_t   = array('last' => $transaksi[0]['last']);
        $last_t     = implode("", $lastId_t);
        $kode_t     = "";
        $baru_t     = 1;
        if ($data_t->num_rows() > 0) {
            $baru_t = intval($last_t) + 1;
            $kode_t = str_pad($baru_t, 4, "0", STR_PAD_LEFT);
        }


        $id_transaksi   = 'TRAN' . $kode_t;
        $nama_obat      = $this->input->post("nama_obat");
        $harga_beli     = convert_to_number($this->input->post('harga_beli'));
        $harga_jual     = convert_to_number($this->input->post('harga_jual'));
        $stok           = $this->input->post("stok");
        $satuan         = $this->input->post("satuan");
      
        if (!isset($nama_obat) || trim($nama_obat) == '' || !isset($harga_beli) || trim($harga_beli) == ''){
            $id_obat = NULL;
        } else {
            $id_obat = 'OBAT' . $kode;
        }
        
        if ($id_obat == NULL) {
            $this->session->set_userdata("notif_gagal","Data Obat gagal di tambahkan !");
            redirect('Obat/add');
        } else {
            $tambah_data = array(
                'id_obat'       => $id_obat, 
                'nama_obat'     => $nama_obat,
                'harga_beli'    => $harga_beli, 
                'harga_jual'    => $harga_jual,
                'stok'          => $stok, 
                'satuan'        => $satuan
            );

            $insert_trans = array(
                'id_transaksi' => $id_transaksi,
                'tgl_transaksi' => date('Y-m-d'),
                'id_user'       => $this->session->userdata('id_user'),
                'id_obat'       => $id_obat,
                'nama_obat'     => $nama_obat,
                'qty'           => $stok,
                'harga'         => $harga_beli,
                'satuan'        => $satuan,
                'status'        => 'keluar'
            );

            $res    = $this->ModelPosyandu->addData('obat', $tambah_data);
            $insert = $this->ModelPosyandu->addData('transaksi_obat', $insert_trans);
            if ($res >= 1) {
                $this->session->set_userdata("notif_sukses","Data obat berhasil di tambahkan ...");
                redirect('Obat');
            }
        }
    }


    // ##### FUNGSI DETAIL OBAT ##### //
    public function detail($id_obat) {
            $data['data_obat'] = $this->ModelPosyandu->getData('obat', '*',"WHERE id_obat = '$id_obat'");
            $this->data['title'] = 'DETAIL OBAT';
            $this->load->view('template/header',$this->data);
            $this->load->view('template/sidebar');
            $this->load->view('obat/v_detail',$data);
            $this->load->view('template/footer');
    }

    // ##### FUNGSI EDIT OBAT ##### //
    public function edit($id_obat) {
        $cek = $this->ModelPosyandu->cekId('obat', 'where id_obat = "' . $id_obat . '"');
        if ($cek > 0) {
            $this->data['data_obat']    = $this->ModelPosyandu->getData('obat', '*',"WHERE id_obat = '$id_obat'");
             $this->data['title']       = 'FORM EDIT DATA OBAT';
            $this->load->view('template/header',$this->data);
            $this->load->view('template/sidebar');
            $this->load->view('obat/v_edit');
            $this->load->view('template/footer');
        } else {
            redirect('obat');
        }
    }

    // ##### FUNGSI PROSES UPDATE ##### //
    public function doUpdate() {
        $id_obat    = $this->input->post('id_obat');
        $nama_obat  = $this->input->post('nama_obat');
        $harga_beli = $this->input->post('harga_beli');
        $harga_jual = convert_to_number($this->input->post('harga_jual'));
        $stok       = $this->input->post('stok');
        $satuan     = $this->input->post('satuan');

        if (!isset($harga_jual) || trim($harga_jual) == '' ) {
            $this->session->set_userdata("notif_gagal","Data obat gagal di edit ...");
            redirect('obat/edit/' . $id_obat);
        } else {
            $update_data = array(
                'harga_jual' => $harga_jual);
            $where = array('id_obat' => $id_obat);
            $res = $this->ModelPosyandu->UpdateData('obat', $update_data, $where);
            if ($res >= 1) {
                $this->session->set_userdata("notif_sukses","Data Obat berhasil di edit ...");
                redirect('Obat');
            }
        }
    }

    // ##### FUNGSI HAPUS DATA OBAT ##### //
    public function delete($id_obat) {
        $where = array('id_obat' => $id_obat);
        $res = $this->ModelPosyandu->HapusData('obat', $where);
        if ($res >= 1) {
            $this->session->set_userdata("notif_sukses","Data obat berhasil di hapus ...");
            redirect('Obat');
        }else{
            $this->session->set_userdata("notif_gagal","Data obat gagal di hapus !");
            redirect('Obat');
        }
    }

    // ##### FUNGSI STOK OBAT ##### //
    public function stok_obat(){
           $data['data_obat'] = $this->ModelPosyandu->getData('obat', '*');
            $this->data['title'] = 'Form stok obat';
            $this->load->view('template/header',$this->data);
            $this->load->view('template/sidebar');
            $this->load->view('obat/v_add_stok',$data);
            $this->load->view('template/footer');
    }

    public function ambil_data_obat(){
        $id_obat = $_POST['id_obat'];
        $data = $this->ModelPosyandu->getData('obat', '*',"WHERE id_obat = '$id_obat'");
        $data_pilih = array();
        if ($data) {
            $data_pilih = array(
                'nama_obat' => $data[0]["nama_obat"],
                'harga_beli' => $data[0]["harga_beli"],
                'satuan'    => $data[0]["satuan"]
            );
        }

        echo json_encode($data_pilih);

    }

    // ##### FUNGSI PROSES STOK OBAT ##### //
    public function proses_stok(){
        $data = $this->ModelPosyandu->dataTerakhir('transaksi_obat','id_transaksi');
        $transaksi = $this->ModelPosyandu->getData('transaksi_obat', 'MAX(RIGHT(id_transaksi,3)) AS last');
        $lastId = array('last' => $transaksi[0]['last']);
        $last = implode("", $lastId);
        $kode = "";
        $baru = 1;
        if ($data->num_rows() > 0) {
            $baru = $last + 1;
            $kode = str_pad($baru, 4, "0", STR_PAD_LEFT);
        }


        $id_transaksi   = 'TRAN' . $kode;
        $id_obat        = $this->input->post('id_obat');
        $nama_obat      = $this->input->post('nama_obat');
        $harga_beli     = convert_to_number($this->input->post('harga_beli'));
        $stok           = $this->input->post('stok');
        $satuan         = $this->input->post('satuan');
        $ambil_stok     = $this->ModelPosyandu->getData('obat','*',"WHERE id_obat = '$id_obat'");
        $qty            = $ambil_stok[0]['stok'] + $stok;

        if (!isset($harga_beli) || trim($harga_beli) == '' || !isset($stok) ) {
            $this->session->set_userdata("notif_gagal","Stok obat gagal ditambahkan ...");
            redirect('obat/stok_obat/' . $id_obat);
        } else {
            $update_obat = array(
                'stok'       => $qty,
                'harga_beli' => $harga_beli
            );

            $where = array('id_obat' => $id_obat);


            $insert_trans = array(
            	'id_transaksi'  => $id_transaksi,
            	'tgl_transaksi' => date('Y-m-d'),
            	'id_user'		=> $this->session->userdata('id_user'),
            	'id_obat'		=> $id_obat,
            	'nama_obat'		=> $nama_obat,
            	'qty'			=> $stok,
            	'harga'			=> $harga_beli,
            	'satuan'		=> $satuan,
            	'status'		=> 'keluar'
            );
            $res = $this->ModelPosyandu->UpdateData('obat', $update_obat, $where);
            $insert = $this->ModelPosyandu->addData('transaksi_obat', $insert_trans);
            if ($res >= 1 && $insert >= 1) {
                $this->session->set_userdata("notif_sukses","Stok Obat berhasil ditambahkan ...");
                redirect('Obat');
            }

           
        }

        
    }


}
