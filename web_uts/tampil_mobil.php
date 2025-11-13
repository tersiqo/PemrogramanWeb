<?php
session_start();

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header('Location: login.php');
    exit;
}

include 'koneksi.php';
?>
<!DOCTYPE html>

<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Data Mobil</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm">
  <div class="container">
    <a class="navbar-brand fw-bold" href="index.php">RentalMobil</a>
    <button class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbarNav">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse justify-content-center" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item"><a class="nav-link" href="index.php">Beranda</a></li>
        <li class="nav-item"><a class="nav-link" href="katalog.php">Pilihan Armada</a></li>
        <li class="nav-item"><a class="nav-link active" href="tampil_mobil.php">Edit Data Mobil</a></li>
      </ul>
    </div>
  </div>
</nav>

<div class="container my-5">
  <div class="d-flex justify-content-between align-items-center mb-4">
    <h3 class="text-primary fw-semibold">Daftar Mobil</h3>
    <a href="logout.php" class="btn btn-danger">+ keluar</a>
    <a href="insert_mobil.php" class="btn btn-success">+ Tambah Mobil</a>
  </div>

  <div class="table-responsive shadow-sm">
    <table class="table table-striped table-hover align-middle">
      <thead class="table-dark">
        <tr>
          <th>ID</th>
          <th>Nama Mobil</th>
          <th>Merk</th>
          <th>Tahun</th>
          <th>Harga</th>
          <th>Status</th>
          <th>Kategori</th>
          <th>Gambar</th>
          <th>Aksi</th>
        </tr>
      </thead>
      <tbody>
        <?php
          $query = "SELECT * FROM tb_mobil ORDER BY id ASC";
          $result = pg_query($conn, $query);
          if(pg_num_rows($result) > 0){
              while($row = pg_fetch_assoc($result)){ ?>
                <tr>
                  <td><?= $row['id'] ?></td>
                  <td><?= htmlspecialchars($row['nama_mobil']) ?></td>
                  <td><?= htmlspecialchars($row['merk']) ?></td>
                  <td><?= htmlspecialchars($row['tahun']) ?></td>
                  <td>Rp <?= number_format($row['harga'], 0, ',', '.') ?></td>
                  <td><span class="badge <?= $row['status']=='Tersedia' ? 'bg-success' : 'bg-danger' ?>"><?= htmlspecialchars($row['status']) ?></span></td>
                  <td><?= htmlspecialchars($row['kategori']) ?></td>
                  <td><img src="img/<?= htmlspecialchars($row['gambar']) ?>" width="70"></td>
                  <td>
                    <a href="edit_mobil.php?id=<?= $row['id'] ?>" class="btn btn-warning btn-sm">Edit</a>
                    <a href="delete.php?id=<?= $row['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin hapus mobil ini?')">Hapus</a>
                  </td>
                </tr>
        <?php }
          } else {
              echo "<tr><td colspan='9' class='text-center'>Belum ada data mobil.</td></tr>";
          }
        ?>
      </tbody>
    </table>
  </div>
</div>

<footer class="bg-dark text-white text-center py-3 mt-5">
  <p class="mb-0">© 2025 Rental Mobil. Semua Hak Dilindungi.</p>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
