<?php
$service = $_GET['service'];
$time = $_GET['time'];
$name = $_GET['name'];
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pembayaran - Klinik Kecantikan Merati</title>
    <link rel="stylesheet" href="style_payment.css">
</head>

<body>
    <div id="payment" class="page active">
        <header>
            <h1>💳 Klinik Kecantikan Merati</h1>
            <p>Pembayaran Layanan</p>
        </header>

        <section>
            <h2>Detail Layanan</h2>
            <p id="service-detail"></p>
            <p id="time-detail"></p>
        </section>

        <section>
            <div class="payment-methods">
                <button class="payment-method-btn" onclick="selectPayment('E-Wallet')">
                    💰 Bayar
                </button>
            </div>
        </section>

        <section id="payment-info">
            <h3>Informasi Pembayaran</h3>
            <p><strong>Bank:</strong> BRI</p>
            <p><strong>Nomor Rekening:</strong> 1234567890123</p>
            <p><strong>Atas Nama:</strong> Klinik Merati</p>
            <button class="success-btn" onclick="confirmPayment()">✓ Konfirmasi Pembayaran</button>
        </section>

        <button class="back-button" onclick="window.location.href='home.php'">← Kembali</button>
    </div>

    <script>
        const urlParams = new URLSearchParams(window.location.search);
        const service = urlParams.get('service');
        const time = urlParams.get('time');
        const name = urlParams.get('name');

        document.getElementById('service-detail').textContent = `Layanan: ${service || 'Tidak ada'}`;
        document.getElementById('time-detail').textContent = `Waktu: ${time || 'Tidak ada'}`;

        function selectPayment(method) {
            const paymentInfo = document.getElementById('payment-info');
            paymentInfo.style.display = 'block';

            // Smooth scroll to payment info
            setTimeout(() => {
                paymentInfo.scrollIntoView({
                    behavior: 'smooth',
                    block: 'center'
                });
            }, 100);
        }

        function confirmPayment() {
            const button = event.target;
            button.innerHTML = '<span class="loading"></span> Processing...';
            button.disabled = true;

            setTimeout(() => {
                window.location.href = 'invoice.php?service=' + encodeURIComponent(service) + '&time=' + encodeURIComponent(time) + '&name=' + encodeURIComponent(name);
            }, 1500);
        }

        function goBack() {
            window.location.href = 'home.html';
        }
    </script>
</body>

</html>