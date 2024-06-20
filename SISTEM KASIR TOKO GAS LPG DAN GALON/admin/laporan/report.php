<?php 
// ======================================================================================================================================//
//                                                    HALAMAN REPORT LAPORAN TRANSAKSI 			                                         //
// ======================================================================================================================================//
	ob_start();
	include "../koneksi.php";
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


	// DEKLARASI VARIABEL HASIL GET PADA URL KODE PRODUK,TANGGAL AWAL DAN TANGGAL AKHIR
	$kode_produk = $_GET["kode_produk"];
	$tgl_awal 	 = $_GET["tgl_awal"];
	$tgl_akhir 	 = $_GET["tgl_akhir"];
	$total 		 = 0;
	$sess_user	 = $_SESSION["username"];
	$tgl_cetak   = date('d-M-Y');


	$data_query = query_select("SELECT * FROM tbl_transaksi"); //MENAMPILKAN DATA LAPORAN DARI TBL_TRANSAKSI 

	// CEK PILIH PRODUK DAN TANGGAL AWAL DAN TANGGAL AKHIR
	if (isset($kode_produk) && isset($tgl_awal) && isset($tgl_akhir)) {
		// QUERY MENAMPILKAN DATA LAPORAN DARI TBL_TRANSAKSI WHERE KODE PRODUK BERDASARKAN FILTER TANGGAL AWAL DAN TANGGAL AKHIR 
		$data_query = query_select("SELECT * FROM tbl_transaksi WHERE kode_product = '$kode_produk' AND tanggal BETWEEN '$tgl_awal' AND '$tgl_akhir'");
	}

	if ($kode_produk == 'All') {
		// QUERY MENAMPILKAN SELURUH DATA LAPORAN DARI TBL_TRANSAKSI BERDASARKAN FILTER TANGGAL AWAL DAN TANGGAL AKHIR
		$data_query = query_select("SELECT * FROM tbl_transaksi WHERE tanggal BETWEEN '$tgl_awal' AND '$tgl_akhir'");
	}
	


	// MEMANGGIL FILE LIBRARY PHPEXCEL
	require_once "../library/PHPExcel/PHPExcel.php";
	// require_once '../library/PHPExcel/PHPExcel/Writer/Excel2007.php';
	
	// CLASS BARU
	$excel = new PHPExcel();
	
			##### SETTINGAN AWAL FILE EXCEL ######
			$excel->getProperties()->setCreator('Toko Kurnia')
            	->setLastModifiedBy('Toko Kurnia')
                ->setTitle("Data Laporan Pemasukan dan Pengeluaran")
                ->setSubject("Data Laporan Pemasukan dan Pengeluaran")
                ->setDescription("Data Laporan Pemasukan dan Pengeluaran")
                ->setKeywords("Data Laporan Pemasukan dan Pengeluaran");

            ##### PENGATURAN STYLE DARI HEADER TABEL ######
			$style_col = array(
				'font'       => array('bold' => true),
				'alignment'  => array(
					'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
					'vertical'   => PHPExcel_Style_Alignment::VERTICAL_CENTER
				),
				'borders'    => array(
					'top'        => array('style'  => PHPExcel_Style_Border::BORDER_THIN),
					'right'      => array('style'  => PHPExcel_Style_Border::BORDER_THIN),
					'bottom'     => array('style'  => PHPExcel_Style_Border::BORDER_THIN),
					'left'       => array('style'  => PHPExcel_Style_Border::BORDER_THIN)
				)
			);

			##### PENGATURAN STYLE DARI ISI TABEL ######
			$style_row = array(
				'alignment'  => array(
					'vertical'   => PHPExcel_Style_Alignment::VERTICAL_CENTER 
				),
				'borders'    => array(
					'top'        => array('style'  => PHPExcel_Style_Border::BORDER_THIN),
					'right'      => array('style'  => PHPExcel_Style_Border::BORDER_THIN),
					'bottom'     => array('style'  => PHPExcel_Style_Border::BORDER_THIN), 
					'left'       => array('style'  => PHPExcel_Style_Border::BORDER_THIN) 
				)
			);

			##### PENGATURAN KOLOM A1 ######
			$excel->setActiveSheetIndex(0)->setCellValue('A1', "TOKO KURNIA");
			$excel->getActiveSheet()->mergeCells('A1:G1');
			$excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(TRUE); 
			$excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(15);
			$excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

			##### PENGATURAN KOLOM A2 ######
			$excel->setActiveSheetIndex(0)->setCellValue('A2', "DATA LAPORAN PEMASUKAN DAN PENGELUARAN");
			$excel->getActiveSheet()->mergeCells('A2:G2');
			$excel->getActiveSheet()->getStyle('A2')->getFont()->setBold(TRUE); 
			$excel->getActiveSheet()->getStyle('A2')->getFont()->setSize(15);
			$excel->getActiveSheet()->getStyle('A2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);


			##### PENGATURAN KOLOM A3 ######
			$excel->setActiveSheetIndex(0)->setCellValue('A3', "Tanggal : $tgl_cetak");
			$excel->getActiveSheet()->getStyle('A3')->getFont()->setBold(TRUE); 
			$excel->getActiveSheet()->mergeCells('A3:C3');

			$excel->setActiveSheetIndex(0)->setCellValue('A4', "Kasir : $sess_user");
			$excel->getActiveSheet()->getStyle('A4')->getFont()->setBold(TRUE); 
			$excel->getActiveSheet()->mergeCells('A4:C4');

			$tanggal_awal = DATE('d M Y',strtotime($tgl_awal));
			$tanggal_akhir = DATE('d M Y',strtotime($tgl_akhir));
			$excel->setActiveSheetIndex(0)->setCellValue('D5', "Periode :$tanggal_awal - $tanggal_akhir");
			$excel->getActiveSheet()->mergeCells('D5:F5');
			$excel->getActiveSheet()->getStyle('D5')->getFont()->setBold(TRUE);
			$excel->getActiveSheet()->getStyle('D5')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); 

		


			##### PENGATURAN STYLE HEADER DARI BARIS KE 4 TABEL ######
			$excel->setActiveSheetIndex(0)->setCellValue('A6', "NO");
			$excel->setActiveSheetIndex(0)->setCellValue('B6', "Id User");
			$excel->setActiveSheetIndex(0)->setCellValue('C6', "Tanggal");
			$excel->setActiveSheetIndex(0)->setCellValue('D6', "Kode Produk");
			$excel->setActiveSheetIndex(0)->setCellValue('E6', "Nama Produk");
			$excel->setActiveSheetIndex(0)->setCellValue('F6', "Kategori");
			$excel->setActiveSheetIndex(0)->setCellValue('G6', "qty");
			$excel->setActiveSheetIndex(0)->setCellValue('H6', "Harga");
			$excel->setActiveSheetIndex(0)->setCellValue('I6', "Total");

			##### PENGATURAN STYLE HEADER DARI BARIS KE 4 TABEL ######
			$excel->getActiveSheet()->getStyle('A6')->applyFromArray($style_col);
			$excel->getActiveSheet()->getStyle('B6')->applyFromArray($style_col);
			$excel->getActiveSheet()->getStyle('C6')->applyFromArray($style_col);
			$excel->getActiveSheet()->getStyle('D6')->applyFromArray($style_col);
			$excel->getActiveSheet()->getStyle('E6')->applyFromArray($style_col);
			$excel->getActiveSheet()->getStyle('F6')->applyFromArray($style_col);
			$excel->getActiveSheet()->getStyle('G6')->applyFromArray($style_col);
			$excel->getActiveSheet()->getStyle('H6')->applyFromArray($style_col);
			$excel->getActiveSheet()->getStyle('I6')->applyFromArray($style_col);

				##### MENAMPILKAN SEMUA DATA DARI DATABASE ######
			$no 			= 1;
			$numrow 		= 7;
			$tmasuk_row 	= count($data_query) + 7;
			$tkeluar_row 	= count($data_query) + 8;
			$tlaba_row		= count($data_query) + 9;
			$trugi_row	 	= count($data_query) + 10;
			$totalmasuk 	='';
			$totalkeluar 	= '';
			$laba 			= 0;
			$rugi			= 0;
			foreach($data_query as $row){
				
				##### MENANGKAP DATA DARI ROW ######
				$excel->setActiveSheetIndex(0)->setCellValue('A'.$numrow, $no);
				$excel->setActiveSheetIndex(0)->setCellValue('B'.$numrow, $row["id_user"]);
				$excel->setActiveSheetIndex(0)->setCellValue('C'.$numrow, DATE('d M Y',strtotime($row["tanggal"])));
				$excel->setActiveSheetIndex(0)->setCellValue('D'.$numrow, $row["kode_product"]);
				$excel->setActiveSheetIndex(0)->setCellValue('E'.$numrow, $row["nama_product"]);
				$excel->setActiveSheetIndex(0)->setCellValue('F'.$numrow, $row["kategori"]);
				$excel->setActiveSheetIndex(0)->setCellValue('G'.$numrow, number_format($row["qty"]));
				$excel->setActiveSheetIndex(0)->setCellValue('H'.$numrow, number_format($row["harga"]));
				$total = $row["qty"] * $row["harga"];
				$excel->setActiveSheetIndex(0)->setCellValue('I'.$numrow, number_format($total));
				if ($row["kategori"] == "in") {
                    $totalmasuk+= $total; 
                } else{
                    $totalkeluar += $total;
                }
				
				 if($totalmasuk > $totalkeluar){
                    $laba = $totalmasuk - $totalkeluar;
                 }else{
                    $rugi = $totalkeluar- $totalmasuk;
                  }
				

				##### APPLY STYLE ROW / ISI ######
				$excel->getActiveSheet()->getStyle('A'.$numrow)->applyFromArray($style_row);
				$excel->getActiveSheet()->getStyle('B'.$numrow)->applyFromArray($style_row);
				$excel->getActiveSheet()->getStyle('C'.$numrow)->applyFromArray($style_row);
				$excel->getActiveSheet()->getStyle('D'.$numrow)->applyFromArray($style_row);
				$excel->getActiveSheet()->getStyle('E'.$numrow)->applyFromArray($style_row);
				$excel->getActiveSheet()->getStyle('F'.$numrow)->applyFromArray($style_row);
				$excel->getActiveSheet()->getStyle('G'.$numrow)->applyFromArray($style_row);
				$excel->getActiveSheet()->getStyle('H'.$numrow)->applyFromArray($style_row);
				$excel->getActiveSheet()->getStyle('i'.$numrow)->applyFromArray($style_row);

				
				
				$no++;
				$numrow++;
			}

			$excel->setActiveSheetIndex(0)->setCellValue('H'.$tmasuk_row, 'Total Pemasukkan (in)');
			$excel->getActiveSheet()->getStyle('H'.$tmasuk_row)->getFont()->setBold(TRUE); 
			$excel->getActiveSheet()->getStyle('H'.$tmasuk_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

			$excel->setActiveSheetIndex(0)->setCellValue('I'.$tmasuk_row, "Rp. " . number_format($totalmasuk,0,',','.'));
			$excel->getActiveSheet()->getStyle('I'.$tmasuk_row)->getFont()->setBold(TRUE); 

			$excel->setActiveSheetIndex(0)->setCellValue('H'.$tkeluar_row, 'Total Pengeluaran (out)');
			$excel->getActiveSheet()->getStyle('H'.$tkeluar_row)->getFont()->setBold(TRUE); 
			$excel->getActiveSheet()->getStyle('H'.$tkeluar_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

			$excel->setActiveSheetIndex(0)->setCellValue('I'.$tkeluar_row, "Rp. " . number_format($totalkeluar,0,',','.'));
			$excel->getActiveSheet()->getStyle('I'.$tkeluar_row)->getFont()->setBold(TRUE); 

			$excel->setActiveSheetIndex(0)->setCellValue('H'.$tlaba_row, 'Laba');
			$excel->getActiveSheet()->getStyle('H'.$tlaba_row)->getFont()->setBold(TRUE); 
			$excel->getActiveSheet()->getStyle('H'.$tlaba_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

			$excel->setActiveSheetIndex(0)->setCellValue('I'.$tlaba_row, "Rp. " . number_format($laba,0,',','.'));
			$excel->getActiveSheet()->getStyle('I'.$tlaba_row)->getFont()->setBold(TRUE); 

			$excel->setActiveSheetIndex(0)->setCellValue('H'.$trugi_row, 'Rugi');
			$excel->getActiveSheet()->getStyle('H'.$trugi_row)->getFont()->setBold(TRUE); 
			$excel->getActiveSheet()->getStyle('H'.$trugi_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

			$excel->setActiveSheetIndex(0)->setCellValue('I'.$trugi_row, "Rp. " . number_format($rugi,0,',','.'));
			$excel->getActiveSheet()->getStyle('I'.$trugi_row)->getFont()->setBold(TRUE); 



			 ##### PENGATURAN WIDTH KOLOM TABEL ######
			  $excel->getActiveSheet()->getColumnDimension('A')->setWidth(5);
			  $excel->getActiveSheet()->getColumnDimension('B')->setWidth(10);
			  $excel->getActiveSheet()->getColumnDimension('C')->setWidth(25);
			  $excel->getActiveSheet()->getColumnDimension('D')->setWidth(35);
			  $excel->getActiveSheet()->getColumnDimension('E')->setWidth(25); 
			  $excel->getActiveSheet()->getColumnDimension('F')->setWidth(15);
			  $excel->getActiveSheet()->getColumnDimension('G')->setWidth(15);
			  $excel->getActiveSheet()->getColumnDimension('H')->setWidth(30);
			  $excel->getActiveSheet()->getColumnDimension('I')->setWidth(30);

			  ##### Set height semua kolom menjadi auto ######
			  $excel->getActiveSheet()->getDefaultRowDimension()->setRowHeight(-1);
		
			  ##### Set orientasi kertas jadi LANDSCAPE ######
			  $excel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);
  
			  ##### Set judul file excel nya #####
			  $excel->getActiveSheet(0)->setTitle("Laporan Toko Kurnia");
			  $excel->setActiveSheetIndex(0);

			  $file = DATE('d-M-Y',strtotime($tgl_awal));
			  $file .= "_";
			  $file .=  DATE('d-M-Y',strtotime($tgl_akhir));
			  $file	.= "_Laporan_toko_kirana";
			  $file  .= ".xlsx";
			  ##### PROSES FILE EXCEL #####
			  header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
			  header("Content-Disposition: attachment; filename=$file");
			  header('Cache-Control: max-age=0');
			  $write = PHPExcel_IOFactory::createWriter($excel, 'Excel2007');
			  ob_end_clean();
			  $write->save('php://output');
			  exit;

 ?>