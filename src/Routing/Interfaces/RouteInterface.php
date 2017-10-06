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
  public function __construct(array $methods, string $pattern, $callback);

  /**
   * addMethods
   * @param string[] $methods
   *@return self
   */
  public function addMethods(array $methods) : RouteInterface;

  /**
   * removeMethods
   * @param string $method
   * @return self
   */
  public function removeMethods(string $method = '') : RouteInterface;

  /**
   * setArgument
   * @param string $key
   * @param string $value
   *@return static
   */
  public function setArgument(string $key, $value) : RouteInterface;

  /**
   * setArgument
   * @param string $key
   * @param string $value
   *@return static
   */
  public function setArguments(array $arguments) : RouteInterface;

  /**
   * getArgument
   * @param string $key
   * @param string $value
   *@return static
   */
  public function getArgument(string $key);

  /**
   * getArguments
   * @param string $key
   * @param string $value
   *@return static
   */
  public function getArguments() : array;

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

  /**
   * __invoke
   * @param RequestInterface $request
   * @param ResponseInterface $response
   * @return mixed
   */
  public function __invoke(RequestInterface $request, ResponseInterface $response);
}
