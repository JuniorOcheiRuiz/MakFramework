<?php
namespace Makframework\Router;

use InvalidArgumentException;
use Makframework\Core\Object;

/**
 *RouteCollection
 */
abstract class RouteCollection extends Object
{
    /**
   *Route
   *@var array
   */
  protected static $route = [];

  /**
   *Methods allowed
   *@var array
   */
  protected static $methodsAllowed = ['GET','HEAD','POST','PUT','DELETE','CONNECT','OPTIONS','TRACE','PATCH'];

  /**
   *Add General
   *@param string[] $methods
   *@param string $route
   *@param string|callable $resource
   *@return void
   */
  protected static function add(array $methods, string $route, $resource) : void
  {
      foreach ($methods as $method) {
          $method = strtoupper($method);

          if (!in_array($method, self::$methodsAllowed)) {
              throw new InvalidArgumentException("$method: Invalid Http method.");
              break;
          }
          self::$route[$method][$route] = $resource;
      }
  }

  /**
   *GET
   *@param string $route
   *@param string|callable $resource
   *@return void
   */
  public static function get(string $route, $resource) : void
  {
      self::add(['GET'], $route, $resource);
  }

  /**
   *POST
   *@param string $route
   *@param string|callable $resource
   *@return void
   */
  public static function post(string $route, $resource) : void
  {
      self::add(['POST'], $route, $resource);
  }
}
