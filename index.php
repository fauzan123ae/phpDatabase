<?php
include 'koneksi.php';

// Fungsi untuk mencari data berdasarkan nama pada tabel t_dosen
function searchDosen($keyword)
{
    global $link;
    $query = "SELECT * FROM t_dosen WHERE namaDosen LIKE '%$keyword%'";
    return mysqli_query($link, $query);
}

// Fungsi untuk mencari data berdasarkan nama pada tabel t_mahasiswa
function searchMahasiswa($keyword)
{
    global $link;
    $query = "SELECT * FROM t_mahasiswa WHERE namaMhs LIKE '%$keyword%'";
    return mysqli_query($link, $query);
}

// Fungsi untuk mencari data berdasarkan nama pada tabel t_matakuliah
function searchMatakuliah($keyword)
{
    global $link;
    $query = "SELECT * FROM t_matakuliah WHERE namaMK LIKE '%$keyword%'";
    return mysqli_query($link, $query);
}

// Initialize results
$resultDosen = $resultMahasiswa = $resultMatakuliah = null;

// Handle search
if (isset($_GET['search'])) {
    $keyword = $_GET['search'];
    $resultDosen = searchDosen($keyword);
    $resultMahasiswa = searchMahasiswa($keyword);
    $resultMatakuliah = searchMatakuliah($keyword);
} else {
    // Jika form pencarian tidak di-submit, tampilkan semua data
    $resultDosen = mysqli_query($link, "SELECT * FROM t_dosen");
    $resultMahasiswa = mysqli_query($link, "SELECT * FROM t_mahasiswa");
    $resultMatakuliah = mysqli_query($link, "SELECT * FROM t_matakuliah");
}
// Handle create dan delete
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['create'])) {
        $table = $_POST['table'];
        if ($table == 'dosen') {
            $namaDosen = $_POST['namaDosen'];
            $noHP = $_POST['noHP'];
            $query = "INSERT INTO t_dosen (namaDosen, noHP) VALUES ('$namaDosen', '$noHP')";
        } elseif ($table == 'mahasiswa') {
            $npm = $_POST['npm'];
            $namaMhs = $_POST['namaMhs'];
            $prodi = $_POST['prodi'];
            $alamat = $_POST['alamat'];
            $noHP = $_POST['noHP'];
            $query = "INSERT INTO t_mahasiswa (npm, namaMhs, prodi, alamat, noHP) VALUES ('$npm', '$namaMhs', '$prodi', '$alamat', '$noHP')";
        } elseif ($table == 'matakuliah') {
            $kodeMK = $_POST['kodeMK'];
            $namaMK = $_POST['namaMK'];
            $sks = $_POST['sks'];
            $jam = $_POST['jam'];
            $query = "INSERT INTO t_matakuliah (kodeMK, namaMK, sks, jam) VALUES ('$kodeMK', '$namaMK', '$sks', '$jam')";
        }
        mysqli_query($link, $query);
    } elseif (isset($_POST['delete'])) {
        $id = $_POST['id'];
        $table = $_POST['table'];
        if ($table == 'dosen') {
            $query = "DELETE FROM t_dosen WHERE idDosen='$id'";
        } elseif ($table == 'mahasiswa') {
            $query = "DELETE FROM t_mahasiswa WHERE npm='$id'";
        } elseif ($table == 'matakuliah') {
            $query = "DELETE FROM t_matakuliah WHERE kodeMK='$id'";
        }
        mysqli_query($link, $query);
    }
    header("Location: " . $_SERVER['PHP_SELF']);
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>CRUD Mahasiswa, Dosen, Matakuliah</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .container {
            margin-top: 20px;
        }
        .action-buttons input[type="submit"] {
            margin: 2px;
        }
        .modal .modal-body input {
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
<div class="container">
    <h2 class="mt-4">Data Dosen</h2>
    <div class="search-bar mb-3">
        <form method="GET" action="">
            <input type="text" name="search" class="form-control" placeholder="Cari Nama Dosen..." style="width: 300px; display: inline-block;">
            <input type="submit" value="Cari" class="btn btn-dark">
        </form>
    </div>
    <button type="button" class="btn btn-dark mb-3" data-toggle="modal" data-target="#addDosenModal">Tambah Dosen</button>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID Dosen</th>
                <th>Nama Dosen</th>
                <th>No HP</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = mysqli_fetch_assoc($resultDosen)) { ?>
                <tr>
                    <td><?php echo $row['idDosen']; ?></td>
                    <td><?php echo $row['namaDosen']; ?></td>
                    <td><?php echo $row['noHP']; ?></td>
                    <td class="action-buttons">
                        <form method="POST" action="">
                            <input type="hidden" name="id" value="<?php echo $row['idDosen']; ?>">
                            <input type="hidden" name="table" value="dosen">
                            <input type="submit" name="delete" value="Delete" class="btn btn-danger btn-sm">
                        </form>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>

    <h2 class="mt-4">Data Mahasiswa</h2>
    <div class="search-bar mb-3">
        <form method="GET" action="">
            <input type="text" name="search" class="form-control" placeholder="Cari Nama Mahasiswa..." style="width: 300px; display: inline-block;">
            <input type="submit" value="Cari" class="btn btn-dark">
        </form>
    </div>
    <button type="button" class="btn btn-dark mb-3" data-toggle="modal" data-target="#addMahasiswaModal">Tambah Mahasiswa</button>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>NPM</th>
                <th>Nama Mahasiswa</th>
                <th>Prodi</th>
                <th>Alamat</th>
                <th>No HP</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = mysqli_fetch_assoc($resultMahasiswa)) { ?>
                <tr>
                    <td><?php echo $row['npm']; ?></td>
                    <td><?php echo $row['namaMhs']; ?></td>
                    <td><?php echo $row['prodi']; ?></td>
                    <td><?php echo $row['alamat']; ?></td>
                    <td><?php echo $row['noHp']; ?></td>
                    <td class="action-buttons">
                        <form method="POST" action="">
                            <input type="hidden" name="id" value="<?php echo $row['npm']; ?>">
                            <input type="hidden" name="table" value="mahasiswa">
                            <input type="submit" name="delete" value="Delete" class="btn btn-danger btn-sm">
                        </form>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>

    <h2 class="mt-4">Data Matakuliah</h2>
    <div class="search-bar mb-3">
        <form method="GET" action="">
            <input type="text" name="search" class="form-control" placeholder="Cari Nama Matakuliah..." style="width: 300px; display: inline-block;">
            <input type="submit" value="Cari" class="btn btn-dark">
        </form>
    </div>
    <button type="button" class="btn btn-dark mb-3" data-toggle="modal" data-target="#addMatakuliahModal">Tambah Matakuliah</button>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Kode MK</th>
                <th>Nama MK</th>
                <th>SKS</th>
                <th>Jam</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = mysqli_fetch_assoc($resultMatakuliah)) { ?>
                <tr>
                    <td><?php echo $row['kodeMK']; ?></td>
                    <td><?php echo $row['namaMK']; ?></td>
                    <td><?php echo $row['sks']; ?></td>
                    <td><?php echo $row['jam']; ?></td>
                    <td class="action-buttons">
                        <form method="POST" action="">
                            <input type="hidden" name="id" value="<?php echo $row['kodeMK']; ?>">
                            <input type="hidden" name="table" value="matakuliah">
                            <input type="submit" name="delete" value="Delete" class="btn btn-danger btn-sm">
                        </form>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>

    <!-- Modal for Adding Dosen -->
    <div class="modal fade" id="addDosenModal" tabindex="-1" role="dialog" aria-labelledby="addDosenModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addDosenModalLabel">Tambah Dosen</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="POST" action="">
                    <div class="modal-body">
                        <input type="hidden" name="table" value="dosen">
                        <input type="text" name="namaDosen" class="form-control" placeholder="Nama Dosen" required>
                        <input type="text" name="noHP" class="form-control" placeholder="No HP" required>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <input type="submit" name="create" value="Tambah" class="btn btn-dark">
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal for Adding Mahasiswa -->
    <div class="modal fade" id="addMahasiswaModal" tabindex="-1" role="dialog" aria-labelledby="addMahasiswaModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addMahasiswaModalLabel">Tambah Mahasiswa</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="POST" action="">
                    <div class="modal-body">
                        <input type="hidden" name="table" value="mahasiswa">
                        <input type="text" name="npm" class="form-control" placeholder="NPM" required>
                        <input type="text" name="namaMhs" class="form-control" placeholder="Nama Mahasiswa" required>
                        <input type="text" name="prodi" class="form-control" placeholder="Prodi" required>
                        <input type="text" name="alamat" class="form-control" placeholder="Alamat" required>
                        <input type="text" name="noHP" class="form-control" placeholder="No HP" required>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <input type="submit" name="create" value="Tambah" class="btn btn-dark">
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal for Adding Matakuliah -->
    <div class="modal fade" id="addMatakuliahModal" tabindex="-1" role="dialog" aria-labelledby="addMatakuliahModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addMatakuliahModalLabel">Tambah Matakuliah</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="POST" action="">
                    <div class="modal-body">
                        <input type="hidden" name="table" value="matakuliah">
                        <input type="text" name="kodeMK" class="form-control" placeholder="Kode MK" required>
                        <input type="text" name="namaMK" class="form-control" placeholder="Nama MK" required>
                        <input type="text" name="sks" class="form-control" placeholder="SKS" required>
                        <input type="text" name="jam" class="form-control" placeholder="Jam" required>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <input type="submit" name="create" value="Tambah" class="btn btn-dark">
                    </div>
                </form>
            </div>
        </div>
    </div>

</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
