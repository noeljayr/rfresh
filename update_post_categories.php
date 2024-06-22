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
    //     $categoryMappings = [
    //     'Video' => 'Videos'
    // ];
     $categoryMappings = [
        'Soca Riddims' => 'Riddims',
       ' The Riddim Nation' => 'Riddims',
       ' Bread Back Riddim' => 'Riddims',
       ' House of Riddims Productions' => 'Riddims',
        'Riddim Wise' => 'Riddims',
       ' RIDDIM WORLD RECORDS' => 'Riddims',
       ' Mosaic Riddim' => 'Riddims',
       ' Minto Play Da Riddim' => 'Riddims',
       ' Soldiers Riddim' => 'Riddims',
       ' Top Choppa Riddim' => 'Riddims',
       ' Money Time Riddim' => 'Riddims',
       ' Riddim N Nice Productions' => 'Riddims',
       ' Real Don Dada Riddim' => 'Riddims',
        'House Of Riddim' => 'Riddims',
        'Riddim Stream' => 'Riddims',
       ' Di Gyangalee Riddim Zone' => 'Riddims',
        'Rough Ride Riddim' => 'Riddims',
        'Reggae Riddims' => 'Riddims',
        'Dancehall Riddims' => 'Riddims',
        'Riddim Force Records' => 'Riddims'
    ];
    // $categoryMappings = [
    //     'News' => 'News',
    //     'Reggae Singles' => 'Singles',
    //     'Dancehall Singles' => 'Singles',
    //     'Soka Singles' => 'Singles',
    //     'Reggae Albums' => 'Albums',
    //     'Dancehall Albums' => 'Albums',
    //     'Soka Albums' => 'Albums',
    //     'Reggae Mixtapes' => 'Mixtapes',
    //     'Dancehall Mixtapes' => 'Mixtapes',
    //     'Soka Mixtapes' => 'Mixtapes',
    //     'Videos' => 'Videos'
    // ];

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
