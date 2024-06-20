
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="card">
          <div class="card-body border border-primary rounded-lg shadow-sm">
            <div class="row">
              <div class="col-sm-6">
                <h1 class="text-primary">&nbsp;EDIT JENIS PEMBAYARAN</h1>
              </div>
            </div>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </div>

  <div class="content-body">
    <div class="container">
      <div class="card">
        <form method="POST" action="<?php echo base_url('C_jenis_pembayaran/proses_edit'); ?>" enctype="multipart/form-data">
          <?php foreach ($Data_jenis_pembayaran as $Djp): ?>
          <div class="card-body">
            <div class="row">
                <div class="form-group col-md-4">
                  <label class="text-primary">KODE JENIS PEMBAYARAN</label>
                  <input type="text" name="kode_jenis_pembayaran" class="form-control" id="kode_jenis_pembayaran" value="<?php echo $Djp['kode_jenis_pembayaran']; ?>" readonly>
                </div>
                <div class="form-group col-md-4">
                  <label class="text-primary">NAMA PEMBAYARAN</label>
                  <input type="text" name="nama_pembayaran" class="form-control" id="nama_pembayaran" value="<?php echo $Djp['nama_pembayaran']; ?>" readonly>
                </div>
                <div class="form-group col-md-4">
                  <label class="text-primary">NOMINAL</label>
                  <input type="text" name="nominal" class="form-control" id="nominal" value="<?php echo $Djp['nominal']; ?>">
                </div>
              </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" id="btn-kembali" >Kembali</button>
            <button type="submit" class="btn btn-primary" id="btn-simpan">Simpan</button>
          </div>
          <?php endforeach; ?>
        </form>
      </div>
    </div>
  </div>

</div>


<script type="text/javascript">
  $("#nominal").mask('0.000.000.000',{reverse:true});
  $("#btn-simpan").click(function(event){
    // event.preventDefault();

    if ($("#nama_pembayaran").val() == "") {
      Lobibox.notify('error', {
        size: 'mini',
        icon: true,
        sound: false,
        msg: 'Nama pembayaran wajib diisi...!'
      });
      $("#nama_pembayaran").focus();
      return false;
    }

    if ($("#nominal").val() == "") {
      Lobibox.notify('error', {
        size: 'mini',
        icon: true,
        sound: false,
        msg: 'Nominal wajib diisi...!'
      });
      $("#nominal").focus();
      return false;
    } 
  });

  $("#btn-kembali").click(function(){
    window.location.href = "<?php echo base_url('C_jenis_pembayaran'); ?>";
  })
</script>
