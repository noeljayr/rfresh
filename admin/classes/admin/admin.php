<?php

class Users extends Dbh
{
// create user
    protected function createUser( $userData )
    {
        $userData['creation_date'] = date('Y-m-d H:i:s');
        $sql = 'INSERT INTO `users`( `first_name`, `last_name`, `phone_number`, `email`, `role`, `creation_date`, `status`, `password`)  VALUES (:first_name, :last_name, :phone_number, :email,  :role, :creation_date, :status, :password)';

        try {
            $stmt = $this->connect()->prepare($sql);
            $stmt->execute($userData);
            return 'done';
        } catch (PDOException $e) {
            error_log('Error creating user: ' . $e->getMessage());
            return 'query failed';
        }
    }
// end create user


// update and modification 
    protected function deactivateUser( $user_id )
    {   
            $modification_date = date('Y-m-d H:i:s');
            $status = 4;
            $sql = 'UPDATE `users` SET `modification_date` = :modification_date, `status` = :status WHERE `user_id` = :user_id';

            try {
                $stmt = $this->connect()->prepare($sql);
                $stmt->execute([ 'modification_date' => $modification_date,  'status' => $status, 'user_id' => $user_id ] );
                return 'done';
            } catch (PDOException $e) {
                error_log('Error updating user: ' . $e->getMessage());
                return 'query failed';
            }
    }
    protected function activateUser( $user_id )
    {
        $modification_date = date('Y-m-d H:i:s');
        $status = 3;
        $sql = 'UPDATE `users` SET `modification_date` = :modification_date, `status` = :status WHERE `user_id` = :user_id';

        try {
            $stmt = $this->connect()->prepare($sql);
            $stmt->execute([ 'modification_date' => $modification_date,  'status' => $status, 'user_id' => $user_id ] );
            return 'done';
        } catch (PDOException $e) {
            error_log('Error updating user: ' . $e->getMessage());
            return 'query failed';
        }
    }
    protected function modifyUser( $userData )
    {
        $userData['modification_date'] = date('Y-m-d H:i:s');

        $sql = 'UPDATE `users` SET `first_name` = :first_name, `last_name` = :last_name, `email` = :email, `phone_number` = :phone_number,  `modification_date` = :modification_date WHERE `user_id` = :user_id';

        try {
            $stmt = $this->connect()->prepare($sql);
            $stmt->execute($userData);
            return 'done';
        } catch (PDOException $e) {
            error_log('Error updating user: ' . $e->getMessage());
            return 'query failed';
        }
    }
    protected function modifyPassword( $password, $new_password, $user_id )
    {   // get user data
        $user = $this->getUserById( $user_id );

        // compare provided password with the one that is in the database
        if ( $user && password_verify( $password, $user['password'] ) ) 
        {
            // try modify password
            try { 
                $modification_date = date( "Y-m-d h:i:s" );
                $stmt = $this->connect()->prepare( 'UPDATE `users` SET  `modification_date`= :modification_date ,  `password`= :password  WHERE `user_id` = :user_id ' );
                $new_password = password_hash($new_password, PASSWORD_DEFAULT);
                $stmt->execute( [ 'modification_date' => $modification_date, 'password'=> $new_password, 'user_id' => $user_id ] );
                return 'done' ;
            } catch (PDOException $e) {
                error_log('Error updating user: ' . $e->getMessage());
                return 'query failed '. $e->getMessage();
            }
        } else {
            return 'Invalid credentials';
        }
    }
// end update and modification 

 
// login and logout
    protected function loginUser( $email, $password  )
    {
        $sql = 'SELECT * FROM `users` WHERE `email` = :email';

        try {
            $stmt = $this->connect()->prepare( $sql );
            $stmt->execute( ['email' => $email] );
            $user = $stmt->fetch( PDO::FETCH_ASSOC );

            if ( $user &&  password_verify( $password, $user['password'] ) ) {
                $responce = $this->updateToOnline( $user['user_id'] );
                if (  $responce ==  'query failed'  )
                {
                    return ['status' => 'failed', 'message' => 'sign up error'];
                }else {
                    return ['status' => 'success', 'user' => $user];
                }
            } else {
                return ['status' => 'failed', 'message' => 'Invalid credentials'];
            }
        } catch ( PDOException $e ) {
            error_log('Error logging in user: ' . $e->getMessage());
            return ['status' => 'error', 'message' => 'Login failed'];
        }
    } 
    protected function logoutUser( $userId )  
    {
        $sql = 'UPDATE `users` SET `status` = :status WHERE `user_id` = :user_id';
    
        try {
            $stmt = $this->connect()->prepare( $sql );
            $stmt->execute( ['status' => 2, 'user_id' => $userId] );
            return ['status' => 'success', 'message' => 'Logged out successfully'];
        } catch ( PDOException $e ) {
            error_log('Error logging out user: ' . $e->getMessage());
            return ['status' => 'error', 'message' => 'Logout failed'];
        }
    }
// end login and logout

// get functions
    protected function getUserByEmail( $email )
    {
        // $sql = 'SELECT COUNT(user_id) FROM `users` WHERE `email` = :email ';
        $sql = 'SELECT * FROM `users` WHERE `email` = :email ';

        try {
            $stmt = $this->connect()->prepare( $sql );
            $stmt->execute( ['email' => $email]) ;
            return $stmt->fetch( PDO::FETCH_ASSOC );
        } catch ( PDOException $e ) {
            error_log('Error fetching user by email: ' . $e->getMessage() );
            return 'query failed';
        }
    }
    // protected function getUserByEmail( $email )
    // {
    //     // $sql = 'SELECT COUNT(user_id) FROM `users` WHERE `email` = :email ';
    //     $sql = 'SELECT COUNT(`user_id`) FROM `users` WHERE `email` = :email ';

