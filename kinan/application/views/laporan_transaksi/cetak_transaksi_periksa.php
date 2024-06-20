<?php            

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

    <div class="header" align="center" style="border-bottom: 3px solid #64b5f6; padding:10px;">
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
             LAPORAN DATA TRANSAKSI PERIKSA 
        </div>

        <div class="content1">
            <table cellspacing='0' width="100%" cellpadding="10">
                 <tbody>
                    <tr>
                        <th align="left">PERIODE</th>
                        <th>:</th>
                        <td><?php echo date('d-m-Y',strtotime($tanggal_awal)) .' - '. date('d-m-Y',strtotime($tanggal_akhir));?></td>
                    </tr>
                    <tr style="background-color: #e0e0e0;">
                        <th align="left">TANGGAL CETAK</th>
                        <th>:</th>
                        <td><?= $tanggal_cetak;?></td>
                    </tr>
                    <tr>
                        <th align="left">NAMA PENCETAK</th>
                        <th>:</th>
                        <td><?= $nama_pencetak;?></td>
                    </tr>
                
                   
                </tbody>
            </table>
        </div>

        <div class="content2" style="margin-top: 20px;">
             <table cellpadding="10" cellspacing='0' width="100%">
                <tr style="background-color: #64b5f6;">
                    <th style="color: white;">NO</th>
                    <th style="color: white;">ID TRANSAKSI</th>
                    <th style="color: white;">TANGGAL TRANSAKSI</th>
                    <th style="color: white;">NAMA PASIEN</th>
                    <th style="color: white;">JENIS PERIKSA</th>
                    <th style="color: white;">BIAYA</th>


                </tr>
                
                 <?php
                   $no = 1;
                    $total = 0;
                    foreach($row_transaksi as $rt){
                        $id_transaksi          = $rt['id_transaksi'];
                        $tgl_transaksi         = $rt['tgl_transaksi'];
                        $nama_pasien           = $rt['nama_pasien'];
                        $jenis_periksa         = $rt['jenis_periksa'];
                        $ttl                   = $rt['tmpt_lahir']." , ".date('d-m-Y',strtotime($rt['tgl_lahir']));
                        $biaya                 = $rt['biaya'];
                        $total                 += $biaya;

                        if($no % 2 == 0){
                            $color = 'white';
                        } else{
                            $color = '#e0e0e0';
                        }
                        
                        echo '
                            <tr style="background-color: '.$color.';">
                                <td align="center">'.$no++.'</td>
                                <td align="center">'.$id_transaksi.'</td>
                                <td align="center">'.date('d-m-Y',strtotime($tgl_transaksi)).'</td>
                                <td align="center">'.$nama_pasien.'</td>
                                <td align="center">'.$jenis_periksa.'</td>
                                <td align="center">'."Rp.".number_format($biaya,0,',','.').'</td>
                            </tr>
                        ';

                         
                    }

                   
                ?>


                <tr>
                    <td colspan="4" align="right" ><b>TOTAL TRANSAKSI</b></td>
                    <td align="center"><b>:</b></td>
                    <td align="center"><b><?php echo "Rp.".number_format($total,0,',','.'); ?></b></td>
                </tr>

                               
                
            </table>
        </div>
    </div>
    
</body>
</html>