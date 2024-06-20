<div class="container-fluid">     
    <div class="card shadow bg-info pt-3">
        <div class="container">
            <h3 class="text-title text-light text-center"> EDIT PEMERIKSAAN KB</h3>
        </div>
    </div>

    <div class="card shadow mb-4 mt-2">
        <div class="card-body">
            <form method ="POST" action="<?php echo base_url() . "index.php/Pel_kb/doUpdate/" ?>">
                
                <div class="row m-auto">
                    <?php foreach ($data_kb as $dk): ?>
                        <div class="form-group col-md-4 col-md-4">
                            <label>Id Registrasi</label>
                            <input class="form-control" type="text" name="id_registrasi" id="id_registrasi" value="<?php echo $dk['id_registrasi']; ?>"  readonly>
                        </div>
                         <div class="form-group col-md-4 col-md-4">
                            <label>Tanggal Periksa</label>
                            <input class="form-control" type="date" name="tgl_periksa" id="tgl_periksa" value="<?php echo date('Y-m-d',strtotime($dk['tgl_periksa']))?>" readonly>
                        </div>
                        <div class="form-group col-md-4 col-md-4">
                            <label>Id Kb</label>
                            <input class="form-control" type="text" name="id_kb" id="id_kb" value="<?php echo $dk['id_kb']; ?>"  readonly>
                        </div>
                        <div class="form-group col-md-4 col-md-4">
                            <label>Nama Istri</label>
                            <input onkeypress="return hanyaHuruf(event)" class="form-control" type="text" id="nama_pasien" name="nama_pasien" value="<?php echo $dk['nama_pasien']; ?>" readonly>
                        </div>
        
                         <div class="form-group col-md-4 col-md-4">
                            <label>Nama Suami *</label>
                            <input onkeypress="return hanyaHuruf(event)" class="form-control" type="text" id="nama_suami" name="nama_suami" value="<?php echo $dk['nama_suami'] ?>">
                        </div>

                        <div class="form-group col-md-4">
                            <label>Tekanan Darah *</label>
                            <div class="input-group mb-3"> 
                                 <input class="form-control" type="text" name="td" id="td" title="Tinggi Darah" value="<?php echo $dk['td'] ?>">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">mmHg</span>
                                </div>
                            </div>
                            
                        </div>

                        <div class="form-group col-md-4">
                            <label>Berat Badan *</label>
                            <div class="input-group mb-3"> 
                                 <input class="form-control" type="number" name="bb" id="bb" title="Berat Badan" step="0.1" value="<?php echo $dk['bb'] ?>">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Kg</span>
                                </div>
                            </div>
                            
                        </div>
                         <div class="form-group col-md-4">
                            <label>Jenis Kb *</label>
                            <select class="form-control" id="jenis_kb" name="jenis_kb">
                                <option value="Pil Kb"<?php if ($dk['jenis_kb'] == 'Pil Kb'){echo 'selected';} ?>>Pil Kb</option>
                                <option value="Suntik Kb" <?php if ($dk['jenis_kb'] == 'Suntik Kb'){echo 'selected';} ?>>Suntik Kb</option>
                            </select>
                        </div>
                        <div class="form-group col-md-4 col-md-4">
                            <label>Tanggal kembali *</label>
                            <input class="form-control" type="date" name="tgl_kembali" id="tgl_kembali" value="<?php echo date('Y-m-d',strtotime($dk['tgl_kembali']))?>">
                        </div>
                         <div class="form-group col-md-4">
                            <label>Biaya *</label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Rp</span>
                                </div>
                                <input class="form-control" value="<?php echo number_format($dk['biaya'],0,',','.') ?>" type="text" name="biaya" id="biaya">
                            </div>
                            
                        </div>
                    <?php endforeach ?>
                   

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
     $("#biaya").mask('0.000.000.000',{reverse:true});
     $("#btn-simpan").click(function(event){
        if ($("#nama_pasien").val() == "pilih") {
                  Lobibox.notify('error', {
                    size: 'mini',
                    icon: true,
                    sound: false,
                    msg: 'pilih nama ibu hamil terlebih dulu ...'
                });
                $("#nama_pasien").focus();
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
   
    function hanyaHuruf(evt) {
        var charCode = (evt.which) ? evt.which : event.keyCode
        if (charCode > 32 && (charCode < 65 || charCode > 90) && (charCode < 97 || charCode > 122) && charCode > 39)
            return false;
        return true;
    }
</script>