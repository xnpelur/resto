<?php

namespace App\Core;

class Model
{
    /** Return array of objects stored inside $table */
    protected function getFieldsFrom(string $table, string $where = '')
    {
        $sql = "SELECT * FROM $table";
        if ($where !== '') {
            $sql .= " WHERE " . $where;
        }

        return Database::query($sql);
    }

    /** Insert new row to $table */
    protected function insertTo(string $table, array $args)
    {
        $params = array_keys($args);
        $placeholders = array_map(fn($s) => ":$s", $params);

        $sql = "INSERT INTO $table (" . implode(', ', $params) . ") VALUES (" . implode(', ', $placeholders) . ")";

        Database::executePrepared($sql, $args);
    }

    /** Update value with $id inside $table */
    protected function update(string $table, array $args, int $id)
    {
        $params = array_map(fn($s) => "$s = :$s", array_keys($args));
        $sql = "UPDATE $table SET " . implode(', ', $params) . " WHERE id = $id";

        Database::executePrepared($sql, $args);
    }

    /** Update each $args key to $args value inside $table */
    protected function updateValues(string $table, array $args)
    {
        $params = [];
        foreach ($args as $key => $value) {
            if ($value === NULL) {
                unset($args[$key]);
                continue;
            }
            $params[] = "WHEN name = '$key' THEN :$key";
        }

        $sql = "UPDATE $table SET value = CASE " . implode(' ', $params) . " ELSE `value` END";

        Database::executePrepared($sql, $args);
    }

    /** Delete row from $table */
    protected function deleteFrom(string $table, string $where)
    {
        $sql = "DELETE FROM $table WHERE $where";
        Database::query($sql);
    }

    /** Upload image from user with validation */
    protected function uploadImage(array $image)
    {
        $targetFile = 'storage/' . basename($image['name']);
        $targetFileFull = dirname(__DIR__, 2) . '/public/' . $targetFile;
        $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

        if (($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") || getimagesize($image['tmp_name']) === false) {
            // File is not an image
            return false;
        }

        if ($image['size'] > 4000000) {
            // File is too big
            return false;
        }

        if (file_exists($targetFileFull)) {

            if (filesize($targetFileFull) == filesize($image['tmp_name']) && sha1_file($targetFileFull) == sha1_file($image['tmp_name'])) {
                // Files are equal
                return $targetFile;
            }

            $file['name'] = str_replace('.' . $imageFileType, '_1.' . $imageFileType, $image['name']);

            return $this->uploadImage($image);
        }

        if (move_uploaded_file($image["tmp_name"], $targetFileFull)) {
            // Success
            return $targetFile;
        } else {
            // Error while uploading file
            return false;
        }
    }

    /** Check if image defined by path is no longer used. If number of usages equals to 0, delete it. */
    protected function checkImage(string $imagePath)
    {
        $imageCount = count($this->getFieldsFrom('menu', "image = '$imagePath'"))
            + count($this->getFieldsFrom('reviews', "image = '$imagePath'"))
            + count($this->getFieldsFrom('options', "value = '$imagePath'"));
        
        if ($imageCount === 0 && file_exists($imagePath)) {
            unlink($imagePath);
        }
    }
}
