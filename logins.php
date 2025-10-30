<?php
session_start();

// kalau sudah login, redirect ke home.php
if (isset($_SESSION['username'])) {
    header("Location: home.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Klinik Kecantikan Merati</title>
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <div id="auth" class="page active">
        <header>
            <h1>✨ Klinik Kecantikan Merati</h1>
            <p>Wujudkan Kecantikan Impian Anda</p>
        </header>
        <div id="login-form">
            <h2>Selamat Datang</h2>
            <form action="login.php" method="post">
                <input type="text" name="username" placeholder="Username">
                <input type="password" name="password" placeholder="Password">
                <button type="submit">Login</button>
            </form>
            <p>Belum punya akun? <a href="#" onclick="showRegister()">Registrasi Sekarang</a></p>
        </div>

        <div id="register-form" style="display: none;">
            <h2>Daftar Sekarang</h2>
            <form action="register.php" method="post">
                <input type="text" name="nama" placeholder="Nama Lengkap">
                <input type="date" name="tgl_lahir">
                <input type="text" name="username" placeholder="Username">
                <input type="password" name="password" placeholder="Password">
                <button type="submit">Daftar</button>
            </form>

            <p>Sudah punya akun? <a href="#" onclick="showLogin()">Login</a></p>
        </div>
    </div>

    <script>
        function showRegister() {
            const loginForm = document.getElementById('login-form');
            const registerForm = document.getElementById('register-form');

            loginForm.classList.add('form-switch-exit');
            setTimeout(() => {
                loginForm.style.display = 'none';
                registerForm.style.display = 'block';
                registerForm.classList.add('form-switch-enter');
            }, 300);
        }

        function showLogin() {
            const loginForm = document.getElementById('login-form');
            const registerForm = document.getElementById('register-form');

            registerForm.classList.add('form-switch-exit');
            setTimeout(() => {
                registerForm.style.display = 'none';
                loginForm.style.display = 'block';
                loginForm.classList.add('form-switch-enter');
            }, 300);
        }

        function login() {
            const username = document.getElementById('login-username').value;
            const password = document.getElementById('login-password').value;
            if (username && password) {
                window.location.href = 'home.php';
            } else {
                alert('Masukkan username dan password');
            }
        }

        function register() {
            const name = document.getElementById('reg-name').value;
            const dob = document.getElementById('reg-dob').value;
            const username = document.getElementById('reg-username').value;
            const password = document.getElementById('reg-password').value;
            if (name && dob && username && password) {
                alert('Registrasi berhasil! Silakan login.');
                showLogin();
            } else {
                alert('Isi semua field');
            }
        }
    </script>
</body>

</html>