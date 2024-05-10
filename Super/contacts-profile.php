<?php
// Masukkan file session
include 'layouts/session.php';

// Masukkan file head-main.php
include 'layouts/head-main.php';

// Masukkan file konfigurasi database
include '../config.php';

// Ambil nilai admin_id dari sesi
$adminId = $_SESSION['user']['id'];

// Variabel untuk menampung data pengguna
$username = '';
$profilePicture = '';
$role = '';
$about = '';

// Gunakan prepared statement untuk query
$sql = "SELECT * FROM user WHERE id = ?";
$stmt = $conn->prepare($sql);

// Periksa apakah prepared statement berhasil dibuat
if (!$stmt) {
    die('Query preparation failed: ' . $conn->error);
}

// Bind parameter ke prepared statement
$stmt->bind_param("i", $adminId);

// Jalankan prepared statement
$stmt->execute();

// Dapatkan hasil dari query
$result = $stmt->get_result();

// Periksa apakah query berhasil dieksekusi dan ada hasilnya
if ($result->num_rows > 0) {
    // Ambil data pengguna
    $adminData = $result->fetch_assoc();

    // Assign nilai dari database ke variabel
    $username = isset($adminData['username']) ? $adminData['username'] : 'N/A';
    $profilePicture = isset($adminData['profile_picture']) ? $adminData['profile_picture'] : '';
    $role = isset($adminData['peran']) ? $adminData['peran'] : 'N/A';
    $about = isset($adminData['about_me']) ? $adminData['about_me'] : 'No information available.';
    $gender = isset($adminData['gender']) ? $adminData['gender'] : 'No information available.';
    $tanggal_lahir = isset($adminData['tanggal_lahir']) ? $adminData['tanggal_lahir'] : 'No information available.';
    $alamat = isset($adminData['alamat']) ? $adminData['alamat'] : 'No information available.';
} else {
    // Tampilkan pesan jika tidak ada data pengguna ditemukan
    echo "No user found with the provided ID.";
}

// Tutup prepared statement
$stmt->close();

// Tutup koneksi database
$conn->close();
// var_dump($username);
// var_dump($role);
// var_dump($profilePicture);
// var_dump($gender);
// var_dump($tanggal_lahir);
// var_dump($about);exit
?>


<head>
    <title><?php echo $language["Profile"]; ?> | FMC Marnik</title>
    <?php include 'layouts/head.php'; ?>
    <?php include 'layouts/head-style.php'; ?>
</head>

<?php include 'layouts/body.php'; ?>

<div id="layout-wrapper">
    <?php include 'layouts/menu.php'; ?>

    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">
                <?php
                $maintitle = "Contacts";
                $title = 'User Profile';
                ?>
                <?php include 'layouts/breadcrumb.php'; ?>

                <div class="row mb-4">
                    <div class="col-xl-8">
                        <div class="card mb-0">
                            <div class="tab-content p-4">
                                <div class="tab-pane active" id="about" role="tabpanel">
                                    <div>
                                        <div>
                                        <h5 class="font-size-16 mb-4">About Me</h5>
                                        <p class="text-muted"><?php echo $about; ?></p>

                                        <!-- Profile Picture and User Information -->
                                        <div class="profile-content text-center">
                                            <h5 class="mt-3 mb-1"><?php echo $username; ?></h5>
                                            <p class="text-muted"><?php echo $role; ?></p>
                                            <p class="text-muted mb-1"><?php echo $gender; ?></p>
                                            <p class="text-muted mb-1"><?php echo $tanggal_lahir; ?></p>
                                            <p class="text-muted mb-1"><?php echo $alamat; ?></p>
                                            <p class="text-muted mb-1"><?php echo $about; ?></p>
                                        </div>

                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane" id="messages" role="tabpanel">
                                    <!-- Placeholder for messages or additional content -->
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4">
                        <div class="card overflow-hidden">
                            <div class="profile-user"></div>
                            <div class="card-body">
                                <div class="profile-content text-center">
                                    <div class="profile-user-img">
                                        <img src="upload/<?php echo $profilePicture; ?>" alt="" class="avatar-lg rounded-circle img-thumbnail">
                                    </div>
                                    <h5 class="mt-3 mb-1"><?php echo $username; ?></h5>
                                    <p class="text-muted"><?php echo $role; ?></p>
                                    <p class="text-muted mb-1"><?php echo $about; ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php include 'layouts/footer.php'; ?>
    </div>
</div>

<?php include 'layouts/right-sidebar.php'; ?>
<?php include 'layouts/vendor-scripts.php'; ?>
<script src="assets/js/app.js"></script>
</body>
</html>
