<?php
include "koneksi.php";
session_start();
if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'admin') {
    header("Location: logins.php");
    exit();
}

$service = isset($_GET['service']) ? htmlspecialchars($_GET['service']) : '';

$jam = [];
$sql = "SELECT id, jam FROM treatment WHERE layanan=\"$service\" AND hapus=0 order by jam asc";
$result = mysqli_query($conn, $sql);
$ndata = mysqli_num_rows($result);
if ($ndata > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $jam[] = $row;
    }
} else {
    $jam[] = ['id' => 0, 'jam' => 'Tidak ada jadwal tersedia'];
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_POST['service'] === $service) {
    $jam = $_POST['time'];
    $service = $_POST['service'];

    $jams = "$jam:00";

    if ($service == 'Treatment Acne') {
        $harga = "250.000";
    } else if ($service == 'Hair Treatment') {
        $harga = "100.000";
    } else {
        $harga = "150.000";
    }

    $sql = "select * from treatment where jam=\"$jams\" and layanan=\"$service\" and hapus=0";
    $result = mysqli_query($conn, $sql);
    $ndata = mysqli_num_rows($result);
    if ($ndata == 0) {
        $sql = "insert into treatment (layanan, harga, jam, hapus) values ('$service', '$harga', '$jams', '0')";

        if (mysqli_query($conn, $sql)) {
            header("location: edit_jadwal.php?service=$service");
            exit();
        } else {
            echo "gagal: "  . mysqli_error($conn);
        }
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    $id = $_POST['id'];

    $sql = "select * from treatment where id=\"$id\" and hapus=0";
    $result = mysqli_query($conn, $sql);
    $ndata = mysqli_num_rows($result);
    if ($ndata > 0) {
        $sql = "update treatment set hapus=1 where id=\"$id\"";

        if (mysqli_query($conn, $sql)) {
            header("location: edit_jadwal.php?service=$service");
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
    <style>
        /* Tambahan styling khusus form input time */
        form {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        input[type="time"] {
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
            <p>Edit Jam Layanan <strong><?= $service ?></strong></p>
        </header>

        <section>
            <h2>Jadwal Layanan Aktif</h2>

            <?php if ($ndata > 0): ?>
                <?php foreach ($jam as $j): ?>
                    <div class="jam-item">
                        <span><?= htmlspecialchars($j['jam']); ?></span>
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
            <h2>Tambahkan Jam Baru</h2>
            <form action="" method="POST">
                <input type="hidden" name="service" value="<?= $service ?>">
                <input type="time" name="time" step="900" min="06:00" max="22:00" required>
                <button type="submit" class="success-btn">+ Tambahkan Jam</button>
            </form>
        </section>
        <button class="back-button" onclick="window.location.href='home.php'">← Kembali</button>
    </div>
</body>

</html>