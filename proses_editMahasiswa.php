<?php
// Mengecek apakah tombol edit telah diklik
if (isset($_POST['edit'])) {
    // Buat koneksi dengan database
    include("koneksi.php");

    // Membuat variabel untuk menampung data dari form edit
    $npm = $_POST['npm'];
    $namaMhs = $_POST['namaMhs'];
    $prodi = $_POST['prodi'];
    $alamat = $_POST['alamat'];
    $noHp = $_POST['noHp'];

    // Buat dan jalankan query UPDATE
    $query = "UPDATE t_mahasiswa SET npm = '$npm', namaMhs ='$namaMhs',prodi = '$prodi', alamat= '$alamat', noHp= '$noHp'";
    $result = mysqli_query($link, $query);

    // Periksa hasil query apakah ada error
    if (!$result) {
        die("Query gagal dijalankan: " . mysqli_errno($link) . " - " . mysqli_error($link));
    }

    // Lakukan redirect ke halaman viewdosen.php
    header("Location: viewmahasiswa.php");
    exit();
}
?>