<div class="container-fluid">     
    <div class="card shadow bg-info pt-3">
        <div class="container">
            <h3 class="text-title text-light text-center"> TRANSAKSI </h3>
        </div>
    </div>

    <form method ="POST" id="form-trans" action="#">
    <div class="card shadow mb-4 mt-2">
        <div class="card-body">
            
                
                <div class="row m-auto">
                    <div class="form-group col-md-4 col-md-4">
                        <label>Id Transaksi</label>
                        <input class="form-control" type="number" name="id_transaksi" value="<?php echo $id_transaksi; ?>"  readonly>
                    </div>
                    <div class="form-group col-md-4 col-md-4">
                        <label>Tanggal Transaksi</label>
                        <input class="form-control" type="date" name="tgl_transaksi" value="<?php echo date("Y-m-d") ?>" readonly>
                    </div>
                    
    
                     <div class="form-group col-md-4 col-md-4">
                        <label>Id Registrasi *</label>
                        <select class="form-control" id="id_registrasi" name="id_registrasi">
                            <option value="--pilih--">--Pilih--</option>
                            <?php foreach ($pasien as $p): ?>
                                <option value="<?php echo $p['id_registrasi']; ?>"><?php echo $p['id_registrasi']; ?></option>
                            <?php endforeach ?>
                        </select>
                    </div>

                    <div class="form-group col-md-4">
                        <label>Jenis Periksa</label>
                        <input class="form-control" type="text" name="jenis_periksa" id="jenis_periksa" readonly>
                    </div>

                    <div class="form-group col-md-4">
                        <label>Biaya Tindakan</label>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Rp</span>
                            </div>
                            <input class="form-control" type="text" name="biaya" id="biaya" readonly>
                        </div>
                        
                    </div>

                  
                   

                    
                </div>
             
                    
            
        
        </div>
    </div>
    <div class="card shadow mb-4 mt-2">
        <div class="card-body">
            <div class="table-responsive">
                <table id="table1" name="table1" class="table table-bordered mt-2">
                    <tbody>
                        <tr>
                        <th>Id Obat</th>
                        <th>Nama obat</th>
                        <th>Jumlah</th>
                        <th>Satuan</th>
                        <th>Harga</th>
                        <th>Total</th>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="card shadow mb-4 mt-2">
        <div class="card-body">
            <div class="row">
                <div class="col-md-2 form-group">
                    <label>Total Transaksi :</label>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Rp</span>
                        </div>
                        <input type="text" name="total_transaksi" id="total_transaksi" class="form-control" readonly>
                    </div>
                    
                </div>
                 <div class="col-md-2 form-group">
                    <label>Pembayaran *  :</label>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Rp</span>
                        </div>
                        <input type="text" name="uang" id="uang" class="form-control">
                    </div>
                    
                </div>
                 <div class="col-md-2 form-group">
                    <label>Kembalian :</label>
                     <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Rp</span>
                        </div>
                        <input type="text" name="kembalian" id="kembalian" class="form-control" readonly>
                    </div>
                    
                </div>
                <div class="col-md-6 text-right pt-4 mt-2">
                    <button type="submit" class="btn btn-info" id="btn-simpan" style="width: 25%">Simpan</button>
                    <a href="<?php echo base_url();?>"><button type="button" class="btn btn-danger"><<-Kembali</button></a>
                </div>
            </div>
        </div>
    </div>
    </form>
</div>

