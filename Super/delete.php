<?php
// Include konfigurasi database
include '../config.php';

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])) {
    // Mendapatkan ID data yang akan dihapus
    $id = $_GET['id'];

    // Query untuk menghapus data
    $sql = "DELETE FROM tb_dataset WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);

    // Eksekusi query
    if ($stmt->execute()) {
        // Redirect kembali ke halaman forms-elements.php dengan notifikasi
        header("Location: forms-elements.php?delete_success=true");
        exit();
    } else {
        echo "Gagal menghapus data.";
    }

    // Tutup statement dan koneksi
    $stmt->close();
    $conn->close();
}
?>
