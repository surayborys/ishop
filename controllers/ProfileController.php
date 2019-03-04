<?php

namespace Controllers;

use Models\User;
use Controllers\BaseController;
use Models\Brand;
use Models\Category;
use Models\EditProfileForm;
use Models\ChangePasswordForm;

/**
 * Profile Controller
 *
 * @author suray
 */
class ProfileController extends BaseController {

    public $mainCategories;
    public $brands;

    public function __controllerConstruct() {
        $this->mainCategories = Category::getMainCategories();
        $this->brands = Brand::getBrandsList();
    }
    /**
     * to check if the user is logged in
     * 
     * @return mixed
     */
    private function checkLogged() {
        if (isset($_SESSION['user'])) {
            return $_SESSION['user'];
        }
        header('Location: /login');
    }

    /**
     *  displays the profile page for a user
     */
    public function actionIndex() {
        $userID = $this->checkLogged();
        $user = new User;
        $user = $user->getUserById($userID);
        $username = $user->firstname;

        $mainCategories = $this->mainCategories;
        $brands = $this->brands;

        include_once ROOT . '/views/profile/profile.php';
    }
    
    /**
     * handles user profile updating
     */
    public function actionUpdate() {

        //common view data
        $mainCategories = $this->mainCategories;
        $brands = $this->brands;
        
        $errors = [];
        $success = null;
        
        //check if the user is logged in and get User $user properties from the database
        $userID = $this->checkLogged();
        
        $user = new User;
        $user = $user->getUserById($userID);
        
        if(!$user) {
            $errors['firstname'][0] = 'Unable to find user. Please, try again later';
        } else {
            //user properties
            $firstname = $user->firstname;
            $lastname = $user->lastname;
            $email = $user->email;
        } 
        
        //check if the form has been submitted
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            
            $firstname = $this->test_input($_POST['firstname']);
            $lastname = $this->test_input($_POST['lastname']);
            $email = $this->test_input($_POST['email']);
            
            //create form model, validate it and if success - update user profile
            $model = new EditProfileForm($userID, $firstname, $lastname, $email);
            
            if(!$model->validate()) {
                $errors = $model->errors;
            } else {
               #!!!!!!!!!!!!!
                $success = $model->updateProfile() ? 'USER DATA SUCCESFULLY UPDATED': 'UNABLE TO UPDATE USER PROFILE. TRY AGAIN LATER';
            }
        }
        
        include_once ROOT . '/views/profile/update.php';
    }
    
    /**
     *  handles update password procedure
     */
    public function actionUpdatePassword(){
        //common view data
        $mainCategories = $this->mainCategories;
        $brands = $this->brands;
        
        $errors = [];
        $success = null;
        
        //check if the user is logged in and get User $user properties from the database
        $userID = $this->checkLogged();
        $success = null;
        
        //check if the form has been submitted and process form data
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            $currentPassword = filter_input(INPUT_POST, 'currentPassword', FILTER_SANITIZE_SPECIAL_CHARS);
            $newPassword = filter_input(INPUT_POST, 'newPassword', FILTER_SANITIZE_SPECIAL_CHARS);
            $confirmNewPassword = filter_input(INPUT_POST, 'confirmNewPassword', FILTER_SANITIZE_SPECIAL_CHARS);
            
            $model = new ChangePasswordForm($userID, $currentPassword, $newPassword, $confirmNewPassword);
            
            if(!$model->validate()) {
                $errors = $model->errors;
            } else if(!$model->verifyPassword()) {
                $errors['currentPassword'][0] = 'Incorrect password';
            } else {
                $success = $model->updatePassword() ? 'PASSWORD SUCCESSFULLY UPDATED' : 'ERROR UPDATING PASSWORD';
            }
        }
        
        include_once ROOT . '/views/profile/changepass.php';
        
    }

}
