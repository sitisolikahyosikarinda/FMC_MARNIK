<?php
// Mulai session jika belum dimulai
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once "../config.php";

// Initialize variables to store form data
$id = $username = $email = $about = $profilePicture = $nama = $tanggal_lahir = $gender = $alamat = "";

// Check if ID is provided via GET parameter
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])) {
    $id = $_GET['id'];
    
    // Fetch user data from the database based on ID
    $sql = "SELECT * FROM user WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    // Check if user data is found
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        // Store database values into variables
        $username = $row['username'];
        $email = $row['email'];
        $about = isset($row['about_me']) ? $row['about_me'] : '';
        $profilePicture = $row['profile_picture']; // Get current profile picture
        $nama = isset($row['nama']) ? $row['nama'] : ''; // Set default value for $nama
        $tanggal_lahir = isset($row['tanggal_lahir']) ? $row['tanggal_lahir'] : ''; // Set default value for $tanggal_lahir
        $gender = isset($row['gender']) ? $row['gender'] : ''; // Set default value for $gender
        $alamat = isset($row['alamat']) ? $row['alamat'] : ''; // Set default value for $alamat
    } else {
        echo "Data not found.";
        exit(); // Exit the script
    }
}

// Process form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $about = $_POST['about'];
    $nama = isset($_POST['nama']) ? $_POST['nama'] : '';
    $tanggal_lahir = isset($_POST['tanggal_lahir']) ? $_POST['tanggal_lahir'] : '';
    $gender = isset($_POST['gender']) ? $_POST['gender'] : '';
    $alamat = isset($_POST['alamat']) ? $_POST['alamat'] : '';

    // Check if a new file is uploaded
    if ($_FILES['profilePicture']['name']) {
        // New file is uploaded, process upload
        $target_dir = "upload/";
        $target_file = $target_dir . basename($_FILES["profilePicture"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Check if file is a valid image
        $check = getimagesize($_FILES["profilePicture"]["tmp_name"]);
        if ($check === false) {
            echo "File is not an image.";
            $uploadOk = 0;
        }

        // Check file size
        if ($_FILES["profilePicture"]["size"] > 500000) {
            echo "Sorry, your file is too large.";
            $uploadOk = 0;
        }

        // Allow only certain file formats
        $allowedFormats = ["jpg", "jpeg", "png", "gif"];
        if (!in_array($imageFileType, $allowedFormats)) {
            echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk = 0;
        }

        // Move uploaded file if everything is ok
        if ($uploadOk == 1) {
            if (move_uploaded_file($_FILES["profilePicture"]["tmp_name"], $target_file)) {
                echo "The file " . htmlspecialchars(basename($_FILES["profilePicture"]["name"])) . " has been uploaded.";
                $profilePicture = basename($_FILES["profilePicture"]["name"]); // Hanya simpan nama file
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        }
    }

    // Update user data in the database
    $sql = "UPDATE user SET username=?, email=?, about_me=?, profile_picture=?, nama=?, tanggal_lahir=?, gender=?, alamat=? WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssssssi", $username, $email, $about, $profilePicture, $nama, $tanggal_lahir, $gender, $alamat, $id);

    if ($stmt->execute()) {
        echo "Admin updated successfully.";
        // Redirect to admin-list.php after update
        header("Location: admin-list.php");
        exit();
    } else {
        echo "Error updating admin: " . $stmt->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Admin</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">
    <h2>Edit Admin</h2>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">

        <input type="hidden" name="id" value="<?php echo $id; ?>">
        <div class="form-group">
            <label for="username">Username:</label>
            <input type="text" class="form-control" id="username" name="username" value="<?php echo $username; ?>" required>
        </div>
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" class="form-control" id="email" name="email" value="<?php echo $email; ?>" required>
        </div>
        <div class="mb-3">
            <label for="nama" class="form-label">Nama</label>
            <input type="text" class="form-control" id="nama" name="nama" value="<?php echo $nama; ?>" placeholder="Enter Nama" required>
        </div>
        <div class="mb-3">
            <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
            <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir" value="<?php echo $tanggal_lahir; ?>" required>
        </div>
        <div class="mb-3">
            <label for="alamat" class="form-label">Alamat</label>
            <input type="text" class="form-control" id="alamat" name="alamat" value="<?php echo $alamat; ?>" placeholder="Enter Alamat" required>
        </div>
        <div class="mb-3">
            <label for="gender" class="form-label">Gender</label>
            <select class="form-select" id="gender" name="gender" required>
                <option value="Pria" <?php if ($gender === 'Pria') echo 'selected'; ?>>Pria</option>
                <option value="Wanita" <?php if ($gender === 'Wanita') echo 'selected'; ?>>Wanita</option>
            </select>
        </div>
        <div class="form-group">
            <label for="about">About:</label>
            <textarea class="form-control" id="about" name="about" rows="3"><?php echo $about; ?></textarea>
        </div>
        <div class="form-group">
            <label for="profilePicture">Current Profile Picture:</label><br>
            <?php if ($profilePicture): ?>
                <img src="upload/<?php echo $profilePicture; ?>" class="img-thumbnail" style="max-width: 200px;">
            <?php else: ?>
                <p>No profile picture uploaded.</p>
            <?php endif; ?>
        </div>
        <div class="form-group">
            <label for="newProfilePicture">Upload New Profile Picture:</label>
            <input type="file" class="form-control" id="newProfilePicture" name="profilePicture" accept="image/*">
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
        <a href="admin-list.php" class="btn btn-secondary">Cancel</a>
    </form>
</div>

<!-- Bootstrap JS and dependencies -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
