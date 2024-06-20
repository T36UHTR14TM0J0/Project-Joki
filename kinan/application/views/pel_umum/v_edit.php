<div class="container-fluid">     
    <div class="card shadow bg-info pt-3">
        <div class="container">
            <h3 class="text-title text-light text-center">EDIT PEMERIKSAAN BIASA</h3>
        </div>
    </div>

    <div class="card shadow mb-4 mt-2">
        <div class="card-body">
            <form method ="POST" action="<?php echo base_url() . "index.php/pel_umum/doUpdate/" ?>"> 
                
                <div class="row m-auto">
                    <?php foreach ($data_pel_biasa as $dpb): ?>
                        <div class="form-group col-md-4 col-md-4">
                            <label>Id Registrasi</label>
                            <input autocomplete="off" class="form-control" type="text" name="id_registrasi" value="<?php echo $dpb['id_registrasi']; ?>"  readonly>
                        </div>
                         <div class="form-group col-md-4 col-md-4">
                            <label>Tanggal Periksa</label>
                            <input autocomplete="off" id="tgl_periksa" class="form-control" id="tgl_periksa" value="<?php echo $dpb['tgl_periksa']; ?>" type="date" name="tgl_periksa" readonly>
                        </div>
                        <div class="form-group col-md-4 col-md-4">
                            <label>Id Pasien</label>
                            <input autocomplete="off" class="form-control" type="text" name="id" value="<?php echo $dpb['id']; ?>"  readonly>
                        </div>
                        <div class="form-group col-md-4 col-md-4">
                            <label>Nama Pasien</label>
                            <input autocomplete="off" id="nama_pasien" class="form-control" type="text" id="nama_pasien" name="nama_pasien" readonly value="<?php echo $dpb['nama_pasien']; ?>" >
                        </div>
                         <div class="form-group col-md-4">
                            <label>Tinggi Badan *</label>
                            <div class="input-group mb-3"> 
                                 <input class="form-control" type="number" min="0" step="0.1" name="tb" id="tb" value="<?php echo $dpb['tb']; ?>">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Cm</span>
                                </div>
                            </div>
                           
                        </div>
                        <div class="form-group col-md-4">
                            <label>Berat Badan *</label>
                            <div class="input-group mb-3"> 
                                <input class="form-control" type="number" min="0" step="0.1" name="bb" id="bb" value="<?php echo $dpb['bb']; ?>">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Kg</span>
                                </div>
                            </div>
                            
                        </div>
                        <div class="form-group col-md-4">
                            <label>Tekanan Darah *</label>
                            <div class="input-group mb-3"> 
                                <input class="form-control" type="text" name="td" id="td" value="<?php echo $dpb['td']; ?>">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">mmHg</span>
                                </div>
                            </div>
                            
                        </div>
        
                         <div class="form-group col-md-4 col-md-4">
                            <label>Keluhan *</label>
                            <input autocomplete="off" id="keluhan" class="form-control" type="text" name="keluhan" id="keluhan" onkeypress="return hanyaHuruf(event)" value="<?php echo $dpb['keluhan'] ?>">
                        </div>
                        <div class="form-group col-md-4">
                        <label>Biaya *</label>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Rp</span>
                            </div>
                            <input class="form-control" value="<?php echo $dpb['biaya'] ?>" type="text" name="biaya" id="biaya">
                        </div>
                        
                    </div>

        
                    <?php endforeach ?>
                   

                    <div class="col-lg-12 text-center">
                        <button type="submit" id="btn-simpan" class="btn btn-info" style="width: 25%">Simpan</button>
                         <a href="<?php echo base_url().'pel_umum' ?>"><button type="button" class="btn btn-danger"><<-Kembali</button></a>
                    </div>
                </div>
             
                    
            </form>
        
        </div>
    </div>

</div>

<script type="text/javascript">
    $("#biaya").mask('0.000.000.000',{reverse:true});
    $("#btn-simpan").click(function(event){
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