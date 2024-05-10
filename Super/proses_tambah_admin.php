<?php

// // Menyertakan file config.php untuk mengatur koneksi database
// include 'layouts/config.php';

// // Memeriksa apakah data dikirimkan melalui metode POST
// if ($_SERVER["REQUEST_METHOD"] == "POST") {
//     // Memeriksa apakah semua input telah disediakan
//     if (isset($_POST['username']) && isset($_POST['email']) && isset($_POST['password']) && isset($_POST['peran'])) {
//         // Mengambil data dari formulir
//         $username = $_POST['username'];
//         $email = $_POST['email'];
//         $password = $_POST['password'];
//         $peran = $_POST['peran'];

//         // Query untuk menyimpan data admin ke dalam tabel
//         $query = "INSERT INTO user (username, email, password, peran) VALUES ('$username', '$email', '$password', '$peran')";

//         // Eksekusi query dan periksa apakah berhasil
//         if ($conn->query($query) === TRUE) {
//             echo "Admin baru berhasil ditambahkan.";
//         } else {
//             echo "Error: " . $query . "<br>" . $conn->error;
//         }
//     } else {
//         // Jika data tidak lengkap, tampilkan pesan kesalahan
//         echo "Data yang dikirimkan tidak lengkap";
//     }
// }
?>

<?php

// Menyertakan file config.php untuk mengatur koneksi database
include 'layouts/config.php';
// Pastikan file ini dipanggil setelah koneksi ke database dilakukan

// Ambil data yang dikirimkan dari form
$username = $_POST['username'];
$email = $_POST['email'];
$password = $_POST['password'];
$about_me = $_POST['about_me'];
$peran = $_POST['peran']; // Asumsikan role sudah diset sebagai 'admin'

// Lakukan hashing password sebelum disimpan ke database
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

// Lakukan validasi data

// Simpan data admin baru ke dalam database
$query = "INSERT INTO admin (username, email, password, about_me, peran) VALUES ('$username', '$email', '$hashed_password', '$about_me', '$peran')";
$result = mysqli_query($koneksi, $query);

if ($result) {
    // Jika berhasil disimpan, beri pesan sukses dan redirect ke halaman lain
    echo "<script>alert('Admin baru berhasil ditambahkan');</script>";
    echo "<script>window.location.href = 'index.php';</script>";
} else {
    // Jika gagal disimpan, beri pesan error
    echo "<script>alert('Gagal menambahkan admin baru');</script>";
}
?>
