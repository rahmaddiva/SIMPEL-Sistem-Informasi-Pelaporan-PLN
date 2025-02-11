<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="dashboard">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">SIMPEL <sup>tm</sup></div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <a class="nav-link" href="dashboard">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Main Menu
    </div>

    <?php if (session()->get('hak') == 'admin'): ?>
        <!-- Nav Item - Pages Collapse Menu -->
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true"
                aria-controls="collapseTwo">
                <i class="fas fa-fw fa-cog"></i>
                <span>Data Master</span>
            </a>
            <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Data Master</h6>
                    <a class="collapse-item" href="/gardu_induk">Gardu Induk</a>
                    <a class="collapse-item" href="/pegawai">Pegawai</a>
                    <a class="collapse-item" href="/perangkat">Perangkat</a>
                </div>
            </div>
        </li>
    <?php endif; ?>

    <!-- Nav Item - Utilities Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
            aria-expanded="true" aria-controls="collapseUtilities">
            <i class="fas fa-fw fa-wrench"></i>
            <span>Kelola Data Pengajuan</span>
        </a>
        <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header"></h6>
                <a class="collapse-item" href="/keluhan">Data Keluhan</a>
                <a class="collapse-item" href="/gangguan">Data Gangguan</a>
            </div>
        </div>
    </li>

    <?php if (session()->get('hak') == 'admin'): ?>
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#Monitoring" aria-expanded="true"
                aria-controls="Monitoring">
                <i class="fas fa-fw fa-wrench"></i>
                <span>Data Monitoring</span>
            </a>
            <div id="Monitoring" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header"></h6>
                    <a class="collapse-item" href="/monitoring_keluhan">Monitoring Keluhan</a>
                    <a class="collapse-item" href="/monitoring_gangguan">Monitoring Pengajuan</a>
                </div>
            </div>
        </li>
    <?php endif; ?>
    <!-- Divider -->
    <hr class="sidebar-divider">
    <?php if (session()->get('hak') == 'admin'): ?>

        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#DataKeluar" aria-expanded="true"
                aria-controls="DataKeluar">
                <i class="fas fa-fw fa-wrench"></i>
                <span>Data Keluar</span>
            </a>
            <div id="DataKeluar" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <a class="collapse-item" href="/data_keluar_keluhan">Data Keluar Keluhan</a>
                    <a class="collapse-item" href="/data_keluar_gangguan">Data Keluar Gangguan</a>
                </div>
            </div>
        </li>




        <!-- Divider -->
        <hr class="sidebar-divider">

        <!-- Heading -->
        <div class="sidebar-heading">
            Kelola Data
        </div>

        <!-- Nav Item - Charts -->
        <li class="nav-item">
            <a class="nav-link" href="/user">
                <i class="fas fa-fw fa-users"></i>
                <span>Data User</span></a>
        </li>
    <?php endif; ?>

    <!-- Heading -->
    <div class="sidebar-heading">
        Logout
    </div>

    <li class="nav-item">
        <a class="nav-link" href="/">
            <i class="fas fa-fw fa-sign-out-alt"></i>
            <span>Logout</span></a>
    </li>


</ul>
<!-- End of Sidebar -->