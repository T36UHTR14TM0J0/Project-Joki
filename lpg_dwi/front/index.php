<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="shortcut icon"  href="../assets/img/image_1.png">

    <!-- Custom fonts for this template-->
    <link href="../assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="../assets/css/sb-admin-2.min.css" rel="stylesheet">

    <!-- Custom styles for this page -->
    <link href="../assets/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <!-- Bootstrap core JavaScript-->
    <script src="../assets/vendor/jquery/jquery.min.js"></script>
    <link rel="stylesheet" type="text/css" href="../assets/vendor/lobibox/css/lobibox.min.css">
    <script src="../assets/vendor/jquery/jquery.mask.min.js"></script>
    <link rel="stylesheet" type="text/css" href="../assets/vendor/lobibox/css/lobibox.min.css">
    <link href="../assets/vendor/select2/css/select2.min.css" rel="stylesheet" />
    <script src="../assets/vendor/select2/js/select2.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.18/js/bootstrap-select.min.js" integrity="sha512-yDlE7vpGDP7o2eftkCiPZ+yuUyEcaBwoJoIhdXv71KZWugFqEphIS3PU60lEkFaz8RxaVsMpSvQxMBaKVwA5xg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.18/css/bootstrap-select.min.css" integrity="sha512-ARJR74swou2y0Q2V9k0GbzQ/5vJ2RBSoCWokg4zkfM29Fb3vZEQyv0iWBMW/yvKgyHSR/7D64pFMmU8nYmbRkg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <title>HOME</title>

    <style type="text/css">
      .nav-link{
        color: yellow !important;
        font-size: 18px;
        text-transform: uppercase;
      }

      .nav-link:hover{
        color: white !important;
      }

      .text-footer{
        color: yellow !important;
      }
      body{
        margin: 0px;
        padding: 0px;
      }
    </style>
  </head>
  <body>
    <div id="navbar">
      <nav class="navbar navbar-expand-lg navbar-dark bg-info fixed-top">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
          <div class="navbar-nav ml-auto">
              <a class="nav-item nav-link active" href="index.php?pages=home">Home <span class="sr-only">(current)</span></a>
              <a class="nav-item nav-link" href="index.php?pages=form_pesan">Pesan Produk</a>
              <a class="nav-item nav-link" href="index.php?pages=status_pesanan">Status Pesanan</a>
              <a class="nav-item nav-link" href="index.php?pages=riwayat_pesanan">Riwayat Pesanan</a>
              <a class="nav-item nav-link" href="../logout.php">Logout</a>
          </div>
        </div>
      </nav>
    </div>
    <div class="jumbotron jumbotron-fluid bg-light">
        <!-- Costum Menu Redirect With GET PHP TO PAGES -->
                    <?php 
                        if (isset($_GET['pages'])) {
                            $page = $_GET['pages'];
                            switch ($page) {
                                // CASE Menu Produk
                                case "form_pesan":
                                    include "form_pesan.php"; 
                                    break;

                                // CASE Menu User
                                case 'status_pesanan':
                                
                                    include "status_pesanan.php";
                                    break;

                                // CASE Menu Report Laporan
                                case 'riwayat_pesanan':
                                    include "riwayat_pesanan.php";
                                    break;
                                // Case Menu Home
                                case 'home':
                                    include "home.php";
                                    break;
                                
                                default:
                                    echo "HALAMAN TIDAK DITEMUKAN";
                                    break;
                            }
                        }else{
                            include "home.php";
                        }
                     ?>

    </div>
    <!-- Footer -->
    <footer class="sticky-footer bg-info text-light fixed-bottom">
      <div class="container my-auto">
        <div class="copyright text-center my-auto text-footer">
          <span>Copyright &copy; 2022</span>
        </div>
      </div>
    </footer>
   
    <!-- Bootstrap core JavaScript-->
    <script src="../assets/vendor/jquery/jquery.min.js"></script>
    <script src="../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="../assets/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="../assets/js/sb-admin-2.min.js"></script>
      <script src="../assets/js/jquery.mask.min.js"></script>

       <!-- Page level plugins -->
    <script src="../assets/vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="../assets/vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="../assets/js/demo/datatables-demo.js"></script>
    <script src="../assets/vendor/lobibox/js/lobibox.js"></script>

    <!-- SCRIPT JAVASCRIPT & JQUERY -->
  <script type="text/javascript">
      
      $(document).ready(function(){

        // ALERT SUCCESS DAN GAGAL
        <?php if(isset($_GET["notif_success"])) { ?>

                        Lobibox.notify('success', {
                        size: 'mini',
                        icon: true,
                        sound: false,
                        msg: '<?php echo $_GET["notif_success"]; ?>'
                    });
        <?php } ?>

        <?php if(isset($_GET["notif_gagal"])) { ?>

                        Lobibox.notify('error', {
                        size: 'mini',
                        icon: true,
                        sound: false,
                        msg: '<?php echo $_GET["notif_gagal"]; ?>'
                    });
        <?php } ?>
      });

      // FUNGSI CONVERT ANGKA KE RUPIAH
    function convertToRupiah(angka)
  {
    var rupiah = '';    
    var angkarev = angka.toString().split('').reverse().join('');
    for(var i = 0; i < angkarev.length; i++) if(i%3 == 0) rupiah += angkarev.substr(i,3)+'.';
    return rupiah.split('',rupiah.length-1).reverse().join('');
  }
  /**
   * Usage example:
   * alert(convertToRupiah(10000000)); -> "Rp. 10.000.000"
   */
   
   // CONVERT RUPIAH KE ANGKA
  function convertToAngka(rupiah)
  {
    return parseInt(rupiah.replace(/,.*|[^0-9]/g, ''), 10);
  }
  </script> 

  </body>
</html>