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
    <h1>Tabel MataKuliah</h1>
    <center><a href="inputMK.php">Input Data</a></center>
    <br/>
    <table border="1">
        <tr>
            <th>kodeMK</th>
            <th>Nama MataKuliah</th>
            <th>sks</th>
            <th>jam</th>
            <th>Pilihan</th>
        </tr>
        <?php
        // jalankan query untuk menampilkan semua data diurutkan ascending berdasarkan IdDosen
        $query = "SELECT * FROM t_matakuliah ORDER BY kodeMK ASC";
        $result = mysqli_query($link, $query);

        // mengecek apakah ada error ketika menjalankan query
        if (!$result) {
            die("Query Error: " . mysqli_errno($link) . " - " . mysqli_error($link));
        }

        // hasil query akan disimpan dalam variabel $data dalam bentuk array kemudian dicetak dengan perulangan while
        while ($data = mysqli_fetch_assoc($result)) {
            // mencetak / menampilkan data
            echo "<tr>";
            echo "<td>{$data['kodeMK']}</td>"; // menampilkan data idDosen
            echo "<td>{$data['namaMK']}</td>";
            echo "<td>{$data['sks']}</td>"; // menampilkan data namaDosen
            echo "<td>{$data['jam']}</td>";
            echo "<td>
                <a href='editMK.php?kodeMK={$data['kodeMK']}'>Edit</a> /
                <a href='hapusMK.php?kodeMK={$data['kodeMK']}' onclick='return confirm(\"Anda yakin akan menghapus data?\")'>Hapus</a>
                </td>";
            echo "</tr>";
        }
        ?>
    </table>
</body>
</html>