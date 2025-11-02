<?php
include "koneksi.php";
session_start();
if (!isset($_SESSION['username']) && !isset($_SESSION['nama'])) {
    header("Location: logins.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $service = $_POST["service"];
    $time = $_POST["time"];
    $name = $_POST["name"];

    $name = htmlspecialchars($name);
    $time = htmlspecialchars($time);
    $service = htmlspecialchars($service);
    $error = 0;
    $sql = "select * from user where nama=\"$name\"";
    $result = mysqli_query($conn, $sql);
    $nresult = mysqli_num_rows($result);
    if ($nresult > 0) {
        $row = mysqli_fetch_assoc($result);
        $id_user = $row['id'];
        $username = $row['username'];
    } else {
        $error++;
    }

    $sql2 = "select * from treatment where layanan=\"$service\" and jam=\"$time\" and hapus=0";
    $result2 = mysqli_query($conn, $sql2);
    $nresult2 = mysqli_num_rows($result2);
    if ($nresult2 > 0) {
        $row2 = mysqli_fetch_assoc($result2);
        $id_treatment = $row2['id'];
        $harga = $row2['harga'];
    } else {
        $error++;
    }

    if ($error == 0) {
        $sql3 = "insert into transaction (id_user, username, id_treatment, layanan, hapus, created_at) values ($id_user, \"$username\", $id_treatment, \"$service\", 0, NOW())";
        mysqli_query($conn, $sql3);
        header("Location: invoice.php?service=" . urlencode($service) . "&time=" . urlencode($time) . "&name=" . urlencode($name));
        exit();
    } else {
        echo "<script>alert('Terjadi kesalahan, coba lagi.'); window.history.back();</script>";

        // echo mysqli_error($conn);
        // die();
    }
}
