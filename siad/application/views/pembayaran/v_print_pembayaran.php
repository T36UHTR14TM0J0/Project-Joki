<?php 


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php $title; ?></title>
    <style>
       
       body{
        margin: 0px;
        padding: 0px;
       }

        table{
            font-size: 12px;
        }

        .content-table table{
            width: 90%;
            margin: auto;
        }
    </style>
</head>
<body>
    <div class="header" align="center" style="border-bottom: 3px solid #black;display: inline-block;">
        <div align="box-left" style="margin-bottom: 10px;float: left;width: 60%;">
            <img style="width: 30px;" src="<?php echo $logo; ?>">
            <small style="text-align:center; font-size:14px;color: #black;">
                <?php echo $nama_sekolah; ?>
            </small><br>
            <small style="text-align:center; font-size:14px;color: #ffab00;">
               <?php echo $alamat; ?>
            </small>
        </div>
        <div class="box-right" style="float: right;width: 30%;text-align:center; font-size:14px;">
            <small>Tanggal : <?php echo date('d-m-Y'); ?></small>
        </div>
        
    </div>
    
    <div id="judul-pembayaran" style="text-align: center;">
        <h2>BUKTI PEMBAYARAN</h2>
    </div>

    <div class="content">
        <div class="content-siswa" style="display: inline-block;width: 100%;">
            <div class="content-siswa-left" style="float: left;width: 50%;">
                <table cellspacing="0" cellpadding="5" style="margin: auto;">
                    <tr>
                        <th align="left">Kode Pembayaran</th>
                        <th align="left">:</th>
                        <td align="left"><?php echo $pembayaran_siswa[0]['kode_pembayaran']; ?></td>
                    </tr>
                    <tr>
                        <th align="left">Nis</th>
                        <th align="left">:</th>
                        <td align="left"><?php echo $pembayaran_siswa[0]['nis']; ?></td>
                    </tr>
                    <tr>
                        <th align="left">Nama Siswa</th>
                        <th align="left">:</th>
                        <td align="left"><?php echo $pembayaran_siswa[0]['nama_lengkap']; ?></td>
                    </tr>
                    <tr>
                        <th align="left">Kelas</th>
                        <th align="left">:</th>
                        <td align="left"><?php echo $pembayaran_siswa[0]['nama_kelas']; ?></td>
                    </tr>
                </table>
            </div>
            <div class="content-siswa-right" style="width:50%;float: right;">
                <table cellspacing="0" cellpadding="5" style="margin: auto;">
                    <tr>
                        <th align="left">Semester</th>
                        <th align="left">:</th>
                        <td align="left"><?php echo $pembayaran_siswa[0]['semester']; ?></td>
                    </tr>
                    <tr>
                        <th align="left">Tahun Ajaran</th>
                        <th align="left">:</th>
                        <td align="left"><?php echo $pembayaran_siswa[0]['tahun_ajaran']; ?></td>
                    </tr>
                    <tr>
                        <th align="left">Tanggal Pembayaran</th>
                        <th align="left">:</th>
                        <td align="left"><?php echo date("d-m-Y",strtotime($pembayaran_siswa[0]['tgl_pembayaran'])); ?></td>
                    </tr>
                    <tr>
                        <th align="left">Bulan Pembayaran</th>
                        <th align="left">:</th>
                        <td align="left"><?php echo $pembayaran_siswa[0]['bln_pembayaran'] ?></td>
                    </tr>
                </table>
            </div>
        </div>
        <div class="content2" style="margin-top: 10px;">
            <table cellpadding="5" cellspacing='0' width="100%" style="margin: auto;border-bottom: 2px solid #black;">
                <tr style="background-color: #black;">
                    <th style="color: white;" align="center" width="10">No</th>
                    <th style="color: white;" align="center">Jenis Pembayaran</th>
                    <th style="color: white;" align="center">Nominal</th>
                </tr>

                <?php $no = 1; foreach ($pembayaran_siswa as $pb): ?>
                    <tr>
                        <td align="center"><?php echo $no++; ?></td>
                        <td align="center"><?php echo $pb['nama_pembayaran']; ?></td>
                        <td align="center"><?php echo "Rp. ". number_format($pembayaran_siswa[0]['nominal'],0,',','.'); ?></td>
                    </tr>
                <?php endforeach ?>
            </table> 
        </div>
        
    </div>

    <div class="paraf" style="width: 100%;display: inline-block;text-align: center;margin-top: 10px;">
        <div class="paraf-siswa" style="float: left;width: 50%;">
            <h4>Siswa</h4>
            <br>
            <br>
            (..............................)
        </div>
        <div class="paraf-staff" style="float: right;width: 50%;">
            <h4>Staff TU</h4>
            <br>
            <br>
            (..............................)
        </div>
    </div>

    
</body>
</html>