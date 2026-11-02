<?php
session_start();

if (isset($_SESSION['username'])) {
    header('Location: dashboard.php');
    exit;
}

$loginError = $_SESSION['login_error'] ?? null;
unset($_SESSION['login_error']);
?>
<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/css/style.css" rel="stylesheet">
</head>
<body class="bg-light">
    <main class="container min-vh-100 d-flex align-items-center justify-content-center py-5">
        <div class="card shadow-sm w-100 login-card">
            <div class="card-body p-4 p-md-5">
                <h1 class="h3 text-center mb-4">Login</h1>
                <?php if ($loginError !== null): ?>
                    <div class="alert alert-danger" role="alert">
                        <?= htmlspecialchars($loginError, ENT_QUOTES, 'UTF-8') ?>
                    </div>
                <?php endif; ?>
                <form method="post" action="validasi.php">
                    <div class="mb-3">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" class="form-control" id="username" name="username" placeholder="Masukkan username" autocomplete="username" required autofocus>
                    </div>
                    <div class="mb-4">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="Masukkan password" autocomplete="current-password" required>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Masuk</button>
                </form>
            </div>
        </div>
    </main>
</body>
</html>
