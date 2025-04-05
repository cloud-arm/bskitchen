<?php

function compressImage($source, $destination, $quality)
{
    // Get image info 
    $imgInfo = getimagesize($source);
    $mime = $imgInfo['mime'];

    // Create a new image from file 
    switch ($mime) {
        case 'image/jpeg':
            $image = imagecreatefromjpeg($source);
            imagejpeg($image, $destination, $quality);
            break;
        case 'image/png':
            $image = imagecreatefrompng($source);
            // Convert quality percentage (0-100) to compression level (0-9)
            $compressionLevel = intval((100 - $quality) / 10);
            imagepng($image, $destination, $compressionLevel);
            break;
        case 'image/gif':
            $image = imagecreatefromgif($source);
            imagegif($image, $destination);
            break;
        default:
            return false;
    }

    // Free up memory
    imagedestroy($image);

    // Return compressed image 
    return $destination;
}

function image_save($image, $img_name, $path)
{

    // File upload path 
    $uploadPath = "image/" . $path . "/";

    // Check if the directory exists, if not, create it
    if (!file_exists($uploadPath)) {
        mkdir($uploadPath, 0777, true); // Create the directory with full permissions (0777)
    }

    // If file upload form is submitted 
    if (!empty($image["name"])) {
        $status['status'] = 'error';
        $status['path'] = '';

        // File info 
        $fileName = $img_name . '.' . pathinfo($image["name"], PATHINFO_EXTENSION);
        $imageUploadPath = $uploadPath . $fileName;
        $fileType = pathinfo($imageUploadPath, PATHINFO_EXTENSION);

        // Allow certain file formats 
        $allowTypes = array('jpg', 'png', 'jpeg', 'gif');
        if (in_array($fileType, $allowTypes)) {
            // Image temp source 
            $imageTemp = $image["tmp_name"];

            // Compress size and upload image 
            $compressedImage = compressImage($imageTemp, $imageUploadPath, 60);

            if ($compressedImage) {
                $status['path'] = $imageUploadPath;
                $status['status'] = 'success';
            } else {
                $status['status'] = "Image compress failed!";
            }
        } else {
            $status['status'] = 'Sorry, only JPG, JPEG, PNG, & GIF files are allowed to upload.';
        }
    } else {
        $status['status'] = 'Please select an image file to upload.';
    }

    return $status;
}




include("class/whatsapp.php");
include("class/sms.php");
include("class/email.php");
include("class/table.php");
include("class/form.php");
include("class/invoice.php");
include("class/db_query/select.php");
include("class/db_query/insert.php");
include("class/db_query/update.php");
include("class/db_query/query.php");
