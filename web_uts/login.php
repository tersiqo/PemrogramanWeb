<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
    <title>Login Sistem Rental Mobil</title>
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background-color: #f8f9fa;
        }
        .login-container {
            width: 100%;
            max-width: 400px;
            padding: 15px;
            margin: auto;
        }
    </style>
</head>
<body>

<div class="login-container">
    <h2 class="text-center mb-4">Login Admin Rental</h2>
    
    <?php if (!empty($_GET['error'])): ?>
      <div class="error"><?= htmlspecialchars($_GET['error']) ?></div>
    <?php endif; ?>

    <form action="authenticate.php" method="POST" class="needs-validation" novalidate>
        <div class="mb-3">
            <label for="username" class="form-label">Username</label>
            <input type="text" class="form-control" id="username" name="username" required>
            <div class="invalid-feedback">
                Mohon masukkan username.
            </div>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" id="password" name="password" required>
            <div class="invalid-feedback">
                Mohon masukkan password.
            </div>
        </div>
        
        <p class="text-center mt-3">
            <a href="index.php" class="back-link text-decoration-none">
                ← Kembali ke Beranda
            </a>
        </p>
        <button type="submit" class="btn btn-primary w-100">Login</button>
    </form>
    
    <p class="text-center mt-3">
        Belum punya akun? **<a href="register.php">Daftar di sini</a>**
    </p>
</div>

</body>
</html>