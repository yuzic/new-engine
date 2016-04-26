<?php
return [
    [
        'pattern' => '',
        'action' => 'Index/index',
    ],
    [
        'pattern' => 'page/:page',
        'action' => 'Index/index',
    ],
    [
        'pattern' => 'sort/:field',
        'action' => 'Index/index',
    ],
    [
        'pattern' => 'news/:id',
        'action' => 'Index/view',
    ],
    [
        'pattern' => 'search/:id',
        'action' => 'Index/search',
    ],
];
