<div class="container-fluid">     
    <div class="card shadow bg-info pt-3">
        <div class="container">
            <h3 class="text-title text-light text-center"> FORM TAMBAH DATA USERS</h3>
        </div>
    </div>

    <div class="card shadow mb-4 mt-2">
        <div class="card-body">
            <form method ="POST" action="<?php echo base_url() . "index.php/User/processAdd/" ?>">
                
                <div class="row m-auto">
                    <div class="form-group col-md-4 col-md-4">
                        <label>Nama lengkap *</label>
                        <input class="form-control" type="text" name="nama_lengkap" id="nama_lengkap" onkeypress="return hanyaHuruf(event)" title="nama_lengkap" required>
                    </div>
                    <div class="form-group col-md-4 col-md-4">
                        <label>Username *</label>
                        <input class="form-control" type="text" name="username" id="username" onkeypress="return hanyaHuruf(event)" title="Username" required>
                    </div>
                
                    <div class="form-group col-md-4">
                        <label>Password *</label>
                        <input class="form-control" type="password" name="password" id="password" title="password"required>
                    </div>
                        
                    <div class="form-group col-md-4">
                        <label>Level *</label>
                        <div class="input-group-prepend">
                            <input class="input-group-text" type="radio" name="level" value="0" />&nbsp;admin&nbsp;&nbsp;&nbsp;
                            <input class="input-group-text" type="radio" name="level" value="1" />&nbsp;apoteker&nbsp;&nbsp;&nbsp;
                            <input class="input-group-text" type="radio" name="level" value="2" />&nbsp;bidan
                        </div>
                    </div>
                  
                    <div class="col-lg-12 text-center">
                        <button type="submit" class="btn btn-info" style="width: 25%">Simpan</button>
                         <a href="<?php echo base_url().'User' ?>"><button type="button" class="btn btn-danger"><<-Kembali</button></a>
                    </div>
                </div>
            </form>
        
        </div>
    </div>
</div>

<script type="text/javascript">
    function hanyaHuruf(evt) {
        var charCode = (evt.which) ? evt.which : event.keyCode
        if (charCode > 32 && (charCode < 65 || charCode > 90) && (charCode < 97 || charCode > 122) && charCode > 39)
            return false;
        return true;
    }
</script>