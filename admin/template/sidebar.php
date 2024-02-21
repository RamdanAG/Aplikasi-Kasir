<!--sidebar start-->
<?php
$id = $_SESSION['admin']['id_member'];
$hasil_profil = $lihat->member_edit($id);
?>

<!-- Sidebar -->
<ul class="navbar-nav sidebar accordion" style="background:#242424" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fa fa-duotone fa-cubes fa-bounce" style="color:white;"></i>
        </div>
        <div class="sidebar-brand-text mx-2" style="background: rgb(2,0,36);
background: linear-gradient(151deg, rgba(2,0,36,1) 0%, rgba(88,56,194,1) 0%, rgba(0,151,255,1) 100%); color:white; padding-left:10px; padding-right:10px;">Dektoko<sup></sup></div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <a style="color:white" class="nav-link" href="index.php">
            <i style="color:white" class="fas fa-fw fa-tachometer-alt"></i>
            <span style="color:white;">Dashboard</span>
        </a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Nav Item Group 1 -->
    <div>
        <div class="sidebar-heading" style="color:white;"><i class="fas fa-dot-circle" style="color: #008744;"></i> Data Master</div>
        <li class="nav-item active" style="top:20; position:relative;">
            <a class="nav-link" href="index.php?page=barang">
                <i style="color:white" class="fas fa-fw fa-cogs"></i>
                <span style="color:white">Barang</span>
            </a>
        </li>

        <li class="nav-item active">
            <a class="nav-link" href="index.php?page=kategori">
                <i style="color:white" class="fas fa-fw fa-cogs"></i>
                <span style="color:white">Kategori</span>
            </a>
        </li>
    </div>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Nav Item Group 2 -->
    <div>
        <li class="nav-item active">
            <div class="sidebar-heading" style="color:white;"><i class="fas fa-dot-circle" style="color: #0057e7;"></i> Transaksi</div>
            <a class="nav-link" href="index.php?page=laporan">
                <i style="color:white" class="fas fa-fw fa-cogs"></i>
                <span style="color:white">Laporan Penjualan</span>
            </a>
        </li>

        <li class="nav-item active">
            <a class="nav-link" href="index.php?page=jual">
                <i style="color:white" class="fas fa-fw fa-cogs"></i>
                <span style="color:white">Transaksi Jual</span>
            </a>
        </li>
    </div>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Nav Item Group 3 -->
    <div>
        <div class="sidebar-heading" style="color:white;"><i class="fas fa-dot-circle" style="color: #d62d20;"></i> Setting</div>
        <li class="nav-item active">
            <a class="nav-link" href="index.php?page=pengaturan">
                <i style="color:white" class="fas fa-fw fa-cogs"></i>
                <span style="color:white">Pengaturan Toko</span>
            </a>
        </li>

        <?php if (!empty($_SESSION['admin']) && $_SESSION['admin']['status'] == '1') { ?>
            <li class="nav-item active">
                <a class="nav-link" href="register.php">
                    <i style="color:white" class="fas fa-fw fa-cogs"></i>
                    <span style="color:white">Register</span>
                </a>
            </li>
        <?php } ?>
    </div>


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
    <div id="content" style="background:#f6f6f6">

        <!-- Topbar -->
        <nav class="navbar navbar-expand topbar mb-4 static-top" style="background:#f6f6f6">

            <!-- Sidebar Toggle (Topbar) -->
            <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                <i class="fa fa-bars"></i>
            </button>
            <h5 class="d-lg-block d-none mt-2" style="color: #2a2b47;"><b><?php echo $toko['nama_toko']; ?>, <?php echo $toko['alamat_toko']; ?></b></h5>
            <!-- Topbar Navbar -->
            <ul class="navbar-nav ml-auto">
                <!-- <div class="topbar-divider d-none d-sm-block"></div> -->
                <!-- Topbar Search -->
                <!-- Nav Item - User Information -->
                <li class="nav-item dropdown no-arrow">
                    <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <img class="img-profile rounded-circle" src="assets/img/user/<?php echo $hasil_profil['gambar']; ?>">
                        <span class="mr-2 d-none d-lg-inline text-gray-600 small ml-2"><?php echo $hasil_profil['nm_member']; ?></span>
                        <i class="fas fa-angle-down"></i>
                    </a>
                    <!-- Dropdown - User Information -->
                    <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                        <a class="dropdown-item" href="index.php?page=user">
                            <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                            Profile
                        </a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="logout.php">
                            <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                            Logout
                        </a>
                    </div>
                </li>
            </ul>
        </nav>
        <!-- End of Topbar -->
        <!-- Begin Page Content -->
        <div class="container-fluid">