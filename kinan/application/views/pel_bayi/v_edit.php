<div class="container-fluid">     
    <div class="card shadow bg-info pt-3">
        <div class="container">
            <h3 class="text-title text-light text-center"> EDIT PEMERIKSAAN BAYI & BALITA</h3>
        </div>
    </div>

    <div class="card shadow mb-4 mt-2">
        <div class="card-body">
            <form method ="POST" action="<?php echo base_url() . "index.php/pel_bayi/doUpdate/" ?>">
                <?php foreach ($data_bayi as $bayi): ?>
               
                <div class="row m-auto">
                    <div class="form-group col-md-4">
                        <label>ID Registrasi</label>
                        <input class="form-control" type="text" name="id_registrasi" id="id_registrasi" value="<?php echo $bayi['id_registrasi']; ?>" readonly>
                         <input class="form-control" type="hidden" name="id_pasien" id="id_pasien" value="<?php echo $bayi['id_pasien']; ?>">
                    </div>
                    <div class="form-group col-md-4 col-md-4">
                        <label>Tanggal Periksa</label>
                        <input class="form-control" type="date" name="tgl_periksa" id="tgl_periksa" value="<?php echo date('Y-m-d',strtotime($bayi['tgl_periksa'])); ?>" readonly>
                    </div>
                    <div class="form-group col-md-4">
                        <label>ID bayi</label>
                        <input class="form-control" type="text" name="id_bayi" id="id_bayi" value="<?php echo $bayi['id_bayi']; ?>" readonly>
                    </div>
                
                    <div class="form-group col-md-4">
                        <label>Nama bayi</label>
                        <input class="form-control" type="text" name="nama_bayi" id="nama_bayi" value="<?php echo $bayi['nama_bayi']; ?>" readonly>
                    </div>
                      <div class="form-group col-md-4">
                        <label>Nama Ibu *</label>
                        <input class="form-control" type="text" name="nama_ibu" id="nama_ibu" onkeypress="return hanyaHuruf(event)" value="<?php echo $bayi['nama_ibu']; ?>">
                    </div>
                        
                     <div class="form-group col-md-4">
                        <label>Jenis *</label>
                        <select class="form-control" id="jenis" name="jenis">
                            <option value="<?php echo $bayi['jenis'] ;?>"><?php echo $bayi['jenis'] ;?></option>
                            <option value="periksa">Periksa</option>
                            <option value="imunisasi">Imunisasi</option>  
                        </select>

                    </div>

                    <div class="form-group  col-md-4 col-md-4 jenis_imun">
                        <label for="jenis_imun">jenis Imunisasi *</label>
                        <select class="form-control" name="jenis_imun" id="jenis_imun">
                            <option value="">--pilih--</option>
                            <option value="HB"  <?php if($bayi["jenis_imun"] == "HB") {echo 'selected';} ?>>HB</option>
                            <option value="BCE"  <?php if($bayi["jenis_imun"] == "BCE") {echo 'selected';} ?>>BCE</option> 
                            <option value="HB-0"  <?php if($bayi["jenis_imun"] == "HB-0") {echo 'selected';} ?>>HB-0</option> 
                            <option value="POLIO 1"  <?php if($bayi["jenis_imun"] == "POLIO 1") {echo 'selected';} ?>>POLIO 1</option>  
                            <option value="POLIO 2"  <?php if($bayi["jenis_imun"] == "POLIO 2") {echo 'selected';} ?>>POLIO 2</option> 
                            <option value="POLIO 3"  <?php if($bayi["jenis_imun"] == "POLIO 3") {echo 'selected';} ?>>POLIO 3</option>
                            <option value="POLIO -0"  <?php if($bayi["jenis_imun"] == "POLIO -0") {echo 'selected';} ?>>POLIO -0</option> 
                            <option value="CAMPAK"  <?php if($bayi["jenis_imun"] == "CAMPAK") {echo 'selected';} ?>>CAMPAK</option> 
                        </select>
                        
                    </div>

                     <div class="form-group col-md-4">
                        <label>Berat Badan *</label>
                        <div class="input-group mb-3"> 
                             <input class="form-control" type="number" id="bb" name="bb" value="<?php echo $bayi['bb']; ?>">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Kg</span>
                            </div>
                        </div>
                       
                    </div>
                    <div class="form-group col-md-4">
                        <label>Tinggi / Panjang Badan *</label>
                        <div class="input-group mb-3"> 
                            <input class="form-control" type="number" id="tb" name="tb" value="<?php echo $bayi['tb']; ?>">
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
                            <input class="form-control" value="<?php echo $bayi['biaya'] ?>" type="text" name="biaya" id="biaya">
                        </div>
                        
                    </div>
                   
                   
                   
                <?php endforeach ?>
                  
                    <div class="col-lg-12 text-center">
                        <button type="submit" class="btn btn-info" id="btn-simpan" style="width: 25%">Simpan</button>
                         <a href="<?php echo base_url().'pel_bayi' ?>"><button type="button" class="btn btn-danger"><<-Kembali</button></a>
                    </div>
                </div>
            </form>
        
        </div>
    </div>
</div>

<script type="text/javascript">
    $("#biaya").mask('0.000.000.000',{reverse:true});
     // $('.jenis_imun').hide();
        $("#jenis").change(function(){
            var jenis_p = $('#jenis').val();
            // $('.container-optional').empty();
            if(jenis_p == 'imunisasi'){
                $('.jenis_imun').show();
            }else {
                $('.jenis_imun').hide();
                $("#jenis_imun").val("");
            }
        });
    $("#btn-simpan").click(function(event){
        if ($("#nama_bayi").val() == "") {
                  Lobibox.notify('error', {
                    size: 'mini',
                    icon: true,
                    sound: false,
                    msg: 'pilih nama bayi terlebih dulu ...'
                });
                $("#nama_bayi").focus();
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