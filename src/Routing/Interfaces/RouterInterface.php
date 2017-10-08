<?php
namespace Makframework\Routing\Interfaces;

/**
 * RouterInterface
 */
interface RouterInterface
{
  /**
   * map
   * @param string[] $methods
   * @param string $pattern
   * @param string|callable|Closure $callback
   * @return RouteInterface
   */
  public function map(array $methods, string $pattern, $callback) : RouteInterface;

  /**
   * get
   * @param string $pattern
   * @param string|callable|Closure $callback
   * @return RouteInterface
   */
  public function get(string $pattern, $callback) : RouteInterface;

  /**
   * group
   * @param string $pattern
   * @param callable|Closure $callback
   * @return RouteGroupInterface
   */
  public function group(string $pattern, $callback) : RouteGroupInterface;

  public function run() : void;

}
