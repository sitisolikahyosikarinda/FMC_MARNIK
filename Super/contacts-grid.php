<?php include 'layouts/session.php'; ?>
<?php include 'layouts/head.php'; ?>
<?php include 'layouts/head-style.php'; ?>
<?php include 'layouts/body.php'; ?>

<!-- Begin page -->
<div id="layout-wrapper">
    <?php include 'layouts/menu.php'; ?>
    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">
                <!-- start page title -->
                <?php
                    $maintitle = "Contacts";
                    $title = 'Daftar Admin';
                ?>
                <?php include 'layouts/breadcrumb.php'; ?>

                <p> Silahkan hubungi kontak dibawah untuk melakukan pengaduan</p>
                <!-- end page title -->

                <div class="row">
                    <!-- Kartu pertama -->
                    <div class="col-xl-3 col-sm-6">
                        <div class="card">
                            <div class="card-body text-center">
                                <div>
                                    <img src="../Admin/assets/images/tyty.jpg" alt="" class="avatar-md rounded-circle img-thumbnail">
                                </div>
                                <div>
                                    <h5 class="font-size-16 mb-1"><a href="#" class="text-dark">Aristy</a></h5>
                                    <p class="text-muted mb-0">Admin</p>
                                </div>
                                <p class="mt-3 text-muted">Curabitur non magna lobortis est tempus gravida ornare libero sed diam sed fringilla est.</p>
                                <div class="mt-3">
                                    <a href="https://api.whatsapp.com/send?phone=6283153451196" target="_blank" class="btn btn-soft-danger btn-sm text-truncate mx-auto d-block"><i class="bx bxl-whatsapp me-1"></i> Contact</a>
                                </div>
                            </div>
                        </div>
                        <!-- end card -->
                    </div>
                    <!-- Kartu kedua -->
                    <div class="col-xl-3 col-sm-6">
                        <div class="card">
                            <div class="card-body text-center">
                                <div>
                                    <img src="../Admin/assets/images/vey.jpg" alt="" class="avatar-md rounded-circle img-thumbnail">
                                </div>
                                <div>
                                    <h5 class="font-size-16 mb-1"><a href="#" class="text-dark">Frren</a></h5>
                                    <p class="text-muted mb-0">Admin</p>
                                </div>
                                <p class="mt-3 text-muted">Curabitur non magna lobortis est tempus gravida ornare libero sed diam sed fringilla est.</p>
                                <div class="mt-3">
                                    <a href="https://api.whatsapp.com/send?phone=6283153451196" target="_blank" class="btn btn-soft-danger btn-sm text-truncate mx-auto d-block"><i class="bx bxl-whatsapp me-1"></i> Contact</a>
                                </div>
                            </div>
                        </div>
                        <!-- end card -->
                    </div>
                    <!-- Kartu ketiga -->
                    <div class="col-xl-3 col-sm-6">
                        <div class="card">
                            <div class="card-body text-center">
                                <div>
                                    <img src="../Admin/assets/images/cesa.jpg" alt="" class="avatar-md rounded-circle img-thumbnail">
                                </div>
                                <div>
                                    <h5 class="font-size-16 mb-1"><a href="#" class="text-dark">Cesa</a></h5>
                                    <p class="text-muted mb-0">Admin</p>
                                </div>
                                <p class="mt-3 text-muted">Curabitur non magna lobortis est tempus gravida ornare libero sed diam sed fringilla est.</p>
                                <div class="mt-3">
                                    <a href="https://api.whatsapp.com/send?phone=6283153451196" target="_blank" class="btn btn-soft-danger btn-sm text-truncate mx-auto d-block"><i class="bx bxl-whatsapp me-1"></i> Contact</a>
                                </div>
                            </div>
                        </div>
                        <!-- end card -->
                    </div>
                    <!-- Kartu keempat -->
                    <div class="col-xl-3 col-sm-6">
                        <div class="card">
                            <div class="card-body text-center">
                                <div>
                                    <img src="../Admin/assets/images/yosi.jpg" alt="" class="avatar-md rounded-circle img-thumbnail">
                                </div>
                                <div>
                                    <h5 class="font-size-16 mb-1"><a href="#" class="text-dark">Karin</a></h5>
                                    <p class="text-muted mb-0">Admin</p>
                                </div>
                                <p class="mt-3 text-muted">Curabitur non magna lobortis est tempus gravida ornare libero sed diam sed fringilla est.</p>
                                <div class="mt-3">
                                    <a href="https://api.whatsapp.com/send?phone=6283153451196" target="_blank" class="btn btn-soft-danger btn-sm text-truncate mx-auto d-block"><i class="bx bxl-whatsapp me-1"></i> Contact</a>
                                </div>
                            </div>
                        </div>
                        <!-- end card -->
                    </div>
                </div>
            </div> <!-- container-fluid -->
        </div> <!-- End Page-content -->
        <?php include 'layouts/footer.php'; ?>
    </div> <!-- end main content-->
</div> <!-- END layout-wrapper -->
<?php include 'layouts/right-sidebar.php'; ?>
<?php include 'layouts/vendor-scripts.php'; ?>
<script src="assets/js/app.js"></script>
</body>
</html>
