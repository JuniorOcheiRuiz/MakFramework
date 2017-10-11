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
   * @var RouterInterface
   */
  protected $router;

  /**
   * Class constructor
   * @param string $pattern
   * @param callable $callback
   */
  public function __construct(string $pattern, callable $callback)
  {
    if (!$callback instanceof Closure) {
      $callback = Closure::fromCallable($callback);
    }

    $this->router = new Router();
    $this->router->setBasePath($pattern);

    // Router instance as $this of Closure
    $callback->bindTo($this->router);

    $callback();
  }

  /**
   * getRoutes
   * @return RouteInterface[]
   */
  public function getRoutes() : array
  {
    return $this->route
  }

  public function __destruct()
  {
    foreach ($this->router->getRoutes() as $route) {
      $route->addMiddlewares($this->getMiddlewares());
    }
  }
}
