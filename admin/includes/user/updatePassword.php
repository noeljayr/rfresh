<?php

require_once '../../classes/dbh.php';
require_once '../../classes/admin/admin.php';  
require_once '../../classes/admin/view.php';
session_start();


if ($_SERVER["REQUEST_METHOD"] === "POST") {

        $password = $_POST["password"];
        $new_password = $_POST["new_password"];


    $users = new User_view;
    $result = $users->updatePassword( $password, $new_password, $_SESSION['user']['user_id']);
    if($result == 'done')
        header( "location: ../../profile.php?error=passwordUpdated");
    else 
        header( "location: ../../profile.php?error=passwordUpdated ");
}
?>
