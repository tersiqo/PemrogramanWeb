<?php include 'koneksi.php'; ?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Katalog Mobil</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    .car-img { height: 200px; object-fit: cover; 
    }

    .hero {
      background-color: #0d6efd;
      color: white;
      text-align: center;
      padding: 3rem 1rem;
    }
  </style>
</head>
 <header class="hero">
    <h1 class ="fw-bold">Pilihan Armada Berdasarkan Kategori</h1>
        <p>Pilih mobil yang sesuai dengan kebutuhan perjalanan Anda!</p>
  </header>


<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm">
  <div class="container">
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse justify-content-center" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item"><a class="nav-link" href="index.php">Beranda</a></li>
        <li class="nav-item"><a class="nav-link active" href="katalog.php">Pilihan Armada</a></li>
        <li class="nav-item"><a class="nav-link" href="syarat.php">Syarat & Ketentuan</a></li>
        <li class="nav-item"><a class="nav-link" href="kontak.php">Kontak Kami</a></li>
        <li class="nav-item"><a class="nav-link" href="login.php">Ubah Data</a></li>
      </ul>
    </div>
  </div>
</nav>

<!-- Katalog -->
<div class="container my-5">
  <h2 class="text-center text-primary mb-4 fw-semibold">Katalog Mobil Lengkap</h2>
  <div class="row g-4">
    <?php
      $query = "SELECT * FROM tb_mobil ORDER BY id DESC";
      $result = pg_query($conn, $query);
      if(pg_num_rows($result) > 0){
          while($row = pg_fetch_assoc($result)){ ?>
            <div class="col-md-3">
              <div class="card h-100 shadow-sm">
                <img src="img/<?= htmlspecialchars($row['gambar']) ?>" class="card-img-top car-img" alt="<?= htmlspecialchars($row['nama_mobil']) ?>">
                <div class="card-body">
                  <h5 class="card-title"><?= htmlspecialchars($row['nama_mobil']) ?></h5>
                  <p class="mb-1 text-muted"><?= htmlspecialchars($row['merk']) ?> - <?= htmlspecialchars($row['tahun']) ?></p>
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
        echo "<p class='text-center'>Belum ada mobil dalam katalog.</p>";
      }
    ?>
  </div>
</div>

<footer class="bg-dark text-white text-center py-3 mt-5">
  <p class="mb-0">© 2025 Rental Mobil. Semua Hak Dilindungi.</p>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
