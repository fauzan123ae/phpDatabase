<?php
// Buka koneksi dengan MySQL
include("koneksi.php");

// Mengecek apakah di URL ada GET idDosen
if (isset($_GET["npm"])) {

    // Menyimpan variabel id dari URL ke dalam variabel $id
    $npm = $_GET["npm"];

    // Jalankan query DELETE untuk menghapus data
    $query = "DELETE FROM t_mahasiswa WHERE npm='$npm'";
    $hasil_query = mysqli_query($link, $query);

    // Periksa query, apakah ada kesalahan
    if (!$hasil_query) {
        die("Gagal menghapus data: " . mysqli_errno($link) . " - " . mysqli_error($link));
    }

    // Melakukan redirect ke halaman viewdosen.php
    header("Location: viewmahasiswa.php");
    exit();
} else {
    // Jika tidak ada idDosen di URL, redirect ke halaman viewdosen.php
    header("Location: viewmahasiswa.php");
    exit();
}
?>