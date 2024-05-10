<?php
    $navbar = [];
?>
<!-- ========== Left Sidebar Start ========== -->
<div class="vertical-menu">

    <!-- LOGO -->
    <div class="navbar-brand-box">
        <a href="admin.php" class="logo logo-dark">
            <span class="logo-sm">
                <img src="assets/images/logo-mobile-sm.png" alt="" height="22"> 
            </span>
            <span class="logo-lg">
                <img src="assets/images/logo-mobile-sm.png" alt="" height="22"> <span class="logo-txt">Dashboard</span>
            </span>
        </a>

        <a href="admin.php" class="logo logo-light">
            <span class="logo-lg">
                <img src="assets/images/logo-mobile-sm.png" alt="" height="22"> <span class="logo-txt">Dashboard</span>
            </span>
            <span class="logo-sm">
                <img src="assets/images/logo-mobile-sm.png" alt="" height="22">
            </span>
        </a>
    </div>

    <button type="button" class="btn btn-sm px-3 font-size-16 header-item vertical-menu-btn">
        <i class="fa fa-fw fa-bars"></i>
    </button>

    <div data-simplebar class="sidebar-menu-scroll">

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <li>
                    <a href="admin.php" data-key="t-user-grid">
                        <i class='bx bxs-tachometer icon nav-icon'></i>
                        <span><?php echo isset($navbar["Dashboard"]) ? $navbar["Dashboard"] : "Dashboard"; ?></span>
                    </a>
                </li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow">
                        <i class="bx bxs-user-detail icon nav-icon"></i>
                        <span class="menu-item" data-key="t-contacts"><?php echo isset($navbar["Admin"]) ? $navbar["Admin"] : "Admin"; ?></span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="contacts-grid.php" data-key="t-user-grid"><?php echo isset($navbar["Contact-Admin"]) ? $navbar["Contact-Admin"] : "Contact Admin"; ?></a></li>
                        <li><a href="contacts-profile.php" data-key="t-user-settings"><?php echo isset($navbar["Profile"]) ? $navbar["Profile"] : "Profil"; ?></a></li>
                    </ul>
                </li>

                <li>
                    <a href="form-elements.php">
                        <i class="bx bxs-eraser icon nav-icon"></i>
                        <span class="menu-item" data-key="t-forms"><?php echo isset($navbar["Forms"]) ? $navbar["Forms"] : "Forms"; ?></span>
                    </a>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow">
                        <i class="bx bx-line-chart icon nav-icon"></i>
                        <span class="menu-item" data-key="t-contacts"><?php echo isset($navbar["Analisis"]) ? $navbar["Analisis"] : "Analisis"; ?></span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="charts.php" data-key="t-user-grid"><?php echo isset($navbar["Chart"]) ? $navbar["Chart"] : "Chart"; ?></a></li>
                        <li><a href="tables.php" data-key="t-user-list"><?php echo isset($navbar["Tables"]) ? $navbar["Tables"] : "Tables"; ?></a></li>
                    </ul>
                </li>
                </li>
            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>
<!-- Left Sidebar End -->