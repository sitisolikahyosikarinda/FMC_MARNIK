<?php
// Panggil file config.php yang berisi koneksi ke database
include_once "../config.php";

// Periksa apakah ada data yang dikirim dari formulir
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['content'])) {
    // Tangkap data notifikasi dari formulir
    $content = $_POST['content'];

    // Siapkan statement SQL untuk menambahkan notifikasi ke database
    $sql = "INSERT INTO notif (content) VALUES ('$content')";

    // Eksekusi statement SQL
    if ($conn->query($sql) === TRUE) {
        // Jika berhasil menambahkan notifikasi, kirimkan respon berhasil
        echo json_encode(array('success' => true, 'message' => 'Notification added successfully'));
    } else {
        // Jika terjadi kesalahan dalam menambahkan notifikasi, kirimkan respon error
        echo json_encode(array('success' => false, 'message' => 'Error adding notification: ' . $conn->error));
    }
} else {
    // Jika data tidak dikirimkan melalui metode POST, kirimkan respon error
    echo json_encode(array('success' => false, 'message' => 'Invalid request'));
}

// Tutup koneksi database
$conn->close();
?>
