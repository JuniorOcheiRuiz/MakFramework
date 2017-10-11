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
   * addMiddleware
   * @param MiddlewareInterface $middleware [description]
   */
  public function addMiddleware(MiddlewareInterface $middleware) : RoutableInterface;

  /**
   * addMiddlewares
   * @param MiddlewareInterface[] $middlewares [description]
   */
  public function addMiddlewares(array $middleware) : RoutableInterface;

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
