<?php include 'koneksi.php'; ?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tambah Mobil - Rental Mobil</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <header>
    <h1>Tambah Data Mobil ke Database</h1>
  </header>

  <main>
    <form action="" method="POST" enctype="multipart/form-data" style="max-width:500px;margin:auto;">
      <label>Nama Mobil</label><br>
      <input type="text" name="nama_mobil" required><br><br>

      <label>Merk</label><br>
      <input type="text" name="merk" required><br><br>

      <label>Tahun</label><br>
      <input type="number" name="tahun" required><br><br>

      <label>Harga Sewa (per hari)</label><br>
      <input type="number" name="harga" required><br><br>

      <label>Status</label><br>
      <select name="status">
        <option value="Tersedia">Tersedia</option>
        <option value="Sedang Disewa">Sedang Disewa</option>
      </select><br><br>

      <label>Kategori</label><br>
      <select name="kategori">
        <option value="lcgc">LCGC</option>
        <option value="mpv">MPV</option>
        <option value="suv">SUV</option>
        <option value="pickup">Niaga</option>
      </select><br><br>

      <label>Upload Gambar Mobil</label><br>
      <input type="file" name="gambar" accept="image/*" required><br><br>

      <button type="submit" name="simpan" style="
          background-color:#007bff;
          color:white;
          border:none;
          padding:10px 18px;
          border-radius:8px;
          cursor:pointer;
          font-size:1rem;
      ">Simpan Mobil</button>
    </form>

    <?php
    if(isset($_POST['simpan'])){
        $nama = $_POST['nama_mobil'];
        $merk = $_POST['merk'];
        $tahun = $_POST['tahun'];
        $harga = $_POST['harga'];
        $status = $_POST['status'];
        $kategori = $_POST['kategori'];

        // folder penyimpanan gambar
        $target_dir = "img/";
        $file_name = basename($_FILES["gambar"]["name"]);
        $target_file = $target_dir . $file_name;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // cek validasi file
        $check = getimagesize($_FILES["gambar"]["tmp_name"]);
        if($check === false){
            echo "<p style='color:red;text-align:center;'>❌ File bukan gambar valid.</p>";
            exit;
        }

        // maksimal 2MB
        if($_FILES["gambar"]["size"] > 2000000){
            echo "<p style='color:red;text-align:center;'>❌ Ukuran gambar maksimal 2MB.</p>";
            exit;
        }

        // format yang diizinkan
        $allowed = ['jpg','jpeg','png','gif'];
        if(!in_array($imageFileType, $allowed)){
            echo "<p style='color:red;text-align:center;'>❌ Hanya format JPG, JPEG, PNG, dan GIF yang diperbolehkan.</p>";
            exit;
        }

        // upload ke folder img/
        if(move_uploaded_file($_FILES["gambar"]["tmp_name"], $target_file)){
            // simpan data ke database
            $query = "INSERT INTO tb_mobil (nama_mobil, merk, tahun, harga, status, kategori, gambar)
                      VALUES ('$nama', '$merk', '$tahun', '$harga', '$status', '$kategori', '$file_name')";
            $result = pg_query($conn, $query);

            if($result){
                echo "<p style='color:green;text-align:center;'>✅ Data mobil dan gambar berhasil disimpan!</p>";
            } else {
                echo "<p style='color:red;text-align:center;'>❌ Gagal menyimpan ke database: " . pg_last_error($conn) . "</p>";
            }
        } else {
            echo "<p style='color:red;text-align:center;'>❌ Upload gambar gagal.</p>";
        }
    }
    ?>

    <!-- Tombol Kembali ke Beranda -->
    <div style="text-align:center; margin-top:40px;">
      <a href="index.php">
        <button style="
            background-color:#28a745;
            color:white;
            border:none;
            padding:10px 20px;
            border-radius:8px;
            cursor:pointer;
            font-size:1rem;
        ">⬅ Kembali ke Beranda</button>
      </a>
    </div>
  </main>
</body>
</html>
/