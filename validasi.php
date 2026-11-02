<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: login.php');
    exit;
}

$username = $_POST['username'] ?? null;
$password = $_POST['password'] ?? null;

if (!is_string($username) || !is_string($password) || trim($username) === '' || $password === '') {
    $_SESSION['login_error'] = 'Username dan password wajib diisi.';
    header('Location: login.php');
    exit;
}

$username = trim($username);

try {
    require __DIR__ . '/koneksi.php';

    $stmt = $koneksi->prepare('SELECT username, password FROM `user` WHERE username = ? LIMIT 1');
    $stmt->bind_param('s', $username);
    $stmt->execute();
    $stmt->bind_result($storedUsername, $passwordHash);

    $authenticated = $stmt->fetch()
        && is_string($passwordHash)
        && ($password === $passwordHash);
    $stmt->close();
    $koneksi->close();
} catch (mysqli_sql_exception $exception) {
    error_log('Login database error: ' . $exception->getMessage());
    $_SESSION['login_error'] = 'Login belum dapat diproses. Silakan coba lagi nanti.';
    header('Location: login.php');
    exit;
}

if (!$authenticated) {
    $_SESSION['login_error'] = 'Username atau password salah.';
    header('Location: login.php');
    exit;
}

session_regenerate_id(true);
$_SESSION['username'] = $storedUsername;

header('Location: dashboard.php');
exit;
