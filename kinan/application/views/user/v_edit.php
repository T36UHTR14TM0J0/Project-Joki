<div class="container-fluid">     
    <div class="card shadow bg-info pt-3">
        <div class="container">
            <h3 class="text-title text-light text-center"> FORM TAMBAH DATA USERS</h3>
        </div>
    </div>

    <div class="card shadow mb-4 mt-2">
        <div class="card-body">
            <form method ="POST" action="<?php echo base_url() . "index.php/User/doUpdate/" ?>">
                <?php foreach ($data_user as $du): ?>
                <div class="form-group col-md-4">
                        <label>ID User</label>
                        <input class="form-control" type="text" name="idUser" value="<?php echo $du['id_user']; ?>" readonly>
                </div>

                <div class="row m-auto">
                     <div class="form-group col-md-4 col-md-4">
                        <label>Nama lengkap *</label>
                        <input class="form-control" type="text" name="nama_lengkap" id="nama_lengkap" value="<?php echo $du['nama_lengkap']; ?>">
                    </div>
                    <div class="form-group col-md-4 col-md-4">
                        <label>Username *</label>
                        <input class="form-control" type="text" name="username" value="<?php echo $du['username']; ?>">
                    </div>
                
                    <div class="form-group col-md-4">
                        <label>Password *</label>
                        <input class="form-control" type="password" name="password" >
                    </div>
                        
                
                    <div class="form-group col-md-4">
                        <label>Level *</label>
                        <div class="input-group-prepend">
                            <input class="input-group-text" type="radio" name="level" value="0" <?php echo ($du['level'] == 0) ? "checked" : ""; ?> />&nbsp;admin&nbsp;&nbsp;&nbsp;
                            <input class="input-group-text" type="radio" name="level" value="1" <?php echo ($du['level'] == 1) ? "checked" : ""; ?>  />&nbsp;apoteker&nbsp;&nbsp;&nbsp;
                            <input class="input-group-text" type="radio" name="level" value="2" <?php echo ($du['level'] == 2) ? "checked" : ""; ?>  />&nbsp;bidan
                        </div>
                    </div>
                <?php endforeach ?>
                  
                    <div class="col-lg-12 text-center">
                        <button type="submit" class="btn btn-info" style="width: 25%">Simpan</button>
                         <a href="<?php echo base_url().'User' ?>"><button type="button" class="btn btn-danger"><<-Kembali</button></a>
                    </div>
                </div>
            </form>
        
        </div>
    </div>
</div>
