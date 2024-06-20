
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- **** JUDUL HALAMAN ***-->
    <div class="content-header">
      <div class="container-fluid">
        <div class="card">
          <div class="card-body border border-primary rounded-lg shadow-sm">
            <div class="row">
              <div class="col-sm-6">
                <h1 class="text-primary">&nbsp;EDIT SISWA</h1>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

  <div class="content-body">
    <div class="container">
      <div class="card">
        <?php foreach ($Data_siswa as $ds): ?>
        <form method="POST" action="<?php echo base_url('C_siswa/proses_edit/'.$ds['nis']); ?>" enctype="multipart/form-data">
          <div class="card-body">
            <div class="row">
                <div class="form-group col-md-4">
                  <label class="text-primary">NIS</label>
                  <input type="number" name="nis" class="form-control" id="nis" value="<?php echo $ds['nis']; ?>" readonly> 
                </div>
                 <div class="form-group col-md-4">
                  <label class="text-primary">NISN</label>
                  <input type="number" name="nisn" class="form-control" id="nisn" value="<?php echo $ds['nisn'] ?>">
                </div>
                <div class="form-group col-md-4">
                  <label class="text-primary">NAMA LENGKAP</label>
                  <input type="text" name="nama_lengkap" class="form-control" id="nama_lengkap" value="<?php echo $ds['nama_lengkap']; ?>">
                </div>
                 <div class="form-group col-md-4">
                    <label class="text-primary">KELAS</label>
                    <select class="form-control" id="id_kelas" name="id_kelas">
                      <?php foreach ($Data_kelas as $Dk): ?>
                          <option value="<?= $Dk['id_kelas']; ?>" <?php if ($ds['id_kelas'] === $Dk['id_kelas']){echo 'selected';} ?>><?php echo $Dk['nama_kelas']; ?></option>
                      <?php endforeach ?>
                    </select>
                  </div>
                  <div class="form-group col-md-4">
                    <label class="text-primary">SEMESTER</label>
                    <input type="text" name="semester" class="form-control" id="semester" value="<?php echo $ds['semester']; ?>">
                  </div>
                  <div class="form-group col-md-4">
                    <label class="text-primary">TAHUN AJARAN</label>
                    <input type="text" name="tahun_ajaran" class="form-control" id="tahun_ajaran" value="<?php echo $ds['tahun_ajaran']; ?>">
                  </div>
                
              </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" id="btn-kembali" >Kembali</button>
            <button type="submit" class="btn btn-primary" id="btn-simpan">Simpan</button>
          </div>
        </form>
        <?php endforeach ?>
      </div>
    </div>
  </div>

</div>


<script type="text/javascript">
  $("#penghasilan_ortu").mask('0.000.000.000',{reverse:true});
  $("#btn-simpan").click(function(event){
    // event.preventDefault();
if ($("#nis").val() == "") {
      Lobibox.notify('error', {
        size: 'mini',
        icon: true,
        sound: false,
        msg: 'Nis wajib diisi...!'
      });
      $("#nis").focus();
      return false;
    }

    if ($("#nisn").val() == "") {
      Lobibox.notify('error', {
        size: 'mini',
        icon: true,
        sound: false,
        msg: 'Nisn wajib diisi...!'
      });
      $("#nisn").focus();
      return false;
    } 
    if ($("#nama_lengkap").val() == "") {
      Lobibox.notify('error', {
        size: 'mini',
        icon: true,
        sound: false,
        msg: 'Nama Lengkap wajib diisi...!'
      });
      $("#nama_lengkap").focus();
      return false;
    } 

    if ($("#semester").val() == "") {
      Lobibox.notify('error', {
        size: 'mini',
        icon: true,
        sound: false,
        msg: 'Semester wajib diisi...!'
      });
      $("#semester").focus();
      return false;
    } 

    if ($("#tahun_ajaran").val() == "") {
      Lobibox.notify('error', {
        size: 'mini',
        icon: true,
        sound: false,
        msg: 'Tahun ajaran wajib diisi...!'
      });
      $("#tahun_ajaran").focus();
      return false;
    } 
   
  });

  $("#btn-kembali").click(function(){
    window.location.href = "<?php echo base_url('C_siswa'); ?>";
  })
</script>
