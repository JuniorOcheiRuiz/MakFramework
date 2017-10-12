<?php
namespace Makframework\Routing;
use Closure;
use Makframework\Routing\Interfaces\RouteInterface;
use Makframework\Routing\Interfaces\RouterInterface;
use Makframework\Routing\Interfaces\RouteGroupInterface;
/**
 * RouteGroup
 */
class RouteGroup extends Routable implements RouteGroupInterface
{
  /**
   * @var RouteCollection
   */
  protected $routeCollection;

  /**
   * Class constructor
   * @param string $pattern
   * @param callable $callback
   */
  public function __construct(string $pattern, callable $callback)
  {
    $this->setPattern($pattern);
    $this->setCallback($callback);

    $this->routeCollection = new RouteCollection();
    $this->routeCollection->setBasePattern($this->pattern);

    // Router instance as $this of Closure
    $this->callback->bindTo($this->routeCollection);

    $this->callback();
  }

  /**
   * getRoutes
   * @return RouteInterface[]
   */
  public function getRoutes() : array
  {
    return $this->routeCollection->getRoutes();
  }

  /**
   * __destruct
   * This method add all middlewares of the RouteGroup to the routes, when execution of this class is finished. 
   */
  public function __destruct()
  {
    foreach ($this->getRoutes() as $route) {
      $route->addMiddlewares($this->middlewares);
    }
  }
}
