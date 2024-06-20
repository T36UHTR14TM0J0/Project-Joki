<?php 

session_start(); // MENGAKTIFKAN FUNGSI SESSION PADA PHP

// CEK APAKAH SESSION LOGIN BERNILAI TRUE
if (isset($_SESSION['login']) === TRUE) {
    header("location:back/index.php");
    exit;
}

 ?>
 
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Halaman Daftar</title>
    <!-- <link rel="shortcut icon"  href="back/assets/img/image_1.png"> -->

    <!-- Custom fonts for this template-->
    <link href="assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="assets/css/sb-admin-2.min.css" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="assets/vendor/lobibox/css/lobibox.min.css">

        <!-- SCRIPT CSS  -->
        <style type="text/css">
            body{
                margin:0px;
                padding: 0px;
            }

            @media(min-width: 576px){
                body{
                    
                    background-size: 100% 720px;
                   
                }
            }



            #content-login{
                position: relative;
                top: 100px;
            }

            .card{
                background-color: transparent;
                box-shadow: 1px 1px 10px 0px green;
                border-radius: 20px;
            }

        </style>
        <!-- END SCRIPT CSS -->

</head>

<body class="bg-info">
    <!-- BAGIAN BODY CONTENT PADA HALAMAN LOGIN -->
    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center" id="content-login" >

            <div class="col-xl-7 col-lg-9 col-md-6" >

                <div class="card o-hidden border-0 my-5 bg-light">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg">
                                <div class="p-5">
                                    <div class="text-center">
                                         <img src="assets/img/image_1.png" width="100">
                                        <h1 class="h4  mb-4 text-success " style="text-shadow: 2px 1px 1px black;">HALAMAN DAFTAR</h1>
                                    </div>
                                    <!-- BAGIAN FORM INPUT LOGIN -->
                                    <form id="form-daftar" name="form-daftar" class="user" action="#" method="POST">
                                         <div class="form-group">
                                            <label>NIK</label>
                                            <input type="text" class="form-control"
                                                id="nik" name="nik" 
                                                placeholder="Masukkan nik anda ...">
                                        </div>
                                         <div class="form-group">
                                            <label>NAMA LENGKAP</label>
                                            <input type="nama_lengkap" class="form-control"
                                                id="nama_lengkap" name="nama_lengkap" 
                                                placeholder="Masukkan nama lengkap anda ...">
                                        </div>
                                         <div class="form-group">
                                            <label>ALAMAT</label>
                                            <textarea class="form-control" name="alamat" id="alamat" cols="3" rows="3"></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label>EMAIL</label>
                                            <input type="email" class="form-control"
                                                id="email" name="email" 
                                                placeholder="Masukkan email anda ...">
                                        </div>
                                        <div class="form-group">
                                            <label>NO HP</label>
                                            <input type="text" class="form-control"
                                                id="no_hp" name="no_hp" 
                                                placeholder="Masukkan no hp anda ...">
                                        </div>
                                        <div class="form-group">
                                            <label>USERNAME</label>
                                            <input type="username" class="form-control"
                                                id="username" name="username" 
                                                placeholder="Masukkan username anda ...">
                                        </div>
                                        <div class="form-group">
                                            <label>PASSWORD</label>
                                            <input type="password" name="password" class="form-control"
                                                id="password" placeholder="Masukkan password anda ..">
                                        </div>
                                        <button id="btn-daftar" name="btn-daftar" class="btn btn-success btn-user btn-block">
                                            Daftar
                                        </button>
                                         <hr>
                                        <a href="index.php" class="btn btn-danger btn-user btn-block">
                                         Sudah punya akun ? Login
                                        </a>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>


    <!-- Bootstrap core JavaScript-->

    <script src="assets/vendor/jquery/jquery.min.js"></script>
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="assets/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="assets/js/sb-admin-2.min.js"></script>
    <script src="assets/vendor/jquery/jquery.mask.min.js"></script>
    <script src="assets/vendor/lobibox/js/lobibox.js"></script>

    <!-- ============================================================================================================ -->
    <!--                                            SCRIPT JAVASCRIPT & jquery                                        -->
    <!-- ============================================================================================================ -->
    <script type="text/javascript">
        $(document).ready(function(){
            $('#nik').mask('0000 0000 0000 0000');
            $('#no_hp').mask('0000-0000-0000');
            // AKSI BUTTON CLICK LOGIN
            $(document).on('click','#btn-daftar',function(event){
                event.preventDefault();

                let nik             = $("#nik").val();
                let nama_lengkap    = $("#nama_lengkap").val();
                let alamat          = $("#alamat").val();
                let email           = $("#email").val();
                let no_hp           = $("#no_hp").val();
                let username        = $("#username").val();
                let password        = $("#password").val();

                // VALIDASI LOGIN INPUT NIK
                if (nik === '' || nik === null) {
                    Lobibox.notify('error', {
                        size: 'mini',
                        icon: true,
                        sound: false,
                        msg: 'Nik tidak boleh kosong!'
                    });
                    $("#nik").focus();
                    return false;
                }

                // VALIDASI LOGIN INPUT NAMA LENGKAP
                if (nama_lengkap === '' || nama_lengkap === null) {
                    Lobibox.notify('error', {
                        size: 'mini',
                        icon: true,
                        sound: false,
                        msg: 'nama lengkap tidak boleh kosong!'
                    });
                    $("#nama_lengkap").focus();
                    return false;
                }

                // VALIDASI LOGIN INPUT ALAMAT
                if (alamat === '' || alamat === null) {
                    Lobibox.notify('error', {
                        size: 'mini',
                        icon: true,
                        sound: false,
                        msg: 'Alamat tidak boleh kosong!'
                    });
                    $("#alamat").focus();
                    return false;
                }

                // VALIDASI LOGIN INPUT EMAIL
                if (email === '' || email === null) {
                    Lobibox.notify('error', {
                        size: 'mini',
                        icon: true,
                        sound: false,
                        msg: 'Email tidak boleh kosong!'
                    });
                    $("#email").focus();
                    return false;
                }

                // VALIDASI LOGIN INPUT USERNAME
                if (no_hp === '' || no_hp === null) {
                    Lobibox.notify('error', {
                        size: 'mini',
                        icon: true,
                        sound: false,
                        msg: 'No hp tidak boleh kosong!'
                    });
                    $("#no_hp").focus();
                    return false;
                }

                // VALIDASI LOGIN INPUT USERNAME
                if (username === '' || username === null) {
                    Lobibox.notify('error', {
                        size: 'mini',
                        icon: true,
                        sound: false,
                        msg: 'Username tidak boleh kosong!'
                    });
                    $("#username").focus();
                    return false;
                }


                // VALIDASI LOGIN INPUT PASSWORD
                if (password === '' || password === null) {
                    Lobibox.notify('error', {
                        size: 'mini',
                        icon: true,
                        sound: false,
                        msg: 'Password tidak boleh kosong!'
                    });
                    $("#password").focus();
                    return false;
                }

                // PROSES LOGIN MENGGUNAKAN AJAX JQUERY
                var formData    =$('#form-daftar').serialize();
                 $.ajax({
                  url     : "proses_daftar.php",
                  type    : "POST",
                  data    : formData,
                  success   : function(data){
                    var datas = $.parseJSON(data);
                    // IF JIKA DATA STATUS 1 BERHASIL LOGIN
                    if(datas.status == 1 ){
                        Lobibox.notify('success', {
                            size: 'mini',
                            icon: true,
                            sound: false,
                            msg: 'berhasil daftar akun'
                        });
                      setTimeout(function(){
                        location = 'index.php'
                      },5000);
                    }else{  
                        // JIKA DATA STATUS TIDAK SAMA DENGAN 1 USERNAME ATAU PASSWORD SALAH
                        Lobibox.notify('error', {
                            size: 'mini',
                            icon: true,
                            sound: false,
                            msg: 'Nik sudah terdaftar'
                        });      
                      return false;
                      
                    }
                  },
                  // ERROR SYSTEM RESPONSE
                  error: function(response) {
                     Lobibox.notify('error', {
                        size: 'mini',
                        icon: true,
                        sound: false,
                        msg: 'Terjadi kesalahan pada sistem!'
                    });
                    return false;
                  }
                });  
            });
        });
    </script>

</body>

</html>