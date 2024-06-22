<?php
// Include the PostManager class
require_once 'classes/dbh.php'; 
require_once 'classes/post/post.php';

// Create an instance of the PostManager class
$postManager = new PostManager();

// Call the getPosts method to retrieve post data
$posts = $postManager->getPosts();

// Encode the retrieved post data as JSON
$postJSON = json_encode($posts);
?>
