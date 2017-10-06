<?php
namespace Makframework\Routing;

use Makframework\Routing\Interfaces\RouterInterface;

/**
 *
 */
class Router implements RouterInterface
{
  /**
   *  @var Route[]
   */
  protected $routes = [];

  protected $container;

  public function __construct()
  {

  }

  public function map(string $method, string $requestPath, $callable)
  {

  }


  public function run() : void;
  
}
