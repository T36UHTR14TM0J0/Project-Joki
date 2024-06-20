 <!-- Begin Page Content -->
<div class="container-fluid">     
    <div class="card shadow bg-info pt-3">
        <div class="container">
            <h3 class="text-title text-light"></i> REGISTRASI PASIEN</h3>
        </div>
    </div>

    <!-- DataTales Example -->
    <div class="card shadow mb-4 mt-2">
        <div class="card-header py-3">
            <a href="<?php echo base_url()."index.php/registrasi/add"; ?>"><button type="button" class="btn btn-primary">Tambah</button></a>
        </div>
    
        <div class="card-body">
            <div class="table-responsive" style="overflow-x: auto;">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th style="text-align: center;">Id Registrasi</th>
                            <th style="text-align: center;">Tanggal Registrasi</th>
                             <th style="text-align: center;">Id Pasien</th>
                            <th style="text-align: center;">Nama Pasien</th>
                            <th style="text-align: center">Jenis Pemeriksaan</th>
                            <th style="text-align: center;">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($data_reg as $dr){
                            if ($dr["jenis_pel"] == "pel_kb") {
                                $jenis_pel = "Pemeriksaan Kb";
                            }else if($dr["jenis_pel"] == "pel_bumil"){
                                $jenis_pel = "Pemeriksaan Ibu Hamil";
                            }else if($dr["jenis_pel"] == "pel_bayi"){
                                $jenis_pel = "Pemeriksaan Bayi & Balita";
                            }else{
                                $jenis_pel = "Pemeriksaan Umum";
                            }
                        ?>
                           
                            <tr style="font-size: 14px">
                                <td style="text-align: center;"><?php echo $dr['id_registrasi']; ?></td>
                                <td style="text-align: center;"><?php echo date('d-m-Y',strtotime($dr['tgl_reg'])); ?></td>
                                <td style="text-align: center;"><?php echo $dr['id_pasien']; ?></td>
                                <td style="text-align: center;"><?php echo $dr['nama_pasien']; ?></td>
                                <td style="text-align: center;"><?php echo $jenis_pel; ?></td>
                                
                                
                                <td style="text-align: center;">
                                    <a href="<?php echo base_url()."registrasi/detail/".$dr['id_registrasi']; ?>" style="text-decoration: none;" title="Informasi Lengkap"><button type="button" class="btn btn-primary btn-circle btn-sm"><i class="fa fa-list"></i></button>
                                    <a href="<?php echo base_url()."registrasi/edit/".$dr['id_registrasi']; ?>" style="text-decoration: none;" title="Ubah Data"><button type="button" class="btn btn-warning btn-circle btn-sm"><i class="fa fa-pencil-alt"></i></button>
                                    <a href="<?php echo base_url()."registrasi/delete/".$dr['id_registrasi']; ?>" style="text-decoration: none;" title="Hapus Data"><button type="button" class="btn btn-danger btn-circle btn-sm" onclick="return confirm('Yakin anda akan menghapus data ini ?');"><i class="fa fa-times"></i></button>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
 </div>
<!-- /.container-fluid -->