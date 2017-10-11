<?php
namespace Makframework\Routing;
use Closure;
use Makframework\Routing\Exceptions\RouterException;
use Makframework\Routing\Exceptions\RoutableException;
use Makframework\Routing\Interfaces\RoutableInterface;
use Makframework\Routing\Interfaces\MiddlewareInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

/**
 * Routable
 */
abstract class Routable implements RoutableInterface
{
  /**
   * @var string
   */
  protected $pattern = '';

  /**
   * @var callable
   */
  protected $callback;

  /**
   * @var MiddlewareInterface[]
   */
  protected $middlewares = [];

  /**
   * @var callable
   */
  protected $stack = null;

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
    if (!$callback instanceof Closure) {
      $callback = Closure::fromCallable($callback);
    }

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
    $this->middleware = $middleware;
  }

  /**
   * addMiddlewares
   * @param MiddlewareInterface[] $middlewares [description]
   */
  public function addMiddlewares(array $middlewares) : RoutableInterface
  {
    $this->middlewares += $middlewares;
  }

  /**
   * pushToStack
   *
   * @param callable $callback
   *
   * @return Routable
   */
  protected function pushToStack(callable $callaback) : Routable
  {
    // Next callable to execute
    $next = $this->stack;

    // New callable
    $this->stack = function (RequestInterface $request,ResponseInterface $response) use($callback, $next) {

      $result = call_user_func($callback, $request, $response, $next);

      if (!$result instanceof ResponseInterface)
        throw new RouterException('The output of moddleware must be a intance of Makframework\Http\Interfaces\ResponseInterface');

      return $result;
    };

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

  /**
   * callStack
   * @param RequestInterface
   * @param ResponseInterface
   */
  public function callStack(RequestInterface $request, ResponseInterface $response) : ResponseInterface
  {
    if ($this->stack === null) {
      $this->stack = $this;
    }


    foreach ($this->middlewares as $middleware) {
        $this->pushToStack($middleware);
    }

    // execute the stack
    return $this->stack($request, $response);
  }
}
