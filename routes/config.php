<?php declare(strict_types=1);

namespace Velocious\routes;

use Velocious\core\Render;
use Velocious\core\MimeTypes;
use Velocious\core\Exception;


/**
 * Index Route - Serves up a static HTML files from
 * the ./html/ folder.
 */
$route["/"] = [
    
    "Rules" => [
        "Allowed_Request_Types" => ["GET", "POST"],
        "Allowed_Remote_Addr"   => ["localhost", "::1"]],
    
    "Controller"  => function (array $state) : bool {
        return Render::file("./html/index.html", "html");
    }
];


/**
 * Read a blog using url variable matching. The
 * variables in the url become available through
 * the $state[] variable passed into the closure.
 */
$route["/blog/{page_id}/{blog_id}/"] = [

    "Rules" => [
        "Allowed_Request_Types" => ["GET", "POST"], 
        "Allowed_Remote_Addr" => ["localhost", "::1"]],
        
    "Controller"  => function (array $state) : bool {
        return Render::json([
            'response' => [
                'blog_page_id' => $state['page_id'],
                'blog_id'      => $state['blog_id']
            ]
        ]);
    }
];


/**
 * Now we use a service within a route to do 
 * some grunt work and pass to the client.
 */
$route["/reverse-string/"] = [

    "Rules" => [
        "Allowed_Request_Types" => ["POST"],
        "Allowed_Remote_Addr"   => ["localhost", "::1"]],
        
    "Controller"  => function (array $state) : bool {
        return Render::json([
            'response' => [
                'string'          => $state['my_string'],
                'reversed_string' => (new \Velocious\services\ReverseString)->commit($state['my_string'])
            ]
        ]);
    }
];
