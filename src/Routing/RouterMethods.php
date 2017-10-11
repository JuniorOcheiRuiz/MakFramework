<?php
namespace Makframework\Routing;
use Closure;

/**
 * RouterMethods
 */
abstract class RouterMethods implements RouterMethodsInterface
{

  /**
   * map
   *
   * @param string[] $methods
   * @param string $pattern
   * @param string|callable|Closure $callback
   * @return RouteInterface
   */
  public function map(array $methods, string $pattern, callable $callback) : RouteInterface
  {
    return new Route($methods, $pattern, $callback);
  }

  /**
   * get
   *
   * @param string $pattern
   * @param string|callable|Closure $callback
   * @return RouteInterface
   */
  public function get(string $pattern, callable $callback) : RouteInterface
  {
    return $this->map(['GET'], $pattern, $callback);
  }

  /**
   * post
   *
   * @param string $pattern
   * @param string|callable|Closure $callback
   * @return RouteInterface
   */
  public function post(string $pattern, callable $callback) : RouteInterface
  {
    return $this->map(['POST'], $pattern, $callback);
  }

  /**
   * put
   *
   * @param string $pattern
   * @param string|callable|Closure $callback
   * @return RouteInterface
   */
  public function put(string $pattern, callable $callback) : RouteInterface
  {
    return $this->map(['PUT'], $pattern, $callback);
  }

  /**
   * delete
   *
   * @param string $pattern
   * @param string|callable|Closure $callback
   * @return RouteInterface
   */
  public function delete(string $pattern, callable $callback) : RouteInterface
  {
    return $this->map(['DELETE'], $pattern, $callback);
  }

  /**
   * options
   *
   * @param string $pattern
   * @param string|callable|Closure $callback
   * @return RouteInterface
   */
  public function options(string $pattern, callable $callback) : RouteInterface
  {
    return $this->map(['OPTIONS'], $pattern, $callback);
  }

  /**
   * patch
   *
   * @param string $pattern
   * @param string|callable|Closure $callback
   * @return RouteInterface
   */
  public function patch(string $pattern, callable $callback) : RouteInterface
  {
    return $this->map(['PATCH'], $pattern, $callback);
  }

  /**
   * any
   *
   * @param string $pattern
   * @param string|callable|Closure $callback
   * @return RouteInterface
   */
  public function any(string $pattern, callable $callback) : RouteInterface
  {
    return $this->map([], $pattern, $callback);
  }

  /**
   * group
   *
   * @param string $pattern
   * @param callable|Closure $callback
   * @return RouteGroupInterface
   */
  public function group(string $pattern, $callback) : RouteGroupInterface
  {
    $routeGroup = 
  }
}
