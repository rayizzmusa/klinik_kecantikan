<?php
include 'koneksi.php';
session_start();
if (!isset($_SESSION['username']) && !isset($_SESSION['nama'])) {
    header("Location: logins.php");
    exit();
}

$iduser = $_SESSION['id'];
$username = $_SESSION['username'];
$name = $_SESSION['nama'];
$role = $_SESSION['role'];

$layanan = [];
$id_layanan = [];
$sql = "select * from master_treatment where hapus=0 order by id asc";
$result = mysqli_query($conn, $sql);
while ($row = mysqli_fetch_assoc($result)) {
    $ids = $row['id'];
    $id_layanan[$ids] = $ids;
    $layanan[] = $row;
}
// print_r($id_layanan);
// exit;

$semuaLayanan = [];

foreach ($id_layanan as $id) {
    $sql = "select * from treatment where id_layanan='$id' and hapus=0 order by jam asc";
    $result = mysqli_query($conn, $sql);
    $dataLayanan = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $dataLayanan[] = $row;
    }

    $semuaLayanan[$id] = $dataLayanan;
}

// $layananList = ['Treatment Acne', 'Hair Treatment', 'Facial'];
// $dataLayanan = [];

// foreach ($layananList as $layanan) {
//     $sql = "SELECT * FROM treatment WHERE layanan = '$layanan' AND hapus = 0 order by jam asc";
//     $result = mysqli_query($conn, $sql);
//     $rows = [];

//     while ($row = mysqli_fetch_assoc($result)) {
//         $rows[] = $row;
//     }

//     $dataLayanan[$layanan] = $rows;
// }

$trans = [];
$sql = "select a.* , b.nama, c.harga from transaction as a inner join user as b on a.id_user = b.id inner join treatment as c on a.id_treatment = c.id where a.hapus=0 and c.hapus=0 order by a.id asc";
$result = mysqli_query($conn, $sql);
$data = [];
while ($fdata = mysqli_fetch_assoc($result)) {
    extract($fdata);

    $sql2 = "select * from master_treatment where id=\"$id_layanan\" and hapus=0";
    $result2 = mysqli_query($conn, $sql2);
    $row = mysqli_fetch_assoc($result2);
    $fdata['nama_layanan'] = $row['layanan'];
    $trans[] = $fdata;
}


?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home - Klinik Kecantikan Merati</title>
    <link rel="stylesheet" href="style_home.css">
    <link rel="icon" href="logo.png" type="image/png">
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
            <p>Selamat Datang <?php echo $name ?> !!</p>
        </header>
        <?php if ($_SESSION['role'] === 'pelanggan'): ?>
            <section id="about-us">
                <h2>Tentang Kami</h2>
                <p>Klinik Merati merupakan klinik kecantikan modern yang berfokus pada perawatan kulit, wajah, dan tubuh dengan mengutamakan keamanan serta hasil yang natural. Menggabungkan teknologi terkini dengan sentuhan profesional dari tenaga ahli berpengalaman, Klinik Merati hadir untuk membantu setiap pelanggan tampil lebih percaya diri dan bersinar dari dalam.</p>
                <p>Dengan suasana klinik yang nyaman, pelayanan ramah, serta produk perawatan berkualitas tinggi, Klinik Merati berkomitmen memberikan pengalaman kecantikan terbaik bagi setiap individu. Kami percaya bahwa kecantikan sejati bukan hanya tentang penampilan luar, tetapi juga tentang perasaan bahagia dan percaya diri dari dalam diri.</p>
            </section>
        <?php endif; ?>

        <section id="services">
            <h2>Layanan</h2>
            <?php foreach ($layanan as $data): ?>
                <div class="service">
                    <h3><?= $data['layanan'] ?></h3>
                    <p><?= $data['deskripsi'] ?></p>
                    <p><b>Rp. <?= $data['harga'] ?></b></p>

                    <?php
                    $id_layanan = $data['id']; // ambil id layanan saat ini
                    $treatments = isset($semuaLayanan[$id_layanan]) ? $semuaLayanan[$id_layanan] : [];
                    ?>

                    <?php if (!empty($treatments)): ?>
                        <div class="schedule">
                            <?php foreach ($treatments as $item): ?>
                                <button onclick="selectService('<?= $item['id_layanan'] ?>', '<?= $item['jam'] ?>', '<?= $username ?>')">
                                    <?= $item['jam'] ?>
                                </button>
                            <?php endforeach; ?>
                        </div>
                    <?php else: ?>
                        <p><i>Belum ada jadwal</i></p>
                    <?php endif; ?>


                    <?php if ($_SESSION['role'] === 'admin'): ?>
                        <div class="admin">
                            <button onclick="window.location.href = 'edit_jadwal.php?service=<?= $data['id'] ?>'">Edit Jam Layanan</button>
                        </div>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>

            <?php if ($_SESSION['role'] === 'pelanggan'): ?>
                <div class="schedule">
                    <button onclick="window.location.href = 'riwayat.php?as=<?= $role ?>&gid=<?= $iduser ?>'">Riwayat Transaksi</button>
                </div>
            <?php endif; ?>
            <?php if ($_SESSION['role'] === 'admin'): ?>
                <div class="admin">
                    <button onclick="window.location.href = 'edit_layanan.php'">+ Tambahkan Layanan</button>
                </div>
            <?php endif; ?>
        </section>


        <?php if ($_SESSION['role'] === 'pelanggan'): ?>
            <section id="find-us">
                <h2>Temukan Kami</h2>
                <p>UMM KAMPUS 3, jalan tlogomas</p>
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3951.7466367254883!2d112.59478997588806!3d-7.921511578865263!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e7881f5405daac1%3A0xb39e4847109109e4!2sUniversitas%20Muhammadiyah%20Malang%20(UMM%20III)!5e0!3m2!1sid!2sid!4v1761720232867!5m2!1sid!2sid" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </section>
        <?php else: ?>
            <section id="services">
                <h2>Daftar Transaksi</h2>
                <?php foreach ($trans as $dat): ?>
                    <div class="service">
                        <p>Tanggal : <?= $dat['created_at'] ?></p>
                        <p>Pelanggan : <b><?= $dat['nama'] ?></b></p>
                        <p><?= $dat['nama_layanan'] ?> - <?= $dat['harga'] ?></p>
                    </div>
                <?php endforeach; ?>
            </section>
        <?php endif; ?>
    </div>

    <script>
        function selectService(service, time, name) {
            window.location.href = `payment.php?service=${encodeURIComponent(service)}&time=${encodeURIComponent(time)}&name=${encodeURIComponent(name)}`;
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