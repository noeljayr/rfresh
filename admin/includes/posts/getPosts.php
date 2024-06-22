<?php
// Include the PostManager class
include '../../classes/dbh.php'; 
include '../../classes/post/post.php';

// Create an instance of the PostManager class
$postManager = new PostManager();

// Call the getPosts method to retrieve post data
$posts = $postManager->getPosts();

// Send the retrieved post data as JSON response
header('Content-Type: application/json');
echo json_encode($posts);
?>
