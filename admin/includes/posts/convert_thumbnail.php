<?php
// Get the base64 thumbnail data from the request
$data = json_decode(file_get_contents('php://input'), true);
$base64Data = $data['thumb'];

// Convert base64 thumbnail to JPEG and save it
$imageName = 'thumbnail_' . time() . '.jpg'; // Unique name
$imagePath = '../../../public/images/' . $imageName; // Path to save the image
$imagePath2 = '/reggaefresh/public/images/' . $imageName; // Path to save the image
if (file_put_contents($imagePath, base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $base64Data)))) {
    // Conversion successful
    $response = array('success' => true, 'filePath' => $imagePath2);
} else {
    // Conversion failed
    $response = array('success' => false);
}

// Send back the response
echo json_encode($response);
?>
