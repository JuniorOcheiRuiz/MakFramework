<?php
use Makframework\Http\Request;
use Makframework\Http\Response;
$autoload = require "vendor/autoload.php";

$resp = new Response('Prueba de Response Http', Response::OK);

$respHeaders = $resp->getHeaders();

$respHeaders->add(['user' => 'junior','edad' => 20]);

echo $respHeaders;

$resp->send();
