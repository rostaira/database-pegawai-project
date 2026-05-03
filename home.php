<?php
session_start();
if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home - Sistem Administrasi Penggajian Pegawai</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background: #f4f4f9;
        }
        header {
            background: #007bff;
            color: white;
            padding: 15px 20px;
            text-align: center;
        }
        header h1 {
            margin: 0;
            font-size: 24px;
        }
        .container {
            max-width: 900px;
            margin: 20px auto;
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
        }
        .welcome {
            text-align: center;
            margin-bottom: 20px;
        }
        .welcome h2 {
            margin: 0;
            color: #333;
        }
        .menu {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 15px;
            margin-top: 20px;
        }
        .menu a {
            display: inline-block;
            text-align: center;
            background: #007bff;
            color: white;
            text-decoration: none;
            padding: 15px 20px;
            border-radius: 8px;
            font-size: 16px;
            transition: background-color 0.3s;
            width: 200px;
        }
        .menu a:hover {
            background-color: #0056b3;
        }
        footer {
            text-align: center;
            margin-top: 20px;
            padding: 10px;
            background: #333;
            color: white;
            border-radius: 8px;
        }
    </style>
</head>
<body>
    <header>
        <h1>Sistem Administrasi Penggajian Pegawai</h1>
    </header>
    <div class="container">
        <div class="welcome">
            <h2>Selamat Datang, <?php echo $_SESSION['username']; ?>!</h2>
            <p>Silakan pilih menu yang tersedia untuk mengelola data pegawai.</p>
        </div>
        <div class="menu">
            <a href="tambahdata.php">Tambah Data</a>
            <a href="ubahdata.php">Ubah Data</a>
            <a href="hapusdata.php">Hapus Data</a>
            <a href="caridata.php">Cari Data</a>
            <a href="tampilkandata.php">Tampilkan Data</a>
            <a href="gaji.php">Tampilkan Gaji</a>
            <a href="logout.php" style="background: #dc3545;">Logout</a>
        </div>
    </div>
    <footer>
        &copy; 2024 Sistem Administrasi Penggajian Pegawai - All Rights Reserved
    </footer>
</body>
</html>