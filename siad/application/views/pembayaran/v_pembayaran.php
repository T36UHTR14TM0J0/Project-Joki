<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="card">
          <div class="card-body border border-primary rounded-lg shadow-sm">
            <div class="row">
              <div class="col-sm-6">
                <h1 class="text-primary">&nbsp;PEMBAYARAN</h1>
              </div>
            </div>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </div>

    <div class="content-body">
      <div class="container">
        <div class="card">
          <div class="card-header">
            <form action="#" method="post">
            <div class="row">
              <div class="col-md-4">
                <div class="form-group">
                  <label class="text-primary" for="cnis">NIS</label>
                  <input type="number" name="cnis" id="cnis" class="form-control">
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group mt-3 pt-3">
                  <button type="submit" class="btn btn-sm btn-primary" id="bcari" name="bcari">CARI</button>
                </div>
              </div>
            </div>
            </form>
          </div>
        </div>

        <div class="card">
          <div class="card-body">
            <form action="" method="post" id="form-spp">
            <div class="row">
              <div class="col-md-4">
                <div class="form-group">
                  <label class="text-primary" for="nis">NIS</label>
                  <input type="number" name="nis" id="nis" class="form-control" readonly>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label class="text-primary" for="nama_lengkap">NAMA LENGKAP</label>
                  <input type="text" name="nama_lengkap" id="nama_lengkap" class="form-control" readonly>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label class="text-primary" for="kelas">KELAS</label>
                  <input type="text" name="kelas" id="kelas" class="form-control" readonly>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label class="text-primary" for="tahun_ajaran">TAHUN AJARAN</label>
                  <input type="text" name="tahun_ajaran" id="tahun_ajaran" class="form-control" readonly>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label class="text-primary" for="tgl_pembayaran">TANGGAL PEMBAYARAN</label>
                  <input type="date" name="tgl_pembayaran" class="form-control" readonly value="<?php echo date('Y-m-d'); ?>">
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label class="text-primary" for="kode_jenis_pembayaran">JENIS PEMBAYARAN</label>
                  <select class="form-control" name="kode_jenis_pembayaran" id="kode_jenis_pembayaran">
                    <option value="--pilih--">--pilih--</option>
                    <?php foreach ($Data_jenis_pembayaran as $Djp): ?>
                      <option value="<?php echo $Djp['kode_jenis_pembayaran']; ?>"><?php echo $Djp['nama_pembayaran']; ?></option>
                    <?php endforeach ?>
                  </select>
                </div>
              </div>
              
               <div class="col-md-4">
                <div class="form-group">
                  <label class="text-primary" for="bln_pembayaran">BULAN PEMBAYARAN</label>
                  <select class="form-control" name="bln_pembayaran" id="bln_pembayaran">
                   <option value="JANUARI">JANUARI</option>
                   <option value="FEBRUARI">FEBRUARI</option>
                   <option value="MARET">MARET</option>
                   <option value="APRIL">APRIL</option>
                   <option value="MEI">MEI</option>
                   <option value="JUNI">JUNI</option>
                   <option value="JULI">JULI</option>
                   <option value="AGUSTUS">AGUSTUS</option>
                   <option value="SEPTEMBER">SEPTEMBER</option>
                   <option value="OKTOBER">OKTOBER</option>
                   <option value="NOVEMBER">NOVEMBER</option>
                   <option value="DESEMBER">DESEMBER</option>
                  </select>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label class="text-primary" for="nominal">NOMINAL</label>
                  <input type="text" name="nominal" id="nominal" class="form-control" readonly>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group mt-3 pt-3">
                  <button type="submit" id="bbayar" class="btn btn-sm btn-primary" name="bbayar">SIMPAN</button>
                </div>
              </div>
            </div>
            </form>
          </div>
        </div>
      </div>
    </div> 
  </div>

  <script type="text/javascript">
    var base_url = "<?php echo base_url('C_Pembayaran/'); ?>";
    $("#nominal").mask('0.000.000.000',{reverse:true});

    $('#kode_jenis_pembayaran').on('click',function(){
        var kode_jenis_pembayaran = $('#kode_jenis_pembayaran').val();
        if (kode_jenis_pembayaran == '0') {
          $("#nominal").val('');
        }


        $.ajax({
            type    : "POST",
            url     : 'C_Pembayaran/ambil_data_nominal',
            data    : {'kode_jenis_pembayaran':kode_jenis_pembayaran},
            dataType: "json",
            success : function(data){
              $('#nominal').val(convertToRupiah(data.nominal));

            }
        });
    });  

    $("#bcari").click(function(event) {
        event.preventDefault(); 
        var cnis = $('#cnis').val();
        if (cnis == null || cnis == '') {
          Lobibox.notify('error', {
            size: 'mini',
            icon: true,
            sound: false,
            msg: 'Nis tidak boleh kosong ...!'
          });
          $("#cnis").focus();
          return false;
        }
        
        $.ajax({
            type    : "POST",
            url     : 'C_Pembayaran/ambil_data_siswa',
            data    : {'cnis':cnis},
            dataType: "json",
            success : function(data){
              $("#nis").val(data.nis);
              $("#nama_lengkap").val(data.nama_lengkap);
              $("#kelas").val(data.nama_kelas);
              $("#tahun_ajaran").val(data.tahun_ajaran);
              $("#id_ta").val(data.id_ta);
              $('#cnis').val('');

            }
        });
    }); 


    $("#bbayar").click(function(event) {
        event.preventDefault(); 
        var nis = $('#nis').val();
        var nama_lengkap = $('#nama_lengkap').val();
        var kelas = $('#kelas').val();
        var tahun_ajaran = $('#tahun_ajaran').val();
        var tgl_pembayaran = $('#tgl_pembayaran').val();
        var kode_jenis_pembayaran = $('#kode_jenis_pembayaran').val();
        var bln_pembayaran = $('#bln_pembayaran').val();
        var nominal = $('#nominal').val();

        if (nis == null || nis == '') {
          Lobibox.notify('error', {
            size: 'mini',
            icon: true,
            sound: false,
            msg: 'Cari data siswa terlebih dahulu ...!'
          });
          $("#cnis").focus();
          return false;
        }

         if (kode_jenis_pembayaran == '--pilih--') {
          Lobibox.notify('error', {
            size: 'mini',
            icon: true,
            sound: false,
            msg: 'Pilih jenis pembayaran ...!'
          });
          $("#kode_jenis_pembayaran").focus();
          return false;
        }

        var formData    = new FormData($('#form-spp')[0]);
        $.ajax({
            type        : "POST",
            url         : 'C_Pembayaran/pembayaran',
            data        : formData,
            cache       : false,
            dataType    : "json",
            processData : false, 
            contentType : false,
            success : function(data){
              if(data.status == 1){
                var kode_pembayaran    = data.kode_pembayaran;
                $('#nis').val('');
                $('#nama_lengkap').val('');
                $('#kelas').val('');
                $('#tahun_ajaran').val('');
                $('#tgl_pembayaran').val('');
                $('#kode_jenis_pembayaran').val('');
                $('#bln_pembayaran').val('');
                $('#nominal').val('');    
                var url = base_url + 'print_pembayaran/' + kode_pembayaran;
                  Lobibox.notify('success', {
                    size: 'mini',
                    icon: true,
                    sound: false,
                    msg: data.pesan
                  });setTimeout(function(){
                        window.open(url,"_blank")
                      },3000);
                      setInterval('location.reload()',3000);
               }

               if(data.status == 2){
                  Lobibox.notify('error', {
                              size: 'mini',
                              icon: true,
                              sound: false,
                              msg: data.pesan
                          });
                   $('#bbayar').prop('disabled',false);
              return false;
               }

            },error: function() {
              

              Lobibox.notify('error', {
                size: 'mini',
                icon: true,
                sound: false,
                msg: 'Maaf ada kesalahan saat proses. Silahkan coba kembali!...'
              });
        
              $('#butsave').prop('disabled',false);
              return false;
            }
        });
    }); 
  </script>

 