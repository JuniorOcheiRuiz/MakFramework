<?php
namespace Makframework\Router;

/**
 *RouteCollection
 */
abstract class RouteCollection {
  /**
   *@var array
   */
  protected static $route = [];

  /**
   *Add General
   *@param string[] $methods
   *@param string $route
   *@param string|callable $resource
   *@return void
   */
  protected static function add(array $methods, string $route, $resource) : void
  {
    foreach($methods as $method) {
      self::$route[$method][$route] = $resource;
    }
  }

  /**
   *GET
   *@param string $route
   *@param string|callable $resource
   *@return void
   */
  public static function get(string $route, $resource) : void {
    self::add(['GET'], $route, $resource);
  }

  /**
   *POST
   *@param string $route
   *@param string|callable $resource
   *@return void
   */
  public static function post(string $route, $resource) : void {
    self::add(['POST'], $route, $resource);
  }
}
