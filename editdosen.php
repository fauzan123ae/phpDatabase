<?php
// Memanggil file koneksi.php untuk membuat koneksi
include 'koneksi.php';

// Mengecek apakah di URL ada nilai GET idDosen
if (isset($_GET['idDosen'])) {
    // Ambil nilai idDosen dari URL dan disimpan dalam variabel $id
    $id = $_GET["idDosen"];

    // Menampilkan data t_dosen dari database yang mempunyai idDosen=$id
    $query = "SELECT * FROM t_dosen WHERE idDosen='$id'";
    $result = mysqli_query($link, $query);

    // Mengecek apakah query gagal
    if (!$result) {
        die("Query Error: " . mysqli_errno($link) . " - " . mysqli_error($link));
    }

    // Mengambil data dari database dan membuat variabel-variabel untuk menampung data
    // Variabel ini nantinya akan ditampilkan pada form
    $data = mysqli_fetch_assoc($result);
    if ($data) {
        $idDosen = $data["idDosen"];
        $namaDosen = $data["namaDosen"];
        $noHP = $data["noHP"];
    } else {
        // Apabila tidak ada data GET idDosen, akan di redirect ke viewdosen.php
        header("Location: viewdosen.php");
        exit;
    }
} else {
    // Apabila tidak ada data GET idDosen, akan di redirect ke viewdosen.php
    header("Location: viewdosen.php");
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
        <form id="form_mahasiswa" action="proses_editdosen.php" method="post">
            <fieldset>
                <legend>Edit Data Dosen</legend>
                <p>
                    <label for="idDosen">ID: </label>
                    <input type="hidden" name="idDosen" value="<?php echo $idDosen; ?>">
                    <input type="text" name="idDosenDisabled" id="idDosenDisabled" value="<?php echo $idDosen; ?>" disabled>
                </p>
                <p>
                    <label for="namaDosen">Nama Dosen: </label>
                    <input type="text" name="namaDosen" id="namaDosen" value="<?php echo $namaDosen; ?>">
                </p>
                <p>
                    <label for="noHP">No HP: </label>
                    <input type="text" name="noHP" id="noHP" value="<?php echo $noHP; ?>">
                </p>
            </fieldset>
            <p>
                <input type="submit" name="edit" value="Update Data">
            </p>
        </form>
    </div>
</body>
</html>
