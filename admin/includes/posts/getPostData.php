<?php
include '../../classes/dbh.php'; 
include '../../classes/post/post.php';

// Check if the post_id parameter is set
if(isset($_GET['post_id'])) {
    // Retrieve post data by post_id
    $postManager = new PostManager();
    $post_id = $_GET['post_id'];
    $postData = $postManager->getPostById($post_id);

    // Return the post data as JSON
    header('Content-Type: application/json');
    echo json_encode($postData);
} else {
    // Return an error message if post_id parameter is missing
    echo json_encode(array('error' => 'Post ID parameter is missing'));
}
?>
