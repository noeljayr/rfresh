<?php
require 'classes/dbh.php';
require 'classes/admin/admin.php';
require 'classes/admin/view.php';

$userObj = new User_view;
$userResult = $userObj->showUsers();

// Define an empty array to hold user data
$admins = [];

// Loop through the user data retrieved from the database
foreach ($userResult as $user) {
    // Format each user's information and add it to the $admins array
    $active = $user['status'] == 4 ? false : true;
    $admin = [
        'ID' => $user['user_id'],
        'name' => $user['first_name'] . ' ' . $user['last_name'],
        'email' => $user['email'],
        'active' => $active, // Convert status to boolean
        'posts' => '', // Assuming 'posts' is a field in your database
    ];

    // Add the formatted user data to the $admins array
    $admins[] = $admin;
}

// Convert the $admins array to JSON format for easy consumption in JavaScript
$adminsJSON = json_encode($admins);
?>
