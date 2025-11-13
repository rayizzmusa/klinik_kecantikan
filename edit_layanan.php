<?php
include "koneksi.php";
session_start();
if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'admin') {
    header("Location: logins.php");
    exit();
}

$layanan = [];
$sql = "select* from master_treatment where hapus=0";
$result = mysqli_query($conn, $sql);
$ndata = mysqli_num_rows($result);
if ($ndata > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $layanan[] = $row;
    }
} else {
    $layanan[] = ['id' => 0, 'layanan' => 'Tidak ada jadwal tersedia'];
} 

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['layanan'])) {
    $layanan = $_POST['layanan'];
    $harga = $_POST['harga'];
    $deskripsi = $_POST['deskripsi'];

    $sql = "select * from master_treatment where harga=\"$harga\" and layanan=\"$layanan\" and hapus=0";
    $result = mysqli_query($conn, $sql);
    $ndata = mysqli_num_rows($result);
    if ($ndata == 0) {
        $sql = "insert into master_treatment (layanan, harga, hapus, deskripsi) values ('$layanan', '$harga','0', '$deskripsi')";

        if (mysqli_query($conn, $sql)) {
            header("location: edit_layanan.php");
            exit();
        } else {
            echo "gagal: "  . mysqli_error($conn);
        }
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    $id = $_POST['id'];

    $sql = "select * from master_treatment where id=\"$id\" and hapus=0";
    $result = mysqli_query($conn, $sql);
    $ndata = mysqli_num_rows($result);
    if ($ndata > 0) {
        $sql = "update master_treatment set hapus=1 where id=\"$id\"";

        if (mysqli_query($conn, $sql)) {
            header("location: edit_layanan.php");
            exit();
        } else {
            echo "hapus gagal: "  . mysqli_error($conn);
        }
    }
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Jam - Klinik Kecantikan Merati</title>
    <link rel="stylesheet" href="style_payment.css">
    <link rel="icon" href="logo.png" type="image/png">
    <style>
        /* Tambahan styling khusus form input time */
        form {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        input[type="text"] {
            width: 100%;
            padding: 15px;
            border: 2px solid #e91e63;
            border-radius: 12px;
            font-size: 16px;
            color: #333;
            outline: none;
            background: rgba(255, 255, 255, 0.9);
            transition: all 0.3s ease;
            box-shadow: 0 3px 10px rgba(233, 30, 99, 0.1);
        }

        input[type="time"]:focus {
            border-color: #ff6b9d;
            box-shadow: 0 0 15px rgba(233, 30, 99, 0.3);
        }

        /* Styling untuk daftar jam + tombol hapus */
        .jam-item {
            display: flex;
            align-items: center;
            justify-content: space-between;
            background: linear-gradient(135deg, rgba(233, 30, 99, 0.05) 0%, rgba(255, 107, 157, 0.05) 100%);
            border-radius: 10px;
            border-left: 4px solid #e91e63;
            padding: 12px 15px;
            margin-bottom: 10px;
            animation: slideIn 0.5s ease-out;
        }

        .hapus-btn {
            background: none;
            border: none;
            color: #e91e63;
            font-size: 20px;
            cursor: pointer;
            transition: transform 0.2s ease, color 0.3s ease;
        }

        .hapus-btn:hover {
            color: #c2185b;
            transform: scale(1.2);
        }
    </style>
</head>

<body>
    <div id="payment" class="page active">
        <header>
            <h1>Klinik Kecantikan Merati</h1>
            <p>Edit Layanan</p>
        </header>

        <section>
            <h2>Jadwal Layanan Aktif</h2>

            <?php if ($ndata > 0): ?>
                <?php foreach ($layanan as $j): ?>
                    <div class="jam-item">
                        <span><?= htmlspecialchars($j['layanan']); ?> - Rp. <?= $j['harga']?></span>
                        <form action="" method="POST" style="margin:0;">
                            <input type="hidden" name="id" value="<?= $j['id']; ?>">
                            <button type="submit" class="hapus-btn" title="Hapus jam ini">🗑️</button>
                        </form>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>Tidak ada jadwal tersedia</p>
            <?php endif; ?>
        </section>

        <section>
            <h2>Tambahkan Layanan Baru</h2>
            <form action="" method="POST">
                <input type="text" name="layanan" placeholder="Nama Layanan" required/>
                <input type="text" name="harga" placeholder="Harga" required/>
                <input type="text" name="deskripsi" placeholder="Deskripsi" required/>
                <button type="submit" class="success-btn">+ Tambahkan</button>
            </form>
        </section>
        <button class="back-button" onclick="window.location.href='home.php'">← Kembali</button>
    </div>
</body>

</html>