<?php
namespace Makframework\Routing\Interfaces;
use Makframework\Routing\RouteCollection;

/**
 * RouteCollectionInterface
 */
interface RouteCollectionInterface
{
  /**
   * setBasePattern
   *
   * @param string $pattern
   *
   * @return RouteCollection
   */
  public function setBasePattern(string $pattern) : RouteCollection;

  /**
   * getBasePattern
   *
   * @return string
   */
  public function getBasePattern() : string;

  /**
   * map
   *
   * @param string[] $methods
   * @param string $pattern
   * @param string|callable $callback
   * @return RouteInterface
   */
   public function map(array $methods, string $pattern, callable $callback) : RouteInterface;

   /**
    * get
    *
    * @param string $pattern
    * @param string|callable $callback
    * @return RouteInterface
    */
   public function get(string $pattern, callable $callback) : RouteInterface;

   /**
    * post
    *
    * @param string $pattern
    * @param string|callable $callback
    * @return RouteInterface
    */
   public function post(string $pattern, callable $callback) : RouteInterface;

   /**
    * put
    *
    * @param string $pattern
    * @param string|callable $callback
    * @return RouteInterface
    */
   public function put(string $pattern, callable $callback) : RouteInterface;

   /**
    * delete
    *
    * @param string $pattern
    * @param string|callable $callback
    * @return RouteInterface
    */
   public function delete(string $pattern, callable $callback) : RouteInterface;

   /**
    * options
    *
    * @param string $pattern
    * @param string|callable $callback
    * @return RouteInterface
    */
   public function options(string $pattern, callable $callback) : RouteInterface;

   /**
    * patch
    *
    * @param string $pattern
    * @param string|callable $callback
    * @return RouteInterface
    */
   public function patch(string $pattern, callable $callback) : RouteInterface;

   /**
    * any
    *
    * @param string $pattern
    * @param string|callable $callback
    * @return RouteInterface
    */
   public function any(string $pattern, callable $callback) : RouteInterface;

   /**
    * group
    *
    * @param string $pattern
    * @param callable|Closure $callback
    * @return RouteGroupInterface
    */
   public function group(string $pattern, callable $callback) : RouteGroupInterface;

   /**
    * addRoute
    *
    * @param RouteInterface $route
    *
    * @return RouteCollectionInterface
    */
   public function addRoute(RouteInterface $route) : RouteCollectionInterface;

   /**
    * addRoutes
    *
    * @param RouteInterface[] $routes
    *
    * @return RouteCollectionInterface
    */
   public function addRoutes(array $routes) : RouteCollectionInterface;

   /**
    * getRoutes()
    *
    * @return RouteCollection[]
    */
   public function getRoutes() : array;
}
