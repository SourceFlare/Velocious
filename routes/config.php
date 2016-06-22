<?php declare(strict_types=1);

namespace Velocious\routes;

use Velocious\core\Render;
use Velocious\core\MimeTypes;
use Velocious\core\Exception;
use Velocious\core\BigData;


# Read a blog
$route["/{page_id}/{blog_id}/"] = [
	"Rules" => [
		"Allowed_Request_Types" => ["POST", "GET"], 
		"Allowed_Remote_Addr" => ["194.247.236.46", "localhost", "::1"]],
	"Controller"  => function (array $state) : bool {
	    return Render::json([
	        'response' => [
    	        'blog_page_id' => $state['page_id'],
        	    'blog_id'      => $state['blog_id'],
            	'blog_mode'    => $state['mode']
	        ]
	    ]);
	}
];


# Delete a blog
$route["/{page_id}/{blog_id}/delete/"] = [
	"Rules" => [
		"Allowed_Request_Types" => ["POST"],
		"Allowed_Remote_Addr"   => ["194.247.236.46", "localhost", "::1"]],
	"Controller"  => function (array $state) : bool {
	    return Render::json([
	        'response' => [
    	        'blog_page_id' => $state['page_id'],
        	    'blog_id'      => $state['blog_id'],
            	'blog_mode'    => $state['mode']
	        ]
	    ]);
	}
];
