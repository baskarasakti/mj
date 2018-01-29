<!-- Sidebar -->
  <aside class="sidebar sidebar-icons-right sidebar-icons-boxed sidebar-expand-lg">
    <header class="sidebar-header">
      <span class="logo">
        <h3 style="color: #fff">Sistem Presensi ITS</h3>
      </span>
    </header>

    <nav class="sidebar-navigation">
      <div class="sidebar-profile">
        <!-- <span class="no-caret" ><img class="img-thumbnail" src="" alt="..."></span> -->
        <h1 style="color: #fff;">Megahjaya</h1>
      </div>
      <ul class="menu">
        <li class="menu-category">Administrator</li>

        <li class="menu-item">
          <a class="menu-link" href="<?= base_url()."welcome" ?>">
            <span class="icon fa fa-home"></span>
            <span class="title">Home</span>
          </a>
        </li>

        <!-- Begin Master Inventory -->
        <li class="menu-item">
          <a class="menu-link" href="#">
            <span class="icon fa fa-folder-open"></span>
            <span class="title">Master Inventory</span>
            <span class="arrow"></span>
          </a>

          <ul class="menu-submenu">
            <li class="menu-item">
              <a class="menu-link" href="<?= base_url() ?>inventory">
                <span class="dot"></span>
                <span class="title">Bahan</span>
              </a>
            </li>
            <li class="menu-item">
              <a class="menu-link" href="<?= base_url() ?>product">
                <span class="dot"></span>
                <span class="title">Produk</span>
              </a>
            </li>
          </ul>
        </li>
        <!-- End Master Inventory -->

        <!-- Begin Master Production -->
        <li class="menu-item">
          <a class="menu-link" href="#">
            <span class="icon fa fa-folder-open"></span>
            <span class="title">Master Production</span>
            <span class="arrow"></span>
          </a>

          <ul class="menu-submenu">
            <li class="menu-item">
              <a class="menu-link" href="<?= base_url() ?>production">
                <span class="dot"></span>
                <span class="title">Project</span>
              </a>
            </li>
            <li class="menu-item">
              <a class="menu-link" href="<?= base_url() ?>proses">
                <span class="dot"></span>
                <span class="title">Proses</span>
              </a>
            </li>
          </ul>
        </li>
        <!-- End Master Production -->

        <!-- Begin Master Purchasing -->
        <li class="menu-item">
          <a class="menu-link" href="#">
            <span class="icon fa fa-folder-open"></span>
            <span class="title">Master Purchasing</span>
            <span class="arrow"></span>
          </a>

          <ul class="menu-submenu">
            <li class="menu-item">
              <a class="menu-link" href="<?= base_url() ?>purchase">
                <span class="dot"></span>
                <span class="title">Purchase</span>
              </a>
            </li>
            <li class="menu-item">
              <a class="menu-link" href="<?= base_url() ?>vendor">
                <span class="dot"></span>
                <span class="title">Vendor</span>
              </a>
            </li>
          </ul>
        </li>
        <!-- End Master Purchasing -->

        <!-- Begin Master Sales -->
        <li class="menu-item">
          <a class="menu-link" href="#">
            <span class="icon fa fa-folder-open"></span>
            <span class="title">Master Sales</span>
            <span class="arrow"></span>
          </a>

          <ul class="menu-submenu">
            <li class="menu-item">
              <a class="menu-link" href="<?= base_url() ?>sales">
                <span class="dot"></span>
                <span class="title">Sales</span>
              </a>
            </li>
            <li class="menu-item">
              <a class="menu-link" href="<?= base_url() ?>customer">
                <span class="dot"></span>
                <span class="title">Customer</span>
              </a>
            </li>
          </ul>
        </li>
        <!-- End Master Sales -->

      </ul>
    </nav>

  </aside>
  <!-- END Sidebar -->


  <!-- Topbar -->
  <header class="topbar">
    <div class="topbar-left">
      <span class="topbar-btn sidebar-toggler"><i>&#9776;</i></span>
      <a class="topbar-btn d-none d-md-block" href="#" data-provide="fullscreen tooltip" title="Fullscreen">
        <i class="material-icons fullscreen-default">fullscreen</i>
        <i class="material-icons fullscreen-active">fullscreen_exit</i>
      </a>
      <div class="topbar-divider"></div>
      <h3 class="d-none d-md-block">Modul Administrator </h3>
    </div>

    <div class="topbar-right">
      <ul class="topbar-btns">
        <div class="topbar-divider"></div>

        <!-- Profile -->
        <li class="dropdown">
          <span class="topbar-btn has-new" data-toggle="dropdown">Admin <img class="avatar" src="../assets/img/avatar/1.jpg" alt="..."></span>
          <div class="dropdown-menu dropdown-menu-right">
            <!-- <a class="dropdown-item" href="../page/profile"><i class="ti-user"></i> Profile</a>
            <a class="dropdown-item" href="../page-app/mailbox">
              <div class="flexbox">
                <i class="ti-email"></i>
                <span class="flex-grow">Inbox</span>
                <span class="badge badge-pill badge-info">5</span>
              </div>
            </a>
            <a class="dropdown-item" href="#"><i class="ti-settings"></i> Settings</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="../page-extra/user-lock-1"><i class="ti-lock"></i> Lock</a> -->
            <a class="dropdown-item" href="<?= base_url()."user/logout" ?>"><i class="ti-power-off"></i> Logout</a>
          </div>
        </li>
        <!-- END Profile -->


      </ul>

    </div>
  </header>
  <!-- END Topbar -->