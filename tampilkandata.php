<?php
session_start();
if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit;
}

$file = 'pegawai.txt';
$datapegawai = [];

if (file_exists($file)) {
$datapegawai = file($file, FILE_IGNORE_NEW_LINES);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tampilan Data Pegawai</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 0;
        }
        header {
            background: #28a745;
            color: white;
            text-align: center;
            padding: 15px 20px;
        }
        header h1 {
            margin: 0;
        }
        .container {
            max-width: 1000px;
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
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        table th, table td {
            padding: 10px;
            text-align: left;
            border: 1px solid #ddd;
        }
        table th {
            background-color: #28a745;
            color: white;
        }
        table tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        table tr:hover {
            background-color: #f1f1f1;
        }
        .no-data {
            text-align: center;
            font-style: italic;
            color: #666;
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
        <h1>Data Pegawai</h1>
    </header>
    <div class="container">
        <h2>Daftar Data Pegawai</h2>
        <?php if (count($datapegawai) > 0): ?>
            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>NIK</th>
                        <th>Nama</th>
                        <th>Alamat</th>
                        <th>Unit</th>
                        <th>Golongan</th>
                        <th>Jumlah Anak</th>
                        <th>Hari Kerja</th>
                        <th>Jam Kerja</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($datapegawai as $index => $line): ?>
                        <?php list($nik,$nama,$alamat,$unit,$golongan,$jumlahanak,$harikerja,$jamkerja) = explode(';', $line); ?>
                        <tr>
                            <td><?php echo $index + 1; ?></td>
                            <td><?php echo htmlspecialchars($nik); ?></td>
                            <td><?php echo htmlspecialchars($nama); ?></td>
                            <td><?php echo htmlspecialchars($alamat); ?></td>
                            <td><?php echo htmlspecialchars($unit); ?></td>
                            <td><?php echo htmlspecialchars($golongan); ?></td>
                            <td><?php echo htmlspecialchars($jumlahanak); ?></td>
                            <td><?php echo htmlspecialchars($harikerja); ?></td>
                            <td><?php echo htmlspecialchars($jamkerja); ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p class="no-data">Tidak ada data pegawai yang tersedia.</p>
        <?php endif; ?>
        <a href="home.php" class="back-link">Kembali ke Halaman Utama</a>
    </div>
</body>
</html>