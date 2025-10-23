<?php include 'koneksi.php'; ?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Mobil - Rental Mobil</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<header>
    <h1>Daftar Mobil dari Database</h1>
</header>

<main style="max-width:1000px;margin:auto;">
    <table border="1" cellpadding="10" cellspacing="0" style="width:100%; border-collapse:collapse;">
        <tr style="background-color:#007bff; color:white;">
            <th>No</th>
            <th>Nama Mobil</th>
            <th>Merk</th>
            <th>Tahun</th>
            <th>Harga</th>
            <th>Status</th>
            <th>Kategori</th>
            <th>Gambar</th>
            <th>Aksi</th>
        </tr>

        <?php
        $result = pg_query($conn, "SELECT * FROM tb_mobil ORDER BY id ASC");
        $no = 1;
        while($row = pg_fetch_assoc($result)){
            echo "<tr>
                <td>{$no}</td>
                <td>{$row['nama_mobil']}</td>
                <td>{$row['merk']}</td>
                <td>{$row['tahun']}</td>
                <td>Rp " . number_format($row['harga'], 0, ',', '.') . "</td>
                <td>{$row['status']}</td>
                <td>{$row['kategori']}</td>
                <td><img src='img/{$row['gambar']}' width='100'></td>
                <td style='text-align:center;'>
                    <a href='edit_mobil.php?id={$row['id']}' style='color:#28a745;font-weight:bold;'>Edit</a> | 
                    <a href='delete_mobil.php?id={$row['id']}' onclick=\"return confirm('Yakin ingin menghapus mobil ini?')\" style='color:#dc3545;font-weight:bold;'>Hapus</a>
                </td>
            </tr>";
            $no++;
        }
        ?>
    </table>

    <div style="text-align:center;margin-top:25px;">
        <a href="insert_mobil.php">
            <button style="background-color:#28a745;color:white;padding:10px 20px;border:none;border-radius:8px;">+ Tambah Mobil</button>
        </a>
        <a href="index.php">
            <button style="background-color:#007bff;color:white;padding:10px 20px;border:none;border-radius:8px;">⬅ Kembali ke Beranda</button>
        </a>
    </div>
</main>

</body>
</html>
/