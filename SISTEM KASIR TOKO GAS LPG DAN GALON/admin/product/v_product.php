<?php 
// ======================================================================================================================================//
//                                                    HALAMAN DATA PRODUK                                                                //
// ======================================================================================================================================//

include "function_product.php";


// ======================================================================================================================================//
//                                                    PROSES TOMBOL SIMPAN / TAMBAH DATA PRODUK                                          //
// ======================================================================================================================================//
    if (isset($_POST['btn-simpan'])) {
        if (insert($_POST) > 0) {
            echo "<script>
                          
                  window.location.href='index.php?pages=product&notif_success=Data Produk berhasil disimpan';
            </script>";      
            return false;

        }else{
            echo "<script>
                window.location.href='index.php?pages=product&notif_gagal=Data Produk gagal disimpan';
            </script>";      
            return false;
        }
    } 

//                                                          END PROSES TOMBOL SIMPAN / TAMBAH PRODUK                                     //
// ======================================================================================================================================//







// ======================================================================================================================================//
//                                                          PROSES TOMBOL TAMBAH STOCK PRODUK                                            //
// ======================================================================================================================================//
if (isset($_POST['btn-tambah-stock'])) {
    if (tambah_stock($_POST) > 0) {
        echo "<script>
                window.location.href='index.php?pages=product&notif_success=Stock produk berhasil ditambahkan';
                </script>";      
       return false;

    }else{
        echo "<script>
                window.location.href='index.php?pages=product&notif_gagal=Stock produk berhasil dihapus';
               </script>";
       return false;
    }
}

//                                                         END PROSES TOMBOL TAMBAH STOCK                                                //
// ======================================================================================================================================//









// ======================================================================================================================================//
//                                        FUNGSI TOMBOL UPDATE / EDIT  HARGA JUAL PRODUK                                                 //
// ======================================================================================================================================//
if (isset($_POST['btn-edit'])) {
    if (update_product($_POST) > 0) {
        echo "<script>
                window.location.href='index.php?pages=product&notif_success=Data Produk berhasil diupdate';
                </script>";      
       return false;

    }else{
        echo "<script>
                window.location.href='index.php?pages=product&notif_gagal=Data Produk gagal diupdate';
               </script>";
       return false;
    }
}
// ======================================================================================================================================//
//                                         END TOMBOL UPDATE / EDIT HARGA JUAL PRODUK                                                    //
// ======================================================================================================================================//
 ?>




 <?php if (isset($_GET['aksi'])): ?>

<!-- ======================================================================================================================================-->
<!--                                              HALAMAN PAGES TAMBAH PRODUK                                                              -->
<!-- ======================================================================================================================================-->
    <?php if ($_GET['aksi'] === 'tambah') :
       
            // mengambil data produk dengan kode paling besar
            $query = query_read("SELECT max(kode_produk) as kodeTerbesar FROM tbl_product")[0];
            $kodeProduk = $query['kodeTerbesar'];
             
            // mengambil angka dari kode barang terbesar, menggunakan fungsi substr
            // dan diubah ke integer dengan (int)
            $urutan = (int) substr($kodeProduk, 3, 3);
             
            // bilangan yang diambil ini ditambah 1 untuk menentukan nomor urut berikutnya
            $urutan++;
             
            // membentuk kode barang baru
            // perintah sprintf("%03s", $urutan); berguna untuk membuat string menjadi 3 karakter
            // misalnya perintah sprintf("%03s", 15); maka akan menghasilkan '015'
            // angka yang diambil tadi digabungkan dengan kode huruf yang kita inginkan, misalnya BRG 
            $kodeProduk = sprintf("%04s", $urutan);


            
            $query          = query_read("SELECT max(kode_transaksi) as kodeTerbesar FROM tbl_transaksi")[0]; // mengambil data barang dengan kode paling besar
            $kodeTransaksi  = $query['kodeTerbesar'];
            $urutan1         = (int) substr($kodeTransaksi, 6, 3); // mengambil angka dari kode barang terbesar, menggunakan fungsi substr           
            $urutan1++;  // bilangan yang diambil ini ditambah 1 untuk menentukan nomor urut berikutnya        
            $kodeTransaksi = date("dmy").sprintf("%03s", $urutan1);
        ?>


        <div id="text-judul" class="row">
            <div class="alert alert-success" role="alert" style="width: 100%;">
                  <h4 class="alert-heading">FORM TAMBAH PRODUCT</h4>
                  
            </div>
        </div>
                <form action="#" method="POST" id="form-tambah" class="text-uppercase">
                    <div class="form-group">
                        <input class="form-control" type="hidden" name="kode_transaksi" id="kode_transaksi" value="<?php echo $kodeTransaksi?>" readonly>
                        <label for="kode_produk">Kode Produk</label>
                        <input class="form-control" type="text" name="kode_produk" id="kode_produk" value="<?php echo $kodeProduk?>" readonly>
                    </div>

                   
                    <div class="form-group">
                        <label for="nama_produk">Nama Produk</label>
                        <input class="form-control" type="text" name="nama_produk" id="nama_produk" onfocus>
                    </div>

                     <div class="form-group">
                        <label for="qty">qty</label>
                        <input class="form-control" type="number" name="qty" id="qty">
                    </div>

                     <div class="form-group" id="form_harga_beli">
                        <label for="harga_beli">Harga Beli</label>
                        <input class="form-control" type="text" name="harga_beli" id="harga_beli">
                    </div>

                    <div class="form-group" id="form_harga">
                        <label for="total_harga_beli">Total Harga Beli</label>
                        <input class="form-control" type="text" name="total_harga_beli" id="total_harga_beli" readonly>
                    </div>

                    <div class="form-group" id="form_harga">
                        <label for="harga_jual">Harga Jual</label>
                        <input class="form-control" type="text" name="harga_jual" id="harga_jual">
                    </div>

                     <div class="form-group" id="form_total">
                        <label for="total_harga_jual">Total Harga</label>
                        <input class="form-control" type="text" name="total_harga_jual" id="total_harga_jual" readonly>
                    </div>



                    <div class="form-group">
                        <button id="btn-tambah-data" type="submit" name="btn-simpan" class="btn btn-warning">Simpan</button>
                        <button id="btn-back" class="btn btn-secondary">Back</button>
                    </div>
                </form>
    <?php endif ?>

