<?php
session_start();

if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit;
}

function hitunggaji($golongan, $jamkerja, $jumlahanak, $harikerja) {
    $gajipokok=[
        "IV-A"=>3250000,"IV-B"=>3000000,"IV-C"=>2750000,
        "III-A"=>2500000,"III-B"=>2250000,"III-C"=>2000000
    ];
    if($harikerja/7==$jamkerja/40){
        $gajilembur=0;
    }elseif($harikerja/7>$jamkerja/40){
        $gajilembur=0;
    }elseif($harikerja<7){
        $gajilembur=0;
    }elseif($jamkerja<40){
        $gajilembur=0;
    }else{
        $harilembur=$harikerja/7;
        $waktulembur=$jamkerja-$harilembur*40;
        $gajilembur=$waktulembur*35000;
    }
    $tunjangananak=min($jumlahanak,2)*250000;
    $uangmakan=25000*$harikerja;
    $gaji=$gajipokok[$golongan]+$gajilembur+$tunjangananak+$uangmakan;
    return [
        'gajipokok'=>$gajipokok[$golongan], 
        'gajilembur'=>$gajilembur, 
        'tunjangananak'=>$tunjangananak, 
        'uangmakan'=>$uangmakan, 
        'gaji'=>$gaji,
        'golongan'=>$golongan,
        'jamkerja'=>$jamkerja,
        'jumlahanak'=>$jumlahanak,
        'harikerja'=>$harikerja,
    ];
}

if (isset($_POST['add'])) {
    $file = fopen("pegawai.txt", "a");
    fwrite($file, implode(";", [
        $_POST['nik'], 
        $_POST['nama'], 
        $_POST['alamat'],
        $_POST['unit'], 
        $_POST['golongan'], 
        $_POST['jumlahanak'], 
        $_POST['harikerja'],
        $_POST['jamkerja'],
    ]) . "\n");
    fclose($file);
    header('Location: tampil_data.php');
    exit;
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
            max-width: 800px;
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
        <h1>Gaji Pegawai</h1>
    </header>
    <div class="container">
        <h2>Gaji Pegawai</h2>
        <?php $file = 'pegawai.txt'; ?>
        <?php if (file_exists($file)): ?>
            <?php
            $datapegawai = file($file, FILE_IGNORE_NEW_LINES); 
            ?>
            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Gaji Pokok</th>
                        <th>Gaji Lembur</th>
                        <th>Tunjangan Anak</th>
                        <th>Uang Makan</th>
                        <th>Total Gaji</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($datapegawai as $index => $line): ?>
                        <?php
                        list($nik, $nama, $alamat, $unit, $golongan, $jumlahanak, $harikerja, $jamkerja) 
                        = explode(';', $line);
                        $gaji = hitunggaji($golongan, $jamkerja, 
                        $jumlahanak, $harikerja);
                        ?>
                        <tr>
                            <td><?php echo $index + 1; ?></td>
                            <td><?php echo htmlspecialchars($nama); ?></td>
                            <td><?php echo number_format($gaji['gajipokok'], 0, ',', '.'); ?></td>
                            <td><?php echo number_format($gaji['gajilembur'], 0, ',', '.'); ?></td>
                            <td><?php echo number_format($gaji['tunjangananak'], 0, ',', '.'); ?></td>
                            <td><?php echo number_format($gaji['uangmakan'], 0, ',', '.'); ?></td>
                            <td><?php echo number_format($gaji['gaji'], 0, ',', '.'); ?></td>
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