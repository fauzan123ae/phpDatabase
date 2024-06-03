<?php
include 'koneksi.php';

$search = $_POST['search'];

$sql = "SELECT * FROM t_matakuliah WHERE namaMK LIKE '%$search%'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>{$row['kodeMK']}</td>
                <td>{$row['namaMK']}</td>
                <td>{$row['sks']}</td>
                <td>{$row['jam']}</td>
                <td>
                    <button onclick='editData({$row['kodeMK']})'>Edit</button>
                    <button onclick='deleteData({$row['kodeMK']})'>Delete</button>
                </td>
            </tr>";
    }
} else {
    echo "<tr><td colspan='5'>No results found</td></tr>";
}
$conn->close();
?>
