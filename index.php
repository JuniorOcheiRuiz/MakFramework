<?php
use Makframework\Http\Request;
use Makframework\Http\Response;
use Makframework\Router\Router;

$autoload = require "vendor/autoload.php";


$request = Request::capture();

Router::get('/', function () {
});


$router = new Router($request);

echo $router;
