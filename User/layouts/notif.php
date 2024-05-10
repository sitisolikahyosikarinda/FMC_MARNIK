<?php
// Panggil file config.php yang berisi koneksi ke database
include_once "../config.php";

// Periksa apakah data notifikasi dikirim melalui metode POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Tangkap data yang dikirim dari form
    $bahan_bakar = $_POST['bahan_bakar'];
    $tanggal = $_POST['tanggal'];

    // Tetapkan Nama_Kapal secara otomatis
    $nama_kapal = "Kapal FMC Marnaik";

    // Query SQL untuk menambahkan data notifikasi ke database
    $sql = "INSERT INTO notif (Nama_Kapal, Bahan_Bakar_Harian, Date) VALUES ('$nama_kapal', '$bahan_bakar', '$tanggal')";

    // Jalankan query dan periksa apakah berhasil
    if ($conn->query($sql) === TRUE) {
        echo "Data notifikasi berhasil ditambahkan.";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>
