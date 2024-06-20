 <!-- Sidebar -->
<ul class="navbar-nav bg-gradient-info sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
    <div class="sidebar-brand-icon rounded-circle">
        <img class="logo-brand rounded-circle" width="50" height="50" src="<?php echo base_url('assets/images/logo-ulfi.png'); ?>">
    </div>
    <div class="sidebar-brand-text mx-3">Bidan Ulfi</div>
        </a>

        
        <!-- Divider -->
        <hr class="sidebar-divider my-0">

       <!-- Nav Item - Dashboard -->
        <li class="nav-item">
            <a class="nav-link" href="<?php echo base_url('welcome'); ?>">
            <span>Beranda</span></a>
        </li>

        <hr class="sidebar-divider">
        <li class="nav-item">
            <a class="nav-link" href="<?php echo base_url("Registrasi"); ?>">
            <span>Registrasi</span></a>
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider">
        <!-- Nav Item - Pages Collapse Menu -->
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseone"
                    aria-expanded="true" aria-controls="collapseone">
            <span>Data Utama</span>
            </a>
            <div id="collapseone" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">

                <?php if ($this->session->userdata("level") == 0 || $this->session->userdata("level") == 1): ?>
                    <a class="collapse-item" href="<?php echo base_url("obat"); ?>">
                    <span>Stok Obat</span></a>

                <?php endif ?>
                    <?php if ($this->session->userdata("level") == 0): ?>
                        
                        <a class="collapse-item" href="<?php echo base_url("Pasien"); ?>">
                        <span>Data Pasien</span></a>
                        
                        
                    <?php endif ?>
                    <?php if($this->session->userdata("level") == 0 || $this->session->userdata("level") == 2) : ?>
                    <a class="collapse-item  dropdown dropdown-toggle" href="#" data-toggle="dropdown">
                        <span>Pemeriksaan</span></a>
                    <ul class="dropdown-menu">
                        <li>
                            <a class="dropdown-item" href="<?php echo base_url("pel_umum"); ?>">
                             <span>Pemeriksaan Umum</span></a>
                        </li>
                         <li>
                            <a class="dropdown-item" href="<?php echo base_url("pel_bumil"); ?>">
                            <span>Pemeriksaan Ibu Hamil</span></a>
                        </li>
                         <li>
                            <a class="dropdown-item" href="<?php echo base_url("pel_kb"); ?>">
                            <span>Pemeriksaan Kb</span></a>
                        </li>
                         <li>
                            <a class="dropdown-item" href="<?php echo base_url("pel_bayi"); ?>">
                            <span>Pemeriksaan Bayi</span></a>
                        </li>
                        
                    </ul>
                    <?php endif; ?>
                   
                </div>
            </div>
        </li>     

     
            <!-- Divider -->
            <hr class="sidebar-divider">
            <li class="nav-item">
                <a class="nav-link" href="<?php echo base_url("resep_obat"); ?>">
                <span>Resep Obat</span></a>
                    
            </li>

            <hr class="sidebar-divider">
                <li class="nav-item">
                     <a class="nav-link" href="<?php echo base_url("transaksi"); ?>">
                        <span>Transaksi</span></a>
                </li>
            </hr>


            

            <?php if ($this->session->userdata("level") == 0): ?>
            
            <hr class="sidebar-divider">

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTri"
                    aria-expanded="true" aria-controls="collapseTri">
                    <span>Laporan</span>
                </a>
                <div id="collapseTri" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                     <a class="collapse-item" href="<?php echo base_url("Laporan_transaksi"); ?>">
                    <span>Laporan Transaksi</span></a>
                         
                    <a class="collapse-item" href="<?php echo base_url("laporan_obat"); ?>">
                    <span>Laporan Obat</span></a>

                    <a class="collapse-item" href="<?php echo base_url("laporan_pasien"); ?>">
                    <span>Laporan Pasien</span></a>

                    <a class="collapse-item" href="<?php echo base_url("laporan_pengguna"); ?>">
                    <span>Laporan Data Pengguna</span></a>
                    </div>
                </div>
            </li>
            <?php endif ?>

            <?php if ($this->session->userdata("level") == 0): ?>
             <!-- Divider -->
            <hr class="sidebar-divider">

            <li class="nav-item">
                <a class="nav-link" href="<?php echo base_url("user"); ?>">
                    <span>Data Pengguna</span></a>
            </li>
        <?php endif ?>



            <!-- Divider -->
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
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                       

                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><i class="fas fa-circle text-success fa-sm fa-fw mr-2"></i><?php echo $this->session->userdata("nama_lengkap");?></span>
                            </a>
                            <!-- Dropdown - User Information -->
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