<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Assuming you're using PDO for database operations
echo 'am here';
// Database connection
$host = 'localhost';
$dbname = 'reggaefr_dev2024';
$username = 'reggaefr_dev2024';
$password = 'rf2024db';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo 'Database connected successfully<br>';
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}

// Decode JSON data sent from JavaScript
$data = json_decode(file_get_contents('php://input'), true);

if (json_last_error() !== JSON_ERROR_NONE) {
    die('Invalid JSON input');
}

echo 'Data decoded<br>';

// Insert thumbnail data into the database
foreach ($data as $thumbnailData) {
    if (isset($thumbnailData['path'])) {
        $imagesArray = json_decode($thumbnailData['path'], true);

        if (json_last_error() !== JSON_ERROR_NONE) {
            echo 'Invalid JSON in path<br>';
            continue;
        }

        // Assuming imagesArray is an array of objects and we are interested in "image:loc"
        foreach ($imagesArray as $image) {
            if (isset($image['image:loc'])) {
                $path = $image['image:loc'];
                // echo 'Extracted path: ' . $path . '<br>';

                // Check if the path is empty
                if (empty($path)) {
                    $path = "empty";
                }

                // Insert into the database
                $sql = "INSERT INTO thumbnail (post_id, path) VALUES (:post_id, :path)";
                $stmt = $pdo->prepare($sql);

                try {
                    $stmt->bindParam(':post_id', $thumbnailData['post_id']);
                    $stmt->bindParam(':path', $path);
                    $stmt->execute();
                    echo 'Inserted: ' . $thumbnailData['post_id'] . ' - ' . $path . '<br>';
                } catch (PDOException $e) {
                    echo 'Insert failed: ' . $e->getMessage() . '<br>';
                }
            }
        }
    }
}
echo "Thumbnail data inserted";
?>