<!--                                             END HALAMAN PAGES TAMBAH PRODUK                                                           -->
<!-- ======================================================================================================================================-->

    


<!-- ======================================================================================================================================-->
<!--                                              HALAMAN PAGES TAMBAH STOCK PRODUK                                                        -->
<!-- ======================================================================================================================================-->
    <?php if ($_GET['aksi'] === 'tambah_stock'): ?>
        <!-- DIV JUDUL PAGES -->
        <div id="text-judul" class="row">
            <div class="alert alert-success" role="alert" style="width: 100%;">
                  <h4 class="alert-heading">FORM TAMBAH STOCK PRODUCT</h4>
                  
            </div>
        </div>



        <?php
            $kode_produk = $_GET['pkode'];
            $tampil_product = query_read("SELECT * FROM tbl_product WHERE kode_produk = '$kode_produk'")[0];
            $query          = query_read("SELECT max(kode_transaksi) as kodeTerbesar FROM tbl_transaksi")[0]; // mengambil data barang dengan kode paling besar
            $kodeTransaksi  = $query['kodeTerbesar'];
            $urutan1         = (int) substr($kodeTransaksi, 6, 3); // mengambil angka dari kode barang terbesar, menggunakan fungsi substr           
            $urutan1++;  // bilangan yang diambil ini ditambah 1 untuk menentukan nomor urut berikutnya        
            $kodeTransaksi = date("dmy").sprintf("%03s", $urutan1);
        ?>


        <!-- FORM TAMBAH STOCK PRODUK -->
        <form action="#" method="POST" id="form-tambah-stock" class="text-uppercase">
                    
            <div class="form-group">
                <label for="kode_produk">Kode Produk</label>
                    <input class="form-control" type="hidden" name="kode_transaksi" id="kode_transaksi" value="<?= $kodeTransaksi;?>" readonly>
                    <input class="form-control" type="text" name="kode_produk" id="kode_produk" value="<?= $tampil_product['kode_produk'];?>" readonly>
            </div>
                 

            <div class="form-group">
                <label for="nama_produk">Nama Produk</label>
                <input class="form-control" type="text" name="nama_produk" id="nama_produk" value="<?= $tampil_product['nama_produk'];?>" readonly>
            </div>

            <div class="form-group">
                <label for="qty_stock">QTY</label>
                <input class="form-control" type="number" name="qty_stock" id="qty_stock">
           </div>

            <div class="form-group">
                <label for="harga_beli">Harga Beli</label>
                <input class="form-control" type="text" name="harga_beli" id="harga_beli">
            </div>

            <div class="form-group">
                <label for="total_harga_beli">Total Harga Beli</label>
                <input class="form-control" type="text" name="total_harga_beli" id="total_harga_beli" readonly>
            </div>

            <div class="form-group">
                <button id="btn-tambah-stock" type="submit" name="btn-tambah-stock" class="btn btn-warning">Simpan</button>
                <button id="btn-back" class="btn btn-secondary">Back</button>
            </div>
        </form>
        <!-- END FORM TAMBAH STOCK PRODUK -->
    <?php endif ?>
    <!-- ======================================================================================================================================-->
