<div class="container-fluid">     
    <div class="card shadow bg-info pt-3">
        <div class="container">
            <h3 class="text-title text-light text-center"> FORM EDIT DATA OBAT</h3>
        </div>
    </div>

    <div class="card shadow mb-4 mt-2">
        <div class="card-body">
            <form method ="POST" action="<?php echo base_url() . "obat/doUpdate/" ?>">
                

                <div class="row m-auto">
                    <?php foreach ($data_obat as $do): ?>
                        <div class="form-group col-md-4">
                        <label>Id Obat</label>
                        <input class="form-control" id="id_obat" type="text" name="id_obat" value="<?php echo $do['id_obat']; ?>" readonly>
                    </div>
                    
                    <div class="form-group col-md-4">
                        <label>Nama Obat</label>
                        <input class="form-control" id="nama_obat" type="text" name="nama_obat" value="<?php echo $do['nama_obat']; ?>" readonly>
                    </div>
                    
                    <div class="form-group col-md-4">
                        <label>Harga Beli</label>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Rp</span>
                            </div>
                            <input class="form-control" id="harga_beli" type="text" name="harga_beli" value="<?php echo $do['harga_beli'] ?>" readonly>
                        </div>
                    </div>

                    <div class="form-group col-md-4">
                        <label>Harga jual *</label>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Rp</span>
                            </div>
                            <input class="form-control" id="harga_jual" type="text" name="harga_jual" value="<?php echo $do['harga_jual'] ?>" >
                        </div>
                    </div>
                                    
                    <div class="form-group col-md-4">
                        <label>Stok</label>
                        <input class="form-control" type="number" id="stok" name="stok" value="<?php echo $do['stok']; ?>" readonly>
                    </div>
                    

                    <div class="form-group col-md-4">
                        <label>Satuan</label>
                        <input class="form-control" type="text" id="satuan" name="satuan" value="<?php echo $do['satuan']; ?>" readonly>
                    </div>

                 
                    <?php endforeach ?>
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


