<?php
include 'koneksi.php'; // memanggil file koneksi.php untuk melakukan koneksi database
?>

<!DOCTYPE html>
<html>
<head>
    <style>
        table {
            width: 840px;
            margin: auto;
        }
        h1 {
            text-align: center;
        }
    </style>
</head>
<body>
    <h1>Tabel Mahasiswa</h1>
    <center><a href="inputMhs.php">Input Data</a></center>
    <br/>
    <table border="1">
        <tr>
            <th>NPM</th>
            <th>Nama Mahasiswa</th>
            <th>Prodi</th>
            <th>Alamat</th>
            <th>No HP</th>
            <th>Pilihan</th>
        </tr>
        <?php
        // jalankan query untuk menampilkan semua data diurutkan ascending berdasarkan IdDosen
        $query = "SELECT * FROM t_mahasiswa ORDER BY npm ASC";
        $result = mysqli_query($link, $query);

        // mengecek apakah ada error ketika menjalankan query
        if (!$result) {
            die("Query Error: " . mysqli_errno($link) . " - " . mysqli_error($link));
        }

        // hasil query akan disimpan dalam variabel $data dalam bentuk array kemudian dicetak dengan perulangan while
        while ($data = mysqli_fetch_assoc($result)) {
            // mencetak / menampilkan data
            echo "<tr>";
            echo "<td>{$data['npm']}</td>"; // menampilkan data idDosen
            echo "<td>{$data['namaMhs']}</td>";
            echo "<td>{$data['prodi']}</td>"; // menampilkan data namaDosen
            echo "<td>{$data['alamat']}</td>";
            echo "<td>{$data['noHp']}</td>"; // menampilkan data noHP
            echo "<td>
                <a href='editMahasiswa.php?npm={$data['npm']}'>Edit</a> /
                <a href='hapusMahasiswa.php?npm={$data['npm']}' onclick='return confirm(\"Anda yakin akan menghapus data?\")'>Hapus</a>
                </td>";
            echo "</tr>";
        }
        ?>
    </table>
</body>
</html>