<?php
namespace Controllers;

use Controllers\BaseController;
use Models\Brand;
use Models\Category;
use Models\Product;


/**
 * Product Controller
 *
 * @author suray
 */
class ProductController extends BaseController
{
    
    public $mainCategories;
    public $brands;
    
    public function __controllerConstruct() {
        $this->mainCategories = Category::getMainCategories();
        $this->brands = Brand::getBrandsList();
    }
    
    /**
     * gets data from database and includes the single product view page
     * 
     * @param int $id
     * @return boolean
     */
    public function actionIndex(int $id) {
        
        ////get data from models
        $product = Product::getProductById($id);
        $hiera = Product::getCategoriesHierarchyForProduct($id);
        $mainCategories = $this->mainCategories; 
        $brands = $this->brands;
        
        //include view
        include_once ROOT . '/views/product/single.php';
        
        return true;
    }
}