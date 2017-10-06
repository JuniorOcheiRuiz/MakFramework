<?php
namespace Makframework\Routing;
use AltoRouter;

/**
 *
 */
class Router
{


  public function __construct()
  {
    $this->altoRouter = new AltoRouter;
  }

  public function map(string $method, string $requestPath, $callable)
  {
    $this->altoRouter->map($method, $requestPath, $target);
  }



}
