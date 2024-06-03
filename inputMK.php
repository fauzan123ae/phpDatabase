<!DOCTYPE html>
<html>
<head>
    <style>
        h1 {
            text-align: center;
        }
        .container {
            width: 400px;
            margin: auto;
        }
    </style>
</head>
<body>
    <h1>Input Data</h1>
    <div class="container">
        <form id="form_matakuliah" action="proses_inputMK.php" method="post">
            <fieldset>
                <legend>Input Data Matakuliah</legend>
                <p>
                    <label for="kodeMK">KodeMK: </label>
                    <input type="text" name="kodeMK" id="kodeMK" required>
                </p>
                <p>
                    <label for="namaMK">Nama MK: </label>
                    <input type="text" name="namaMK" id="namaMK" required>
                </p>
                <p>
                    <label for="sks">SKS: </label>
                    <input type="text" name="sks" id="sks" required>
                </p>
                <p>
                    <label for="jam">Jam: </label>
                    <input type="text" name="jam" id="jam" required>
    </p>
            </fieldset>
            <p>
                <input type="submit" name="input" value="Simpan">
            </p>
        </form>
    </div>
</body>
</html>
