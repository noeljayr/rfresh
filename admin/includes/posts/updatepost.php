<?php
include '../../classes/dbh.php'; 
include '../../classes/post/post.php';

// Retrieve the raw POST data
$postData = file_get_contents("php://input");

// Decode the JSON data into a PHP array
$formData = json_decode($postData, true);

// Access the individual fields
$postId = $formData['postId']; // Assuming postId is included in the JSON data
$title = $formData['title'];
$content = $formData['content'];
$category = $formData['category'];
$tags = $formData['tags']; 
$platforms = $formData['platforms'];
$thumbnails = $formData['thumbnail'];
$user_id = 1;

// Create a new instance of the PostManager class
$postManager = new PostManager(); // Assuming $connect is your database connection

// Call the method to update a post and pass the data
$updateResult = $postManager->updatePost($postId, $title, $content, $tags, $category, $user_id, $thumbnails, $platforms);

// Check if the post was successfully updated
if ($updateResult) {
    echo "Post updated successfully";
} else {
    echo "Failed to update post";
}
?>
