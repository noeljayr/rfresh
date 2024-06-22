<?php

class  User_view extends Users {
    public function login( $email, $password )
    {
        return $this->loginUser( $email,   $password );
    }
    public function logout ( $admin_id ) 
    {
        return $this->logoutUser( $admin_id );
    }
    public function showUserById( $userId )
    {
        return $this->getUserById( $userId );
    }
    public function showUsers() 
    {
        return $this->getAllUser();
    }
    public  function updateUser( $userData  )
    {
        return  $this->modifyUser(  $userData );
    }
    public  function updatePassword (  $password, $new_password, $admin_id )
    {
        return $this->modifyPassword(  $password, $new_password, $admin_id );
    }
    public function  userDeactivation( $admin_id )
    {
        return $this->deactivateUser( $admin_id  );
    }
    public function  userActivation( $admin_id )
    {
        return $this->activateUser( $admin_id  );
    }

}


?>