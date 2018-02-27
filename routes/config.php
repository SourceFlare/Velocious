<?php declare(strict_types=1);  namespace Velocious\routes;

# Inject Dependencies
use Velocious\core\Render;
use Velocious\core\MimeTypes;
use Velocious\core\Exception;
use Velocious\config\Restricted;



/**
 * Index Route - Serves up a static HTML files from
 * the ./html/ folder.
**/
$route["/"] = [
    "Rules" => [
        "Allowed_Request_Types" => ["GET"],
        "Allowed_Remote_Addr"   => Restricted::getRemoteAddresses(),
        "Secure" => 0],
    "Controller"  => function (array $state) : bool {
        return Render::file("/public/Welcome.html", "html");
    }
];


$route["/controller-test/"] = [
    "Rules" => [
        "Allowed_Request_Types" => ["GET"],
        "Allowed_Remote_Addr"   => Restricted::getRemoteAddresses(),
        "Secure" => 0],
    "Controller"  => function (array $state) : bool {
        return (new \Velocious\controllers\Application)->homePage();
    }
];

$route["/input-test/{text}/"] = [
    "Rules" => [
        "Allowed_Request_Types" => ["GET"],
        "Allowed_Remote_Addr"   => Restricted::getRemoteAddresses(),
        "Secure" => 0],
    "Controller"  => function (array $state) : bool {
        echo json_encode($state['text']);
        return true;
    }
];