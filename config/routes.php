<?php

/**
 * stores routes
 */

return [
    'news' => 'news/list',
    'news/([0-9]+)' => 'news/view/$1',
    'products' => 'products/view',
    'test' => 'test/test',
];
