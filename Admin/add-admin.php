<?php
include '../config.php';

// Memproses data ketika tombol "Add Admin" ditekan
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Mengambil data dari form
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $about = $_POST['about'];

    // Mengunggah file gambar (Profile Picture)
    $targetDir = "../Admin/uploads";
    $profilePicture = basename($_FILES["profilePicture"]["name"]);
    $targetFilePath = $targetDir . $profilePicture;
    $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);

    // Izinkan format file tertentu
    $allowTypes = array('jpg', 'png', 'jpeg', 'gif');
    if (in_array($fileType, $allowTypes)) {
        // Pindahkan file yang diunggah ke lokasi yang diinginkan
        if (move_uploaded_file($_FILES["profilePicture"]["tmp_name"], $targetFilePath)) {
            // Menggunakan prepared statement untuk mencegah SQL Injection
            $sql = "INSERT INTO user (username, email, password, about_me, profile_picture) VALUES (?, ?, ?, ?, ?)";

            // Persiapan statement
            $stmt = $conn->prepare($sql);

            // Binding parameter ke statement
            $stmt->bind_param("sssss", $username, $email, $password, $about, $profilePicture);

            // Eksekusi statement
            if ($stmt->execute()) {
                // Data berhasil disimpan
                echo "Admin berhasil ditambahkan.";
            } else {
                // Jika terjadi error
                echo "Error: " . $sql . "<br>" . $conn->error;
            }

            // Menutup statement
            $stmt->close();
        } else {
            echo "Maaf, terjadi kesalahan saat mengunggah file.";
        }
    } else {
        echo "Maaf, hanya file JPG, JPEG, PNG, dan GIF yang diperbolehkan untuk diunggah.";
    }
}

// Menutup koneksi
$conn->close();
?>
