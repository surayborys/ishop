<?php
namespace Models;

use Components\DbConnect;
use Models\Category;
use PDO;

/**
 * A model for the 'product' table
 *
 * @author suray
 */
class Product {
    /**
     * gets new products from the product table (is_new = 1)
     * 
     * @param int $limit
     * @return array
     */
    public static function getNewProducts(int $limit): array {

        $con = DbConnect::connect();

        $query = 'SELECT product.*, category.title AS cat_title FROM product'
                . ' INNER JOIN category ON product.category_id = category.id'
                . ' WHERE is_new = 1 ORDER BY price DESC LIMIT :limit';
        $sth = $con->prepare($query);
        $sth->setFetchMode(PDO::FETCH_ASSOC);

        $sth->bindValue(':limit', $limit, PDO::PARAM_INT);
        $sth->execute();

        $i = 0;
        $products = array();

        while ($row = $sth->fetch()) {
            $products[$i]['id'] = $row['id'];
            $products[$i]['title'] = $row['title'];
            $products[$i]['price'] = $row['price'];
            $products[$i]['category_id'] = $row['category_id'];
            $products[$i]['brand_id'] = $row['brand_id'];
            $products[$i]['image'] = $row['image'];
            $products[$i]['availability'] = $row['availability'];
            $products[$i]['is_new'] = $row['is_new'];
            $products[$i]['product_status'] = $row['product_status'];
            $products[$i]['main_category_id'] = $row['main_category_id'];
            $products[$i]['finalCategoryName'] = $row['cat_title'];

            $i++;
        }
        return $products;
    }

    /**
     * to get single product from the 'product' table by its id
     * 
     * @param int $id
     * @return boolean|array
     */
    public static function getProductById(int $id) {

        $con = DbConnect::connect();

        $query = 'SELECT product.*, category.title as cat_title FROM product '
                . 'INNER JOIN category ON product.category_id = category.id '
                . 'WHERE product.id = :id';
        $sth = $con->prepare($query);
        $sth->setFetchMode(PDO::FETCH_ASSOC);

        $sth->bindValue(':id', $id, PDO::PARAM_INT);
        $sth->execute();

        if ($product = $sth->fetch()) {
            return $product;
        }

        return false;
    }

    /**
     * to get from the 'product' table all the records by main_category_title (join 'category' table)
     * 
     * @param string $name
     * @return array|boolean
     */
    public static function getProductsByMainCategoryName(string $name, int $pageNum = 1) {
        $con = DbConnect::connect();
        
        $productsInRow = 3;
        $offset = ($pageNum-1)*$productsInRow;

        $query = 'SELECT product.*, category.title AS main_cat_title '
                . 'FROM product INNER JOIN category '
                . 'ON product.main_category_id = category.id '
                . 'WHERE category.title = :name LIMIT :limit OFFSET :offset';
        
        $sth = $con->prepare($query);
        $sth->setFetchMode(PDO::FETCH_ASSOC);

        $sth->bindValue(':name', $name, PDO::PARAM_STR);
        $sth->bindValue(':offset', $offset, PDO::PARAM_INT);
        $sth->bindValue(':limit', $productsInRow, PDO::PARAM_INT);


        $sth->execute();

        $i = 0;
        $products = array();

        while ($row = $sth->fetch()) {
            $products[$i]['id'] = $row['id'];
            $products[$i]['title'] = $row['title'];
            $products[$i]['code_number'] = $row['code_number'];
            $products[$i]['price'] = $row['price'];
            $products[$i]['category_id'] = $row['category_id'];
            $products[$i]['brand_id'] = $row['brand_id'];
            $products[$i]['description'] = $row['description'];
            $products[$i]['image'] = $row['image'];
            $products[$i]['availability'] = $row['availability'];
            $products[$i]['is_new'] = $row['is_new'];
            $products[$i]['product_status'] = $row['product_status'];
            $products[$i]['main_category_id'] = $row['main_category_id'];
            $products[$i]['main_cat_title'] = $row['main_cat_title'];

            $i++;
        }

        return (is_array($products)) ? $products : false;
    }

    /**
     * to get the array of category hierarchy for current product
     * 
     * @param int $id
     * @return boolean|array
     */
    public static function getCategoriesHierarchyForProduct(int $id) {

        $product = self::getProductById($id);

        //check if the product has been found and add the final category to the result array
        if ($product && (isset($product['category_id']) && !empty($product['category_id']))) {
            $hieraArray = [];
            $hieraArray[] = [
                'id' => $product['category_id'],
                'title' => $product['cat_title']
            ];

            //get a main category for the product using the Category::getCategoryById method
            $mainCategory = Category::getCategoryById($product['main_category_id']);

            //get an array with parent categories asing the Category::getHierarchy method
            $hiera = Category::getHierarchy($product['category_id'], $hieraArray);

            //add main category to the result array
            array_push($hiera, $mainCategory);

            //return reversed array(from main to final category)
            return array_reverse($hiera);
        } else {
            //return false if the product hasn't been found
            return false;
        }
    }

