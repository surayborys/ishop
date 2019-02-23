<?php
namespace Models;

use Components\DbConnect;
use PDO;
/**
 * A model class for the 'brand' table
 *
 * @author suray
 */
class Brand {
    
    /**
     * gets all the records from the 'brand' table
     * 
     * @return array|boolean
     */
    public static function getBrandsList() {
        $con = DbConnect::connect();
        
        $checkQuery = 'SELECT count(*) FROM brand WHERE true';
        if($result = $con->query($checkQuery)){
            if($result->fetchColumn() < 1){
                return false;
            }       
        }
        
        $query = 'SELECT * from brand WHERE true';
        $result = $con->query($query);
        
        $result->setFetchMode(PDO::FETCH_ASSOC);
        
        $i = 0;
        $brands = array();
        
        while($row = $result->fetch()) {
            $brands[$i]['id'] = $row['id'];
            $brands[$i]['title'] = $row['title'];
                        
            $i++;    
        }
        return is_array($brands) ? $brands : false;
    }
}
