<?php


/**
 * Base Controller Class
 *
 * @author suray
 */
abstract class BaseController {
    
    //stores local settings
    protected $localSettings;
    /**
     * do child classes to describe __controllerConstruct() function
     * if they do not need this - just return true in this function
     */
    
    abstract public function __controllerConstruct();

    /**
     * assigns to @var $localSettings local settings
     */
    public function __construct() {
        $pathToLocal = ROOT . '/config/local.php';
        $this->localSettings = include($pathToLocal);
        $this->__controllerConstruct();
    }
    
    /**
     * takes an array and divides it into rows according to layout requirements
     * 
     * @param int $elementsInRow
     * @param array $arr
     * @return array|boolean
     */
    public function delimitArrayForLayout(int $elementsInRow, array $arr) {
        $optimizedArray = array();
        $numberOfArrayElts = count($arr);
        
        for($i=0;$i<$numberOfArrayElts;$i+=$elementsInRow) {
            for($j=$i;$j<$i+$elementsInRow;$j++) {
                if(array_key_exists($j, $arr)):
                    $optimizedArray[$i][$j] = $arr[$j];
                endif;
            }
        }
        
        return (is_array($optimizedArray)) ? $optimizedArray : FALSE;
    }
}
