 <!-- Begin Page Content -->
<div class="container-fluid">     
    <div class="card shadow bg-info pt-3">
        <div class="container">
            <h3 class="text-title text-light">PEMERIKSAAN KB</h3>
        </div>
    </div>

    <!-- DataTales Example -->
    <div class="card shadow mb-4 mt-2">
        <div class="card-header py-3">
            <a href="<?php echo base_url()."Pel_kb/add"; ?>"><button type="button" class="btn btn-primary">Tambah</button></a>
        </div>
    
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th style="text-align: center;">No</th>
                            <th style="text-align: center;">Id Registrasi</th>
                            <th style="text-align: center;">Tanggal Periksa</th>
                            <th style="text-align: center;">Id Kb</th>
                            <th style="text-align: center;">Nama Istri</th>
                            <th style="text-align: center;">Nama Suami</th>
                            <th style="text-align: center;">Action</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php 
                        $no =1;
                        foreach($kb as $i){
                            
                        ?>
                        <tr style="font-size: 14px">
                            <td style="text-align: center;"><?php echo $no++ ;?></td>
                            <td style="text-align: center;"><?php echo $i['id_registrasi']; ?></td>
                            <td style="text-align: center;"><?php echo date('d-m-Y',strtotime($i['tgl_periksa'])); ?></td>
                            <td style="text-align: center;"><?php echo $i['id_kb']; ?></td>
                            <td style="text-align: center;"><?php echo $i['nama_pasien']; ?></td>
                            <td style="text-align: center;"><?php echo $i['nama_suami']; ?></td>
                            <td style="text-align: center;">
                            <a href="<?php echo base_url()."Pel_kb/detail/".$i['id_kb']; ?>" style="text-decoration: none;" title="Informasi Lengkap"><button type="button" class="btn btn-primary btn-circle btn-sm"><i class="fa fa-list"></i></button>
                            <a href="<?php echo base_url()."Pel_kb/edit/".$i['id_kb']; ?>" style="text-decoration: none;" title="Ubah Data"><button type="button" class="btn btn-warning btn-circle btn-sm"><i class="fa fa-pencil-alt"></i></button>
                            <a href="<?php echo base_url()."Pel_kb/delete/".$i['id_kb']; ?>" style="text-decoration: none;" title="Hapus Data"><button type="button" class="btn btn-danger btn-circle btn-sm" onclick="return confirm('Yakin anda akan menghapus data ini ?');"><i class="fa fa-times"></i></button>
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