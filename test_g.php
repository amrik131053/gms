<?php
// Load the image
$originalImage = imagecreatefrompng('D:/sig/6111011025.png');

// Get the image dimensions
$width = imagesx($originalImage);
$height = imagesy($originalImage);

// Create a new image with a transparent background
$newImage = imagecreatetruecolor($width, $height);
$transparency = imagecolorallocatealpha($newImage, 0, 0, 0, 127);
imagefill($newImage, 0, 0, $transparency);
imagesavealpha($newImage, true);

// Copy the original image to the new image with transparency
imagecopy($newImage, $originalImage, 0, 0, 0, 0, $width, $height);

// Output the image (you can save it to a file or send it to the browser)
header('Content-Type: image/png');
imagepng($newImage);

// Free up memory by destroying the images
imagedestroy($originalImage);
imagedestroy($newImage);
?>
