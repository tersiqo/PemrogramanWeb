<?php
session_start();
require_once 'koneksi.php';

try {
    $conn = get_pg_connection();
} catch (Throwable $e) {
    error_log('DB connection error in authenticate.php: ' . $e->getMessage());
    header('Location: login.php?error=' . urlencode('Gagal koneksi ke database.'));
    exit;
}

$username = trim($_POST['username'] ?? '');
$password = $_POST['password'] ?? '';

if ($username === '' || $password === '') {
    header('Location: login.php?error=' . urlencode('Username dan password harus diisi.'));
    exit;
}

$sql = "SELECT id, username, password, nama_lengkap FROM tb_user WHERE username = $1";
$result = pg_query_params($conn, $sql, [$username]);

if (!$result || pg_num_rows($result) === 0) {
    header('Location: login.php?error=' . urlencode('Username atau password salah.'));
    exit;
}

$user = pg_fetch_assoc($result);

if (password_verify($password, $user['password'])) {
    session_regenerate_id(true);
    $_SESSION['loggedin'] = true;
    $_SESSION['user_id'] = $user['id'];
    $_SESSION['username'] = $user['username'];
    $_SESSION['nama_lengkap'] = $user['nama_lengkap'];

    header('Location: tampil_mobil.php');
    exit;
} else {
    header('Location: login.php?error=' . urlencode('Username atau password salah.'));
    exit;
}
