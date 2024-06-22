<?php

require_once '../../classes/dbh.php';
require_once '../../classes/admin/admin.php';
require_once '../../classes/admin/view.php';
session_start();

$_SESSION["user"] =  '';
if ($_SERVER["REQUEST_METHOD"] === "POST") 
{

    $password = $_POST["password"];
    $email = $_POST["email"]; 
    echo $password . " " . $email;

    $users = new User_view() ;
    $result = $users->login( $email, $password );

    if  ( $result['status'] == 'success' )
    {
        $_SESSION['user'] =  $result['user'] ;
        // header( 'location:  ../../index.php?error=success');
        echo 'success';
    } 
    elseif( $result['status']  =='failed' && $result['message'] == 'Invalid credentials')  
    {
        // header( 'location:  ../../signin.php?error=invalid credentials');
        echo 'invalid';

    }  else {
        // header( 'location:  ../../signin.php?error=login failed');
        echo 'failed';
    }

}
?>
