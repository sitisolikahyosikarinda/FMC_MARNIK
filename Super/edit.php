<?php
require_once "../config.php";

// Inisialisasi variabel untuk menyimpan data dari database
$id = $date = $from = $to = $start_me = $stop_me = $running_minutes = $fuel_daily_consumption = $opening_fuel_tank_sounding = $closing_fuel_tank_sounding = $fuel_tank_stock_after = "";

// Periksa apakah ID telah diberikan melalui parameter GET
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])) {
    $id = $_GET['id'];
    
    // Mengambil data dari database berdasarkan ID yang diberikan
    $sql = "SELECT * FROM tb_dataset WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    // Periksa apakah data ditemukan
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        // Menyimpan data dari database ke variabel
        $date = $row['Date'];
        $from = $row['From'];
        $to = $row['To'];
        $start_me = $row['Start_ME'];
        $stop_me = $row['Stop_ME'];
        $running_minutes = $row['Running_Minutes'];
        $fuel_daily_consumption = $row['Fuel_Daily_Consumption'];
        $opening_fuel_tank_sounding = $row['Opening_Fuel_Tank_Sounding'];
        $closing_fuel_tank_sounding = $row['Closing_Fuel_Tank_Sounding'];
        $fuel_tank_stock_after = $row['Fuel_Tank_Stock_After'];
    } else {
        echo "Data tidak ditemukan.";
        exit(); // Keluar dari skrip
    }
}

