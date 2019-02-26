<?php

namespace Models;

use Models\User;
use Components\Validator;

/**
 * Sign Up Form
 *
 * @author suray
 */
class SignUpForm {

    //model properties
    public $firstname;
    public $lastname;
    public $email;
    public $password;
    public $confirm;
    public $errors = array();
    
    //constructor
    public function __construct($firstname, $lastname, $email, $password, $confirm) {
        $this->firstname = $firstname;
        $this->lastname = $lastname;
        $this->email = $email;
        $this->password = $password;
        $this->confirm = $confirm;
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
                ['email', $this->email, 'errorUniqueField', 'the email is already busy', 'email', 'User'],
                ['password', $this->password, 'errorRequired', 'password is required field'],
                ['password', $this->password, 'errorMinLength', 'password must contgain at least 8 characters', 8],
                ['password', $this->password, 'errorMatching', 'use only letters and characters for the password', '([a-zA-Z0-9\s]+)'],
                ['confirm', $this->confirm, 'errorNonIdentical', 'wrong password confirmation', $this->password],
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
    public function signup() {
        $user = new User;

        $user->firstname = $this->firstname;
        $user->lastname = $this->lastname;
        $user->email = $this->email;
        $user->setPassword($this->password);

        return ($user->save()) ? $user : null;
    }

}
