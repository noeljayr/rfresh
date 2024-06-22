<?php
    require '../../classes/dbh.php';
    require '../../classes/events/event.php';
    
// Check if form data is received
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Retrieve form data
    $title = $_POST["even-title"];
    $eventDate = $_POST["event_date"];
    $description = $_POST["event-description"];
    
    // Handle image upload
    $imgPath = "/public/images/";
    if (isset($_FILES["image"]) && $_FILES["image"]["error"] === UPLOAD_ERR_OK) {
        $targetDir = "../../../public/images/";
        $imgName = "event_" . time() . "_" . basename($_FILES["image"]["name"]);
        $targetPath = $targetDir . $imgName;
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetPath)) {
            $imgPath .= $imgName; // Concatenate the image name to the path
        } else {
            echo "Failed to upload image.";
            exit();
        }
    }

    // Now you can use $title, $eventDate, $description, and $imgPath to insert into the database
    $eventManager = new EventManager();
    $eventId = $eventManager->createEvent($title, $eventDate, $description, $imgPath);

    // Handle response from the database
    if ($eventId) {
        echo "Event created successfully with ID: " . $eventId;
    } else {
        echo "Failed to create event.";
    }
} else {
    // If the request method is not POST, return an error
    echo "Invalid request.";
}
?>
