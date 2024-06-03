<?php
// Memanggil file koneksi.php untuk melakukan koneksi database
include 'koneksi.php';

// Mengecek apakah tombol input dari form telah diklik
if (isset($_POST['input'])) {

    // Membuat variabel untuk menampung data dari form
    $npm = $_POST['npm'];
    $namaMhs = $_POST['namaMhs'];
    $prodi = $_POST['prodi'];
    $alamat = $_POST['alamat'];
    $noHp = $_POST['noHp'];

    // Jalankan query INSERT untuk menambah data ke database
    $query = "INSERT INTO t_mahasiswa (npm, namaMhs, prodi, alamat, noHp) VALUES ('$npm', '$namaMhs', '$prodi', '$alamat', '$noHp')";
    $result = mysqli_query($link, $query);

    // Periksa query apakah ada error
    if (!$result) {
        die("Query gagal dijalankan: " . mysqli_errno($link) . " - " . mysqli_error($link));
    } else {
        // Melakukan redirect (mengalihkan) ke halaman viewdosen.php jika berhasil
        header("Location: viewmahasiswa.php");
        exit();
    }
}
?>
