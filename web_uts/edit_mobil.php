<?php include 'koneksi.php'; ?>

<?php
if (!isset($_GET['id'])) {
    die("ID Mobil tidak ditemukan!");
}

$id = $_GET['id'];
$result = pg_query($conn, "SELECT * FROM tb_mobil WHERE id=$id");
$data = pg_fetch_assoc($result);

if (!$data) {
    die("Data mobil tidak ditemukan!");
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Edit Mobil - Rental Mobil</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
<header>
  <h1>Edit Data Mobil</h1>
</header>

<main>
  <form action="" method="POST" enctype="multipart/form-data" style="max-width:500px;margin:auto;">
    <input type="hidden" name="id" value="<?php echo $data['id']; ?>">

    <label>Nama Mobil</label><br>
    <input type="text" name="nama_mobil" value="<?php echo $data['nama_mobil']; ?>" required><br><br>

    <label>Merk</label><br>
    <input type="text" name="merk" value="<?php echo $data['merk']; ?>" required><br><br>

    <label>Tahun</label><br>
    <input type="number" name="tahun" value="<?php echo $data['tahun']; ?>" required><br><br>

    <label>Harga Sewa (per hari)</label><br>
    <input type="number" name="harga" value="<?php echo $data['harga']; ?>" required><br><br>

    <label>Status</label><br>
    <select name="status">
        <option value="Tersedia" <?php if($data['status']=='Tersedia') echo 'selected'; ?>>Tersedia</option>
        <option value="Sedang Disewa" <?php if($data['status']=='Sedang Disewa') echo 'selected'; ?>>Sedang Disewa</option>
    </select><br><br>

    <label>Kategori</label><br>
    <select name="kategori">
        <option value="lcgc" <?php if($data['kategori']=='lcgc') echo 'selected'; ?>>LCGC</option>
        <option value="mpv" <?php if($data['kategori']=='mpv') echo 'selected'; ?>>MPV</option>
        <option value="suv" <?php if($data['kategori']=='suv') echo 'selected'; ?>>SUV</option>
        <option value="pickup" <?php if($data['kategori']=='pickup') echo 'selected'; ?>>Niaga</option>
    </select><br><br>

    <label>Gambar Saat Ini</label><br>
    <img src="img/<?php echo $data['gambar']; ?>" width="120"><br><br>

    <label>Ganti Gambar (Opsional)</label><br>
    <input type="file" name="gambar" accept="image/*"><br><br>

    <button type="submit" name="update" style="background-color:#007bff;color:white;border:none;padding:10px 18px;border-radius:8px;">Simpan Perubahan</button>
  </form>

  <?php
  if(isset($_POST['update'])){
      $id = $_POST['id'];
      $nama = $_POST['nama_mobil'];
      $merk = $_POST['merk'];
      $tahun = $_POST['tahun'];
      $harga = $_POST['harga'];
      $status = $_POST['status'];
      $kategori = $_POST['kategori'];

      // Jika user upload gambar baru
      if($_FILES["gambar"]["name"] != ""){
          $target_dir = "img/";
          $file_name = basename($_FILES["gambar"]["name"]);
          $target_file = $target_dir . $file_name;

          move_uploaded_file($_FILES["gambar"]["tmp_name"], $target_file);

          $query = "UPDATE tb_mobil SET 
                      nama_mobil='$nama', merk='$merk', tahun='$tahun',
                      harga='$harga', status='$status', kategori='$kategori', gambar='$file_name'
                    WHERE id=$id";
      } else {
          $query = "UPDATE tb_mobil SET 
                      nama_mobil='$nama', merk='$merk', tahun='$tahun',
                      harga='$harga', status='$status', kategori='$kategori'
                    WHERE id=$id";
      }

      $result = pg_query($conn, $query);

      if($result){
          echo "<p style='color:green;text-align:center;'>✅ Data mobil berhasil diperbarui!</p>";
      } else {
          echo "<p style='color:red;text-align:center;'>❌ Gagal update data: " . pg_last_error($conn) . "</p>";
      }
  }
  ?>

  <div style="text-align:center;margin-top:30px;">
    <a href="tampil_mobil.php">
      <button style="background-color:#28a745;color:white;border:none;padding:10px 20px;border-radius:8px;">⬅ Kembali ke Daftar Mobil</button>
    </a>
  </div>
</main>

</body>
</html>
/