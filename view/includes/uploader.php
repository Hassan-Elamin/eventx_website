<?php

function checkImageSize($file): bool {
    $check = getimagesize($file);
    if ($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        return true ;
    } else {
        echo "File is not an image.";
        return false;
    }
}

function uploadImage(string $name,string $selectedname = null) {
    $source = $_FILES[$name]['tmp_name'];
    $dest_dir = "uploads/";

    $filename = '';
    if ($selectedname !== null) {
        $filename = $selectedname . '.' . pathinfo($_FILES[$name]['name'], PATHINFO_EXTENSION);
    } else {
        $filename = basename($_FILES[$name]["name"]);
    }
    $destination = $dest_dir . $filename;

    $imageFileType = strtolower(pathinfo($destination, PATHINFO_EXTENSION));
    
    $uploadOk = 1;

    // Check if image file is a actual image or fake image
    if (isset($_POST["submit"])) {
        if(checkImageSize($_FILES[$name]["tmp_name"])){
            $uploadOk = 1 ;
        }else {
            $uploadOk = 0 ;
            echo 'image is too large';
        }
    }

    // Check if file already exists
    if (file_exists($destination)) {
        echo "Sorry, file already exists.";
        $uploadOk = 0;
    }

    // Check file size
    if ($_FILES[$name]["size"] > 500000) {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }

    // Allow certain file formats
    if (
        $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif"
    ) {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
        // if everything is ok, try to upload file
    } else {
        

        if (move_uploaded_file($source, $destination)) {
            return $destination ;
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }
}
