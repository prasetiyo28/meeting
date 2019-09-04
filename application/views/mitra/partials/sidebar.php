<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

  <!-- Sidebar - Brand -->
  <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
    <div class="sidebar-brand-icon rotate-n-15">
      <i class="fas fa-laugh-wink"></i>
    </div>
    <div class="sidebar-brand-text mx-3">Mitra</div>
  </a>

  <!-- Divider -->
  <hr class="sidebar-divider my-0">

  <!-- Nav Item - Dashboard -->
  <li class="nav-item active">
    <a class="nav-link" href="index.html">
      <i class="fas fa-fw fa-tachometer-alt"></i>
      <span>Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">




    <!-- Nav Item - Charts -->
    <li class="nav-item">
      <a class="nav-link" href="<?php echo base_url() ?>mitra/booking">
        <i class="fas fa-fw fa-chart-area"></i>
        <span>Booking Masuk <?php if ($jml_booking > 0) { ?>
          <span class="badge badge-danger"><?php echo $jml_booking ?></span>
          <?php } ?> </span>
        </a>
      </li>

      <!-- Nav Item - Tables -->
      <li class="nav-item">
        <a class="nav-link" href="<?php echo base_url() ?>Mitra/dataruang">
          <i class="fas fa-fw fa-table"></i>
          <span>Ruang Meeting</span>
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link" href="<?php echo base_url() ?>Mitra/datamakanan_minuman">
          <i class="fas fa-fw fa-utensils"></i>
          <span>Makanan dan Minuman</span>
        </a>
      </li>
      <!-- <li class="nav-item">
        <a class="nav-link" href="<?php echo base_url() ?>Mitra/profil">
          <i class="fas fa-fw fa-tools"></i>
          <span>Profil</span>
        </a>
      </li> -->






      <!-- Divider -->
      <hr class="sidebar-divider d-none d-md-block">

      <!-- Sidebar Toggler (Sidebar) -->
      <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
      </div>

    </ul>