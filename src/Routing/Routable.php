<?php
namespace Makframework\Routing;
use Closure;
use Makframework\Routing\Interfaces\RoutableInterface;
use Makframework\Routing\Interfaces\MiddlewareInterface;

/**
 * Routable
 */
abstract class Routable implements RoutableInterface
{
  protected $pattern = '';

  protected $callback;

  protected $middlewares = [];

  /**
   * setPattern
   * @param string $pattern
   * @return RoutableInterface
   */
  public function setPattern(string $pattern) : RoutableInterface
  {
    $this->pattern = $pattern;
    return $this;
  }

  /**
   * getPattern
   * @return string
   */
  public function getPattern() : string
  {
    return $this->pattern;
  }

  /**
   * setCallback
   * @param callable $callback
   * @return RoutableInterface
   */
  public function setCallback(callable $callback) : RoutableInterface
  {
    $this->callback = $callback;
    return $this;
  }

  /**
   * getCallback
   * @return string
   */
  public function getCallback() : Closure
  {
    return $this->callback;
  }

  /**
   * addMiddleware
   * @param MiddlewareInterface $middleware [description]
   */
  public function addMiddleware(MiddlewareInterface $middleware) : RoutableInterface
  {
    $this->middlewares[] = $middleware;
    return $this;
  }

  /**
   * getMiddlewares
   * @return MiddlewareInterface[]
   */
  public function getMiddlewares() : array
  {
    return $this->middlewares;
  }
}
