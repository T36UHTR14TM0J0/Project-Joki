<?php  

defined('BASEPATH') OR exit('No direct script access allowed');
class Transaksi extends CI_Controller {

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

    public function index(){
		$this->data['title'] = "Transaksi";

        $data_tran = $this->ModelPosyandu->dataTerakhir('transaksi_periksa','id_transaksi');
        $transaksi_periksa = $this->ModelPosyandu->getData('transaksi_periksa', 'MAX(RIGHT(id_transaksi,3)) AS last');
        $lastId = array('last' => $transaksi_periksa[0]['last']);
        $last = implode("", $lastId);
        $kode = "";
        $baru = 1;
        if ($data_tran->num_rows() <> 0) {
            $baru = intval($last) + 1;
            $kode = str_pad($baru, 4, "0", STR_PAD_LEFT);
        }else{
        	$kode = 1;
        }
        $this->data['id_transaksi']	= date('dmY'). $kode;
	    $this->data['pasien']     = $this->ModelPosyandu->getData('resep_obat', '*',"GROUP BY id_registrasi");
	    $this->load->view('template/header',$this->data);
	    $this->load->view('template/sidebar');
	    $this->load->view('transaksi/v_transaksi');
	    $this->load->view('template/footer');
	}

	 public function ambil_data_pasien(){
        $id_registrasi = $_POST['id_registrasi'];
        $data = $this->ModelPosyandu->getData('pasien', '*',"JOIN registrasi ON registrasi.id_registrasi = pasien.id_registrasi WHERE pasien.id_registrasi = '$id_registrasi'");
        $id_pasien = $data[0]['id_pasien'];
        $data_pilih = array();
        if ($data) {
            if ($data[0]['jenis_pel'] == "pel_umum") {
            	$jenis_p = "Pemeriksaan Umum";
                 $data_p = $this->ModelPosyandu->getData("umum","*","WHERE id_pasien = '$id_pasien' ORDER BY id DESC LIMIT 1");
                $biaya_tindakan = $data_p[0]['biaya'];
            }else if ($data[0]['jenis_pel'] == "pel_kb"){
                $data_p = $this->ModelPosyandu->getData("kb","*","WHERE id_pasien = '$id_pasien'  ORDER BY id_kb DESC LIMIT 1");
                $biaya_tindakan = $data_p[0]['biaya'];
            	$jenis_p = "Pemeriksaan Kb";
            }else if  ($data[0]['jenis_pel'] == "pel_bayi"){
                 $data_p = $this->ModelPosyandu->getData("bayi","*","WHERE id_pasien = '$id_pasien'  ORDER BY id_bayi DESC LIMIT 1");
                 $biaya_tindakan = $data_p[0]['biaya'];
            	$jenis_p ="Pemeriksaan Bayi & Balita";
            }else{
            	$jenis_p = "Pemeriksaan Ibu Hamil";
                $data_p = $this->ModelPosyandu->getData("ibu_hamil","*","WHERE id_pasien = '$id_pasien'  ORDER BY id_bumil DESC LIMIT 1");
                $biaya_tindakan = $data_p[0]['biaya'];
            }

            $data_pilih = array(
            	'id_registrasi' => $data[0]['id_registrasi'],
            	'jenis_periksa' => $jenis_p,
                'biaya_tindakan' => $biaya_tindakan
            );
        }

        echo json_encode($data_pilih);

    }

     public function ambil_resep(){
        $id_registrasi = $_POST['id_registrasi'];
        $data = $this->ModelPosyandu->getData('obat', 'obat.id_obat,obat.nama_obat,resep_obat.jml_obat,obat.harga_jual,obat.satuan',"JOIN resep_obat ON obat.id_obat = resep_obat.id_obat WHERE resep_obat.id_registrasi = '$id_registrasi'");
        if ($data) {
            $data_pilih = array(
            	'resep_obat' => $data
            );
        }

        echo json_encode($data_pilih);

    }

