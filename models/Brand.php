<?php

/**
 * A model class for the 'brand' table
 *
 * @author suray
 */
class Brand {
    
    public static function getBrandsList() {
        $con = DbConnect::connect();
        
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
        return $brands;
    }
}
