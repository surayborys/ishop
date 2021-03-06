<?php

//local settings

return [
    
    //common paths and routes
    'pathToIndex' => '',
    'pathToHeader' => ROOT . '/views/layouts/header.php',
    'pathToFooter' => ROOT . '/views/layouts/footer.php',
    'pathToFilter' => ROOT . '/views/layouts/filter.php',
    'indexRoute' => 'site/index',
    '_404Route' => 'site/404',
    
    //connection to DATABASE (store in another file and .gitignore)
    //WARNING!!!! SENSITIVE DATA!!!!
    'mysql_host' => 'localhost',
    'mysql_dbname' => 'shop',
    'mysql_user' => '',
    'mysql_password' => '',
    
    //layout requirements
    'numOfNewProductsForMainPage' => 9,
    'numOfProductsForCategoryMainPage' => 9,
    'numOfProductsForCategoryPage' => 6,
    'elementsInRowForPageLayout' => 3,
];
