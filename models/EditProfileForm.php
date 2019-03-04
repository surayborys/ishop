<?php

namespace Models;

use Models\User;
use Components\Validator;

/**
 * Sign Up Form
 *
 * @author suray
 */
class EditProfileForm {

    //model properties
    public $userID;
    public $firstname;
    public $lastname;
    public $email;
    
    
    public $errors = array();
    
    //constructor
    public function __construct($userID, $firstname, $lastname, $email) {
        $this->firstname = $firstname;
        $this->lastname = $lastname;
        $this->email = $email;
        $this->userID = $userID;
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
                ['firstname', $this->firstname, 'errorRequired', 'first name is required field'],
                ['firstname', $this->firstname, 'errorMinLength', 'first name must contain at least 2 characters', 2],
                ['firstname', $this->firstname, 'errorMatching', 'use only letters and characters for the first name', '([a-zA-Z0-9\s]+)'],
                ['email', $this->email,  'errorRequired', 'email is required field'],
                ['email', $this->email, 'errorEmail', 'non-valid email'],
                ['email', $this->email, 'errorUniqueFieldExcept', 'the email is already busy', 'email', 'User', 'id', $this->userID ],
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
    public function updateProfile() {
        $user = new User;

        $user->firstname = $this->firstname;
        $user->lastname = $this->lastname;
        $user->email = $this->email;
        $user->id = $this->userID;

        return $user->updateProfile();
            
        
    }

}
