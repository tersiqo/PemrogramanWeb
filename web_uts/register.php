<?php
require __DIR__ . '/koneksi.php';
session_start();

if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
    header('Location: tampil_mobil.php');
    exit;
}

$err = $_GET['error'] ?? '';
$success = $_GET['success'] ?? '';
?>
<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
    <title>Registrasi Admin Rental</title>
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background-color: #f8f9fa;
        }
        .register-container {
            width: 100%;
            max-width: 450px;
            padding: 15px;
            margin: auto;
        }
    </style>
</head>
<body>

<div class="register-container">
    <h2 class="text-center mb-4">Registrasi Admin Baru</h2>
    
    <?php if ($err): ?>
        <div class="alert alert-danger" role="alert">
            Gagal Registrasi: <?= htmlspecialchars($err) ?>
        </div>
    <?php endif; ?>

    <?php if ($success): ?>
        <div class="alert alert-success" role="alert">
            Registrasi berhasil! Silakan <a href="login.php">Login</a>.
        </div>
    <?php endif; ?>

    <form action="register_process.php" method="POST" class="needs-validation" novalidate>
        <div class="mb-3">
            <label for="full_name" class="form-label">Nama Lengkap</label>
            <input type="text" class="form-control" id="full_name" name="full_name" required>
        </div>
        <div class="mb-3">
            <label for="username" class="form-label">Username</label>
            <input type="text" class="form-control" id="username" name="username" required>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" id="password" name="password" required>
        </div>
        
        <button type="submit" class="btn btn-success w-100">Daftar</button>
        <p class="text-center mt-3">
            Sudah punya akun? <a href="login.php" class="back-link text-decoration-none">Login di sini</a>
        </p>
    </form>
</div>

</body>
</html>