<?php 
// ======================================================================================================================================//
//                                                           PAGES HALAMAN USERS                                                         //
// ======================================================================================================================================//

// MEMANGGIL FILE FUNCTION DI DALAM FOLDER USERS
include "konsumen/function.php";


// PROSESS PENYIMPANAN DATA USERS
if (isset($_POST['btn-simpan'])) {
    if (insert($_POST) > 0) {
        echo "<script>
                      window.location.href='index.php?pages=konsumen&notif_success=Data konsumen berhasil disimpan';
            </script>";      
          return false;

    }else{
        echo "<script>
                window.location.href='index.php?pages=konsumen&notif_error=Data konsumen Gagal disimpan';
            </script>";      
       return false;
    }
} 

// PROSES PENYIMPANAN EDIT DATA USERS
if (isset($_POST['btn-simpan-edit'])) {
    if (update($_POST) > 0) {
        echo "<script>
               window.location.href='index.php?pages=konsumen&notif_success=Data konsumen berhasil diupdate';
                </script>";      
       return false;

    }else{
        echo "<script>
                window.location.href='index.php?pages=konsumen&notif_error=Data konsumen gagal disimpan';
               </script>";
       return false;
    }
}



// AKSI TAMBAH DATA USERS / HALAMAN FORM TAMBAH DATA USERS
if (isset($_GET['aksi'])) { ?>
    

    <!-- AKSI EDIT DATA USERS / HALAMAN EDIT DATA USERS -->
    <?php if ($_GET['aksi'] === 'edit'): ?>
        <!-- CONTENT FORM EDIT DATA USERS -->
        <form action="#" method="POST" id="form-edit">
        <div class="card">
            <div class="card-header bg-secondary text-light">
                <div id="text-judul" class="row">
                    <h4 class="alert-heading">FORM EDIT KONSUMEN</h4>                
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <?php 
                $id = $_GET['id'];
                $row_users = query_select("SELECT * FROM tbl_konsumen WHERE id_konsumen = '$id'")[0];

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
                    <input class="form-control" type="hidden" value="<?php echo $row_users['id_konsumen']; ?>" name="id" id="id">
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
                            window.location.href='index.php?pages=konsumen&notif_success=Data konsumen berhasil dihapus';
                        </script>
                    ";
            }else{
                echo "
                        <script>
                            window.location.href='index.php?pages=konsumen&notif_error=Data konsumen gagal dihapus';
                        </script>
                    ";
            }
         ?>
    <?php endif ?>


    <!-- HALAMAN UTAMA MENU DATA USERS -->
    <?php }else{ ?>

    <?php $tampil_user = query_select("SELECT * FROM tbl_konsumen");?>

        <!-- BOX CONTENT DATA USERS -->
         <div class="card shadow mb-4">
            <!-- BUTTON TAMBAH DATA USER -->
            <div class="card-header bg-secondary text-light py-3">
                <div id="text-judul" class="row">
                    <h4 class="alert-heading">DATA KONSUMEN</h4>                
                </div>
            </div>
            <div class="card-body">
                <!-- TABLE DATA USERS -->
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Id konsumen</th>
                                <th>Nik</th>
                                <th>Nama Lengkap</th>
                                <th>Alamat</th>
                                <th>Action</th>
                            </tr>
                        </thead> 
                        <tbody>
                            <?php $no = 1; ?>
                            <?php foreach($tampil_user as $u):?>
                                <tr>
                                    <td><?= $no++; ?></td>
                                    <td><?=$u['id_konsumen'];?></td>
                                    <td><?= $u['nik'];?></td>
                                    <td><?= $u['nama_lengkap'];?></td>
                                    <td><?php echo $u['alamat']; ?></td>
                                    <td>
                                        <a href="index.php?pages=konsumen&aksi=edit&id=<?php echo $u['id_konsumen']; ?>" class="btn btn-sm btn-dark" id="btn-edit">
                                            <i class="fas fa-edit"></i>
                                        </a>&nbsp;&nbsp;
                                        <a class="btn btn-sm btn-danger" href="index.php?pages=konsumen&aksi=hapus&id=<?php echo $u['id_konsumen']; ?>" id="btn-hapus">
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
    

        // ACTION BUTTON KEMBALI
        $(document).on('click','#btn-back',function(event){
            event.preventDefault();
          window.location.href = "index.php?pages=konsumen";

        });

       
    });
</script>

