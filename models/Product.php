<?php

include_once ROOT . '/models/Category.php';

/**
 * A model for the 'product' table
 *
 * @author suray
 */
class Product {

    /**
     * to get products from the product table, that are NEW (new = 1)
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
    public static function getProductsByMainCategoryName(string $name) {
        
        $con = DbConnect::connect();
        
        $query = 'SELECT product.*, category.title AS main_cat_title '
                . 'FROM product INNER JOIN category '
                . 'ON product.main_category_id = category.id '
                . 'WHERE category.title = :name';
        
        $sth = $con->prepare($query);
        $sth->setFetchMode(PDO::FETCH_ASSOC);
        
        $sth->bindValue(':name', $name, PDO::PARAM_STR);
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

}
