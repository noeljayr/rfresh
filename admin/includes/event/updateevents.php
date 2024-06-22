<?php
// Include necessary files and start session if required
// Include the Event class
include '../../classes/dbh.php'; 
include '../../classes/events/event.php';

// Check if the request method is POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve form data
    $eventId = $_POST['event_id'];
    $title = $_POST['title'];
    $date = $_POST['event_date'];
    $description = $_POST['description'];

    if ( isset($_FILES['image']) ){
            // Handle image upload
            $targetDir = "../../../public/images/";
            $imageName = basename($_FILES["image"]["name"]);
            $targetFilePath = $targetDir . $imageName;
            $fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);

            // Check if image file is a actual image or fake image
            $check = getimagesize($_FILES["image"]["tmp_name"]);
            if($check !== false) {
                    // Allow certain file formats
                    if(in_array($fileType, array("jpg", "jpeg", "png", "gif"))) {
                        // Upload file to server
                        if(move_uploaded_file($_FILES["image"]["tmp_name"], $targetFilePath)){
                            // Image uploaded successfully, update event data
                            $eventManager = new EventManager();
                            $result = $eventManager->updateEvent($eventId, $title, $date, $description, "/public/images/".$imageName);
                            
                            if($result) {
                                // Event data updated successfully
                                echo 'success';
                            } else {
                                // Failed to update event data
                                echo 'error';
                            }
                        } else {
                            // Failed to move uploaded file
                            echo 'error';
                        }
                    } else {
                        // Invalid file format
                        echo 'error';
                    }
                } else {
                    // File is not an image
                    echo 'error';
                }
            } else {
                // If the request method is not POST, return error response
                echo 'Method not allowed';
            }
    } else {  
        $eventManager = new EventManager();
                    $result = $eventManager->updateEvent2($eventId, $title, $date, $description);
                    
                    if($result) {
                        // Event data updated successfully
                        echo 'success';
                    } else {
                        // Failed to update event data
                        echo 'error';
                    }    
    }
?>
