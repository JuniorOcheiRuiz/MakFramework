<?php
namespace Makframework\Routing\Interfaces;
/**
 * RouteGroupInterface
 */
interface RouteGroupInterface extends RoutableInterface
{
  /**
   * Class constructor
   *
   * @param string $pattern
   * @param callable $callback
   */
  public function __construct(string $pattern, callable $callback);

  /**
   * getRoutes
   *
   * @return RouteInterface[]
   */
  public function getRoutes() : array;
}
