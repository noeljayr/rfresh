<?php
    require '../../classes/dbh.php';
    require '../../classes/events/event.php';

// Query to retrieve events data from the database
$sql = "SELECT * FROM events";

// Execute the query
$result = $connection->query($sql);

// Check if there are any rows returned
if ($result->num_rows > 0) {
    // Fetch all rows as an associative array
    $events = $result->fetch_all(MYSQLI_ASSOC);

    // Encode the events data in JSON format
    $eventJSON = json_encode($events);

    // Output the JSON string
    echo $eventJSON;
} else {
    // If no events found, return an empty array as JSON
    echo json_encode([]);
}

// Close the database connection
$connection->close();
?>
