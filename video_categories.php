<?php
// Database credentials
$host = 'localhost';
$dbname = 'reggaefr_dev2024';
$username = 'reggaefr_dev2024';
$password = 'rf2024db';

try {
    // Establish a database connection using PDO
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Get JSON data from POST request
    $data = json_decode(file_get_contents('php://input'), true);
    $tags = $data['tags'];

    // Define category mappings
        $categoryMappings = [
        'Video' => 'Videos'
    ];

    // Prepare the SQL statement for updating post category
    $stmt = $pdo->prepare("UPDATE post SET category = ? WHERE post_id = ?");

    // Process tags data
    foreach ($tags as $tag) {
        $tagName = $tag['tag_name'];
        $postId = $tag['post_id'];

        if (isset($categoryMappings[$tagName])) {
            $category = $categoryMappings[$tagName];
            // Update the post category in the database
            if ($stmt->execute([$category, $postId])) {
                echo "Updated post_id $postId to category $category\n";
            } else {
                echo "Failed to update post_id $postId to category $category\n";
                print_r($stmt->errorInfo());
            }
        }
    }

    echo "Post categories updated successfully.";
} catch (PDOException $e) {
    // Handle any errors
    echo "Error: " . $e->getMessage();
}
?>
