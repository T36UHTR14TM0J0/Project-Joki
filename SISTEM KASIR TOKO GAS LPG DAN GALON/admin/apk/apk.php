<?php 
include "koneksi.php";

function query_read($query){
    global $koneksi;

    $result   = mysqli_query($koneksi,$query);
    $rows     = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }

 
    return $rows;
 }

$data_produk    = mysqli_query($koneksi,"SELECT * FROM tbl_product WHERE qty_stock > 0 ");
$query          = query_read("SELECT max(kode_transaksi) as kodeTerbesar FROM tbl_transaksi")[0]; // mengambil data barang dengan kode paling besar
$kodeTransaksi  = $query['kodeTerbesar'];
$urutan         = (int) substr($kodeTransaksi, 6, 3); // mengambil angka dari kode barang terbesar, menggunakan fungsi substr           
$urutan++;  // bilangan yang diambil ini ditambah 1 untuk menentukan nomor urut berikutnya        
$kodeTransaksi = date("dmy").sprintf("%03s", $urutan);

 ?>

 <style type="text/css">
     label{
        font-weight: bold;
     }
 </style>
 <div id="text-judul" class="row">
        <div class="alert alert-success" role="alert" style="width: 100%;">
              <h4 class="alert-heading">APLIKASI KASIR TOKO KURNIA</h4>
              
        </div>
</div>
<div class="card shadow mb-4 mt-3 p-5">
    <div class="form-group">
        <label for="kode_transaksi">Kode Transaksi :</label>
        <input type="text" name="kode_transaksi" class="form-control" id="kode_transaksi" value="<?=$kodeTransaksi;?>" readonly>
    </div>
    
    <div class="form-group">
        <label for="nama_produk">Nama Produk :</label>
        <select class="form-control" id="nama_produk" name="nama_produk">
        <option value="">--pilih--</option>
        <?php while ($row = mysqli_fetch_array($data_produk)) { ?>
            <option value="<?=$row['nama_produk'];?>"><?php echo $row["nama_produk"]; ?></option>

        <?php } ?>
            
        </select>
        
    </div>
    <div class="form-group">
        <label for="kode_produk">Kode Produk :</label>
        <input type="text" name="kode_produk" class="form-control" id="kode_produk" readonly>
    </div>
    <div class="form-group">
        <label for="harga_jual">Harga :</label>
        <input type="text" name="harga_jual" class="form-control" id="harga_jual" readonly>
    </div>

     <div class="form-group">
        <label for="qty_stock">Jumlah Stock :</label>
        <input type="number" name="qty_stock" class="form-control" id="qty_stock" readonly>
    </div>

    <div class="form-group">
        <label for="qty">Qty :</label><br>
        <div class="row">
           <!-- <span id="minus" class="badge  badge-primary"><i class="fas fa-minus p-2"></i></span> -->
          
             <input type="number" name="qty" class="form-control col-md-1 mr-1 ml-1" id="qty" min="0">
          
          
            <!-- <span id="plus" class="badgell badge-primary"><i class="fas fa-plus p-2"></i></span> -->
          </div>

        
        
       
        
    </div>
     <div class="form-group">
        <label for="total_harga">Total Harga :</label>
        <input type="text" name="total_harga" class="form-control" id="total_harga" readonly>
    </div>
    <div class="form-group">
        <input type="button" name="send" class="btn btn-primary btn-sm" value="Tambah Pesanan" id="butsend">
    </div>
<form id="form1" name="form-kasir" method="post" action="#">
     <input type="hidden" name="kode_transaksi" class="form-control" id="kode_transaksi" value="<?=$kodeTransaksi;?>" readonly>
    <div class="table-responsive">
        <table id="table1" name="table1" class="table table-bordered mt-2">
            <tbody>
                <tr>
                <th>Kode Produk</th>
                <th>Nama Produk</th>
                <th>Harga</th>
                <th>Qty</th>
                <th>Total Harga</th>
                <th>Action</th>
                </tr>
            </tbody>
        </table>
    </div>
     <div class="row justify-content-end mt-2">
       <div class="col-md-6 table-responsive">
            <table cellpadding="20" cellspacing="0">
                <tr>
                    <th>TOTAL PESANAN</th>
                    <th>RP</th>
                    <th><input type="text" name="totalpesan" id="totalpesan" class="form-control" readonly></th>
                </tr>
                <tr>
                    <th>BAYAR</th>
                    <th>RP</th>
                    <th><input type="text" name="bayar" id="bayar" class="form-control"></th>
                </tr>
                <tr>
                    <th>KEMBALIAN</th>
                    <th>RP</th>
                    <th><input type="text" name="kembalian" id="kembalian" class="form-control" min="0" readonly></th>
                </tr>
            </table>
       </div>
    </div>
   <input type="button" name="save" class="btn btn-primary" value="Cetak" id="butsave">
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
            url     : 'apk/ambil_data_produk.php',
            data    : {'nama_produk':nama_produk},
            dataType: "json",
            success : function(data){
                    $('#kode_produk').val(data.kode_produk);
                    $("#harga_jual").val(convertToRupiah(data.harga_jual));
                    $("#qty_stock").val(data.qty_stock);
            }
        });
    }); 

  