<!--                                            END  HALAMAN PAGES TAMBAH STOCK PRODUK                                                              -->
<!-- ======================================================================================================================================-->


    


<!-- ======================================================================================================================================-->
<!--                                              HALAMAN PAGES EDIT HARGA JUAL PRODUK                                                              -->
<!-- ======================================================================================================================================-->
    <?php if ($_GET['aksi'] === 'edit_produk'): ?>
        <!-- DIV JUDUL PAGES FORM EDIT -->
        <div id="text-judul" class="row">
            <div class="alert alert-success" role="alert" style="width: 100%;">
                  <h4 class="alert-heading">FORM EDIT PRODUK</h4>
                  
            </div>
        </div>

        <?php
            // MENGAMBIL PARAMETER KODE PRODUK DI $_GET
            $kode_produk = $_GET['kode'];
            $tampil_product = query_read("SELECT * FROM tbl_product WHERE kode_produk = '$kode_produk'")[0];
        ?>

        <!-- FORM EDIT HARGA JUAL PRODUK -->
        <form action="#" method="POST" id="form-edit" class="text-uppercase">
                    
            <div class="form-group">
                <label for="kode_produk">Kode Produk</label>
                <input class="form-control" type="text" name="kode_produk" id="kode_produk" value="<?= $tampil_product['kode_produk'];?>" readonly>
            </div>
                 

            <div class="form-group">
                <label for="nama_produk">Nama Produk</label>
                <input class="form-control" type="text" name="nama_produk" id="nama_produk" value="<?= $tampil_product['nama_produk'];?>" readonly>
            </div>

            <div class="form-group">
                <label for="qty_stock">QTY</label>
                <input class="form-control" type="number" name="qty_stock" id="qty_stock"  value="<?= $tampil_product['qty_stock'];?>" readonly>
            </div>

            <div class="form-group">
                <label for="harga_jual">Harga Jual</label>
                <input class="form-control" type="text" name="harga_jual" id="harga_jual"  value="<?= $tampil_product['harga_jual'];?>">
            </div>

            <div class="form-group">
                <label for="total_harga_jual">Total Harga Jual</label>
                <?php $total_harga_jual = $tampil_product['harga_jual'] * $tampil_product['qty_stock'];?>
                <input class="form-control" type="text" name="total_harga_jual" id="total_harga_jual"  value="<?= number_format($total_harga_jual,0,',','.');?>" readonly>
            </div>

            <div class="form-group">
                <button id="btn-edit" type="submit" name="btn-edit" class="btn btn-warning">Simpan</button>
                <button id="btn-back" class="btn btn-secondary">Back</button>
            </div>
        </form>
    <?php endif ?>

<!--                                             END HALAMAN PAGES EDIT HARGA JUAL PRODUK                                                  -->
<!-- ======================================================================================================================================-->




<!-- ======================================================================================================================================-->
<!--                                              PROSES HAPUS DATA PRODUK                                                              -->
<!-- ======================================================================================================================================-->

    <?php if ($_GET['aksi'] === 'hapus'): ?>
        <?php 
            $id = $_GET["id"];
            if(delete($id) > 0){
                echo "
                        <script>
                            document.location.href='index.php?pages=product&notif_success=Data Produk berhasil dihapus';
                        </script>
                    ";
            }else{
                echo "
                        <script>
                            document.location.href='index.php?pages=product&notif_gagal=Data Produk gagal dihapus';
                        </script>
                    ";
            }
         ?>
    <?php endif ?>
<!-- ======================================================================================================================================-->
<!--                                              END PROSES HAPUS DATA PRODUK                                                             -->
<!-- ======================================================================================================================================-->

