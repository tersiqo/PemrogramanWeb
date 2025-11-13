<?php
session_start();
require __DIR__ . '/koneksi.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: register.php');
    exit;
}

$full_name = trim($_POST['full_name'] ?? '');
$username = trim($_POST['username'] ?? '');
$password = $_POST['password'] ?? '';

if (empty($full_name) || empty($username) || empty($password)) {
    header('Location: register.php?error=' . urlencode('Semua kolom wajib diisi.'));
    exit;
}

try {
    $check_sql = "SELECT id FROM tb_user WHERE username = $1";
    $check_res = qparams($check_sql, [$username]);

    if (pg_num_rows($check_res) > 0) {
        header('Location: register.php?error=' . urlencode('Username sudah digunakan.'));
        exit;
    }

    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $insert_sql = "INSERT INTO tb_user (username, password, nama_lengkap) VALUES ($1, $2, $3)";
    qparams($insert_sql, [$username, $hashed_password, $full_name]);

    header('Location: register.php?success=1');
    exit;

} catch (Throwable $e) {
    error_log('Registration Error: ' . $e->getMessage());
    header('Location: register.php?error=' . urlencode('Terjadi kesalahan saat menyimpan data.'));
    exit;
}
?>