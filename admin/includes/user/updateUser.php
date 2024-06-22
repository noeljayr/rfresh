<?php
session_start();
require_once '../../classes/dbh.php';
require_once '../../classes/admin/admin.php';
require_once '../../classes/admin/view.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {

        $first_name = $_POST["first_name"];
        $last_name = $_POST["last_name"];
        $phone_number = $_POST["phone_number"];
        $role = $_POST["role"];
        $email = $_POST["email"];
        $user_id = $_POST["user_id"];



        $userData = [
            'first_name' => $first_name,
        'last_name' => $last_name,
        'email' => $email,
        'phone_number' => $phone_number,
        'role' => $role,
        'modification_date' => ' ',
        'user_id' => $user_id
        ];

    $users = new User_view();
    $result = $users->updateUser( $userData  );

    if (   $result ==  'done' )
    {      
            header( 'location: ../../newuseredit.php?user_id='.$user_id.'&error=updateDone' );

    } else {
        header( 'location: ../../newuseredit.php?user_id='.$user_id.'&error=updateFailed' );
    }

}
?>