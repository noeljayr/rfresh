<?php

class PostManager extends Dbh {

    public function testFunction()
    {
        return "this is a test function";
    }
    
    public function createPost($title, $content, $tags, $category, $user_id, $thumbnails, $platforms) {
        // Initialize the database connection
        $conn = $this->connect();
    
        // Insert post into the database
        $stmt = $conn->prepare("INSERT INTO post (title, content, category, user_id) VALUES (?, ?, ?, ?)");
        $stmt->execute([$title, $content, $category, $user_id]);
    
        // Get the last inserted post ID
        $postId = $conn->lastInsertId();

        // Insert tags into the tags table
        if (!empty($tags)) {
            foreach ($tags as $tagName) {
                $stmt = $conn->prepare("INSERT INTO tags (tag_name, post_id) VALUES (?, ?)");
                $stmt->execute([$tagName, $postId]);
            }
        }

        // Insert thumbnails into the database
        if (!empty($thumbnails)) {
            $stmt = $conn->prepare("INSERT INTO thumbnail (post_id, path, alt) VALUES (?, ?, ?)");
            $stmt->execute([$postId, $thumbnails['path'], $thumbnails['alternative']]);
        }

        // Insert platforms into the database
        if (!empty($platforms)) {
            foreach ($platforms as $platform) {
                $stmt = $conn->prepare("INSERT INTO platform (post_id, platform_name, link) VALUES (?, ?, ?)");
                $stmt->execute([$postId, $platform['name'], $platform['link']]);
            }
        }
    
        // Return the post ID
        return $postId;
    }

    

    public function updatePost($postId, $title, $content, $tags, $category, $user_id, $thumbnails, $platforms) {
        // Initialize the database connection
        $conn = $this->connect();
    
        // Update post in the database
        $stmt = $conn->prepare("UPDATE post SET title = ?, content = ?, category = ?, user_id = ? WHERE post_id = ?");
        $stmt->execute([$title, $content, $category, $user_id, $postId]);
    
        // Delete existing tags for this post
        $stmt = $conn->prepare("DELETE FROM tags WHERE post_id = ?");
        $stmt->execute([$postId]);
    
        // Insert new tags into the tags table
        if (!empty($tags)) {
            foreach ($tags as $tagName) {
                $stmt = $conn->prepare("INSERT INTO tags (tag_name, post_id) VALUES (?, ?)");
                $stmt->execute([$tagName, $postId]);
            }
        }
    
        // Delete existing thumbnails for this post
        if (!empty($thumbnails)){
            $stmt = $conn->prepare("DELETE FROM thumbnail WHERE post_id = ?");
            $stmt->execute([$postId]);
        
            // Insert new thumbnails into the database
            if (!empty($thumbnails)) {
                $stmt = $conn->prepare("INSERT INTO thumbnail (post_id, path, alt) VALUES (?, ?, ?)");
                $stmt->execute([$postId, $thumbnails['path'], $thumbnails['alternative']]);
            }
        }
    
        // Delete existing platforms for this post
        $stmt = $conn->prepare("DELETE FROM platform WHERE post_id = ?");
        $stmt->execute([$postId]);
    
        // Insert new platforms into the database
        if (!empty($platforms)) {
            foreach ($platforms as $platform) {
                $stmt = $conn->prepare("INSERT INTO platform (post_id, platform_name, link) VALUES (?, ?, ?)");
                $stmt->execute([$postId, $platform['platform_name'], $platform['link']]);
            }
        }
    
        // Return the updated post ID
        return $postId;
    }

