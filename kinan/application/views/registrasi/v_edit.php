<div class="container-fluid">     
    <div class="card shadow bg-info pt-3">
        <div class="container">
            <h3 class="text-title text-light text-center"> FORM EDIT REGISTRASI</h3>
        </div>
    </div>

    <div class="card shadow mb-4 mt-2">
        <div class="card-body">
            <form method ="POST" action="<?php echo base_url() . "index.php/registrasi/doUpdate/" ?>">
                <?php foreach ($data_reg as $dr): ?>
               
                <div class="row m-auto">
                     <div class="form-group col-md-4">
                     <label>ID Registrasi</label>
                        <input autocomplete="off" class="form-control" type="text" name="id_registrasi" id="id_registrasi" value="<?php echo $dr['id_registrasi']; ?>" readonly>
                    </div>
                     <div class="form-group col-md-4">
                        <label>Tanggal Registrasi</label>
                        <input autocomplete="off" class="form-control" type="date" name="tgl_reg" id="tgl_reg" value="<?php echo $dr['tgl_reg']; ?>" readonly>
                    </div>

                      <div class="form-group col-md-4">
                        <label>ID Pasien</label>
                        <input autocomplete="off" class="form-control" type="text" name="id_pasien" id="id_pasien" value="<?php echo $dr['id_pasien']; ?>" readonly>
                    </div>
                   
                    <div class="form-group col-md-4 col-md-4">
                        <label>No ktp *</label>
                        <input autocomplete="off" class="form-control" type="number" name="no_ktp" id="no_ktp" value="<?php echo $dr['no_ktp']; ?>">
                    </div>
                
                    <div class="form-group col-md-4">
                        <label>Nama Pasien *</label>
                        <input autocomplete="off" class="form-control" type="text" name="nama_pasien" id="nama_pasien" value="<?php echo $dr['nama_pasien']; ?>" onkeypress="return hanyaHuruf(event)">
                    </div>
                      <div class="form-group col-md-4">
                        <label>Tempat Lahir *</label>
                        <input autocomplete="off" class="form-control" type="text" name="tmpt_lahir" id="tmpt_lahir" onkeypress="return hanyaHuruf(event)" value="<?php echo $dr['tmpt_lahir']; ?>">
                    </div>
                        
                     <div class="form-group col-md-4">
                        <label>Tanggal Lahir *</label>
                        <input autocomplete="off" class="form-control" type="date" name="tgl_lahir" id="tgl_lahir" value="<?php echo $dr['tgl_lahir']; ?>">
                    </div>

                     <div class="form-group col-md-4">
                        <label>Umur *</label>
                        <input autocomplete="off" class="form-control"  type="text" name="umur" id="umur" value="<?php echo $dr['umur']; ?>">
                    </div>

                     <div class="form-group col-md-4">
                        <label>Jenis Kelamin *</label>
                        <select class="form-control" name="jk">
                            <option value="L" <?php if ($dr['jk'] == 'L'){echo 'selected';} ?>>Laki-Laki</option>
                            <option value="P" <?php if ($dr['jk'] == 'P'){echo 'selected';} ?> >Perempuan</option>
                        </select>
                    </div>
                
                     <div class="form-group col-md-4">
                        <label>Alamat *</label>
                        <textarea cols="3" rows="3" class="form-control" name="alamat" id="alamat"><?php echo $dr['alamat']; ?></textarea>
                    </div>

                     <div class="form-group col-md-4">
                        <label>No HP *</label>
                        <input autocomplete="off" class="form-control" type="number" name="no_tlp" id="no_tlp" value="<?php echo $dr['no_tlp']; ?>">
                    </div>

                     <div class="form-group col-md-4">
                        <label>Jenis Periksa *</label>
                        <select class="form-control" name="jenis_pel">
                            <option value="pel_kb" <?php if($dr["jenis_pel"] == "pel_kb") {echo 'selected';} ?>>Pemeriksaan Kb</option>
                            <option value="pel_bumil" <?php if($dr["jenis_pel"] == "pel_bumil") {echo 'selected';} ?>>Pemeriksaan Ibu Hamil</option>
                            <option value="pel_umum" <?php if($dr["jenis_pel"] == "pel_umum") {echo 'selected';} ?>>Pemeriksaan Umum</option>
                            <option value="pel_bayi" <?php if($dr["jenis_pel"] == "pel_bayi") {echo 'selected';} ?>>Pemeriksaan Bayi & Balita</option>
                        </select>
                    </div>
                
                
                <?php endforeach ?>
                  
                    <div class="col-lg-12 text-center">
                        <button type="submit" class="btn btn-info" id="btn-simpan" style="width: 25%">Simpan</button>
                         <a href="<?php echo base_url().'Registrasi' ?>"><button type="button" class="btn btn-danger"><<-Kembali</button></a>
                    </div>
                </div>
            </form>
        
        </div>
    </div>
