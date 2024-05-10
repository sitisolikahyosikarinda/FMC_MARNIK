<?php
// Include file konfigurasi
include '../config.php'; 

// Memeriksa apakah ada request untuk menghapus data
if (isset($_GET['action']) && $_GET['action'] === 'delete' && isset($_GET['id'])) {
    $deleteId = $_GET['id'];

    // Lakukan proses penghapusan data berdasarkan $deleteId dari database
    $queryDelete = "DELETE FROM tb_dataset WHERE id = ?";
    
    // Persiapan pernyataan
    $stmtDelete = $mysqli->prepare($queryDelete);

    if ($stmtDelete) {
        $stmtDelete->bind_param("i", $deleteId);
        $stmtDelete->execute();
        $stmtDelete->close();

        // Setelah penghapusan berhasil, tampilkan notifikasi
        echo "<script>alert('Data berhasil dihapus');</script>";
    } else {
        echo "<script>alert('Gagal menghapus data');</script>";
    }
}
?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FMC Marnik</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Your Custom CSS -->
    <style>
        .highlight-row {
            background-color: #ffffcc; /* Warna latar belakang untuk menyorot baris */
        }
    </style>
</head>
<body>

<?php include 'layouts/session.php'; ?>
<?php include 'layouts/head-main.php'; ?>

<?php 
include '../config.php';
// Memeriksa apakah form telah disubmit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Memperoleh nilai yang diinputkan oleh admin
    $date = $_POST['date'];
    $from = $_POST['from'];
    $to = $_POST['to'];
    $start_me = $_POST['start_me'];
    $stop_me = $_POST['stop_me'];
    $running_minutes = $_POST['running_minutes'];
    $fuel_daily_consumption = $_POST['fuel_daily_consumption'];
    $opening_fuel_tank_sounding = $_POST['opening_fuel_tank_sounding'];
    $closing_fuel_tank_sounding = $_POST['closing_fuel_tank_sounding'];
    $fuel_tank_stock_after = $_POST['fuel_tank_stock_after'];

    $query = "INSERT INTO tb_dataset (`date`, `from`, `to`, `start_me`, `stop_me`, `running_minutes`, `fuel_daily_consumption`, `opening_fuel_tank_sounding`, `closing_fuel_tank_sounding`, `fuel_tank_stock_after`) 
    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = $mysqli->prepare($query);

    $stmt->bind_param("ssssssssss", $date, $from, $to, $start_me, $stop_me, $running_minutes, $fuel_daily_consumption, $opening_fuel_tank_sounding, $closing_fuel_tank_sounding, $fuel_tank_stock_after);
    $stmt->execute();
    $stmt->close();

    if($stmt === false) {
        die("Persiapan pernyataan gagal: " . $mysqli->error);
        }
    

    // Tampilkan notifikasi jika data berhasil ditambahkan
    echo "<script>alert('Data berhasil ditambahkan');</script>";
}
?>


<?php include 'layouts/head.php'; ?>
<?php include 'layouts/head-style.php'; ?>
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
                    $maintitle = "Forms";
                    $title = 'FMC Marnik';
                ?>
                <?php include 'layouts/breadcrumb.php'; ?>
                <!-- end page title -->

                <!-- Seluruh konten HTML -->

               <!-- Form untuk tambah data -->
               <div class="row mb-3">
    <div class="col-xl-12 mx-auto">
        <div class="card my-4" style="border-radius: 1rem; box-shadow: 1px 1px 1px #B4B4B8;">
            <div class="card-header" style="border-radius: 1rem;">
                <h5 class="card-title mb-0">Tambah Data</h5>
            </div>
            <div class="card-body">
                <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                    <div class="mb-3 row">
                        <label for="date" class="col-md-2 col-form-label">Tanggal</label>
                        <div class="col-md-10">
                            <input class="form-control" type="date" id="date" name="date" required>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="from" class="col-md-2 col-form-label">Tempat Awal</label>
                        <div class="col-md-10">
                            <select class="form-select form-control" id="from" name="from" required>
                                <option value="" disabled selected>Pilih Tempat Awal</option>
                                <option value="Running ME/Stand by">Running ME/Stand by</option>
                                <option value="Somber">Somber</option>
                                <option value="PSTB">PSTB</option>
                                <option value="JETTY BUNKER">JETTY BUNKER</option>
                            </select>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="to" class="col-md-2 col-form-label">Tujuan</label>
                        <div class="col-md-10">
                            <select class="form-select form-control" id="to" name="to" required>
                                <option value="" disabled selected>Pilih Tujuan</option>
                                <option value="Running ME/Stand by">Running ME/Stand by</option>
                                <option value="Somber">Somber</option>
                                <option value="PSTB">PSTB</option>
                                <option value="JETTY BUNKER">JETTY BUNKER</option>
                            </select>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="start_me" class="col-md-2 col-form-label">Mulai Mesin Utama</label>
                        <div class="col-md-10">
                            <input class="form-control" type="time" id="start_me" name="start_me" required>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="stop_me" class="col-md-2 col-form-label">Berhenti Mesin Utama</label>
                        <div class="col-md-10">
                            <input class="form-control" type="time" id="stop_me" name="stop_me" required>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="running_minutes" class="col-md-2 col-form-label">Durasi Pengunaan Mesin Utama</label>
                        <div class="col-md-10">
                            <input class="form-control" type="time" id="running_minutes" name="running_minutes" required>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="fuel_daily_consumption" class="col-md-2 col-form-label">Volume Bahan Bakar Harian</label>
                        <div class="col-md-10">
                            <input class="form-control" type="text" id="fuel_daily_consumption" name="fuel_daily_consumption" required>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="opening_fuel_tank_sounding" class="col-md-2 col-form-label">Volume Bahan Bakar Sebelum Perjalanan</label>
                        <div class="col-md-10">
                            <input class="form-control" type="text" id="opening_fuel_tank_sounding" name="opening_fuel_tank_sounding" required>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="closing_fuel_tank_sounding" class="col-md-2 col-form-label">Volume Bahan Bakar Setelah Perjalanan</label>
                        <div class="col-md-10">
                            <input class="form-control" type="text" id="closing_fuel_tank_sounding" name="closing_fuel_tank_sounding" required>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="fuel_tank_stock_after" class="col-md-2 col-form-label">Sisa Stok Bahan Bakar</label>
                        <div class="col-md-10">
                            <input class="form-control" type="text" id="fuel_tank_stock_after" name="fuel_tank_stock_after" required>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <div class="col-md-12 offset-md-5">
                            <button type="submit" class="btn text-light" style="background-color: #C40C0C;">Tambahkan</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- End Form untuk tambah data -->
