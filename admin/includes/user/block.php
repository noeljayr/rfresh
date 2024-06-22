<?php

include '../../classes/dbh.php';
include  '../../classes/admin/admin.php';
include '../../classes/admin/view.php';

session_start();

    if ($_SERVER['REQUEST_METHOD'] === 'POST') 
    {   

        $items = json_decode($_POST['items'], true);
        $userObj = new User_view;

        if ($items === null && json_last_error() !== JSON_ERROR_NONE) {
            // Handle JSON decoding error
            echo 'Error decoding JSON: ' . json_last_error_msg();
        } else {
            if ( $items['status'] == 'Active'){
                $result = $userObj->userDeactivation( $items['userid']);
            }else {
                $result = $userObj->userActivation( $items['userid']);
            }
            if ($result == "done"){
                echo 'done';
            }  else {
                echo 'no';
            }
            
        }

        }

?>
