<?php
require __DIR__ . '/koneksi.php';
session_start();

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header('Location: login.php');
    exit; 
}

$err = '';
$id = (int)($_GET['id'] ?? 0);
$err = '';
$id = (int)($_GET['id'] ?? 0);

if ($id <= 0) {
    http_response_code(400);
    exit('ID mobil tidak valid.');
}

try {
    $res = qparams('SELECT id, nama_mobil, merk, tahun, harga, kategori, status, gambar FROM tb_mobil WHERE id=$1', [$id]);
    $row = pg_fetch_assoc($res);
    if (!$row) {
        http_response_code(404);
        exit('Data mobil tidak ditemukan.');
    }
} catch (Throwable $e) {
    exit('Error: ' . htmlspecialchars($e->getMessage()));
}

$nama_mobil_old = $nama_mobil = $row['nama_mobil'];
$merk_old = $merk = $row['merk'];
$tahun_old = $tahun = $row['tahun'];
$harga_old = $harga = $row['harga'];
$kategori_old = $kategori = $row['kategori'];
$status_old = $status = $row['status'];
$gambar_lama = $row['gambar']; 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama_mobil = trim($_POST['nama_mobil'] ?? '');
    $merk       = trim($_POST['merk'] ?? '');
    $tahun      = (int)($_POST['tahun'] ?? 0);
    $harga      = (int)($_POST['harga'] ?? 0);
    $kategori   = trim($_POST['kategori'] ?? '');
    $status     = trim($_POST['status'] ?? '');
    $gambar_baru = $gambar_lama; 

    if ($nama_mobil === '' || $merk === '' || $tahun <= 0 || $harga <= 0 || $kategori === '') {
        $err = 'Nama Mobil, Merk, Tahun, Harga, dan Kategori wajib diisi.';
    } elseif (!in_array($status, ['Tersedia', 'Disewa'])) {
        $err = 'Status tidak valid.';
    } else {

        if (isset($_FILES['gambar']) && $_FILES['gambar']['error'] == UPLOAD_ERR_OK && $_FILES['gambar']['size'] > 0) {
            $fileTmpPath = $_FILES['gambar']['tmp_name'];
            $fileName = $_FILES['gambar']['name'];
            $fileSize = $_FILES['gambar']['size'];
            $fileNameCmps = explode(".", $fileName);
            $fileExtension = strtolower(end($fileNameCmps));
            
            $newFileName = md5(time() . $fileName) . '.' . $fileExtension;
            $uploadFileDir = __DIR__ . '/img/';
            $destPath = $uploadFileDir . $newFileName;

            $allowedfileExtensions = ['jpg', 'gif', 'png', 'jpeg'];
            if (!in_array($fileExtension, $allowedfileExtensions)) {
                $err = "Ekstensi file tidak didukung. Hanya JPG, JPEG, PNG, GIF yang diperbolehkan.";
            } elseif ($fileSize > 5000000) { 
                $err = "Ukuran file terlalu besar (Maks. 5MB).";
            } elseif (move_uploaded_file($fileTmpPath, $destPath)) {
                $gambar_baru = $newFileName;
                if ($gambar_lama !== 'default.jpg' && file_exists($uploadFileDir . $gambar_lama)) {
                    unlink($uploadFileDir . $gambar_lama);
                }
            } else {
                $err = 'Terjadi kesalahan saat mengupload file.';
            }
        }


        if ($err === '') {
            try {
                qparams(
                    'UPDATE tb_mobil
                        SET nama_mobil=$1, merk=$2, tahun=$3, harga=$4, kategori=$5, status=$6, gambar=$7
                      WHERE id=$8',
                    [$nama_mobil, $merk, $tahun, $harga, $kategori, $status, $gambar_baru, $id]
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
  <title>Ubah Mobil</title>
  <style>
    body{font-family:system-ui,Segoe UI,Roboto,Arial,sans-serif;max-width:720px;margin:24px auto;padding:0 12px}
    label{display:block;margin-top:10px}
    input, select{width:100%;padding:8px;margin-top:4px}
    .btn{padding:8px 12px;border:1px solid #999;border-radius:6px;background:#f6f6f6;text-decoration:none}
    .alert{padding:10px;border-radius:6px;margin:10px 0}
    .alert.error{background:#ffe9e9;border:1px solid #e99}
    .img-preview { max-width: 150px; height: auto; margin-top: 10px; border: 1px solid #ccc; padding: 5px; border-radius: 5px;}
  </style>
</head>
<body>
  <h1>Ubah Data Mobil</h1>

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
        <?php
        $kategori_list = ["lcgc", "mpv", "suv", "pickup"];
        foreach ($kategori_list as $key) {
            $selected = ($kategori == $key) ? 'selected' : '';
            echo "<option value='{$key}' {$selected}>" . strtoupper($key) . "</option>";
        }
        ?>
      </select>
    </label>
    <label>Status
      <select name="status" required>
        <option value="Tersedia" <?= ($status == 'Tersedia' ? 'selected' : '') ?>>Tersedia</option>
        <option value="Disewa" <?= ($status == 'Disewa' ? 'selected' : '') ?>>Disewa</option>
      </select>
    </label>

    <label>Gambar Mobil Saat Ini</label>
    <img src="img/<?= htmlspecialchars($gambar_lama) ?>" alt="Gambar <?= htmlspecialchars($nama_mobil) ?>" class="img-preview">
    
    <label style="margin-top:10px;">Ganti Gambar (Kosongkan jika tidak diubah)</label>
    <input type="file" name="gambar" accept=".jpg, .jpeg, .png, .gif">

    <p style="margin-top:16px">
      <button class="btn" type="submit">Simpan Perubahan</button>
      <a class="btn" href="tampil_mobil.php">Batal</a>
    </p>
  </form>
</body>
</html>