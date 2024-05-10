
<?php
    $navbar = [];
?>

<head>

    <title><?php echo isset($navbar["Dashboard"]) ? $navbar["Dashboard"] : "Dashboard"; ?> | FMC - Dashboard</title>

    <?php include 'layouts/head.php'; ?>

    <?php include 'layouts/head-style.php'; ?>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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
                $maintitle = "FMC";
                $title = 'Welcome !';
                ?>
                <?php include 'layouts/breadcrumb.php'; ?>
                <!-- end page title -->

                <div class="row">
                    <div class="col-xl-4">
                        <div class="card" style="background: linear-gradient( #C40C0C, #F57D1F); border-radius:1rem; box-shadow: 5px 5px 5px #B4B4B8; height: 320px;">
                            <div class="card-body">
                                <div class="text-center py-3">
                                    <ul class="bg-bubbles ps-0">
                                        <li><i class="bx bx-grid-alt font-size-24"></i></li>
                                        <li><i class="bx bx-tachometer font-size-24"></i></li>
                                        <li><i class="bx bx-store font-size-24"></i></li>
                                        <li><i class="bx bx-cube font-size-24"></i></li>
                                        <li><i class="bx bx-cylinder font-size-24"></i></li>
                                        <li><i class="bx bx-command font-size-24"></i></li>
                                        <li><i class="bx bx-hourglass font-size-24"></i></li>
                                        <li><i class="bx bx-pie-chart-alt font-size-24"></i></li>
                                        <li><i class="bx bx-coffee font-size-24"></i></li>
                                        <li><i class="bx bx-polygon font-size-24"></i></li>
                                    </ul>
                                    <div class="main-wid position-relative">
                                        <h3 class="text-white">Welcome to</h3>

                                        <h3 class="text-white mb-0"> FMC Marnaik Dashboard!</h3>

                                        <p class="text-white-50 px-4 mt-4">Tingkatkan efisiensi operasional dan optimalkan penggunaan bahan bakar pada kapal FMC Marnaik</p>

                                        <div class="mt-4 pt-2 mb-2">
                                            <a href="tips-trick.php" class="btn" style="background-color: black; color:white;">Tips & Trick <i class="mdi mdi-arrow-right ms-1"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                        <div class="col-xl-8">
                            <div class="row">
                                <div class="col-6 col-sm-6">
                                    <div class="card" style=" border-radius:1rem; box-shadow: 2px 2px 2px #B4B4B8; height:150px;" >
                                        <div class="card-body">
                                            <div class="d-flex align-items-center">
                                                <div class="avatar">
                                                    <span class="avatar-title bg-danger-subtle rounded">
                                                        <i class="mdi mdi-calendar-today font-size-26" style="color: #C40C0C;"></i>
                                                    </span>
                                                </div>
                                                <div class="d-flex flex-column justify-content-center"> <!-- Menggunakan flexbox -->
                                                    <p class="text-dark mb-2 mx-4 mt-2">Rata-rata Volume Bahan Bakar Sebelum Perjalanan</p>
                                                    <div>
                                                        <div class="py-1  mx-4">
                                                            <?php
                                                            include '../config.php';
                                                            $sql = "SELECT AVG(Opening_Fuel_Tank_Sounding) AS Average_Fuel_Volume FROM tb_dataset";
                                                            $result = $conn->query($sql);

                                                            if ($result->num_rows > 0) {
                                                                // Output data dari setiap baris hasil query
                                                                while($row = $result->fetch_assoc()) {
                                                                    // Mengambil dua angka di belakang koma dari rata-rata dan menampilkannya
                                                                    $average_fuel_volume = number_format($row["Average_Fuel_Volume"], 4);
                                                                    echo "<h4 class='mt-1 mb-0'> " . $average_fuel_volume . "</h4>";
                                                                }
                                                            } else {
                                                                echo "Tidak ada data.";
                                                            }
                                                            ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-6 col-sm-6">
                                    <div class="card" style=" border-radius:1rem; box-shadow: 2px 2px 2px #B4B4B8; height:150px;"">
                                        <div class="card-body">
                                            <div class="d-flex align-items-center">
                                                <div class="avatar">
                                                    <span class="avatar-title bg-warning-subtle rounded">
                                                        <i class="mdi mdi-fax  font-size-26" style="color: #FCDC2A;"></i>
                                                    </span>
                                                </div>
                                                <div class="d-flex flex-column justify-content-center"> <!-- Menggunakan flexbox -->
                                                    <p class="text-dark mb-2 mx-4 mt-2">Frekuensi Penggunaan Mesin Utama Kapal FMC Marnaik</p>
                                                    <div>
                                                        <div class="py-1  mx-4">
                                                        <?php
                                                        include '../config.php';
                                                        $sql = "SELECT AVG(SUBSTRING_INDEX(Running_Minutes, ':', 1) * 60 + SUBSTRING_INDEX(Running_Minutes, ':', -1)) AS Average_Running_Minutes FROM tb_dataset";
                                                        $result = $conn->query($sql);

                                                        if ($result->num_rows > 0) {
                                                            // Output data dari setiap baris hasil query
                                                            while($row = $result->fetch_assoc()) {
                                                                // Mengambil nilai rata-rata dalam menit
                                                                $average_running_minutes = $row["Average_Running_Minutes"];
                                                                // Menampilkan nilai rata-rata dengan format yang diinginkan (misalnya, 0:41)
                                                                $hours = floor($average_running_minutes / 60);
                                                                $minutes = $average_running_minutes % 60;
                                                                echo "<h4 class='mt-1 mb-0'>" . sprintf("%d:%02d", $hours, $minutes) . "</h4>";
                                                            }
                                                        } else {
                                                            echo "Tidak ada data.";
                                                        }
                                                        ?>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-6 col-sm-6">
                                    <div class="card" style="border-radius:1rem; box-shadow: 2px 2px 2px #B4B4B8; height:150px;">
                                        <div class="card-body">
                                            <div class="d-flex align-items-center">
                                                <div class="avatar">
                                                    <span class="avatar-title bg-danger-subtle rounded">
                                                        <i class="mdi mdi-flash font-size-26" style="color: #C40C0C;"></i>
                                                    </span>
                                                </div>
                                                <div class="d-flex flex-column justify-content-center"> <!-- Menggunakan flexbox -->
                                                    <p class="text-dark mb-2 mx-4 mt-2">Rata-rata Volume Bahan Bakar Setelah Perjalanan</p>
                                                    <div>
                                                        <div class="py-1  mx-4">
                                                            <?php
                                                            include '../config.php';
                                                            $sql = "SELECT AVG(Closing_Fuel_Tank_Sounding) AS Average_Fuel_Volume FROM tb_dataset";
                                                            $result = $conn->query($sql);

                                                            if ($result->num_rows > 0) {
                                                                // Output data dari setiap baris hasil query
                                                                while($row = $result->fetch_assoc()) {
                                                                    // Mengambil dua angka di belakang koma dari rata-rata dan menampilkannya
                                                                    $average_fuel_volume = number_format($row["Average_Fuel_Volume"], 4);
                                                                    echo "<h4 class='mt-1 mb-0'> " . $average_fuel_volume . "</h4>";
                                                                }
                                                            } else {
                                                                echo "Tidak ada data.";
                                                            }
                                                            ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <div class="col-6 col-sm-6">
                                    <div class="card" style=" border-radius:1rem; box-shadow: 2px 2px 2px #B4B4B8; height:150px;">
                                        <div class="card-body">
                                            <div class="d-flex align-items-center">
                                                <div class="avatar">
                                                    <span class="avatar-title bg-warning-subtle rounded">
                                                        <i class="mdi mdi-rowing  font-size-26" style="color: #FCDC2A;"></i>
                                                    </span>
                                                </div>
                                                <div class="d-flex flex-column justify-content-center"> <!-- Menggunakan flexbox -->
                                                    <p class="text-dark mb-2 mx-4 mt-2">Rata-rata Sisa Stok Bahan Bakar Kapal FMC Marnaik</p>
                                                    <div>
                                                        <div class="py-1  mx-4">
                                                            <?php
                                                            include '../config.php';
                                                            $sql = "SELECT AVG(Fuel_Tank_Stock_After) AS Average_Fuel_Volume FROM tb_dataset";
                                                            $result = $conn->query($sql);

                                                            if ($result->num_rows > 0) {
                                                                // Output data dari setiap baris hasil query
                                                                while($row = $result->fetch_assoc()) {
                                                                    // Mengambil dua angka di belakang koma dari rata-rata dan menampilkannya
                                                                    $average_fuel_volume = number_format($row["Average_Fuel_Volume"], 4);
                                                                    echo "<h4 class='mt-1 mb-0'> " . $average_fuel_volume . "</h4>";
                                                                }
                                                            } else {
                                                                echo "Tidak ada data.";
                                                            }
                                                            ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>


                <div class="row">
                    <div class="col-xl-8">
                        <div class="card" style=" border-radius:1rem; box-shadow: 2px 2px 2px #B4B4B8; height: 500px;">
                            <div class="card-body">
                                <div class="d-flex flex-wrap align-items-center mb-3">
                                    <h5 class="card-title mb-0">Penggunaan Bahan Bakar Harian</h5>
                                    <div class="ms-auto">
                                        <a href="tables.php">Lihat Semua</a>
                                    </div>
                                </div>

                                <div class="row align-items-center">
                                    <div class="col-xl-8">
                                        <div>
                                            <?php
                                            include '../config.php';

                                            // Query untuk mengambil data Fuel_Daily_Consumption dari tabel tb_dataset
                                            $sql = "SELECT Fuel_Daily_Consumption FROM tb_dataset";
                                            $result = mysqli_query($conn, $sql);

                                            // Inisialisasi array untuk menyimpan data
                                            $data = array();

                                            // Ambil data dari hasil query dan simpan ke dalam array
                                            if (mysqli_num_rows($result) > 0) {
                                                while($row = mysqli_fetch_assoc($result)) {
                                                    $data[] = $row['Fuel_Daily_Consumption'];
                                                }
                                            }

                                            $counts = array_count_values($data);
                                            ?>
                                            <canvas id="histogramChart" width="800" height="600"></canvas>
                                        </div>
                                    </div>
                                    <div class="col-xl-4">
                                        <div class="">
                                            <div>
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <div class="d-flex">
                                                        <i class="mdi mdi-circle font-size-10 mt-1" style="color: #FCDC2A;"></i>
                                                        <div class="flex-1 ms-2">
                                                            <p class="mb-0">Penggunaan Bahan Bakar Harian</p>
                                                            <h5 id="labels" class="mt-1 mb-0 font-size-16"></h5>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="col-xl-4">
                        <div class="card" style=" border-radius:1rem; box-shadow: 2px 2px 2px #B4B4B8; height: 500px;">
                            <div class="card-body">
                                <div class="d-flex flex-wrap align-items-center">
                                    <h5 class="card-title mb-0">Persentase Tempat Awal Kapal Berlayar</h5>
                                </div>

                                <div class="text-center mt-4">
                                    <?php
                                    // Include file konfigurasi database
                                    include '../config.php';
                                    
                                    // Query untuk mengambil data 'From' dari tabel 'tb_dataset'
                                    $sql = "SELECT `From` FROM tb_dataset";
                                    $result = mysqli_query($conn, $sql);
                                    // Inisialisasi array untuk menyimpan data 'From'
                                    $fromData = array();

                                    // Ambil data 'From' dari hasil query
                                    if (mysqli_num_rows($result) > 0) {
                                        while($row = mysqli_fetch_assoc($result)) {
                                            // Periksa apakah nilai 'From' adalah string atau integer sebelum dimasukkan ke dalam array
                                            if (is_string($row['From']) || is_int($row['From'])) {
                                                $fromData[] = $row['From'];
                                            }
                                        }
                                    }

                                    // Hitung frekuensi masing-masing nilai 'From' jika nilai-nilai dalam array adalah string atau integer
                                    if (!empty($fromData)) {
                                        $fromCounts = array_count_values($fromData);

                                        // Hitung total frekuensi dari semua nilai
                                        $totalFrequency = array_sum($fromCounts);

                                        // Hitung persentase frekuensi dari setiap nilai 'From' dan simpan dalam array
                                        $fromPercentages = array();
                                        foreach ($fromCounts as $value => $frequency) {
                                            $percentage = ($frequency / $totalFrequency) * 100;
                                            $fromPercentages[$value] = $percentage;
                                        }

                                        // Urutkan persentase berdasarkan abjad (Ascending)
                                        ksort($fromPercentages);

                                        // Convert array PHP menjadi array JavaScript
                                        $fromLabels = json_encode(array_keys($fromPercentages));
                                        $fromValues = json_encode(array_values($fromPercentages));
                                    } else {
                                        echo "Tidak ada data yang valid untuk dihitung frekuensinya.";
                                    }


                                    ?>
                                    <canvas id="donutChart" height="600" data-colors='["#C40C0C","#F57D1F", "#FCDC2A", "#B4B4B5", "#f1f3f4"]'></canvas>
                                </div>                  
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-xl-8">
                        <div class="row">
                            <div class="col-lg-5">
                                <div class="card" style=" border-radius:1rem; box-shadow: 2px 2px 2px #B4B4B8; height:460;">
                                    <div class="card-header" style=" border-radius:1rem;">
                                        <div class="d-flex flex-wrap align-items-center">
                                            <h5 class="card-title mb-0">Riwayat Perjalanan Terakhir Kapal</h5>
                                            <div class="ms-auto">
                                                <a href="tables.php">Lihat Semua</a>
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                    include '../config.php';

                                    // Query untuk mengambil beberapa data terbaru dari tabel 'tb_dataset'
                                    $sql = "SELECT `To`, `Date`, `Fuel_Tank_Stock_After` FROM tb_dataset ORDER BY `Date` DESC LIMIT 5"; // Limit 4 untuk mengambil 4 data terbaru
                                    $result = mysqli_query($conn, $sql);

                                    // Cek apakah query berhasil dieksekusi dan apakah hasilnya tidak kosong
                                    if ($result && mysqli_num_rows($result) > 0) {
                                        // Tampilkan data dalam bentuk daftar
                                        echo '<div class="card-body px-0">
                                                <ol class="activity-feed mb-0 px-4" data-simplebar style="max-height: 377px;">';
                                        while ($row = mysqli_fetch_assoc($result)) {
                                            // Ubah format tanggal dari "Date"
                                            $date = date('Y-m-d', strtotime($row['Date']));
                                            // Tampilkan nilai dari kolom 'Fuel_Tank_Stock_After'
                                            echo '<li class="feed-item">
                                                    <div class="d-flex justify-content-between feed-item-list">
                                                        <div>
                                                            <h5 class="font-size-15 mb-1">Menuju '.$row['To'].'</h5>
                                                            <p class="text-muted mt-0 mb-0">Sisa Bahan Bakar:  '.$row['Fuel_Tank_Stock_After'].'</p>
                                                        </div>
                                                        <div>
                                                            <p class="text-muted mb-0">'.$date.'</p>
                                                        </div>
                                                    </div>
                                                </li>';
                                        }
                                        echo '</ol></div>';
                                    } else {
                                        // Tampilkan pesan jika tidak ada data
                                        echo "Tidak ada data.";
                                    }
                                    ?>
                                </div>
                            </div>

                            <div class="col-lg-7">
                                <div class="card" style=" border-radius:1rem; box-shadow: 2px 2px 2px #B4B4B8; height:460;">
                                    <div class="card-header" style=" border-radius:1rem;">
                                        <div class="align-items-center d-flex">
                                            <h4 class="card-title mb-0 flex-grow-1">Monitoring Stok Bahan Bakar</h4>
                                            <div class="flex-shrink-0">
                                                <a href="tables.php">Lihat Semua</a>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="card-body px-0 pt-2">
                                        <div class="table-responsive px-3" data-simplebar style="max-height: 393px; " >
                                        <?php
                                        include '../config.php';

                                        $sql = "SELECT Date, Opening_Fuel_Tank_Sounding, Closing_Fuel_Tank_Sounding, Fuel_Tank_Stock_After FROM tb_dataset LIMIT 20";
                                        $result = mysqli_query($conn, $sql);

                                        if (mysqli_num_rows($result) > 0) {
                                            echo '<table style="border-collapse: collapse;">';
                                            echo '<tr style="border-bottom: 1px solid #B4B4B8;">';
                                            echo '<th style="border: 0px; font-size:13px; color:#3C3633; border-right: 1px solid #B4B4B8;">Date</th>';
                                            echo '<th style="border: 0px; font-size:13px; color:#3C3633; border-right: 1px solid #B4B4B8;">Opening Fuel Tank Sounding</th>';
                                            echo '<th style="border: 0px; font-size:13px; color:#3C3633; border-right: 1px solid #B4B4B8;">Closing Fuel Tank Sounding</th>';
                                            echo '<th style="border: 0px; font-size:13px; color:#3C3633;">Fuel Tank Stock After</th>';
                                            echo '</tr>';

                                            while ($row = mysqli_fetch_assoc($result)) {
                                                echo "<tr'>";
                                                echo "<td style='border: 0px; border-top: 1px solid #B4B4B8; border-right: 1px solid #B4B4B8;'>" . $row["Date"] . "</td>";
                                                echo "<td style='border: 0px; border-top: 1px solid #B4B4B8; border-right: 1px solid #B4B4B8;'>" . $row["Opening_Fuel_Tank_Sounding"] . "</td>";
                                                echo "<td style='border: 0px; border-top: 1px solid #B4B4B8; border-right: 1px solid #B4B4B8;'>" . $row["Closing_Fuel_Tank_Sounding"] . "</td>";
                                                echo "<td style='border: 0px; border-top: 1px solid #B4B4B8;'>" . $row["Fuel_Tank_Stock_After"] . "</td>";
                                                echo "</tr>";
                                            }

                                            echo '</table>';
                                        } else {
                                            echo "Tidak ada data yang ditemukan.";
                                        }

                                        mysqli_close($conn);
                                        ?>

                                        </div> <!-- enbd table-responsive-->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-xl-4">

                        <div class="card" style=" border-radius:1rem; box-shadow: 2px 2px 2px #B4B4B8;">
                            <div class="card-header" style=" border-radius:1rem;">
                                <div class="align-items-center d-flex">
                                    <h4 class="card-title mb-0 flex-grow-1">Persentase Tempat Tujuan Kapal</h4>
                                    <div class="flex-shrink-0">
                                        <a href="tables.php">Lihat Lainnya</a>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body pt-1">

                                <div class="table-responsive">
                                    <?php
                                    include '../config.php';
                                    $sql = "SELECT `To` AS `Tujuan`, 
                                            COUNT(`To`) AS `Jumlah`, 
                                            (COUNT(`To`) / (SELECT COUNT(*) FROM `tb_dataset`)) * 100 AS `Persentase` 
                                    FROM `tb_dataset` 
                                    GROUP BY `To`";
                                    $result = mysqli_query($conn, $sql);
                                    
                                    // Periksa apakah query berhasil dieksekusi
                                    if ($result) {
                                        ?>
                                        <table class="table table-centered align-middle table-nowrap mb-0">
                                            <thead>
                                                <tr>
                                                    <th style='border: 0px; font-size:13px; color:#3C3633; border-right: 1px solid #B4B4B8;'>Tujuan</th>
                                                    <th style='border: 0px; font-size:13px; color:#3C3633;'>Persentase</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                // Ambil data dari hasil query
                                                while ($row = mysqli_fetch_assoc($result)) {
                                                    // Periksa apakah kunci 'To' ada dalam array $row
                                                    if (isset($row['Tujuan'])) {
                                                        ?>
                                                        <tr>
                                                            <td style='border: 0px; border-top: 1px solid #B4B4B8; border-right: 1px solid #B4B4B8;'><?php echo $row['Tujuan']; ?></td>
                                                            <td style='border: 0px; border-top: 1px solid #B4B4B8;'><?php echo $row['Persentase']; ?>%</td>
                                                        </tr>
                                                        <?php
                                                    }
                                                }
                                                ?>
                                            </tbody>
                                        </table>
                                        <?php
                                    } else {
                                        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
                                    }
                                    
                                    ?>
                                </div>
                            </div>
                        </div>
                        <?php
                        include '../config.php';

                        // Lakukan kueri ke database untuk mengambil data dari kolom Fuel Tank Stock After
                        $sql = "SELECT Fuel_Tank_Stock_After FROM tb_dataset ORDER BY Date DESC LIMIT 1";
                        $result = mysqli_query($conn, $sql);

                        if (mysqli_num_rows($result) > 0) {
                            // Ambil nilai rata-rata
                            $row = mysqli_fetch_assoc($result);
                            $last_fuel_stock = $row['Fuel_Tank_Stock_After'];

                            // Tampilkan nilai rata-rata dalam elemen HTML
                            echo '<div class="card">';
                            echo '<div class="card-body" style="background-color:#C40C0C; border-radius:1rem; box-shadow: 2px 2px 2px #B4B4B8; height:180">';
                            echo '<div class="row align-items-center justify-content-start">';
                            echo '<div class="col-lg-12">';
                            echo '<h5 class="best-product-title mt-3" style ="color:white;"> Isi Tank Bahan Bakar Terakhir</h5>';
                            echo '<div class="row align-items-end mt-4">';
                            echo '<div class="col-6">';
                            echo '<div>';
                            echo '<h4 class="font-size-20 best-product-title" style="color:white;">' . $last_fuel_stock . '</h4>';
                            echo '<p class="mb-0" style ="color:white;">Isi Tank Terakhir</p>';
                            echo '</div>';
                            echo '</div>';
                            echo '<div class="col-6">';
                            echo '<div class="mt-2">';
                            echo '<a href="tables.php" class="btn text-light btn-sm" style="background-color:black;">Lihat Tabel</a>';
                            echo '</div>';
                            echo '</div>';
                            echo '</div>';
                            echo '</div>';
                            echo '</div>';
                        } else {
                            echo "Tidak ada data yang ditemukan.";
                        }
                        ?>
                    </div>
                </div>
            </div>

                <div class="row">
                    <div class="col-xl-4">

                        <div class="card" style=" border-radius:1rem; box-shadow: 2px 2px 2px #B4B4B8; height:460;">
                            <div class="card-header" style=" border-radius:3rem;">
                                <div class="d-flex flex-wrap align-items-center">
                                    <h5 class="card-title mb-0">Tren Penggunaan Bahan Bakar Harian Kapal FMC</h5>
                                </div>
                            </div>
                            <div class="card-body py-xl-0">
                                <?php
                                include '../config.php';

                                // Query untuk mengambil data dari tabel tb_dataset dan urutkan berdasarkan tanggal
                                $sql = "SELECT Date, Fuel_Daily_Consumption FROM tb_dataset ORDER BY Date";
                                $result = mysqli_query($conn, $sql);

                                // Inisialisasi array untuk menyimpan data
                                $data = array();

                                // Ambil data dari hasil query dan simpan ke dalam array
                                if ($result && mysqli_num_rows($result) > 0) {
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        $data[] = array(
                                            'date' => $row['Date'],
                                            'fuel' => $row['Fuel_Daily_Consumption']
                                        );
                                    }
                                }

                                // Buat array kosong untuk setiap kategori bulan
                                $startOfMonth = [];
                                $middleOfMonth = [];
                                $endOfMonth = [];

                                // Loop melalui data dan pisahkan ke dalam tiga array berdasarkan tanggal
                                foreach ($data as $item) {
                                    $date = new DateTime($item['date']);
                                    $day = $date->format('d');
                                    $lastDay = $date->format('t');

                                    // Tentukan kategori bulan
                                    if ($day <= 10) {
                                        $startOfMonth[] = $item['fuel'];
                                    } elseif ($day > 10 && $day <= 20) {
                                        $middleOfMonth[] = $item['fuel'];
                                    } else {
                                        $endOfMonth[] = $item['fuel'];
                                    }
                                }

                                // Hitung rata-rata dari setiap kategori bulan
                                $startOfMonthAvg = count($startOfMonth) > 0 ? array_sum($startOfMonth) / count($startOfMonth) : 0;
                                $middleOfMonthAvg = count($middleOfMonth) > 0 ? array_sum($middleOfMonth) / count($middleOfMonth) : 0;
                                $endOfMonthAvg = count($endOfMonth) > 0 ? array_sum($endOfMonth) / count($endOfMonth) : 0;

                                // Format rata-rata menjadi dua desimal
                                $startOfMonthAvg = number_format($startOfMonthAvg, 2);
                                $middleOfMonthAvg = number_format($middleOfMonthAvg, 2);
                                $endOfMonthAvg = number_format($endOfMonthAvg, 2);
                                ?>
                                <canvas id="lineChart" width="800" height="800"></canvas>
                            </div>
                        </div>

                    </div>
                    <div class="col-xl-8">
                        <div class="card" style=" border-radius:1rem; box-shadow: 2px 2px 2px #B4B4B8; height:460;">
                            <div class="card-header" style=" border-radius:1rem;">
                                <div class="d-flex flex-wrap align-items-center">
                                    <h5 class="card-title mb-0">Tabel Aktivitas Kapal FMC Marnaik Keseluruhan</h5>
                                    <div class="ms-auto">
                                        <div class="dropdown">
                                            <a class="dropdown-toggle" href="#" id="dropdownMenuButton1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <span class="text-muted font-size-12">Tujuan: </span> <span class="fw-medium" id="selectedDestination">Somber</span>
                                            </a>
                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton1" id="destinationDropdown">
                                                <a class="dropdown-item" href="#" onclick="selectDestination('Semua')">Tampilkan Semua</a>
                                                <div class="dropdown-divider"></div>
                                                <a class="dropdown-item" href="#" onclick="selectDestination('Somber')">Somber</a>
                                                <a class="dropdown-item" href="#" onclick="selectDestination('Running ME/Stand by')">Running ME/Stand by</a>
                                                <a class="dropdown-item" href="#" onclick="selectDestination('PSTB')">PSTB</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body pt-xl-1">
                                <div class="table-responsive px-3" data-simplebar style="max-height: 393px;">
                                <?php
                                require_once "../config.php";

                                $selectedDestination = isset($_GET['destination']) ? $_GET['destination'] : '';

                                // Ubah query SQL dengan menambahkan kondisi WHERE untuk filtering berdasarkan tujuan
                                $sql = "SELECT * FROM tb_dataset";
                                if ($selectedDestination !== '' && $selectedDestination !== 'Semua') {
                                    $sql .= " WHERE `To` = '$selectedDestination'";
                                }
                                $result = mysqli_query($conn, $sql);

                                if (!$result) {
                                    // Jika terjadi kesalahan, tangani di sini
                                    echo "Error: " . mysqli_error($conn);
                                    // atau tampilkan pesan kesalahan yang lebih informatif
                                    die("Query execution failed: " . $sql);
                                }
                                if (mysqli_num_rows($result) > 0) {
                                    echo '<table id="data-table">';
                                    echo '<tr>';
                                    echo '<th style="border: 0px; font-size:13px; color:#3C3633; border-right: 1px solid #B4B4B8;">Date</th>';
                                    echo '<th style="border: 0px; font-size:13px; color:#3C3633; border-right: 1px solid #B4B4B8;">From</th>';
                                    echo '<th style="border: 0px; font-size:13px; color:#3C3633; border-right: 1px solid #B4B4B8;">To</th>';
                                    echo '<th style="border: 0px; font-size:13px; color:#3C3633; border-right: 1px solid #B4B4B8;">Start ME</th>';
                                    echo '<th style="border: 0px; font-size:13px; color:#3C3633; border-right: 1px solid #B4B4B8;">Stop ME</th>';
                                    echo '<th style="border: 0px; font-size:13px; color:#3C3633; border-right: 1px solid #B4B4B8;">Running Minutes</th>';
                                    echo '<th style="border: 0px; font-size:13px; color:#3C3633; border-right: 1px solid #B4B4B8;">Fuel Daily Consumption</th>';
                                    echo '<th style="border: 0px; font-size:13px; color:#3C3633; border-right: 1px solid #B4B4B8;">Opening Fuel Tank Sounding</th>';
                                    echo '<th style="border: 0px; font-size:13px; color:#3C3633; border-right: 1px solid #B4B4B8;">Closing Fuel Tank Sounding</th>';
                                    echo '<th style="border: 0px; font-size:13px; color:#3C3633;">Fuel Tank Stock After</th>';
                                    echo '</tr>';

                                    while($row = mysqli_fetch_assoc($result)) {
                                        echo "<tr>";
                                        echo "<td style='border: 0px; border-top: 1px solid #B4B4B8; border-right: 1px solid #B4B4B8;'>" . $row["Date"] . "</td>";
                                        echo "<td style='border: 0px; border-top: 1px solid #B4B4B8; border-right: 1px solid #B4B4B8;'>" . $row["From"] . "</td>";
                                        echo "<td style='border: 0px; border-top: 1px solid #B4B4B8; border-right: 1px solid #B4B4B8;'>" . $row["To"] . "</td>";
                                        echo "<td style='border: 0px; border-top: 1px solid #B4B4B8; border-right: 1px solid #B4B4B8;'>" . $row["Start_ME"] . "</td>";
                                        echo "<td style='border: 0px; border-top: 1px solid #B4B4B8; border-right: 1px solid #B4B4B8;'>" . $row["Stop_ME"] . "</td>";
                                        echo "<td style='border: 0px; border-top: 1px solid #B4B4B8; border-right: 1px solid #B4B4B8;'>" . $row["Running_Minutes"] . "</td>";
                                        echo "<td style='border: 0px; border-top: 1px solid #B4B4B8; border-right: 1px solid #B4B4B8;'>" . $row["Fuel_Daily_Consumption"] . "</td>";
                                        echo "<td style='border: 0px; border-top: 1px solid #B4B4B8; border-right: 1px solid #B4B4B8;'>" . $row["Opening_Fuel_Tank_Sounding"] . "</td>";
                                        echo "<td style='border: 0px; border-top: 1px solid #B4B4B8; border-right: 1px solid #B4B4B8;'>" . $row["Closing_Fuel_Tank_Sounding"] . "</td>";
                                        echo "<td style='border: 0px; border-top: 1px solid #B4B4B8;'>" . $row["Fuel_Tank_Stock_After"] . "</td>";
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
                    </div>
                </div>

            </div> <!-- container-fluid -->
        </div>
        <!-- End Page-content -->


        <?php include '../User/layouts/footer.php'; ?>
    </div>
    <!-- end main content-->

</div>

    <script>
        function selectDestination(destination) {
            document.getElementById('selectedDestination').innerText = destination;
            window.location.href = 'index.php?destination=' + destination;
        }
    </script>

    <script>
        // Data dari PHP

        var data = <?php echo json_encode(array_values($counts)); ?>;
        var labels = <?php echo json_encode(array_keys($counts)); ?>;
        var frequencyValues = <?php echo json_encode(array_values($counts)); ?>; // Ambil array nilai frekuensi

        // Buat histogram menggunakan Chart.js
        var ctx = document.getElementById('histogramChart').getContext('2d');
        var histogramChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Frequency',
                    data: data,
                    backgroundColor: '#C40C0C',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    hoverBackgroundColor: "#FCDC2A",
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        // Tampilkan label-label di dalam elemen <div> yang sesuai
        var labelsDiv = document.getElementById('labels');
        labels.forEach(function(label, index) {
            var labelElement = document.createElement('div');
            labelElement.textContent = label + ' - Frequency: ' + frequencyValues[index]; // Tambahkan frekuensi ke dalam teks
            labelsDiv.appendChild(labelElement);
        });
    </script>

    <script>
    // Buat Donut Chart menggunakan Chart.js
    var ctx = document.getElementById('donutChart').getContext('2d');
    var donutChart = new Chart(ctx, {
        type: 'doughnut',
        data: {
            labels: <?php echo $fromLabels; ?>, // Label berdasarkan 'From'
            datasets: [{
                label: 'Frequency',
                data: <?php echo $fromValues; ?>, // Frekuensi masing-masing 'From'
                backgroundColor: ["#C7C8CC","#F57D1F", "#FCDC2A", "#C40C0C", "#f1f3f4"],
                borderColor: ["#C7C8CC","#F57D1F", "#FFC700", "#C40C0C", "#f1f3f4"],
                borderWidth: 1
            }]
        },
        options: {
            plugins: {
                legend: {
                    position: 'bottom'
                }
            }
        }
    });
    </script>
    <script>
        // Buat grafik garis menggunakan Chart.js
        var ctx = document.getElementById('lineChart').getContext('2d');
        var lineChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: ['Awal Bulan', 'Tengah Bulan', 'Akhir Bulan'],
                datasets: [{
                    label: 'Fuel Daily Consumption',
                    data: [<?php echo $startOfMonthAvg; ?>, <?php echo $middleOfMonthAvg; ?>, <?php echo $endOfMonthAvg; ?>],
                    borderColor: 'FCDC2A',
                    backgroundColor: '#FCDC2A',
                    borderWidth: 1,
                    fill: false
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
    <?php include '../User/layouts/vendor-scripts.php'; ?>
    <script src="assets/js/app.js"></script>
    <!-- Chart JS -->
    <script src="../assets/js/pages/chartjs.js"></script>
    <script src="../assets/js/bootstrap/bootstrap.min.js"></script>
    <script src="../assets/js/bootstrap/bootstrap.js"></script>
    <script src="../assets/js/pages/dashboard.init.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="assets/js/app.js"></script>
    <script src="assets/js/jquery-3.7.1.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.6/dist/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.2.1/dist/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
</body>

</html>