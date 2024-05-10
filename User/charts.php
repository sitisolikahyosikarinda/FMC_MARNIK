<?php include 'layouts/session.php'; ?>
<?php include '../config.php';   ?>

<?php
    $navbar = [];
?>

<head>

    <title><?php echo isset($navbar["Charts"]) ? $navbar["Charts"] : "Charts"; ?> | FMC - Dashboard</title>

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
                            $maintitle = "Analisis";
                            $title = '';
                        ?>
                        <?php include 'layouts/breadcrumb.php'; ?>
                        <!-- end page title -->

                        <div class="row">
                            <div class="col-xl-6">
                                <div class="card" style="height: 400px; border-radius:1rem; box-shadow: 2px 2px 2px #B4B4B8;">
                                    <div class="card-header" style="border-radius:1rem;">
                                        <h4 class="card-title mb-0">Tingkat Efisiensi Bahan Bakar Pada Kapal FMC Marnik</h4>
                                    </div>
                                    <div class="card-body">
                                        <?php
                                            $garis = "SELECT `Fuel_Daily_Consumption`, AVG(`Opening_Fuel_Tank_Sounding`) AS avg_opening FROM `tb_dataset` GROUP BY `Fuel_Daily_Consumption` ORDER BY `Fuel_Daily_Consumption`";
                                            $result_garis = mysqli_query($conn, $garis);
                                        
                                            $labels_garis = [];
                                            $data_garis = [];
                                        
                                            while ($row = mysqli_fetch_assoc($result_garis)) {
                                                $labels_garis[] = $row['Fuel_Daily_Consumption'];
                                                $data_garis[] = $row['avg_opening'];
                                            }
                                        
                                        
                                            $data_json_garis = json_encode($data_garis);
                                        
                                        ?>
                                        <canvas id="lineChart" class="chartjs-chart" data-colors='["rgba(57, 128, 192, 0.2)", "#3980c0", "rgba(235, 239, 242, 0.2)", "#ebeff2"]'></canvas>   
                                    </div>
                                </div>
                            </div> <!-- end col -->
        
                            <div class="col-xl-6">
                                <div class="card"  style="height: 400px;  border-radius:1rem; box-shadow: 2px 2px 2px #B4B4B8;">
                                    <div class="card-header" style="border-radius:1rem;">
                                        <h4 class="card-title mb-0">Volume Bahan Bakar Perjalanan Kapal FMC Marnaik ke Destinasi Tujuan</h4>
                                    </div>
                                    <div class="card-body">
                                        <?php
                                        $query = "SELECT * FROM tb_dataset";
                                        $result = mysqli_query($conn, $query);

                                        $labels = [];
                                        $data = [];
                                        $merged_data = [];

                                        while($row = mysqli_fetch_assoc($result)) {
                                            $name = $row['To'];
                                            $value = $row['Closing_Fuel_Tank_Sounding'];

                                            if (array_key_exists($name, $merged_data)) {
                                                $merged_data[$name] += $value;
                                            } else {

                                                $merged_data[$name] = $value;
                                            }
                                        }

                                        $labels = array_keys($merged_data);
                                        $data = array_values($merged_data);
                                        ?>
                                        <canvas id="bar" class="chartjs-chart" data-colors='["rgba(51, 161, 134, 0.8)", "rgba(51, 161, 134, 0.9)"]'></canvas>
                                          
                                    </div>
                                </div>
                            </div> <!-- end col -->
                        </div> <!-- end row -->
        
                        <div class="row">
                            <div class="col-xl-6">
                                <div class="card"  style="height: 400px;  border-radius:1rem; box-shadow: 2px 2px 2px #B4B4B8;">
                                    <div class="card-header" style="border-radius:1rem;">
                                        <h4 class="card-title mb-0">Persentase Penggunaan Tempat Awal Sebelum Kapal FMC Marnaik Berlayar</h4>
                                    </div>
                                    <div class="card-body">
                                        <?php
                                        $total = "SELECT `From`, COUNT(*) as total FROM tb_dataset GROUP BY `From`";
                                        $pie = mysqli_query($conn, $total);

                                        $labels_pie = [];
                                        $data_pie = [];

                                        if ($pie->num_rows > 0) {
                                            while ($row = $pie->fetch_assoc()) {

                                                $labels_pie[] = $row['From'];

                                                $data_pie[] = $row['total'];
                                            }
                                        }

                                        $total_data_pie = array_sum($data_pie);
                                        $labels_pie_with_percentage = [];

                                        for ($i = 0; $i < count($labels_pie); $i++) {
                                            $percentage_pie = ($data_pie[$i] / $total_data_pie) * 100;
                                            $label_with_percentage = $labels_pie[$i] . " = " . number_format($percentage_pie, 1) . "%";
                                            $labels_pie_with_percentage[] = $label_with_percentage;
                                        }
                                        ?>
                                        <canvas id="pieChart" class="chartjs-chart" data-colors='["#C40C0C", "#F57D1F", "#FCDC2A", "#C40C0C", "#F57D1F"]'></canvas>
                                    </div>
                                </div>
                            </div> <!-- end col -->
        
                            <div class="col-xl-6">
                                <div class="card"  style="height: 400px;  border-radius:1rem; box-shadow: 2px 2px 2px #B4B4B8;">
                                    <div class="card-header" style="border-radius:1rem;">
                                        <h4 class="card-title mb-0">Distribusi Volume Bahan Bakar Dalam Tangki Setelah Perjalanan Selesai</h4>
                                    </div>
                                    <div class="card-body">
                                        <?php
                                            $histogram = "SELECT Closing_Fuel_Tank_Sounding, COUNT(*) AS count FROM tb_dataset GROUP BY Closing_Fuel_Tank_Sounding";
                                            $result_histo = mysqli_query($conn, $histogram);
                                        
                                            $labels_histo = [];
                                            $data_histo = [];
                                            
                                            while ($row = mysqli_fetch_assoc($result_histo)) {
                                                $labels_histo[] = $row['Closing_Fuel_Tank_Sounding'];
                                                $data_histo[] = $row['count'];
                                        
                                            }
                                        
                                            $data_json = json_encode($data_histo);
                                        ?>
                                        <canvas id="histogramChart" class="chartjs-chart" data-colors='["#3980c0", "#ebeff2"]'></canvas>
                                    </div>
                                </div>
                            </div> <!-- end col -->
                        </div> <!-- end row -->
        
                        <div class="row">
                            <div class="col-xl-6">
                                <div class="card" style="height: 400px;  border-radius:1rem; box-shadow: 2px 2px 2px #B4B4B8;">
                                    <div class="card-header" style="border-radius:1rem;">
                                        <h4 class="card-title mb-0">Penggunaan Bahan Bakar</h4>
                                    </div>
                                    <div class="card-body">
                                            <?php
                                            // Include file konfigurasi database
                                            include '../Admin/layouts/config.php';
                                            
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
                                            <canvas id="donutChart" class="chartjs-chart" data-colors='["#C40C0C","#F57D1F", "#FFC700", "#B4B4B5", "#f1f3f4"]'></canvas>
                                    </div>
                                </div>
                            </div> <!-- end col -->
        
                            <div class="col-xl-6">
                                <div class="card" style="height: 400px; border-radius:1rem; box-shadow: 2px 2px 2px #B4B4B8;">
                                    <div class="card-header" style="border-radius:1rem;">
                                        <h4 class="card-title mb-0">Frekueni Mesin Dimulai dan Berhenti</h4>
                                    </div>
                                    <div class="card-body">
                                        <?php
                                            $histogram2 = "SELECT CONCAT(Start_ME, ' - ', Stop_ME) AS label, COUNT(*) AS count FROM tb_dataset GROUP BY Start_ME, Stop_ME LIMIT 5";
                                            $result_histo2 = mysqli_query($conn, $histogram2);
                                        
                                            $labels_histo2 = [];
                                            $data_histo2 = [];
                                        
                                            // Memproses hasil kueri untuk membuat label dan data histogram
                                            while ($row = mysqli_fetch_assoc($result_histo2)) {
                                                $labels_histo2[] = $row['label'];
                                                $data_histo2[] = $row['count'];
                                            }
                                        
                                            // Mengkonversi data histogram ke format JSON
                                            $data_json2 = json_encode($data_histo2);
                                        ?>
                                        <canvas id="histogramChart2" class="chartjs-chart" data-colors='["rgba(42, 181, 125, 0.2)", "#33a186", "rgba(57, 128, 192, 0.2)", "#3980c0"]'></canvas>
                                    </div>
                                </div>
                            </div> <!-- end col -->
                        </div> <!-- end row -->

                    </div> <!-- container-fluid -->
                </div>
                <!-- End Page-content -->
                
                <?php include 'layouts/footer.php'; ?>
            </div>
            <!-- end main content-->

        </div>
        <!-- END layout-wrapper -->

        <?php include 'layouts/vendor-scripts.php'; ?>

         <!-- Chart JS -->
         <script src="assets/libs/chart.js/chart.min.js"></script>
         <script>

            function getChartColorsArray(chartId) {
                if (document.getElementById(chartId) !== null) {
                var colors = document.getElementById(chartId).getAttribute("data-colors");
                var colors = JSON.parse(colors);
                return colors.map(function (value) {
                    var newValue = value.replace(" ", "");
                    if (newValue.indexOf("--") != -1) {
                    var color = getComputedStyle(document.documentElement).getPropertyValue(
                        newValue
                    );
                    if (color) return color;
                    } else {
                    return newValue;
                    }
                });
                }
            }

            var labels = <?php echo json_encode($labels_garis); ?>;
            var data = <?php echo $data_json_garis; ?>;

            // Membuat grafik menggunakan Chart.js
            var ctx = document.getElementById('lineChart').getContext('2d');
            var myChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Fuel Daily Consumption',
                        data: data,
                        fill: false,
                        borderColor: '#C40C0C',
                        tension: 0.1
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


            var isbarchart = document.getElementById('bar');
            var barChartColors = ['#F57D1F', '#FF5722']; // Tentukan warna secara langsung

            // Mengatur lebar canvas sesuai dengan lebar parent element
            isbarchart.setAttribute("width", isbarchart.parentElement.offsetWidth);

            var barChart = new Chart(isbarchart, {
                type: 'bar',
                data: {
                    labels: <?php echo json_encode($labels); ?>,
                    datasets: [
                        {
                            label: 'Close Fuel Tank Sounding',
                            backgroundColor: barChartColors[0], // Gunakan warna dari array yang ditentukan
                            borderColor: barChartColors[0], // Gunakan warna dari array yang ditentukan
                            borderWidth: 1,
                            hoverBackgroundColor: barChartColors[1], // Gunakan warna dari array yang ditentukan
                            hoverBorderColor: barChartColors[1], // Gunakan warna dari array yang ditentukan
                            data: <?php echo json_encode($data); ?>,
                        }
                    ]
                },
                options: {
                    scales: {
                        xAxes: [{
                            barPercentage: 0.4 // Menyesuaikan lebar bar chart
                        }]
                    }
                }
            });


            var ispiechart = document.getElementById('pieChart');
            pieChartColors =  getChartColorsArray('pieChart');

            var pieChart = new Chart(ispiechart, {
                type: 'pie',
                data: {
                    labels: <?php echo json_encode($labels_pie_with_percentage); ?>,
                    datasets: [
                        {
                            data: <?php echo json_encode($data_pie); ?>,
                            backgroundColor: pieChartColors,
                            hoverBackgroundColor: pieChartColors,
                            hoverBorderColor: "#fff"
                        }]
                }
            });


            var histogramChart = document.getElementById('histogramChart');

            var histogramChart = new Chart(histogramChart, {
                type: 'bar',
                data: {
                    labels: <?php echo json_encode($labels_histo); ?>,
                    datasets: [{
                        label: 'Close Fuel Tank Sounding',
                        data: <?php echo json_encode($data_histo); ?>,
                        backgroundColor: "#FCDC2A",
                        borderColor: 'rgba(54, 162, 235, 1)',
                        hoverBackgroundColor: "#FF9130",
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero: true
                            }
                        }]
                    }
                }
            });


            var ispolarAreachart = document.getElementById('polarArea');
            polarAreaChartColors =  getChartColorsArray('polarArea');

            var lineChart = new Chart(ispolarAreachart, {
                type: 'polarArea',
                data: {
                    labels: [
                        "Series 1",
                        "Series 2",
                        "Series 3",
                        "Series 4"
                    ],
                    datasets: [{
                        data: [
                            11,
                            16,
                            7,
                            18
                        ],
                        backgroundColor: polarAreaChartColors,
                        label: 'My dataset', // for legend
                        hoverBorderColor: "#fff"
                    }]
                }
            });

            var ctx = document.getElementById('histogramChart2').getContext('2d');
            var histogramChart2 = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: <?php echo json_encode($labels_histo2); ?>,
                    datasets: [{
                        label: 'Frequency',
                        data: <?php echo $data_json2; ?>,
                        backgroundColor: "#C40C0C",
                        borderColor: '#C40C0C',
                        hoverBackgroundColor: "#F57D1F",
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero: true
                            }
                        }]
                    }
                }
            });

            var ctx = document.getElementById('donutChart').getContext('2d');
            var donutChart = new Chart(ctx, {
                type: 'doughnut',
                data: {
                    labels: <?php echo $fromLabels; ?>, // Label berdasarkan 'From'
                    datasets: [{
                        label: 'Frequency',
                        data: <?php echo $fromValues; ?>, // Frekuensi masing-masing 'From'
                        backgroundColor: ["#C7C8CC","#F57D1F", "#FCDC2A", "#C40C0C", "#f1f3f4"],
                        borderColor: ["#C7C8CC","#F57D1F", "#FCDC2A", "#C40C0C", "#f1f3f4"],
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
        <script src="assets/js/app.js"></script>

    </body>
</html> 