 <!-- Navbar -->
  <nav class="main-header navbar navbar-expand bg-primary navbar-dark">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <li class="nav-item">
        <button type="button" id="btn-logout" class="btn btn-sm btn-danger">Logout</button>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <script type="text/javascript">
    $("#btn-logout").click(function(){
      window.location.href = "<?php echo base_url('Auth/logout'); ?>";
    });
  </script>