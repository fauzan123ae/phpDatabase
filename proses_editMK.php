<?php
// Mengecek apakah tombol edit telah diklik
if (isset($_POST['edit'])) {
    // Buat koneksi dengan database
    include("koneksi.php");

    // Membuat variabel untuk menampung data dari form edit
    $kodeMK = $_POST['kodeMK'];
    $namaMK = $_POST['namaMK'];
    $sks = $_POST['sks'];
    $jam = $_POST['jam'];

    // Buat dan jalankan query UPDATE
    $query = "UPDATE t_matakuliah SET kodeMK = '$kodeMK', namaMK ='$namaMK',sks = '$sks', jam= '$jam'";
    $result = mysqli_query($link, $query);

    // Periksa hasil query apakah ada error
    if (!$result) {
        die("Query gagal dijalankan: " . mysqli_errno($link) . " - " . mysqli_error($link));
    }

    // Lakukan redirect ke halaman viewdosen.php
    header("Location: viewMK.php");
    exit();
}
?>