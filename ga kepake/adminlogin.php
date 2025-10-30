<?php
require 'koneksi.php';
$username = $_POST["username"];
$password = $_POST["password"];

$query_sql = "SELECT * FROM adminlogin 
            WHERE username = '$username' AND password = '$password'";

$result = mysqli_query($conn, $query_sql);

if (mysqli_num_rows($result) > 0) {
    header("Location: https://dashboard.sandbox.midtrans.com/beta/transactions");
} else {
    echo "<center><h1>Username atau Password Anda Salah</h1>
            <button><strong><a href='adminlogin.html'>Login</a></strong></button></center>";
}