<!-- Akhir bagian Tambah Data -->

               <!-- Tabel -->
<div class="row">
    <div class="col-xl-12">
        <div class="card" style="border-radius: 1rem; box-shadow: 1px 1px 1px #B4B4B8;">
            <div class="card-header" style="border-radius: 1rem;">
                <div class="d-flex flex-wrap align-items-center">
                    <h5 class="card-title mb-0">Tabel Penggunaan Bahan Bakar Kapal FMC Marnik Keseluruhan</h5>
                    <div class="ms-auto">
                        <div class="dropdown">
                            <!-- Dropdown menu -->
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Tanggal</th>
                                <th>Tempat Awal</th>
                                <th>Tujuan</th>
                                <th>Mulai Mesin Utama</th>
                                <th>Berhenti Mesin Utama</th>
                                <th>Durasi Penggunaan Mesin Utama</th>
                                <th>Volume Bahan Bakar Harian</th>
                                <th>Volume Bahan Bakar Sebelum Perjalanan</th>
                                <th>Volume Bahan Bakar Setelah Perjalanan</th>
                                <th>Sisa Stok Bahan Bakar</th>
                                <th>Action</th> <!-- Tambah kolom untuk aksi CRUD -->
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            // Mengambil data dari database dan menampilkannya di tabel
                            require_once "../config.php";
                            $sql = "SELECT * FROM tb_dataset";
                            $result = mysqli_query($conn, $sql);
                            if (mysqli_num_rows($result) > 0) {
                                $count = 0;
                                while ($row = mysqli_fetch_assoc($result)) {
                                    $count++;
                                    echo "<tr" . ($count === mysqli_num_rows($result) ? ' class="highlight-row"' : '') . ">";
                                    echo "<td>" . $row["Date"] . "</td>";
                                    echo "<td>" . $row["From"] . "</td>";
                                    echo "<td>" . $row["To"] . "</td>";
                                    echo "<td>" . $row["Start_ME"] . "</td>";
                                    echo "<td>" . $row["Stop_ME"] . "</td>";
                                    echo "<td>" . $row["Running_Minutes"] . "</td>";
                                    echo "<td>" . $row["Fuel_Daily_Consumption"] . "</td>";
                                    echo "<td>" . $row["Opening_Fuel_Tank_Sounding"] . "</td>";
                                    echo "<td>" . $row["Closing_Fuel_Tank_Sounding"] . "</td>";
                                    echo "<td>" . $row["Fuel_Tank_Stock_After"] . "</td>";
                                    // Tambahkan tombol Edit dan Delete
                                    echo "<td>";
                                    echo "<a href='edit.php?id=" . $row['id'] . "' class='btn btn-primary'>Edit</a>";
                                    echo "<a href='" . $_SERVER['PHP_SELF'] . "?action=delete&id=" . $row['id'] . "' class='btn btn-danger' onclick=\"return confirm('Apakah Anda yakin ingin menghapus data ini?');\">Delete</a>";
                                    echo "</td>";
                                    echo "</tr>";
                                }
                            } else {
                                echo "<tr><td colspan='11'>No records found</td></tr>";
                            }
                            mysqli_close($conn);
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Tabel -->

<!-- Akhir Seluruh konten HTML -->

</div> <!-- container-fluid -->
</div> <!-- End Page-content -->

<?php include 'layouts/footer.php'; ?>
</div> <!-- end main content -->
</div> <!-- END layout-wrapper -->

<?php include 'layouts/right-sidebar.php'; ?>
<?php include 'layouts/vendor-scripts.php'; ?>
<script src="assets/js/app.js"></script>

</body>
</html>
