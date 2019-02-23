<?php
namespace Controllers;

use Controllers\BaseController;
use Models\Brand;
use Models\Category;
use Models\Product;

/**
 * Site Controller
 *
 * @author suray
 */
class SiteController extends BaseController
{
    
    public $mainCategories;
    public $brands;
    
    public function __controllerConstruct() {
        $this->mainCategories = Category::getMainCategories();
        $this->brands = Brand::getBrandsList();
    }
    
    /**
     * gets data from database and includes the site main page
     * 
     * @return boolean
     */
    public function actionIndex() {
        
        //get data from models
        $limitOfProducts = $this->localSettings['numOfNewProductsForMainPage'];
        $mainCategories = $this->mainCategories;
        $brands = $this->brands;
        $newProducts = Product::getNewProducts($limitOfProducts);
        $numberOfProducts = count($newProducts);
        
        //optimize array with products to the layout requirements
        $elementsInRow = $this->localSettings['elementsInRowForPageLayout'];
        $optimizedArrayOfNewProducts = $this->delimitArrayForLayout($elementsInRow, $newProducts);      
        
        //include view file
        include_once ROOT . '/views/site/index.php';
        
        return true;
    }
    
    public function action404 () {
        echo '404 error';
        
        return true;
    }
}
