<?php

/**
 * News Model
 *
 * @author suray
 */
class News {
    
    /**
     * select all records from the 'news' table
     * @return array
     */
    public static function getNewsList():array {
        $con = DbConnect::connect();
        $query = 'SELECT * FROM news ORDER BY date DESC LIMIT 20';
        $result = $con->query($query);
        
        $result->setFetchMode(PDO::FETCH_ASSOC);
        
        $i = 0;
        $newsList = array();
        while ($row = $result->fetch()) {
            $newsList[$i]['id'] = $row['id'];
            $newsList[$i]['title'] = $row['title'];
            $newsList[$i]['short_content'] = $row['short_content'];
            $newsList[$i]['date'] = self::dateFormat($row['date']);
            $newsList[$i]['content'] = $row['content'];
        $i++;
        }
        return $newsList;
    }
    
    /**
     * get one record with id = $id from the 'news' table
     * 
     * @param int $id
     * @return mixed
     */
    public static function getItemById(int $id) {
        $con = DbConnect::connect();
        
        $query = 'SELECT * FROM news WHERE id='.$id;
        $result = $con->query($query);
        if(!$result) {
            return false;
        }        
        $result->setFetchMode(PDO::FETCH_ASSOC);
        
        $record = $result->fetch();
        //set date to required format
        $record['date'] = self::dateFormat($record['date']) ?? null;
        return $record;

    }
    
    /**
     * convert datetime from MySQL to DD MM YYYY format
     * @param string $date
     * @return string
     */
    private static function dateFormat(string $date=null) {
        $pattern = "%([0-9]{4})-([0-9]{2})-([0-9]{2})\s([0-9]{2}):([0-9]{2}):([0-9]{2})%";
        $replacement = "$1, $3-$2";
        return preg_replace($pattern, $replacement, $date);
    }
}
