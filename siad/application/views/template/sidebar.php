
  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-light elevation-4">
    <!-- Brand Logo -->
    <a href="<?php echo base_url('Dashboard'); ?>" class="brand-link">
      <img src="<?php echo base_url('assets/') ?>img/logo-sekolah.png" alt="Logo" class="brand-image img-circle elevation-1 bg-light" style="opacity: .8">
      <span class="brand-text font-weight-light" >SIAD PAKAR</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar text-light">
      <!-- Sidebar user (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="info m-auto">
          <h3 class="text-light"><i class="fas fa-user text-light"></i>&nbsp;&nbsp;<?php echo $this->session->userdata('username'); ?></h3>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item">
            <a href="<?php echo base_url('Dashboard'); ?>" class="nav-link">
              <p>
                DASHBOARD
              </p>
            </a>
          
          </li>
         
          <li class="nav-item">
            <a href="#" class="nav-link">
              <p>
                MASTER DATA
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">

              <li class="nav-item">
                <a href="<?php echo base_url("C_siswa"); ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>SISWA</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="<?php echo base_url("C_kelas"); ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>KELAS</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="<?php echo base_url("C_jenis_pembayaran"); ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>JENIS PEMBAYARAN</p>
                </a>
              </li>
              
            </ul>
          </li>
          <li class="nav-item">
            <a href="<?php echo base_url('C_Pembayaran'); ?>" class="nav-link">
              <p>
                PEMBAYARAN
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="<?php echo base_url('C_laporan'); ?>" class="nav-link">
              <p>
                LAPORAN
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="<?php echo base_url('C_user'); ?>" class="nav-link">
              <p>
                MANAGEMENT USER
              </p>
            </a>
          </li>
           
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
