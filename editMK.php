<?php
// Memanggil file koneksi.php untuk membuat koneksi
include 'koneksi.php';

// Mengecek apakah di URL ada nilai GET idDosen
if (isset($_GET['kodeMK'])) {
    // Ambil nilai idDosen dari URL dan disimpan dalam variabel $id
    $id = $_GET["kodeMK"];

    // Menampilkan data t_dosen dari database yang mempunyai idDosen=$id
    $query = "SELECT * FROM t_matakuliah WHERE kodeMK='$id'";
    $result = mysqli_query($link, $query);

    // Mengecek apakah query gagal
    if (!$result) {
        die("Query Error: " . mysqli_errno($link) . " - " . mysqli_error($link));
    }

    // Mengambil data dari database dan membuat variabel-variabel untuk menampung data
    // Variabel ini nantinya akan ditampilkan pada form
    $data = mysqli_fetch_assoc($result);
    if ($data) {
        $kodeMK = $data['kodeMK'];
        $namaMK = $data['namaMK'];
        $sks = $data['sks'];
        $jam = $data['jam'];
    } else {
        // Apabila tidak ada data GET idDosen, akan di redirect ke viewdosen.php
        header("Location: viewMK.php");
        exit;
    }
} else {
    // Apabila tidak ada data GET idDosen, akan di redirect ke viewdosen.php
    header("Location: viewMK.php");
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
        <form id="form_matakuliah" action="proses_editMK.php" method="post">
            <fieldset>
                <legend>Edit Data Mahasiswa</legend>
                <p>
                    <label for="kodeMK">KodeMK: </label>
                    <input type="hidden" name="kodeMK" value="<?php echo $kodeMK; ?>">
                    <input type="text" name="idDosenDisabled" id="idDosenDisabled" value="<?php echo $kodeMK; ?>" disabled>
                </p>
                <p>
                    <label for="namaMK">Nama MK: </label>
                    <input type="text" name="namaMK" id="namaMK" value="<?php echo $namaMK; ?>">
                </p>
                <p>
                    <label for="sks">SKS: </label>
                    <input type="text" name="sks" id="sks" value="<?php echo $sks; ?>">
                </p>
                <p>
                    <label for="jam">Jam: </label>
                    <input type="text" name="jam" id="jam" value="<?php echo $jam; ?>">
                </p>
            </fieldset>
            <p>
                <input type="submit" name="edit" value="Update Data">
            </p>
        </form>
    </div>
</body>
</html>
