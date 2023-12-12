<?php
// Load the signature image
$signaturePath = 'D:/sig/sign.jpg';
$signature = imagecreatefromjpeg($signaturePath);

// Create a new image with a transparent background
$width = imagesx($signature);
$height = imagesy($signature);
$transparentSignature = imagecreatetruecolor($width, $height);
$transparencyColor = imagecolorallocatealpha($transparentSignature, 0, 51, 0, 102);
imagefill($transparentSignature, 0, 0, $transparencyColor);
imagesavealpha($transparentSignature, true);

// Copy the signature onto the transparent background
imagecopy($transparentSignature, $signature, 0, 0, 0, 0, $width, $height);

// Output the image (you can also save it to a file or send it to the browser)
header('Content-Type: image/png');
imagepng($transparentSignature);

// Free up memory
imagedestroy($signature);
imagedestroy($transparentSignature);
?>
