<?php

namespace Controllers;

use Models\User;
use Models\SignUpForm;
use Models\Brand;
use Models\Category;
use Controllers\BaseController;

/**
 * User Controller
 *
 * @author suray
 */
class UserController extends BaseController {

    public $mainCategories;
    public $brands;

    public function __controllerConstruct() {
        $this->mainCategories = Category::getMainCategories();
        $this->brands = Brand::getBrandsList();
    }

    /**
     * handles user registration
     * 
     * @return boolean
     */
    public function actionRegister() {
        
        $mainCategories = $this->mainCategories;
        $brands = $this->brands;
        
        //set default values for the form fields
        $firstname = $lastname = $email = $password = $passwordConfirm = '';
        
        //set default values for the errors
        $errors = [];
        
        //check if the form has been already submittes
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            //prepare model properties
            $firstname = $this->test_input($_POST['firstname']);
            $lastname = $this->test_input($_POST['lastname']);
            $email = $this->test_input($_POST['email']);
            $password = $this->test_input($_POST['password']);
            $confirm = $this->test_input($_POST['confirm']);
            //create new SignUpForm entity
            $model = new SignUpForm($firstname, $lastname, $email, $password, $confirm);
            
            //validate SignUpForm properties
            if(!$model->validate()){
                $errors = $model->errors;
            }elseif($user = $model->signup()){
                $this->actionLogin($user);
            }else{
                echo 'Unable to register new user';
            }
        }        
        //inclede view file      
        include_once ROOT . '/views/user/forms/signup_form.php';
        return true;
    }
    
    /**
     * TEST MODE
     * @param User $user
     * @return boolean
     */
    public function actionLogin(User $user){
        echo 'HELLO';
        echo '<pre>';
        print_r($user);
        echo '</pre>';
        return true;
    }

    /**
     *  1.removes spaces
     *  2.removes slashes, added with addslashes()
     *  3.converts all aplicable characters
     */
    private function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    
    

}
