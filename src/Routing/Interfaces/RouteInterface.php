<?php
namespace Makframework\Routing\Interfaces;
use Closure;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

/**
 * RouteInterface
 */
interface RouteInterface extends RoutableInterface
{
  /**
   * class constructor
   * @param string[] $methods
   * @param string $pattern
   * @param callable|\Closure $callback
   * @return RouteInterface
   */
  public function __construct(array $methods, string $pattern, callable $callback);

  /**
   * setMethods
   *
   * @param string[] $methods
   *
   * @return RouteInterface
   */
  public function setMethods(array $methods) : RouteInterface;

  /**
   * getMethods
   *
   * @return array
   */
  public function getMethods() : array;

  /**
   * setName
   * @param string $name
   * @return self
   */
  public function setName(string $name) : RouteInterface;

  /**
   * getName
   * @return string
   */
  public function getName() : string;


}
