<?php
require "vendor/autoload.php";

use \Symfony\Component\HttpFoundation\Request;
use \Symfony\Component\HttpFoundation\Response;

$request = Request::createFromGlobals();

$name = $request->get('name');

$url = $request->getPathInfo();
$response = new Response();
$method = $request->getMethod();
if($method == "GET"){

    var_dump( $method );  die();
}

switch($url) {
    case '/':
        $response->setContent('Accueil');
        break;
    case '/admin':
        $response->setContent('Accès Espace Admin');
        break;
    default :
        $response->setStatusCode(Response::HTTP_NOT_FOUND);

}

$response->send();

// var_dump(  );  die();