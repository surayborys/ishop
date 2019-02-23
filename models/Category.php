<?php
namespace Models;

use Components\DbConnect;
use PDO;
/**
 * A model for the 'category' table
 *
 * @author suray
 */
class Category {

    /**
     * to get main categories (range_order = 1 in the 'category' table) 
     * 
     * @return array
     */
    public static function getMainCategories(): array {

        $con = DbConnect::connect();

        $query = 'SELECT * from category WHERE range_order = 1';
        $result = $con->query($query);

        $result->setFetchMode(PDO::FETCH_ASSOC);

        $i = 0;
        $mainCategories = array();

        while ($row = $result->fetch()) {
            $mainCategories[$i]['id'] = $row['id'];
            $mainCategories[$i]['title'] = $row['title'];
            $mainCategories[$i]['range_order'] = $row['range_order'];
            $mainCategories[$i]['description'] = $row['description'];
            $mainCategories[$i]['image'] = $row['image'];
            $mainCategories[$i]['is_final'] = $row['is_final'];
            $mainCategories[$i]['subcategories'] = self::getSubcatIds($row['id']);

            $i++;
        }
        return $mainCategories;
    }

    /**
     * to get an array of subcategories recursively from the 'hiera' table join 'category' table by category.id
     * 
     * @param int $id
     * @return array
     */
    public static function getSubcatIds(int $id) {

        $con = DbConnect::connect();

        $query = 'SELECT hiera.category_id, category.title, category.is_final FROM hiera INNER JOIN category '
                . 'ON hiera.category_id = category.id WHERE hiera.parent_id = :id';
        $sth = $con->prepare($query);
        $sth->setFetchMode(PDO::FETCH_ASSOC);

        $sth->bindValue(':id', $id, PDO::PARAM_INT);
        $sth->execute();

        $i = 0;
        $subcategories = array();
        while ($row = $sth->fetch()) {
            $subcategories[$i]['id'] = $row['category_id'];
            $subcategories[$i]['title'] = $row['title'];
            $subcategories[$i]['is_final'] = $row['is_final'];
            if ($subcategories[$i]['is_final'] == 0) {
                $subcategories[$i]['childs'] = self::getSubcatIds($subcategories[$i]['id']);
            }

            $i++;
        }

        return $subcategories;
    }

    /**
     * to get single category from the 'category' table by its name (the 'title' property)
     * 
     * @param string $name
     * @return boolean|array
     */
    public static function getCategoryByName(string $name) {

        $con = DbConnect::connect();

        $query = 'SELECT id, title, is_final from category WHERE title = :name';
        $sth = $con->prepare($query);
        $sth->setFetchMode(PDO::FETCH_ASSOC);

        $sth->bindValue(':name', $name, PDO::PARAM_STR);
        $sth->execute();

        $row = $sth->fetch();
        if (!$row) {
            return false;
        }

        $category = array();

        $category['id'] = $row['id'];
        $category['title'] = $row['title'];
        $category['is_final'] = $row['is_final'];

        if ($category['is_final'] == 0) {
            $category['childs'] = self::getSubcatIds($category['id']);
        }

        return $category;
    }

    /**
     * to get single category from the 'category' table by its id
     * 
     * @param string $name
     * @return boolean|array
     */
    public static function getCategoryById(int $id) {
        
        $con = DbConnect::connect();

        $query = 'SELECT * from category WHERE id = :id';
        $sth = $con->prepare($query);
        $sth->setFetchMode(PDO::FETCH_ASSOC);

        $sth->bindValue(':id', $id, PDO::PARAM_INT);
        $sth->execute();

        if ($row = $sth->fetch()):

            $category = array();

            $category['id'] = $row['id'];
            $category['title'] = $row['title'];
            $category['range_order'] = $row['range_order'];
            $category['is_final'] = $row['is_final'];
            if ($category['is_final'] == 0) {
                $category['childs'] = self::getSubcatIds($category['id']);
            }

            return $category;
            

        endif;
        return 0;
    }

    /**
     * to get a parent categories hierarchy for the category by its id
     * 
     * @param int $id
     * @param array $hieraArray
     * @return boolean|array
     */
    public static function getHierarchy(int $id, array $hieraArray = array()) {

        $con = DbConnect::connect();

        //return false if the category hasn't been found
        $category = self::getCategoryById($id);
        if (!$category) {
            return false;
        }

        //declare the output condition
        if ($category['range_order'] == 2) {
            return $hieraArray;
        }

        /*select the parent for the current category using parent-child relations 
         *between categories, described in the 'hiera' table*/
        $query = 'SELECT hiera.parent_id AS id , category.title AS title, '
                . 'category.range_order AS range_order, category.is_final AS is_final '
                . 'FROM hiera INNER JOIN category '
                . 'ON hiera.parent_id = category.id '
                . 'WHERE hiera.category_id = :id';

        $sth = $con->prepare($query);
        $sth->bindValue(':id', $id, PDO::PARAM_INT);

        $sth->setFetchMode(PDO::FETCH_ASSOC);
        $sth->execute();

        $parent_category = $sth->fetch();
        array_push($hieraArray, $parent_category);

        //recursively call to the getHierarchy() method
        return self::getHierarchy($parent_category['id'], $hieraArray);
    }
    
    /**
     * returns an array of ids of final categories for the current category by its id
     * 
     * @param int $id
     * @param array $finalCategoriesIds
     * @return boolean|array    
     */
    public static function getFinalCategoriesIds(int $id, $finalCategoriesIds = array()) {
        
        $con = DbConnect::connect();    

        //return false if the category hasn't been found
        $category = self::getCategoryById($id);
        if (!$category) {
            return false;
        }
        
        //determine the output condition
        if($category['is_final'] == 1) {
            $finalCategoriesIds[] = $category['id'];
            return $finalCategoriesIds;
        }
        
        //loop through the array of subcategories and grab the final categories
        if($category['childs']):
            foreach ($category['childs'] as $subcategory) {
                if($new_id = self::getFinalCategoriesIds($subcategory['id'], $finalCategoriesIds)){
                    $finalCategoriesIds = array_merge($finalCategoriesIds, $new_id);
                }
            }
            return is_array($finalCategoriesIds) ? (array_unique($finalCategoriesIds)) : false;
        endif;    
    } 

}
