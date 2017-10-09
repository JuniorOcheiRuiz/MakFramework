<?php
namespace Makframework\Routing\Interfaces;

/**
 * RouterInterface
 */
interface RouterInterface
{
  /**
   * map
   *
   * @param string[] $methods
   * @param string $pattern
   * @param string|callable|Closure $callback
   * @return RouteInterface
   */
  public function map(array $methods, string $pattern, $callback) : RouteInterface;

  /**
   * get
   *
   * @param string $pattern
   * @param string|callable|Closure $callback
   * @return RouteInterface
   */
  public function get(string $pattern, $callback) : RouteInterface;

  /**
   * post
   *
   * @param string $pattern
   * @param string|callable|Closure $callback
   * @return RouteInterface
   */
  public function post(string $pattern, $callback) : RouteInterface;

  /**
   * put
   *
   * @param string $pattern
   * @param string|callable|Closure $callback
   * @return RouteInterface
   */
  public function put(string $pattern, $callback) : RouteInterface;

  /**
   * delete
   *
   * @param string $pattern
   * @param string|callable|Closure $callback
   * @return RouteInterface
   */
  public function delete(string $pattern, $callback) : RouteInterface;

  /**
   * options
   *
   * @param string $pattern
   * @param string|callable|Closure $callback
   * @return RouteInterface
   */
  public function options(string $pattern, $callback) : RouteInterface;

  /**
   * patch
   *
   * @param string $pattern
   * @param string|callable|Closure $callback
   * @return RouteInterface
   */
  public function patch(string $pattern, $callback) : RouteInterface;

  /**
   * any
   *
   * @param string $pattern
   * @param string|callable|Closure $callback
   * @return RouteInterface
   */
  public function any(string $pattern, $callback) : RouteInterface;

  /**
   * group
   *
   * @param string $pattern
   * @param callable|Closure $callback
   * @return RouteGroupInterface
   */
  public function group(string $pattern, $callback) : RouteGroupInterface;

  /**
   * getRoute
   *
   * @param string $pattern
   * @return RouteInterface
   */
  public function getRoute(string $pattern) : RouteInterface;

  /**
   * getRoutes
   *
   * @return RouteInterface[]
   */
  public function getRoutes() : array;

  /**
   * setRoute
   *
   * @param array $methods
   * @param string $pattern
   *
   * @return RouterInterface
   */
  public function setRoute() : RouterInterface;

  /**
   * setRoutes
   *
   * @param RouteInterface[]
   * @return RouterInterface
   */
  public function setRoutes(array $routes) : RouterInterface;


  /**
   * run
   *
   * @param bool $debugMode
   *
   * @throws HttpException
   *
   * @return void
   */
  public function run(bool $debugMode = false) : void;

}
