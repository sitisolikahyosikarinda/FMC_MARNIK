<?php
include 'layouts/session.php';
include '../config.php';

// Proses form jika data telah di-submit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $about = $_POST['about'];
    $role = $_POST['role'];
    $nama = isset($_POST['nama']) ? $_POST['nama'] : '';
    $tanggal_lahir = isset($_POST['tanggal_lahir']) ? $_POST['tanggal_lahir'] : '';
    $gender = isset($_POST['gender']) ? $_POST['gender'] : '';
    $alamat = isset($_POST['alamat']) ? $_POST['alamat'] : '';

    // Mengunggah file gambar
    $target_dir = "upload/";
    $target_file = basename($_FILES["profilePicture"]["name"]);
    $uploadOk = 1;
    $namafile = $_FILES["profilePicture"]["name"];
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Periksa apakah file gambar valid
    if (isset($_POST["submit"])) {
        $check = getimagesize($_FILES["profilePicture"]["tmp_name"]);
        if ($check !== false) {
            // echo "File is an image - " . $check["mime"] . ".";
            $uploadOk = 1;
        } else {
            echo "File is not an image.";
            $uploadOk = 0;
        }
    }

    // Periksa apakah file sudah ada
    if (file_exists($target_file)) {
        echo "Sorry, file already exists.";
        $uploadOk = 0;
    }

    // Batasi jenis file yang diizinkan
    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }

    // Periksa apakah uploadOk bernilai 0 oleh kesalahan di atas
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
    } else {
        if (move_uploaded_file($_FILES["profilePicture"]["tmp_name"], "upload/" . $namafile)) {
            // echo "The file " . basename($_FILES["profilePicture"]["name"]) . " has been uploaded.";

            // Simpan informasi admin ke database
            $sql = "INSERT INTO user (username, email, password, about_me, profile_picture, peran, nama, tanggal_lahir, gender, alamat) VALUES ('$username', '$email', '$password', '$about', '$target_file', '$role', '$nama', '$tanggal_lahir', '$gender', '$alamat')";
        
            if (mysqli_query($conn, $sql)) {
                echo '<script>alert("Berhasil Menambahkan Admin")</script>';

            } else {
                echo '<script>alert("Gagal Menambahkan Admin")</script>';
            }
        } else {
            echo '<script>alert("Terjadi Kesalahan dalam mengupload file")</script>';
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title><?php echo $language["Admin-List"]; ?> | BSS - Dashboard</title>
    <?php include 'layouts/head.php'; ?>
    <?php include 'layouts/head-style.php'; ?>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<?php include 'layouts/body.php'; ?>
<body>

    <div id="layout-wrapper">

        <?php include 'layouts/menu.php'; ?>

        <div class="main-content">
            <div class="page-content">
                <div class="container-fluid">
                    <!-- start page title -->
                    <?php
                    $maintitle = "Contacts";
                    $title = 'User List';
                    ?>
                    <?php include 'layouts/breadcrumb.php'; ?>
                    <!-- end page title -->

                    <!-- Tombol "Add New" -->
                    <div class="mb-3 d-flex justify-content-end">
                        <a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#addNewModal" class="btn btn-success waves-effect waves-light">
                            <i class="mdi mdi-plus me-2"></i> Add New
                        </a>
                    </div>

                    <!-- Modal "Add New Admin" -->
                    <div class="modal fade" id="addNewModal" tabindex="-1" role="dialog" aria-labelledby="addNewModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-xl modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="addNewModalLabel">Add New Admin</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
    <form action="" method="POST" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="username" class="form-label">Username</label>
            <input type="text" class="form-control" id="username" name="username" placeholder="Enter Username" required>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" placeholder="Enter Email" required>
        </div>
        <div class="mb-3">
            <label for="nama" class="form-label">Nama</label>
            <input type="text" class="form-control" id="nama" name="nama" placeholder="Enter Nama" required>
        </div>
        <div class="mb-3">
            <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
            <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir" required>
        </div>
        <div class="mb-3">
            <label for="alamat" class="form-label">Alamat</label>
            <input type="text" class="form-control" id="alamat" name="alamat" placeholder="Enter Alamat" required>
        </div>
        <div class="mb-3">
            <label for="gender" class="form-label">Gender</label>
            <select class="form-select" id="gender" name="gender" required>
                <option value="Pria">Pria</option>
                <option value="Wanita">Wanita</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="role" class="form-label">Role</label>
            <select class="form-select" id="role" name="role" required>
                <option value="admin">Admin</option>
                <option value="superadmin">Super</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" id="password" name="password" placeholder="Enter Password" required>
        </div>
        <div class="mb-3">
            <label for="about" class="form-label">About</label>
            <textarea class="form-control" id="about" name="about" rows="3" placeholder="Write something about this admin"></textarea>
        </div>
        <div class="mb-3">
            <label for="profilePicture" class="form-label">Profile Picture</label>
            <input type="file" class="form-control" id="profilePicture" name="profilePicture" accept="image/*" required>
        </div>
        
        <button type="submit" name="submit" class="btn btn-primary">Add Admin</button>
    </form>
</div>

                            </div>
                        </div>
                    </div>
                    <!-- coba -->

                    <!-- Daftar admin -->
                    <div class="row">
                        <?php
                        $sql = "SELECT * FROM user";
                        $result = mysqli_query($conn, $sql);

                        if (mysqli_num_rows($result) > 0) {
                            while ($row = mysqli_fetch_assoc($result)) {
                                echo '<div class="col-lg-4 col-md-6 mb-4">';
                                echo '<div class="card">';
                                echo '<img src="upload/' . $row['profile_picture'] . '" class="card-img-top" alt="Profile Picture">;                           ';
                                echo '<div class="card-body">';
                                echo '<h5 class="card-title">' . $row['username'] . '</h5>';
                                echo '<div class="d-flex justify-content-end">';
                                echo '<a href="edit-admin.php?id=' . $row['id'] . '" class="btn btn-sm btn-primary me-2">Edit</a>';
                                echo '<a href="delete-admin.php?id=' . $row['id'] . '" class="btn btn-sm btn-danger" onclick="return confirm(\'Apakah Anda yakin ingin menghapus?\')">Hapus</a>';
                                echo '</div>';
                                echo '</div>';
                                echo '</div>';
                                echo '</div>';
                            }
                        }
                        ?>
                    </div>

                </div> <!-- container-fluid -->
            </div>
            <!-- End Page-content -->

            <?php include 'layouts/footer.php'; ?>
        </div>
        <!-- end main content-->

    </div>
    <!-- END layout-wrapper -->

    <?php include 'layouts/right-sidebar.php'; ?>
    <?php include 'layouts/vendor-scripts.php'; ?>

    <!-- gridjs js -->
    <script src="assets/libs/gridjs/gridjs.umd.js"></script>
    <script src="assets/js/pages/contacts-list.init.js"></script>
    <script src="assets/js/app.js"></script>

</body>

</html>
