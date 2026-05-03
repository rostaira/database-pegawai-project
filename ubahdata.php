<?php
session_start();
if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit;
}

$file = 'pegawai.txt';
$message = '';
$type = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $namacari = $_POST['namacari'];
    $nikbaru = $_POST['nikbaru'];
    $namabaru = $_POST['namabaru'];
    $alamatbaru = $_POST['alamatbaru'];
    $unitbaru = $_POST['unitbaru'];
    $golonganbaru = $_POST['golongan'];
    $jumlahanakbaru = $_POST['jumlahanakbaru'];
    $harikerjabaru = $_POST['harikerjabaru'];
    $jamkerjabaru = $_POST['jamkerjabaru'];
    $found = false;

    if (file_exists($file)) {
        $data = file($file, FILE_IGNORE_NEW_LINES);
        foreach ($data as $key => $line) {
            list($nik,$nama,$alamat,$unit,$golonganbaru,$jumlahanak,$harikerja,$jamkerja) = explode(';', $line);
            if (strtolower(trim($nama)) === strtolower(trim($namacari))) {
                $data[$key] = "$nikbaru;$namabaru;$alamatbaru;$unitbaru;$golonganbaru;$jumlahanakbaru;$harikerjabaru;$jamkerjabaru";
                $found = true;
                break;
            }
        }
        if ($found) {
            file_put_contents($file, implode("\n", $data));
            $message = "Data pegawai berhasil diubah!";
            $type = 'success';
        } else {
            $message = "Data dengan nama '$namacari' tidak ditemukan.";
            $type = 'error';
        }
    } else {
        $message = "File database pegawai tidak ditemukan!";
        $type = 'error';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ubah Data Pegawai</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 0;
        }
        header {
            background: #007bff;
            color: white;
            text-align: center;
            padding: 15px 20px;
        }
        header h1 {
            margin: 0;
        }
        .container {
            max-width: 600px;
            margin: 30px auto;
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
        }
        .container h2 {
            color: #333;
            margin-bottom: 20px;
            text-align: center;
        }
        form {
            display: flex;
            flex-direction: column;
        }
        label {
            margin-bottom: 5px;
            font-weight: bold;
        }
        input[type="text"], input[type="number"] {
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
            width: 580px;
        }
        select {
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
            width: 600px;
        }
        button {
            background-color: #007bff;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }
        button:hover {
            background-color: #0056b3;
        }
        .message {
            margin-top: 20px;
            padding: 10px;
            border-radius: 5px;
            text-align: center;
            font-weight: bold;
        }
        .success {
            color: #155724;
            background-color: #d4edda;
            border: 1px solid #c3e6cb;
        }
        .error {
            color: #721c24;
            background-color: #f8d7da;
            border: 1px solid #f5c6cb;
        }
        .back-link {
            display: block;
            margin-top: 20px;
            text-align: center;
            text-decoration: none;
            color: #007bff;
        }
        .back-link:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <header>
        <h1>Ubah Data Pegawai</h1>
    </header>
    <div class="container">
        <h2>Form Ubah Data Pegawai</h2>
        <form method="POST">
            <label for="namacari">Nama yang Dicari:</label>
            <input type="text" id="namacari" name="namacari" placeholder="Masukkan nama yang ingin diubah" required>
            
            <label for="nikbaru">NIK Baru:</label>
            <input type="number" id="nikbaru" name="nikbaru" placeholder="Masukkan NIK baru" required>

            <label for="namabaru">Nama Baru:</label>
            <input type="text" id="namabaru" name="namabaru" placeholder="Masukkan nama baru" required>

            <label for="alamatbaru">Alamat Baru:</label>
            <input type="text" id="alamatbaru" name="alamatbaru" placeholder="Masukkan alamat baru" required>

            <label for="unitbaru">Unit Baru:</label>
            <input type="text" id="unitbaru" name="unitbaru" placeholder="Masukkan unit baru" required>

            <label for="golonga">Golongan:</label>
            <select name="golongan" id="golongan" required>
            <option value="IV-A">IV-A</option>
            <option value="IV-B">IV-B</option>
            <option value="IV-C">IV-C</option>
            <option value="III-A">III-A</option>
            <option value="III-B">III-B</option>
            <option value="III-C">III-C</option>
            </select>

            <label for="jumlahanakbaru">Jumlah Anak Baru:</label>
            <input type="number" id="jumlahanakbaru" name="jumlahanakbaru"placeholder="Masukkan jumlah anak baru"required>

            <label for="harikerjabaru">Hari Kerja Baru:</label>
            <input type="number" id="harikerjabaru" name="harikerjabaru" placeholder="Masukkan hari kerja baru" required>

            <label for="jamkerjabaru">Jam Kerja Baru:</label>
            <input type="number" id="jamkerjabaru" name="jamkerjabaru" placeholder="Masukkan jam kerja baru" required>


            <button type="submit">Ubah Data</button>
        </form>

        <?php if ($message): ?>
            <div class="message <?php echo $type; ?>">
                <?php echo $message; ?>
            </div>
        <?php endif; ?>

        <a href="home.php" class="back-link">Kembali ke Halaman Utama</a>
    </div>
</body>
</html>