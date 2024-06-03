<?php
// Memanggil file koneksi.php untuk membuat koneksi
include 'koneksi.php';

// Mengecek apakah di URL ada nilai GET idDosen
if (isset($_GET['npm'])) {
    // Ambil nilai idDosen dari URL dan disimpan dalam variabel $id
    $id = $_GET["npm"];

    // Menampilkan data t_dosen dari database yang mempunyai idDosen=$id
    $query = "SELECT * FROM t_mahasiswa WHERE npm='$id'";
    $result = mysqli_query($link, $query);

    // Mengecek apakah query gagal
    if (!$result) {
        die("Query Error: " . mysqli_errno($link) . " - " . mysqli_error($link));
    }

    // Mengambil data dari database dan membuat variabel-variabel untuk menampung data
    // Variabel ini nantinya akan ditampilkan pada form
    $data = mysqli_fetch_assoc($result);
    if ($data) {
        $npm =  $data['npm'];
        $namaMhs =  $data['namaMhs'];
        $prodi = $data['prodi'];
        $alamat =  $data['alamat'];
        $noHp =  $data['noHp'];
    } else {
        // Apabila tidak ada data GET idDosen, akan di redirect ke viewdosen.php
        header("Location: viewmahasiswa.php");
        exit;
    }
} else {
    // Apabila tidak ada data GET idDosen, akan di redirect ke viewdosen.php
    header("Location: viewmahasiswa.php");
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <style>
        .container {
            width: 400px;
            margin: auto;
            text-align: center;
        }
    </style>
</head>
<body>
    <h1>Edit Data</h1>
    <div class="container">
        <form id="form_mahasiswa" action="proses_editMahasiswa.php" method="post">
            <fieldset>
                <legend>Edit Data Mahasiswa</legend>
                <p>
                    <label for="npm">NPM: </label>
                    <input type="hidden" name="npm" value="<?php echo $npm; ?>">
                    <input type="text" name="idDosenDisabled" id="idDosenDisabled" value="<?php echo $npm; ?>" disabled>
                </p>
                <p>
                    <label for="namaMhs">Nama Dosen: </label>
                    <input type="text" name="namaMhs" id="namaMhs" value="<?php echo $namaMhs; ?>">
                </p>
                <p>
                    <label for="prodi">Prodi: </label>
                    <input type="text" name="prodi" id="prodi" value="<?php echo $prodi; ?>">
                </p>
                <p>
                    <label for="alamat">Alamat: </label>
                    <input type="text" name="alamat" id="alamat" value="<?php echo $alamat; ?>">
                </p>
                <p>
                    <label for="noHp">No HP: </label>
                    <input type="text" name="noHp" id="noHp" value="<?php echo $noHp; ?>">
                </p>
            </fieldset>
            <p>
                <input type="submit" name="edit" value="Update Data">
            </p>
        </form>
    </div>
</body>
</html>
