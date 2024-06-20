<div class="container-fluid">     
    <div class="card shadow bg-info pt-3">
        <div class="container">
            <h3 class="text-title text-light text-center"> EDIT PEMERIKSAAN IBU HAMIL</h3>
        </div>
    </div>

    <div class="card shadow mb-4 mt-2">
        <div class="card-body">
            <form method ="POST" action="<?php echo base_url() . "index.php/pel_bumil/doUpdate/" ?>">
                 
                <div class="row m-auto">
                    <?php foreach ($data_bumil as $db): ?>
                    <div class="form-group col-md-4 col-md-4">
                        <label>Id Registrasi</label>
                        <input class="form-control" type="text" name="id_registrasi" value="<?php echo $db['id_registrasi']; ?>"  readonly>
                    </div>
                    <div class="form-group col-md-4 col-md-4">
                        <label>Tanggal Periksa</label>
                        <input class="form-control" type="date" name="tgl_periksa" value="<?php echo $db['tgl_periksa'] ?>" readonly>
                    </div>
                    <div class="form-group col-md-4 col-md-4">
                        <label>Id Ibu Hamil</label>
                        <input class="form-control" type="text" name="id_bumil" value="<?php echo $db['id_bumil']; ?>"  readonly>
                    </div>
                     <div class="form-group  col-md-4 col-md-4">
                        <label for="nama_pasien">Nama Ibu Hamil</label>
                        <input type="text" name="nama_pasien" id="nama_pasien" class="form-control" 
                        value="<?php echo $db['nama_pasien'] ?>" readonly>
                    </div>


                    <div class="form-group col-md-4">
                        <label for="jenis">Jenis Periksa *</label>
                        <select class="form-control" id="jenis" name="jenis">
                            <?php 
                                $select = '';
                                if ($db['jenis'] === 'Nifas') {
                                    $select = 'selected';

                                }else if ($db['jenis'] === 'Periksa'){
                                    $select = 'selected';
                                }else{
                                    $select = 'selected';
                                }
                            ?>
                            <option <?php echo $select; ?>><?php echo $db['jenis']; ?></option>
                            <option >Nifas</option>
                            <option >Periksa</option>
                            <option >persalinan</option>
                            
                        </select>
                    </div>

                     <div class="form-group col-md-4">
                        <label>Hari Perkiraan Haid Terakhir *</label>
                        <input class="form-control" type="date" name="hpht" id="hpht" value="<?php echo $db['hpht'] ?>">
                    </div>
                        
                    <div class="form-group col-md-4 col-md-4">
                        <label>Nama Suami *</label>
                        <input class="form-control" type="text" name="nama_suami" id="nama_suami" value="<?php echo $db['nama_suami'] ?>">
                    </div>

                    <div class="form-group col-md-4">
                        <label>Tekanan Darah *</label>
                        <div class="input-group mb-3"> 
                           <input class="form-control" type="text" name="td" id="td" value="<?php echo $db['td'] ?>">
                            <div class="input-group-prepend">
                                <span class="input-group-text">mmHg</span>
                            </div>
                        </div>
                        
                    </div>
                    
                     <div class="form-group col-md-4">
                        <label>Berat Badan *</label>
                        <div class="input-group mb-3"> 
                            <input class="form-control" type="number" name="bb" id="bb" value="<?php echo $db['bb'] ?>">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Kg</span>
                            </div>
                        </div>
                       
                    </div>
                    <div class="form-group col-md-4">
                        <label>Hari Perkiraan Lahir *</label>
                        <input class="form-control" type="date" name="hpl" id="hpl" value="<?php echo $db['hpl'] ?>">
                    </div>
                    <div class="form-group col-md-4">
                        <label>Tinggi Fundus Uteri *</label>
                        <div class="input-group mb-3"> 
                            <input class="form-control" type="text" name="tfu" id="tfu" value="<?php echo $db['tfu'] ?>">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Cm</span>
                            </div>
                        </div>
                        
                    </div>
                    <div class="form-group col-md-4">
                        <label>Presentasi *</label>
                       <input class="form-control" type="text" name="presentasi" id="presentasi" value="<?php echo $db['presentasi'] ?>">
                    </div>

                    <div class="form-group col-md-4">
                        <label>Detak Jantung Janin *</label>
                        <div class="input-group mb-3"> 
                            <input class="form-control" type="text" name="djj" id="djj" value="<?php echo $db['djj'] ?>">
                            <div class="input-group-prepend">
                                <span class="input-group-text">denyut/detik</span>
                            </div>
                        </div>
                        
                    </div>

                    <div class="form-group col-md-4">
                        <label>Tindakan *</label>
                        <input class="form-control" type="text" name="tindakan" id="tindakan" value="<?php echo $db['tindakan'] ?>">
                    </div>
                    <div class="form-group col-md-4">
                        <label>Tanggal Kembali *</label>
                        <input class="form-control" type="date" name="tgl_kembali" id="tgl_kembali" value="<?php echo $db['tgl_kembali'] ?>">
                    </div>
                    <div class="form-group col-md-4">
                        <label>Biaya *</label>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Rp</span>
                            </div>
                            <input class="form-control" value="<?php echo $db['biaya'] ?>" type="text" name="biaya" id="biaya">
                        </div>
                        
                    </div>

                    <?php endforeach ?>


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
       $("#biaya").mask('0.000.000.000',{reverse:true});
     $("#btn-simpan").click(function(event){
            if ($("#nama_bumil").val() == "") {
                  Lobibox.notify('error', {
                    size: 'mini',
                    icon: true,
                    sound: false,
                    msg: 'pilih nama ibu hamil terlebih dulu...'
                });
                $("#nama_bumil").focus();
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
                    msg: 'Presentasi wajib di isi...'
                });
                $("#presentasi").focus();
                return false;
            }

            if ($("#djj").val() == "") {
                  Lobibox.notify('error', {
                    size: 'mini',
                    icon: true,
                    sound: false,
                    msg: 'Djj wajib di isi...'
                });
                $("#djj").focus();
                return false;
            }

            if ($("#tindakan").val() == "") {
                  Lobibox.notify('error', {
                    size: 'mini',
                    icon: true,
                    sound: false,
                    msg: 'Tindakan wajib di isi...'
                });
                $("#tindakan").focus();
                return false;
            }

            if ($("#keterangan").val() == "") {
                  Lobibox.notify('error', {
                    size: 'mini',
                    icon: true,
                    sound: false,
                    msg: 'Keterangan wajib di isi...'
                });
                $("#keterangan").focus();
                return false;
            }

            if ($("#tgl_kembali").val() == "") {
                  Lobibox.notify('error', {
                    size: 'mini',
                    icon: true,
                    sound: false,
                    msg: 'Tanggal Kembali wajib di isi...'
                });
                $("#tgl_kembali").focus();
                return false;
            }



           
        });
</script>