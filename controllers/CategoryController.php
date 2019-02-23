<?php
namespace Controllers;


use Controllers\BaseController;
use Models\Brand;
use Models\Category;
use Models\Product;
use JasonGrimes\Paginator;


/**
 *  Site Controller
 *
 * @author suray
 */
class CategoryController extends BaseController {
    
    public $mainCategories;
    public $brands;
    
    public function __controllerConstruct() {
        $this->mainCategories = Category::getMainCategories();
        $this->brands = Brand::getBrandsList();
    }
    
    /**
     * gets data from database and includes the main category page
     * 
     * @param string $name
     * @return boolean
     */
    public function actionIndex(string $name, int $pageNumber) {
        
        //get data from models
        $activeCategory = Category::getCategoryByName($name);
        $mainCategories = $this->mainCategories;
        $brands = $this->brands;
        $pre_products = Product::getProductsByMainCategoryName($name, $pageNumber);
        
        
        //optimize array with products to the layout requirements
        $elementsInRow = $this->localSettings['elementsInRowForPageLayout'];
        $products = $this->delimitArrayForLayout($elementsInRow, $pre_products);
        
        //data for paginator
        $totalItems = Product::countProductsInMainCategory($name);
        $itemsPerPage = 3;
        $currentPage = $pageNumber;
        $urlPattern = 'page-(:num)';
        
        $paginator = new Paginator($totalItems, $itemsPerPage, $currentPage, $urlPattern);
        
        
        //include view
        include_once ROOT . '/views/category/index.php';
        return true;
    }
    
    /**
     * gets data from database and includes the current category page
     * 
     * @param string $mainName
     * @param int $id
     * @param int $pageNumber
     * @return boolean
     */
    public function actionView(string $mainName, int $id, int $pageNumber) {
        
        //get data from models
        $activeCategory = Category::getCategoryByName($mainName);
        $mainCategories = $this->mainCategories;
        $brands = $this->brands;
        $pre_products = Product::NgetProductsByCategoryWithinMainCategory($id, $mainName, $pageNumber); 
        
        //optimize array with products to the layout requirements
        $elementsInRow = $this->localSettings['elementsInRowForPageLayout'];;
        $products = $this->delimitArrayForLayout($elementsInRow, $pre_products);
        
        //data for paginator
        $totalItems = Product::countProductsInCategory($id, $mainName);
        $itemsPerPage = 3;
        $currentPage = $pageNumber;
        $urlPattern = 'page-(:num)';
        
        $paginator = new Paginator($totalItems, $itemsPerPage, $currentPage, $urlPattern);
        
        //include view
        include_once ROOT . '/views/category/index.php';
        
        return true;
    }
}
