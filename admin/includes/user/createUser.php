<?php

require_once '../../classes/dbh.php';
require_once '../../classes/admin/admin.php';
require_once '../../classes/admin/controller.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {

        $first_name = $_POST["fName"];
        $last_name = $_POST["fName"];
        $phone_number = $_POST["phone"];
        $email = $_POST["email"];
        $role = 'admin';

        $userData = [
            'first_name' => $first_name,
        'last_name' => $last_name,
        'email' => $email,
        'role' => $role,
        'phone_number' => $phone_number,
        'status' => 2,
        'password' => password_hash('password123', PASSWORD_DEFAULT),
        'creation_date' => ' ',
    ];

    $users = new User_controller( $userData );
    $result = $users->add_user();
    if($result == 'done')
        echo 'done';
    else 
        echo $result;
}
?>
