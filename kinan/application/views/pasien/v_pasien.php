 <!-- Begin Page Content -->
<div class="container-fluid">     
    <div class="card shadow bg-info pt-3">
        <div class="container">
            <h3 class="text-title text-light"></i> DATA PASIEN</h3>
        </div>
    </div>

    <!-- DataTales Example -->
    <div class="card shadow mb-4 mt-2">
        <div class="card-header py-3">
         <!--    <a href="<?php echo base_url()."index.php/pasien/add"; ?>"><button type="button" class="btn btn-primary">Tambah</button></a> -->
        </div>
    
        <div class="card-body">
            <div class="table-responsive" style="overflow-x: auto;">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th style="text-align: center;">Id Registrasi</th>
                            <th style="text-align: center;">Id Pasien</th>
                            <th style="text-align: center;">KTP</th>
                            <th style="text-align: center;">Nama Pasien</th>
                            <th style="text-align: center;">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($pasien as $p){?>
                            <tr style="font-size: 14px">
                                <td style="text-align: center;"><?php echo $p['id_registrasi']; ?></td>
                                <td style="text-align: center;"><?php echo $p['id_pasien']; ?></td>
                                <td style="text-align: center;"><?php echo $p['no_ktp']; ?></td>
                                <td style="text-align: center;"><?php echo $p['nama_pasien']?></td>
                                <td style="text-align: center;">
                                    <a href="<?php echo base_url()."pasien/detail/".$p['id_registrasi']; ?>" style="text-decoration: none;" title="Informasi Lengkap"><button type="button" class="btn btn-primary btn-circle btn-sm"><i class="fa fa-list"></i></button>
                                    <a href="<?php echo base_url()."pasien/edit/".$p['id_registrasi']; ?>" style="text-decoration: none;" title="Ubah Data"><button type="button" class="btn btn-warning btn-circle btn-sm"><i class="fa fa-pencil-alt"></i></button>
                                    <a href="<?php echo base_url()."pasien/delete/".$p['id_registrasi']; ?>" style="text-decoration: none;" title="Hapus Data"><button type="button" class="btn btn-danger btn-circle btn-sm" onclick="return confirm('Yakin anda akan menghapus data ini ?');"><i class="fa fa-times"></i></button>
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