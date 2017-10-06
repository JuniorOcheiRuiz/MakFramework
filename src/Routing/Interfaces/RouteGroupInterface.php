<?php
namespace Makframework\Routing\Interfaces;

/**
 * RouteGroupInterface
 */
interface RouteGroupInterface extends RoutableInterface
{
  public function __construct(string $pattern, $callback);
}
