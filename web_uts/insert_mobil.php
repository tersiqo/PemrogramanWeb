<?php
require __DIR__ . '/koneksi.php';
session_start();

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header('Location: login.php');
    exit;
}
$err = '';
$nama_mobil = $merk = $tahun = $harga = $kategori = $status = $gambar = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama_mobil = trim($_POST['nama_mobil'] ?? '');
    $merk       = trim($_POST['merk'] ?? '');
    $tahun      = (int)($_POST['tahun'] ?? 0);
    $harga      = (int)($_POST['harga'] ?? 0);
    $kategori   = trim($_POST['kategori'] ?? '');
    $status     = trim($_POST['status'] ?? '');
    $gambar     = ''; 

    if ($nama_mobil === '' || $merk === '' || $tahun <= 0 || $harga <= 0 || $kategori === '') {
        $err = 'Nama Mobil, Merk, Tahun, Harga, dan Kategori wajib diisi.';
    } elseif (!in_array($kategori, ["lcgc", "mpv", "suv", "pickup"])) {
        $err = 'Kategori tidak valid.';
    } elseif (!in_array($status, ['Tersedia', 'Disewa'])) {
        $err = 'Status tidak valid.';
    } else {

        if (isset($_FILES['gambar']) && $_FILES['gambar']['error'] == UPLOAD_ERR_OK) {
            $fileTmpPath = $_FILES['gambar']['tmp_name'];
            $fileName = $_FILES['gambar']['name'];
            $fileSize = $_FILES['gambar']['size'];
            $fileType = $_FILES['gambar']['type'];
            $fileNameCmps = explode(".", $fileName);
            $fileExtension = strtolower(end($fileNameCmps));
            
            $newFileName = md5(time() . $fileName) . '.' . $fileExtension;
            
            $uploadFileDir = __DIR__ . '/img/';
            $destPath = $uploadFileDir . $newFileName;

            $allowedfileExtensions = ['jpg', 'gif', 'png', 'jpeg'];
            if (!in_array($fileExtension, $allowedfileExtensions)) {
                $err = "Ekstensi file tidak didukung. Hanya JPG, JPEG, PNG, GIF yang diperbolehkan.";
            } elseif ($fileSize > 5000000) { // Batas 5MB
                $err = "Ukuran file terlalu besar (Maks. 5MB).";
            } elseif (move_uploaded_file($fileTmpPath, $destPath)) {
                $gambar = $newFileName;
            } else {
                $err = 'Terjadi kesalahan saat mengupload file.';
            }
        } else {
             $gambar = 'default.jpg';
        }

        if ($err === '') {
            try {
                qparams(
                    'INSERT INTO tb_mobil (nama_mobil, merk, tahun, harga, kategori, status, gambar) VALUES ($1, $2, $3, $4, $5, $6, $7)',
                    [$nama_mobil, $merk, $tahun, $harga, $kategori, $status, $gambar]
                );
                header('Location: tampil_mobil.php');
                exit;
            } catch (Throwable $e) {
                $err = $e->getMessage();
            }
        }
    }
}
?>
<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <title>Tambah Mobil</title>
  <style>
    body{font-family:system-ui,Segoe UI,Roboto,Arial,sans-serif;max-width:720px;margin:24px auto;padding:0 12px}
    label{display:block;margin-top:10px}
    input,select{width:100%;padding:8px;margin-top:4px}
    .btn{padding:8px 12px;border:1px solid #999;border-radius:6px;background:#f6f6f6;text-decoration:none}
    .alert{padding:10px;border-radius:6px;margin:10px 0}
    .alert.error{background:#ffe9e9;border:1px solid #e99}
  </style>
</head>
<body>
  <h1>Tambah Mobil Baru</h1>

  <?php if ($err): ?>
    <div class="alert error"><?= htmlspecialchars($err) ?></div>
  <?php endif; ?>

  <form method="post" enctype="multipart/form-data">
    <label>Nama Mobil
      <input name="nama_mobil" value="<?= htmlspecialchars($nama_mobil) ?>" required>
    </label>
    <label>Merk
      <input name="merk" value="<?= htmlspecialchars($merk) ?>" required>
    </label>
    <label>Tahun
      <input name="tahun" type="number" value="<?= htmlspecialchars($tahun) ?>" required>
    </label>
    <label>Harga Sewa/Hari
      <input name="harga" type="number" value="<?= htmlspecialchars($harga) ?>" required>
    </label>
    <label>Kategori
      <select name="kategori" required>
        <option value="">Pilih Kategori</option>
        <option value="lcgc" <?= ($kategori == 'lcgc' ? 'selected' : '') ?>>LCGC</option>
        <option value="mpv" <?= ($kategori == 'mpv' ? 'selected' : '') ?>>MPV</option>
        <option value="suv" <?= ($kategori == 'suv' ? 'selected' : '') ?>>SUV</option>
        <option value="pickup" <?= ($kategori == 'pickup' ? 'selected' : '') ?>>Niaga/Pickup</option>
      </select>
    </label>
    <label>Status
      <select name="status" required>
        <option value="Tersedia" <?= ($status == 'Tersedia' ? 'selected' : '') ?>>Tersedia</option>
        <option value="Disewa" <?= ($status == 'Disewa' ? 'selected' : '') ?>>Disewa</option>
      </select>
    </label>
    <label>Gambar Mobil (JPG/PNG maks 5MB)
      <input type="file" name="gambar" accept=".jpg, .jpeg, .png, .gif">
    </label>

    <p style="margin-top:16px">
      <button class="btn" type="submit">Simpan</button>
      <a class="btn" href="tampil_mobil.php">Kembali</a>
    </p>
  </form>
</body>
</html>