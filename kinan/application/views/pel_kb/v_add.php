<div class="container-fluid">     
    <div class="card shadow bg-info pt-3">
        <div class="container">
            <h3 class="text-title text-light text-center"> FORM PEMERIKSAAN KB</h3>
        </div>
    </div>

    <div class="card shadow mb-4 mt-2">
        <div class="card-body">
            <form method ="POST" action="<?php echo base_url() . "index.php/Pel_kb/processAdd/" ?>">
                
                <div class="row m-auto">
                    <div class="form-group  col-md-4 col-md-4">
                        <label for="id_registrasi">Id Registrasi *</label>
                        <select class="form-control" id="id_registrasi" name="id_registrasi" id="id_registrasi">
                         <option value="pilih">--pilih--</option>
                            <?php foreach ($id_registrasi as $ip): ?>
                                <option value="<?=$ip['id_registrasi'];?>"><?php echo $ip["id_registrasi"]; ?></option>
                            <?php endforeach ?>     
                        </select>
                        
                    </div>
                    <div class="form-group col-md-4 col-md-4">
                        <label>Tanggal Periksa</label>
                        <input autocomplete="off" class="form-control" type="date" name="tgl_periksa" value="<?php echo date("Y-m-d") ?>" readonly>
                    </div>
                    <div class="form-group col-md-4 col-md-4">

                        <label>Id Kb</label>
                        <input autocomplete="off" class="form-control" type="text" name="id_kb" value="<?php echo $id_kb; ?>"  readonly>
                        <input autocomplete="off" class="form-control" type="hidden" name="id_pasien" id="id_pasien" readonly>
                    </div>
                    
                     <div class="form-group col-md-4 col-md-4">
                        <label>Nama Istri</label>
                        <input autocomplete="off" onkeypress="return hanyaHuruf(event)" class="form-control" type="text" name="nama_istri" id="nama_istri" readonly>
                    </div>
    
                    <div class="form-group col-md-4 col-md-4">
                        <label>Nama Suami *</label>
                        <input autocomplete="off" onkeypress="return hanyaHuruf(event)" class="form-control" type="text" name="nama_suami" id="nama_suami" >
                    </div>

                    <div class="form-group col-md-4">
                        <label>Tekanan Darah *</label>
                        <div class="input-group mb-3"> 
                            <input autocomplete="off" class="form-control" type="text" name="td" id="td">
                            <div class="input-group-prepend">
                                <span class="input-group-text">mmHg</span>
                            </div>
                        </div>
                        
                    </div>

                    <div class="form-group col-md-4">
                        <label>Berat Badan *</label>
                        <div class="input-group mb-3"> 
                             <input autocomplete="off" class="form-control" type="number" step="0.1" name="bb" id="bb">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Kg</span>
                            </div>
                        </div>
                       
                    </div>

                    <div class="form-group col-md-4">
                        <label>Jenis Kb *</label>
                        <select class="form-control" id="jenis_kb" name="jenis_kb">
                            <option value="pilih">--Pilih--</option>
                            <option value="Pil Kb">Pil Kb</option>
                            <option value="Suntik Kb">Suntik Kb</option>
                        </select>
                    </div>

                    <div class="form-group col-md-4 col-md-4">
                        <label>Tanggal Kembali *</label>
                        <input autocomplete="off" class="form-control" type="date" name="tgl_kembali" id="tgl_kembali">
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
                         <a href="<?php echo base_url().'Pel_kb' ?>"><button type="button" class="btn btn-danger"><<-Kembali</button></a>
                    </div>
                </div>
             
                    
            </form>
        
        </div>
    </div>
</div>

<script type="text/javascript">
      $('#id_registrasi').select2();
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
                    $('#nama_istri').val(data.nama_pasien);
            }
        });
    }); 

  $("#btn-simpan").click(function(event){
        if ($("#id_registrasi").val() == "pilih") {
                  Lobibox.notify('error', {
                    size: 'mini',
                    icon: true,
                    sound: false,
                    msg: 'pilih nama id registrasi terlebih dulu ...'
                });
                $("#id_registrasi").focus();
                return false;
            }

            if ($("#nama_suami").val() == "") {
                  Lobibox.notify('error', {
                    size: 'mini',
                    icon: true,
                    sound: false,
                    msg: 'Nama suami wajib diisi ...'
                });
                $("#nama_suami").focus();
                return false;
            }

            if ($("#td").val() == "" || $("#td").val() == "0") {
                  Lobibox.notify('error', {
                    size: 'mini',
                    icon: true,
                    sound: false,
                    msg: 'Tekanan darah tidak boleh kosong atau 0 ...'
                });
                $("#td").focus();
                return false;
            }

            if ($("#bb").val() == "" || $("#bb").val() == "0") {
                  Lobibox.notify('error', {
                    size: 'mini',
                    icon: true,
                    sound: false,
                    msg: 'Berat badan tidak boleh kosong atau 0 ...'
                });
                $("#bb").focus();
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