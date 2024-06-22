<?php
// upload.php

// Step 1: Receive base64 images from the client
$data = json_decode(file_get_contents('php://input'), true);

$imageNames = [];

// Step 2: Convert base64 images to JPEG and save them in a folder
foreach ($data as $index => $base64) {
    $imageName = 'image_' . time() . '_' . $index . '.jpg'; // Unique name
    $imagePath = __DIR__ . '/../../../public/images/' . $imageName; // Absolute path
    file_put_contents($imagePath, base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $base64)));
    $imageNames[] = $imageName;
}

// Step 3: Send back the image names to the client
echo json_encode($imageNames);

?>
