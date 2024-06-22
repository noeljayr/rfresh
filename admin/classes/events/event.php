<?php

// require_once 'dbh.php'; // Assuming this file contains your database connection

class EventManager extends Dbh
{
    // Method to create a new event
    public function createEvent($title, $eventDate, $description, $imgPath)
    {
        $conn = $this->connect();
        $stmt = $conn->prepare("INSERT INTO events (title, event_date, description, imgPath) VALUES (?, ?, ?, ?)");
        $stmt->execute([$title, $eventDate, $description, $imgPath]);
        return $conn->lastInsertId(); // Return the ID of the newly created event
    }

    // Method to update an existing event
    public function updateEvent($eventId, $title, $eventDate, $description, $imgPath)
    {
        $conn = $this->connect();
        $stmt = $conn->prepare("UPDATE events SET title = ?, event_date = ?, description = ?, imgPath = ?, updated_at = CURRENT_TIMESTAMP WHERE event_id = ?");
        $stmt->execute([$title, $eventDate, $description, $imgPath, $eventId]);
        return $stmt->rowCount(); // Return the number of rows affected
    }
    // Method to update an existing event
    public function updateEvent2($eventId, $title, $eventDate, $description)
    {
        $conn = $this->connect();
        $stmt = $conn->prepare("UPDATE events SET title = ?, event_date = ?, description = ?,  updated_at = CURRENT_TIMESTAMP WHERE event_id = ?");
        $stmt->execute([$title, $eventDate, $description,  $eventId]);
        return $stmt->rowCount(); // Return the number of rows affected
    }

    // Method to get an event by ID
    public function getEventById($eventId)
    {
        $conn = $this->connect();
        $stmt = $conn->prepare("SELECT * FROM events WHERE event_id = ?");
        $stmt->execute([$eventId]);
        return $stmt->fetch(PDO::FETCH_ASSOC); // Return the event as an associative array
    }

    // Method to get all events
    public function getEvents()
    {
        $conn = $this->connect();
        $stmt = $conn->prepare("SELECT * FROM events");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC); // Return all events as an array of associative arrays
    }
    // Function to retrieve events in descending order
        public function getEventsDescending() {
            $stmt = $this->connect()->prepare("
                SELECT * FROM events ORDER BY event_date DESC
            ");
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

    // In Event class

// public function updateEvent($eventId, $title, $date, $description, $imgPath) {
//     try {
//         // Prepare SQL statement to update event data
//         $stmt = $this->connect()->prepare("
//             UPDATE events
//             SET title = :title, event_date = :date, description = :description, imgPath = :imgPath
//             WHERE event_id = :eventId
//         ");

//         // Bind parameters
//         $stmt->bindParam(':title', $title, PDO::PARAM_STR);
//         $stmt->bindParam(':date', $date, PDO::PARAM_STR);
//         $stmt->bindParam(':description', $description, PDO::PARAM_STR);
//         $stmt->bindParam(':imgPath', $imgPath, PDO::PARAM_STR);
//         $stmt->bindParam(':eventId', $eventId, PDO::PARAM_INT);

//         // Execute the statement
//         $stmt->execute();

//         // Check if any rows were affected
//         if ($stmt->rowCount() > 0) {
//             // Event data updated successfully
//             return true;
//         } else {
//             // No rows were affected, indicating no changes were made
//             return false;
//         }
//     } catch (PDOException $e) {
//         // Handle any database errors
//         // You can log the error, return false, or throw an exception
//         return false;
//     }
// }

    // public function getEvents() {
    //     $conn = $this->connect();
    
    //     // Query to retrieve events data
    //     $sql = "SELECT * FROM events";
    
    //     // Prepare the statement
    //     $stmt = $conn->prepare($sql);
    
    //     // Execute the statement
    //     $stmt->execute();
    
    //     // Fetch all rows as associative arrays
    //     $events = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    //     // Return the events data
    //     return $events;
    // }
    

    // Method to get events by date
    public function getEventsByDate($date)
    {
        $conn = $this->connect();
        $stmt = $conn->prepare("SELECT * FROM events WHERE event_date = ?");
        $stmt->execute([$date]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC); // Return events for the given date as an array of associative arrays
    }
}

?>
