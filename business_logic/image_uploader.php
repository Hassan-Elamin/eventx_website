<?php

function uploadImageToServer( $file, $dest, $filename = null)
{
    if ($filename) {
        $filename = $filename . '.' . pathinfo($file['name'], PATHINFO_EXTENSION);
        $dest .= $filename;
    }
    //2,097,152 is 2 mb
    if ($file['size'] > (2097152 * 4)) {
        exit('invalid file size');
    }
    if (move_uploaded_file($file['tmp_name'], $dest)) {
        return $filename ?? pathinfo($file['name'], PATHINFO_FILENAME);
    }
    exit('image didn\'t upload');
}

