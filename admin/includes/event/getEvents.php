<?php
    require '../../classes/dbh.php';
    require '../../classes/events/event.php';

    // Create an instance of the EventManager class
    $eventManager = new EventManager();

    // Call the getEvents function to retrieve events data
    $eventsData = $eventManager->getEvents();

    // Return the events data as JSON
    header('Content-Type: application/json');
    echo 'var dataEvents = ' . json_encode($eventsData) . ';';
    ?>
