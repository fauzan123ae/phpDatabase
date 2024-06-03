<?php
// Variabel koneksi dengan database MySQL
$host = "localhost";
$user = "root";
$paswd = "";
$name = "dbtes";

// Proses koneksi
$link = mysqli_connect($host, $user, $paswd, $name);

// Periksa koneksi, jika gagal akan menampilkan pesan error
if (!$link) {
    die("Koneksi dengan database gagal: " . mysqli_connect_errno() . " - " . mysqli_connect_error());
}
?>
