<?php
session_start();
if (!isset($_SESSION['username']) && !isset($_SESSION['nama'])) {
    header("Location: logins.php");
    exit();
}
$username = $_SESSION['username'];
$name = $_SESSION['nama'];
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home - Klinik Kecantikan Merati</title>
    <link rel="stylesheet" href="style_home.css">
</head>

<body>
    <div id="home" class="page active">
        <header>
            <div class="header-buttons">
                <button class="logout-btn" onclick="window.location.href='logout.php'">
                    Logout
                </button>
            </div>
            <h1>✨ Klinik Kecantikan Merati</h1>
            <p>Tujuan Anda untuk kecantikan dan kesejahteraan</p>
        </header>

        <section id="about-us">
            <h2>Tentang Kami</h2>
            <p>Klinik Merati merupakan klinik kecantikan modern yang berfokus pada perawatan kulit, wajah, dan tubuh dengan mengutamakan keamanan serta hasil yang natural. Menggabungkan teknologi terkini dengan sentuhan profesional dari tenaga ahli berpengalaman, Klinik Merati hadir untuk membantu setiap pelanggan tampil lebih percaya diri dan bersinar dari dalam.</p>
            <p>Dengan suasana klinik yang nyaman, pelayanan ramah, serta produk perawatan berkualitas tinggi, Klinik Merati berkomitmen memberikan pengalaman kecantikan terbaik bagi setiap individu. Kami percaya bahwa kecantikan sejati bukan hanya tentang penampilan luar, tetapi juga tentang perasaan bahagia dan percaya diri dari dalam diri.</p>
        </section>

        <section id="services">
            <h2>Layanan</h2>
            <div class="service">
                <h3>Treatment Acne</h3>
                <p>Perawatan jerawat efektif untuk membersihkan dan merejuvenasi kulit Anda.</p>
                <div class="schedule">
                    <button onclick="selectService('Treatment Acne', '08:00', '<?php echo $name ?>')">08:00</button>
                    <button onclick="selectService('Treatment Acne', '11:00', '<?php echo $name ?>')">11:00</button>
                    <button onclick="selectService('Treatment Acne', '13:00', '<?php echo $name ?>')">13:00</button>
                    <button onclick="selectService('Treatment Acne', '15:00', '<?php echo $name ?>')">15:00</button>
                    <button onclick="selectService('Treatment Acne', '17:00', '<?php echo $name ?>')">17:00</button>
                    <button onclick="selectService('Treatment Acne', '19:00', '<?php echo $name ?>')">19:00</button>
                </div>
            </div>
            <div class="service">
                <h3>Hair Treatment</h3>
                <p>Revitalisasi rambut Anda dengan perawatan yang menyegarkan.</p>
                <div class="schedule">
                    <button onclick="selectService('Hair Treatment', '08:00', '<?php echo $name ?>')">08:00</button>
                    <button onclick="selectService('Hair Treatment', '11:00', '<?php echo $name ?>')">11:00</button>
                    <button onclick="selectService('Hair Treatment', '13:00', '<?php echo $name ?>')">13:00</button>
                    <button onclick="selectService('Hair Treatment', '15:00', '<?php echo $name ?>')">15:00</button>
                    <button onclick="selectService('Hair Treatment', '17:00', '<?php echo $name ?>')">17:00</button>
                    <button onclick="selectService('Hair Treatment', '19:00', '<?php echo $name ?>')">19:00</button>
                </div>
            </div>
            <div class="service">
                <h3>Facial</h3>
                <p>Perawatan wajah yang menenangkan untuk kulit yang bersinar.</p>
                <div class="schedule">
                    <button onclick="selectService('Facial', '08:00', '<?php echo $name ?>')">08:00</button>
                    <button onclick="selectService('Facial', '11:00', '<?php echo $name ?>')">11:00</button>
                    <button onclick="selectService('Facial', '13:00', '<?php echo $name ?>')">13:00</button>
                    <button onclick="selectService('Facial', '15:00', '<?php echo $name ?>')">15:00</button>
                    <button onclick="selectService('Facial', '17:00', '<?php echo $name ?>')">17:00</button>
                    <button onclick="selectService('Facial', '19:00', '<?php echo $name ?>')">19:00</button>
                </div>
            </div>
        </section>

        <section id="find-us">
            <h2>Temukan Kami</h2>
            <p>UMM KAMPUS 3, jalan tlogomas</p>
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3951.7466367254883!2d112.59478997588806!3d-7.921511578865263!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e7881f5405daac1%3A0xb39e4847109109e4!2sUniversitas%20Muhammadiyah%20Malang%20(UMM%20III)!5e0!3m2!1sid!2sid!4v1761720232867!5m2!1sid!2sid" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </section>
    </div>

    <script>
        function selectService(service, time, name) {
            window.location.href = `payment.html?service=${encodeURIComponent(service)}&time=${encodeURIComponent(time)}&name=${encodeURIComponent(name)}`;
        }

        function logout() {
            const confirmation = confirm('Apakah Anda yakin ingin logout?');
            if (confirmation) {
                alert('Anda telah logout. Sampai jumpa! 👋');
                window.location.href = 'login.html';
            }
        }
    </script>
</body>

</html>