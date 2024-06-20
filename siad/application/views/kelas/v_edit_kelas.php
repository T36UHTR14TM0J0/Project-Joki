
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="card">
          <div class="card-body border border-primary rounded-lg shadow-sm">
            <div class="row">
              <div class="col-sm-6">
                <h1 class="text-primary">&nbsp;FORM EDIT KELAS</h1>
              </div>
            </div>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </div>


  <div class="content-body">
    <div class="container">
      <div class="card">
        <form method="POST" action="<?php echo base_url('C_kelas/proses_edit'); ?>" enctype="multipart/form-data">
          <?php foreach ($Data_kelas as $Dk): ?>
          <div class="card-body">
            <div class="row">
                <div class="form-group col-md-4">
                  <label class="text-primary">ID KELAS</label>
                  <input type="text" name="id_kelas" class="form-control" id="id_kelas" value="<?php echo $Dk['id_kelas']; ?>" readonly>
                </div>
                <div class="form-group col-md-4">
                  <label class="text-primary">NAMA KELAS</label>
                  <input type="text" name="nama_kelas" class="form-control" id="nama_kelas" value="<?php echo $Dk['nama_kelas']; ?>">
                </div>
                <div class="form-group col-md-4">
                  <label class="text-primary">JUMLAH SISWA</label>
                  <input type="number" name="jml_siswa" class="form-control" id="jml_siswa" value="<?php echo $Dk['jml_siswa']; ?>">
                </div>
              </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" id="btn-kembali" >Kembali</button>
            <button type="submit" class="btn btn-primary" id="btn-simpan">Simpan</button>
          </div>
          <?php endforeach ?>
        </form>
      </div>
    </div>
  </div>

</div>


<script type="text/javascript">
  $("#btn-simpan").click(function(event){
    // event.preventDefault();

    if ($("#nama_kelas").val() == "") {
      Lobibox.notify('error', {
        size: 'mini',
        icon: true,
        sound: false,
        msg: 'Nama kelas wajib diisi...!'
      });
      $("#nama_kelas").focus();
      return false;
    }

    if ($("#jml_siswa").val() == "") {
      Lobibox.notify('error', {
        size: 'mini',
        icon: true,
        sound: false,
        msg: 'Jumlah siswa wajib diisi...!'
      });
      $("#jml_siswa").focus();
      return false;
    } 
  });

  $("#btn-kembali").click(function(){
    window.location.href = "<?php echo base_url('C_kelas'); ?>";
  })
</script>
