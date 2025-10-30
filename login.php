<?php
session_start();
require 'koneksi.php';
$username = $_POST["username"];
$password = $_POST["password"];

$query_sql = "SELECT * FROM user 
            WHERE username = '$username' AND password = '$password'";

$result = mysqli_query($conn, $query_sql);
$user = mysqli_fetch_assoc($result);

if ($user && mysqli_num_rows($result) > 0) {
    $_SESSION['username'] = $user['username'];
    $_SESSION['nama'] = $user['nama'];
    header("Location: home.php");
} else {
    echo "<script>alert('Login gagal: Username atau password salah.'); window.location.href='logins.php';</script>";
}
