<?php
include 'layouts/session.php';
include '../config.php';

// Periksa jika parameter ID admin telah diberikan dalam URL
if (isset($_GET['id']) && !empty($_GET['id'])) {
    $admin_id = $_GET['id'];

    // Query untuk menghapus admin berdasarkan ID
    $sql = "DELETE FROM user WHERE id='$admin_id'";

    if (mysqli_query($conn, $sql)) {
        echo "Admin berhasil dihapus.";
    } else {
        echo "Error deleting admin: " . mysqli_error($conn);
    }
} else {
    echo "ID admin tidak valid.";
}

// Redirect kembali ke halaman admin list setelah menghapus admin
header("Location: admin-list.php");
exit();
?>
