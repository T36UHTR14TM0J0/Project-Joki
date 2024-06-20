<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>SIAD | Log in</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo base_url('assets/');?>plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="<?php echo base_url('assets/');?>plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url('assets/');?>dist/css/adminlte.min.css">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/plugins/lobibox/css/lobibox.min.css">

  <style type="text/css">
    body{
      background-image: url(<?php echo base_url('assets/img/bg-sekolah.jpg'); ?>);
      background-size: cover;
    }
  </style>
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="card border border-primary shadow-lg">
    <div class="card-body login-card-body">
      <div class="login-logo">
        <img width="100" height="100" src="<?php echo base_url('assets/') ?>img/logo-sekolah.png" alt="Logo" class="brand-image img-circle elevation-1 bg-light" style="opacity: .8">
      </div>
  <!-- /.login-logo -->
      
        <h4 class="login-box-msg text-uppercase text-primary ">LOGIN SIAD PAKAR</h4>
          
      

      <form action="<?php echo base_url('auth/Login') ?>" method="post">
        <div class="input-group mb-3">
          <input type="text" id="username" name="username" class="form-control" placeholder="Username">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" id="password" name="password" class="form-control" placeholder="Password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-4">
            <button type="submit" id="btn-login" class="btn btn-primary btn-block">Login</button>
          </div>
          <!-- /.col -->
        </div>
      </form>
    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="<?php echo base_url('assets/');?>plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="<?php echo base_url('assets/');?>plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url('assets/');?>dist/js/adminlte.min.js"></script>

<script src="<?php echo base_url(); ?>assets/plugins/lobibox/js/lobibox.js"></script>

<script>
        $(document).ready(function() {

            
            <?php
            // NOTIFIKASI JIKA SUKSES
            if ($this->session->userdata("pesan_error")) {
            ?>
                Lobibox.notify('error', {
                    size: 'mini',
                    icon: true,
                    sound: false,
                    msg: '<?php echo $this->session->userdata("pesan_error")?>'
                });
            <?php
                $this->session->unset_userdata("pesan_error");
            }
            ?>

            <?php
            // NOTIFIKASI JIKA SUKSES
            if ($this->session->userdata("pesan_sukses")) {
            ?>
                Lobibox.notify('success', {
                    size: 'mini',
                    icon: true,
                    sound: false,
                    msg: '<?php echo $this->session->userdata("pesan_sukses")?>'
                });
            <?php
                $this->session->unset_userdata("pesan_sukses");
            }
            ?>

            $("#btn-login").click(function(event){
            if ($("#username").val() == "") {
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
