<?php
// Memanggil file koneksi.php untuk melakukan koneksi database
include 'koneksi.php';

// Mengecek apakah tombol input dari form telah diklik
if (isset($_POST['input'])) {

    // Membuat variabel untuk menampung data dari form
    $kodeMK = $_POST['kodeMK'];
    $namaMK = $_POST['namaMK'];
    $sks = $_POST['sks'];
    $jam = $_POST['jam'];

    // Jalankan query INSERT untuk menambah data ke database
    $query = "INSERT INTO t_matakuliah (kodeMK, namaMK, sks, jam) VALUES ('$kodeMK', '$namaMK', '$sks', '$jam')";
    $result = mysqli_query($link, $query);

    // Periksa query apakah ada error
    if (!$result) {
        die("Query gagal dijalankan: " . mysqli_errno($link) . " - " . mysqli_error($link));
    } else {
        // Melakukan redirect (mengalihkan) ke halaman viewdosen.php jika berhasil
        header("Location: viewMK.php");
        exit();
    }
}
?>
