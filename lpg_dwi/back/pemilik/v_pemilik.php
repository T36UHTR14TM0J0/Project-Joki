<?php 
// ======================================================================================================================================//
//                                                           PAGES HALAMAN USERS                                                         //
// ======================================================================================================================================//

// MEMANGGIL FILE FUNCTION DI DALAM FOLDER USERS
include "pemilik/function.php";


// PROSESS PENYIMPANAN DATA USERS
if (isset($_POST['btn-simpan'])) {
    if (insert($_POST) > 0) {
        echo "<script>
                      window.location.href='index.php?pages=pemilik&notif_success=Data pemilik berhasil disimpan';
            </script>";      
          return false;

    }else{
        echo "<script>
                window.location.href='index.php?pages=pemilik&notif_error=Data pemilik Gagal disimpan';
            </script>";      
       return false;
    }
} 

// PROSES PENYIMPANAN EDIT DATA USERS
if (isset($_POST['btn-simpan-edit'])) {
    if (update($_POST) > 0) {
        echo "<script>
               window.location.href='index.php?pages=pemilik&notif_success=Data pemilik berhasil diupdate';
                </script>";      
       return false;

    }else{
        echo "<script>
                window.location.href='index.php?pages=pemilik&notif_error=Data pemilik gagal disimpan';
               </script>";
       return false;
    }
}



// AKSI TAMBAH DATA USERS / HALAMAN FORM TAMBAH DATA USERS
if (isset($_GET['aksi'])) { ?>
    <?php if ($_GET['aksi'] === 'tambah'): ?>
        <!-- JUDUL FORM TAMBAH DATA USERS -->
        <!-- BOX CONTENT FORM TAMBAH DATA USERS -->
        <form action="#" method="POST" id="form-tambah">
        <div class="card">
            <div class="card-header bg-secondary text-light">
                <div id="text-judul" class="row">
                    <h4 class="alert-heading">FORM TAMBAH PEMILIK</h4>                
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="form-group col-md-4">
                        <label>NIK</label>
                        <input type="text" class="form-control"
                                                id="nik" name="nik" 
                                                placeholder="Masukkan nik anda ...">
                    </div>
                    <div class="form-group col-md-4">
                        <label>NAMA LENGKAP</label>
                        <input type="nama_lengkap" class="form-control"
                                                id="nama_lengkap" name="nama_lengkap" 
                                                placeholder="Masukkan nama lengkap anda ...">
                    </div>
                    <div class="form-group col-md-4">
                        <label>ALAMAT</label>
                        <textarea class="form-control" name="alamat" id="alamat" cols="3" rows="3"></textarea>
                    </div>
                    <div class="form-group col-md-4">
                        <label>EMAIL</label>
                        <input type="email" class="form-control"
                                               id="email" name="email" 
                                                placeholder="Masukkan email anda ...">
                    </div>
                    <div class="form-group col-md-4">
                        <label>NO HP</label>
                        <input type="text" class="form-control"
                                              id="no_hp" name="no_hp" 
                                                placeholder="Masukkan no hp anda ...">
                    </div>

                    <!-- FORM TAMBAH USERNAME -->
                    <div class="form-group col-md-4">
                        <label for="username">Username</label>
                        <input class="form-control" type="text" name="username" id="username">
                    </div>

                    <!-- FORM TAMBAH PASSWORD -->
                    <div class="form-group col-md-4">
                        <label for="password">Password</label>
                        <input class="form-control" type="password" name="password" id="password">
                    </div>
                </div>
            </div>
            <div class="card-footer">
                 <div class="form-group">
                        <button id="btn-tambah-data" type="submit" name="btn-simpan" class="btn btn-success">Simpan</button>
                         <button id="btn-back" class="btn btn-danger">Back</button>
                    </div>
            </div>
        </div>
                
        <!-- BUTTON SIMPAN DAN BACK -->             
        </form>
    <?php endif ?>

    <!-- AKSI EDIT DATA USERS / HALAMAN EDIT DATA USERS -->
    <?php if ($_GET['aksi'] === 'edit'): ?>
        <!-- CONTENT FORM EDIT DATA USERS -->
        <form action="#" method="POST" id="form-edit">
        <div class="card">
            <div class="card-header bg-secondary text-light">
                <div id="text-judul" class="row">
                    <h4 class="alert-heading">FORM EDIT PEMILIK</h4>                
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <?php 
                $id = $_GET['id'];
                $row_users = query_select("SELECT * FROM tbl_pemilik WHERE id_pemilik = '$id'")[0];

             ?>
             
                <div class="form-group col-md-4">
                        <label>NIK</label>
                        <input type="text" class="form-control" id="nik" name="nik" value="<?php echo $row_users['nik']; ?>">
                    </div>
                    <div class="form-group col-md-4">
                        <label>NAMA LENGKAP</label>
                        <input type="nama_lengkap" class="form-control"
                                                id="nama_lengkap" name="nama_lengkap" 
                                               value="<?php echo $row_users['nama_lengkap']; ?>">
                    </div>
                    <div class="form-group col-md-4">
                        <label>ALAMAT</label>
                        <textarea class="form-control" name="alamat" id="alamat" cols="3" rows="3"><?php echo $row_users['alamat']; ?></textarea>
                    </div>
                    <div class="form-group col-md-4">
                        <label>EMAIL</label>
                        <input type="email" class="form-control" id="email" name="email" value="<?php echo $row_users['email']; ?>">
                    </div>
                    <div class="form-group col-md-4">
                        <label>NO HP</label>
                        <input type="text" class="form-control" id="no_hp" name="no_hp"value="<?php echo $row_users['no_hp']; ?>">
                    </div>

                <!-- FORM EDIT USERNAME -->
                <div class="form-group col-md-4">
                    <input class="form-control" type="hidden" value="<?php echo $row_users['id_pemilik']; ?>" name="id" id="id">
                    <label for="username">Username</label>
                    <input class="form-control" type="text" value="<?php echo $row_users['username']; ?>" name="username" id="username">
                </div>

                <!-- FORM EDIT PASSWORD -->
                <div class="form-group col-md-4">
                    <label for="password">Password</label>
                    <input class="form-control" type="password"  name="password" id="password">
                </div>
                </div>
            </div>
            <div class="card-footer">
                <!-- BUTTON SIMPAN & BACK -->
                <div class="form-group">
                    <button id="btn-edit-data" type="submit" name="btn-simpan-edit" class="btn btn-success">Simpan</button>
                    <button id="btn-back" class="btn btn-danger">Back</button>
                </div>
            </div>
        </div>            
     </form>
    <?php endif ?>

    <!-- AKSI HAPUS / DELETE DATA USERS -->
    <?php if ($_GET['aksi'] === 'hapus'): ?>
        <?php 
            $id = $_GET["id"];
            if(delete($id) > 0){
                echo "
                        <script>
                            window.location.href='index.php?pages=pemilik&notif_success=Data pemilik berhasil dihapus';
                        </script>
                    ";
            }else{
                echo "
                        <script>
                            window.location.href='index.php?pages=pemilik&notif_error=Data pemilik gagal dihapus';
                        </script>
                    ";
            }
         ?>
    <?php endif ?>


    <!-- HALAMAN UTAMA MENU DATA USERS -->
    <?php }else{ ?>

    <?php $tampil_user = query_select("SELECT * FROM tbl_pemilik");?>

        <!-- BOX CONTENT DATA USERS -->
         <div class="card shadow mb-4">
            <!-- BUTTON TAMBAH DATA PEMILIK -->
            <div class="card-header bg-secondary text-light py-3">
                <div id="text-judul" class="row">
                    <h4 class="alert-heading">DATA PEMILIK</h4>                
                </div>
                <button id="btn-tambah" class="btn btn-primary"><i class="fas fa-plus"></i>&nbsp;Tambah data</button>
            </div>
            <div class="card-body">
                <!-- TABLE DATA USERS -->
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Id Pemilik</th>
                                <th>Username</th>
                                <th>Password</th>
                                <th>Action</th>
                            </tr>
                        </thead> 
                        <tbody>
                            <?php $no = 1; ?>
                            <?php foreach($tampil_user as $u):?>
                                <tr>
                                    <td><?= $no++; ?></td>
                                    <td><?=$u['id_pemilik'];?></td>
                                    <td><?= $u['username'];?></td>
                                    <td><?= $u['password'];?></td>
                                    <td>
                                        <a href="index.php?pages=pemilik&aksi=edit&id=<?php echo $u['id_pemilik']; ?>" class="btn btn-sm btn-dark" id="btn-edit">
                                            <i class="fas fa-edit"></i>
                                        </a>&nbsp;&nbsp;
                                        <a class="btn btn-sm btn-danger" href="index.php?pages=pemilik&aksi=hapus&id=<?php echo $u['id_pemilik']; ?>" id="btn-hapus">
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
    <?php }?>


