<?php 
// ======================================================================================================================================//
//                                                    FILE INDEX - HALAMAN LOGIN                                                         //
// ======================================================================================================================================//


session_start(); // MENGAKTIFKAN FUNGSI SESSION PADA PHP

// CEK APAKAH SESSION LOGIN BERNILAI TRUE
if (isset($_SESSION['login']) === TRUE) {
    header("location:admin/index.php");
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

    <title>Halaman Login</title>
    <link rel="shortcut icon"  href="admin/assets/img/image_1.png">

    <!-- Custom fonts for this template-->
    <link href="admin/assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="admin/assets/css/sb-admin-2.min.css" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="admin/assets/vendor/lobibox/css/lobibox.min.css">

        <!-- SCRIPT CSS  -->
        <style type="text/css">
            body{
                background-image: url('admin/assets/img/image_1.png');
                background-repeat: no-repeat;
                background-size: 100% 730px;
                padding: 0px;
            

                
            }

            @media(min-width: 576px){
                body{
                    
                    background-size: 100% 720px;
                   
                }
            }



            #content-login{
                position: relative;
                top: 200px;
            }

            .card{
                background-color: transparent;
                box-shadow: 1px 1px 10px 0px black;
                border-radius: 20px;
            }

        </style>
        <!-- END SCRIPT CSS -->

</head>

<body>
    <!-- BAGIAN BODY CONTENT PADA HALAMAN LOGIN -->
    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center" id="content-login" >

            <div class="col-xl-7 col-lg-9 col-md-6" >

                <div class="card o-hidden border-0 my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg">
                                <div class="p-5">
                                    <div class="text-center">
                                        <i class="fas fa-lock text-light" style="font-size: 34px;"></i>
                                        <h1 class="h4  mb-4 text-light " style="text-shadow: 2px 2px 2px black;">HALAMAN LOGIN</h1>
                                    </div>
                                    <!-- BAGIAN FORM INPUT LOGIN -->
                                    <form id="form-login" name="form-login" class="user" action="#" method="POST">
                                        <div class="form-group">
                                            <input type="username" class="form-control form-control-user"
                                                id="username" name="username" 
                                                placeholder="Masukkan username anda ...">
                                        </div>
                                        <div class="form-group">
                                            <input type="password" name="password" class="form-control form-control-user"
                                                id="password" placeholder="Masukkan password anda ..">
                                        </div>
                                        <button id="btn-login" name="btn-login" class="btn btn-warning btn-user btn-block">
                                            Login
                                        </button>
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
    <script src="admin/assets/vendor/jquery/jquery.min.js"></script>
    <script src="admin/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="admin/assets/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="admin/assets/js/sb-admin-2.min.js"></script>
    <script src="admin/assets/vendor/lobibox/js/lobibox.js"></script>

    <!-- ============================================================================================================ -->
    <!--                                            SCRIPT JAVASCRIPT & jquery                                        -->
    <!-- ============================================================================================================ -->
    <script type="text/javascript">
        $(document).ready(function(){
            // AKSI BUTTON CLICK LOGIN
            $(document).on('click','#btn-login',function(event){
                event.preventDefault();

                let username = $("#username").val();
                let password = $("#password").val();

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
                var formData    =$('#form-login').serialize();
                 $.ajax({
                  url     : "cek_login.php",
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
                            msg: 'Login berhasil'
                        });
                      setTimeout(function(){
                        location = 'admin/index.php'
                      },5000);
                    }else{  
                        // JIKA DATA STATUS TIDAK SAMA DENGAN 1 USERNAME ATAU PASSWORD SALAH
                        Lobibox.notify('error', {
                            size: 'mini',
                            icon: true,
                            sound: false,
                            msg: 'Username atau password salah!'
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