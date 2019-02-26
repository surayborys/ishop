<?php
namespace Models;

/**
 * Base Model class
 *
 * @author suray
 */
class BaseModel {
   
    protected static $tableName;
    public static function getTable(){
        return static ::$tableName;
    }   
} 
