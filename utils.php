<?php

function upload_image(array $file)
{
    $target_file = 'storage/' . basename($file['name']);
    $image_file_type = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    if (($image_file_type != "jpg" && $image_file_type != "png" && $image_file_type != "jpeg") || getimagesize($file['tmp_name']) === false) {
        // File is not an image
        return false;
    }

    if (file_exists($target_file)) {

        if (files_equal($target_file, $file['tmp_name'])) {
            return $target_file;
        }
        
        $file['name'] = str_replace('.' . $image_file_type, '_1.' . $image_file_type, $file['name']);

        return upload_image($file);
    }

    if ($file['size'] > 500000) {
        // File is too big
        return false;
    }

    if (move_uploaded_file($file["tmp_name"], $target_file)) {
        // Success
        return $target_file;
    } else {
        // Error while file upload
        return false;
    }
}

function files_equal($file1, $file2)
{
    if (filesize($file1) == filesize($file2)) {

        if (sha1_file($file1) == sha1_file($file2)) {
            return true;
        }

    }

    return false;
}