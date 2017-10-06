<?php
namespace Makframework\Routing;

/**
 * Route
 */
class Route implements RouteI
{
  /**
   * @var string[]
   */
  protected $methods = [];

  /**
   * @var string
   */
  protected $pattern;

  /**
   * @var callable|Closure
   */
  protected $callback;

  /**
   * @var string
   */
  protected $name;

  /**
   * @var MiddlewareInterface[]
   */
  protected $middlewares = [];
}
