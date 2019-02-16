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
    'category/([a-zA-Z0-9]+)' => 'category/index/$1',
    'category/([a-zA-Z0-9]+)/([0-9])+' => 'category/view/$1/$2',
    
    'product/([0-9]+)' => 'product/index/$1',
];

