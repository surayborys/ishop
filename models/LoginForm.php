<?php

namespace Models;

use Models\User;
use Components\Validator;

/**
 * Sign Up Form
 *
 * @author suray
 */
class LoginForm {

    //model properties
    public $email;
    public $password;
    
    public $errors = array();
    
    //constructor
    public function __construct($email, $password) {
        $this->email = $email;
        $this->password = $password;
    }
    
    /**
     * returns the array, filled with the validation rules
     * 
     * !!!!!!!!!keep elements order!!!!!!!!!!!!!!!!!!!!!!!!!!
     * [property name, property value, validator function name, error message, parameters]
     * @return array
     */
    private function  rules() {
        return 
            [
                ['email', $this->email,  'errorRequired', 'email is required field'],
                ['email', $this->email, 'errorEmail', 'non-valid email'],
                ['password', $this->password, 'errorRequired', 'password is required field'],
                ['password', $this->password, 'errorMinLength', 'password must contgain at least 8 characters', 8],
                ['password', $this->password, 'errorMatching', 'use only letters and characters for the password', '([a-zA-Z0-9\s]+)'],
            ];
        
    }
    
    /**
     * calls to validator and validates rules for the current model 
     * @return boolean
     */
    public function validate(){
        $rulesArray = $this->rules();
        $validator = new Validator;
        $result = $validator->validate($rulesArray);
        if ($result == 2) {
            return true;
        }
        if (is_array($result)) {
            $this->errors = $result;
            return false;
        }
        return false;
    }

    /**
     * calls to User model class and saves a new user 
     * @return User|null
     */
    public function findIdentity() {
        $user = new User;
        
        $user->email = $this->email;
        $user->password = $this->password;
        return $user->findIdentity();
    }

}