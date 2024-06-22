<?php

class PostManager extends Dbh {
    

    public function createPost($title, $content, $tags, $category, $user_id, $thumbnails, $platforms) {
        // Insert post into the database
        $stmt = $this->connect()->prepare("INSERT INTO post (title, content, tags, category, user_id) VALUES (?, ?, ?, ?, ?)");
        $stmt->execute([$title, $content, $tags, $category, $user_id]);
        $postId = $this->connect()->lastInsertId();

        // Insert thumbnails into the database
        foreach ($thumbnails as $thumbnail) {
            $stmt = $this->connect()->prepare("INSERT INTO thumbnail (post_id, path, alt) VALUES (?, ?, ?)");
            $stmt->execute([$postId, $thumbnail['path'], $thumbnail['alt']]);
        }

        // Insert platforms into the database
        foreach ($platforms as $platform) {
            $stmt = $this->connect()->prepare("INSERT INTO platform (post_id, platform_name, link) VALUES (?, ?, ?)");
            $stmt->execute([$postId, $platform['platform_name'], $platform['link']]);
        }

        return $postId;
    }

    public function updatePost($postId, $title, $content, $tags, $category, $thumbnails, $platforms) {
        // Update post in the database
        $stmt = $this->connect()->prepare("UPDATE post SET title=?, content=?, tags=?, category=? WHERE post_id=?");
        $stmt->execute([$title, $content, $tags, $category, $postId]);

        // Delete existing thumbnails associated with the post
        $stmt = $this->connect()->prepare("DELETE FROM thumbnail WHERE post_id=?");
        $stmt->execute([$postId]);

        // Insert new thumbnails into the database
        foreach ($thumbnails as $thumbnail) {
            $stmt = $this->connect()->prepare("INSERT INTO thumbnail (post_id, path, alt) VALUES (?, ?, ?)");
            $stmt->execute([$postId, $thumbnail['path'], $thumbnail['alt']]);
        }

        // Delete existing platforms associated with the post
        $stmt = $this->connect()->prepare("DELETE FROM platform WHERE post_id=?");
        $stmt->execute([$postId]);

        // Insert new platforms into the database
        foreach ($platforms as $platform) {
            $stmt = $this->connect()->prepare("INSERT INTO platform (post_id, platform_name, link) VALUES (?, ?, ?)");
            $stmt->execute([$postId, $platform['platform_name'], $platform['link']]);
        }

        return true;
    }

    public function getPostById($postId) {
        // Retrieve post by ID from the database
        $stmt = $this->connect()->prepare("SELECT * FROM post WHERE post_id=?");
        $stmt->execute([$postId]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getPostsByCategory($category) {
        // Retrieve posts by category from the database
        $stmt = $this->connect()->prepare("SELECT * FROM post WHERE category=?");
        $stmt->execute([$category]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getPostsByDate($date) {
        // Retrieve posts by date from the database
        $stmt = $this->connect()->prepare("SELECT * FROM post WHERE DATE(creation_date)=?");
        $stmt->execute([$date]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Other relevant functions can be added as needed
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
