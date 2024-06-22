<?php

require_once '../../classes/dbh.php';
require_once '../../classes/admin/admin.php';
require_once '../../classes/admin/view.php';
session_start();

    $admnObj = new User_view();
    $results = $admnObj->logout( $_SESSION['user']['user_id'] );

    if ( $results['status'] == 'success' )
    {
        session_unset();
        session_destroy();
        header( 'location:  ../../index.php?error=success');
    }

?>