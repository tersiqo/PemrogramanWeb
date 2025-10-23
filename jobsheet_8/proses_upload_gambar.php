<?php
$targetDirectory = "uploads/";

if (!file_exists($targetDirectory)) {
    mkdir($targetDirectory, 0777, true);
}

$allowedExtensions = array("jpg", "jpeg", "png", "gif");

$maxFileSize = 5 * 1024 * 1024; // 5 MB

if (isset($_FILES['gambar_files']) && !empty($_FILES['gambar_files']['name'][0])) {
    $totalFiles = count($_FILES['gambar_files']['name']);

    for ($i = 0; $i < $totalFiles; $i++) {
        $fileName = $_FILES['gambar_files']['name'][$i];
        $fileSize = $_FILES['gambar_files']['size'][$i];
        $fileTmpName = $_FILES['gambar_files']['tmp_name'][$i];
        $fileError = $_FILES['gambar_files']['error'][$i];
        
        $fileExt = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
        
        $targetFile = $targetDirectory . $fileName;

        if (in_array($fileExt, $allowedExtensions)) {
            if ($fileSize <= $maxFileSize) {
                if ($fileError === 0) { 
                    if (move_uploaded_file($fileTmpName, $targetFile)) {
                        echo "File $fileName berhasil diunggah.<br>";
                    } else {
                        echo "Gagal mengunggah file $fileName.<br>";
                    }
                } else {
                    echo "Gagal mengunggah file $fileName karena error server (kode: $fileError).<br>";
                }
            } else {
                echo "File $fileName gagal diunggah. Ukuran file melebihi " . ($maxFileSize / (1024*1024)) . " MB.<br>";
            }
        } else {
            echo "File $fileName gagal diunggah. Hanya file JPG, JPEG, PNG, dan GIF yang diizinkan.<br>";
        }
    }
} else {
    echo "Tidak ada file gambar yang diunggah.";
}
?>