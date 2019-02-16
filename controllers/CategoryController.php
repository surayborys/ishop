<?php
require_once ROOT . '/controllers/BaseController.php';
require_once ROOT . '/models/Category.php';
require_once ROOT . '/models/Brand.php';
require_once ROOT . '/models/Product.php';


/**
 *  Site Controller
 *
 * @author suray
 */
class CategoryController extends BaseController {
    
    public function __controllerConstruct() {
        return true;
    }
    
    /**
     * 
     * @param string $name
     */
    public function actionIndex(string $name) {
        
        //get data from models
        $activeCategory = Category::getCategoryByName($name);
        $mainCategories = Category::getMainCategories();
        $brands = Brand::getBrandsList();
        $pre_products = Product::getProductsByMainCategoryName($name);
        
        //optimize array with products to the layout requirements
        $elementsInRow = 3;
        $products = $this->delimitArrayForLayout($elementsInRow, $pre_products);
        
        //include view
        include_once ROOT . '/views/category/index.php';
    }
}
