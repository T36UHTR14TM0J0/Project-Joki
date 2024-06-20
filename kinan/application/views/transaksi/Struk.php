<?php            
    if($row_periksa){
        foreach ($row_periksa as $rp) {
            $id_transaksi   = $rp['id_transaksi'];
            $tgl_transaksi  = $rp['tgl_transaksi'];
            $id_registrasi  = $rp['id_registrasi'];
            $biaya          = $rp['biaya'];

        }

        $data_pasien = $this->ModelPosyandu->getData('pasien','*',"WHERE id_registrasi='$id_registrasi'");
        $nama_pasien = $data_pasien[0]['nama_pasien'];
        $id_pasien = $data_pasien[0]['id_pasien'];
        $jenis_p        = $data_pasien[0]['jenis_pel'];
        $penanggung_jawab = $this->session->userdata['nama_lengkap'];

        
    }

    if ($jenis_p === 'pel_kb') {
            $pel_kb = $this->ModelPosyandu->getData('kb','tgl_kembali',"WHERE id_pasien='$id_pasien'");
            $tgl_kembali = $pel_kb[0]['tgl_kembali'];
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?=$title;?></title>
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

    <div class="header" align="center" style="border-bottom: 3px solid #64b5f6; padding:10px;display: inline-block;">
        <div align="center" style="margin-bottom: 10px;">
            <img style="width: 100px;" src="<?php echo $logo; ?>" alt="fdhfg">
            <img style="width: 100px;" src="<?php echo $logo_ibi; ?>" alt="fdhfg">
        </div>
        <small style="text-align:center; font-size:18px;color: #64b5f6;">
            &nbsp;Bidan&nbsp;Ulfi&nbsp;Karina&nbsp;Hasanah&nbsp;amd.keb
        </small><br>
        <small style="text-align:center; font-size:12px;color: #ffab00;">
            Kp&nbsp;Maswati&nbsp;Rt.002/Rw.007&nbsp;Desa&nbsp;Kanangasari,&nbsp;Kec.Cikalong Wetan
        </small>
    </div>
   

    <div class="wraper" style="margin-top: 10px;">
        <div class="judul-laporan" style="font-size: 16px;font-weight: bold;text-align: left;margin-bottom: 2%;padding: 5px;background-color: #64b5f6;color: white;">
             BUKTI TRANSAKSI 
        </div>

        <div class="content1">
             <table cellspacing='0' width="100%" cellpadding="10">
                 <tbody>
                    <tr>
                        <th colspan="3" align="right" style="text-transform: uppercase;">Kasir : <?php echo $penanggung_jawab;?></th>
                    </tr>
                    <tr style="background-color: #e0e0e0;">
                        <th align="left">ID TRANSAKSI</th>
                        <th>:</th>
                        <td><?= $id_transaksi;?></td>
                    </tr>
                
                    <tr>
                        <th align="left">TANGGAL TRANSAKSI</th>
                        <th>:</th>
                        <td><?=date('d M Y',strtotime($tgl_transaksi));?></td>
                    </tr>

                    <tr style="background-color: #e0e0e0;">
                        <th align="left">NAMA LENGKAP</th>
                        <th>:</th>
                        <td><?=$nama_pasien;?></td>
                    </tr>
                    
                    <tr>
                        <th align="left">JENIS PEMERIKSAAN</th>
                        <th>:</th>
		                <td><?=$jenis_p;?></td>
                    </tr>

                    <?php if ($jenis_p === 'pel_kb'): ?>
                    <tr>
                        <th align="left">TANGGAL KEMBALI</th>
                        <th>:</th>
                        <td><?=date('d-m-Y',strtotime($tgl_kembali));?></td>
                    </tr>
                    <?php endif ?>

                    <tr>
                        <th align="left">BIAYA TINDAKAN</th>
                        <th>:</th>
		                <td><?php echo 'Rp.'.$biaya; ?></td>
                    </tr>
                  
                </tbody>
            </table>
        </div>

        <div class="content2" style="margin-top: 20px;">
            <table cellpadding="10" cellspacing='0' width="100%">
                <tr style="background-color: #64b5f6;">
                    <th style="color: white;">NO</th>
                    <th style="color: white;">ID OBAT</th>
                    <th style="color: white;">NAMA OBAT</th>
                    <th style="color: white;">JUMLAH</th>
                    <th style="color: white;">SATUAN</th>
                    <th style="color: white;">HARGA</th>
                    <th style="color: white;">TOTAL</th>
                </tr>
                
                 <?php
                    $no = 1;
                    $sub_total = 0;
                    $total = 0;
                    $total_transaksi = 0;
                    foreach($row_obat as $ro){
                        $id_obat        = $ro['id_obat'];
                        $nama_obat      = $ro['nama_obat'];
                        $qty            = $ro['qty'];
                        $satuan         = $ro['satuan'];
                        $harga          = $ro['harga'];
                        $sub_total      = $harga * $qty; 
                        $total          += $sub_total; 

                        if($no % 2 == 0){
                            $color = 'white';
                        } else{
                            $color = '#e0e0e0';
                        }
                        
                        echo '
                            <tr style="background-color: '.$color.';">
                                <td align="center">'.$no++.'</td>
                                <td align="center">'.$id_obat.'</td>
                                <td align="center">'.$nama_obat.'</td>
                                <td align="center">'.$qty.'</td>
                                <td align="center">'.$satuan.'</td>
                                <td align="center">Rp.'.number_format($harga,0,',','.').'</td>
                                <td align="center">Rp.'.number_format($sub_total,0,',','.').'</td>
                            </tr>
                        ';
                    }

                    $total_transaksi = $biaya + $total;
                ?>

                <tr>
                    <td colspan="5" align="right" ><b>TOTAL TRANSAKSI</b></td>
                    <td align="center"><b>:</b></td>
                    <td align="center"><b><?php echo "Rp.".number_format($total_transaksi,0,',','.'); ?></b></td>
                </tr>
                 <tr>
                    <td colspan="5" align="right" ><b>PEMBAYARAN</b></td>
                    <td align="center"><b>:</b></td>
                    <td align="center"><b><?php echo "Rp.".number_format($uang,0,',','.') ?></b></td>
                </tr>
                 <tr>
                    <td colspan="5" align="right" ><b>KEMBALIAN</b></td>
                    <td align="center"><b>:</b></td>
                    <td align="center"><b><?php echo "Rp.".number_format($kembalian,0,',','.') ?></b></td>
                </tr>
                
                
            </table>
        </div>
        <div class="content3" style="margin-top: 30px;color:#64b5f6;text-align: center;">
            <center><b><i><h2>***** Terima Kasih *****</h2></i></b></center>
        </div>
    </div>
    
</body>
</html>