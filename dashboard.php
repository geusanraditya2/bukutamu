<?php
session_start();

if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit;
}
?>
<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard</title>
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <main class="container py-5">
        <div class="card shadow-sm">
            <div class="card-body">
                <h1 class="h3">Dashboard</h1>
                <p class="mb-0">
                    Hi, selamat datang di hidupku, <?= htmlspecialchars($_SESSION['username'], ENT_QUOTES, 'UTF-8') ?>.
                </p>
                <form method="post" action="logout.php" class="mt-3">
                    <button type="submit" class="btn btn-outline-danger">Logout</button>
                </form>
            </div>
        </div>
    </main>
</body>
</html>
