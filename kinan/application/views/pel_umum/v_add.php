<!-- START CONTAINER FLUID -->
<div class="container-fluid">
     <!-- START FORM  -->
    <form method ="POST" id="form-biasa" action="processAdd"> 
        <!-- START CARD JUDUL HALAMAN -->
        <div class="card shadow bg-info pt-3">
            <div class="container">
                 <h3 class="text-title text-light text-center"> TAMBAH PEMERIKSAAN UMUM</h3>
            </div>
        </div>
        <!-- LAST CARD JUDUL HALAMAN -->

        <!-- START CARD  FORM PEMERIKSAAN BIASA -->
        <div class="card shadow mb-4 mt-2">
             
            <!-- START CARD BODY PEMERIKSAAN BIASA -->
            <div class="card-body">
                <!-- START ROW PEMERIKSAAN BIASA -->
                <div class="row m-auto">
                     <!-- START FORM GROUP NAMA PASIEN -->
                    <div class="form-group  col-md-4 col-md-4">
                        <label for="id_registrasi">Id Registrasi *</label>
                        <select class="form-control" id="id_registrasi" name="id_registrasi" id="id_registrasi">
                         <option>--pilih--</option>
                            <?php foreach ($pasien as $p): ?>
                                <option value="<?=$p['id_registrasi'];?>"><?php echo $p["id_registrasi"]; ?></option>
                                <input autocomplete="off" class="form-control" type="hidden" name="id_pasien" id="id_pasien" value="<?=$p['id_pasien'];?>" readonly>
                            <?php endforeach ?>     
                        </select>
                    </div>
                    <!-- START FORM GROUP TANGGAL PERIKSA -->
                     <div class="form-group col-md-4 col-md-4">
                        <label>Tanggal Periksa</label>
                        <input autocomplete="off" class="form-control" type="date" name="tgl_periksa" value="<?php echo date('Y-m-d') ;?>" readonly>
                    </div>
                    <!-- LAST FORM GROUP TANGGAL PERIKSA -->
                    <!-- START FORM GROUP ID PASIEN -->
                    <div class="form-group col-md-4 col-md-4">
                        <label>Id Pasien</label>
                        <input autocomplete="off" class="form-control" type="text" name="id" value="<?php echo $id; ?>"  readonly>
                        
                    </div>
                    <!-- LAST FORM GROUP ID PASIEN -->
                     <div class="form-group col-md-4">
                        <label>Nama Pasien</label>
                        <input class="form-control" type="text" name="nama_pasien" id="nama_pasien" readonly="">
                    </div> 
                   
                    <!-- LAST FORM GROUP NAMA PASIEN -->
                    <div class="form-group col-md-4">
                        <label>Tinggi Badan *</label>
                         <div class="input-group mb-3"> 
                            <input class="form-control" type="number" min="0" step="0.1" name="tb" id="tb">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Cm</span>
                            </div>
                        </div>
                        
                    </div>
                    <div class="form-group col-md-4">
                        <label>Berat Badan *</label>
                        <div class="input-group mb-3"> 
                            <input class="form-control" type="number" min="0" step="0.1" name="bb" id="bb">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Kg</span>
                            </div>
                        </div>
                        
                    </div>
                    <div class="form-group col-md-4">
                        <label>Tekanan Darah *</label>
                        <div class="input-group mb-3"> 
                            <input class="form-control" type="text" name="td" id="td">
                            <div class="input-group-prepend">
                                <span class="input-group-text">mmHg</span>
                            </div>
                        </div>
                        
                    </div>
                    <!-- START FORM GROUP KELUHAN -->
                     <div class="form-group col-md-4 col-md-4">
                        <label>Keluhan *</label>
                        <input autocomplete="off" id="keluhan" class="form-control" type="text" name="keluhan" onkeypress="return hanyaHuruf(event)">
                    </div>
                    <div class="form-group col-md-4">
                        <label>Biaya *</label>
                        <div class="input-group mb-3"> 
                            <div class="input-group-prepend">
                                <span class="input-group-text">Rp</span>
                            </div>
                            <input class="form-control" type="text" name="biaya" id="biaya">
                        </div>
                        
                    </div>
                     <div class="col-lg-12 text-center">
                        <button type="submit" class="btn btn-success shadow" id="btn-simpan" style="width: 25%">Simpan</button>
                        <a href="<?php echo base_url('pel_umum') ?>"><button type="button" class="btn btn-danger"><<-Kembali</button></a>
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
<!-- LAST CONTAINER FLUID -->

<!-- START SCRIPT JAVASCRIPT JQUERY -->
<script type="text/javascript">
    //START SELECT 2
    $('#id_registrasi').select2();
    $("#biaya").mask('0.000.000.000',{reverse:true});
    // START ON CHANGE NAMA PASIEN
    $('#id_registrasi').on('change.select2',function(){
        var id_registrasi = $('#id_registrasi').val();
        $.ajax({
            type    : "POST",
            url     : 'ambil_data_pasien',
            data    : {'id_registrasi':id_registrasi},
            dataType: "json",
            success : function(data){
                    $('#nama_pasien').val(data.nama_pasien);
            }
        });
    }); 
    // LAST ON CHANGE NAMA PASIEN

  
    // START BUTTON SIMPAN & PROSES AJAX 
    $("#btn-simpan").click(function(event){
        
        // VALIDASI INPUT NAMA PASIEN
        if ($("#nama_pasien").val() == "") {
            Lobibox.notify('error', {
                size: 'mini',
                icon: true,
                sound: false,
                msg: 'Silahkan Pilih Nama Pasien...'
            });
            $("#nama_pasien").focus();
            return false;
        }

       

        // VALIDASI INPUT Tinggi Badan
        if ($("#tb").val() == "" || $("#tb").val() == "0" ){
            Lobibox.notify('error', {
                size: 'mini',
                icon: true,
                sound: false,
                msg: 'Tinggi badan tidak boleh kosong atau 0...'
            });
            $("#tb").focus();
            return false;
        }

          // VALIDASI INPUT Berat Badan
        if ($("#bb").val() == "" || $("#bb").val() == "0" ) {
            Lobibox.notify('error', {
                size: 'mini',
                icon: true,
                sound: false,
                msg: 'Berat badan tidak boleh kosong atau 0...'
            });
            $("#bb").focus();
            return false;
        }

          // VALIDASI INPUT Tekanan Darah
        if ($("#td").val() == "" || $("#td").val() == "0") {
            Lobibox.notify('error', {
                size: 'mini',
                icon: true,
                sound: false,
                msg: 'Tekanan darah tidak boleh kosong atau 0...'
            });
            $("#td").focus();
            return false;
        }

         // VALIDASI INPUT KELUHAN
        if ($("#keluhan").val() == "") {
            Lobibox.notify('error', {
                size: 'mini',
                icon: true,
                sound: false,
                msg: 'Keluhan wajib di isi ...'
            });
            $("#keluhan").focus();
            return false;
        }

                   
    });



</script>