    /**
     * gets records from the 'product' table by final category id within the main category
     * 
     * @param int $id
     * @param int $mainCategoryId
     * @return array|false
     */
    public static function getProductsByFinalCategoryId(int $id, int $mainCategoryId) {
        $con = DbConnect::connect();
        $query = 'SELECT * FROM product WHERE category_id = :id AND '
                . 'main_category_id = :main_id';

        $sth = $con->prepare($query);
        $sth->setFetchMode(PDO::FETCH_ASSOC);

        $sth->bindValue(':id', $id, PDO::PARAM_INT);
        $sth->bindValue(':main_id', $mainCategoryId, PDO::PARAM_INT);

        $sth->execute();
        
        $i = 0;
        $products = array();

        while ($row = $sth->fetch()) {
            $products[$i]['id'] = $row['id'];
            $products[$i]['title'] = $row['title'];
            $products[$i]['code_number'] = $row['code_number'];
            $products[$i]['price'] = $row['price'];
            $products[$i]['category_id'] = $row['category_id'];
            $products[$i]['brand_id'] = $row['brand_id'];
            $products[$i]['description'] = $row['description'];
            $products[$i]['image'] = $row['image'];
            $products[$i]['availability'] = $row['availability'];
            $products[$i]['is_new'] = $row['is_new'];
            $products[$i]['product_status'] = $row['product_status'];
            $products[$i]['main_category_id'] = $row['main_category_id'];
            
            $i++;
        }
        
         return (is_array($products)) ? $products : false;
    }

    /**
     * <p>recursivelly gets products from all the subctegories of current category 
     * within the main category and stores it into the $products array</p>
     * 
     * @param int $id
     * @param string $mainCategoryName
     * @param arrat $products
     * @return array
     */
    public static function getProductsByCategoryWithinMainCategory(int $id, string $mainCategoryName, $products = array()) {

        $category = Category::getCategoryById($id);
        $mainCategoryId = Category::getCategoryByName($mainCategoryName)['id'];

        if ($category['is_final'] == 1 && $categoryProducts = self::getProductsByFinalCategoryId($id, $mainCategoryId) ) {
            #array_push($products, $categoryProducts);
            $products = array_merge($products, $categoryProducts);
            return $products;
        }
        
        if(isset($category['childs'])):
            foreach ($category['childs'] as $subcategory) {
                if($addProducts = self::getProductsByCategoryWithinMainCategory($subcategory['id'], $mainCategoryName)):
                    $products = array_merge($products, $addProducts);
                endif;
            }
            return $products;
        endif;
    }
    
    /**
     * to count a number of products of the main category
     * 
     * @param string $name
     * @return integer
     */
    public static function countProductsInMainCategory(string $name) {
        $con = DbConnect::connect();
        
        $query = 'SELECT count(product.id) FROM product INNER JOIN category ON '
                . 'product.main_category_id = category.id WHERE category.title = :name';
        $sth = $con->prepare($query);
       
        $sth->bindValue(':name', $name, PDO::PARAM_STR);
        $sth->execute();
        $result = $sth->fetchColumn();
        
        return $result;
    }
    
    public static function NgetProductsByCategoryWithinMainCategory(int $id, string $mainCategoryName, int $pageNum = 1) {

        $con = DbConnect::connect();
        $mainCategoryId = Category::getCategoryByName($mainCategoryName)['id'];
        
        $productsInRow = 3;
        $offset = ($pageNum-1)*$productsInRow;
        
        $ids = Category::getFinalCategoriesIds($id);
        
        //prepare an argument for the IN() mysql function 
        $in = implode(', ', $ids);
        
        $query = 'SELECT * FROM product WHERE category_id IN('. $in . ') '
                . 'AND main_category_id = :main_id LIMIT :limit OFFSET :offset';

        $sth = $con->prepare($query);
        $sth->setFetchMode(PDO::FETCH_ASSOC);
        
        $sth->bindValue(':main_id', $mainCategoryId, PDO::PARAM_INT);
        $sth->bindValue(':offset', $offset, PDO::PARAM_INT);
        $sth->bindValue(':limit', $productsInRow, PDO::PARAM_INT);

        $sth->execute();
        
        $i = 0;
        $products = array();

        while ($row = $sth->fetch()) {
            $products[$i]['id'] = $row['id'];
            $products[$i]['title'] = $row['title'];
            $products[$i]['code_number'] = $row['code_number'];
            $products[$i]['price'] = $row['price'];
            $products[$i]['category_id'] = $row['category_id'];
            $products[$i]['brand_id'] = $row['brand_id'];
            $products[$i]['description'] = $row['description'];
            $products[$i]['image'] = $row['image'];
            $products[$i]['availability'] = $row['availability'];
            $products[$i]['is_new'] = $row['is_new'];
            $products[$i]['product_status'] = $row['product_status'];
            $products[$i]['main_category_id'] = $row['main_category_id'];
            
            $i++;
        }
        
         return (is_array($products)) ? $products : false;
    }
    
    /**
     * returns the number of records in the 'product' table by category id and main category name (table 'category')
     * 
     * @param int $id
     * @param string $mainCategoryName
     * @return integer
     */
    public static function countProductsInCategory(int $id, string $mainCategoryName){
        
        $con = DbConnect::connect();
        $mainCategoryId = Category::getCategoryByName($mainCategoryName)['id'];
                
        $ids = Category::getFinalCategoriesIds($id);
        
        //prepare an argument for the IN() mysql function 
        $in = implode(', ', $ids);
        
        $query = 'SELECT count(*) FROM product WHERE category_id IN('. $in . ') '
                . 'AND main_category_id = :main_id ';
        
        $sth = $con->prepare($query);
        
        $sth->bindValue(':main_id', $mainCategoryId, PDO::PARAM_INT);
        $sth->execute();
        $result = $sth->fetchColumn();
        
        return intval($result);
    }

}
