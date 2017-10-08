<?php
namespace Makframework\Routing;

use Makframework\Routing\Interfaces\RouteInterface;
use Makframework\Routing\Interfaces\RouterInterface;

/**
 *
 */
class Router implements RouterInterface
{
  /**
   *  @var RouteInterface[]
   */
  protected $routes = [];


  protected $container;

  public function __construct()
  {

  }

  public function map(string $method, string $requestPath, $callable)
  {

  }

  protected function builtSegments(string $pattern) : array 
  {

  }

  protected function match(string $requestPath) : RouteInterface
  {
    foreach ($this->routes as $pattern => $route) {
      if (preg_match('#')) {

      }
    }

    return false;
  }

  public function run() : void;

}
