
<?php
    $navbar = [];
?>

<head>

    <title><?php echo isset($navbar["Contacts"]) ? $navbar["Contacts"] : "Contacts"; ?> | FMC - Dashboard</title>

        <?php include 'layouts/head.php'; ?>

        <?php include 'layouts/head-style.php'; ?>

    </head>

    <?php include 'layouts/body.php'; ?>

        <!-- Begin page -->
        <div id="layout-wrapper">

            <?php include 'layouts/menu.php'; ?>

            <!-- ============================================================== -->
            <!-- Start right Content here -->
            <!-- ============================================================== -->
            <div class="main-content">

                <div class="page-content">
                    <div class="container-fluid">

                        <!-- start page title -->
                        <?php
                            $maintitle = "Admin";
                            $title = 'Contacts';
                        ?>
                        <?php include 'layouts/breadcrumb.php'; ?>
                        <!-- end page title -->

                        <div class="row">
                            <div class="col-xl-3 col-sm-6">
                                <div class="card" style="border-radius:1rem; box-shadow: 2px 2px 2px #B4B4B8;">
                                    <div class="card-body">
                                        <div class="d-flex align-items-center">
                                            <div>
                                                <img src="assets/images/tyty.jpg" alt="" class="avatar-md rounded-circle img-thumbnail">
                                            </div>
                                            <div class="flex-1 ms-3">
                                                <h5 class="font-size-16 mb-1"><a href="#" class="text-dark">Aristy</a></h5>
                                                <p class="text-muted mb-0">Super Admin</p>
                                            </div>
                                        </div>
                                        <p class="mt-3 text-muted">Memantau aktivitas keseluruhan, baik kapal maupun karyawan dan kebutuhan lainnya. hubungi jika keperluan rumit</p>
                                    
                                        <div class="pt-1">
                                            <a href="https://api.whatsapp.com/send?phone=6281234567890" target="_blank" class="btn btn-sm text-truncate" style="background-color: #C40C0C; color:white; border-radius:1rem; justify-content:center; "><i class="bx bxl-whatsapp me-1"></i>Contact</a>
                                        </div>
                                    </div>
                                </div>
                                <!-- end card -->
                            </div>
                            <!-- end col -->
                            <div class="col-xl-3 col-sm-6">
                                <div class="card" style="border-radius:1rem; box-shadow: 2px 2px 2px #B4B4B8;">
                                    <div class="card-body">
                                        <div class="d-flex align-items-center">
                                            <div>
                                                <img src="../assets/images/farren.jpg" alt="" class="avatar-md rounded-circle img-thumbnail">
                                            </div>
                                            <div class="flex-1 ms-3">
                                                <h5 class="font-size-16 mb-1"><a href="#" class="text-dark">Farren</a></h5>
                                                <p class="text-muted mb-0">Admin</p>
                                            </div>
                                        </div>
                                        <p class="mt-3 text-muted">Mengatur jadwal pemberangkatan kapal dan tujuan kapal, Silahkan hubungi contac dibawah untuk melakukan pengaduan. </p>
                                    
                                        <div class="pt-1">
                                            <a href="https://api.whatsapp.com/send?phone=6281234567890" target="_blank" class="btn btn-sm text-truncate" style="background-color: #C40C0C; color:white; border-radius:1rem; justify-content:center;"><i class="bx bxl-whatsapp me-1"></i>Contact</a>
                                        </div>
                                    </div>
                                </div>
                                <!-- end card -->
                            </div>
                            <!-- end col -->
                            <div class="col-xl-3 col-sm-6">
                                <div class="card" style="border-radius:1rem; box-shadow: 2px 2px 2px #B4B4B8;">
                                    <div class="card-body">
                                        <div class="d-flex align-items-center">
                                            <div>
                                                <img src="assets/images/cesa.jpg" alt="" class="avatar-md rounded-circle img-thumbnail">
                                            </div>
                                            <div class="flex-1 ms-3">
                                                <h5 class="font-size-16 mb-1"><a href="#" class="text-dark">Cesa</a></h5>
                                                <p class="text-muted mb-0">Admin</p>
                                            </div>
                                        </div>
                                        <p class="mt-3 text-muted">Mengatur pengeluaran dan pemasukkan bahan bakar kapal. Silahkan hubungi contac dibawah untuk melakukan pengaduan</p>
                                    
                                        <div class="pt-1">
                                            <a href="https://api.whatsapp.com/send?phone=6281234567890" target="_blank" class="btn btn-sm text-truncate" style="background-color: #C40C0C; color:white; border-radius:1rem; justify-content:center;"><i class="bx bxl-whatsapp me-1"></i>Contact</a>
                                        </div>
                                    </div>
                                </div>
                                <!-- end card -->
                            </div>
                            <!-- end col -->
                            <div class="col-xl-3 col-sm-6">
                                <div class="card" style="border-radius:1rem; box-shadow: 2px 2px 2px #B4B4B8;">
                                    <div class="card-body">
                                        <div class="d-flex align-items-center">
                                            <div>
                                                <img src="../assets/images/karin.jpg" alt="" class="avatar-md rounded-circle img-thumbnail">
                                            </div>
                                            <div class="flex-1 ms-3">
                                                <h5 class="font-size-16 mb-1"><a href="#" class="text-dark">Karin</a></h5>
                                                <p class="text-muted mb-0">Admin</p>
                                            </div>
                                        </div>
                                        <p class="mt-3 text-muted">Mengatur waktu keberangkatan dan memantau estimasi kapal sampai. silahkan hubungi contac dibawah untuk pengaduan.</p>
                                    
                                        <div class="pt-1">
                                            <a href="https://api.whatsapp.com/send?phone=6281234567890" target="_blank" class="btn btn-sm text-truncate" style="background-color: #C40C0C; color:white; border-radius:1rem; justify-content:center;"><i class="bx bxl-whatsapp me-1"></i>Contact</a>
                                        </div>
                                    </div>
                                </div>
                                <!-- end card -->
                            </div>
                            <!-- end col -->                           
                        </div>
                        <!-- end row -->
                    </div> <!-- container-fluid -->
                </div>
                <!-- End Page-content -->
                
                <?php include 'layouts/footer.php'; ?>
            </div>
            <!-- end main con
            tent-->

            <?php include 'layouts/vendor-scripts.php'; ?>
        </div>
        <!-- END layout-wrapper -->


        <script src="assets/js/app.js"></script>
    </body>
</html>
