<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Sip - Login</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="<?php echo base_url(); ?>assets/dist/css/sb-admin-2.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/vendor/lobibox/css/lobibox.min.css">

</head>

<body style="background-image: url(<?php echo base_url();?>/assets/images/logo-ibi.png);background-repeat: no-repeat;background-size: 50%;background-position: center;">

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-6 col-lg-9 col-md-6 ">

                <div class="card  border-2 shadow-lg my-5 bg-transparent">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg">
                                <div class="p-5 text-center">
                                    <img class="rounded rounded-circle" src="<?php echo base_url();?>/assets/images/logo-ulfi.png" width="300" height="300" align="center">
                                    <div class="panel-heading  rounded mt-2 bg-info text-light mb-1 bold">
                                        <h4 class="panel-title">HALAMAN LOGIN</h4>
                                    </div>
                                    
                                    <div class="panel-body">
                                        <form id="login-form" class="text-left" action="<?php echo base_url('login/aksi_login'); ?>" method="post">
                                            <fieldset>
                                                <div class="form-group">
                                                    <input type="text" class="form-control" id="lg_username" name="username" placeholder="Username" autofocus required autocomplete="off">
                                                </div>
                                                <div class="form-group">
                                                    <input class="form-control" placeholder="Password" name="password" type="password" id="password" required autocomplete="off">
                                                </div>
                                                <button type="submit" class="btn btn-lg btn-success btn-block" id="btn-login" value="login">Login</button>
                                                <hr>
                                            </fieldset>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

    
  <!-- Bootstrap core JavaScript-->
    <script src="<?php echo base_url() ?>assets/vendor/jquery/jquery.min.js"></script>
    <script src="<?php echo base_url() ?>assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="<?php echo base_url() ?>assets/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="<?php echo base_url() ?>assets/dist/js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="<?php echo base_url() ?>assets/vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/chart-area-demo.js"></script>
    <script src="js/demo/chart-pie-demo.js"></script>
    <script src="<?php echo base_url(); ?>assets/vendor/lobibox/js/lobibox.js"></script>
    <script>
        $(document).ready(function() {

            
            <?php
            // NOTIFIKASI JIKA SUKSES
            if ($this->session->userdata("notif_gagal")) {
            ?>
                Lobibox.notify('error', {
                    size: 'mini',
                    icon: true,
                    sound: false,
                    msg: '<?php echo $this->session->userdata("notif_gagal")?>'
                });
            <?php
                $this->session->unset_userdata("notif_gagal");
            }
            ?>

            <?php
            // NOTIFIKASI JIKA SUKSES
            if ($this->session->userdata("notif_sukses")) {
            ?>
                Lobibox.notify('success', {
                    size: 'mini',
                    icon: true,
                    sound: false,
                    msg: '<?php echo $this->session->userdata("notif_sukses")?>'
                });
            <?php
                $this->session->unset_userdata("notif_sukses");
            }
            ?>

            $("#btn-login").click(function(event){
            if ($("#lg_username").val() == "") {
                  Lobibox.notify('error', {
                    size: 'mini',
                    icon: true,
                    sound: false,
                    msg: 'Username wajib di isi..!'
                });
                $("#lg_username").focus();
                return false;
            }

            if ($("#password").val() == "") {
                  Lobibox.notify('error', {
                    size: 'mini',
                    icon: true,
                    sound: false,
                    msg: 'password wajib di isi ...!'
                });
                $("#password").focus();
                return false;
            }

        });

           
             
        });


    </script>

</body>

</html>