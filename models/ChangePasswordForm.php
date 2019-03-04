<?php

namespace Models;

use Models\User;
use Components\Validator;

/**
 * Sign Up Form
 *
 * @author suray
 */
class ChangePasswordForm {

    //model properties
    public $userID;
    public $currentPassword;
    public $newPassword;
    public $confirmNewPassword;
    
    
    public $errors = array();
    
    //constructor
    public function __construct($userID, $currentPassword, $newPassword, $confirmNewPassword) {
        $this->userID = $userID;
        $this->currentPassword = $currentPassword;
        $this->newPassword = $newPassword;
        $this->confirmNewPassword = $confirmNewPassword;
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
                ['password', $this->newPassword, 'errorRequired', 'password is required field'],
                ['password', $this->newPassword, 'errorMinLength', 'password must contgain at least 8 characters', 8],
                ['password', $this->newPassword, 'errorMatching', 'use only letters and characters for the password', '([a-zA-Z0-9\s]+)'],
                ['confirm', $this->confirmNewPassword, 'errorNonIdentical', 'wrong password confirmation', $this->newPassword],
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
    
    public function verifyPassword(){
        return User::verifyPassword($this->userID, $this->currentPassword);
    }

    /**
     * calls to User model class and saves a new user 
     * @return User|null
     */
    public function updatePassword() {
        $user = new User;
        $user->setPassword($this->newPassword);
        $user->id = $this->userID;

        return $user->updatePassword();
            
        
    }

}