<!-- ======================================================================================================================================-->
<!--                                              HALAMAN PAGES AWAL PRODUK                                                                -->
<!-- ======================================================================================================================================-->
 <?php else: ?>
    <!-- JUDUL HALAMAN -->
 	<div id="text-judul" class="row">
        <div class="alert alert-success" role="alert" style="width: 100%;">
              <h4 class="alert-heading">DATA PRODUK</h4>
              
        </div>
    </div>

    <?php 
    	$tampil_product = query_read("SELECT * FROM tbl_product");
     ?>

      <!-- DATA TABEL PRODUK -->
     <div class="card shadow mb-4">
        <div class="card-header py-3">
            <button id="btn-tambah" class="btn btn-primary">Tambah produk</button>
            <button id="btn-tambah-stock" class="btn btn-info" data-toggle="modal" data-target="#modalstock">Tambah stock Produk </button>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered " id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                        	<th>No</th>
                            <th>Kode Produk</th>
                            <th>Nama Produk</th>
                            <th>Qty</th>
                            <th>Harga Jual</th>
                            <th>Total</th>

                            <th>action</th>
                        </tr>
                    </thead> 
                    <tbody>
                        <?php $no = 1; ?>
                        <?php foreach($tampil_product as $tm):?>
                            <tr>
                                <td><?= $no++; ?></td>
                                <td><?= $tm['kode_produk'];?></td>
                                <td><?= $tm['nama_produk'];?></td>
                                <td><?= $tm['qty_stock']; ?></td>
                                <td><?= number_format($tm['harga_jual'],0,',','.'); ?></td>
                                <?php $total = $tm["harga_jual"] * $tm["qty_stock"] ?>
                                <td><?= number_format($total,0,',','.');?></td>
                                <td>

                                    <a href="index.php?pages=product&aksi=edit_produk&kode=<?php echo $tm['kode_produk']; ?>" class="badge badge-primary" id="btn-edit">
                                        <i class="fas fa-edit"></i>
                                    </a>&nbsp;&nbsp;
                                    <a class="badge badge-danger" href="index.php?pages=product&aksi=hapus&id=<?php echo $tm['kode_produk']; ?>" id="btn-hapus">
                                      <i class="fas fa-trash"></i>
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>    
                </table>
            </div>
        </div>
    </div>
<?php endif; ?>

<!--                                             END HALAMAN PAGES AWAL PRODUK                                                              -->
<!-- ======================================================================================================================================-->


<!-- ======================================================================================================================================-->
<!--                                              HALAMAN MODAL OPTION DATA PRODUK                                                              -->
<!-- ======================================================================================================================================-->
<!-- Modal Tambah Stock -->
<div class="modal fade" id="modalstock" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
             
               
                    <label for="pkode_produk">Pilih produk :</label><br>
                    <select style="width: 100%;"  id="pkode_produk" name="pkode_produk" class="form-control">
                    <?php foreach ($tampil_product as $tp) :?>
                        <option value="<?= $tp['kode_produk'];?>"><?= $tp['kode_produk'];?> - <?=$tp['nama_produk'];?></option>
                    <?php endforeach;?>
                    </select>
                
  
      </div>
      <div class="modal-footer">
        <button type="button" id="pilih_produk" class="btn btn-primary">Pilih Produk</button>
      </div>
    </div>
  </div>
</div>

<!--                                              END HALAMAN MODAL OPTION DATA PRODUK                                                     -->
<!-- ======================================================================================================================================-->