$(document).ready(function() {
    $("#bayar").mask('0.000.000.000',{reverse:true});


    

    //############## KEYUP QTY #################//
    $("#qty").keyup(function(){
            var qty = $("input[name=qty]").val();
            var harga_jual = convertToAngka($("#harga_jual").val());
            
            var total_harga = qty * harga_jual;
            $("input[name=total_harga]").val(convertToRupiah(total_harga));

        });

    //############## PROSES SEND DATA PADA TABLE #################//
    var id = 1; 
    $("#butsend").click(function() {
      
        var newid       = id++; 
        var kode_produk = $("#kode_produk").val();
        var nama_produk = $("#nama_produk").val();
        var harga_jual  = $("#harga_jual").val();
        var qty_stock   = $("#qty_stock").val();
        var qty         = $("#qty").val();
        var total_harga = $("#total_harga").val();

        
        if(kode_produk == "" ){
                Lobibox.notify('error', {
                    size: 'mini',
                    icon: true,
                    sound: false,
                    msg: 'Silahkan Pilih produk terlebih dahulu!!!'
                });
                $("#nama_produk").focus();
                $('#butsend').prop('disabled',false);
                return false;
            }

        //############## Validasi Apabila qty tidak diisi #################//
         if(qty == "" ){
                Lobibox.notify('error', {
                    size: 'mini',
                    icon: true,
                    sound: false,
                    msg: 'Masukkan jumlah pembelian!!!'
                });
                $("#qty").focus();
                $('#butsend').prop('disabled',false);
                return false;
            }
        //############## Validasi Apabila Qty yang dimasukkan melebihi stock  #################//
         if( qty > parseInt($("#qty_stock").val())){
                Lobibox.notify('error', {
                    size: 'mini',
                    icon: true,
                    sound: false,
                    msg: 'Stock tidak tersedia!!!'

                });
                $("#qty_stock").focus();
                $('#butsend').prop('disabled',false);
                return false;
        }

          var hasilkode = 0;
         for (var i = 1; i <= newid; i++) {
             $("#tkode_produk"+i).each(function(){
                hasilkode = $(this).val();  
             }) ;

             if (kode_produk == hasilkode) {
               Lobibox.notify('error', {
                      size: 'mini',
                      icon: true,
                      sound: false,
                      msg: 'Produk Sudah Dipilih!'
                  });

                  $("#nama_produk").focus();
                  $("#qty").val(0);
                  $("#total_harga").val("");
                  $('#butsend').prop('disabled',false);
                  return false;
           }  
         }

         
             $("#table1").append('<tr valign="top" id="'+newid+'">\n\
               \n\
                <td class="tkode_produk'+newid+'">' + '<input class="form-control" type = "number" id="tkode_produk'+newid+'" name="detDetail['+newid+'][tkode_produk]" value="'+ kode_produk +'" readonly>' + '</td>\n\
                <td class="tnama_produk'+newid+'">' + '<input class="form-control" type = "text" id="tnama_produk'+newid+'" name="detDetail['+newid+'][tnama_produk]" value="'+ nama_produk +'" readonly>' + '</td>\n\
                <td class="tharga'+newid+'">' + '<input class="form-control" type = "number" id="tharga'+newid+'" name="detDetail['+newid+'][tharga]" value="'+ harga_jual +'" readonly>' + '</td>\n\
                <td class="tqty'+newid+'">' + ' <input class="form-control" type = "hidden" id="tqty_stock'+newid+'" name="detDetail['+newid+'][tqty_stock]" value="'+ qty_stock +'"><input class="form-control" type = "number" id="tqty'+newid+'" name="detDetail['+newid+'][tqty]" value="'+ qty +'">' + '</td>\n\
                <td class="ttotal_harga'+newid+'">' + '<input class="form-control" type = number" id="ttotal_harga'+newid+'" name="detDetail['+newid+'][ttotal_harga]" value="'+ total_harga +'" readonly>' + '</td>\n\
                <td><a href="javascript:void(0);" class="remCF">Remove</a></td>\n\ </tr>');

                 var Totalpesan = 0;
                 for (var i = 1- 1; i <= newid; i++) {
                     $("#ttotal_harga"+i).each(function(){
                        Totalpesan += parseInt(convertToAngka($(this).val()));  
                     }) ;  
                 }




                 $("#totalpesan").val(convertToRupiah(Totalpesan));
                 $("#kode_produk").val("");
                 $("#nama_produk").val("--pilih--");
                 $("#harga_jual").val("");
                 $("#qty").val("0");
                 $("#total_harga").val("");
                 $("#qty_stock").val("");
         

       //############## KEYUP QTY #################//
        $("#tqty" + newid).keyup(function(){
                Totalpesan = 0;
                var jml_total = $("#table1").find("tr").length ;
                var qty = $("#tqty"+newid).val();
                var qty_stock = $("#tqty_stock"+newid).val();
                var harga = convertToAngka($("#tharga"+newid).val());
                
                var total_harga = qty * harga;
                $("#ttotal_harga"+newid).val(convertToRupiah(total_harga));

                for (var j = 1 - 1; j <= jml_total; j++) {
                   $("#ttotal_harga"+j).each(function(){
                        Totalpesan += parseInt(convertToAngka($(this).val()));  
                     }) ;  
                }

                if (parseInt(qty_stock) < parseInt(qty)) {
                    Lobibox.notify('error', {
                      size: 'mini',
                      icon: true,
                      sound: false,
                      msg: 'Qty Melebihi Stock!'
                  });
                }

                $("#totalpesan").val(convertToRupiah(Totalpesan));


        });
            

    });


    

    //############## Keyup input bayar #################//
     $("#bayar").keyup(function(){
            var bayar = convertToAngka($("#bayar").val());
            var totalpesan = convertToAngka($("#totalpesan").val());
            
            var kembalian = bayar - totalpesan;
            $("#kembalian").val(convertToRupiah(kembalian));
            

        });



   
     //############## Delete Row Tabel #################//
    $("#table1").on('click', '.remCF', function() {
        $(this).parent().parent().remove();
        var intdata = $("#table1").find("tr").length;
        var total_pesan_r = 0;
        for (var k = 1 - 1; k <= intdata; k++) {
         $("#ttotal_harga"+k).each(function(){
                        total_pesan_r += parseInt(convertToAngka($(this).val()));  
                     }) ;   
        }

     $("#totalpesan").val(convertToRupiah(total_pesan_r));



    });

    
    //############## PROSES SIMPAN DATA #################//
    $("#butsave").click(function(event) {
        event.preventDefault(); 

        // var intSave = 1;
        var jml_data = $('#table1').find('tr').length;


      if(jml_data == 1){        
        Lobibox.notify('warning', {
          size: 'mini',
          icon: true,
          sound:false,
          msg: 'Maaf pastikan anda telah memilih produk terlebih dulu!...'
        });     
      
        $('#butsave').prop('disabled',false);
        return false;
      }


      if($("#bayar").val() == "" || $("#bayar").val() == null){        
        Lobibox.notify('error', {
          size: 'mini',
          icon: true,
          sound:false,
          msg: 'Masukkan Jumlah Bayar!'
        });     
      
        $('#butsave').prop('disabled',false);
        return false;
      }

      if(convertToAngka($("#bayar").val()) < convertToAngka($("#totalpesan").val())){        
        Lobibox.notify('error', {
          size: 'mini',
          icon: true,
          sound:false,
          msg: 'Uang Kurang Dari Jumlah Pesanan!'
        });     
      
        $('#butsave').prop('disabled',false);
        return false;
      }

        var formData    = new FormData($('#form1')[0]);
        $.ajax({
            url: "apk/save.php",
            type: "post",
            data: formData,
            cache       : false,
            dataType    : 'json',
            processData : false, 
            contentType : false,
            success : function(data){
            
               if(data.status == 1){
                     var kode = data.kode;
                     var base_url = "apk/print.php?id=" + kode + "&bayar=" + data.bayar + "&kembalian=" + data.kembalian + "&nama_kasir=" + data.nama_kasir;
                     
                      Lobibox.notify('success', {
                            size: 'mini',
                            icon: true,
                            sound: false,
                            msg: data.pesan
                        });
                      setTimeout(function(){
                        window.open(base_url,"_blank")
                      },3000);
                      setInterval('location.reload()',3000);

                      $("#table1").find("tr:gt(0)").remove();
                      $("#totalpesan").val("");
                      $("#bayar").val("");
                      $("#kembalian").val("");
               }

               if(data.status == 2){
                  Lobibox.notify('error', {
                              size: 'mini',
                              icon: true,
                              sound: false,
                              msg: data.pesan
                          });
                   $('#butsave').prop('disabled',false);
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


});
</script>