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
