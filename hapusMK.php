<?php
// Buka koneksi dengan MySQL
include("koneksi.php");

// Mengecek apakah di URL ada GET idDosen
if (isset($_GET["kodeMK"])) {

    // Menyimpan variabel id dari URL ke dalam variabel $id
    $kodeMK = $_GET["kodeMK"];

    // Jalankan query DELETE untuk menghapus data
    $query = "DELETE FROM t_matakuliah WHERE kodeMK='$kodeMK'";
    $hasil_query = mysqli_query($link, $query);

    // Periksa query, apakah ada kesalahan
    if (!$hasil_query) {
        die("Gagal menghapus data: " . mysqli_errno($link) . " - " . mysqli_error($link));
    }

    // Melakukan redirect ke halaman viewdosen.php
    header("Location: viewMK.php");
    exit();
} else {
    // Jika tidak ada idDosen di URL, redirect ke halaman viewdosen.php
    header("Location: viewMK.php");
    exit();
}
?>