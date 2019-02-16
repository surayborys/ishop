<?php
require_once ROOT . '/controllers/BaseController.php';
require_once ROOT . '/models/Category.php';
require_once ROOT . '/models/Brand.php';
require_once ROOT . '/models/Product.php';


/**
 * Product Controller
 *
 * @author suray
 */
class ProductController extends BaseController
{
    
    public function __controllerConstruct() {
        return true;
    }
    

    public function actionIndex(int $id) {
        
        ////get data from models
        $product = Product::getProductById($id);
        $hiera = Product::getCategoriesHierarchyForProduct($id);
        $mainCategories = Category::getMainCategories();
        $brands = Brand::getBrandsList();
        
        //include view
        include_once ROOT . '/views/product/single.php';
    }
}