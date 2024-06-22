<?php
include '../../classes/dbh.php'; 
include '../../classes/post/post.php';

// Retrieve the raw POST data
$postData = file_get_contents("php://input");

// Decode the JSON data into a PHP array
$formData = json_decode($postData, true);
$user_id = 1;

// Access the individual fields
$title = $formData['title'];
$content = $formData['content'];
$category = $formData['category'];
$tags = $formData['tags'];
$platforms = $formData['platforms'];
$thumbnails = $formData['thumbnail'];

// Create a new instance of the PostManager class
$postManager = new PostManager(); // Assuming $connect is your database connection

// Call the method to create a post and pass the data
$postId = $postManager->createPost($title, $content, $tags, $category, $user_id, $thumbnails, $platforms);

// Optionally, you can check if the post was successfully created
if ($postId) {
    echo "Post created successfully with ID: " . $postId;
} else {
    echo "Failed to create post";
}
?>
