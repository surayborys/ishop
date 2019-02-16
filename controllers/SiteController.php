<?php
require_once ROOT . '/controllers/BaseController.php';
require_once ROOT . '/models/Category.php';
require_once ROOT . '/models/Brand.php';
require_once ROOT . '/models/Product.php';


/**
 * Site Controller
 *
 * @author suray
 */
class SiteController extends BaseController
{
    
    public function __controllerConstruct() {
        return true;
    }
    

    public function actionIndex() {
        
        //get data from models
        $limitOfProducts = $this->localSettings['numOfNewProductsForMainPage'];
        $mainCategories = Category::getMainCategories();
        $brands = Brand::getBrandsList();
        $newProducts = Product::getNewProducts($limitOfProducts);
        
        //optimize array with products to the layout requirements
        $elementsInRow = 3;
        $numberOfProducts = count($newProducts);
        $optimizedArrayOfNewProducts = $this->delimitArrayForLayout($elementsInRow, $newProducts);      
        
        //include view file
        include_once ROOT . '/views/site/index.php';
    }
}
