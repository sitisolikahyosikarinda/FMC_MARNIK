
<?php
    $navbar = [];
?>

<head>

    <title><?php echo isset($navbar["Tables"]) ? $navbar["Tables"] : "Tables"; ?> | FMC - Dashboard</title>

    <?php include '../User/layouts/head.php'; ?>

    <?php include '../User/layouts/head-style.php'; ?>

    </head>

    <?php include '../User/layouts/body.php'; ?>

        <!-- Begin page -->
        <div id="layout-wrapper">

            <?php include '../User/layouts/menu.php'; ?>

            <!-- ============================================================== -->
            <!-- Start right Content here -->
            <!-- ============================================================== -->
            <div class="main-content">

                <div class="page-content">
                    <div class="container-fluid">

                         <!-- start page title -->
                         <?php
                            $maintitle = "Analisis";
                            $title = 'Tabel';
                        ?>
                        <?php include '../User/layouts/breadcrumb.php'; ?>
                        <!-- end page title -->

                        <!-- tabel 1 -->
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card" style="border-radius:1rem; box-shadow: 2px 2px 2px #B4B4B8;">
                                    <div class="card-header">
                                        <h4 class="card-title mb-3" style="font-size: 1.5rem;">Data Aktivitas Kapal FMC Marnaik</h4>
                                        <p>Tabel ini menunjukkan detail aktivitas kapal FMC Marnaik, mencakup tanggal mulainya aktivitas kapal, lokasi awal perjalanan kapal, waktu mulai dan selesai mesin, durasi mesin utama beroperasi dalam menit, 
                                        jumlah konsumsi bahan bakar hari itu, volume bahan bakar di dalam tangki sebelum perjalanan dimulai, volume bahan bakar di dalam tangki setelah perjalanan selesai, dan sisa stok bahan bakar di dalam tangki setelah perjalanan selesai.</p>
                                    </div><!-- end card header -->
                                    <div class="card-body">
                                        <div class="grid-container">
                                            <form action='tables.php'method="POST">
                                                <input type='text' value='' name='qcari1'>
                                                <input type='submit' value='cari'
                                                ><a href='tables.php' style="margin-left: 1rem;">Tampilkan Semua</a>
                                            </form>
                                            <div class="table-container">
                                                <?php
                                                require_once "../config.php";

                                                $sql = "SELECT * FROM tb_dataset";

                                                if(isset($_POST['qcari1'])){
                                                    $qcari = $_POST['qcari1'];
                                                    // Pastikan format tanggal sesuai dengan format yang Anda gunakan di database
                                                    // Di sini saya asumsikan format tanggal adalah 'YYYY-MM-DD'
                                                    $sql .= " WHERE Date LIKE '%$qcari%' OR `From` LIKE '%$qcari%' OR `To` LIKE '%$qcari%'";
                                                }

                                                $sql .= " ORDER BY Date DESC"; // Menambahkan pengurutan pada query SQL

                                                $result = mysqli_query($conn, $sql);

                                                if (!$result) {
                                                    // Query execution failed
                                                    die("Query failed: " . mysqli_error($conn));
                                                }

                                                if (mysqli_num_rows($result) > 0) {
                                                    echo '<table id="data-table">';
                                                    echo '<tr class="table-tr">';
                                                    echo '<th class="table-th">Date</th>';
                                                    echo '<th>From</th>';
                                                    echo '<th>To</th>';
                                                    echo '<th>Start ME</th>';
                                                    echo '<th>Stop ME</th>';
                                                    echo '<th>Running Minutes</th>';
                                                    echo '<th>Fuel Daily Consumption</th>';
                                                    echo '<th>Opening Fuel Tank Sounding</th>';
                                                    echo '<th>Closing Fuel Tank Sounding</th>';
                                                    echo '<th>Fuel Tank Stock After</th>';
                                                    echo '</tr>';

                                                    while($row = mysqli_fetch_assoc($result)) {
                                                        echo "<tr>";
                                                        echo "<td class='table-td'>" . $row["Date"] . "</td>";
                                                        echo "<td class='table-td'>" . $row["From"] . "</td>";
                                                        echo "<td class='table-td'>" . $row["To"] . "</td>";
                                                        echo "<td class='table-td'>" . $row["Start_ME"] . "</td>";
                                                        echo "<td class='table-td'>" . $row["Stop_ME"] . "</td>";
                                                        echo "<td class='table-td'>" . $row["Running_Minutes"] . "</td>";
                                                        echo "<td class='table-td'>" . $row["Fuel_Daily_Consumption"] . "</td>";
                                                        echo "<td class='table-td'>" . $row["Opening_Fuel_Tank_Sounding"] . "</td>";
                                                        echo "<td class='table-td'>" . $row["Closing_Fuel_Tank_Sounding"] . "</td>";
                                                        echo "<td class='table-td'>" . $row["Fuel_Tank_Stock_After"] . "</td>";
                                                        echo "</tr>";
                                                    }

                                                    echo '</table>';

                                    
                                                } else {
                                                    echo "Tidak ada data yang ditemukan.";
                                                }

                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- end card body -->
                                </div>
                                <!-- end card -->
                            </div>
                            <!-- end col -->
                        </div>
                        <!-- end tabel 1 -->

                        <!-- tabel 2 -->
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card" style="border-radius:1rem; box-shadow: 2px 2px 2px #B4B4B8;">
                                    <div class="card-header">
                                        <h4 class="card-title mb-3" style="font-size: 1.5rem;">Monitoring Stok Bahan Bakar</h4>
                                        <p>Tabel ini mencatat data monitoring stok bahan bakar, termasuk volume tangki bahan bakar pada awal dan akhir perjalanan, serta sisa stok bahan bakar di dalam tangki setelah perjalanan selesai.</p>
                                    </div><!-- end card header -->
                                    <div class="card-body">
                                        <div class="grid-container">
                                            <form action='tables.php'method="POST">
                                                <input type='text' value='' name='qcari2'>
                                                <input type='submit' value='cari'
                                                ><a href='tables.php' style="margin-left: 1rem;">Tampilkan Semua</a>
                                            </form>
                                            <div class="table-container">
                                                <?php
                                                require_once "../config.php";

                                                $sql = "SELECT Date, Opening_Fuel_Tank_Sounding, Closing_Fuel_Tank_Sounding, Fuel_Tank_Stock_After FROM tb_dataset ";

                                                if(isset($_POST['qcari2'])){
                                                    $qcari = $_POST['qcari2'];
                                                    // Pastikan format tanggal sesuai dengan format yang Anda gunakan di database
                                                    // Di sini saya asumsikan format tanggal adalah 'YYYY-MM-DD'
                                                    $sql .= " WHERE Date LIKE '%$qcari%' OR `From` LIKE '%$qcari%' OR `To` LIKE '%$qcari%'";
                                                }

                                                $sql .= " ORDER BY Date DESC"; // Menambahkan pengurutan pada query SQL

                                                $result = mysqli_query($conn, $sql);

                                                if (!$result) {
                                                    // Query execution failed
                                                    die("Query failed: " . mysqli_error($conn));
                                                }


                                                if (mysqli_num_rows($result) > 0) {
                                                    echo '<table id="data-table">';
                                                    echo '<thead>';
                                                    echo '<tr class="table-tr">';
                                                    echo '<th data-column>Date</th>';
                                                    echo '<th data-column>Opening Fuel Tank Sounding</th>';
                                                    echo '<th data-column>Closing Fuel Tank Sounding</th>';
                                                    echo '<th data-column>Fuel Tank Stock After</th>';
                                                    echo '</tr>';
                                                    echo '</thead>';
                                                    echo '<tbody>';

                                                    while($row = mysqli_fetch_assoc($result)) {
                                                        echo "<tr>";
                                                        echo "<td class='table-td'>" . $row["Date"] . "</td>";
                                                        echo "<td class='table-td'>" . $row["Opening_Fuel_Tank_Sounding"] . "</td>";
                                                        echo "<td class='table-td'>" . $row["Closing_Fuel_Tank_Sounding"] . "</td>";
                                                        echo "<td class='table-td'>" . $row["Fuel_Tank_Stock_After"] . "</td>";
                                                        echo "</tr>";
                                                    }

                                                    echo '</tbody>';
                                                    echo '</table>';
                                                } else {
                                                    echo "Tidak ada data yang ditemukan.";
                                                }

                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- end card body -->
                                </div>
                                <!-- end card -->
                            </div>
                            <!-- end col -->
                        </div>
                        <!-- end tabel 2 -->

                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card"style="border-radius:1rem; box-shadow: 2px 2px 2px #B4B4B8;">
                                    <div class="card-header">
                                        <h4 class="card-title mb-4" style="font-size: 1.5rem;">Aktivitas Mesin Utama</h4>
                                        <p>Tabel ini berisi aktivitas mesin utama, yang dimana mencatat lokasi awal dan akhir perjalanan kapal, waktu mulai dan berhenti mesin utama, beserta total menit mesin utama beroperasi</p>
                                    </div><!-- end card header -->
                                    <div class="card-body">
                                    <div class="grid-container">
                                            <form action='tables.php'method="POST">
                                                <input type='text' value='' name='qcari3'>
                                                <input type='submit' value='cari'
                                                ><a href='tables.php' style="margin-left: 1rem;">Tampilkan Semua</a>
                                            </form>
                                            <div class="table-container">
                                                <?php
                                                require_once "../config.php";

                                                $sql = "SELECT Date, `From`, `To`, Start_ME, Stop_ME, Running_Minutes FROM tb_dataset";

                                                if(isset($_POST['qcari3'])){
                                                    $qcari = $_POST['qcari3'];
                                                    // Pastikan format tanggal sesuai dengan format yang Anda gunakan di database
                                                    // Di sini saya asumsikan format tanggal adalah 'YYYY-MM-DD'
                                                    $sql .= " WHERE Date LIKE '%$qcari%' OR `From` LIKE '%$qcari%' OR `To` LIKE '%$qcari%'";
                                                }

                                                $sql .= " ORDER BY Date DESC"; // Menambahkan pengurutan pada query SQL

                                                $result = mysqli_query($conn, $sql);

                                                if (!$result) {
                                                    // Query execution failed
                                                    die("Query failed: " . mysqli_error($conn));
                                                }

                                                if (mysqli_num_rows($result) > 0) {
                                                    echo '<table id="data-table">';
                                                    echo '<tr class="table-tr">';
                                                    echo '<th class="table-th">Date</th>';
                                                    echo '<th>From</th>';
                                                    echo '<th>To</th>';
                                                    echo '<th>Start ME</th>';
                                                    echo '<th>Stop ME</th>';
                                                    echo '<th>Running Minutes</th>';
                                                    echo '</tr>';

                                                    while($row = mysqli_fetch_assoc($result)) {
                                                        echo "<tr>";
                                                        echo "<td class='table-td'>" . $row["Date"] . "</td>";
                                                        echo "<td class='table-td'>" . $row["From"] . "</td>";
                                                        echo "<td class='table-td'>" . $row["To"] . "</td>";
                                                        echo "<td class='table-td'>" . $row["Start_ME"] . "</td>";
                                                        echo "<td class='table-td'>" . $row["Stop_ME"] . "</td>";
                                                        echo "<td class='table-td'>" . $row["Running_Minutes"] . "</td>";
                                                        echo "</tr>";
                                                    }

                                                    echo '</table>';

                                    
                                                } else {
                                                    echo "Tidak ada data yang ditemukan.";
                                                }

                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- end card body -->
                                </div>
                                <!-- end card -->
                            </div>
                            <!-- end col -->
                        </div>
                        <!-- end row -->

                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card" style="border-radius:1rem; box-shadow: 2px 2px 2px #B4B4B8;">
                                    <div class="card-header">
                                        <h4 class="card-title mb-3" style="font-size: 1.5rem;">Pemantauan Pemakaian Bahan Bakar</h4>
                                        <p>Tabel ini digunakan untuk memantau pemakaian bahan bakar harian dan stok bahan bakar setelah penggunaan.</p>
                                    </div><!-- end card header -->
                                    <div class="card-body">
                                        <div class="grid-container">
                                            <form action='tables.php'method="POST">
                                                <input type='text' value='' name='qcari4'>
                                                <input type='submit' value='cari'
                                                ><a href='tables.php' style="margin-left: 1rem;">Tampilkan Semua</a>
                                            </form>
                                            <div class="table-container">
                                                <?php
                                                require_once "../config.php";
                                                
                                                $sql = "SELECT Date, Fuel_Tank_Stock_After, Fuel_Daily_Consumption FROM tb_dataset";

                                                if(isset($_POST['qcari4'])){
                                                    $qcari = $_POST['qcari4'];
                                                    // Pastikan format tanggal sesuai dengan format yang Anda gunakan di database
                                                    // Di sini saya asumsikan format tanggal adalah 'YYYY-MM-DD'
                                                    $sql .= " WHERE Date LIKE '%$qcari%'";
                                                }
                                                
                                                $sql .= " ORDER BY Date DESC"; // Menambahkan pengurutan pada query SQL
                                                
                                                $result = mysqli_query($conn, $sql);
                                                
                                                if (!$result) {
                                                    // Query execution failed
                                                    die("Query failed: " . mysqli_error($conn));
                                                }

                                                if (mysqli_num_rows($result) > 0) {
                                                    echo '<table id="data-table">';
                                                    echo '<tr class="table-tr">';
                                                    echo '<th class="table-th">Date</th>';
                                                    echo '<th>Fuel Daily Consumption</th>';
                                                    echo '<th>Fuel Tank Stock After</th>';
                                                    echo '</tr>';

                                                    while($row = mysqli_fetch_assoc($result)) {
                                                        echo "<tr>";
                                                        echo "<td class='table-td'>" . $row["Date"] . "</td>";
                                                        echo "<td class='table-td'>" . $row["Fuel_Daily_Consumption"] . "</td>";
                                                        echo "<td class='table-td'>" . $row["Fuel_Tank_Stock_After"] . "</td>";
                                                        echo "</tr>";
                                                    }

                                                    echo '</table>';

                                    
                                                } else {
                                                    echo "Tidak ada data yang ditemukan.";
                                                }

                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- end card body -->
                                </div>
                                <!-- end card -->
                            </div>
                            <!-- end col -->
                        </div>
                        <!-- end row -->

                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card" style="border-radius:1rem; box-shadow: 2px 2px 2px #B4B4B8;">
                                    <div class="card-header">
                                        <h4 class="card-title mb-3" style="font-size: 1.5rem;">Analisis Efisiensi Mesin</h4>
                                        <p>Tabel ini menyajikan data yang digunakan untuk menganalisis efisiensi penggunaan mesin berdasarkan durasi mesin utama beroperasi dalam menit dan konsumsi bahanbakar harian kapal.</p>
                                    </div><!-- end card header -->
                                    <div class="card-body">
                                        <div class="grid-container">
                                            <form action='tables.php'method="POST">
                                                <input type='text' value='' name='qcari5'>
                                                <input type='submit' value='cari'
                                                ><a href='tables.php' style="margin-left: 1rem;">Tampilkan Semua</a>
                                            </form>
                                            <div class="table-container">
                                                <?php
                                                require_once "../config.php";
                                                
                                                $sql = "SELECT Date, Running_Minutes, Fuel_Daily_Consumption FROM tb_dataset";

                                                if(isset($_POST['qcari5'])){
                                                    $qcari = $_POST['qcari5'];
                                                    // Pastikan format tanggal sesuai dengan format yang Anda gunakan di database
                                                    // Di sini saya asumsikan format tanggal adalah 'YYYY-MM-DD'
                                                    $sql .= " WHERE Date LIKE '%$qcari%'";
                                                }
                                                
                                                $sql .= " ORDER BY Date DESC"; // Menambahkan pengurutan pada query SQL
                                                
                                                $result = mysqli_query($conn, $sql);
                                                
                                                if (!$result) {
                                                    // Query execution failed
                                                    die("Query failed: " . mysqli_error($conn));
                                                }

                                                if (mysqli_num_rows($result) > 0) {
                                                    echo '<table id="data-table">';
                                                    echo '<tr class="table-tr">';
                                                    echo '<th class="table-th">Date</th>';
                                                    echo '<th>Running Minutes</th>';
                                                    echo '<th>Fuel Daily Consumption</th>';
                                                    echo '</tr>';

                                                    while($row = mysqli_fetch_assoc($result)) {
                                                        echo "<tr>";
                                                        echo "<td class='table-td'>" . $row["Date"] . "</td>";
                                                        echo "<td class='table-td'>" . $row["Running_Minutes"] . "</td>";
                                                        echo "<td class='table-td'>" . $row["Fuel_Daily_Consumption"] . "</td>";
                                                        echo "</tr>";
                                                    }

                                                    echo '</table>';
                                                } else {
                                                    echo "Tidak ada data yang ditemukan.";
                                                }

                                                ?>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- end card body -->
                                </div>
                                <!-- end card -->
                            </div>
                            <!-- end col -->
                        </div>
                        <!-- end row -->

                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card" style="border-radius:1rem; box-shadow: 2px 2px 2px #B4B4B8;">
                                    <div class="card-header">
                                        <h4 class="card-title mb-3" style="font-size: 1.5rem;">Riwayat Perjalanan Kapal Terakhir</h4>
                                        <p>Tabel ini berisi riwayat perjalanan terakhir kapal, yang berisi tanggal, lokasi awal dan akhir perjalanan kapal dan penggunaan bahan bakar harian kapal</p>
                                    </div><!-- end card header -->
                                    <div class="card-body">
                                        <div class="grid-container">
                                            <form action='tables.php'method="POST">
                                                <input type='text' value='' name='qcari6'>
                                                <input type='submit' value='cari'
                                                ><a href='tables.php' style="margin-left: 1rem;">Tampilkan Semua</a>
                                            </form>
                                            <div class="table-container"">
                                            <?php
                                                require_once "../config.php";
                                                $sql = "SELECT * FROM tb_dataset ORDER BY Date DESC";
                                                if(isset($_POST['qcari6'])){
                                                    $qcari = $_POST['qcari6'];
                                                    $sql = "SELECT * FROM tb_dataset 
                                                            WHERE `From` LIKE '%$qcari%'
                                                            OR `To` LIKE '%$qcari%' 
                                                            OR Fuel_Daily_Consumption LIKE '%$qcari%'  ";
                                                }
                                                

                                                  $result = mysqli_query($conn, $sql);

                                                  if (!$result) {
                                                      // Query execution failed
                                                      die("Query failed: " . mysqli_error($conn));
                                                  }

                                                if (mysqli_num_rows($result) > 0) {
                                                    echo '<table id="data-table" style="max-height: 393px; overflow-y: auto;"">';
                                                    echo '<tr class="table-tr">';
                                                    echo '<th class="table-th">Date</th>';
                                                    echo '<th>From</th>';
                                                    echo '<th>To</th>';
                                                    echo '<th>Fuel Daily Consumption</th>';
                                                    echo '</tr>';

                                                    while($row = mysqli_fetch_assoc($result)) {
                                                        echo "<tr>";
                                                        echo "<td class='table-td'>" . $row["Date"] . "</td>";
                                                        echo "<td class='table-td'>" . $row["From"] . "</td>";
                                                        echo "<td class='table-td'>" . $row["To"] . "</td>";
                                                        echo "<td class='table-td'>" . $row["Fuel_Daily_Consumption"] . "</td>";
                                                        echo "</tr>";
                                                    }

                                                    echo '</table>';

                                    
                                                } else {
                                                    echo "Tidak ada data yang ditemukan.";
                                                }

                                                mysqli_close($conn); 
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- end card body -->
                                </div>
                                <!-- end card -->
                            </div>
                            <!-- end col -->
                        </div>
                        <!-- end row -->

                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card" style="border-radius:1rem; box-shadow: 2px 2px 2px #B4B4B8;">
                                    <div class="card-header">
                                        <h4 class="card-title mb-3" style="font-size: 1.5rem;">Persentase Tempat Tujuan Kapal</h4>
                                        <p>Tabel ini berisi persentase dari seberapa sering kapal mengunjungi tempat tujuan kapal tersebut</p>
                                    </div>
                                    <div class="card-body">
                                        <div class="table-responsive px-3" data-simplebar style="max-height: 393px;">
                                            <?php
                                            include "../config.php";

                                            $limit = 4; // Jumlah baris data yang akan ditampilkan

                                            $sql = "SELECT `To` AS Tujuan, COUNT(`To`) AS Jumlah, (COUNT(`To`) / (SELECT COUNT(*) FROM tb_dataset)) * 100 AS Persentase FROM tb_dataset GROUP BY `To`";
                                            $result = mysqli_query($conn, $sql);

                                            if (mysqli_num_rows($result) > 0) {
                                                echo '<table id="data-table" style="border: 1px solid #000;"">';
                                                echo '<tr class="table-tr">';
                                                echo '<th class="table-th">Tujuan</th>';
                                                echo '<th>Persentase</th>';
                                                echo '</tr>';

                                                while($row = mysqli_fetch_assoc($result)) {
                                                    echo "<tr>";
                                                    echo "<td class='table-td'>" . $row["Tujuan"] . "</td>";
                                                    echo "<td class='table-td'>" . $row["Persentase"] . "</td>";
                                                    echo "</tr>";
                                                }

                                                echo '</table>';

                                
                                            } else {
                                                echo "Tidak ada data yang ditemukan.";
                                            }

                                            mysqli_close($conn);
                                            ?>
                                        </div>
                                    </div>
                                    <!-- end card body -->
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
            <!-- end main content-->

        </div>
        <!-- END layout-wrapper -->

        <?php include 'layouts/vendor-scripts.php'; ?>

        <script>
            $(document).ready(function() {
                $('#data-table').DataTable({
                    "order": [] // Menonaktifkan pengurutan default
                });
                
                // Menambahkan panah sortir
                $('#data-table thead th.sortable').each(function() {
                    $(this).append('<span class="sorting"></span>');
                });

                $('#data-table').on('click', 'th.sortable', function() {
                    var column = $(this).index();
                    var order = $('#data-table').DataTable().order()[0][1];
                    $('#data-table thead th span').removeClass('sorting-up sorting-down');

                    if (order === 'asc') {
                        $(this).find('span').addClass('sorting-down');
                    } else {
                        $(this).find('span').addClass('sorting-up');
                    }
                });
            });
        </script>
        <script>
        function selectDestination(destination) {
            document.getElementById('selectedDestination').innerText = destination;
            window.location.href = 'tables.php?destination=' + destination;
        }
        </script>
        <script src="assets/js/app.js"></script>
        <script src="assets/js/bootstrap/bootstrap.min.js"></script>
        <script src="assets/js/bootstrap/bootstrap.js"></script>
        <script src="assets/js/pages/dashboard.init.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <script src="assets/js/app.js"></script>
        <script src="assets/js/jquery-3.7.1.min.js"></script>
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.6/dist/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.2.1/dist/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>

    </body>
</html>
