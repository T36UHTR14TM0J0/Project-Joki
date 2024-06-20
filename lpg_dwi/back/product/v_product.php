<?php 
include "function_product.php";

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

?>




<?php if (isset($_GET['aksi'])): ?>

<?php if ($_GET['aksi'] === 'tambah') :
       
    
  $query          = query_read("SELECT max(id_produk) as kodeTerbesar FROM tbl_produk")[0];
  $kodeProduk     = $query['kodeTerbesar'];
  $urutan         = (int) substr($kodeProduk, 3, 3);
  $urutan++;         
  $kodeProduk     = sprintf("%04s", $urutan);
?>
  <form action="#" method="POST" id="form-tambah" class="text-uppercase">
    <div class="card mb-2 shadow-lg">
      <div class="card-header bg-secondary text-light">
        <div id="text-judul" class="row">
          <h4 class="alert-heading">FORM TAMBAH PRODUK</h4>
        </div>
      </div>
      <div class="card-body">
        <div class="row">
          <div class="form-group col-md-4">
            <label for="id_produk">Id Produk</label>
            <input class="form-control" type="text" name="id_produk" id="id_produk" value="<?php echo $kodeProduk?>" readonly>
          </div>
                           
          <div class="form-group col-md-4">
            <label for="nama_produk">Nama Produk</label>
            <input class="form-control" type="text" name="nama_produk" id="nama_produk" onfocus>
          </div>

          <div class="form-group col-md-4">
            <label for="stok">Stok</label>
            <input class="form-control" type="number" name="stok" id="stok">
          </div>

          <div class="form-group col-md-4" id="form_harga_beli">
            <label for="harga_beli">Harga Beli</label>
            <input class="form-control" type="text" name="harga_beli" id="harga_beli">
          </div>

          <div class="form-group col-md-4" id="form_harga">
            <label for="total_harga_beli">Total Harga Beli</label>
            <input class="form-control" type="text" name="total_harga_beli" id="total_harga_beli" readonly>
          </div>

          <div class="form-group col-md-4" id="form_harga">
            <label for="harga_jual">Harga Jual</label>
            <input class="form-control" type="text" name="harga_jual" id="harga_jual">
          </div>

          <div class="form-group col-md-4" id="form_total">
            <label for="total_harga_jual">Total Harga</label>
            <input class="form-control" type="text" name="total_harga_jual" id="total_harga_jual" readonly>
          </div>
        </div>
      </div>
      <div class="card-footer">
        <div class="row">
          <button id="btn-tambah-data" type="submit" name="btn-simpan" class="btn btn-secondary mr-2">Simpan</button>
          <button id="btn-back" class="btn btn-danger">Back</button>
        </div>
      </div>
    </div>   
  </form>
<?php endif ?>

<?php if ($_GET['aksi'] === 'tambah_stock'): ?>
  <?php
  $id_produk = $_GET['pkode'];
  $tampil_product = query_read("SELECT * FROM tbl_produk WHERE id_produk = '$id_produk'")[0];
  ?>  

        <!-- FORM TAMBAH STOCK PRODUK -->
  <form action="#" method="POST" id="form-tambah-stock" class="text-uppercase">
    <div class="row card mb-2 shadow-lg">
      <div class="card-header bg-secondary text-light">
                <!-- DIV JUDUL PAGES -->
        <div id="text-judul" class="row">
          <h4 class="alert-heading">FORM TAMBAH STOCK PRODUK</h4>
        </div>
      </div>
 
      <div class="card-body">
        <div class="row">
          <div class="form-group col-md-4">
            <label for="id_produk">Id Produk</label>
            <input class="form-control" type="text" name="id_produk" id="id_produk" value="<?= $tampil_product['id_produk'];?>" readonly>
          </div>
                             
          <div class="form-group col-md-4">
            <label for="nama_produk">Nama Produk</label>
            <input class="form-control" type="text" name="nama_produk" id="nama_produk" value="<?= $tampil_product['nama_produk'];?>" readonly>
          </div>

          <div class="form-group col-md-4">
            <label for="stok">Stok</label>
            <input class="form-control" type="number" name="stok" id="stok">
          </div>

          <div class="form-group col-md-4">
            <label for="harga_beli">Harga Beli</label>
            <input class="form-control" type="text" name="harga_beli" id="harga_beli">
          </div>

          <div class="form-group col-md-4">
            <label for="total_harga_beli">Total Harga Beli</label>
            <input class="form-control" type="text" name="total_harga_beli" id="total_harga_beli" readonly>
          </div>
        </div>                     
      </div>
  
      <div class="card-footer">
        <div class="row pl-2">
          <button id="btn-tambah-stock" type="submit" name="btn-tambah-stock" class="btn btn-secondary mr-2">Simpan</button>
          <button id="btn-back" class="btn btn-danger">Back</button>
        </div>
      </div>
    </div>
  </form>
        <!-- END FORM TAMBAH STOCK PRODUK -->
<?php endif ?>
   
<?php if ($_GET['aksi'] === 'edit_produk'): ?>
<?php
  $id_produk = $_GET['kode'];
  $tampil_product = query_read("SELECT * FROM tbl_produk WHERE id_produk = '$id_produk'")[0];
