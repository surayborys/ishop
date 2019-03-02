<?php

namespace Controllers;

use Models\User;
use Controllers\BaseController;
use Models\Brand;
use Models\Category;

/**
 * Profile Controller
 *
 * @author suray
 */
class ProfileController extends BaseController{
    
    public $mainCategories;
    public $brands;

    public function __controllerConstruct() {
        $this->mainCategories = Category::getMainCategories();
        $this->brands = Brand::getBrandsList();
    }
    
    private function checkLogged() {
        if(isset($_SESSION['user'])) {
            return $_SESSION['user'];
        }
        header('Location: /login');
    }

    public function actionIndex() {
        $userID = $this->checkLogged();
        
        $mainCategories = $this->mainCategories;
        $brands = $this->brands;
        
        include_once ROOT . '/views/profile/profile.php';
    }
}
