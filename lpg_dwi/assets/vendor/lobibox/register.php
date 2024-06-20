<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>register</title>

    <!-- Custom fonts for this template-->
    <link href="<?php echo base_url(); ?>assets/admin/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="<?php echo base_url(); ?>assets/admin/css/sb-admin-2.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/vendor/lobibox/css/lobibox.min.css">



</head>

<body class="bg-gradient-secondary">

    <div class="container">

        <div class="card o-hidden border-0 shadow-lg my-5" style="background-color: green;;">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="row">
                    <div class="col-lg">
                        <div class="p-5">
                            <div class="text-center">
                                <img class="image-fluid mb-2" width="100" src="<?php echo base_url('assets/img/upload/logo.jpeg'); ?>">
                                <h1 class="h4 mb-4" style="color: yellow;text-transform: uppercase;">Registrasi Akun</h1>
                            </div>
                            <form class="user" id="form-daftar" style="color: white;" method="post" action="#" enctype="multipart/form-data">
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap" placeholder="Nama Lengkap">
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control" id="username" name="username" placeholder="Username" 
                                            >
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir" placeholder="tanggal lahir">
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="password" class="form-control" id="password" name="password" placeholder="Password" 
                                            >
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="text" class="form-control" id="tempat_lahir" name="tempat_lahir" placeholder="Tempat Lahir">
                                    </div>
                                    <div class="col-sm-6">
                                        <select id="agama" name="agama" class="form-control" placeholder="Agama">
                                            <option>Agama :</option>
                                            <option>Islam</option>
                                            <option>Kristen</option>
                                            <option>Hindu</option>
                                            <option>Budha</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label>Alamat Lengkap :</label>
                                    <textarea id="alamat_lengkap" name="alamat_lengkap" class="form-control" style="padding: 0px;">
                                    </textarea>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <select id="jenis_kelamin" name="jenis_kelamin" class="form-control">
                                            <option>Jenis kelamin :</option>
                                            <option>Laki - Laki</option>
                                            <option>Perempuan</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control"
                                            id="puk" name="puk" placeholder="PUK">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="email" class="form-control"
                                            id="email" name="email" placeholder="Email">
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="input-group mb-3">
                                          <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1">+64</span>
                                          </div>
                                          <input type="number" class="form-control" placeholder="No tlp / Wa" id="no_tlp" name="no_tlp">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                       <div class="imgWrap mb-2">
                                            <img src="" id="imgViewprofil" class="card-img-top img-fluid">
                                        </div>

                                       <label for="inputFileprofil">Upload Foto Profil</label> 
                                       <div class="custom-file">
                                            <input type="file" name="inputFileprofil" id="inputFileprofil" class="imgFile custom-file-input" aria-describedby="inputGroupFileAddon01">
                                            <label class="custom-file-label" for="inputFile">Choose file</label>
                                        </div>
                                        
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="imgWrap mb-2">
                                            <img src="" id="imgViewktp" class="card-img-top img-fluid">
                                        </div>

                                        <label for="inputFilektp">Upload Foto Ktp</label> 
                                       <div class="custom-file">
                                            <input type="file" id="inputFilektp" name="img_ktp" class="imgFile custom-file-input" aria-describedby="inputGroupFileAddon01">
                                            <label class="custom-file-label" for="inputFile">Choose file</label>
                                        </div>
                                    </div>
                                </div>

                               

                                <button type="submit" id="btn-daftar" name="btn-daftar" class="btn btn-user btn-block" style="background-color: yellow;color: grey;">
                                    Register Account
                                </button>
                                
                            </form>
                            <div class="text-center">
                                <a class="small" href="login.html" style="color: yellow;">Already have an account? Login!</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="<?php echo base_url(); ?>assets/admin/vendor/jquery/jquery.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/admin/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="<?php echo base_url(); ?>assets/admin/vendor/jquery-easing/jquery.easing.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/vendor/lobibox/js/lobibox.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="<?php echo base_url(); ?>assets/admin/js/sb-admin-2.min.js"></script>

    <script>

    $("#inputFileprofil").change(function(event) {  
      fadeInAdd();
      getURLprofil(this);    
    });

    $("#inputFileprofil").on('click',function(event){
      fadeInAdd();
    });

    function getURLprofil(input) {    
      if (input.files && input.files[0]) {   
        var reader = new FileReader();
        var filename = $("#inputFileprofil").val();
        filename = filename.substring(filename.lastIndexOf('\\')+1);
        reader.onload = function(e) {
          debugger;      
          $('#imgViewprofil').attr('src', e.target.result);
          $('#imgViewprofil').hide();
          $('#imgViewprofil').fadeIn(500);      
          $('.custom-file-label').text(filename);             
        }
        reader.readAsDataURL(input.files[0]);    
      }
      $(".alert").removeClass("loadAnimate").hide();
    }

    $("#inputFilektp").change(function(event) {  
      fadeInAdd();
      getURLktp(this);    
    });

    $("#inputFilektp").on('click',function(event){
      fadeInAdd();
    });

    function getURLktp(input) {    
      if (input.files && input.files[0]) {   
        var reader = new FileReader();
        var filename = $("#inputFilektp").val();
        filename = filename.substring(filename.lastIndexOf('\\')+1);
        reader.onload = function(e) {
          debugger;      
          $('#imgViewktp').attr('src', e.target.result);
          $('#imgViewktp').hide();
          $('#imgViewktp').fadeIn(500);      
          $('.custom-file-label').text(filename);             
        }
        reader.readAsDataURL(input.files[0]);    
      }
      $(".alert").removeClass("loadAnimate").hide();
    }

    function fadeInAdd(){
      fadeInAlert();  
    }
    function fadeInAlert(text){
      $(".alert").text(text).addClass("loadAnimate");  
    }

    $("#btn-daftar").click(function(event){
        event.preventDefault(); //prevent default action 
       
        
        if($('#nama_lengkap').val() == ''){
            document.getElementById("nama_lengkap").focus();
    
            Lobibox.notify('warning', {
                size: 'mini',
                icon: false,
                sound: false,
                msg: 'Nama Lengkap tidak boleh kosong !!!'
            });
    
            $('#btn-daftar').prop('disabled',false);
            return false;
        } 

        if($('#username').val() == ''){
            document.getElementById("username").focus();
    
            Lobibox.notify('warning', {
                size: 'mini',
                icon: false,
                sound: false,
                msg: 'Username tidak boleh kosong !!!'
            });
    
            $('#btn-daftar').prop('disabled',false);
            return false;
        }

        if($('#tanggal_lahir').val() == ''){
            document.getElementById("tanggal_lahir").focus();
    
            Lobibox.notify('warning', {
                size: 'mini',
                icon: false,
                sound: false,
                msg: 'Tanggal Lahir tidak boleh kosong !!!'
            });
    
            $('#btn-daftar').prop('disabled',false);
            return false;
        }  

        
        if($('#password').val() == ''){
            document.getElementById("password").focus();
    
            Lobibox.notify('warning', {
                size: 'mini',
                icon: false,
                sound: false,
                msg: 'Password tidak boleh kosong !!!'
            });
    
            $('#btn-daftar').prop('disabled',false);
            return false;
        } 

        if($('#tempat_lahir').val() == ''){
            document.getElementById("tempat_lahir").focus();
    
            Lobibox.notify('warning', {
                size: 'mini',
                icon: false,
                sound: false,
                msg: 'Tempat Lahir tidak boleh kosong !!!'
            });
    
            $('#btn-daftar').prop('disabled',false);
            return false;
        }

        if($('#email').val() == ''){
            document.getElementById("email").focus();
    
            Lobibox.notify('warning', {
                size: 'mini',
                icon: false,
                sound: false,
                msg: 'Email tidak boleh kosong !!!'
            });
    
            $('#btn-daftar').prop('disabled',false);
            return false;
        }

        if($('#no_tlp').val() == ''){
            document.getElementById("no_tlp").focus();
    
            Lobibox.notify('warning', {
                size: 'mini',
                icon: false,
                sound: false,
                msg: 'No hp / wa tidak boleh kosong !!!'
            });
    
            $('#btn-daftar').prop('disabled',false);
            return false;
        }

                 var formData    =new FormData($('#form-daftar')[0]);
                 var base_url           = '<?php echo site_url(); ?>';
                 $.ajax({
                  url     : base_url + "register",
                  type    : "POST",
                  data    : formData,
                  success   : function(data){
                    var datas = $.parseJSON(data);
                    console.log(data);
                    if(datas.status == 2 ){
                         Lobibox.notify('success', {
                            size: 'mini',
                            icon: false,
                            sound: false,
                            msg: datas.pesan
                        });
                      window.location.href = "admin";
                      return false;
                    }else{  
                      alert("Username atau password salah!");         
                     
                      return false;
                      
                    }
                  },
                  error: function(response) {
                    alert('Terjadi kesalahan saat proses!')            
                    
                    return false;
                  }
                }); 
       
    });
</script>

</body>

</html>