// Proses penyimpanan data setelah pengeditan
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil nilai dari form
    $id = $_POST['id'];
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
    
    // Update data ke dalam database
    $sql = "UPDATE tb_dataset SET `Date`=?, `From`=?, `To`=?, Start_ME=?, Stop_ME=?, Running_Minutes=?, Fuel_Daily_Consumption=?, Opening_Fuel_Tank_Sounding=?, Closing_Fuel_Tank_Sounding=?, Fuel_Tank_Stock_After=? WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('ssssssssssi', $date, $from, $to, $start_me, $stop_me, $running_minutes, $fuel_daily_consumption, $opening_fuel_tank_sounding, $closing_fuel_tank_sounding, $fuel_tank_stock_after, $id);

    if ($stmt->execute()) {
        echo "Data berhasil diperbarui.";
        // Redirect kembali ke halaman form-elements.php setelah proses update selesai
        header("Location: form-elements.php");
        exit();
    } else {
        echo "Error updating data: " . $stmt->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data</title>
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

<!-- Begin page -->
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <!-- start page title -->
            <?php
                $maintitle = "Forms";
                $title = 'Basic Elements';
            ?>
            <!-- end page title -->

            <!-- Form untuk mengedit data -->
            <div class="row mb-3">
                <div class="col-xl-10 mx-auto">
                    <div class="card my-4" style="border-radius: 1rem; box-shadow: 1px 1px 1px #B4B4B8;">
                        <div class="card-header">
                            <h5 class="card-title mb-0">Edit Data</h5>
                        </div>
                        <div class="card-body">
                            <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                                <input type="hidden" name="id" value="<?php echo $id; ?>">
                                <div class="mb-3 row">
                                    <label for="date" class="col-md-2 col-form-label">Tanggal</label>
                                    <div class="col-md-10">
                                        <input class="form-control" type="date" id="date" name="date" value="<?php echo $date; ?>" required>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label for="from" class="col-md-2 col-form-label">Tempat Awal</label>
                                    <div class="col-md-10">
                                        <select class="form-select form-control" id="from" name="from" required>
                                            <option value="Running ME/Stand by" <?php if ($from == "Running ME/Stand by") echo "selected"; ?>>Running ME/Stand by</option>
                                            <option value="Somber" <?php if ($from == "Somber") echo "selected"; ?>>Somber</option>
                                            <option value="PSTB" <?php if ($from == "PSTB") echo "selected"; ?>>PSTB</option>
                                            <option value="JETTY BUNKER" <?php if ($from == "JETTY BUNKER") echo "selected"; ?>>JETTY BUNKER</option>
                                        </select>
                                    </div>
                                </div>
                                <!-- Sisipkan kembali elemen select untuk tujuan -->
                                <div class="mb-3 row">
                                    <label for="to" class="col-md-2 col-form-label">Tujuan</label>
                                    <div class="col-md-10">
                                        <select class="form-select form-control" id="to" name="to" required>
                                            <option value="Running ME/Stand by" <?php if ($to == "Running ME/Stand by") echo "selected"; ?>>Running ME/Stand by</option>
                                            <option value="Somber" <?php if ($to == "Somber") echo "selected"; ?>>Somber</option>
                                            <option value="PSTB" <?php if ($to == "PSTB") echo "selected"; ?>>PSTB</option>
                                            <option value="JETTY BUNKER" <?php if ($to == "JETTY BUNKER") echo "selected"; ?>>JETTY BUNKER</option>
                                        </select>
                                    </div>
                                </div>
                                <!-- Sisipkan kembali elemen input untuk start_me -->
                                <div class="mb-3 row">
                                    <label for="start_me" class="col-md-2 col-form-label">Mulai Mesin Utama</label>
                                    <div class="col-md-10">
                                        <input class="form-control" type="time" id="start_me" name="start_me" value="<?php echo $start_me; ?>" required>
                                    </div>
                                </div>
                                <!-- Sisipkan kembali elemen input untuk stop_me -->
                                <div class="mb-3 row">
                                    <label for="stop_me" class="col-md-2 col-form-label">Berhenti Mesin Utama</label>
                                    <div class="col-md-10">
                                        <input class="form-control" type="time" id="stop_me" name="stop_me" value="<?php echo $stop_me; ?>" required>
                                    </div>
                                </div>
                                <!-- Sisipkan kembali elemen input untuk running_minutes -->
                                <div class="mb-3 row">
                                    <label for="running_minutes" class="col-md-2 col-form-label">Durasi Pengunaan Mesin Utama</label>
                                    <div class="col-md-10">
                                        <input class="form-control" type="text" id="running_minutes" name="running_minutes" value="<?php echo $running_minutes; ?>" required>
                                    </div>
                                </div>
                                <!-- Sisipkan kembali elemen input untuk fuel_daily_consumption -->
                                <div class="mb-3 row">
                                    <label for="fuel_daily_consumption" class="col-md-2 col-form-label">Volume Bahan Bakar Harian</label>
                                    <div class="col-md-10">
                                        <input class="form-control" type="text" id="fuel_daily_consumption" name="fuel_daily_consumption" value="<?php echo $fuel_daily_consumption; ?>" required>
                                    </div>
                                </div>
                                <!-- Sisipkan kembali elemen input untuk opening_fuel_tank_sounding -->
                                <div class="mb-3 row">
                                    <label for="opening_fuel_tank_sounding" class="col-md-2 col-form-label">Volume Bahan Bakar Sebelum Perjalanan</label>
                                    <div class="col-md-10">
                                        <input class="form-control" type="text" id="opening_fuel_tank_sounding" name="opening_fuel_tank_sounding" value="<?php echo $opening_fuel_tank_sounding; ?>" required>
                                    </div>
                                </div>
                                <!-- Sisipkan kembali elemen input untuk closing_fuel_tank_sounding -->
                                <div class="mb-3 row">
                                    <label for="closing_fuel_tank_sounding" class="col-md-2 col-form-label">Volume Bahan Bakar Setelah Perjalanan</label>
                                    <div class="col-md-10">
                                        <input class="form-control" type="text" id="closing_fuel_tank_sounding" name="closing_fuel_tank_sounding" value="<?php echo $closing_fuel_tank_sounding; ?>" required>
                                    </div>
                                </div>
                                <!-- Sisipkan kembali elemen input untuk fuel_tank_stock_after -->
                                <div class="mb-3 row">
                                    <label for="fuel_tank_stock_after" class="col-md-2 col-form-label">Sisa Stok Bahan Bakar</label>
                                    <div class="col-md-10">
                                        <input class="form-control" type="text" id="fuel_tank_stock_after" name="fuel_tank_stock_after" value="<?php echo $fuel_tank_stock_after; ?>" required>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <div class="col-md-12 offset-md-5">
                                        <button type="submit" class="btn text-light" style="background-color: #C40C0C;">Update</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Form untuk mengedit data -->

        </div> <!-- container-fluid -->
    </div> <!-- End Page-content -->
    
</div> <!-- end main content -->

<!-- Bootstrap JS and dependencies -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
