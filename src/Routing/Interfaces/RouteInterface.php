<?php
namespace Makframework\Routing\Interfaces;
use Closure;
use Psr\Http\Message\RequestInterface;
use Makframework\Http\Interfaces\ResponseInterface;

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
   * hasMethod
   * @param string $method
   *
   * @return bool
   */
  public function hasMethod(string $method) : bool;

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
   * @return RouteInterface
   */
  public function setArguments(array $arguments) : RouteInterface;

  /**
   * setArgument
   * @param string $name
   * @param mixed $value
   * @return RouteInterface
   */
  public function setArgument(string $name, $value) : RouteInterface;

  /**
   * addArgument
   *
   * Add a value to the arguments stack. If the key of a value is already present in the stack,
   * the method throw a exception reporting the duplicate value.
   *
   * @param string $name
   * @param mixed $value
   *
   * @return RouteInterface
   *
   * @throws RouteException
   */
  public function addArgument(string $name, $value) : RouteInterface;

  /**
   * addArguments
   *
   * Add values to the arguments stack. If the key of a value is already present in the stack,
   * the method throw a exception reporting the duplicate value.
   *
   * @param array $arguments
   *
   * @return RouteInterface
   *
   * @throws RouteException
   */
  public function addArguments(array $arguments) : RouteInterface;

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
