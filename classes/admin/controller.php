<?php

class User_controller extends Users {
    private $userData;

    public function __construct( $userData )
    {
        $this->userData = $userData;

    }

    public function add_user(){
        if( $this->valid_userName() == false ){
            return 'invalid first name or last name ';
            exit();
        }
        if( $this->valid_email() == false ){ 
            return 'invalid email';
            exit();
        } 
        if( $this->user_match() == true ){
            return 'user exist';
            exit();
        } 
  
        return $this->createUser( $this->userData );
    }
  
    private function valid_userName(){
        if(preg_match("/^[a-zA-Z0-9]*$/", $this->userData['first_name'])  == 1 ||  preg_match("/^[a-zA-Z0-9]*$/", $this->userData['last_name']) == 1){
            return true;
        }else{
            return false;
        }
    }
    private function valid_email(){
        if(!filter_var($this->userData['email'], FILTER_VALIDATE_EMAIL)){
            return false;
        }else{
            return true;
        }
    }
    private function user_match(){
        $data  = [];
        $data = $this->getUserByEmail( $this->userData['email'] );
        if( is_array($data) ){
            return true;
        } else {
            return false;
        }
    }
    
}


?>