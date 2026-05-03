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
    $namahapus = $_POST['namahapus'];
    $found = false;

    if (file_exists($file)) {
        $data = file($file, FILE_IGNORE_NEW_LINES);
        foreach ($data as $key => $line) {
            list($nik,$nama,$alamat,$unit,$golongan,$jumlahanak,$harikerja,$jamkerja) = explode(';', $line);
            if (strtolower(trim($nama)) === strtolower(trim($namahapus))) {
                unset($data[$key]);
                $found = true;
                break;
            }
        }
        if ($found) {
            file_put_contents($file, implode("\n", $data));
            $message = "Data pegawai dengan nama '$namahapus' berhasil dihapus!";
            $type = 'success';
        } else {
            $message = "Data dengan nama '$namahapus' tidak ditemukan.";
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
    <title>Hapus Data Pegawai</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 0;
        }
        header {
            background: #dc3545;
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
        input[type="text"] {
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
            width: 580px;
        }
        button {
            background-color: #dc3545;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }
        button:hover {
            background-color: #a71d2a;
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
        <h1>Hapus Data Pegawai</h1>
    </header>
    <div class="container">
        <h2>Form Hapus Data Pegawai</h2>
        <form method="POST">
            <label for="namahapus">Nama yang Akan Dihapus:</label>
            <input type="text" id="namahapus" name="namahapus" placeholder="Masukkan nama yang ingin dihapus" required>

            <button type="submit">Hapus Data</button>
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