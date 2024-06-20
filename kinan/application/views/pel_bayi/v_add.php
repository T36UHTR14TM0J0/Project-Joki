<div class="container-fluid">     
    <div class="card shadow bg-info pt-3">
        <div class="container">
            <h3 class="text-title text-light text-center"> TAMBAH PEMERIKSAAN BAYI & BALITA</h3>
        </div>
    </div>

    <div class="card shadow mb-4 mt-2">
        <div class="card-body">
            <form method ="POST" action="<?php echo base_url() . "index.php/pel_bayi/processAdd/" ?>">
                
                <div class="row m-auto">
                    <div class="form-group  col-md-4 col-md-4">
                        <label for="id_registrasi">Id Registrasi *</label>
                        <select class="form-control" id="id_registrasi" name="id_registrasi" id="id_registrasi">
                         <option value="">--pilih--</option>
                            <?php foreach ($id_registrasi as $id_registrasi): ?>
                                <option value="<?=$id_registrasi['id_registrasi'];?>"><?php echo $id_registrasi["id_registrasi"]; ?></option>
                            <?php endforeach ?>     
                        </select>
                        
                    </div>
                     <div class="form-group col-md-4 col-md-4">
                        <label>Tanggal Periksa</label>
                        <input autocomplete="off" class="form-control" type="date" name="tgl_periksa" value="<?php echo date('Y-m-d'); ?>" id="tgl_periksa" readonly>
                    </div>
                    <div class="form-group col-md-4 col-md-4">
                        <label>Id Bayi</label>
                        <input autocomplete="off" class="form-control" type="text" name="id_bayi" value="<?php echo $id_bayi; ?>"  readonly>
                        <input autocomplete="off" class="form-control" type="hidden" name="id_pasien" id="id_pasien" readonly>
                    </div>
                    
                    <div class="form-group col-md-4 col-md-4">
                        <label>Nama Bayi</label>
                        <input autocomplete="off" onkeypress="return hanyaHuruf(event)" class="form-control" type="text" name="nama_bayi" id="nama_bayi" readonly>
                    </div>
    
                     <div class="form-group col-md-4 col-md-4">
                        <label>Nama Ibu *</label>
                        <input autocomplete="off" onkeypress="return hanyaHuruf(event)" class="form-control" type="text" name="nama_ibu" id="nama_ibu">
                    </div>

                     <div class="form-group  col-md-4 col-md-4">
                        <label for="jenis">Jenis *</label>
                        <select class="form-control" id="jenis" name="jenis" id="jenis">
                            <option value="">--pilih--</option>
                            <option value="periksa">Periksa</option>
                            <option value="imunisasi">Imunisasi</option>  
                        </select>
                        
                    </div>

                    <div class="form-group  col-md-4 col-md-4 jenis_imun">
                        <label for="jenis_imun">jenis Imunisasi *</label>
                        <select class="form-control" name="jenis_imun" id="jenis_imun">
                            <option value="">--pilih--</option>
                            <option value="HB">HB</option>
                            <option value="BCE">BCE</option> 
                            <option value="HB-0">HB-0</option> 
                            <option value="POLIO 1">POLIO 1</option>  
                            <option value="POLIO 2">POLIO 2</option> 
                            <option value="POLIO 3">POLIO 3</option>
                            <option value="POLIO -0">POLIO -0</option> 
                            <option value="CAMPAK">CAMPAK</option> 
                        </select>
                        
                    </div>

                     <div class="form-group col-md-4">
                        <label>Berat Bayi *</label>
                        <div class="input-group mb-3"> 
                             <input autocomplete="off" step="0.1" class="form-control" type="number" name="bb" id="bb">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Kg</span>
                            </div>
                        </div>
                       
                    </div>

                     <div class="form-group col-md-4">
                        <label>Tinggi / Panjang Bayi *</label>
                        <div class="input-group mb-3"> 
                            <input autocomplete="off" step="0.1" class="form-control" type="number" name="tb" id="tb">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Cm</span>
                            </div>
                        </div>
                       
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
                        <button type="submit" class="btn btn-info" id="btn-simpan" style="width: 25%">Simpan</button>
                         <a href="<?php echo base_url('pel_bayi') ?>"><button type="button" class="btn btn-danger"><<-Kembali</button></a>
                    </div>
                </div>
             
                    
            </form>
        
        </div>
    </div>
</div>

<script type="text/javascript">
      $('#id_registrasi').select2();
      $('.jenis_imun').hide();
        $("#jenis").change(function(){
            var jenis_p = $('#jenis').val();
            // $('.container-optional').empty();
            if(jenis_p == 'imunisasi'){
                $('.jenis_imun').show();
            }else {
                $('.jenis_imun').hide();
            }
        });
       $("#biaya").mask('0.000.000.000',{reverse:true});
  $('#id_registrasi').on('change.select2',function(){


        var id_registrasi = $('#id_registrasi').val();
        $.ajax({
            type    : "POST",
            url     : 'ambil_data_pasien',
            data    : {'id_registrasi':id_registrasi},
            dataType: "json",
            success : function(data){
                    $('#id_pasien').val(data.id_pasien);
                    $('#nama_bayi').val(data.nama_bayi);
            }
        });
    }); 

    $("#btn-simpan").click(function(event){
        if ($("#id_registrasi").val() == "") {
                  Lobibox.notify('error', {
                    size: 'mini',
                    icon: true,
                    sound: false,
                    msg: 'pilih id registrasi terlebih dulu ...'
                });
                $("#id_registrasi").focus();
                return false;
            }

            if ($("#nama_ibu").val() == "") {
                  Lobibox.notify('error', {
                    size: 'mini',
                    icon: true,
                    sound: false,
                    msg: 'Nama ibu wajib diisi ...'
                });
                $("#nama_ibu").focus();
                return false;
            }


            if ($("#bb").val() == "" || $("#bb").val() == "0") {
                  Lobibox.notify('error', {
                    size: 'mini',
                    icon: true,
                    sound: false,
                    msg: 'Berat bayi tidak boleh kosong atau 0 ...'
                });
                $("#bb").focus();
                return false;
            }

            if ($("#tb").val() == "" || $("#tb").val() == "0") {
                  Lobibox.notify('error', {
                    size: 'mini',
                    icon: true,
                    sound: false,
                    msg: 'Tinggi / Panjang bayi tidak boleh kosong atau 0 ...'
                });
                $("#tb").focus();
                return false;
            }

            if ($("#tgl_kembali").val() == "") {
                  Lobibox.notify('error', {
                    size: 'mini',
                    icon: true,
                    sound: false,
                    msg: 'Tanggal Kembali wajib di isi ...'
                });
                $("#tgl_kembali").focus();
                return false;
            }



           
        });


</script>