<?php
// Assuming you're using PDO for database operations

// Database connection
$host = 'localhost';
$dbname = 'reggaefr_dev2024';
$username = 'reggaefr_dev2024';
$password = 'rf2024db';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}

// Decode JSON data sent from JavaScript
$data = json_decode(file_get_contents('php://input'), true);
// print_r($data);
echo "this is a test";

// Insert data into the database
foreach ($data as $postData) {
    $sql = "INSERT INTO post (post_id, title, post_name, content, user_id, creation_date, modification_date,  post_status) VALUES (:post_id, :title, :post_name, :content, :user_id, :creation_date, :modification_date,  :post_status)";
    $stmt = $pdo->prepare($sql);
    // Bind parameters
    $stmt->bindParam(':post_id', $postData['post_id']);
    $stmt->bindParam(':title', $postData['title']);
    $stmt->bindParam(':post_name', $postData['post_name']);
    $stmt->bindParam(':content', $postData['content']);
    $stmt->bindParam(':user_id', $postData['user_id']);
    $stmt->bindParam(':creation_date', $postData['creation_date']);
    $stmt->bindParam(':modification_date', $postData['modification_date']);
    // $stmt->bindParam(':post_type', $postData['post_type']);
    $stmt->bindParam(':post_status', $postData['post_status']);
    $stmt->execute();
}

echo "Data inserted successfully!";
?>
