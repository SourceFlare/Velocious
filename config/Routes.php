<?php declare(strict_types=1);

namespace Velocious\config;

use Velocious\core\Render;
use Velocious\core\MimeTypes;
use Velocious\core\Exception;


/**
 * Reading a Blog Route - passes in a pageid, 
 * articleid, and mode
 */
$route["/blog/{id}/"] = function (array $state) : bool {
    
    $data = [
        'response' => [
            'header' => [
                'protocol' => 'HTTP 1/1',
                'tcp/ip'    => 'tcp'
            ],
            'code'         => '200 OK',
            'message'   => 'Your page has been found!',
            'blog_id'      => $state['id']
        ]
    ];
    
    Render::json ($data);
    
    return true;
};



/**
 * Reading a Blog Route - passes in a pageid, 
 * articleid, and mode
 */
$route["/blog/{page_id}/{id}/{mode}/"] = function (array $state) : bool {
    
    $data = [
        'response' => [
            'header' => [
                'protocol' => 'HTTP 1/1',
                'tcp/ip'    => 'tcp'
            ],
            'code'         => '200 OK',
            'message'   => 'Edit Mode!',
            'blog_id'      => $state['id']
        ]
    ];
    
    Render::json ($data);
    
    return true;
};
