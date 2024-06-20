<?php 
// ======================================================================================================================================//
//                                                    HALAMAN UTAMA TOKO KURNIA                                                          //
// ======================================================================================================================================//

session_start();

// CEK apakah User Sudah Login 
if (!isset($_SESSION['login'])) {
    header("location:../index.php");
    exit;
}

if ($_SESSION['opsi'] !== 'pemilik') {
    header("location:../front/index.php");
    exit;
}

$akses = $_SESSION["opsi"];
 ?>
<!DOCTYPE html>
<html lang="en">

<!-- BAGIAN HEAD -->
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Admin Panel <?php if(isset($_GET["pages"])){ echo " - " . $_GET["pages"] ;}?></title>
    <!-- <link rel="shortcut icon"  href="../assets/img/image_1.png"> -->

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
</head>
<!--  END HEAD-->

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar-->
        <ul class="navbar-nav bg-dark sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - ICON DAN JUDUL -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php?pages=home">
                <div class="sidebar-brand-icon">
                    <img src="../assets/img/image_1.png" width="50">
                </div>
                <div class="sidebar-brand-text mx-3" style="font-size: 12px;">ADMIN PANEL</div>
            </a>

            <!-- Divider / Garis -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Home -->
            <li class="nav-item">
                <a class="nav-link" href="index.php?pages=home">
                    <i class="fas fa-home"></i>
                    <span>Home</span></a>
            </li>

            <!-- Divider / Garis -->
            <hr class="sidebar-divider">

                <!-- Nav Item - Data Produk-->
                 <li class="nav-item">
                    <a class="nav-link" href="index.php?pages=product">
                        <i class="fas fa-fw fa-box"></i>
                        <span>Data Produk</span></a>
                </li>

                 <!-- Divider / Garis -->
                <hr class="sidebar-divider my-0">
                
                <!-- Nav Item - Data Produk-->
                 <li class="nav-item">
                    <a class="nav-link" href="index.php?pages=pesanan">
                        <i class="fas fa-fw fa-tasks"></i>
                        <span>Data Pesanan</span></a>
                </li>

                 <!-- Divider / Garis -->
                 <hr class="sidebar-divider">
                
                 <!-- Nav Item - Data Produk-->
                 <li class="nav-item">
                    <a class="nav-link" href="index.php?pages=riwayat_pesanan">
                        <i class="fas fa-fw fa-scroll"></i>
                        <span>Riwayat Pesanan</span></a>
                </li>

                 <!-- Divider / Garis -->
                <hr class="sidebar-divider">

                 <li class="nav-item">
                    <a class="nav-link" href="index.php?pages=konsumen">
                        <i class="fas fa-fw fa-users"></i>
                        <span>Data Konsumen</span></a>
                </li>

                 <!-- Divider / Garis -->
                <hr class="sidebar-divider">

                <!-- Nav Item - Data User-->
                <li class="nav-item">
                    <a class="nav-link" href="index.php?pages=pemilik">
                        <i class="fas fa-fw fa-user"></i>
                        <span>Managemen Pemilik</span></a>
                </li>

                 <!-- Divider / Garis-->
                <hr class="sidebar-divider my-0">

            <!-- Nav Item - Report Laporan -->
            <li class="nav-item">
                <a class="nav-link" href="index.php?pages=laporan">
                    <i class="fas fa-fw fa-table"></i>
                    <span>Report Laporan</span></a>
            </li>




            <!-- Divider / Garis -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand bg-info navbar-dark topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-light d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                  

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                       
                        <!-- Nav Item - Name User -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-user fa-lg fa-fw"></i>
                                <span class="mr-2 d-none d-lg-inline small text-light text-uppercase" style="font-size: 18px;"><?php echo $_SESSION['username']; ?></span>
                                
                            </a>
                            <!-- Dropdown - Tomblo Logout -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                               
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div id="box-wrapper" class="container-fluid">

                    <!-- Costum Menu Redirect With GET PHP TO PAGES -->
                    <?php 
                        if (isset($_GET['pages'])) {
                            $page = $_GET['pages'];
                            switch ($page) {
                                // CASE Menu Produk
                                case "product":
                                   
                                    include "product/v_product.php"; 
                                    break;

                                case "pesanan":
                                   
                                    include "pesanan/v_pesanan.php"; 
                                    break;

                                case "riwayat_pesanan":
                                   
                                    include "pesanan/riwayat_pesanan.php"; 
                                    break;

                                // CASE Menu User
                                case 'pemilik':
                                
                                    include "pemilik/v_pemilik.php";
                                    break;

                                case 'konsumen':
                                
                                    include "konsumen/v_konsumen.php";
                                    break;

                                // CASE Menu Report Laporan
                                case 'laporan':
                                    include "laporan/laporan.php";
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
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-info text-light">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; 2022</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Permintaan Logout Sistem</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Apakah anda yakin akan logout dari sistem?</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-warning" href="../logout.php">Logout</a>
                </div>
            </div>
        </div>
    </div>

    
<!-- Modal -->
<div class="modal fade" id="modal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

        <!-- Bagian header -->
        <div class="modal-header">
            <h4 class="modal-title" id="judul"></h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>

        <!-- Bagian body -->
        <div class="modal-body">
            <div id="tampil_data">

            </div>  
        </div>
        <!-- Bagian footer -->
        <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div>

        </div>
    </div>
</div>

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
