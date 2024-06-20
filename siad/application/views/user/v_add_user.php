<!-- ### CONTENT WRAPPER ### -->
<div class="content-wrapper">
  <!-- **** JUDUL HALAMAN -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="card">
        <div class="card-body border border-primary rounded-lg shadow-sm">
          <div class="row">
            <div class="col-sm-6">
              <h1 class="text-primary">&nbsp;TAMBAH USER</h1>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- *** BOX CONTENT -->
  <div class="content-body">
    <div class="container">
      <div class="card">
        <form method="POST" action="<?php echo base_url('C_user/proses_add'); ?>" enctype="multipart/form-data">
          <div class="card-body">
            <div class="row">

                <div class="form-group col-md-4">
                  <label class="text-primary">ID USER</label>
                  <input type="text" name="id_user" class="form-control" id="id_user" value="<?php echo $id_user; ?>" readonly>
                </div>

                <div class="form-group col-md-4">
                  <label class="text-primary">USERNAME</label>
                  <input type="text" name="username" class="form-control" id="username">
                </div>

                <div class="form-group col-md-4">
                  <label class="text-primary">PASSWORD</label>
                  <input type="password" name="password" class="form-control" id="password">
                </div>

              </div>
          </div>

          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" id="btn-kembali" >Kembali</button>
            <button type="submit" class="btn btn-primary" id="btn-simpan">Simpan</button>
          </div>

        </form>
      </div>
    </div>
  </div>
</div>


<script type="text/javascript">
  $("#btn-simpan").click(function(event){
    // event.preventDefault();

    if ($("#username").val() == "") {
      Lobibox.notify('error', {
        size: 'mini',
        icon: true,
        sound: false,
        msg: 'Username wajib diisi...!'
      });
      $("#username").focus();
      return false;
    }

    if ($("#password").val() == "") {
      Lobibox.notify('error', {
        size: 'mini',
        icon: true,
        sound: false,
        msg: 'password wajib diisi...!'
      });
      $("#password").focus();
      return false;
    } 
  });

  $("#btn-kembali").click(function(){
    window.location.href = "<?php echo base_url('C_user'); ?>";
  })
</script>
