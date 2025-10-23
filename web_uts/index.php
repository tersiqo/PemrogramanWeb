<?php include 'koneksi.php'; ?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rental Mobil Online</title>
    <link rel="stylesheet" href="style.css">
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@600;700&family=Roboto:wght@300;400;700&display=swap" rel="stylesheet">
</head>

<body>
    <header>
        <h1>Rental Mobil Terbaik Se-Malang Raya</h1>
        <p>Sewa mobil impian Anda dengan harga terjangkau!</p>
    </header>

    <nav>
        <ul>
            <li><a href="index.php" class="active-link">Beranda</a></li>
            <li><a href="katalog.php">Pilihan Armada</a></li> 
            <li><a href="syarat.html">Syarat & Ketentuan</a></li> 
            <li><a href="kontak.html">Kontak Kami</a></li>
        </ul>
    </nav>

    <main id="home-content">
        <h2>Armada Unggulan Kami</h2>
        <p>Nikmati kemudahan sewa harian, mingguan, atau bulanan. Mulai jelajahi koleksi kami dengan mengklik Pilihan Armada di menu, atau 
        <a href="katalog.php">klik di sini</a>.</p>

        

        <div id="car-catalog">
        <?php
        // ambil 4 mobil terbaru dari database
        $query = "SELECT * FROM tb_mobil ORDER BY id DESC LIMIT 4";
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
                        <span class='car-status' style='color:" . 
                            ($row['status']=='Tersedia' ? '#28a745' : '#dc3545') . "'>
                            Status: {$row['status']}
                        </span>
                    </div>
                </a>
                ";
            }
        } else {
            echo "<p style='text-align:center;'>Belum ada mobil ditambahkan.</p>";
        }
        ?>
        </div>
        <div style="margin: 25px 0;">
            <a href="insert_mobil.php">
                <button style="
                    background-color: #28a745;
                    color: white;
                    border: none;
                    padding: 12px 20px;
                    border-radius: 8px;
                    font-size: 1rem;
                    cursor: pointer;
                    font-weight: bold;
                    transition: 0.3s;">
                    + Tambah Mobil Baru
                </button>
            </a>
        </div>
        <div style="margin: 25px 0;">
            <a href="tampil_mobil.php">
                <button style="
                    background-color: #28a745;
                    color: white;
                    border: none;
                    padding: 12px 20px;
                    border-radius: 8px;
                    font-size: 1rem;
                    cursor: pointer;
                    font-weight: bold;
                    transition: 0.3s;">
                    + Edit data Mobil
                </button>
            </a>
        </div>
    </main>
  

    <footer>
        <p>© 2025 Rental Mobil. Semua Hak Dilindungi.</p>
    </footer>
</body>
</html>
