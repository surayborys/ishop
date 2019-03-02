<?php

/**
 * stores routes
 */

return [
    'news' => 'news/list',
    'news/([0-9]+)' => 'news/view/$1',
    'product/([0-9]+)' => 'product/index',
    'test' => 'test/test',
    
    ##########I_SHOP ROUTES##############
    'category/([a-zA-Z0-9]+)/page-([0-9]+)' => 'category/index/$1/$2',
    'category/([a-zA-Z0-9]+)/([0-9]+)/page-([0-9]+)' => 'category/view/$1/$2/$3',
    
    'product/([0-9]+)' => 'product/index/$1',
    
    'register' => 'user/register',
    'profile' => 'profile/index',
    'login' => 'user/login',
    'logout' => 'user/logout',
];