    //     try {
    //         $stmt = $this->connect()->prepare( $sql );
    //         $stmt->execute( ['email' => $email]) ;
    //         return $stmt->fetch( PDO::FETCH_ASSOC );
    //     } catch ( PDOException $e ) {
    //         error_log('Error fetching user by email: ' . $e->getMessage() );
    //         return 'query failed';
    //     }
    // }
    protected function getUserById( $user_id )
    {
        $sql = 'SELECT * FROM `users` WHERE `user_id` = :user_id';
        try {
            $stmt = $this->connect()->prepare( $sql );
            $stmt->execute( ['user_id' => $user_id] ) ;
            return $stmt->fetch( PDO::FETCH_ASSOC );
        } catch ( PDOException $e ) {
            error_log('Error fetching user' . $e->getMessage() );
            return 'query failed';
        }
    }
    protected function getAllUser()
    {
        $sql = 'SELECT * FROM `users` order by user_id DESC ';
        try {
            $stmt = $this->connect()->prepare( $sql );
            $stmt->execute() ;
            return $stmt->fetchAll( PDO::FETCH_ASSOC );
        } catch ( PDOException $e ) {
            error_log('Error fetching admins: ' . $e->getMessage() );
            return 'query failed';
        }
    }
// end get functions



// status updates
    protected function updateToOffline( $user_id )
    {
        $sql = 'UPDATE `users` SET  `status` = :status WHERE `user_id` = :user_id';

        try {
            $stmt = $this->connect()->prepare($sql);
            $stmt->execute( [ `status` => 2, `user_id` => $user_id ] );
            return 'done';
        } catch (PDOException $e) {
            error_log('Error updating user: ' . $e->getMessage());
            return 'query failed';
        }  
    }
    protected function updateToOnline( $user_id )
    {
        $last_login_date = date('Y-m-d H:i:s');
        $status = 1;
        $sql = 'UPDATE `users` SET `last_login_date`= :last_login_date,`status`= :status WHERE `user_id` = :user_id';

        try {
            $stmt = $this->connect()->prepare($sql);
            $obj = [
                'last_login_date' => $last_login_date, 
                'status' => $status, 
                'user_id' => $user_id
            ];
            
            $stmt->execute($obj);
            return 'done';
        } catch (PDOException $e) {
            error_log('Error updating user: ' . $e->getMessage());
            echo  $e->getMessage() . "<br>";  //remove this
            return 'query failed';
        }  
    }
// end status updates

// destructor
    function __destruct() {
        $this->close_connection();
    }
//end destructor
}

?>