<?php
/**
 * router class  
 */

###################################DEV MODE###############################
class Router 
{
    //stores declared rotes 
    private $routes;
    //stores local settings
    private $localSettings;
    /**
     * assigns to @var $routes declared routes
     * assigns to @var $localSettings local settings
     * @return bool 
     */
    public function __construct() {
        $pathToRoutes = ROOT . '/config/routes.php';
        $this->routes = include($pathToRoutes);
        $pathToLocal = ROOT . '/config/local.php';
        $this->localSettings = include($pathToLocal);
    }
    
    /**
     * gets request uri from the $_SERVER superglobal
     * @return string|bool
     */
    private function getQueryString(){
        $uri = filter_input(INPUT_SERVER, 'REQUEST_URI', FILTER_SANITIZE_URL);
        return ($uri) ? trim($uri, '/') : false;
    }
    
    /**
     * checks if the requested uri is main page
     * @return bool 
     */
    private function checkIfIndex(string $uri) : bool{
        return ($uri == $this->localSettings['pathToIndex']) ? true : false;
    }
    
    /**
     * takes string with user query and returns array 
     * ['controller' => 'ControllerName', 'action' => 'actionName', 'params' => []]
     * 
     * @param string $address
     * @return array
     */
    private function processAddress(string $address):array {
        $explodedAddress = explode('/', $address);
        
        $result = array();
                
        $result['controller'] = ucfirst(array_shift($explodedAddress)) . 'Controller';
        $result['action'] = 'action' . ucfirst(array_shift($explodedAddress));
        $result['params'] = $explodedAddress;
        
        return $result;
    }


    /**
     * takes query string from input and runs determined action and controller
     * 
     * @param string $internalRoot
     * @return boolean
     */
    private function runAction(string $internalRoot) {
        $querySegmentsArray = $this->processAddress($internalRoot);
        $controller = $querySegmentsArray['controller'];
        $action = $querySegmentsArray['action'];
        $params = $querySegmentsArray['params'];
        
        $controllerFile = ROOT . '/controllers/' . $controller . '.php';
        if(file_exists($controllerFile)) {
            require_once ROOT . '/controllers/' . $controller . '.php';
            $controllerObj = new $controller;
            
            call_user_func_array(array($controllerObj, $action), $params);
            return true;
        }
        return false;          
    }

    /**
     * takes user query, checks for matches in routes array and runs 
     * action in determined controller
     *  
     * @return boolean
     */
    public function run(){
        $uri = $this->getQueryString();
       
        //check if the requested uri is index page
        if($this->checkIfIndex($uri)) {
            $this->runAction($this->localSettings['indexRoute']);
            return true;
        }
        //set flag for finded routes
        $matches = false; 
        
        //loop through the routes and find matches
        foreach ($this->routes as $pattern=>$address) {
            if(preg_match("%^$pattern$%", $uri)) {
                               
                //replace pattern submasks with values from request uri 
                $internalRoute = preg_replace("%$pattern%", $address, $uri);
                $this->runAction($internalRoute);
          
                $matches = true; //set flag to TRUE: route finded
                break;
            }
        }
        
        //if there're no matches - go to 404 page
        if($matches == false) {
             $this->runAction($this->localSettings['_404Route']);
        }
    }
}
