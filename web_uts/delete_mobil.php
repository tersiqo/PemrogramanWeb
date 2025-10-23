<?php include 'koneksi.php'; ?>

<?php
if(!isset($_GET['id'])){
    die("ID tidak ditemukan!");
}

$id = $_GET['id'];

// Ambil data mobil (untuk hapus file gambar juga)
$qSelect = pg_query($conn, "SELECT * FROM tb_mobil WHERE id=$id");
$data = pg_fetch_assoc($qSelect);

if($data){
    $gambar_path = "img/" . $data['gambar'];
    if(file_exists($gambar_path)){
        unlink($gambar_path); // hapus file gambar
    }
}

// Hapus dari database
$query = "DELETE FROM tb_mobil WHERE id=$id";
$result = pg_query($conn, $query);

if($result){
    echo "<script>alert('✅ Data mobil berhasil dihapus!'); window.location='tampil_mobil.php';</script>";
} else {
    echo "<script>alert('❌ Gagal menghapus data: " . pg_last_error($conn) . "'); window.location='tampil_mobil.php';</script>";
}
?>
