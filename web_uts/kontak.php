<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Kontak Kami</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<style>
    .hero {
      background-color: #0d6efd;
      color: white;
      text-align: center;
      padding: 3rem 1rem;
    }
    </style>
   <header class="hero">
    <h1 class ="fw-bold">Kontak Kami</h1>
        <p>Pesan mobil Anda sekarang!</p>
  </header>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm">
  <div class="container">
    <button class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbarNav">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse justify-content-center" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item"><a class="nav-link" href="index.php">Beranda</a></li>
        <li class="nav-item"><a class="nav-link" href="katalog.php">Pilihan Armada</a></li>
        <li class="nav-item"><a class="nav-link" href="syarat.php">Syarat & Ketentuan</a></li>
        <li class="nav-item"><a class="nav-link active" href="kontak.php">Kontak Kami</a></li>
        <li class="nav-item"><a class="nav-link" href="login.php">Ubah Data</a></li>
      </ul>
    </div>
  </div>
</nav>

<div class="container my-5">
  <h2 class="text-center mb-4 text-primary fw-semibold">Hubungi Kami</h2>

  <div class="row justify-content-center">
    <div class="col-md-6">
      <div class="card shadow-sm">
        <div class="card-body">
          <p><strong>Alamat:</strong> Jl. Soekarno Hatta No.123, Malang</p>
          <p><strong>Telepon:</strong> 0812-3456-7890</p>
          <p><strong>Email:</strong> rentalmobilmalang@gmail.com</p>
          <hr>
          <h5>Kirim Pesan</h5>
          <form>
            <div class="mb-3">
              <label class="form-label">Nama</label>
              <input type="text" class="form-control" placeholder="Masukkan nama Anda">
            </div>
            <div class="mb-3">
              <label class="form-label">Email</label>
              <input type="email" class="form-control" placeholder="nama@email.com">
            </div>
            <div class="mb-3">
              <label class="form-label">Pesan</label>
              <textarea class="form-control" rows="4" placeholder="Tulis pesan..."></textarea>
            </div>
            <button type="submit" class="btn btn-primary w-100">Kirim</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

<footer class="bg-dark text-white text-center py-3 mt-5">
  <p class="mb-0">© 2025 Rental Mobil. Semua Hak Dilindungi.</p>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
