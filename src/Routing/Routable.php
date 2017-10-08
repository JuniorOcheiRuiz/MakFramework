<?php
namespace Makframework\Routing;
use Closure;
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
  protected $pattern = '';

  protected $callback;

  protected $arguments = [];

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
   * getArgument
   * @param string $name [description]
   * @return mixed
   */
  public function getArgument(string $name)
  {
    return $this->arguments[$name];
  }

  /**
   * getArguments
   * @return array
   */
  public function getArguments() : array
  {
    return $this->arguments;
  }

  /**
   * setArguments
   * @param array $arguments
   * @return RoutableInterface
   */
  public function setArguments(array $arguments) : RoutableInterface
  {
    $this->arguments = $arguments;
    return $this;
  }

  /**
   * setArgument
   * @param string $name
   * @param mixed $value
   * @return RoutableInterface
   */
  public function setArgument(string $name, $value) : RoutableInterface
  {
    $this->arguments[$name] = $value;
  }

  /**
   * addArgument
   *
   * Add a value to the arguments stack. If the key of a value is already present in the stack,
   * the method throw a exception reporting the duplicate value.
   *
   * @param string $name
   * @param mixed $value
   *
   * @return RoutableInterface
   *
   * @throws RoutableException
   */
  public function addArgument(string $name, $value) : RoutableInterface
  {
    if (isset($this->arguments[$name]))
      throw new RoutableException(sprintf('The argument %s is already exists in the arguments stack.', $name));

    $this->arguments[$name] = $value;

    return $this;
  }

  /**
   * addArguments
   *
   * Add values to the arguments stack. If the key of a value is already present in the stack,
   * the method throw a exception reporting the duplicate value.
   *
   * @param array $arguments
   *
   * @return RoutableInterface
   *
   * @throws RoutableException
   */
  public function addArguments(array $arguments) : RoutableInterface
  {
    foreach ($arguments as $name => $value) {
      $this->addArgument($name, $value);
    }

    return $this;
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
