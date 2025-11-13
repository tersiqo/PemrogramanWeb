<?php
require __DIR__ . '/koneksi.php';
session_start();

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header('Location: login.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    exit('Method not allowed');
}

$id = (int)($_POST['id'] ?? 0);
if ($id <= 0) {
    http_response_code(400);
    exit('ID mobil tidak valid.'); 
}

try {
    qparams('DELETE FROM tb_mobil WHERE id=$1', [$id]);
    header('Location: tampil_mobil.php'); 
    exit;
} catch (Throwable $e) {
    http_response_code(500);
    echo 'Gagal menghapus mobil: ' . htmlspecialchars($e->getMessage()); 
}
header("Location: tampil_mobil.php");
?>