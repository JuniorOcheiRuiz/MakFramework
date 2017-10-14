<?php
namespace Makframework\Routing;
use Closure;
use Makframework\Routing\Interfaces\RouteInterface;
use Makframework\Routing\Interfaces\RouteGroupInterface;
use Makframework\Routing\Interfaces\RouteCollectionInterface;

/**
 * RouterMethods
 */
class RouteCollection implements RouteCollectionInterface
{
  /**
   * @var string
   */
  protected $basePattern = '';

  /**
   * @var RouteInterface[]
   */
  protected $routes = [];

  /**
   * setBasePattern
   *
   * @param string $pattern
   *
   * @return RouteCollection
   */
  public function setBasePattern(string $pattern) : RouteCollection
  {
    $this->basePattern = $pattern;

    return $this;
  }

  /**
   * getBasePattern
   *
   * @return string
   */
  public function getBasePattern() : string
  {
    return $this->basePattern;
  }

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
    // concat basePattern
    $pattern = $this->basePattern . $pattern;
    $this->routes[$pattern] = new Route($methods, $pattern, $callback);
    return $this->routes[$pattern];
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
  public function group(string $pattern, callable $callback) : RouteGroupInterface
  {
    $group = new RouteGroup($pattern, $callback);

    // add instance of routes from RouteGroup in routes of RouteCollection parent.
    $this->addRoutes($group->getRoutes());

    return $group;
  }

  /**
   * addRoute
   *
   * @param RouteInterface $route
   *
   * @return RouteCollectionInterface
   */
  public function addRoute(RouteInterface $route) : RouteCollectionInterface
  {
    $this->routes[] = $route;
  }

  /**
   * addRoutes
   *
   * @param RouteInterface[] $routes
   *
   * @return RouteCollectionInterface
   */
  public function addRoutes(array $routes) : RouteCollectionInterface
  {
    foreach ($routes as $route) {
      $this->addRoute($route);
    }

    return $this;
  }

  /**
   * getRoutes()
   *
   * @return RouteInterface[]
   */
  public function getRoutes() : array
  {
    return $this->routes;
  }
}
