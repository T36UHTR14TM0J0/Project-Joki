<?php 


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php $title; ?></title>
    <style>
       

        table{
            font-size: 8px;
        }

        .content-table table{
            width: 90%;
            margin: auto;
        }
    </style>
</head>
<body>
    <div class="header" align="center" style="border-bottom: 3px solid #black; padding:10px;display: inline-block;">
        <div align="box-left" style="margin-bottom: 10px;float: left;width: 60%;">
            <img style="width: 30px;" src="<?php echo $logo; ?>">
            <small style="text-align:center; font-size:18px;color: #black;">
                <?php echo $nama_sekolah; ?>
            </small><br>
            <small style="text-align:center; font-size:14px;color: #ffab00;">
               <?php echo $alamat; ?>
            </small>
        </div>
        <div class="box-right" style="float: right;width: 30%;text-align:center; font-size:14px;">
            <small>Tanggal : <?php echo $tanggal_cetak; ?></small>
        </div>
        
    </div>
    
    <div id="judul-pembayaran" style="text-align: center;">
        <h2>LAPORAN PEMBAYARAN</h2>
    </div>

    <div class="content">
        <div class="content-siswa" style="display: inline-block;width: 100%;">
            <div class="content-siswa-left" style="float: left;width: 50%;">
                <table cellspacing="20" style="margin: auto;">
                    <tr>
                        <th align="left">Periode Tanggal</th>
                        <th align="left">:</th>
                        <td align="left"><?php echo date('d-m-Y',strtotime($tanggal_awal)) .' - '. date('d-m-Y',strtotime($tanggal_akhir)); ?></td>
                    </tr>

                    <tr>
                        <th align="left">Nama Staff</th>
                        <th align="left">:</th>
                        <td align="left"><?php echo $nama_pencetak; ?></td>
                    </tr>
                    
                </table>
            </div>
            <div class="content-siswa-right" style="width:50%;float: right;">
            </div>
        </div>
        <div class="content2" style="margin-top: 20px;">
            <table cellpadding="10" cellspacing='0' width="100%" style="margin: auto;border-bottom: 2px solid #black;">
                <tr style="background-color: #black;">
                    <th style="color: white;" align="center" width="10">NO</th>
                    <th style="color: white;" align="center">KODE PEMBAYARAN</th>
                    <th style="color: white;" align="center">TANGGAL PEMBAYARAN</th>
                    <th style="color: white;" align="center">BULAN PEMBAYARAN</th>
                    <th style="color: white;" align="center">JENIS PEMBAYARAN</th>
                    <th style="color: white;" align="center">NIS</th>
                    <th style="color: white;" align="center">NAMA SISWA</th>
                    <th style="color: white;" align="center">TAHUN AJARAN</th>
                    <th style="color: white;" align="center">NOMINAL</th>
                  </tr>

                    <?php 
                        $no = 1;
                        $jml_total = 0; 
                    ?>
                      <?php foreach ($data_laporan as $dl): ?>
                        <tr>
                          <td><?php echo $no++; ?></td>
                          <td><?php echo $dl["kode_pembayaran"]; ?></td>
                          <td><?php echo date('d-m-Y',strtotime($dl["tgl_pembayaran"])); ?></td>
                          <td><?php echo $dl["bln_pembayaran"]; ?></td>
                          <td><?php echo $dl['nama_pembayaran']; ?></td>
                          <td><?php echo $dl["nis"]; ?></td>
                          <td><?php echo $dl["nama_lengkap"]; ?></td>
                          <td><?php echo $dl["tahun_ajaran"]; ?></td>
                          <td><?php echo "Rp. ". number_format($dl["nominal"],0,',','.'); ?></td>
                          

                        </tr>
                    <?php
                        $jml_total += $dl['nominal']; 
                        endforeach
                    ?>
                      <tr style="background-color: #black;">
                            <td colspan="6" align="right" style="color: white;"><b>JUMLAH TOTAL</b></td>
                            <td align="center" style="color: white;"><b>:</b></td>
                            <td align="center" style="color: white;"><b><?php echo "Rp.".number_format($jml_total,0,',','.'); ?></b></td>
                        </tr>
            </table> 
        </div>
        
    </div>
    
</body>
</html>