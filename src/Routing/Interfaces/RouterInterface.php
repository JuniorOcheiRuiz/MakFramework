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
   * @param callable|\Closure $callback
   * @return RouteInterface
   */
  public function map(array $methods, string $pattern, callable $callback) : RouteInterface;


  public function run() : void;

}
