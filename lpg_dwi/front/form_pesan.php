<?php 
include "../koneksi/koneksi.php";

function query_read($query){
    global $koneksi;

    $result   = mysqli_query($koneksi,$query);
    $rows     = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    return $rows;
}
$data_produk    = mysqli_query($koneksi,"SELECT * FROM tbl_produk WHERE stok > 0 ");
?>
<div class="container">
  <div class="row">
  <form id="form1" method="POST">
  <div class="card m-auto shadow-md">
    <div class="card-header bg-secondary text-light">
        <div id="text-judul" class="row">
           <h4 class="alert-heading">FORM PESANAN PRODUK</h4>
        </div>
    </div>
    <div class="card-body">
      <div class="row">
        <div class="form-group col-md-4">
              <label for="nama_produk">Nama Produk :</label>
              <select class="form-control" id="nama_produk" name="nama_produk">
              <option value="">--pilih--</option>
              <?php while ($row = mysqli_fetch_array($data_produk)) { ?>
                  <option value="<?=$row['nama_produk'];?>"><?php echo $row["nama_produk"]; ?></option>

              <?php } ?>
                  
              </select>
              
          </div>
          <div class="form-group col-md-4">
              <label for="id_produk">Id Produk :</label>
              <input type="text" name="id_produk" class="form-control" id="id_produk" readonly>
          </div>
          <div class="form-group col-md-4">
              <label for="tgl_pesan">Tanggal Pesan :</label>
              <input type="date" name="tgl_pesan" class="form-control" id="tgl_pesan" value="<?php echo date('Y-m-d'); ?>" >
          </div>
          <div class="form-group col-md-4">
              <label for="harga_jual">Harga :</label>
              <input type="text" name="harga_jual" class="form-control" id="harga_jual" readonly>
          </div>

           <div class="form-group col-md-4">
              <label for="stok">Jumlah Stock :</label>
              <input type="number" name="stok" class="form-control" id="stok" readonly>
          </div>

          <div class="form-group col-md-4">
              <label for="jumlah">Jumlah :</label><br>
                <input type="number" name="jumlah" class="form-control" id="jumlah" min="0">
          </div>
           <div class="form-group col-md-4">
              <label for="total_harga">Total Harga :</label>
              <input type="text" name="total_harga" class="form-control" id="total_harga" readonly>
          </div>
      </div>
      
    </div>
    <div class="card-footer">
      <div class="form-group ">
            <input type="button" name="btn-pesan" class="btn btn-primary btn-sm" value="PESAN" id="btn-pesan">
        </div>
    </div>
  </div>
  </form>

  
</div>

<div class="coba"></div>
<script>
  //############## AJAX SELECT DATA PRODUCT #################//
  $('#nama_produk').select2();
  $('#nama_produk').on('change.select2',function(){


        var nama_produk = $('#nama_produk').val();
        $.ajax({
            type    : "POST",
            url     : 'ambil_data_produk.php',
            data    : {'nama_produk':nama_produk},
            dataType: "json",
            success : function(data){
                    $('#id_produk').val(data.id_produk);
                    $("#harga_jual").val(convertToRupiah(data.harga_jual));
                    $("#stok").val(data.stok);
            }
        });
    }); 

  
$(document).ready(function() {
    $("#bayar").mask('0.000.000.000',{reverse:true});


    //############## KEYUP stok #################//
    $("#jumlah").keyup(function(){
            var jumlah = $("input[name=jumlah]").val();
            var harga_jual = convertToAngka($("#harga_jual").val());
            
            var total_harga = jumlah * harga_jual;
            $("input[name=total_harga]").val(convertToRupiah(total_harga));

        });

    //############## PROSES SIMPAN DATA #################//
    $("#btn-pesan").click(function(event) {
        event.preventDefault(); 
        var formData    = new FormData($('#form1')[0]);
        $.ajax({
            url: "save_pesanan.php",
            type: "post",
            data: formData,
            cache       : false,
            dataType    : 'json',
            processData : false, 
            contentType : false,
            success : function(data){
            
               if(data.status == 1){
                      Lobibox.notify('success', {
                            size: 'mini',
                            icon: true,
                            sound: false,
                            msg: data.pesan
                        });
                      setTimeout(function(){
                        window.location.href = 'index.php?pages=status_pesanan';
                      },3000);
               }

               if(data.status == 2){
                  Lobibox.notify('error', {
                              size: 'mini',
                              icon: true,
                              sound: false,
                              msg: data.pesan
                          });
                   $('#btn-pesan').prop('disabled',false);
              return false;
               }
           },error: function() {
              

              Lobibox.notify('error', {
                size: 'mini',
                icon: true,
                sound: false,
                msg: 'Maaf ada kesalahan saat proses. Silahkan coba kembali!...'
              });
        
              $('#btn-pesan').prop('disabled',false);
              return false;
            }

        });
        
    });


});
</script>

