<?php

//test new functions 

class TestController {
    public function actionTest(){
        $string = '21-11-2013';
        
        $pattern = '%^([0-3][0-9])-([0-1][0-9])-([0-9]{0,4})$%';
        
        $replacement = 'year: $3, month: $2, day: $1';
        
        echo preg_replace($pattern, $replacement, $string);
    }
}
