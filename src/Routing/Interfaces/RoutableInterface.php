<?php
namespace Makframework\Routing\Interfaces;
use Closure;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

/**
 *
 */
interface RoutableInterface
{
  /**
   * setPattern
   * @param string $pattern
   * @return RoutableInterface
   */
  public function setPattern(string $pattern) : RoutableInterface;

  /**
   * getPattern
   * @return string
   */
  public function getPattern() : string;

  /**
   * setCallback
   * @param callable $callback
   * @return RoutableInterface
   */
  public function setCallback(callable $callback) : RoutableInterface;

  /**
   * getCallback
   * @return string
   */
  public function getCallback() : Closure;

  /**
   * getArgument
   * @param string $name [description]
   * @return mixed
   */
  public function getArgument(string $name);

  /**
   * getArguments
   * @return array
   */
  public function getArguments() : array;

  /**
   * setArguments
   * @return RoutableInterface
   */
  public function setArguments(array $arguments) : RoutableInterface;

  /**
   * setArgument
   * @param string $name
   * @param mixed $value
   * @return RoutableInterface
   */
  public function setArgument(string $name, $value) : RoutableInterface;

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
  public function addArgument(string $name, $value) : RoutableInterface;

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
  public function addArguments(array $arguments) : RoutableInterface;

  /**
   * addMiddleware
   * @param MiddlewareInterface $middleware [description]
   */
  public function addMiddleware(MiddlewareInterface $middleware) : RoutableInterface;

  /**
   * getMiddlewares
   * @return MiddlewareInterface[]
   */
  public function getMiddlewares() : array;

  /**
   * __invoke
   * @param RequestInterface $request
   * @param ResponseInterface $response
   * @param array $args arguments
   * @return mixed
   */
  public function __invoke(RequestInterface $request, ResponseInterface $response);
}
