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
    $nik = $_POST['nik'];
    $nama = $_POST['nama'];
    $alamat = $_POST['alamat'];
    $unit = $_POST['unit'];
    $golongan = $_POST['golongan'];
    $jumlahanak = $_POST['jumlahanak'];
    $harikerja = $_POST['harikerja'];
    $jamkerja = $_POST['jamkerja'];

    if (!empty($nik) && !empty($nama) && !empty($alamat) && !empty($unit) && !empty($golongan) && !empty($jumlahanak) && !empty($harikerja) && !empty($jamkerja)) {
        $data = "$nik;$nama;$alamat;$unit;$golongan;$jumlahanak;$harikerja;$jamkerja\n";
        file_put_contents($file, $data, FILE_APPEND);
        $message = "Data pegawai berhasil ditambahkan!";
        $type = 'success';
    } else {
        $message = "Semua kolom harus diisi!";
        $type = 'error';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Data Pegawai</title>
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
        h2 {
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
        <h1>Tambah Data Pegawai</h1>
    </header>
    <div class="container">
        <h2>Form Tambah Data</h2>
        <form method="POST">

            <label for="nik">NIK:</label>
            <input type="number" id="nik" name="nik" placeholder="Masukkan NIK pegawai" required>

            <label for="nama">Nama:</label>
            <input type="text" id="nama" name="nama" placeholder="Masukkan nama pegawai" required>

            <label for="alamat">Alamat:</label>
            <input type="text" id="alamat" name="alamat" placeholder="Masukkan alamat pegawai" required>

            <label for="unit">Unit:</label>
            <input type="text" id="unit" name="unit" placeholder="Masukkan unit pegawai" required>

            <label for="golongan">Golongan:</label>
            <select name="golongan" id="golongan" required>
            <option value="IV-A">IV-A</option>
            <option value="IV-B">IV-B</option>
            <option value="IV-C">IV-C</option>
            <option value="III-A">III-A</option>
            <option value="III-B">III-B</option>
            <option value="III-C">III-C</option>
            </select>

            <label for="jumlahanak">Jumlah Anak:</label>
            <input type="number" id="jumlahanak" name="jumlahanak" placeholder="Masukkan jumlah anak pegawai" required>

            <label for="harikerja">Hari Kerja:</label>
            <input type="number" id="harikerja" name="harikerja" placeholder="Masukkan hari kerja pegawai" required>

            <label for="jamkerja">Jam Kerja (Per Minggu):</label>
            <input type="number" id="jamkerja" name="jamkerja" placeholder="Masukkan jam kerja pegawai" required>

            <button type="submit">Tambah Data</button>
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