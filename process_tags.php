<?php
// Database credentials
$host = 'localhost';
$dbname = 'reggaefr_dev2024';
$username = 'reggaefr_dev2024';
$password = 'rf2024db';

try {
    // Establish a database connection using PDO
    $pdo = new PDO("mysql:host=$host;dbname=$dbName", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Get JSON data from POST request
    $data = json_decode(file_get_contents('php://input'), true);

    $relationships = json_decode($data['relationships'], true);
    $terms = json_decode($data['terms'], true);
    echo count($relationships). "<br>";
    echo count($terms). "<br>";


    // Create an associative array to map term_id to term name
    $termsMap = [];
    foreach ($terms as $term) {
        $termsMap[$term['term_id']] = $term['name'];
    }


    // Prepare the SQL statement for inserting tags
    $stmt = $pdo->prepare("INSERT INTO tags (tag_name, post_id) VALUES (?, ?)");

    // Process relationships data
    foreach ($relationships as $relation) {
        $postId = $relation['object_id'];
        $termId = $relation['term_taxonomy_id'];
        
        if (isset($termsMap[$termId])) {
            $tagName = $termsMap[$termId];
            echo "post_id: ". $postId . "tag Name" . $tagName . "<br>";
            // Insert the tag into the database
            if ($stmt->execute([$tagName, $postId])) {
            } else {
                echo "Failed to insert: $tagName, $postId\n";
                print_r($stmt->errorInfo());
            }
        }
    }

    echo "Tags inserted successfully.";
} catch (PDOException $e) {
    // Handle any errors
    echo "<br>Error: " . $e->getMessage();
}
?>
