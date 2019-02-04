<?php

require_once ROOT . '/models/News.php';

/**
 * News Controller
 */
class NewsController {
    
    /**
     * get news list from model end render it to view
     */
    public function actionList() {
        $newsList = News::getNewsList();        
        require_once ROOT . '/views/news/index.php';
    } 
    
    /**
     * get news item by id from model end render it to view
     */
    public function actionView(int $id) {
        if($newsItem = News::getItemById($id)){
            require_once ROOT . '/views/news/single.php';
        }else{
            header('Location: /404_error_page');
        }
    }
}

