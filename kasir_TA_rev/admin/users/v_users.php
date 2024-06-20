<?php 
// ======================================================================================================================================//
//                                                           PAGES HALAMAN USERS                                                         //
// ======================================================================================================================================//

// MEMANGGIL FILE FUNCTION DI DALAM FOLDER USERS
include "users/function.php";


// PROSESS PENYIMPANAN DATA USERS
if (isset($_POST['btn-simpan'])) {
    if (insert($_POST) > 0) {
        echo "<script>
                      window.location.href='index.php?pages=user&notif_success=Data User berhasil disimpan';
            </script>";      
          return false;

    }else{
        echo "<script>
                window.location.href='index.php?pages=user&notif_error=Data User Gagal disimpan';
            </script>";      
       return false;
    }
} 

// PROSES PENYIMPANAN EDIT DATA USERS
if (isset($_POST['btn-simpan-edit'])) {
    if (update($_POST) > 0) {
        echo "<script>
               window.location.href='index.php?pages=user&notif_success=Data User berhasil diupdate';
                </script>";      
       return false;

    }else{
        echo "<script>
                window.location.href='index.php?pages=user&notif_error=Data User gagal disimpan';
               </script>";
       return false;
    }
}



// AKSI TAMBAH DATA USERS / HALAMAN FORM TAMBAH DATA USERS
if (isset($_GET['aksi'])) { ?>
    <?php if ($_GET['aksi'] === 'tambah'): ?>
        <!-- JUDUL FORM TAMBAH DATA USERS -->
        <div id="text-judul" class="row">
            <div class="alert alert-success" role="alert" style="width: 100%;">
                  <h4 class="alert-heading">FORM TAMBAH DATA USER</h4>
                  
            </div>
        </div>
                <!-- BOX CONTENT FORM TAMBAH DATA USERS -->
                <form action="#" method="POST" id="form-tambah">

                    <!-- FORM TAMBAH PILIH LEVEL USERS -->
                     <div class="form-group">
                        <label for="level">Pilih Level</label>
                        <select class="form-control" name="level" id="level">
                                <option value="admin">Admin</option>
                                <option value="kasir">Kasir</option>                         
                        </select>
                    </div>

                    <!-- FORM TAMBAH USERNAME -->
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input class="form-control" type="text" name="username" id="username">
                    </div>

                    <!-- FORM TAMBAH PASSWORD -->
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input class="form-control" type="password" name="password" id="password">
                    </div>

                    <!-- BUTTON SIMPAN DAN BACK -->
                    <div class="form-group">
                        <button id="btn-tambah-data" type="submit" name="btn-simpan" class="btn btn-warning">Simpan</button>
                         <button id="btn-back" class="btn btn-secondary">Back</button>
                    </div>
                </form>
    <?php endif ?>

    <!-- AKSI EDIT DATA USERS / HALAMAN EDIT DATA USERS -->
    <?php if ($_GET['aksi'] === 'edit'): ?>
        <div id="text-judul" class="row">
            <!-- JUDUL FORM -->
                <div class="alert alert-success" role="alert" style="width: 100%;">
                      <h4 class="alert-heading">FORM EDIT DATA USER</h4>
                      
                </div>
            </div>

            <?php 
                $id = $_GET['id'];
                $row_users = query_select("SELECT * FROM tbl_users WHERE id_user = '$id'")[0];

             ?>
             <!-- CONTENT FORM EDIT DATA USERS -->
            <form action="#" method="POST" id="form-edit">
                <!-- FORM PILIH LEVEL USERS -->
                <div class="form-group">
                        <label for="level">Pilih Level</label>
                        <select class="form-control" name="level" id="level">
                                <option value="admin">Admin</option>
                                <option value="kasir">kasir</option>                         
                        </select>
                </div>

                <!-- FORM EDIT USERNAME -->
                <div class="form-group">
                    <input class="form-control" type="hidden" value="<?php echo $row_users['id_user']; ?>" name="id" id="id">
                    <label for="username">Username</label>
                    <input class="form-control" type="text" value="<?php echo $row_users['username']; ?>" name="username" id="username">
                </div>

                <!-- FORM EDIT PASSWORD -->
                <div class="form-group">
                    <label for="password">Password</label>
                    <input class="form-control" type="password"  name="password" id="password">
                </div>

                
                <!-- BUTTON SIMPAN & BACK -->
                <div class="form-group">
                    <button id="btn-edit-data" type="submit" name="btn-simpan-edit" class="btn btn-warning">Simpan</button>
                    <button id="btn-back" class="btn btn-secondary">Back</button>
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
                            window.location.href='index.php?pages=user&notif_success=Data User berhasil dihapus';
                        </script>
                    ";
            }else{
                echo "
                        <script>
                            window.location.href='index.php?pages=user&notif_error=Data User gagal dihapus';
                        </script>
                    ";
            }
         ?>
    <?php endif ?>


    <!-- HALAMAN UTAMA MENU DATA USERS -->
    <?php }else{ ?>
        <div id="text-judul" class="row">
            <div class="alert alert-success" role="alert" style="width: 100%;">
                  <h4 class="alert-heading">DATA USERS</h4>
                  
            </div>
        </div>

    <?php $tampil_user = query_select("SELECT * FROM tbl_users");?>

        <!-- BOX CONTENT DATA USERS -->
         <div class="card shadow mb-4">
            <!-- BUTTON TAMBAH DATA USER -->
            <div class="card-header py-3">
                <button id="btn-tambah" class="btn btn-warning"><i class="fas fa-plus"></i>&nbsp;Tambah data</button>
            </div>
            <div class="card-body">
                <!-- TABLE DATA USERS -->
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Id User</th>
                                <th>Level</th>
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
                                    <td><?=$u['id_user'];?></td>
                                    <td><?= $u['level'];?></td>
                                    <td><?= $u['username'];?></td>
                                    <td><?= $u['password'];?></td>
                                    <td>
                                        <a href="index.php?pages=user&aksi=edit&id=<?php echo $u['id_user']; ?>" class="btn btn-sm btn-dark" id="btn-edit">
                                            <i class="fas fa-edit"></i>
                                        </a>&nbsp;&nbsp;
                                        <a class="btn btn-sm btn-danger" href="index.php?pages=user&aksi=hapus&id=<?php echo $u['id_user']; ?>" id="btn-hapus">
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
        
        // ACTION BUTTON TAMBAH DATA
        $(document).on('click','#btn-tambah',function(event){
            event.preventDefault();
          window.location.href = "index.php?pages=user&aksi=tambah";

        });

        // ACTION BUTTON KEMBALI
        $(document).on('click','#btn-back',function(event){
            event.preventDefault();
          window.location.href = "index.php?pages=user";

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

