<?php
require 'koneksi.php';
$username = $_POST["username"];
$password = $_POST["password"];

$query_sql = "INSERT INTO user (username, password, nama, tgl_lahir) 
            VALUES ('$username', '$password', '{$_POST["nama"]}', '{$_POST["tgl_lahir"]}')";

if (mysqli_query($conn, $query_sql)) {
    echo "<script>alert('Pendaftaran Berhasil! Silakan login.'); window.location.href='logins.php';</script>";
} else {
    echo "Pendaftaran Gagal : " . mysqli_error($conn);
}