<script type="text/javascript">
    var base_url = "<?php echo base_url('transaksi/'); ?>";
     $('#id_registrasi').select2();
      $("#biaya").mask('0.000.000.000',{reverse:true});
      $("#uang").mask('0.000.000.000',{reverse:true});
    $('#id_registrasi').on('change.select2',function(){
        var jml_tr = $("#table1").find("tr").length;
        for (var j = 0; j <= jml_tr; j++) {
            $("#"+j).remove();
        }
        
        var id_registrasi = $('#id_registrasi').val();
        $.ajax({
            type    : "POST",
            url     : 'Transaksi/ambil_data_pasien',
            data    : {'id_registrasi':id_registrasi},
            dataType: "json",
            success : function(data){
                    $('#jenis_periksa').val(data.jenis_periksa);
                    // console.log(data.id_registrasi);
                    var id_registrasi = data.id_registrasi;
                    ambil(id_registrasi);
                    $('#biaya').val(convertToRupiah(data.biaya_tindakan));
                    $('#uang').val("");
                    $('#kembalian').val("");

            }
        });
    }); 

    function ambil(id_registrasi){
       var id_registrasi = id_registrasi;
        $.ajax({
            type    : "POST",
            url     : 'Transaksi/ambil_resep',
            data    : {'id_registrasi':id_registrasi},
            dataType: "json",
            success : function(data){
                    var total_harga_obat = 0;
                    var sub_total_obat = 0;
                    var total_transaksi = 0;
                    var biaya_tindakan = $("#biaya").val();
                    for (var i = 0; i <= data.resep_obat.length; i++) {
                         $("#table1").append('<tr valign="top" id="'+i+'">\n\
                           \n\
                            <td class="id_obat'+i+'">' + '<input class="form-control" type = "text" id="id_obat'+i+'" name="detDetail['+i+'][id_obat]" value="'+ data.resep_obat[i]['id_obat'] +'" readonly>' + '</td>\n\
                            <td class="nama_obat'+i+'">' + '<input class="form-control" type = "text" id="nama_obat'+i+'" name="detDetail['+i+'][nama_obat]" value="'+ data.resep_obat[i]['nama_obat'] +'" readonly>' + '</td>\n\
                            <td class="jml_obat'+i+'">' + '<input class="form-control" type = "number" id="jml_obat'+i+'" name="detDetail['+i+'][jml_obat]" value="'+ data.resep_obat[i]['jml_obat'] +'" readonly>' + '</td>\n\
                            <td class="satuan'+i+'">' + '<input class="form-control" type = "text" id="satuan'+i+'" name="detDetail['+i+'][satuan]" value="'+ data.resep_obat[i]['satuan'] +'" readonly>' + '</td>\n\
                            <td class="harga'+i+'">' + '<div class="input-group mb-3"><div class="input-group-prepend"><span class="input-group-text">Rp</span>     </div><input class="form-control" type = "text" id="harga'+i+'" name="detDetail['+i+'][harga]" value="'+ convertToRupiah(data.resep_obat[i]['harga_jual']) +'" readonly></div>' + '</td>\n\
                            <td class="total_h_obat'+i+'">' + '<div class="input-group mb-3"><div class="input-group-prepend"><span class="input-group-text">Rp</span>     </div><input class="form-control" type = "text" id="total_h_obat'+i+'" name="detDetail['+i+'][total_h_obat]" value="'+ convertToRupiah(data.resep_obat[i]['harga_jual'] * data.resep_obat[i]['jml_obat'])  +'" readonly></div>' + '</td>\n\ </tr>');
                         
                            var sub_total_obat = data.resep_obat[i]['harga_jual'] * data.resep_obat[i]['jml_obat']
                            total_harga_obat += parseInt(sub_total_obat) ;
                            $("#total_transaksi").val(convertToRupiah(total_harga_obat + convertToAngka(biaya_tindakan)));
                    
                    }
                    




                    
            }
        });
       
    }


    

    //############## Keyup input bayar #################//
     $("#uang").keyup(function(){
        var total_bayar = convertToAngka($('#total_transaksi').val());
        var uang = parseInt(convertToAngka($("#uang").val()));
        var kembalian = uang - total_bayar;
        $("#kembalian").val(convertToRupiah(kembalian));

    });


      //############## PROSES SIMPAN DATA #################//
    $("#btn-simpan").click(function(event) {
        event.preventDefault(); 
        if($("#id_registrasi").val() == "--pilih--" ){
            Lobibox.notify('error', {
                size: 'mini',
                icon: true,
                sound: false,
                msg: 'Pilih id registrasi terlebih dulu ...'
            });
            $("#id_registrasi").focus();
            return false;
        }
        if($("#biaya").val() == "" ){
            Lobibox.notify('error', {
                size: 'mini',
                icon: true,
                sound: false,
                msg: 'Masukkan jumlah biaya ...'
            });
            $("#biaya").focus();
            return false;
        }
        if($("#uang").val() == "" ){
            Lobibox.notify('error', {
                size: 'mini',
                icon: true,
                sound: false,
                msg: 'Masukkan jumlah uang...'
            });
            $("#uang").focus();
            return false;
        }

        if(convertToAngka($("#uang").val()) < convertToAngka($("#total_transaksi").val())  ){
            Lobibox.notify('error', {
                size: 'mini',
                icon: true,
                sound: false,
                msg: 'Uang pembayaran kurang dari total transaksi...'
            });
            $("#uang").focus();
            return false;
        }
        var formData    = new FormData($('#form-trans')[0]);
        $.ajax({
            url: "Transaksi/simpan",
            type: "post",
            data: formData,
            cache       : false,
            dataType    : 'json',
            processData : false, 
            contentType : false,
            success : function(data){
            
               if(data.status == 1){
                    var id_transaksi    = data.id_transaksi;
                    var uang            = data.uang;
                    var kembalian       = data.kembalian;
                    var jml             = data.jml;
                     var url = base_url + 'print_struk/' + id_transaksi + '/' + uang + '/' + kembalian + '/' + jml;
                     
                      Lobibox.notify('success', {
                            size: 'mini',
                            icon: true,
                            sound: false,
                            msg: data.pesan
                        });
                      setTimeout(function(){
                        window.open(url,"_blank")
                      },3000);
                      setInterval('location.reload()',3000);

                      $("#table1").find("tr:gt(0)").remove();
                      $("#biaya").val("");
                      $("#total_transaksi").val("");
                      $("#uang").val("");
                      $("#kembalian").val("");
               }

               if(data.status == 2){
                  Lobibox.notify('error', {
                              size: 'mini',
                              icon: true,
                              sound: false,
                              msg: data.pesan
                          });
                   $('#btn-simpan').prop('disabled',false);
              return false;
               }
           },error: function() {
              

              Lobibox.notify('error', {
                size: 'mini',
                icon: true,
                sound: false,
                msg: 'Maaf ada kesalahan saat proses. Silahkan coba kembali!...'
              });
        
              $('#btn-simpan').prop('disabled',false);
              return false;
            }

        });
        
    });

  

    function hanyaHuruf(evt) {
        var charCode = (evt.which) ? evt.which : event.keyCode
        if (charCode > 32 && (charCode < 65 || charCode > 90) && (charCode < 97 || charCode > 122) && charCode > 39)
            return false;
        return true;
    }
</script>