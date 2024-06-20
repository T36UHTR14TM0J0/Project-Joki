<!-- START CONTAINER FLUID -->
<div class="container-fluid">
     <!-- START FORM  -->
    <form method ="POST" id="form-biasa" action="<?php echo base_url() . "index.php/resep_obat/doUpdate/" ?>"> 
        <!-- START CARD JUDUL HALAMAN -->
        <div class="card shadow bg-info pt-3">
            <div class="container">
                <h3 class="text-title text-light text-center"> EDIT RESEP OBAT</h3>
            </div>
        </div>
        <!-- LAST CARD JUDUL HALAMAN -->

        <!-- START CARD  FORM PEMERIKSAAN BIASA -->
        <div class="card shadow mb-4 mt-2">
             
            <!-- START CARD BODY PEMERIKSAAN BIASA -->
            <div class="card-body">
                <!-- START ROW PEMERIKSAAN BIASA -->
                <div class="row m-auto">
                    <?php foreach ($resep_obat as $ro): ?>
                        
                  
                    <!-- START FORM GROUP NAMA PASIEN -->
                    <div class="form-group  col-md-4 col-md-4">
                        <label for="id_resep">Id Resep</label>
                        <input type="text" name="id_resep" class="form-control" id="id_resep" value="<?php echo $ro['id_resep']; ?>" readonly>
                    </div>
                    <!-- LAST FORM GROUP NAMA PASIEN -->

                    <!-- START FORM GROUP NAMA PASIEN -->
                    <div class="form-group  col-md-4 col-md-4">
                        <label for="tgl_resep">Tanggal Resep</label>
                        <input type="date" name="tgl_resep" class="form-control" id="tgl_resep" value="<?php echo date('Y-m-d',strtotime($ro['tgl_resep'])); ?>" readonly>
                    </div>
                    <!-- LAST FORM GROUP NAMA PASIEN -->

                    <!-- START FORM GROUP NAMA PASIEN -->
                    <div class="form-group  col-md-4 col-md-4">
                        <label for="id_registrasi">Id Registrasi *</label>
                        <select class="form-control" id="id_registrasi" name="id_registrasi" id="id_registrasi">
                        
                            <?php foreach ($data_reg as $dr): ?>
                                <option value="<?=$dr['id_registrasi'];?>" <?php if ($ro['id_registrasi'] == $dr['id_registrasi']){echo 'selected';} ?>><?php echo $dr["id_registrasi"]; ?></option>
                            <?php endforeach ?>     
                        </select>
                    </div>
                    <!-- LAST FORM GROUP NAMA PASIEN -->
                     <!-- START FORM GROUP NAMA PASIEN -->
                    <div class="form-group  col-md-4 col-md-4">
                        <label for="nama_obat">Nama Obat *</label>
                        <select class="form-control" id="nama_obat" name="nama_obat" id="nama_obat">
                            <?php foreach ($obat as $o): ?>
                                <option value="<?=$o['id_obat'];?>" <?php if ($ro['id_obat'] == $o['id_obat']){echo 'selected';} ?>><?php echo $o["nama_obat"]; ?></option>
                            <?php endforeach ?>     
                        </select>
                    </div>
                    <!-- LAST FORM GROUP NAMA PASIEN -->
                    <!-- START FORM GROUP KELUHAN -->
                     <div class="form-group col-md-4 col-md-4">
                        <label>Jumlah *</label>
                        <input id="jml_obat" class="form-control" type="number" name="jml_obat" id="jml_obat" value="<?php echo $ro['jml_obat'] ?>">
                    </div>
                <?php endforeach ?>
                 
                    <!-- LAST FORM GROUP TERAPI OBAT -->
                     <div class="col-lg-12 text-center">
                        <button type="submit" class="btn btn-success shadow" id="btn-simpan" style="width: 25%">Simpan</button>
                        <a href="<?php echo base_url('resep_obat') ?>"><button type="button" class="btn btn-danger"><<-Kembali</button></a>
                     </div>
                </div> 
                <!-- LAST ROW PEMERIKSAAN BIASA -->
            </div>
            <!-- LAST CARD BODY PEMERIKSAAN BIASA -->
        </div>
        <!-- LAST CARD FORM PEMERIKSAAN BIASA -->

      
    </form>
    <!-- LAST FORM -->
</div>
<!-- LAST CONTAINER FLUID