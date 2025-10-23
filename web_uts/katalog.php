<?php include 'koneksi.php'; ?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Pilihan Armada - Rental Mobil</title>
  <link rel="stylesheet" href="style.css">

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@600;700&family=Roboto:wght@300;400;700&display=swap" rel="stylesheet">
</head>
<body>
  <header>
    <h1>Pilihan Armada Berdasarkan Kategori</h1>
    <p>Pilih mobil yang sesuai dengan kebutuhan perjalanan Anda!</p>
  </header>

  <nav>
    <ul>
      <li><a href="index.php">Beranda</a></li>
      <li><a href="katalog.php" class="active-link">Pilihan Armada</a></li>
      <li><a href="syarat.html">Syarat & Ketentuan</a></li>
      <li><a href="kontak.html">Kontak Kami</a></li>
    </ul>
  </nav>

  <main>
    <div class="category-menu">
      <button onclick="scrollToCategory('lcgc-content')">LCGC</button>
      <button onclick="scrollToCategory('mpv-content')">MPV</button>
      <button onclick="scrollToCategory('suv-content')">SUV</button>
      <button onclick="scrollToCategory('pickup-content')">Niaga</button>
      <a href="insert_mobil.php" style="margin-left:20px;">
        <button style="background-color:#28a745;">+ Tambah Mobil</button>
      </a>
    </div>

    <?php
    // daftar kategori mobil
    $kategori = [
      "lcgc" => "LCGC (Low Cost Green Car)",
      "mpv" => "MPV (Multi-Purpose Vehicle)",
      "suv" => "SUV (Sport Utility Vehicle)",
      "pickup" => "Mobil Pickup/Niaga"
    ];

    foreach($kategori as $key => $judul){
      echo "<section id='{$key}-content' class='car-category full-catalog'>";
      echo "<h2>$judul</h2>";
      echo "<div class='car-catalog-grid'>";

      // ambil data berdasarkan kategori
      $query = "SELECT * FROM tb_mobil WHERE kategori='$key' ORDER BY id ASC";
      $result = pg_query($conn, $query);

      if(pg_num_rows($result) > 0){
        while($row = pg_fetch_assoc($result)){
          echo "
          <a href='kontak.html' class='car-item'>
            <img src='img/{$row['gambar']}' alt='{$row['nama_mobil']}'>
            <div class='car-details'>
              <h2>{$row['nama_mobil']} ({$row['tahun']})</h2>
              <p>Merk: {$row['merk']}</p>
              <span class='rental-price'>Sewa/Hari: Rp ".number_format($row['harga'],0,',','.')."</span>
              <span class='car-status' style='color:" . ($row['status']=='Tersedia' ? '#28a745' : '#dc3545') . "'>
                Status: {$row['status']}
              </span>
            </div>
          </a>
          ";
        }
      } else {
        echo "<p style='text-align:center;'>Belum ada mobil di kategori ini.</p>";
      }

      echo "</div></section>";
    }
    ?>
  </main>

  <footer>
    <p>© 2025 Rental Mobil. Semua Hak Dilindungi.</p>
  </footer>

  <script>
  function scrollToCategory(id){
    document.getElementById(id)?.scrollIntoView({behavior:'smooth'});
  }
  </script>
</body>
</html>
/