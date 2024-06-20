<?php 
	require_once("../library/dompdf/autoload.inc.php");
	include "../koneksi.php";
	date_default_timezone_set('Asia/Jakarta');


	use Dompdf\Dompdf;
	$dompdf 	 = new DOMPDF();	
	$int 		 = 1;
	$tanggal     = date('Y-m-d H:i:s');

	$id 		 = $_GET["id"];
	$nama_kasir	 = $_GET["nama_kasir"];
	$bayar 		 = $_GET["bayar"];
	$kembalian 	 = $_GET["kembalian"];
	$total_pesan = 0;
	$total_harga = 0;

	$data_transaksi = mysqli_query($koneksi,"SELECT * FROM tbl_transaksi WHERE kode_transaksi = '$id' ");
	
	
 
 $html = '
 <head>
 	<title>Print</title>
 </head>
 <body style="font-family: tahoma;font-size: 10pt;">
 	<center>
		<table style="width: 350px;font-size: 14pt;font-family: calibri;border-collapse: collapse;border:0;margin:auto;">
			<td  align="center" vertical-align="top"><span style="color: black">
				<b style="font-size: 22pt">TOKO KURNIA</b><br>
				Jl.Raya Sadang Subang Rt 04 Rw 03, Kel.Ciseureuh,Kec.Purwakarta,Kab.Purwakarta,Jawa Barat,Indonesia
			</span></td>
		</table>
	</center>

<br><br>
	<b>
		<table>
			<tr>
				<td>No Transaksi</td>
				<td>:</td>
				<td>'. $id .'</td>
			</tr>
			<tr>
				<td>Tanggal / Jam</td>
				<td>:</td>
				<td>'. $tanggal . '</td>
			</tr>

			<tr>
				<td>Kasir</td>
				<td>:</td>
				<td>'. $nama_kasir. '</td>
			</tr>
			
		</table>
		</b>	
		<br>
 	<div class="table" style=" width: 100%; margin: auto;">
 		<table  cellspacing="0" cellpadding="5" style="width: 100%; margin-bottom: 20px; border-collapse:collapse;">
 			<tr style="border-top:2px solid black;border-bottom:2px solid black;">
 				<th>NO</th>
 				<th>KODE PRODUK</th>
 				<th>NAMA PRODUK</th>
 				<th>HARGA</th>
 				<th>QTY</th>
 				<th>SUB TOTAL</th>
 			</tr>';
 			 while ($row_detail = mysqli_fetch_array($data_transaksi)) {
 			 	$total_harga = $row_detail["qty"] * $row_detail["harga"];
 			 	$total_pesan += $total_harga;
 			$html .= '<tr>
 					<td align="center">'. $int++ .'</td>
 					<td align="center">'. $row_detail["kode_product"] .'</td>
 					<td align="center">'. $row_detail["nama_product"] .'</td>
 					<td align="center">'. number_format($row_detail["harga"],0,',','.') .'</td>
 					<td align="center">'. $row_detail["qty"] .'</td>
 					<td align="center">'. number_format($total_harga,0,',','.') .'</td>
 				</tr>

 				
 				';
			 } 
		$html .= '	 <tr style="border-top:2px solid black;">
			 			<td colspan="4" align="right">BAYAR</td>
			 			<td align="right"> : Rp.</td>
			 			<td align="right">'.number_format($bayar,0,',','.').'</td>
			 		</tr>
			 		<tr>
			 			<td  colspan="4" align="right">TOTAL</td>
			 			<td align="right"> : Rp.</td>
			 			<td align="right">'.number_format($total_pesan,0,',','.').'</td>
			 		</tr>
			 		<tr>
			 			<td  colspan="4" align="right">KEMBALIAN</td>
			 			<td align="right"> : Rp.</td>
			 			<td align="right">'.number_format($kembalian,0,',','.').'</td>
			 		</tr>
 	</table>
 	</div>
 	<center>
 	<h5>***** TERIMA KASIH *****</h5>
 	</center>
 	
 </body>
 </html>';
$dompdf->setPaper('A5','potrait');
 $dompdf->load_html($html);
 $dompdf->render();
 $stream = $dompdf->stream("laporan.pdf",array("Attachment"=>0));

 ?>