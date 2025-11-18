<?php
include "koneksi.php";
session_start();
if (!isset($_SESSION['username']) && !isset($_SESSION['nama'])) {
    header("Location: logins.php");
    exit();
}
$service = $_GET['service'];
$name = $_GET['name'];
$time = $_GET['time'];

$sql = "select * from user where username=\"$name\" and role=\"pelanggan\"";
$result = mysqli_query($conn, $sql);
$fdata = mysqli_fetch_assoc($result);
$nama = $fdata['nama'];

$sql = "select * from master_treatment where id=\"$service\" and hapus=0";
$result = mysqli_query($conn, $sql);
$fdata = mysqli_fetch_assoc($result);
$layanan = $fdata['layanan'];
$harga = $fdata['harga'];
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice - Klinik Kecantikan Merati</title>
    <link rel="stylesheet" href="style_payment.css">
    <link rel="icon" href="logo.png" type="image/png">
</head>

<body>
    <div id="payment" class="page active">
        <header>
            <h1>🧾 Klinik Kecantikan Merati</h1>
            <p>Invoice Layanan</p>
        </header>

        <section>
            <h2 style="text-align: center;">
                Pembayaran Berhasil
            </h2>
            <br /><br />
            <p><strong>Pelanggan:</strong> <?php echo $nama; ?></p>
            <p><strong>Layanan:</strong> <?php echo $layanan; ?></p>
            <p><strong>Waktu:</strong> <?php echo htmlspecialchars($time); ?></p>
            <p><strong>Total Pembayaran:</strong> <?php echo $harga; ?></p>
            <span>Terimakasih telah menggunakan layanan kami, <b>Sampai Jumpa Kembali &#128522;</b></span>
        </section>

        <button class=" back-button" onclick="window.location.href='home.php'">← Kembali ke Home</button>
    </div>
</body>

</html>