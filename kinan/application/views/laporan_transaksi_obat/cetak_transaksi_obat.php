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
             LAPORAN DATA TRANSAKSI OBAT 
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
                    <th style="color: white;">TANGGAL</th>
                    <th style="color: white;">STATUS</th>
                    <th style="color: white;">USER</th>
                    <th style="color: white;">ID OBAT</th>
                    <th style="color: white;">NAMA OBAT</th>
                    <th style="color: white;">QTY</th>
                    <th style="color: white;">SATUAN</th>
                    <th style="color: white;">HARGA</th>
                    <th style="color: white;">TOTAL</th>

                </tr>
                
                 <?php
                   $no = 1;
                   $total = 0;
                   $totalmasuk = 0;
                   $totalkeluar = 0;
                    foreach($row_obat as $ro){
                        $id_transaksi        = $ro['id_transaksi'];
                        $tgl_transaksi      = $ro['tgl_transaksi'];
                        $status            = $ro['status'];
                        $user         = $ro['id_user'];
                        $id_obat          = $ro['id_obat'];
                        $nama_obat          = $ro['nama_obat'];
                        $qty          = $ro['qty'];
                        $satuan          = $ro['satuan'];
                        $harga          = $ro['harga'];
                        $total      = $harga * $qty; 
                        // $total          += $sub_total; 

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
                                <td align="center">'.$status.'</td>
                                <td align="center">'.$user.'</td>
                                <td align="center">'.$id_obat.'</td>
                                <td align="center">'.$nama_obat.'</td>
                                <td align="center">'.$qty.'</td>
                                <td align="center">'.$satuan.'</td>
                                <td align="center">Rp.'.number_format($harga,0,',','.').'</td>
                                <td align="center">Rp.'.number_format($total,0,',','.').'</td>
                            </tr>
                        ';

                         if ($ro["status"] == "masuk") {
                            $totalmasuk+= $total; 
                        } else{
                            $totalkeluar += $total;
                        }
                    }

                   
                ?>

                <tr>
                    <td colspan="9" align="right" ><b>TOTAL PEMASUKKAN</b></td>
                    <td align="center"><b>:</b></td>
                    <td align="center"><b><?php echo "Rp.".number_format($totalmasuk,0,',','.'); ?></b></td>
                </tr>
                 <tr>
                    <td colspan="9" align="right" ><b>TOTAL PENGELUARAN</b></td>
                    <td align="center"><b>:</b></td>
                    <td align="center"><b><?php echo "Rp.".number_format($totalkeluar,0,',','.') ?></b></td>
                </tr>
              
                
                
            </table>
        </div>
    </div>
    
</body>
</html>