<!-- SCRIPT JAVASCRIPT JQUERY -->
<script type="text/javascript">
    $(document).ready(function(){
          $('#nik').mask('0000 0000 0000 0000');
            $('#no_hp').mask('0000-0000-0000');
        
        // ACTION BUTTON TAMBAH DATA
        $(document).on('click','#btn-tambah',function(event){
            event.preventDefault();
          window.location.href = "index.php?pages=pemilik&aksi=tambah";

        });

        // ACTION BUTTON KEMBALI
        $(document).on('click','#btn-back',function(event){
            event.preventDefault();
          window.location.href = "index.php?pages=pemilik";

        });

        // ACTION BUTTON SIMPAN DATA
        $("#btn-tambah-data").click(function(event){
        // event.preventDefault(); //prevent default action 

            if($("#username").val() == ""){
                // alert("Nama produk tidak boleh kosong");
                Lobibox.notify('error', {
                    size: 'mini',
                    icon: true,
                    sound: false,
                    msg: 'Username wajib diisi!'
                });
                $("#username").focus();
                return false;
            }

            if ($("#password").val() == "") {
                // alert("Qty tidak boleh kosong");
                 Lobibox.notify('error', {
                    size: 'mini',
                    icon: true,
                    sound: false,
                    msg: 'Password wajib diisi!'
                });
                $("#password").focus();
                return false;
            }

        });

       
    });
</script>

