<?php
if(isset($_POST["submit"])){
    $targetdir = "uploads/";
    $targetfile = $targetdir . basename($_FILES["myfile"]["name"]);
    $fileType = strtolower(pathinfo($targetfile, PATHINFO_EXTENSION));

    $allowedExtensions = array("jpg", "jpeg", "png", "gif");
    $maxsize = 5*1024*1024;

    if (in_array($fileType, $allowedExtensions) && $_FILES["myfile"]["size"] <= $maxsize)
    {
        if (move_uploaded_file($_FILES["myfile"]["tmp_name"], $targetfile)){
            echo "File berhasil diunggah.";

            $thumbnail_width = 200;
            $uploaded_filename = $targetfile;
            $thumbnail_filename = $targetdir . "thumb_" . basename($_FILES["myfile"]["name"]);

            list($original_width, $original_height) = getimagesize($uploaded_filename);
            $thumbnail_height = floor(($original_height / $original_width) * $thumbnail_width);

            $thumbnail = imagecreatetruecolor($thumbnail_width, $thumbnail_height);

            if ($fileType == "jpeg" || $fileType == "jpg") {
                $source = imagecreatefromjpeg($uploaded_filename);
                imagecopyresampled($thumbnail, $source, 0, 0, 0, 0, $thumbnail_width, $thumbnail_height, $original_width, $original_height);
                imagejpeg($thumbnail, $thumbnail_filename, 90); // Simpan sebagai JPEG
            } elseif ($fileType == "png") {
                $source = imagecreatefrompng($uploaded_filename);
                imagecopyresampled($thumbnail, $source, 0, 0, 0, 0, $thumbnail_width, $thumbnail_height, $original_width, $original_height);
                imagepng($thumbnail, $thumbnail_filename); // Simpan sebagai PNG
            } elseif ($fileType == "gif") {
                $source = imagecreatefromgif($uploaded_filename);
                imagecopyresampled($thumbnail, $source, 0, 0, 0, 0, $thumbnail_width, $thumbnail_height, $original_width, $original_height);
                imagegif($thumbnail, $thumbnail_filename); // Simpan sebagai GIF
            }

            // Bersihkan memori
            imagedestroy($source);
            imagedestroy($thumbnail);

            // Tampilkan thumbnail
            echo "<br>Thumbnail berhasil dibuat dan ditampilkan:<br>";
            echo "<img src='$thumbnail_filename' alt='Thumbnail' style='border: 1px solid #ccc;'>";

        }
        else{
            echo "Gagal mengunggah file.";
        }
    }
    else{
        echo "File tidak valid atau melebihi ukuran maksimum yang diizinkan";
    }
}
?>