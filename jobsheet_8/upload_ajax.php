<?php

if (isset($_FILES['files'])) {
    $total_files = count($_FILES['files']['name']);
    $global_errors = array();
    $success_count = 0;
    
    $extensions = array("jpeg", "jpg", "png", "gif");
    $max_file_size = 5242880; // 5 * 1024 * 1024 bytes = 5 MB

    for ($i = 0; $i < $total_files; $i++) {
        $file_name = $_FILES['files']['name'][$i];
        $file_size = $_FILES['files']['size'][$i];
        $file_tmp  = $_FILES['files']['tmp_name'][$i];
        $file_type = $_FILES['files']['type'][$i];
        $errors    = array();
        
        @$file_ext = strtolower(end(explode('.', $file_name)));

        if (in_array($file_ext, $extensions) === false) {
            $errors[] = "File '{$file_name}' memiliki ekstensi yang tidak diizinkan. Hanya JPEG, JPG, PNG, GIF yang diperbolehkan.";
        }

        if ($file_size > $max_file_size) {
            $errors[] = "File '{$file_name}' terlalu besar. Ukuran maksimum adalah 5 MB.";
        }

        if (empty($errors)) {
            $upload_dir = "images/"; // Ubah direktori ke tempat menyimpan gambar
            
            if (!is_dir($upload_dir)) {
                mkdir($upload_dir, 0777, true);
            }

            if (move_uploaded_file($file_tmp, $upload_dir . $file_name)) {
                $success_count++;
            } else {
                 $global_errors[] = "Gagal memindahkan file '{$file_name}'.";
            }
        } else {
            $global_errors = array_merge($global_errors, $errors);
        }
    }

    if (empty($global_errors)) {
        echo "Berhasil mengunggah {$success_count} file gambar!";
    } else {
        echo "Gagal mengunggah beberapa file. Berikut detailnya:<br>" . implode("<br>", $global_errors);
    }

} else {
    echo "Tidak ada file yang dipilih.";
}
?>