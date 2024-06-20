<div class="container-fluid">     
    <div class="card shadow bg-info pt-3">
        <div class="container">
            <h3 class="text-title text-light text-center"> FORM TAMBAH STOK OBAT</h3>
        </div>
    </div>

    <div class="card shadow mb-4 mt-2">
        <div class="card-body">
            <form method ="POST" action="<?php echo base_url() . "obat/proses_stok/" ?>">

                <div class="row m-auto">
                    <div class="form-group  col-md-4 col-md-4">
                        <label for="id_obat">Id Obat *</label>
                        <select class="form-control" id="id_obat" name="id_obat" id="id_obat">
                         <option value="--pilih--">--pilih--</option>
                            <?php foreach ($data_obat as $do): ?>
                                <option value="<?=$do['id_obat'];?>"><?php echo $do["id_obat"]; ?></option>
                            <?php endforeach ?>     
                        </select>
                        
                    </div>
                    
                    <div class="form-group col-md-4">
                        <label>Nama Obat</label>
                        <input class="form-control"  type="text" id="nama_obat" name="nama_obat" readonly>
                    </div>
                    
                    <div class="form-group col-md-4">
                        <label>Harga Beli</label>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Rp</span>
                            </div>
                           <input class="form-control"  type="text" id="harga_beli" name="harga_beli" >
                        </div>
                        
                    </div>

                
                                    
                    <div class="form-group col-md-4">
                        <label>Stok</label>
                        <input class="form-control" type="number" min="0" id="stok" name="stok">
                    </div>
                    

                    <div class="form-group col-md-4">
                        <label>Satuan</label>
                        <input class="form-control" type="text" id="satuan"  name="satuan" readonly>
                    </div>

                    <div class="col-lg-12 text-center">
                        <button type="submit" class="btn btn-info" id="btn-simpan" style="width: 25%">Simpan</button>
                         <a href="<?php echo base_url().'Obat' ?>"><button type="button" class="btn btn-danger"><<-Kembali</button></a>
                    </div>  
                </div>
              
            </form>
        </div>
    </div>
</div>
<script type="text/javascript">
    $("#harga_beli").mask('0.000.000.000',{reverse:true});
    $('#id_obat').select2();

     $('#id_obat').on('change.select2',function(){


        var id_obat = $('#id_obat').val();
        $.ajax({
            type    : "POST",
            url     : 'ambil_data_obat',
            data    : {'id_obat':id_obat},
            dataType: "json",
            success : function(data){
                    $('#nama_obat').val(data.nama_obat);
                    $('#harga_beli').val(convertToRupiah(data.harga_beli));
                    $('#satuan').val(data.satuan);
            }
        });
    }); 

    $("#btn-simpan").click(function(){

         if($("#id_obat").val() == "--pilih--" ){
            Lobibox.notify('error', {
                size: 'mini',
                icon: true,
                sound: false,
                msg: 'Pilih id obat terlebih dulu ...'
            });
            $("#id_obat").focus();
            return false;
        }
        
        if($("#harga_beli").val() == "" ){
            Lobibox.notify('error', {
                size: 'mini',
                icon: true,
                sound: false,
                msg: 'Harga Beli wajib diisi ...'
            });
            $("#harga_beli").focus();
            return false;
        }


        if($("#stok").val() == "" ){
            Lobibox.notify('error', {
                size: 'mini',
                icon: true,
                sound: false,
                msg: 'Stok wajib diisi ...'
            });
            $("#stok").focus();
            return false;
        }

    });
</script>