    // Function to retrieve posts with category "news" including thumbnail data
public function getNewsPosts() {
    $stmt = $this->connect()->prepare("
        SELECT p.*, t.path AS thumbnail_path, t.alt AS thumbnail_alt
        FROM post AS p
        LEFT JOIN thumbnail AS t ON p.post_id = t.post_id
        WHERE p.category = 'news'
        ORDER BY p.creation_date DESC LIMIT  6
    ");
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// Function to retrieve all posts except those with category "news" including thumbnail data
public function getAllPostsExceptNews() {
    $stmt = $this->connect()->prepare("
        SELECT p.*, t.path AS thumbnail_path, t.alt AS thumbnail_alt
        FROM post AS p
        LEFT JOIN thumbnail AS t ON p.post_id = t.post_id
        WHERE p.category != 'news'
        ORDER BY p.creation_date DESC LIMIT  6
    ");
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

    

    // public function getPostById($postId) {
    //     // Retrieve post by ID from the database with related data
    //     $stmt = $this->connect()->prepare("
    //         SELECT p.*, 
    //             GROUP_CONCAT(DISTINCT t.tag_name) AS tags, 
    //             GROUP_CONCAT(DISTINCT CONCAT(plat.platform_name, ':', plat.link)) AS platforms, 
    //             p.category AS category
    //         FROM post AS p
    //         LEFT JOIN tags AS t ON p.post_id = t.post_id
    //         LEFT JOIN platform AS plat ON p.post_id = plat.post_id
    //         WHERE p.post_id=?
    //         GROUP BY p.post_id
    //     ");
    
    //     $stmt->execute([$postId]);
    //     return $stmt->fetch(PDO::FETCH_ASSOC);
    // }

    public function getPostById($postId) {
        // Retrieve post by ID from the database with related data
        $stmt = $this->connect()->prepare("
            SELECT p.*, 
                GROUP_CONCAT(DISTINCT t.tag_name) AS tags, 
                GROUP_CONCAT(DISTINCT CONCAT(plat.platform_name, '@@', plat.link)) AS platforms, 
                p.category AS category
            FROM post AS p
            LEFT JOIN tags AS t ON p.post_id = t.post_id
            LEFT JOIN platform AS plat ON p.post_id = plat.post_id
            WHERE p.post_id=?
            GROUP BY p.post_id
        ");
    
        $stmt->execute([$postId]);
        $postData = $stmt->fetch(PDO::FETCH_ASSOC);
    
        // Process platforms field
        $platforms = [];
        if (!empty($postData['platforms'])) {
            $platformEntries = explode(',', $postData['platforms']);
            foreach ($platformEntries as $entry) {
                list($platformName, $link) = explode('@@', $entry);
                $platforms[] = ['platform_name' => $platformName, 'link' => $link];
            }
        }
    
        // Replace the platforms field with processed platforms array
        $postData['platforms'] = $platforms;
    
        return $postData;
    }
    
    
    

    public function getPostsByCategory($category) {
        // Retrieve posts by category from the database
        $stmt = $this->connect()->prepare("SELECT * FROM post WHERE category=? LIMIT  6");
        $stmt->execute([$category]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getPostsByDate($date) {
        // Retrieve posts by date from the database
        $stmt = $this->connect()->prepare("SELECT * FROM post WHERE DATE(creation_date)=?");
        $stmt->execute([$date]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Method to retrieve post data from multiple tables
    public function getPosts() {
        // SQL query to retrieve post data with related thumbnails and platforms
        $sql = "SELECT post.*, GROUP_CONCAT(tags.tag_name) AS tag_names, thumbnail.path AS thumbnail_path, platform.platform_name, platform.link 
        FROM post 
        LEFT JOIN thumbnail ON post.post_id = thumbnail.post_id 
        LEFT JOIN platform ON post.post_id = platform.post_id
        LEFT JOIN tags ON post.post_id = tags.post_id
        GROUP BY post.post_id  ";


        // Prepare and execute the query
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute();

        // Fetch all rows as associative arrays
        $postData = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $postData;
    }

     // Function to delete a post by its ID
     public function deletePostById($postId) {
        try {
            // Prepare and execute the SQL query to delete the post by its ID
            $stmt = $this->connect()->prepare("DELETE FROM post WHERE post_id = ?");
            $stmt->execute([$postId]);
            
            // Check if any rows were affected (post deleted successfully)
            if ($stmt->rowCount() > 0) {
                return true; // Return true to indicate successful deletion
            } else {
                return print_r($stmt); // Return false if no rows were affected (post not found or already deleted)
            }
        } catch (PDOException $e) {
            // Handle any database errors and log or display them
            echo "Error deleting post: " . $e->getMessage();
            return false; // Return false to indicate deletion failure
        }
    }
    public function getPostsByCategoryDescending($category) {
        $stmt = $this->connect()->prepare("
        SELECT post.*, thumbnail.path AS thumbnail_path, thumbnail.alt AS thumbnail_alt
        FROM post
        LEFT JOIN thumbnail ON post.post_id = thumbnail.post_id
        WHERE post.category = ?
        ORDER BY post.creation_date DESC LIMIT  6
    ");
        $stmt->execute([$category]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    

}

// // Example usage:
// $postManager = new PostManager($connect);

// // Create a post
// $postId = $postManager->createPost($title, $content, $tags, $category, $user_id, $thumbnails, $platforms);

// // Update a post
// $postManager->updatePost($postId, $title, $content, $tags, $category, $thumbnails, $platforms);

// // Retrieve a post by ID
// $post = $postManager->getPostById($postId);

// // Retrieve posts by category
// $posts = $postManager->getPostsByCategory($category);

// // Retrieve posts by date
// $posts = $postManager->getPostsByDate($date);

?>
