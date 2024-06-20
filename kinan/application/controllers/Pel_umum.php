<?php  

defined('BASEPATH') OR exit('No direct script access allowed');

class Pel_umum extends CI_Controller {

    public function __construct() {
        parent::__construct();
        if ($this->session->userdata('status') != "login") {
            $this->session->set_userdata("notif_gagal","Silahkan login terlebih dahulu!");
            redirect(base_url("Welcome"));
        } 
        $this->load->model('ModelPosyandu');
        $this->load->helper('convert_number');
        $this->data = array();
        $Arr_Return = array();
    
    }

// ################## FUNGSI INDEX / MENAMPILKAN FILE BAYI ######################## //
    public function index() {
        
        $this->data['data_pel_biasa'] = $this->ModelPosyandu->getData('umum', '*','JOIN pasien ON umum.id_pasien = pasien.id_pasien ORDER BY umum.tgl_periksa DESC');
        $this->data['title']    = "Pemeriksaan Umum";
        $this->load->view('template/header',$this->data);
        $this->load->view('template/sidebar');
        $this->load->view('pel_umum/v_pel_umum');
        $this->load->view('template/footer');
    }
// ################## END FUNGSI INDEX ########################################## //

    public function ambil_data_pasien(){
        $id_registrasi = $_POST['id_registrasi'];
        $data = $this->ModelPosyandu->getData('pasien', '*',"JOIN registrasi ON registrasi.id_registrasi = pasien.id_registrasi WHERE pasien.id_registrasi = '$id_registrasi'");
        $data_pilih = array();
        if ($data) {
            $data_pilih = array(
                'nama_pasien' => $data[0]["nama_pasien"]
            );
        }

        echo json_encode($data_pilih);

    }



// ############ FUNGSI ADD / MENAMPILKAN FORM TAMBAH DATA BAYI ################# //
    public function add() {
        $data   = $this->ModelPosyandu->dataTerakhir('umum','id');
        $data_kb= $this->ModelPosyandu->getData('umum', 'MAX(RIGHT(id,3)) AS last');
        $lastId = array('last' => $data_kb[0]['last']);
        $last   = intval(implode("", $lastId));
        $kode   = "";
        $baru   = 1;

        if ($data->num_rows() > 0) {
            $baru = $last + 1;
            $kode = str_pad($baru, 3, "0", STR_PAD_LEFT);
        }
        $this->data['title']  = 'Form Tambah';
        $this->data['id']     = 'U' . $kode;
        $this->data['pasien'] = $this->ModelPosyandu->getData('pasien', '*','JOIN registrasi ON registrasi.id_registrasi = pasien.id_registrasi WHERE jenis_pel = "pel_umum"');
        $this->data['obat']   = $this->ModelPosyandu->getData('obat', '*');
        $this->load->view('template/header',$this->data);
        $this->load->view('template/sidebar');
        $this->load->view('pel_umum/v_add');
        $this->load->view('template/footer');
    }
// ############################# END FUNGSI ADD ############################### //


// ################## FUNGSI PROSES TAMBAH ######################## //
    public function processAdd() {
       

        $id             = $this->input->post('id');
        $tgl_periksa    = $this->input->post('tgl_periksa');
        $id_pasien      = $this->input->post('id_pasien');
        $nama_pasien    = $this->input->post('nama_pasien');
        $keluhan        = $this->input->post('keluhan');
        $tb             = str_replace(',', '.',$this->input->post('tb'));
        $bb             = str_replace(',', '.',$this->input->post('bb'));
        $td             = str_replace(',', '.',$this->input->post('td'));
        $biaya          = convert_to_number($this->input->post('biaya'));
        $tambah_data = array(
            'id'            => $id, 
            'tgl_periksa'   => $tgl_periksa,
            'id_pasien'     => $id_pasien, 
            'nama_pasien'   => $nama_pasien,
            'keluhan'       => $keluhan,
            'tb'            => $tb,
            'bb'            => $bb,
            'td'            => $td,
            'biaya'         => $biaya
        );
                
        $res      = $this->ModelPosyandu->addData('umum', $tambah_data);
        if ($res >= 1) {
            $this->session->set_userdata("notif_sukses","Data berhasil di tambahkan ...");
            redirect('pel_umum');
        }else{
            $this->session->set_userdata("notif_gagal","Data gagal di tambahkan ...");
            redirect('pel_umum/add');
        }

    }
// ################## END FUNGSI PROSES TAMBAH ######################## //

     public function edit($id) {
         $data['data_pel_biasa'] = $this->ModelPosyandu->getData('umum', '*',"JOIN pasien ON umum.id_pasien = pasien.id_pasien WHERE umum.id = '$id'");
            $this->data['title'] = 'Form Edit';
            $this->load->view('template/header',$this->data);
            $this->load->view('template/sidebar');
            $this->load->view('pel_umum/v_edit',$data);
            $this->load->view('template/footer');
    }

    public function doUpdate() {
        $id             = $this->input->post('id');
        $tgl_periksa    = $this->input->post('tgl_periksa');
        $id_pasien      = $this->input->post('id_pasien');
        $nama_pasien    = $this->input->post('nama_pasien');
        $keluhan        = $this->input->post('keluhan');
        $tb             = str_replace(',', '.',$this->input->post('tb'));
        $bb             = str_replace(',', '.',$this->input->post('bb'));
        $td             = str_replace(',', '.',$this->input->post('td'));
        $biaya          = convert_to_number($this->input->post('biaya'));

    
            
        if (!isset($id) || trim($id) == '') 
        {
            $this->session->set_userdata("notif_gagal","Data gagal diedit ...");
            redirect('pel_umum/edit/' . $id);
        } else {
            $update_data = array( 
               'tgl_periksa'   => $tgl_periksa, 
                'nama_pasien'  => $nama_pasien,
                'keluhan'      => $keluhan,
                'tb'            => $tb,
                'bb'            => $bb,
                'td'            => $td,
                'biaya'         => $biaya

            );


            $where  = array('id' => $id);
            $res    = $this->ModelPosyandu->UpdateData('umum', $update_data, $where);
            if ($res >= 1) {
                $this->session->set_userdata("notif_sukses","Data berhasil diedit ...");
                redirect('pel_umum');
            }else{
                $this->session->set_userdata("notif_gagal","Data gagal diedit ...");
                redirect('pel_umum/edit/' . $id);
            }
        }
    }

     public function detail($id) {
            $data['data_pel_biasa'] = $this->ModelPosyandu->getData('umum', '*',"JOIN pasien ON umum.id_pasien = pasien.id_pasien WHERE umum.id= '$id'");
            $this->data['title'] = 'Detail Pelayanan umum';
            $this->load->view('template/header',$this->data);
            $this->load->view('template/sidebar');
            $this->load->view('pel_umum/v_detail',$data);
            $this->load->view('template/footer');
    }

    public function delete($id) {
        $where = array('id' => $id);
        $res = $this->ModelPosyandu->HapusData('umum', $where);
        if ($res >= 1) {
            $this->session->set_userdata("notif_sukses","Data berhasil di hapus ...");
            redirect('pel_umum');
        }else{
            $this->session->set_userdata("notif_gagal","Data gagal di hapus !");
            redirect('pel_umum');
        }
    }

}
