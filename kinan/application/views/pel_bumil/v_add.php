<div class="container-fluid">     
    <div class="card shadow bg-info pt-3">
        <div class="container">
            <h3 class="text-title text-light text-center">TAMBAH PEMERIKSAAN IBU HAMIL</h3>
        </div>
    </div>

    <div class="card shadow mb-4 mt-2">
        <div class="card-body">
            <form method ="POST" action="<?php echo base_url() . "index.php/pel_bumil/processAdd/" ?>">
                
                <div class="row m-auto">
                    <div class="form-group  col-md-4 col-md-4">
                        <label for="id_registrasi">Id Registrasi *</label>
                        <select class="form-control" id="id_registrasi" name="id_registrasi">
                         <option value="">--pilih--</option>
                            <?php foreach ($id_registrasi as $p): ?>
                                <option value="<?=$p['id_registrasi'];?>"><?php echo $p["id_registrasi"]; ?></option>
                            <?php endforeach ?>     
                        </select>
                        
                    </div>
                     
                    <div class="form-group col-md-4 col-md-4">
                        <label>Tanggal Periksa</label>
                        <input class="form-control" type="date" name="tgl_periksa" value="<?php echo date(
                        'Y-m-d');?>" readonly>
                    </div>
                    <div class="form-group col-md-4 col-md-4">
                        <label>Id Ibu Hamil</label>
                        <input class="form-control" type="text" name="id_bumil" value="<?php echo $id_bumil; ?>"  readonly>
                        <input class="form-control" type="hidden" name="id_pasien" id="id_pasien" readonly>
                    </div>

                    <div class="form-group col-md-4 col-md-4">
                        <label>Nama Ibu Hamil *</label>
                        <input class="form-control" type="text" id="nama_bumil" name="nama_bumil" readonly>
                    </div>
                     

                    <div class="form-group col-md-4">
                        <label for="jenis">Jenis Periksa *</label>
                        <select class="form-control" id="jenis" name="jenis">
                            <option value="">--pilih--</option>
                            <option>Nifas</option>
                            <option>Periksa</option>
                            <option>persalinan</option>
                            
                        </select>
                    </div>

                     <div class="form-group col-md-4">
                        <label>Hari Perkiraan Haid Terakhir *</label>
                        <input class="form-control" type="date" name="hpht" id="hpht">
                    </div>
                        
                    <div class="form-group col-md-4 col-md-4">
                        <label>Nama Suami *</label>
                        <input class="form-control" type="text" name="nama_suami" id="nama_suami">
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
                        <label>Hari Perkiraan Lahir *</label>
                        <input class="form-control" type="date" name="hpl" id="hpl">
                    </div>
                    <div class="form-group col-md-4">
                        <label>Tinggi Fundus Uteri *</label>
                        <div class="input-group mb-3"> 
                            <input class="form-control" type="number" min="0" name="tfu" id="tfu">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Cm</span>
                            </div>
                        </div>
                        
                    </div>
                    <div class="form-group col-md-4">
                        <label>Presentasi *</label>
                       <input class="form-control" type="text" name="presentasi" id="presentasi">
                    </div>

                    <div class="form-group col-md-4">
                        <label>Detak Jantung Janin *</label>
                         <div class="input-group mb-3"> 
                          <input class="form-control" type="text" name="djj" id="djj">
                            <div class="input-group-prepend">
                                <span class="input-group-text">denyut/menit</span>
                            </div>
                        </div>
                        
                    </div>

                    <div class="form-group col-md-4">
                        <label>Tindakan *</label>
                        <input class="form-control" type="text" name="tindakan" id="tindakan">
                    </div>
                    <div class="form-group col-md-4">
                        <label>Tanggal Kembali *</label>
                        <input class="form-control" type="date" name="tgl_kembali" id="tgl_kembali">
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
                         <a href="<?php echo base_url().'pel_bumil' ?>"><button type="button" class="btn btn-danger"><<-Kembali</button></a>
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
                        $('#nama_bumil').val(data.nama_bumil);
                }
            });
        }); 

     $("#btn-simpan").click(function(event){
            if ($("#id_registrasi").val() == "") {
                  Lobibox.notify('error', {
                    size: 'mini',
                    icon: true,
                    sound: false,
                    msg: 'Pilih id registrasi terlebih dulu...'
                });
                $("#id_registrasi").focus();
                return false;
            }

            if ($("#jenis").val() == "") {
                  Lobibox.notify('error', {
                    size: 'mini',
                    icon: true,
                    sound: false,
                    msg: 'Jenis Periksa wajib di isi...'
                });
                $("#jenis").focus();
                return false;
            }

            if ($("#hpht").val() == "") {
                  Lobibox.notify('error', {
                    size: 'mini',
                    icon: true,
                    sound: false,
                    msg: 'Hpht wajib di isi...'
                });
                $("#hpht").focus();
                return false;
            }

            if ($("#nama_suami").val() == "") {
                  Lobibox.notify('error', {
                    size: 'mini',
                    icon: true,
                    sound: false,
                    msg: 'nama suami wajib di isi...'
                });
                $("#nama_suami").focus();
                return false;
            }

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

            if ($("#bb").val() == "" || $("#bb").val() == "0") {
                  Lobibox.notify('error', {
                    size: 'mini',
                    icon: true,
                    sound: false,
                    msg: 'Berat badan tidak boleh kosong atau 0...'
                });
                $("#bb").focus();
                return false;
            }

            if ($("#hpl").val() == "") {
                  Lobibox.notify('error', {
                    size: 'mini',
                    icon: true,
                    sound: false,
                    msg: 'Hpl wajib di isi...'
                });
                $("#hpl").focus();
                return false;
            }

            if ($("#tfu").val() == "") {
                  Lobibox.notify('error', {
                    size: 'mini',
                    icon: true,
                    sound: false,
                    msg: 'Tfu wajib di isi...'
                });
                $("#tfu").focus();
                return false;
            }

            if ($("#presentasi").val() == "") {
                  Lobibox.notify('error', {
                    size: 'mini',
                    icon: true,
                    sound: false,
                    msg: 'Presentasi wajib di isi!'
                });
                $("#presentasi").focus();
                return false;
            }

            if ($("#djj").val() == "") {
                  Lobibox.notify('error', {
                    size: 'mini',
                    icon: true,
                    sound: false,
                    msg: 'Djj wajib di isi!'
                });
                $("#djj").focus();
                return false;
            }

            if ($("#tindakan").val() == "") {
                  Lobibox.notify('error', {
                    size: 'mini',
                    icon: true,
                    sound: false,
                    msg: 'Tindakan wajib di isi!'
                });
                $("#tindakan").focus();
                return false;
            }

            if ($("#keterangan").val() == "") {
                  Lobibox.notify('error', {
                    size: 'mini',
                    icon: true,
                    sound: false,
                    msg: 'Keterangan wajib di isi!'
                });
                $("#keterangan").focus();
                return false;
            }

            if ($("#tgl_kembali").val() == "") {
                  Lobibox.notify('error', {
                    size: 'mini',
                    icon: true,
                    sound: false,
                    msg: 'Tanggal Kembali wajib di isi!'
                });
                $("#tgl_kembali").focus();
                return false;
            }



           
        });
</script>