</div>

<script type="text/javascript">


     

        $("#btn-simpan").click(function(event){
          

            if ($("#no_ktp").val() == "") {
                  Lobibox.notify('error', {
                    size: 'mini',
                    icon: true,
                    sound: false,
                    msg: 'No ktp wajib diisi!'
                });
                $("#no_ktp").focus();
                return false;
            }

            if($("#no_ktp").val().length < 16 || $("#no_ktp").val().length > 16){
                 Lobibox.notify('error', {
                    size: 'mini',
                    icon: true,
                    sound: false,
                    msg: 'No ktp tidak valid!'
                });
                $("#no_ktp").focus();
                return false;
            }

              if ($("#nama_pasien").val() == "") {
                  Lobibox.notify('error', {
                    size: 'mini',
                    icon: true,
                    sound: false,
                    msg: 'Nama pasien wajib diisi!'
                });
                $("#nama_pasien").focus();
                return false;
            }
              if ($("#tmpt_lahir").val() == "") {
                  Lobibox.notify('error', {
                    size: 'mini',
                    icon: true,
                    sound: false,
                    msg: 'Tempat Lahir wajib diisi!'
                });
                $("#tmpt_lahir").focus();
                return false;
            }
              if ($("#tgl_lahir").val() == "") {
                  Lobibox.notify('error', {
                    size: 'mini',
                    icon: true,
                    sound: false,
                    msg: 'Tanggal lahir wajib diisi!'
                });
                $("#tgl_lahir").focus();
                return false;
            }
              if ($("#umur").val() == "") {
                  Lobibox.notify('error', {
                    size: 'mini',
                    icon: true,
                    sound: false,
                    msg: 'Umur wajib diisi!'
                });
                $("#umur").focus();
                return false;
            }
              if ($("#alamat").val() == "") {
                  Lobibox.notify('error', {
                    size: 'mini',
                    icon: true,
                    sound: false,
                    msg: 'Alamat wajib diisi!'
                });
                $("#alamat").focus();
                return false;
            }
              if ($("#no_tlp").val() == "") {
                  Lobibox.notify('error', {
                    size: 'mini',
                    icon: true,
                    sound: false,
                    msg: 'No hp wajib diisi!'
                });
                $("#no_tlp").focus();
                return false;
            }

            if ($("#no_tlp").val().length <= 10 || $("#no_tlp").val().length >= 13 ) {
                  Lobibox.notify('error', {
                    size: 'mini',
                    icon: true,
                    sound: false,
                    msg: 'No hp tidak valid!'
                });
                $("#no_tlp").focus();
                return false;
            }
           
        });

     //############## Keyup input bayar #################//
     $("#tgl_lahir").keyup(function(){
        var tgl_lahir = $("#tgl_lahir").val();
        $.ajax({
            type    : "POST",
            url     : 'hitung_umur',
            data    : {'tgl_lahir':tgl_lahir},
            dataType: "json",
            success : function(data){
                    $('#umur').val(data.umur);
                  
            }
        });

    });

    $("#tgl_lahir").change(function(event) {
        event.preventDefault(); 
         var tgl_lahir = $("#tgl_lahir").val();
        $.ajax({
            type    : "POST",
            url     : 'hitung_umur',
            data    : {'tgl_lahir':tgl_lahir},
            dataType: "json",
            success : function(data){
                    $('#umur').val(data.umur);
                  
            }
        });
    });
  

    
</script>