<div class="container-fluid">     
    <div class="card shadow bg-info pt-3">
        <div class="container">
            <h3 class="text-title text-light text-center"> FORM TAMBAH DATA OBAT</h3>
        </div>
    </div>

    <div class="card shadow mb-4 mt-2">
        <div class="card-body">
            <form method ="POST" action="<?php echo base_url() . "index.php/Obat/processAdd/" ?>">
                
              
                <div class="row m-auto">
                    <div class="form-group col-md-4 col-md-4">
                        <label>Nama Obat *</label>
                        <input class="form-control text-lower" type="text" name="nama_obat" id="nama_obat">
                    </div>
                
                    <div class="form-group col-md-4">
                        <label>Harga Beli *</label>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Rp</span>
                            </div>
                            <input class="form-control" type="text" name="harga_beli" id="harga_beli">
                        </div>
                        
                    </div>
                        
                   <div class="form-group col-md-4">
                        <label>Harga Jual *</label>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Rp</span>
                            </div>
                             <input class="form-control" type="text" name="harga_jual" id="harga_jual">
                        </div>
                       
                    </div>
                    <div class="form-group col-md-4">
                        <label>Stok *</label>
                        <input class="form-control" min="0"  type="number" name="stok" id="stok">
                    </div>
                    <div class="form-group col-md-4">
                        <label>Satuan *</label>
                        <select class="form-control" name="satuan" id="satuan">
                            <option>--Pilih--</option>
                            <option value="ampul">ampul</option>
                            <option value="tablet">tablet</option>
                            <option value="pen">pen</option>
                            <option value="ml">ml</option>
                            
                        </select>
                    </div>
                </div>
                <div class="col-lg-12 text-center">
                        <button type="submit" class="btn btn-info" id="btn-simpan" style="width: 25%">Simpan</button>
                         <a href="<?php echo base_url().'Obat' ?>"><button type="button" class="btn btn-danger"><<-Kembali</button></a>
                </div>
            </form>
        
        </div>
    </div>
</div>

<script type="text/javascript">
    $("#harga_beli").mask('0.000.000.000',{reverse:true});
    $("#harga_jual").mask('0.000.000.000',{reverse:true});

    $("#btn-simpan").click(function(){
        if($("#nama_obat").val() == "" ){
            Lobibox.notify('error', {
                size: 'mini',
                icon: true,
                sound: false,
                msg: 'Nama obat wajib diisi ...'
            });
            $("#nama_obat").focus();
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


        if($("#harga_jual").val() == "" ){
            Lobibox.notify('error', {
                size: 'mini',
                icon: true,
                sound: false,
                msg: 'Harga jual wajib diisi ...'
            });
            $("#harga_jual").focus();
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

        if($("#satuan").val() == "" ){
            Lobibox.notify('error', {
                size: 'mini',
                icon: true,
                sound: false,
                msg: 'Satuan wajib diisi ...'
            });
            $("#satuan").focus();
            return false;
        }
    });
</script>