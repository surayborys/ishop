<?php

namespace Controllers;

use Models\User;
use Models\SignUpForm;
use Models\LoginForm;
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
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            //prepare model properties
            $firstname = $this->test_input($_POST['firstname']);
            $lastname = $this->test_input($_POST['lastname']);
            $email = $this->test_input($_POST['email']);
            $password = $this->test_input($_POST['password']);
            $confirm = $this->test_input($_POST['confirm']);
            //create new SignUpForm entity
            $model = new SignUpForm($firstname, $lastname, $email, $password, $confirm);

            //validate SignUpForm properties
            if (!$model->validate()) {
                $errors = $model->errors;
            } elseif ($user = $model->signup()) {
                $this->actionLogin($email, $password, 0);
            } else {
                echo 'Unable to register new user';
            }
        }
        //inclede view file      
        include_once ROOT . '/views/user/forms/signup_form.php';
        return true;
    }

    /**
     * handles authorization
     * 
     * @param User $user
     * @return boolean
     */
    public function actionAuth(User $user) {
        if($_SESSION['user']) {
            header('Location: /profile');
        } else {
            $_SESSION['user'] = $user->id;
            header('Location: /profile');
        }
        return true;
    }

    /**
     *  <b>handles loginning procedure</b>
     *  1. takes email and password as params or from the $_POST superglobal
     *  2. authentificates user
     *  3. logs user in or prompts errors
     * 
     * @param string $email
     * @param string $password
     * @param int $post
     * @return boolean
     */
    public function actionLogin($email = '', $password = '', $post = 1) {

        $mainCategories = $this->mainCategories;
        $brands = $this->brands;

        //set default values
        $errors = [];
        
        
        if ($_SERVER['REQUEST_METHOD'] == 'POST' || $post == 0) {
            if ($_SERVER['REQUEST_METHOD'] == 'POST'){
                //prepare model properties
                $email = $this->test_input($_POST['email']);
                $password = $this->test_input($_POST['password']);
            }
        
            $model = new LoginForm($email, $password);
            
            if(!$model->validate()) {
                $errors = $model->errors;
            } elseif($user = $model->findIdentity()){
                $this->actionAuth($user);
            } else {
                $errors['email'][0] = 'Incorrect username and/or password';
            }
        }

        include_once ROOT . '/views/user/forms/login_form.php';
        return true;
    }
    
    /**
     *  Unset current user id from $_SESSION superglobal
     *  @return boolean
     */
    public function actionLogout() {
        unset($_SESSION['user']);
        header('location: /');
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