<!-- ======================================================================================================================================-->
<!--                                           SCRIPT JAVASCRIPT JQUERY VALIDATION EVENT                                                   -->
<!-- ======================================================================================================================================-->
<script type="text/javascript">
    // MENGAKTIFKAN SEARCH PADA SELECT OPTION NAMA PRODUK
    $('#pkode_produk').select2({
        width:'resolve'
    });

    $(document).ready(function(){   
          // ACTION BUTTON KEMBALI
        $(document).on('click','#btn-back',function(event){
            event.preventDefault();
          window.location.href = "index.php?pages=product";

        });

        // MENGAKTIFKAN MASK PADA FORM INPUT 
        $("#harga_beli").mask('0.000.000.000',{reverse:true});
        $("#harga_jual").mask('0.000.000.000',{reverse:true});
        $("#harga").mask('0.000.000.000',{reverse:true});
        $("#tot_harga_jual").mask('0.000.000.000',{reverse:true});

        var harga_beli       = 0;
        var total_harga_beli = 0;
        var qty              = 0;

        //==================================================================================================================//
        //                                           SCRIPT JQUERY KETIKA BUTTON DI CLICK
        //==================================================================================================================//

        // EVENT CLICK TOMBOL TAMBAH
        $(document).on('click','#btn-tambah',function(event){
            event.preventDefault();
          window.location.href = "index.php?pages=product&aksi=tambah";

        });

        // EVENT CLICK TOMBOL TAMBAH
        $(document).on('click','#pilih_produk',function(event){
            event.preventDefault();
            var pkode_produk = $('#pkode_produk').val();
          window.location.href = "index.php?pages=product&aksi=tambah_stock&pkode="+pkode_produk;

        });

        //                                         END SCRIPT JQUERY KETIKA BUTTON DI CLICK
        //==================================================================================================================//


        //==================================================================================================================//
        //                                           SCRIPT JQUERY KEYUP PADA INPUT
        //==================================================================================================================//

        // KEYUP HARGA BELI
        $("#harga_beli").keyup(function(){
             qty_stock                = $("#qty_stock").val();
             harga_beli         = convertToAngka($("#harga_beli").val());
             total_harga_beli   = qty_stock * harga_beli;
            $("#total_harga_beli").val(convertToRupiah(total_harga_beli));

        });

        
        $("#harga_beli").keyup(function(){
            var qty_stock = $("#qty_stock").val();
            var harga_beli = convertToAngka($("#harga_beli").val());
            
            var total_harga_beli = qty_stock * harga_beli;
            $("#total_harga_beli").val(convertToRupiah(total_harga_beli));

        });


        $("#harga_jual").keyup(function(){
            var qty_stock = $("#qty_stock").val();
            var harga_jual = convertToAngka($("#harga_jual").val());
            
            var total_harga_jual = qty_stock * harga_jual;
            $("#total_harga_jual").val(convertToRupiah(total_harga_jual));

        });
//                                       END SCRIPT JQUERY KEYUP PADA INPUT
//==================================================================================================================//


//==================================================================================================================//
//                                    SCRIPT JQUERY VALIDASI TAMBAH DATA PRODUK
//==================================================================================================================//

        $("#btn-tambah-data").click(function(event){
        // event.preventDefault(); //prevent default action 

            // VALIDASI INPUT NAMA PRODUK
            if($("#nama_produk").val() == ""){
                // alert("Nama produk tidak boleh kosong");
                Lobibox.notify('error', {
                    size: 'mini',
                    icon: true,
                    sound: false,
                    msg: 'Nama produk wajib diisi!'
                });
                $("#nama_produk").focus();
                return false;
            }

            // VALIDASI INPUT QTY STOCK
            if ($("#qty_stock").val() == "") {
                // alert("Qty tidak boleh kosong");
                 Lobibox.notify('error', {
                    size: 'mini',
                    icon: true,
                    sound: false,
                    msg: 'Qty wajib diisi!'
                });
                $("#qty_stock").focus();
                return false;
            }

            // VALIDASI HARGA BELI
            if($("#harga_beli").val() == "" ){
                Lobibox.notify('error', {
                    size: 'mini',
                    icon: true,
                    sound: false,
                    msg: 'Harga Beli wajib diisi!'
                });
                $("#harga_beli").focus();
                return false;
            }

            // VALIDASI HARGA JUAL
            if($("#harga_jual").val() == "" ){
                Lobibox.notify('error', {
                    size: 'mini',
                    icon: true,
                    sound: false,
                    msg: 'Harga Jual wajib diisi!'
                });
                $("#harga_jual").focus();
                return false;
            }

        });
//                                       END SCRIPT JQUERY VALIDASI TAMBAH DATA PRODUK
//==================================================================================================================//

//==================================================================================================================//
//                                        SCRIPT JQUERY VALIDASI TAMBAH STOCK PRODUK
//==================================================================================================================//
        $("#btn-tambah-stock").click(function(event){
            if ($("#qty_stock").val() == "") {
                  Lobibox.notify('error', {
                    size: 'mini',
                    icon: true,
                    sound: false,
                    msg: 'qty stock wajib diisi!'
                });
                $("#qty_stock").focus();
                return false;
            }

            if ($("#harga_beli").val() == "") {
                  Lobibox.notify('error', {
                    size: 'mini',
                    icon: true,
                    sound: false,
                    msg: 'Harga beli wajib diisi!'
                });
                $("#harga_beli").focus();
                return false;
            }
        });
//                                       END SCRIPT JQUERY VALIDASI TAMBAH STOCK PRODUK
//==================================================================================================================//

    });
</script>

                                      <!--  SCRIPT JAVASCRIPT JQUERY VALIDATION EVENT 
//==================================================================================================================// -->