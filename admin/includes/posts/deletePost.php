<?php
// Include necessary files and start session if required
require_once '../../classes/dbh.php';
require_once '../../classes/post/post.php'; 

// Check if the request method is POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve the post ID from the request
    $post_id = $_POST['post_id'];

    // Create an instance of PostManager class
    $postManager = new PostManager();

    // Perform the deletion operation
    $result = $postManager->deletePostById($post_id);

    // Check if the deletion operation was successful
    if ($result) {
        echo 'success';
    } else {
        echo 'error';
        echo $result;
    }
} else {
    // If the request method is not POST, return error response
    echo 'Method not allowed';
}
?>
