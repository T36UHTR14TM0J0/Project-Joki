<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class Pel_bayi extends CI_Controller {

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
       

        $this->data['title']    = 'Pemeriksaan Bayi';
        $this->data['bayi']     = $this->ModelPosyandu->getData('bayi', '*',"JOIN pasien ON bayi.id_pasien = pasien.id_pasien ORDER BY pasien.id_registrasi DESC");
        $this->load->view('template/header',$this->data);
        $this->load->view('template/sidebar');
        $this->load->view('pel_bayi/v_bayi');
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
                'nama_bayi' => $data[0]["nama_pasien"]
            );
        }

        echo json_encode($data_pilih);

    }

// ############ FUNGSI ADD / MENAMPILKAN FORM TAMBAH DATA BAYI ################# //
    public function add() {
        $data       = $this->ModelPosyandu->dataTerakhir('bayi','id_bayi');
        $data_bayi  = $this->ModelPosyandu->getData('bayi', 'MAX(RIGHT(id_bayi,3)) AS last');
        $lastId     = array('last' => $data_bayi[0]['last']);
        $last       = intval(implode("", $lastId));
        $kode       = "";
        $baru       = 1;

        if ($data->num_rows() > 0) {
            $baru = $last + 1;
            $kode = str_pad($baru, 3, "0", STR_PAD_LEFT);
        }
        $this->data['title']    = 'Form Tambah';
        $this->data['id_bayi']  = 'B' . $kode;
        $this->data['id_registrasi']   = $this->ModelPosyandu->getData('pasien', '*','JOIN registrasi ON registrasi.id_registrasi = pasien.id_registrasi WHERE jenis_pel = "pel_bayi"');
        $this->load->view('template/header',$this->data);
        $this->load->view('template/sidebar');
        $this->load->view('pel_bayi/v_add');
        $this->load->view('template/footer');
    }
// ############################# END FUNGSI ADD ############################### //


// ################## FUNGSI PROSES TAMBAH ######################## //
    public function processAdd() {
        $id_bayi        = $this->input->post('id_bayi');
        $tgl_periksa    = $this->input->post('tgl_periksa');
        $id_pasien      = $this->input->post('id_pasien');
        $nama_bayi      = $this->input->post('nama_bayi');
        $nama_ibu       = $this->input->post('nama_ibu');
        $jenis          = $this->input->post('jenis');
        $jenis_imun     = $this->input->post('jenis_imun');
        $bb             = str_replace(',', '.', $this->input->post('bb'));
        $tb             = str_replace(',', '.', $this->input->post('tb'));
        $biaya          = convert_to_number($this->input->post('biaya'));

        $tambah_data = array(
            'id_bayi'            => $id_bayi, 
            'tgl_periksa'        => $tgl_periksa,
            'id_pasien'          => $id_pasien, 
            'nama_bayi'          => $nama_bayi,
            'nama_ibu'           => $nama_ibu, 
            'jenis'              => $jenis,
            'jenis_imun'        => $jenis_imun,
            'bb'                 => $bb,
            'tb'                 => $tb,
            'biaya'              => $biaya
        );

        $res = $this->ModelPosyandu->addData('bayi', $tambah_data);
        if ($res >= 1) {
            $this->session->set_userdata("notif_sukses","Data berhasil disimpan ...");
            redirect('pel_bayi');
        }else{
            $this->session->set_userdata("notif_gagal","Data gagal disimpan ...");
            redirect('pel_bayi');
        }
    }
// ################## END FUNGSI PROSES TAMBAH ######################## //

     public function edit($id_bayi) {
         $data['data_bayi'] = $this->ModelPosyandu->getData('bayi', '*',"JOIN pasien ON bayi.id_pasien = pasien.id_pasien WHERE id_bayi = '$id_bayi'");
            $this->data['title'] = 'Form Edit';
            $this->load->view('template/header',$this->data);
            $this->load->view('template/sidebar');
            $this->load->view('pel_bayi/v_edit',$data);
            $this->load->view('template/footer');
    }

    public function doUpdate() {
      
        $id_bayi        = $this->input->post('id_bayi');
        $tgl_periksa    = $this->input->post('tgl_periksa');
        $id_pasien      = $this->input->post('id_pasien');
        $nama_bayi      = $this->input->post('nama_bayi');
        $nama_ibu       = $this->input->post('nama_ibu');
        $jenis          = $this->input->post('jenis');
        $jenis_imun     = $this->input->post('jenis_imun');
        $bb             = str_replace(',', '.', $this->input->post('bb'));
        $tb             = str_replace(',', '.', $this->input->post('tb'));
        $biaya          = convert_to_number($this->input->post('biaya'));
    
            
        if (!isset($id_bayi) || trim($id_bayi) == '') 
        {
            $this->session->set_userdata("notif_gagal","Data gagal diedit ...");
            redirect('bayi/edit/' . $id_bayi);
        } else {
            $update_data = array( 
                'tgl_periksa'  => $tgl_periksa,
                'nama_bayi'    => $nama_bayi,
                'nama_ibu'     => $nama_ibu, 
                'jenis'        => $jenis,
                'jenis_imun'        => $jenis_imun,
                'bb'           => $bb,
                'tb'           => $tb,
                'biaya'        => $biaya
            );

            $where  = array('id_bayi' => $id_bayi);
            $res    = $this->ModelPosyandu->UpdateData('bayi', $update_data, $where);
            if ($res >= 1) {
                $this->session->set_userdata("notif_sukses","Data berhasil diedit ...");
                redirect('pel_bayi');
            }else{
                $this->session->set_userdata("notif_gagal","Data gagal diedit ...");
                redirect('bayi/edit/' . $id_bayi);
            }
        }
    }

     public function detail($id_bayi) {
            $data['data_bayi'] = $this->ModelPosyandu->getData('bayi', '*',"JOIN pasien ON bayi.id_pasien = pasien.id_pasien WHERE id_bayi= '$id_bayi'");
            $this->data['title'] = 'Detail Bayi';
            $this->load->view('template/header',$this->data);
            $this->load->view('template/sidebar');
            $this->load->view('pel_bayi/v_detail',$data);
            $this->load->view('template/footer');
    }

    public function delete($id_bayi) {
        $where = array('id_bayi' => $id_bayi);
        $res = $this->ModelPosyandu->HapusData('bayi', $where);
        if ($res >= 1) {
            $this->session->set_userdata("notif_sukses","Data berhasil di hapus ...");
            redirect('pel_bayi');
        }else{
            $this->session->set_userdata("notif_gagal","Data gagal di hapus !");
            redirect('pel_bayi');
        }
    }

}
