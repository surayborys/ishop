<?php

/**
 * Description of MainController
 *
 * @author suray
 */
class MainController {
    
    public function actionIndex() {
        echo '<br><b>' . 'INDEX PAGE' . '<b><br>';
    }
    
    public function action404() {
        echo '<br><b>' . '404 PAGE' . '<b><br>'; 
        echo '<p><a href="/">BACK TO MAIN PAGE</a></p>';
    }
}
