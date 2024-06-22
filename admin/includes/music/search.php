<?php
include '../../classes/dbh.php';
include '../../classes/music/music.php';

// Include your Music class and establish a database connection
include 'Music.php';
$music = new Music();

// Check if a search query is provided
if (isset($_GET['query'])) {
    $query = $_GET['query'];

    // Perform the search using the Music class
    $results = $music->searchMusic($query);

    // Display the search results
    if ($results) {
        foreach ($results as $result) {
            echo '<p>' . $result['Title'] . ' by ' . $result['Artist'] . ' (' . $result['Album'] . ')</p>';
        }
    } else {
        echo 'No results found.';
    }
}

?>
