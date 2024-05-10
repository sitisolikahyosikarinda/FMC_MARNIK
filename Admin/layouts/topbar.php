<?php
    $navbar = [];
?>
<?php
include_once "config.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Pastikan data yang diterima tidak kosong
    if (!empty($_POST['type']) && !empty($_POST['date'])) {
        // Tangkap data yang diterima dari form
        $type = $_POST['type'];
        $date = $_POST['date'];
        
        // Query SQL untuk menambahkan notifikasi ke dalam database
        $insertSql = "INSERT INTO notif (Nama_Kapal, Bahan_Bakar_Harian, Date) VALUES ('Kapal FMC Marnaik', '$type', '$date')";
        
        // Eksekusi query SQL
        if ($conn->query($insertSql) === TRUE) {
            echo "Notification added successfully!";
        } else {
            echo "Error: " . $insertSql . "<br>" . $conn->error;
        }
    } else {
        echo "Type and date must not be empty!";
    }
}
?>
<header id="page-topbar" class="isvertical-topbar">
    <div class="navbar-header">
        <div class="d-flex">
            <!-- LOGO -->
            <div class="navbar-brand-box">
                <a href="index.php" class="logo logo-dark">
                    <span class="logo-sm">
                        <img src="assets/images/logo-sm.svg" alt="" height="22">
                    </span>
                    <span class="logo-lg">
                        <img src="assets/images/logo-sm.svg" alt="" height="22"> <span class="logo-txt">Symox</span>
                    </span>
                </a>

                <a href="index.php" class="logo logo-light">
                    <span class="logo-sm">
                        <img src="assets/images/logo-sm.svg" alt="" height="22">
                    </span>
                    <span class="logo-lg">
                        <img src="assets/images/logo-sm.svg" alt="" height="22"> <span class="logo-txt">Symox</span>
                    </span>
                </a>
                
            </div>

            <button type="button" class="btn btn-sm px-3 font-size-16 header-item vertical-menu-btn">
                <i class="fa fa-fw fa-bars"></i>
            </button>
            
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
                        // Masukkan file konfigurasi database
                        include 'config.php';

                        // Memeriksa koneksi
                        if ($conn->connect_error) {
                            die("Koneksi gagal: " . $conn->connect_error);
                        }
                        
                        // Jalankan query SQL
                        $sql = "SELECT * FROM notif ORDER BY date DESC LIMIT 5";
                        $result = $conn->query($sql);

                        
                        if ($result) {
                            // Lakukan sesuatu dengan hasil query
                        } else {
                            echo "Error: " . $conn->error;
                        }
                        
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
                    <i data-feather="moon" class="icon-sm layout-mode-dark"></i>
                    <i data-feather="sun" class="icon-sm layout-mode-light"></i>
                </button>
            </div>

            <div class="dropdown d-inline-block">
                <button type="button" class="btn header-item user text-start d-flex align-items-center" id="page-header-user-dropdown"
                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <img class="rounded-circle header-profile-user" src="assets/images/users/avatar-1.jpg" alt="Header Avatar">
                </button>
                <div class="dropdown-menu dropdown-menu-end pt-0">
                    <a class="dropdown-item" href="contacts-profile.php"><i class='bx bx-user-circle text-muted font-size-18 align-middle me-1'></i> <span class="align-middle">My Account</span></a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="auth-logout.php"><i class='bx bx-log-out text-muted font-size-18 align-middle me-1'></i> <span class="align-middle">Logout</span></a>
                </div>
            </div>
        </div>
    </div>
</header>

<!-- Modal untuk menambahkan notifikasi -->
<div class="modal fade" id="addNotificationModal" tabindex="-1" aria-labelledby="addNotificationModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addNotificationModalLabel">Add Notification</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="addNotificationForm">
                    <div class="mb-3">
                        <label for="notificationType" class="form-label">Bahan Bakar Harian</label>
                        <select class="form-select" id="notificationType" name="type" required>
                            <option value="">Select Type</option>
                            <option value="info">High</option>
                            <option value="warning">Low</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="notificationDate" class="form-label">Date</label>
                        <input type="date" class="form-control" id="notificationDate" name="date" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/5.1.0/js/bootstrap.bundle.min.js"></script>

<script>
$(document).ready(function() {
    // Kirim data notifikasi ke server saat form disubmit
    $('#addNotificationForm').submit(function(e) {
        e.preventDefault(); // Hindari reload halaman
        var notificationType = $('#notificationType').val();
        var notificationDate = $('#notificationDate').val();
        
        // Kirim data ke server menggunakan AJAX
        $.ajax({
            url: 'your_file_name.php', // Nama file PHP yang sama dengan file ini
            type: 'POST',
            data: { type: notificationType, date: notificationDate },
            success: function(response) {
                // Proses response dari server (jika diperlukan)
                console.log(response);
                $('#addNotificationModal').modal('hide'); // Sembunyikan modal setelah notifikasi ditambahkan
            },
            error: function(xhr, status, error) {
                console.error(status + ': ' + error); // Tangani kesalahan (jika diperlukan)
            }
        });
    });
});
</script>