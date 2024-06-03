<?php
include 'koneksi.php';

$search = $_POST['search'];

$sql = "SELECT * FROM t_mahasiswa WHERE namaMhs LIKE '%$search%'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>{$row['npm']}</td>
                <td>{$row['namaMhs']}</td>
                <td>{$row['prodi']}</td>
                <td>{$row['alamat']}</td>
                <td>{$row['noHp']}</td>
                <td>
                    <button onclick='editData({$row['npm']})'>Edit</button>
                    <button onclick='deleteData({$row['npm']})'>Delete</button>
                </td>
            </tr>";
    }
} else {
    echo "<tr><td colspan='6'>No results found</td></tr>";
}
$conn->close();
?>