?>

  <form action="#" method="POST" id="form-edit" class="text-uppercase">
    <div class="card shadow-lg mb-2">
      <div class="card-header bg-secondary text-light">
          <div id="text-judul" class="row">
            <h4 class="alert-heading">FORM EDIT PRODUK</h4>                
          </div>
      </div>
      <div class="card-body">
        <div class="row">
          <div class="form-group col-md-4">
            <label for="id_produk">Id Produk</label>
            <input class="form-control" type="text" name="id_produk" id="id_produk" value="<?= $tampil_product['id_produk'];?>" readonly>
          </div>
                       
          <div class="form-group col-md-4">
            <label for="nama_produk">Nama Produk</label>
            <input class="form-control" type="text" name="nama_produk" id="nama_produk" value="<?= $tampil_product['nama_produk'];?>" readonly>
          </div>

          <div class="form-group col-md-4">
            <label for="stok">Stok</label>
            <input class="form-control" type="number" name="stok" id="stok"  value="<?= $tampil_product['stok'];?>" readonly>
          </div>

          <div class="form-group col-md-4">
            <label for="harga_jual">Harga Jual</label>
            <input class="form-control" type="text" name="harga_jual" id="harga_jual"  value="<?= $tampil_product['harga_jual'];?>">
          </div>

          <div class="form-group col-md-4">
            <label for="total_harga_jual">Total Harga Jual</label>
            <?php $total_harga_jual = $tampil_product['harga_jual'] * $tampil_product['stok'];?>
            <input class="form-control" type="text" name="total_harga_jual" id="total_harga_jual"  value="<?= number_format($total_harga_jual,0,',','.');?>" readonly>
          </div>
        </div>
      </div>
      <div class="card-footer">
        <div class="row">
          <button id="btn-edit" type="submit" name="btn-edit" class="btn btn-secondary mr-2">Simpan</button>
          <button id="btn-back" class="btn btn-danger">Back</button>
        </div>
      </div>
    </div>
  </form>
<?php endif ?>

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

<?php else: ?>
  <?php 
   	$tampil_product = query_read("SELECT * FROM tbl_produk");
  ?>

  <!-- DATA TABEL PRODUK -->
  <div class="card shadow mb-4">
    <div class="card-header bg-secondary text-light py-3">
      <!-- JUDUL HALAMAN -->
      <div id="text-judul" class="row">
          <h4 class="alert-heading">DATA PRODUK</h4>                  
      </div>
      <button id="btn-tambah" class="btn btn-primary">Tambah produk</button>
      <button id="btn-tambah-stock" class="btn btn-warning" data-toggle="modal" data-target="#modalstock">Tambah stock</button>
  </div>

  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-bordered " id="dataTable" width="100%" cellspacing="0">
        <thead>
          <tr>
           	<th>No</th>
            <th>Id Produk</th>
            <th>Nama Produk</th>
            <th>Stok</th>
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
            <td><?= $tm['id_produk'];?></td>
            <td><?= $tm['nama_produk'];?></td>
            <td><?= $tm['stok']; ?></td>
            <td><?= number_format($tm['harga_jual'],0,',','.'); ?></td>
            <?php $total = $tm["harga_jual"] * $tm["stok"] ?>
            <td><?= number_format($total,0,',','.');?></td>
            <td>
              <a href="index.php?pages=product&aksi=edit_produk&kode=<?php echo $tm['id_produk']; ?>" class="badge badge-primary p-2" id="btn-edit">
              Edit
              </a>&nbsp;&nbsp;
              <a class="badge badge-danger p-2" href="index.php?pages=product&aksi=hapus&id=<?php echo $tm['id_produk']; ?>" id="btn-hapus">
              Hapus
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
                        <option value="<?= $tp['id_produk'];?>"><?= $tp['id_produk'];?> - <?=$tp['nama_produk'];?></option>
                    <?php endforeach;?>
                    </select>
                
  
      </div>
      <div class="modal-footer">
        <button type="button" id="pilih_produk" class="btn btn-primary">Pilih Produk</button>
      </div>
    </div>
  </div>
</div>

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


        // KEYUP HARGA BELI
        $("#harga_beli").keyup(function(){
             stok                = $("#stok").val();
             harga_beli         = convertToAngka($("#harga_beli").val());
             total_harga_beli   = stok * harga_beli;
            $("#total_harga_beli").val(convertToRupiah(total_harga_beli));

        });

        
        $("#harga_beli").keyup(function(){
            var stok = $("#stok").val();
            var harga_beli = convertToAngka($("#harga_beli").val());
            
            var total_harga_beli = stok * harga_beli;
            $("#total_harga_beli").val(convertToRupiah(total_harga_beli));

        });


        $("#harga_jual").keyup(function(){
            var stok = $("#stok").val();
            var harga_jual = convertToAngka($("#harga_jual").val());
            
            var total_harga_jual = stok * harga_jual;
            $("#total_harga_jual").val(convertToRupiah(total_harga_jual));

        });


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
            if ($("#stok").val() == "") {
                // alert("stok tidak boleh kosong");
                 Lobibox.notify('error', {
                    size: 'mini',
                    icon: true,
                    sound: false,
                    msg: 'Stok wajib diisi!'
                });
                $("#stok").focus();
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

        $("#btn-tambah-stock").click(function(event){
            if ($("#stok").val() == "") {
                  Lobibox.notify('error', {
                    size: 'mini',
                    icon: true,
                    sound: false,
                    msg: 'stok wajib diisi!'
                });
                $("#stok").focus();
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

    });
</script>
