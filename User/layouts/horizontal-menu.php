<?php include('notif.php'); ?>

<?php
    $navbar = [];
?>

<header id="page-topbar" class="ishorizontal-topbar">
    <div class="navbar-header">
        <div class="d-flex">
            <!-- LOGO -->
            <div class="navbar-brand-box">
                <a href="index.php" class="logo logo-dark">
                    <span class="logo-sm">
                        <img src="assets/images/logo-mobile.png" alt="" height="22">
                    </span>
                    <span class="logo-lg">
                        <img src="assets/images/logo-mobile.png" alt="" height="22"> <span class="logo-txt">Dashboard</span>
                    </span>
                </a>

                <a href="index.php" class="logo logo-light">
                    <span class="logo-sm">
                        <img src="assets/images/logo-mobile.png" alt="" height="22">
                    </span>
                    <span class="logo-lg">
                        <img src="assets/images/logo-mobile.png" alt="" height="22"> <span class="logo-txt">Dashboard</span>
                    </span>
                </a>
            </div>

            <button type="button" class="btn btn-sm px-3 font-size-16 d-lg-none header-item" data-bs-toggle="collapse" data-bs-target="#topnav-menu-content">
                <i class="fa fa-fw fa-bars"></i>
            </button>

            <div class="topnav">
                <nav class="navbar navbar-light navbar-expand-lg topnav-menu">

                    <div class="collapse navbar-collapse" id="topnav-menu-content">
                        <ul class="navbar-nav">
                            <li class="nav-item">
                                <a class="nav-link arrow-none" href="index.php" id="topnav-dashboard" role="button" aria-haspopup="true" aria-expanded="false">
                                    <i class='bx bx-tachometer'></i>
                                    <span data-key="t-dashboards"><?php echo isset($navbar["Dashboard"]) ? $navbar["Dashboard"] : "Dashboard"; ?></span>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link arrow-none" href="tips-trick.php" id="topnav-dashboard" role="button" aria-haspopup="true" aria-expanded="false">
                                    <i class='bx bx-bulb'></i>
                                    <span data-key="t-dashboards"><?php echo isset($navbar["Tips_Trick"]) ? $navbar["Tips_Trick"] : "Tips & Trick"; ?></span>
                                </a>
                            </li>

                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle arrow-none" href="#" id="topnav-components" role="button"
                                >
                                    <i class='bx bx-line-chart' ></i>
                                    <span data-key="t-components"><?php echo isset($translations["Analisis"]) ? $navbar["Analisis"] : "Analisis"; ?></span>
                                </a>
                                <div class="dropdown-menu" aria-labelledby="topnav-components">
                                    <a href="tables.php" class="dropdown-item" data-key="t-advanced-tables"><?php echo isset($navbar["Tables"]) ? $navbar["Tables"] : "Tables"; ?></a>
                                    <a href="charts.php" class="dropdown-item" data-key="t-chartjs-charts"><?php echo isset($navbar["Charts"]) ? $navbar["Charts"] : "Charts"; ?></a>
                                </div>

                            </li>

                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle arrow-none" href="#" id="topnav-more" role="button">
                                <i class='bx bx-user'></i>
                                    <span data-key="t-pages"><?php echo isset($translations["Admin"]) ? $translations["Admin"] : "Admin"; ?></span>
                                </a>
                                <div class="dropdown-menu" aria-labelledby="topnav-more">
                                    <a href="admin-grid.php" class="dropdown-item" data-key="t-vertical"><?php echo isset($navbar["Contacts"]) ? $navbar["Contacts"] : "Contacts"; ?></a>
                                    <a href="../auth-login.php" class="dropdown-item" data-key="t-vertical"><?php echo isset($navbar["Login"]) ? $navbar["Login"] : "Login"; ?></a>
                                </div>
                            </li>

                        </ul>
                    </div>
                </nav>
            </div>
        </div>
        <div class="d-flex">
            <!-- Notification -->
            <div class="dropdown d-inline-block">
                <button type="button" class="btn header-item noti-icon" id="page-header-notifications-dropdown"
                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="icon-sm" data-feather="bell">3</i>
                </button>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0"
                    aria-labelledby="page-header-notifications-dropdown">
                    <div class="p-3">
                        <div class="row align-items-center">
                            <div class="col">
                                <h5 class="m-0 font-size-15"><?php echo isset($navbar["Notification"]) ? $navbar["Notification"] : "Notification"; ?> </h5>
                            </div>
                        </div>
                    </div>
                    <div data-simplebar style="max-height: 250px;">
                        <?php
                        // Panggil file config.php yang berisi koneksi ke database
                        include_once "../config.php";

                        // Query SQL untuk mengambil data notifikasi dari database
                        $sql = "SELECT * FROM notif ORDER BY date DESC LIMIT 5";
                        $result = $conn->query($sql);

                        // Periksa apakah terdapat notifikasi yang ditemukan
                        if ($result->num_rows > 0) {
                            // Loop through each row to display the notification
                            while($row = $result->fetch_assoc()) {
                                // Tampilkan data notifikasi dalam HTML
                                echo "<a href='' class='text-reset notification-item'>
                                        <div class='d-flex border-bottom align-items-start bg-light'>
                                            <div class='flex-shrink-0'>
                                            <i class='bx bxs-bell-ring' style='font-size:30px; margin-right:1rem; color:FCDC2A;'></i>
                                            </div>
                                            <div class='flex-grow-1'>
                                                <h6 class='mb-1'>Kapal FMC Marnaik</h6>
                                                <div class='text-muted'>
                                                    <p class='mb-1 font-size-13'>" . $row['Bahan_Bakar_Harian'] . "<span class='badge text-success bg-success-subtle'>New</span></p>
                                                    <p class='mb-0 font-size-10 text-uppercase fw-bold'><i class='mdi mdi-clock-outline'></i> " . $row['Date'] . "</p>
                                                </div>
                                            </div>
                                        </div>
                                    </a>";
                            }
                        } else {
                            // Jika tidak ada notifikasi yang ditemukan, tampilkan pesan kosong
                            echo "<p>No notifications found.</p>";
                        }
                        ?>
                    </div>
                </div>
            </div>


            <div class="dropdown d-none d-sm-inline-block">
                <button type="button" class="btn header-item light-dark" id="mode-setting-btn">
                    <i data-feather="moon" class="icon-sm layout-mode-dark "></i>
                    <i data-feather="sun" class="icon-sm layout-mode-light"></i>
                </button>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="../notif.js"></script>
</header>
