<?php
include "koneksi.php";
session_start();
if (!isset($_SESSION['username']) && !isset($_SESSION['nama'])) {
    header("Location: logins.php");
    exit();
}

$iduser = $_GET['gid'];
$role = $_GET['as'];

if ($role == 'pelanggan') {
    $data = [];
    $sql = "select * from transaction where id_user=\"$iduser\" and hapus=0 order by id asc";
    $result = mysqli_query($conn, $sql);
    $ndata = mysqli_num_rows($result);
    if ($ndata > 0) {
        while ($fdata = mysqli_fetch_assoc($result)) {
            extract($fdata);
            if ($layanan == 'Treatment Acne') {
                $harga = "Rp. 250.000";
            } else if ($layanan == 'Hair Treatment') {
                $harga = "Rp. 100.000";
            } else {
                $harga = "Rp. 150.000";
            }

            $fdata['harga'] = $harga;
            $data[] = $fdata;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Transaksi - Klinik Kecantikan Merati</title>
    <link rel="stylesheet" href="style_payment.css">
    <link rel="icon" href="logo.png" type="image/png">
</head>

<body>
    <div id="payment" class="page active">
        <header>
            <h1>🧾 Klinik Kecantikan Merati</h1>
            <p>Riwayat Transaksi</p>
        </header>

        <section>
            <h2 style="text-align: center;">
                Riwayat Pembayaran
            </h2>
            <br /><br />
            <?php if (!empty($data)): ?>
                <?php foreach ($data as $dat): ?>
                    <p><b><?= $dat['created_at'] ?></b></p>
                    <p><?= $dat['layanan'] ?></p>
                    <p><b><?= $dat['harga'] ?></b></p>
                    <br /> <br />
                <?php endforeach; ?>
            <?php else: ?>
                <span>belum pernah melakukan transaksi</span>
            <?php endif; ?>
        </section>

        <button class=" back-button" onclick="window.location.href='home.php'">← Kembali ke Home</button>
    </div>
</body>

</html>