<?php


/**
 * Class for connection to database
 *
 * @author suray
 */
class DbConnect {
    
    /**
     * handles connection to database
     * 
     * @return \PDO
     */
    public static function connect() {
         $pathToLocalSettings = ROOT . '/config/local_private.php';
         $localSettings = include($pathToLocalSettings);
         
         $host = $localSettings['mysql_host'];
         $dbname = $localSettings['mysql_dbname'];
         $username = $localSettings['mysql_user'];
         $password = $localSettings['mysql_password'];
         
         $db = new PDO("mysql:host=$host; dbname=$dbname; charset=utf8", $username, $password);
         return $db; 
    }
}
