<?php
session_start();
if (!isset($_SESSION['username']) && !isset($_SESSION['nama'])) {
    header("Location: logins.php");
    exit();
}
$service = $_GET['service'];
$name = $_GET['name'];
$time = $_GET['time'];

if ($service == 'Treatment Acne') {
    $harga = "Rp. 250.000";
} else if ($service == 'Hair Treatment') {
    $harga = "Rp. 100.000";
} else {
    $harga = "Rp. 150.000";
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice - Klinik Kecantikan Merati</title>
    <link rel="stylesheet" href="style_payment.css">
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
            <p><strong>Pelanggan:</strong> <?php echo htmlspecialchars($name); ?></p>
            <p><strong>Layanan:</strong> <?php echo htmlspecialchars($service); ?></p>
            <p><strong>Waktu:</strong> <?php echo htmlspecialchars($time); ?></p>
            <p><strong>Total Pembayaran:</strong> <?php echo htmlspecialchars($harga); ?></p>
            <span>Terimakasih telah menggunakan layanan kami, <b>Sampai Jumpa Kembali &#128522;</b></span>
        </section>

        <button class=" back-button" onclick="window.location.href='home.php'">← Kembali ke Home</button>
    </div>
</body>

</html>