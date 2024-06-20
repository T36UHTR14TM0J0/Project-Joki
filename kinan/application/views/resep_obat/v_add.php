<!-- START CONTAINER FLUID -->
<div class="container-fluid">
  
        <!-- START CARD JUDUL HALAMAN -->
        <div class="card shadow bg-info pt-3">
            <div class="container">
                <h3 class="text-title text-light text-center"> TAMBAH RESEP OBAT</h3>
            </div>
        </div>
        <!-- LAST CARD JUDUL HALAMAN -->

        <!-- START CARD  FORM PEMERIKSAAN BIASA -->
        <div class="card shadow mb-4 mt-2">
             
            <!-- START CARD BODY PEMERIKSAAN BIASA -->
            <div class="card-body">
                <!-- START FORM  -->
                <form method ="POST" id="form-biasa" action="processAdd"> 
                <!-- START ROW PEMERIKSAAN BIASA -->
                <div class="row m-auto">
                   
                    <!-- START FORM GROUP NAMA PASIEN -->
                    <div class="form-group  col-md-4 col-md-4">
                        <label for="id_registrasi">Id Registrasi *</label>
                        <select class="form-control" id="id_registrasi" name="id_registrasi" id="id_registrasi">
                         <option>--pilih--</option>
                            <?php foreach ($data_reg as $dr): ?>
                                <option value="<?=$dr['id_registrasi'];?>"><?php echo $dr["id_registrasi"]; ?></option>
                            <?php endforeach ?>     
                        </select>
                    </div>
                    <!-- LAST FORM GROUP NAMA PASIEN -->
                     
                </div> 
                <div class="row mt-2">
                    <div class="container">
                        <h4 class="text-title text-primary text-center">DAFTAR OBAT</h4>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>NO</th>
                                    <th>NAMA OBAT</th>
                                    <th>JUMLAH *</th>
                                    <th>ACTION *</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1; ?>
                                <?php foreach ($obat as $o): ?>
                                    <tr>
                                        <td><?php echo $no++; ?></td>
                                        <td>
                                            <?php echo $o["nama_obat"]; ?>
                                            <input type="hidden" name="id_obat[]" class="form-control" value="<?php echo $o['id_obat']; ?>">
                                        </td>
                                        <td><input class="form-control" type="number" name="jml_obat[]" id="jml_obat"></td>
                                        <td><input type="checkbox" name="c_id_obat[]" value="<?php echo $o["id_obat"]; ?>"></td>
                                    </tr>
                                <?php endforeach ?>
                            </tbody>
                        </table>
                        <div class="col-lg-12 text-center">
                        <button type="submit" class="btn btn-success shadow" id="btn-simpan" style="width: 25%">Simpan</button>
                        <a href="<?php echo base_url('resep_obat') ?>"><button type="button" class="btn btn-danger"><<-Kembali</button></a>
                     </div>
                    </div>
                    
                </div>
                <!-- LAST ROW PEMERIKSAAN BIASA -->
                </form>
                 <!-- LAST FORM -->
            </div>
            <!-- LAST CARD BODY PEMERIKSAAN BIASA -->
        </div>
        <!-- LAST CARD FORM PEMERIKSAAN BIASA -->

      
    
</div>
<!-- LAST CONTAINER FLUID -->

<!-- START SCRIPT JAVASCRIPT JQUERY -->
<script type="text/javascript">
    //START SELECT 2
    $('#id_registrasi').select2();

  
    // START BUTTON SIMPAN & PROSES AJAX 
    $("#btn-simpan").click(function(event){

        // VALIDASI INPUT NAMA PASIEN
        if ($("#id_registrasi").val() == "--pilih--") {
            Lobibox.notify('error', {
                size: 'mini',
                icon: true,
                sound: false,
                msg: 'Silahkan Pilih Id Registrasi..!'
            });
            $("#id_registrasi").focus();
            return false;
        }

    
                   
    });

</script>