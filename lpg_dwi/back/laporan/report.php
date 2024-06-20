<?php 
	require_once '../library/vendor/autoload.php';
	include "../../koneksi/koneksi.php";
	session_start();
	date_default_timezone_set('Asia/Jakarta');

	// FUNGSI MENGAMPIL / MENAMPILKAN DATA DARI DATABASE
	function query_select($query){
		global $koneksi;
		$result 	= mysqli_query($koneksi,$query);
		$rows 		= [];

		while ($row = mysqli_fetch_assoc($result)){
			$rows[] = $row;

		}
		return $rows;
	}

	$tanggal_awal 	= $_GET['tgl_awal'];
	$tanggal_akhir 	= $_GET['tgl_akhir'];

	
	$data_query = query_select("SELECT * FROM tbl_transaksi  JOIN tbl_pemilik ON tbl_transaksi.id_pemilik = tbl_pemilik.id_pemilik JOIN tbl_produk ON tbl_transaksi.id_produk = tbl_produk.id_produk"); //MENAMPILKAN DATA LAPORAN DARI TBL_TRANSAKSI 

	// CEK PILIH PRODUK DAN TANGGAL AWAL DAN TANGGAL AKHIR
	if ($tanggal_awal != null && $tanggal_akhir != null) {
		// QUERY MENAMPILKAN DATA LAPORAN DARI TBL_TRANSAKSI WHERE KODE PRODUK BERDASARKAN FILTER TANGGAL AWAL DAN TANGGAL AKHIR 
		$data_query = query_select("SELECT * FROM tbl_transaksi JOIN tbl_pemilik ON tbl_transaksi.id_pemilik = tbl_pemilik.id_pemilik JOIN tbl_produk ON tbl_transaksi.id_produk = tbl_produk.id_produk WHERE tanggal BETWEEN '$tanggal_awal' AND '$tanggal_akhir'");
	}


	$mpdf = new \Mpdf\Mpdf();
	$html = '
		<html lang="en">
			<head>
			    <meta charset="UTF-8">
			    <meta name="viewport" content="width=device-width, initial-scale=1.0">
			    <title>Cetak laporan</title>
			    <style>
			        @page {
			            size: 8.5in 11in; 
			            margin-left:5%;
			            margin-right: 5%;
			            margin-top: 0;
			        }

			        table{
			            font-size: 8pt;
			        }
			    </style>
			</head>
			<body>
	';
	$html .= '
				<div class="header" align="center" style="border-bottom: 3px solid black; padding:10px;">
			        <small style="text-align:center; font-size:18px;color: black;">
			            LAPORAN KEUANGAN PANGKALAN GAS YANTI
			        </small><br>
			        <small style="text-align:center; font-size:12px;color: #ffab00;">
			            Kp.Kaum RT.10/02, Campakasari, Campaka, Kab.Purwakarta 087879933620
			        </small>
			    </div>
	';

	$html .= '
				<div class="wraper" style="margin-top: 10px;">
			        <div class="judul-laporan" style="font-size: 16px;font-weight: bold;text-align: left;margin-bottom: 2%;padding: 5px;">
			             LAPORAN KEUANGAN
			        </div>
			        <div class="content1">
			            <table cellspacing="0" width="100%" cellpadding="10">
			                 <tbody>
			                    <tr>
			                        <th align="left">PERIODE</th>
			                        <th>:</th>
			                        <td>'. date("d-m-Y",strtotime($tanggal_awal)) .' - '. date("d-m-Y",strtotime($tanggal_akhir)).'</td>
			                    </tr>
			                    <tr style="background-color: #e0e0e0;">
			                        <th align="left">TANGGAL CETAK</th>
			                        <th>:</th>
			                        <td>'.date("d-m-Y").'</td>
			                    </tr>
			                    <tr>
			                        <th align="left">NAMA PENCETAK</th>
			                        <th>:</th>
			                        <td>'.$_SESSION["username"].'</td>
			                    </tr>
			                
			                   
			                </tbody>
			            </table>
			        </div>
	';
	$html .= '
		<div class="content2" style="margin-top: 20px;">
             <table border="1" cellpadding="10" cellspacing="0" width="100%">
                <tr>
                    <th>No</th>
                    <th>Pemilik</th>
                    <th>Nama Produk</th>
                    <th>Tanggal</th>
                    <th>Keterangan</th>
                    <th>Jumlah</th>
                    <th>Total Harga</th>

                </tr>
	';
				$no = 1;
				$total = 0;
				$totalmasuk = 0;
                $totalkeluar = 0;
				foreach ($data_query as $dq) {
				$nama_lengkap = $dq['nama_lengkap'];
				$tanggal 	= date("d-m-Y",strtotime($dq["tanggal"]));
				$id_produk = $dq["id_produk"];
				$nama_produk = $dq["nama_produk"];
				$keterangan	= $dq['keterangan'];
				$jumlah 		= $dq['jumlah'];
				$total      = $dq['total_harga'];
                $html .= '
                	<tr>
                        <td>'. $no++ .'</td>
                        <td>'. $nama_lengkap .'</td>
                        <td>'. $nama_produk .'</td>
                        <td>'. $tanggal .'</td>
                        <td>'. $keterangan .'</td>
                        <td>'. $jumlah .'</td>
                        <td>'. number_format($total,0,",",".") .'</td>
                    </tr>
                ';
                	if ($dq["keterangan"] == "masuk") {
                    	$totalmasuk += $total; 
                    } else{
                        $totalkeluar += $total;
                    }

             
                }

    $html .= '
            <tr>
                <th colspan="6" align="right" ><right>Total Pemasukkan :</right></th>
                <th colspan="1">Rp. '. number_format($totalmasuk,0,",",".").'</th>
            </tr>
            <tr>
                <th colspan="6" align="right"><right>Total Pengeluaran :</right></th>
                <th colspan="1">Rp. '. number_format($totalkeluar,0,",",".").'</th>
            </tr>

    ';

	$html .= '
		</table>
        </div>
    </div>
    
</body>
</html>
	';
	$mpdf->WriteHTML($html);
	$mpdf->Output('laporan.pdf','I');

 ?>