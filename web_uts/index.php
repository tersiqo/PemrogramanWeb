<?php include 'koneksi.php'; ?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Rental Mobil Online</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      font-family: 'Poppins', sans-serif;
      background-color: #f8f9fa;
    }
    .hero {
      background-color: #0d6efd;
      color: white;
      text-align: center;
      padding: 3rem 1rem;
    }
    .car-img {
      height: 180px;
      object-fit: cover;
    }
  </style>
</head>
<body>

  <!-- Header -->
  <header class="hero">
    <h1 class="fw-bold">Rental Mobil Terbaik Se-Malang Raya</h1>
    <p>Sewa mobil impian Anda dengan harga terjangkau!</p>
  </header>

  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow">
    <div class="container">
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse justify-content-center" id="navbarNav">
        <ul class="navbar-nav">
          <li class="nav-item"><a class="nav-link active" href="index.php">Beranda</a></li>
          <li class="nav-item"><a class="nav-link" href="katalog.php">Pilihan Armada</a></li>
          <li class="nav-item"><a class="nav-link" href="syarat.php">Syarat & Ketentuan</a></li>
          <li class="nav-item"><a class="nav-link" href="kontak.php">Kontak Kami</a></li>
          <li class="nav-item"><a class="nav-link" href="login.php">Ubah Data</a></li>
        </ul>
      </div>
    </div>
  </nav>

  <!-- Main Content -->
  <main class="container my-5">
    <h2 class="text-center mb-4 text-primary fw-semibold">Armada Unggulan Kami</h2>
    <p class="text-center">Nikmati kemudahan sewa harian, mingguan, atau bulanan. Mulai jelajahi koleksi kami dengan mengklik <a href="katalog.php">Pilihan Armada</a>.</p>

    <div class="row justify-content-center g-4 mt-4">
      <?php
      $query = "SELECT * FROM tb_mobil ORDER BY id DESC LIMIT 4";
      $result = pg_query($conn, $query);

      if(pg_num_rows($result) > 0){
          while($row = pg_fetch_assoc($result)){ ?>
              <div class="col-md-3">
                <div class="card shadow-sm h-100">
                  <img src="img/<?= htmlspecialchars($row['gambar']) ?>" class="card-img-top car-img" alt="<?= htmlspecialchars($row['nama_mobil']) ?>">
                  <div class="card-body">
                    <h5 class="card-title"><?= htmlspecialchars($row['nama_mobil']) ?> (<?= htmlspecialchars($row['tahun']) ?>)</h5>
                    <p class="card-text mb-2">Merk: <?= htmlspecialchars($row['merk']) ?></p>
                    <p class="fw-bold text-danger">Rp <?= number_format($row['harga'], 0, ',', '.') ?>/hari</p>
                    <span class="badge <?= $row['status']=='Tersedia' ? 'bg-success' : 'bg-danger' ?>">
                      <?= htmlspecialchars($row['status']) ?>
                    </span>
                  </div>
                  <div class="card-footer text-center">
                    <a href="kontak.php" class="btn btn-primary btn-sm">Pesan Sekarang</a>
                  </div>
                </div>
              </div>
          <?php }
      } else {
          echo "<p class='text-center'>Belum ada mobil ditambahkan.</p>";
      }
      ?>
    </div>

    <div class="text-center mt-5">
      <a href="insert_mobil.php" class="btn btn-success me-2">+ Tambah Mobil Baru</a>
      <a href="tampil_mobil.php" class="btn btn-outline-primary">Edit Data Mobil</a>
    </div>
  </main>

  <!-- Footer -->
  <footer class="bg-dark text-white text-center py-3 mt-5">
    <p class="mb-0">© 2025 Rental Mobil. Semua Hak Dilindungi.</p>
  </footer>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