    public function simpan(){
    	$id_transaksi_periksa  = $this->input->post('id_transaksi');
    	$tgl_transaksi_periksa = $this->input->post('tgl_transaksi');
    	$id_registrasi             = $this->input->post('id_registrasi');
    	$jenis_periksa         = $this->input->post('jenis_periksa');
    	$biaya                 = convert_to_number($this->input->post('biaya'));
    	$resep_obat            = $this->input->post('detDetail');
    	$total_transaksi       = convert_to_number($this->input->post('total_transaksi'));
    	$kembalian             = convert_to_number($this->input->post('kembalian'));
    	$uang                  = convert_to_number($this->input->post('uang'));
    	$juml                  = count($resep_obat);


        $data_tran = $this->ModelPosyandu->dataTerakhir('transaksi_obat','id_transaksi');
        $transaksi = $this->ModelPosyandu->getData('transaksi_obat', 'MAX(RIGHT(id_transaksi,3)) AS last');
        $lastId = array('last' => $transaksi[0]['last']);
        $last = implode("", $lastId);
        $kode = "";
        $baru = 1;
        $transaksi_periksa = array(
        	'id_transaksi'	=> $id_transaksi_periksa,
        	'tgl_transaksi'	=> $tgl_transaksi_periksa,
        	'id_registrasi'		=> $id_registrasi,
        	'jenis_periksa' => $jenis_periksa,
        	'biaya'			=> $biaya	
        );
      
        $Transaksi_obat = array();
        $i = 0;
        foreach ($resep_obat as $key => $vals) {
        	$i++;
        	if ($data_tran->num_rows() <> 0) {
	            $baru = intval($last) + $i;
	            $kode = str_pad($baru, 4, "0", STR_PAD_LEFT);
	        }else{
	        	$kode = 1;
	        } 
			$id_transaksi   = 'TRAN' . $kode;
			$id_obat		= $vals["id_obat"];
			$nama_obat		= $vals["nama_obat"];
			$qty 			= $vals["jml_obat"];
			$harga			= convert_to_number($vals["harga"]);
            $satuan          = $vals["satuan"];
            $total_h_obat   = convert_to_number($vals['total_h_obat']);
			$Transaksi_obat[$i]	= array(
                            'id_transaksi'	        => $id_transaksi,
                            'tgl_transaksi'  		=> $tgl_transaksi_periksa,
                            'id_user'				=> $this->session->userdata('id_user'),
			            	'id_obat'				=> $id_obat,
			            	'nama_obat'				=> $nama_obat,
			            	'qty'					=> $qty,
			            	'harga'					=> $harga,
			            	'satuan'				=> $satuan,
			            	'status'				=> 'masuk'
            );

            $ambil_stok = $this->ModelPosyandu->getData('obat','*',"WHERE id_obat = '$id_obat'");
            $stok = $ambil_stok[0]['stok'] - $qty;
            $update_obat = array(
                'stok' => $stok
            );
            $where = array('id_obat' => $id_obat);
            $this->ModelPosyandu->UpdateData('obat', $update_obat, $where);
            $where = array('id_obat' => $id_obat);
            $res = $this->ModelPosyandu->HapusData('resep_obat', $where);
        }
    


		$this->db->trans_begin();
        $this->db->insert('transaksi_periksa',$transaksi_periksa);
		if($Transaksi_obat){
			$this->db->insert_batch('transaksi_obat',$Transaksi_obat);   
		}

		if ($this->db->trans_status() !== TRUE){
			$this->db->trans_rollback();
			$Arr_Return		= array(
				'status'    => 2,
				'pesan'		=> 'Proses transaksi gagal. Silahkan coba kembali...'
		);
            $this->session->set_userdata('notif_gagal', 'Proses transaksi gagal.Silahkan coba kembali...');
		}else{
			$this->db->trans_commit();
			$Arr_Return		= array(
                
                'id_transaksi' => $id_transaksi_periksa,
                'uang'         => $uang,
                'kembalian'     => $kembalian,
                'jml'           => $juml,
				'status'	=> 1,
				'pesan'		=> 'Proses transaksi sukses...'
			);
			$this->session->set_userdata('notif_sukses', 'Proses transaksi sukses...');
		}

		echo json_encode($Arr_Return);
    }

    public function print_struk(){
        
        $id_transaksi_periksa       = $this->uri->segment(3);
        $this->data['uang']         = $this->uri->segment(4);
        $this->data['kembalian']    = $this->uri->segment(5);
        $limit                      = $this->uri->segment(6);
        $this->data['row_periksa']  = $this->ModelPosyandu->getData('transaksi_periksa','*',"WHERE id_transaksi = '$id_transaksi_periksa'");
        $this->data['row_obat']     = $this->ModelPosyandu->getData('transaksi_obat','*',"ORDER BY id_transaksi DESC LIMIT $limit");
        $this->data['logo']         = base_url('assets/images/logo-ulfi.png');
        $this->data['logo_ibi']         = base_url('assets/images/logo-ibi.png');
        $this->data['title']        = 'PRINT STRUK';
        // $this->load->library('m_pdf');
        require_once __DIR__ .'/../third_party/vendor/autoload.php';
        $mpdf = new \Mpdf\Mpdf([
                    'mode' => 'utf-8', 
                    'format' => [150,250]
        ]);
        $html = $this->load->view("transaksi/Struk",$this->data,true);
        $mpdf->WriteHTML($html);
        $mpdf->Output("bukti_transaksi_".$id_transaksi_periksa.".pdf" ,'I');
    
    }

}


?>